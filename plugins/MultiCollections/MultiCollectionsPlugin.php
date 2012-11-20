<?php

class MultiCollectionsPlugin extends Omeka_Plugin_Abstract
{

    protected $_hooks = array(
        'install',
        'after_save_form_item',
        'admin_append_to_items_show_secondary',
        'item_browse_sql',
        'config_form',
        'config'
        );

    protected $_filters = array('admin_items_form_tabs', 'admin_navigation_main');

    protected $_options = null;

    public function hookInstall()
    {
        //check props I need

        if(!record_relations_property_id(DCTERMS, 'isPartOf')) {
            record_relations_install_properties(  array(
                  array(
                        'name' => 'Dublin Core',
                        'description' => 'Dublin Core Terms',
                        'namespace_uri' => DCTERMS,
                        'namespace_prefix' => 'dcterms',
                        'properties' => array(
                            array(
                                'local_part' => 'isPartOf',
                                'label' => 'is part of',
                                'description' => ''
                            )
                        )
                    )

              ));
        }
        //build existing Collection relations
        $relationTable = get_db()->getTable('RecordRelationsRelation');
        $props = self::defaultParams();
        $items = get_db()->getTable('Item')->findAll();
        foreach($items as $item) {
            $props['subject_id'] = $item->id;
            if(!is_null($item->collection_id) && $item->collection_id != 0) {
                $props['object_id'] = $item->collection_id;
                $relation = new RecordRelationsRelation();
                $relation->setProps($props);
                $relation->save();
            }

        }
    }

    public function hookConfig()
    {
        set_option('multicollections_override', $_POST['multicollections_override']);
    }

    public function hookConfigForm()
    {
        include 'config_form.php';
    }

    public function filterAdminNavigationMain($tabs)
    {
        $label = get_option('multicollections_override') ? 'Collections' : 'Multi-Collections';
        $tabs[$label] = uri('multi-collections/multi-collections/browse');
        return $tabs;
    }

    public function filterAdminItemsFormTabs($tabs, $item)
    {
        
        $db = get_db();
        $relationTable = $db->getTable('RecordRelationsRelation');
        $params = self::defaultParams();
        if(isset($item->id) && $item->id != null) {
            $params['subject_id'] = $item->id;
        }
        
        if($item->exists()) {
            $multicollections = $relationTable->findObjectRecordsByParams($params, array('indexById'=>true));
            $values = array_keys($multicollections);
        } else {
            $values = array();
        }
        $values = implode(",",array_values($values));
        /*
        $allCollections = $db->getTable('Collection')->findPairsForSelectForm();
        $html = "<h3>Check the Collections for the Item</h3>";
        $html .= __v()->formMultiCheckbox('multicollections_collections', $values, null, $allCollections , '');
        $label = get_option('multicollections_override') ? 'Collection' : 'Multi-Collections';
        */

        $html .= self::getFullCollectionTreeList( $linkToCollectionShow = true , $values);

        $tabs['Collections'] = $html;
        unset($tabs['Collection']);
        return $tabs;
    }

    /**
     * Build a nested HTML unordered list of the full collection tree, starting
     * at root collections.
     *
     * @param bool $linkToCollectionShow
     * @return string|null
     */
    public static function getFullCollectionTreeList($linkToCollectionShow = true, $values )
    {
        $rootCollections = get_db()->getTable('CollectionTree')->getRootCollections();

        // Return NULL if there are no root collections.
        if (!$rootCollections) {
            return null;
        }

        $html = '<ul>';
        foreach ($rootCollections as $rootCollection) {
            $html .= '<li>';
            $html .= '<label for="multicollections_collections-'.$rootCollection['id'].'">';
            $html .= '<input type="checkbox" '; 
            if(in_array( $rootCollection['id'], explode(',', $values)) !== false ) { $html .= 'checked="checked"'; }
            $html .= ' value="'.$rootCollection['id'].'" id="multicollections_collections-'.$rootCollection['id'].'" name="multicollections_collections[]">' .  $rootCollection['name'];
            $html .= '</label>';

            $collectionTree = get_db()->getTable('CollectionTree')->getDescendantTree($rootCollection['id']);
            $html .= self::getCollectionTreeList($collectionTree, true, $values);
            $html .= '</li>';
        }
        $html .= '</ul>';

        return $html;
    }

    /**
     * Recursively build a nested HTML unordered list from the provided
     * collection tree.
     *
     * @see CollectionTreeTable::getCollectionTree()
     * @see CollectionTreeTable::getAncestorTree()
     * @see CollectionTreeTable::getDescendantTree()
     * @param array $collectionTree
     * @param bool $linkToCollectionShow
     * @return string
     */
    public static function getCollectionTreeList($collectionTree, $linkToCollectionShow = true, $values) {
        if (!$collectionTree) {
            return;
        }

        $html = '<ul>';

        foreach ($collectionTree as $collection) {
            $html .= '<li>';
            $params = MultiCollectionsPlugin::defaultParams();
            $params['object_id'] = $collection['id'];

            $pos = strpos($collection['id'], $values);
            $html .= '<label for="multicollections_collections-'.$collection['id'].'">';
            $html .= '<input type="checkbox" '; 
            if(in_array( $collection['id'], explode(',', $values)) !== false ) { $html .= 'checked="checked"'; }
            $html .= ' value="'.$collection['id'].'" id="multicollections_collections-'.$collection['id'].'" name="multicollections_collections[]">' .  $collection['name'];
            $html .= '</label>';

            $html .= self::getCollectionTreeList($collection['children'], $linkToCollectionShow, $values);
            $html .= '</li>';
        }
        $html .= '</ul>';
        return $html;
    }

    public function hookAfterSaveFormItem($item, $post)
    {
        $relationTable = get_db()->getTable('RecordRelationsRelation');
        $props = self::defaultParams();
        $props['subject_id'] = $item->id;
        /* quick an dirty fix on the update item */
        $table = get_db()->getTable('RecordRelationsRelation')->getTableName();
        $query = "DELETE FROM $table WHERE {$table}.subject_id = ? LIMIT 1";
        get_db()->delete($table, 'subject_id = '  . (int) $item->id);
        /*end hack*/
        foreach($post['multicollections_collections'] as $collection_id) {
            $props['object_id'] = $collection_id;
            if($relationTable->count($props) == 0) {
                $relation = new RecordRelationsRelation();
                $relation->setProps($props);
                $relation->save();
            }
        }
    }

    public function hookItemBrowseSql($select, $params)
    {
        if (($request = Zend_Controller_Front::getInstance()->getRequest())) {
            $db = get_db();
            $collection_id = $request->get('multi-collection');
            if (is_numeric($collection_id)) {
                $select->joinInner(
                    array('rr' => $db->RecordRelationsRelation),
                    'rr.subject_id = i.id',
                    array()
                );
                $select->where('rr.object_id = ?', $collection_id);
                $select->where('rr.object_record_type = "Collection"');
                $select->where('rr.property_id = ?', record_relations_property_id(DCTERMS, 'isPartOf'));
                $select->where('rr.subject_record_type = "Item"');
                $select->group('i.id');
            }
        }
    }

    public function hookAdminAppendToItemsShowSecondary($item)
    {
        $html = '<div class="info-panel">';
        $html .= "<h2>Multiple Collections</h2>";
        $html .= "<div>";
        $collections = multicollections_get_collections_for_item($item);
        set_collections_for_loop($collections);
        while(loop_collections()) {
            $collection = get_current_collection();
            $html .= "<p>";
            $html .= $collection->name;
            $html .= " Item count: " . multicollections_total_items_in_collection() ;
            $html .= "</p>";
        }
        $html .= "</div>";
        echo $html;
    }

    public static function defaultParams()
    {
        return array(
            'subject_record_type' => 'Item',
            'object_record_type' => 'Collection',
            'property_id' => record_relations_property_id(DCTERMS, 'isPartOf'),
            'public' => true
        );

    }

    //new funxtions for tree
    /**
     * Cache collection data.
     */
    public function cacheCollections()
    {
        $db = $this->getDb();
        $sql = "
        SELECT c.*, nc.parent_collection_id 
        FROM {$db->Collection} c 
        LEFT JOIN {$db->CollectionTree} nc 
        ON c.id = nc.collection_id";
        
        // Cache only those collections to which the current user has access.
        if (!get_acl()->checkUserPermission('Collections', 'showNotPublic')) {
            $sql .= ' WHERE c.public = 1';
        }
        
        $sql .= ' ORDER BY name ASC ';

        $this->_collections = $db->fetchAll($sql);
    }

    /**
     * Get all root collections, i.e. those without parent collections.
     * 
     * @return array
     */
    public function getRootCollections()
    {
        // Cache collections if not already.
        if (!$this->_collections) {
            $this->cacheCollections();
        }
        
        $rootCollections = array();
        foreach ($this->_collections as $collection) {
            if (!$collection['parent_collection_id']) {
                $rootCollections[] = $collection;
            }
        }
        return $rootCollections;
    }  
    
    /**
     * Get the HTML link to the specified collection show page.
     *
     * @see link_to_collection()
     * @param int $collectionId
     * @return string
     */
    public static function linkToCollectionShow($collectionId, $collectionName = null)
    {
        // Require the helpers libraries. This is necessary when calling this
        // method before the libraries are loaded.
        require_once HELPERS;
        return link_to_collection($collectionName, array(), 'show', get_db()->getTable('Collection')->find($collectionId));
    }      
}


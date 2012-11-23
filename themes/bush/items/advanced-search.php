<?php

$pageTitle = __('Advanced Search');
if (!$isPartial):
    head(array('title' => $pageTitle,
               'bodyclass' => 'advanced-search',
               'bodyid' => 'advanced-search-page'));
?>
    <?php if(!is_admin_theme()): ?>
        <div class="splashimage">
        </div>
        
        <div class="subtitle">
            <h1><?php echo $pageTitle; ?></h1>
        </div>

    
    <div class="content">
        <div class="container">
        <div id="primary">
    <?php endif; ?>

 <h1><?php echo $pageTitle; ?></h1>
    <?php if(is_admin_theme()): ?>
        <div id="primary">
    <?php endif; ?>

<?php endif; ?>

<?php
if ($formActionUri):
    $formAttributes['action'] = $formActionUri;
else:
    $formAttributes['action'] = uri(array('controller'=>'items','action'=>'browse'));
endif;

$formAttributes['method'] = 'GET';
?>

    <form <?php echo _tag_attributes($formAttributes); ?>>
                <div id="search-keywords" class="field">
                    <?php echo label(array('for'=>'keyword-search'), __('Search for Keywords:')); ?>
                    <div class="inputs">
                    <?php echo text(array(
                            'name' => 'search',
                            'size' => '40',
                            'id' => 'keyword-search',
                            'class' => 'textinput'), @$_REQUEST['search']); ?>
                    </div></div>
        
                <div id="search-narrow-by-fields" class="field">
                    <div><?php echo __('Narrow by Specific Fields'); ?></div>
                    <div class="inputs">
                    <?php
                    // If the form has been submitted, retain the number of search
                    // fields used and rebuild the form
                    if (!empty($_GET['advanced'])) {
                        $search = $_GET['advanced'];
                    } else {
                        $search = array(array('field'=>'','type'=>'','value'=>''));
                    }

                    //Here is where we actually build the search form
                    foreach ($search as $i => $rows): ?>
                        <div class="search-entry">
                            <?php
                            //The POST looks like =>
                            // advanced[0] =>
                            //[field] = 'description'
                            //[type] = 'contains'
                            //[terms] = 'foobar'
                            //etc
                            echo select_element(
                                array('name' => "advanced[$i][element_id]"),
                                @$rows['element_id'],
                                null,
                                array('record_types' => array('Item', 'All'),
                                      'sort' => 'alphaBySet'));
                            echo select(
                                array('name' => "advanced[$i][type]"),
                                array('contains' => __('contains'),
                                      'does not contain' => __('does not contain'),
                                      'is exactly' => __('is exactly'),
                                      'is empty' => __('is empty'),
                                      'is not empty' => __('is not empty')),
                                @$rows['type']
                            );
                            echo text(
                                array('name' => "advanced[$i][terms]",
                                      'size' => 20),
                                @$rows['terms']); ?>
                            <button type="button" class="remove_search" disabled="disabled" style="display: none;">-</button>
                        </div>
                    <?php endforeach; ?>
                    </div>
                    <button type="button" class="add_search"> <?php echo __('Add a Field'); ?></button>
                </div>

        
                <div class="field">
                    <?php echo label(array('for'=>'collection-search'), __('Search By Collection')); ?>
                    <div class="inputs"><?php
                        echo select_collection(array(
                            'name' => 'collection',
                            'id' => 'collection-search',
                            'class' => 'span6'
                        ), @$_REQUEST['collection']); ?>
                    </div>
                </div>

                <div class="field">
                    <?php echo label(array('for'=>'item-type-search'), __('Search By Item/Document Type')); ?>
                    <div class="inputs"><?php
                        echo select_item_type(array('name'=>'type', 'id'=>'item-type-search','class'=>'span3'),
                            @$_REQUEST['type']); ?>
                    </div>

                <div class="field">
                    <label>Search by Script Type</label>
                    <div class="inputs">
                        <?php echo select(array('name' => 'script-type', 'id' => 'script-type', 'class' => 'span3'),
                            array('1' => __('Primarily Handwritten'),
                                  '0' => __('Primarily Typewritten')),
                            @$_REQUEST['script-type']); ?>
                    </div>
                </div>
        </div>

                <div class="field">
                    <?php echo label(array('for'=>'tag-search'), __('Search By Tags')); ?>
                    <div class="inputs">
                        <?php 
                        $tagList = tag_string(get_tags(),$link=false,$delimiter=",");
                        $quotedTags = str_replace(",", "\",\"", $tagList);
                        echo text(array(
                            'name' => 'tags',
                            'size' => '40',
                            'id' => 'tag-search',
                            'class'=>'textinput typeahead span3',
                            'data-provide'=>'typeahead',
                            'data-source'=>'["'.$quotedTags.'"]',
                            'data-items'=>'12',
                            'data-minLength' => '2',
                            ),

                        @$_REQUEST['tags']); ?>
                    </div>

                <div id="search-by-range" class="field">
                    <label for="range"><?php echo __('Search by a range of ID#s (example: 1-4, 156, 79)'); ?></label>
                    <div class="inputs">
                    <?php echo text(
                            array('name' => 'range',
                                  'size' => '40',
                                  'class' => 'textinput span3'),
                            @$_GET['range']); ?>
                    </div>
                </div>
        </div>

                <div class="field">
                    <?php echo label(array('for'=>'creator-search'), __('Search for an Author')); ?>
                    <div class="inputs">
                        <?php 
                        //$tagList = tag_string(get_tags(),$link=false,$delimiter=",");
                        //$quotedTags = str_replace(",", "\",\"", $tagList);
                        echo text(array(
                            'name' => 'creator-search',
                            'size' => '40',
                            'id' => 'creator-search',
                            'class'=>'textinput typeahead span3',
                            'data-provide'=>'typeahead',
                            //'data-source'=>'["'.$quotedTags.'"]',
                            'data-items'=>'12',
                            'data-minLength' => '2',
                            ),

                        @$_REQUEST['creator']); ?>
                    </div>


                <div id="search-by-range" class="field">
                    <label for="recipient-search"><?php echo __('Search for a Recipient'); ?></label>
                    <div class="inputs">
                    <?php echo text(
                            array('name' => 'recipient-search',
                                  'id' => 'recipient-search',
                                  'size' => '40',
                                  'class' => 'textinput span3'),
                            @$_GET['recipient']); ?>
                    </div>
                </div>

        </div>
        <?php if(is_admin_theme()): ?>

        
            
                <?php if (has_permission('Items','showNotPublic')): ?>
                <div class="field">
                    <?php echo label(array('for'=>'public'), __('Public/Non-Public')); ?>
                    <div class="inputs">
                        <?php echo select(array('name' => 'public', 'id' => 'public'),
                            array('1' => __('Only Public Items'),
                                  '0' => __('Only Non-Public Items')),
                            @$_REQUEST['public']); ?>
                    </div>
                </div>
                <?php endif; ?>
            
            
                <div class="field">
                    <?php echo label(array('for'=>'featured'), __('Featured/Non-Featured')); ?>
                    <div class="inputs">
                        <?php echo select(array('name' => 'featured', 'id' => 'featured'),
                            array('1' => __('Only Featured Items'),
                                  '0' => __('Only Non-Featured Items')),
                            @$_REQUEST['featured']); ?>
                    </div>
                </div>
            
            
                <?php if(is_admin_theme()): //(has_permission('Users', 'browse')): ?>
                <div class="field">
                <?php
                    echo label(array('for'=>'user-search'), __('Search By User'));?>
                    <div class="inputs"><?php
                        echo select_user(array(
                                'name' => 'user',
                                'id' => 'user-search'),
                            @$_REQUEST['user']);?>
                    </div>
                </div>
                <?php endif; ?>
            
        
        <?php endif ?>
        
                <?php is_admin_theme() ? fire_plugin_hook('admin_append_to_advanced_search') : fire_plugin_hook('public_append_to_advanced_search'); ?>
            
        <!-- <div class="span12"><hr /></div> -->
        
                <input type="submit" class="submit" name="submit_search" id="submit_search_advanced" value="<?php echo __('Search'); ?>" />
            
    </form>

<?php echo js('search'); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        Omeka.Search.activateSearchButtons();
    });
</script>

<?php if (!$isPartial): ?>
</div> <!-- Close 'primary' div. -->
        </div> <!-- /container -->

    </div> <!-- /content -->
<?php foot(); ?>
<?php endif; ?>

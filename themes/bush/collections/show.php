<?php
    head(array('title' => html_escape($collection->name),
            'bodyid'=>'collections',
            'bodyclass' => 'show')
    );
?>


        <div class="splashimage">
        </div>

        <div class="subtitle">
            <h1><?php echo collection('Name'); ?></h1>
        </div>


    <div class="content">
        <div class="container">


<div id="primary">
    <h1><?php echo collection('Name'); ?></h1>

    <div id="description" class="element">
        <h2><?php echo __('Description'); ?></h2>
        <div class="element-text"><?php echo nls2p(collection('Description')); ?></div>
    </div><!-- end description -->

    <p class="view-items-link"><?php echo link_to_browse_items('View items in the collection', array('collection' => collection('id'))); ?></p>


    <div id="collection-items">
        <h2>Materiale ne koleksionin <?php echo collection('Name'); ?></h2>
        <?php while (multicollections_loop_items_in_collection()): ?>
        <div class="item hentry">
            <h3>
                <?php echo link_to_item(item('Dublin Core','Title')); ?>
            </h3>
            <div class="item-description">
                <?php echo item('Dublin Core','Description'); ?>
            </div>
        </div>
        <?php endwhile ?>
    </div>

</div><!-- end primary -->

        </div> <!-- /container -->

    </div> <!-- /content -->


<?php foot(); ?>

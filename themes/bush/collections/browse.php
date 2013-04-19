<?php head(array('title'=>'Browse Collections','bodyid'=>'collections','bodyclass' => 'browse')); ?>

<div class="splashimage">
</div>

<div class="subtitle">
<h1>Shfleto Koleksionet</h1>
</div>


<div class="content">
    <div class="container">

        <div id="primary">

            <h1><?php echo __('Browse Collections'); ?></h1>
            <div class="pagination"><?php echo pagination_links(); ?></div>

            <?php while (loop_collections()): ?>
            <div class="collection">
                <h2><?php echo link_to_collection(); ?></h2>

                <div class="element">
                    <h3><?php echo __('Description'); ?></h3>
                    <div>
                        <?php echo nls2p(collection('Description', array('snippet'=>150))); ?>
                    </div>
                </div>

                <p class="view-items-link">
                    <?php echo link_to_browse_items('View the items in this collection', array('collection' => collection('id'))); ?>
                </p>
            </div>
            <!-- end class="collection" -->
            <?php endwhile; ?>
        </div>
    </div>
</div>
<?php foot(); ?>

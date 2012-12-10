<?php
$pageTitle = __('Browse Items');
head(array('title'=>$pageTitle,'bodyid'=>'items','bodyclass' => 'browse'));
?>
<div class="splashimage">
</div>

<div class="subtitle">
    <h1><?php echo $pageTitle;?></h1>
</div>


<div class="content">
<div class="container">
<div id="primary">

    <div class="row">
        <div class="span3">

        <h2><?php echo $pageTitle;?></h2>
        <p><?php echo __('(%s items total)', total_results()); ?></p>
        <ul class="optionlist items-nav navigation" id="secondary-nav">
            <li>
                <a href="<?php echo uri('items/browse'); ?>">Browse All Primary Sources</a>
            </li>
            <li>
                <a onclick="return false;" href="#">Browse by Item Type</a>
                <?php
                //item type         = 51
                //subject           = 49
                //date              = 40
                //keywords(tags)

                $category = new MetadataBrowserCategory();
                $category->element_id = 51;
                $categoryValues = $category->getAssignedValues();
                ?>
                <ul class="sublist">
                <?php foreach($categoryValues as $value): ?>
                    <li><?php echo metadata_browser_create_link(51, $value)?></li>
                <?php endforeach; ?>
                </ul>
            </li>
            <li>
                <a onclick="return false;" href="#">Browse by Subject</a>
                <?php
                //item type         = 51
                //subject           = 49
                //date              = 40
                //keywords(tags)

                $category = new MetadataBrowserCategory();
                $category->element_id = 49;
                $categoryValues = $category->getAssignedValues();
                ?>
                <ul class="sublist">
                <?php foreach($categoryValues as $value): ?>
                    <li><?php echo metadata_browser_create_link(49, $value)?></li>
                <?php endforeach; ?>
                </ul>
            </li>
            <li>
                <a onclick="return false;" href="#">Browse by Date</a>
                <?php
                //item type         = 51
                //subject           = 49
                //date              = 40
                //keywords(tags)

                $category = new MetadataBrowserCategory();
                $category->element_id = 40;
                $categoryValues = $category->getAssignedValues();
                ?>
                <ul class="sublist">
                <?php foreach($categoryValues as $value): ?>
                    <li><?php echo metadata_browser_create_link(40, $value)?></li>
                <?php endforeach; ?>
                </ul>
            </li>
            <li>
                <a onclick="return false;" href="#">Browse by Keywords</a>
                <ul class="sublist tags" style="display: block;">
                <?php
                    $tags = get_tags(array('sort' => 'alpha'));
                    foreach($tags as $id => $tag) :
                ?>
                       <li>
                            <a href="<?php echo html_escape(uri("items/browse") . "?tags=" . urlencode($tag->name)); ?>"><?php echo $tag->name; ?></a>
                       </li>
                <?php
                    endforeach;
                ?>
                </ul>
            </li>
        </ul>

    <script type="text/javascript">
    jQuery('.optionlist li a').click(function(){
        jQuery(this).parent().children('.sublist').slideToggle();
    });
    </script>

    </div>
    <div class="span9">

    <div id="pagination-top" class="pagination">
        <?php echo pagination_links(); ?>
    </div>


<?php if (get_theme_option('Display Items Carousel') == '1'): ?>
    <div class="row"><div class="span8 offset2">
    <div id="itemsCarousel" class="carousel slide">
        <div class="carousel-inner">
    <?php while (loop_items()): ?>
            <div class="item">
                <?php if (item_has_thumbnail()): ?>
                <div class="carousel-img" style="text-align: center">
                    <?php echo link_to_item(item_thumbnail($props=array('class'=>'img-polaroid'))); ?>
                </div>
                <?php endif; ?>
                <div class="carousel-caption">
                    <h4><?php echo link_to_item(item('Dublin Core', 'Title'), array('class'=>'permalink')); ?></h4>
                    <?php if ($description = item('Dublin Core', 'Description', array('snippet'=>250))): ?>
                    <p class="item-description">
                        <?php echo $description; ?>
                    </p>
                    <?php elseif ($text = item('Item Type Metadata', 'Text', array('snippet'=>250))): ?>
                    <div class="item-description">
                        <?php echo $text; ?>
                    </div>

                    <?php endif; ?>

                    <?php if (item_has_tags()): ?>
                    <div class="tags"><p><strong><?php echo __('Tags'); ?>:</strong>
                        <?php echo item_tags_as_string(); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
                <?php echo plugin_append_to_items_browse_each(); ?>
                </div>
        <?php endwhile; ?>
        </div>
        <a class="carousel-control left" href="#itemsCarousel" data-slide="prev">&lsaquo;</a>
        <a class="carousel-control right" href="#itemsCarousel" data-slide="next">&rsaquo;</a>
    </div>
    </div></div>
<?php else: ?>
    <?php while (loop_items()): ?>
<div class="item hentry">
    <div class="item-meta">
            <?php if (item_has_thumbnail()): ?>
                <div class="item-img">
                <?php echo link_to_item(item_thumbnail()); ?>
                </div>
            <?php endif; ?>

            <div class="item-title">
                <h3><?php echo link_to_item(item('Dublin Core', 'Title'), array('class'=>'permalink')); ?></h3>
            </div>
            <?php if ($text = item('Item Type Metadata', 'Text', array('snippet'=>250))): ?>
                <div class="item-description">
                    <p><?php echo $text; ?></p>
                </div>
            <?php elseif ($description = item('Dublin Core', 'Description', array('snippet'=>250))): ?>
                <div class="item-description">
                    <?php echo $description; ?>
                </div>
            <?php endif; ?>

            <?php if (item_belongs_to_collection()): ?>
                <p><div><strong><?php echo __('Collection'); ?></strong></div>
                <div class="element-text"><?php echo link_to_collection_for_item(); ?></div></p>

            <?php endif; ?>

            <!-- <div>
                <h5>Citation</h5>
                <p class="citation"><?php echo item_citation(); ?></p>
            </div> -->

            <?php if (item_has_tags()): ?>
                <div class="tags">
                    <p><strong>Tags:</strong>
                    <?php echo item_tags_as_string(); ?>
                </div>
            <?php endif; ?>

    </div><!-- end class="item-meta" -->
    <div class="force-layout">&nbsp;</div>
</div><!-- end class="item hentry" -->

<?php echo plugin_append_to_items_browse_each(); ?>
    <?php endwhile; ?>
<?php endif; ?>

   <div id="pagination-top" class="pagination">
        <?php echo pagination_links(); ?>
    </div>

    <?php echo plugin_append_to_items_browse(); ?>
        </div><!-- end span9 -->
    </div><!-- end row -->

</div><!-- end primary -->

        </div> <!-- /container -->

    </div> <!-- /content -->

<?php foot(); ?>

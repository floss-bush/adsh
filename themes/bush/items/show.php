<?php
    head(array('title' => item('Dublin Core', 'Title'), 'bodyid'=>'items','bodyclass' => 'show'));
    $item = $this->item;
    ?>
<div class="splashimage">
</div>

<div class="subtitle">
    <h1>Explore the Collection</h1>
</div>

    <div class="content">
        <div class="container">


            <div class="secondary-nav top">
                <span class="previous">
                    <?php echo link_to_previous_item('&laquo; Previous Item'); ?>
                </span>
                <span class="next">
                    <?php echo link_to_next_item('Next Item &raquo;'); ?>
                </span>
            </div>
    <div id="primary">

        <div class="row">

                <div class="span1 noprint" style="text-align: center;">

    <!-- AddThis Button BEGIN -->
    <div class="addthis_toolbox addthis_32x32_style" style="margin-left: 20px;">
    <a class="addthis_button_facebook"></a>
    <a class="addthis_button_twitter"></a>
    <a class="addthis_button_linkedin"></a>
    <a class="addthis_button_compact"></a>
    </div>
    <script type="text/javascript">
    var addthis_share =
    {
        title: "Arkivat Shkoder | Database i materialit arkivor te bibliotekave te Shkodres",
        url_transforms : {
             shorten: {
                 twitter: 'bitly'
            }
        },
        shorteners : {
             bitly : {}
        }
    };
    </script>
    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=gjergjsheldija"></script>
    <!-- AddThis Button END -->

                &nbsp;
        </div>

        <div class="span11">
            <div class="span6" style="float: right;">
                <ul class="thumbnails">
                <li class="span6">
                    <?php echo
                        display_files_for_item(
                            array('imageSize'=>'thumbnail','linkToFile'=>true,'linkToMetadata'=>false, 'linkAttributes' => array('class' => 'thumbnail fancybox-zoomit fancybox.iframe', 'type'=>'iframe', 'rel'=>'images')),
                            array('id'=>'item-image'), //wrapperAttributes
                            null
                        );
                    ?>
                </li>
                </ul>
            </div>

        <?php echo flash(); ?>
        <h2><?php echo item('Dublin Core', 'Title') . item('Dublin Core','Identifier'); ?> </h2>

    <div class="element-set">
        <h3><?php echo __('Description'); ?></h3>
        <?php if ($itemDescription = item('Dublin Core','Description')): ?>
            <p><?php echo $itemDescription; ?></p>
        <?php else: ?>
            <p><strong>Sorry!</strong> No description recorded.</p>
        <?php endif; ?>
    </div>

    <div id="item-tags" class="element">
        <h3><?php echo __('Keywords'); ?></h3>
        <?php if (item_tags_as_string() != null) {
                            echo item_tags_as_string(); }
                            else {
                            echo 'No tags recorded for this item.';
                            }
                        ?>
    </div>

    <div id="item-collection" class="element">
           <h3><?php echo __('Collection'); ?></h3>
        <div class="element-text">
            <?php echo link_to_collection_for_item(); ?>
        </div>
    </div>

    <div id="date-collection" class="element">
           <h3><?php echo __('Date'); ?></h3>
        <div class="element-text">
            <?php echo item('Dublin Core','Date'); ?>
        </div>
    </div>

    <div id="creator-collection" class="element">
           <h3><?php echo __('Author'); ?></h3>
        <div class="element-text">
            <?php echo item('Dublin Core','Creator'); ?>
        </div>
    </div>

    <div id="item-citation" class="element" style="clear: both;">
        <h3><?php echo __('Citation'); ?></h3>
        <div class="element-text">
            <?php echo item_citation($item); ?>
        </div>
    </div>

<style type="text/css" media="screen">

            #cc_license { text-align:left;margin:auto;}
            div.cc_info  { text-align:left;}
            a.cc_js_a { padding-bottom:1em;}

        </style>

        <div id="cc_license"><!-- Creative Commonts License -->
            <h3><?php echo __('Owner'); ?></h3>
            <?php
                if( strpos(item_tags_as_string(),'Marin Barleti') ) :
            ?>
                <a href="<?php echo html_escape(uri("items/browse") . "?tags=" . urlencode("Marin Barleti")); ?>">
                    <img src="<?php echo WEB_THEME; ?>/bush/img/logo_marin_barleti_trans.png" alt="Biblioteka Marin Barleti">
                </a>
            <?php
                else :
            ?>
                <a href="<?php echo html_escape(uri("items/browse") . "?tags=" . urlencode("BUSH")); ?>">
                    <img src="<?php echo WEB_THEME; ?>/bush/img/logo_bush_trans.png" alt="Biblioteka Universitare Shkoder">
                </a>
            <?php
                endif;
            ?>
        </div>

</div> <!-- /span11 -->


</div> <!-- /row -->

</div> <!-- /#primary -->

    <div class="secondary-nav bottom">
        <span class="previous">
            <?php echo link_to_previous_item('&laquo; Previous Item'); ?></span>
        <span class="next">
            <?php echo link_to_next_item('Next Item &raquo;'); ?></span>
    </div>


        </div> <!-- /container -->

    </div> <!-- /content -->


</div>
<!-- end primary -->
<script type="text/javascript">
jQuery(document).ready(function() {

    if (!jQuery.browser.mobile)
    {
        jQuery(".fancybox-zoomit").fancybox({
            width       : '90%',
            height      : '90%',
            autoSize    : true,
            closeClick  : false,
            preload     : 0,
            loop        : false,
            iframe      : { preload : false },
            openEffect  : 'none',
            closeEffect : 'none',
            nextEffect  : 'none',
            prevEffect  : 'none',
            padding     : 0,
            margin      : [20, 60, 20, 60] // Increase left/right margin
        });
    }
});
</script>
<?php foot(); ?>

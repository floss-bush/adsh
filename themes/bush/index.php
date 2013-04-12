<!-- load the header -->
<?php head(array('bodyid'=>'home')); ?>
<div class="splashimage">
</div>

<div class="subtitle">
<h1>Homepage</h1>
</div>

    <div class="content">
    <div class="container">

    <div class="row">

    <div class="span4">
        <h2>Misioni</h2>
        <p>Arkivi digjital synon t&euml; siguroj&euml; qasje digjitale n&euml; form&euml; t&euml; strukturuar dhe autoritare n&euml; m&euml;nyr&euml; q&euml; t&euml; integroj&euml; teknologjin&euml; e informacionit, arsimin dhe kultur&euml;n n&euml; bibliotekat bashk&euml;kohore.<br />
            Misioni i yn&euml; &euml;sht&euml; i nj&euml;jt&euml; me ata t&euml; bibliotekave t&euml; tjera digjitale kudo n&euml; Bot&euml;.<br />
            Synimet tona jan&euml;:<br /></p>
            <ul>
            <li>Qasja dhe ruajtja p&euml;rmes koleksioneve virtuale e trashigimis&euml; kulturore, sidomos t&euml; arkivave me vler&euml; t&euml; bibliotekave tona.</li>
            <li>Krijimi i nj&euml; sistemi bibliotekash digjitale n&euml; qytetin e Shkodr&euml;s, duke l&euml;n&euml; hap&euml;sir&euml; bashk&euml;punimi edhe p&euml;r krijimin e rrjeteve t&euml; integruara digjitale duke respektuar gjithnj&euml; standartet e pranuara nd&euml;rkomb&euml;tare.</li>
            <li>Lidhjet e bibliotekave me rrjetet e shpejta t&euml; k&euml;rkimit.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</li>
            <li>Realizimi i ciklit t&euml; plot&euml; t&euml; krijimit, shp&euml;rndarjes, p&euml;rdorimit dhe&nbsp;&nbsp;&nbsp;&nbsp; ruajtjes s&euml; t&euml; dh&euml;nave, t&euml; informacionit dhe dijes.&nbsp;&nbsp;&nbsp;&nbsp;</li>
            </ul>
        </p>

    </div>

    <?php if (get_theme_option('Display Featured Item') !== '0'): ?>
        <div class="span4">
            <!-- Featured Item -->
            <div id="featured-item">
                <?php echo display_random_featured_item(); ?>
            </div><!--end featured-item-->
        </div>
    <?php else: ?>
        <div class="span4"></div>
    <?php endif; ?>

    <?php if (get_theme_option('Display Featured Collection') !== '0'): ?>
        <div class="span4">
            <!-- Featured Collection -->
            <div id="featured-collection">
                <h2><?php echo  __('Featured Collection'); ?></h2>
                <?php set_collections_for_loop(recent_collections(1)); ?>
                <?php while (loop_collections()): ?>
                <h3><?php echo link_to_collection() ?></h3>
                <?php while (loop_items_in_collection(1)): ?>
                    <?php if (item_has_thumbnail()): ?>
                            <?php echo link_to_collection(item_square_thumbnail(array('alt'=>item('Dublin Core', 'Title')))); ?>
                    <?php endif; ?>
                    <?php echo nls2p(collection('Description', array('snippet'=>300))); ?>
                <?php endwhile; ?>
                <?php endwhile; ?>
            </div><!-- end featured collection -->
        </div>
    <?php else: ?>
        <div class="span4"></div>
    <?php endif; ?>
    </div><!-- end row -->

    <?php if ((get_theme_option('Display Featured Exhibit') !== '0')
                    && plugin_is_active('ExhibitBuilder')
                    && function_exists('exhibit_builder_display_random_featured_exhibit')): ?>

    <div class="row">
        <div class="span12"><hr /></div>
    </div>
    <div class="row">
        <div class="span12">
            <!-- Featured Exhibit -->
            <?php echo exhibit_builder_display_random_featured_exhibit(); ?>
        </div>
        </div>
    <?php endif; ?>
    </div>
</div>

<?php foot(); ?>

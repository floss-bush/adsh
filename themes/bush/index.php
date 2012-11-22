<!-- load the header -->
<?php head(array('bodyid'=>'home')); ?>
        <div id="home-splash">
            <div class="container">
                <div class="row">
        
                    <div class="span4">
                        <div id="twitter-feed">
                        <div id="home-main-subtitle">Promovim i botimeve &amp; diskutimit</div>
                        <div id="home-main-title">Historik 
                        <span class="title-highlight">i Botimit</span></div>
                        <?php echo get_theme_option('Homepage Text'); ?>
                        </div>
                    </div>
        
                    <div class="span8 textright">
                        <img src="<?php echo uri(); ?>themes/bush/img/homepage_image.jpg" width="480" height="637">
                        
                    </div>
        
                </div>
            </div>
        </div>
        
        <script type="text/javascript">
        jQuery(window).load(function() {
            getTweets('GreenfieldHWE', 'twitter-content', function(){ setupPager('twitter-content', 'twitter-pager-list'); });
        });
        </script>

    
    <div class="content">
        <div class="container">
        
    <div class="row">

    <div class="span4">
        <h2>Our Mission</h2>
        <p>The Albert M. Greenfield Digital Center for the History of Women's Education aims to foster 
            scholarship and dialogue on the history of women’s education by providing a digital space that 
            will act as a locus for inquiry and research into these diverse histories.
            The Albert M. Greenfield Digital Center for the History of Women's Education aims to foster 
            scholarship and dialogue on the history of women’s education by providing a digital space that 
            will act as a locus for inquiry and research into these diverse histories.
            The Albert M. Greenfield Digital Center for the History of Women's Education aims to foster 
            scholarship and dialogue on the history of women’s education by providing a digital space that 
            will act as a locus for inquiry 
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
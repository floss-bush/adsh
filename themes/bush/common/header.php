<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <?php if ( $description = settings('description')): ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <?php endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo settings('site_title'); echo isset($title) ? ' | ' . strip_formatting($title) : ''; ?></title>

    <?php echo auto_discovery_link_tags(); ?>

    <!-- Plugin Stuff -->
    <?php plugin_header(); ?>

    <!-- Stylesheets -->
    <?php
        queue_css(array('bootstrap', 'pagination', 'jquery.fancybox' ,'bush','jquery.reject'));
        display_css();
    ?>
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- JavaScripts -->
    <?php
        queue_js(array('bootstrap','twitter', 'jquery.fancybox','jquery.reject'),$dir='js');

        if (get_theme_option('Use Google Analytics') == 1): ?>

            <script type="text/javascript">
                var _gaq = _gaq || [];
                _gaq.push(['_setAccount', '<?php echo html_entity_decode(get_theme_option('Google Analytics Account')); ?>']);
                _gaq.push(['_trackPageview']);

                (function() {
                  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
                })();

             </script>

        <?php endif;

        display_js();
    ?>
<script type="text/javascript">
jQuery(document).ready(function($){
    $.reject({
        reject: { all: false }, // Reject all renderers for demo
        header: 'Browser i juaj nuk suportohet', // Header Text
        paragraph1: 'Jeni duke perdorur nje nrowser qe nuk e perbadhon kete sit.', // Paragraph 1
        paragraph2: 'Ju lutem instaloni nje nga browser te meposhtem',
        closeMessage: 'Ky sit web funksionon vetem me browser te mesiperm', // Message below close window link
        closeLink: 'Mbylle kete dritare',
        imagePath: window.location + 'themes/bush/img/browser/',
    }); // Customized Text
});
</script>
</head>

<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
<?php plugin_body(); ?>
	<div class="header">
		<div class="header-inner">
			<div class="container">
					<?php echo custom_header_logo() ?>
				<div id="header-search">
					<?php echo custom_simple_search(); ?>
                <?php echo link_to_advanced_search($text='Advanced Search'); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="navbar">
        <div class="navbar-inner">
        <div class="container">
            <ul class="nav">
                <?php echo custom_public_nav_header(); ?>
            </ul>
        </div><!-- end primary-nav -->
    </div><!-- end navbar -->
</div>

<?php plugin_page_content(); ?>

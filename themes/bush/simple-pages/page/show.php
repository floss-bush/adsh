<?php 

$bodyclass = 'page simple-page';
if (simple_pages_is_home_page(get_current_simple_page())) {
    $bodyclass .= ' simple-page-home';
} ?>

<?php head(array('title' => html_escape(simple_page('title')), 'bodyclass' => $bodyclass, 'bodyid' => html_escape(simple_page('slug')))); ?>

<div class="splashimage">
</div>

<div class="subtitle">
	<h1><?php echo html_escape(simple_page('title')); ?></h1>
</div>


<div class="content">
<div class="container">

<?php if (!simple_pages_is_home_page(get_current_simple_page())): ?>
	<div class="row">
		<div class="span3">
			<h2>More</h2>

			<div class="optionlist">
    		<?php echo simple_pages_navigation(); ?>
			</div>
		</div>
<?php endif; ?>

	<!--
	    <?php if (!simple_pages_is_home_page(get_current_simple_page())): ?>
	    <p id="simple-pages-breadcrumbs"><?php echo simple_pages_display_breadcrumbs(); ?></p>
	    <?php endif; ?>
	 --> 
	<div class="span9">  
    <h2><?php echo html_escape(simple_page('title')); ?></h2>
    <?php
    if (simple_page('use_tiny_mce')) {
        echo simple_page('text');
    } else {
        echo eval('?>' . simple_page('text'));
    }
    ?>
	</div>


	</div>
		</div> <!-- /container -->

	</div> <!-- /content -->
<?php echo foot(); ?>
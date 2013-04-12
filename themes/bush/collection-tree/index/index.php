<?php head(); ?>
<div class="splashimage">
</div>

<div class="subtitle">
<h1>Collection Tree</h1>
</div>


<div class="content">
<div class="container">

	<div id="primary">
		<h1>Collection Tree</h1>

	<h2><?php echo settings('collection_tree'); ?></h2>

	<div class="row">
		<div class="span6">

			<?php if ($this->fullCollectionTree): ?>
			<?php echo $this->fullCollectionTree; ?>
			<?php else: ?>
			<p>There are no collections.</p>
			<?php endif; ?>

		</div> <!-- div.span6 -->
		<div class="span6">

		</div>
	</div> <!-- row -->

</div> <!-- #primary -->

		</div> <!-- /container -->

	</div> <!-- /content -->
<?php foot(); ?>

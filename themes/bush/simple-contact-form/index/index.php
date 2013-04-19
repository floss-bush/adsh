<?php head(); ?>
<div class="splashimage">
</div>

<div class="subtitle">
	<h1><?php echo settings('simple_contact_form_contact_page_title'); ?></h1>
</div>


<div class="content">
<div class="container">

			<div id="primary">

	<h2><?php echo settings('simple_contact_form_contact_page_title'); ?></h2>

	<div class="row">
		<div class="span6">

			<div id="simple-contact">
				<div id="form-instructions">
					<?php echo get_option('simple_contact_form_contact_page_instructions'); // HTML ?>
				</div>
				<?php echo flash(); ?>
				<form name="contact_form" id="contact-form"  method="post" enctype="multipart/form-data" accept-charset="utf-8">

			        <fieldset>

			        <div class="field">
					<?php
					    echo $this->formLabel('name', 'Emri: ');
					    echo $this->formText('name', $name, array('class'=>'textinput')); ?>
					</div>

			        <div class="field">
			            <?php
			            echo $this->formLabel('email', 'Email: ');
					    echo $this->formText('email', $email, array('class'=>'textinput'));  ?>
			        </div>

					<div class="field">
					  <?php
					    echo $this->formLabel('message', 'Mesazhi: ');
					    echo $this->formTextarea('message', $message, array('class'=>'textinput')); ?>
					</div>

					</fieldset>

					<fieldset>

					<div class="field">
					  <?php echo $captcha; ?>
					</div>

					<div class="field">
					  <?php echo $this->formSubmit('send', 'Dergo Mesazhin'); ?>
					</div>

				    </fieldset>
				</form>
			</div>
		</div> <!-- div.span6 -->
		<div class="span6">
			<?php display_random_featured_item(); ?>
		</div>
	</div> <!-- row -->

</div> <!-- #primary -->

		</div> <!-- /container -->

	</div> <!-- /content -->
<?php foot(); ?>

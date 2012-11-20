        </div><!-- end content -->


	<div class="copyright">
		<div class="copyright-inner">
			<div class="container">
				<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style noprint" style="float: right;">
				<a class="addthis_button_facebook"></a>
				<a class="addthis_button_twitter"></a>
				<a class="addthis_button_linkedin"></a>
				<a class="addthis_button_compact"></a>
				</div>
				<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=gjergjsheldija"></script>
				<!-- AddThis Button END -->

				&copy; 2012 Biblioteka Universitare Shkoder.  All Rights Reserved.
			</div>
		</div>
	</div>

<div class="navbar navbar-bottom">
		<div class="navbar-inner">
			<div class="container">
				<ul class="nav">
				<?php echo public_nav_main(array(
							__('Home') => uri(''), 
							__('About Us') => uri(''), 
							__('Browse Items') => uri('items'), 
							__('Browse Collections') => uri('collections'),
							__('Contact Us') => uri('collections')
							));
	        	?>
				</ul>
			</div>
		</div>
	</div>


	<div class="footer">
		<div class="footer-inner">
			<div class="container">
				<ul class="nav nav-left">
					<li class="nav-project-documentation"><a href="#">Dokumentacion mbi perdorimin e materialit</a></li>
					<li class="nav-privacy-policy"><a href="#">Privacy Policy</a></li>
					<li class="nav-terms-of-use"><a href="#">Termat e perdorimit</a></li>
				</ul>
				<ul class="nav nav-right">
					<li><a href="http://bibliotekashkoder.com/" target="_blank"><img src="<?php echo uri(); ?>themes/bush/img/logo_marin_barleti_trans.png" alt="Biblioteka Marin Barleti"></a></li>
					<li><a href="http://bush.unishk.edu.al" target="_blank"><img src="<?php echo uri(); ?>themes/bush/img/logo_bush_trans.png" alt="Biblioteka Shkencore Universitare"></a></li>
				</ul>
			</div>
		</div>
	</div>

</body>
</html>

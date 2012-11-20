        </div><!-- end content -->

	<div class="footer">
		<div class="footer-inner">
			<div class="container">
				<ul class="nav nav-left">
					<li class="nav-project-documentation"><a href="/greenfield/projectdocs">Project Documentation</a></li>
<li class="nav-privacy-policy"><a href="/greenfield/privacy">Privacy Policy</a></li>
<li class="nav-terms-of-use"><a href="/greenfield/terms">Terms of Use</a></li>

					<!--
					<li><a href="#pressroom">Press Room</a></li>
					<li><a href="#privacy">Privacy Policy</a></li>
					<li><a href="#terms">Terms of Use</a></li>
					-->
				</ul>
				<ul class="nav nav-right">
					<li><a href="http://www.interactivemechanics.com" target="_blank"><img src="http://brynmawrcollections.org/greenfield/themes/greenfield/images/im_logo.png" width="38" height="34" alt="Interactive Mechanics"></a></li>
					<li><a href="http://brynmawr.edu" target="_blank"><img src="http://brynmawrcollections.org/greenfield/themes/greenfield/images/bmc_logo.png" width="120" height="26" alt="Bryn Mawr College"></a></li>
					<li><a href="http://thealbertmgreenfieldfoundation.org/albertmgreenfield" target="_blank"><img src="http://brynmawrcollections.org/greenfield/themes/greenfield/images/greenfield_logo.png" width="100" height="36" alt="Albert M. Greenfield Foundation"></a></li>
				</ul>
			</div>
		</div>
	</div>

        <div id="footer" class="container">
            <div class="row"><div class="span12"><hr /></div></div>
            <div id="footer-text" class="row">
                <div class="span12"> 
                    <?php echo html_entity_decode(get_theme_option('Footer Text')); ?>
                    
                    <?php if ((get_theme_option('Display Footer Copyright') == 1) && $copyright = settings('copyright')): ?>
                        <div><small><?php echo html_entity_decode($copyright); ?></small></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="span12">
                    <?php plugin_footer(); ?>
                </div>
            </div>
            
        </div><!-- end footer -->
 <!--   </div><!-- end wrap -->
</body>
</html>

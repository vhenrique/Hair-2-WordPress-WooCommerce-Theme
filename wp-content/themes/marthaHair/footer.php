			<?php global $redux_options, $themePrefix; ?>
			<div class="hr-invisible"></div>
            <footer id="footer">
            	<div class="footer-widgets-wrapper">
                	<div class="container">
                    	<div class="column dt-sc-one-third first">
                        	<aside class="widget widget_text">
                            	<h3 class="widgettitle">Contato</h3>
                                <div class="textwidget">
                                    <?php 
                                    if(!empty($redux_options[$themePrefix.'cs_email'])) {
                                        echo '<div class="dt-sc-contact-info"><div class="icon"><i class="fa fa-envelope"></i></div><p><a href="mailto:'.$redux_options[$themePrefix.'cs_email'].'" title="Email to us">sac</a></p></div>';
                                    } 
                                    if(!empty($redux_options[$themePrefix.'cs_telephone'])) {
                                        echo '<div class="dt-sc-contact-info"><div class="icon"><i class="fa fa-phone"></i></div><p title="Call us">'.$redux_options[$themePrefix.'cs_telephone'].'</p></div>';
                                    }
                                    if(!empty($redux_options[$themePrefix.'cs_address']) && !empty($redux_options[$themePrefix.'cs_neightborhood_city_state'])) {
                                        echo '<div class="dt-sc-contact-info address"><p title="We are at here">'.$redux_options[$themePrefix.'cs_address'].'<br>'.$redux_options[$themePrefix.'cs_neightborhood_city_state'].'</p></div>';
                                    } ?>                                   
                                </div>
                            </aside>
                        </div>
                       <div class="column dt-sc-one-third">
                        	<aside class="widget widget_text">
                            	<h3 class="widgettitle">Links</h3>
                                <div class="textwidget">
                                	<?php wp_nav_menu(array('name'=>'main'))?>
                                </div>
                            </aside>
                       </div>
                       <div class="column dt-sc-one-third">
                        	<aside class="widget widget_text">
                            	<h3 class="widgettitle">Siga-nos</h3>
                                <div class="textwidget">
                                    <ul>
                                    <?php
                                    if(!empty($redux_options[$themePrefix.'facebook_url'])){
                                        echo '<li><a href="'.$redux_options[$themePrefix.'facebook_url'].'" target="_BLANK" title="Facebook"> <i class="fa fa-facebook"></i> &nbsp Facebook</a></li>';
                                    }
                                    if(!empty($redux_options[$themePrefix.'instagram_url'])){
                                        echo '<li><a href="'.$redux_options[$themePrefix.'instagram_url'].'" target="_BLANK" title="Instagram"> <i class="fa fa-instagram"></i> &nbsp Instagram</a></li>';
                                    }
                                    if(!empty($redux_options[$themePrefix.'instagram_url'])){
                                        echo '<li><a href="'.$redux_options[$themePrefix.'instagram_url'].'" target="_BLANK" title="Twitter"> <i class="fa fa-twitter"></i> &nbsp Twitter</a></li>';
                                    } ?>
                                    </ul>
                                </div>
                            </aside>
                       </div>         
                    </div>
                </div>
                <div class="hr-invisible"></div>
                <div class="container">
                    <ul class="footer-links">
                        <?php if(!empty($redux_options[$themePrefix.'ft_copright'])){
                            echo '<li><label>© '.$redux_options[$themePrefix.'ft_copright'].'</label></li>';
                        } echo '<li><a href="http://avivatec.com.br" target="_BLANK">Desenvolvido por AVIVATEC Soluções em TI</a></li>'; ?>
                    </ul>
                </div>
                <?php wp_footer(); ?>
            </footer>
            <script type="text/javascript">
                jQuery.noConflict();
                jQuery(document).ready(function(){
                    // Submenu show
                    jQuery(".sub-menu").parent().hover(function(){
                        jQuery(this).find("ul.sub-menu").first().show();
                        jQuery(this).find("a").first().addClass("active");
                        jQuery(this).hover(function(){}, function(){
                            jQuery(this).find("ul.sub-menu").first().hide();
                            jQuery(this).find("a").first().removeClass("active");
                        });
                    });
                });
            </script>
            <script data-cfasync="false" type="text/javascript">
            jQuery(document).ready(function() {
                if(typeof jQuery.fn.layerSlider == "undefined") { lsShowNotice('layerslider_30','jquery'); }
                else {
                jQuery("#layerslider_30").layerSlider({responsiveUnder: 1170, layersContainer: 1170, startInViewport: false, pauseOnHover: false, forceLoopNum: false, autoPlayVideos: false, skinsPath: 'http://wedesignthemes.com/themes/dummy-super/wp-content/plugins/LayerSlider/static/skins/'})
                }
            });
            </script> 
            </div>
		</div>
	</div>
</body>
</html>
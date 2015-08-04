<?php 
    $footer_socials = tfuse_options('footer_socials');
    $footer_menu = tfuse_options('footer_menu');
    $bg = tfuse_options('footer_bg');
?>
<footer class="site-footer" <?php echo (!empty($bg)) ? 'style="background: url(\''.$bg.'\')"' : ''; ?>>
    <div class="container">
        <div class="row">
            <?php echo do_shortcode(tfuse_options('footer_sh'));?>
        
            <div class="col-lg-3 col-lg-offset-1 col-md-4 col-sm-6 col-xs-6">
                <?php if($footer_socials):?>
                    <div class="widget widget-social-links">
                        <h3 class="widget-title"><?php _e('Find us elsewhere','tfuse');?></h3>
                
                    <?php
                       $fb = tfuse_options('facebook');
                       $tw = tfuse_options('twitter');
                       $skype = tfuse_options('skype');
                       $g = tfuse_options('google');
                   ?>
                   <ul class="footer-social">
                       <?php if(!empty($fb)):?>
                           <li><a  href="<?php echo $fb;?>" target="_blank"><i class="icon-facebook"></i></a></li>
                       <?php endif;?>
                        <?php if(!empty($g)):?>
                           <li><a href="<?php echo $g;?>" target="_blank"><i class="icon-google-plus"></i></a></li>
                       <?php endif;?>
                       <?php if(!empty($tw)):?>
                           <li><a href="<?php echo $tw;?>" target="_blank"><i class="icon-twitter"></i></a></li>
                       <?php endif;?>
                       <?php if(!empty($skype)):?>
                           <li><a href="skype:<?php echo $skype;?>?chat"><i class="icon-skype"></i></a></li>
                       <?php endif;?>
                       
                   </ul>
                    </div>
               <?php endif;?>
                
                <!--Copyright-->
                <div class="copyright">
                    <?php echo tfuse_options('footer_copyright');?>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
<?php
    $home = tfuse_is_homepage();
    $cat_ids = tfuse_get_categories_ids();
    $allhome = tfuse_select_all_home();
    $allblog = tfuse_select_all_blog();
?>
<input type="hidden" value="<?php echo $home; ?>" name="homepage"  />
<input type="hidden" value="<?php echo $allhome; ?>" name="allhome"  />
<input type="hidden" value="<?php echo $allblog; ?>" name="allblog"  />
<input type="hidden" value="<?php echo $cat_ids; ?>" name="categories_ids"  />
<?php wp_footer(); ?>
</body>
</html>

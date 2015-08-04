<?php  get_header();?>
<?php $sidebar_position = tfuse_sidebar_position(); ?>
<?php tfuse_shortcode_content('before');?>
<div id="main" class="site-main" role="main">
    <div class="container">
        <div class="row">
            <!--Content Area-->
            <div class="col-sm-12 col-xs-12 content-area">
                <div class="inner">
                    <article>
                        <div class="error-page clearfix">
                            <header class="entry-header">
                                <h1 class="entry-title"><span><?php _e('ooops', 'tfuse') ?>...</span> <?php _e('404 Error', 'tfuse') ?></h1>
                            </header>
                                <div class="entry-content">
                                    <span class="after-title"><?php _e('This page is out of site', 'tfuse') ?></span>
                                    <p><?php _e('You\'ve requested a page - either by typing a URL directly into the address bar or clicking on an out-of-date link and you\'ve found yourself in the middle of nowhere.', 'tfuse') ?></p>
                                    <a href="javascript:history.go(-1)" class="btn btn-yellow btn-error-page"><span><?php _e('Go back to last page', 'tfuse') ?></span></a>
                                </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
<?php tfuse_shortcode_content('after'); ?>
<?php get_footer();
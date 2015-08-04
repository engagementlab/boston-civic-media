<?php get_header(); ?>
<?php  tfuse_shortcode_content('before'); ?>
<?php 
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
    $title = tfuse_options('category_title','',$term->term_id);
?>
<div id="main" class="site-main" role="main">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-xs-12 content-area">
                <div class="inner">
                    <article class="post-events">
                        <header class="entry-header">
                            <h1 class="entry-title"><?php echo (!empty($title)) ? $title : single_term_title(); ?></h1>
                            <?php if(tfuse_options('rss_enable','',$term->term_id)):?>
                                <a href="<?php echo tfuse_options('feedburner_url');?>" class="btn btn-transparent btn-join-us btn-rss-subscribe"><span><?php _e('Subscribe to RSS feed','tfuse');?></span></a>
                            <?php endif;?>
                        </header>
                        <div class="entry-content">
                            <?php if (have_posts()) 
                             { ?>

                                <div class="wrapp_calendar">
                                    <div id="calendar" class="calendar"></div>
                                </div>

                                <div class="calendar-navigation">
                                    <a href="#" class="prev" data-calendar-nav="prev"><span><?php _e('Previous Month', 'tfuse'); ?></span></a>
                                    <h3></h3>
                                    <a href="#" class="next" data-calendar-nav="next"><span><?php _e('Next Month', 'tfuse'); ?></span></a>
                                </div>

                                <!-- Modal Window -->
                                <div class="modal fade" id="events-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body" style="height: 400px"></div>
                                            <button type="button" class="btn" data-dismiss="modal">&times;</button>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Modal Window -->

                           <?php  } 
                             else 
                             { ?>
                                 <h5><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h5>
                       <?php } ?>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="<?php echo $term->term_id; ?>" name="current_event" />
<?php  tfuse_shortcode_content('after'); ?>
<?php get_footer();
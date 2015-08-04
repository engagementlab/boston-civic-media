<div class="widget widget-search">
    <h3 class="widget-title"><?php _e('Search Widget','tfuse');?></h3>
    <form method="get" id="searchform" action="<?php echo home_url( '/' ) ?>">
        <input type="text" value="" placeholder="<?php _e('Search','tfuse');?>" name="s" id="s" />
        <button type="submit" id="searchsubmit" class="btn btn-search"><span><i class="tficon-search"></i></span></button>
    </form>
</div>

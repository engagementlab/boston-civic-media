<?php
class TFuse_Widget_Donate extends WP_Widget {

	function TFuse_Widget_Donate() {
            $widget_ops = array('classname' => 'widget_donate', 'description' => __( "A Donate form for your site","tfuse") );
            $this->WP_Widget('donate', __('TFuse Donate','tfuse'), $widget_ops);
	}

	function widget($args, $instance) { 
            extract($args);
            $title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Search','tfuse' ) : $instance['title'], $instance, $this->id_base);
			$code = empty( $instance['code'] ) ? 'USD' : $instance['code'];
			$amount = empty( $instance['amount'] ) ? 100 : $instance['amount'];
            $sign = empty( $instance['sign'] ) ? '$' : $instance['sign'];
			?>
            <div class="widget widget-make-donation">
                    <h1 class="widget-title"><?php echo $title;?></h1>
                    <span class="total-donate"><sup><?php echo $sign; ?></sup><?php echo $instance['total']; ?></span>
                    <div class="divider"></div>
                    <h3><?php _e('MAKE A DONATION','tfuse');?></h3>
                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                            <label></label>
                            <input type="hidden" name="cmd" value="_donations">
                            <input type="hidden" name="business" value="<?php echo $instance['email']; ?>">
                            <input type="hidden" name="lc" value="US">
                            <input type="hidden" name="item_name" value="">
                            <input type="hidden" name="no_note" value="0">
                            <input type="hidden" name="currency_code" value="<?php echo $code; ?>">
                            <input type="hidden" name="bn" value="PP-DonationsBF:btn_donate_LG.gif:NonHostedGuest">
                            <input type="text" id="amount" name="amount"  placeholder="<?php echo $amount;?>"  value="<?php echo $amount;?>">
                            <button type="submit" class="btn btn-yellow btn-giveby-card" alt="PayPal - The safer, easier way to pay online!"><span><?php _e('Give by','tfuse');?> <i class="icon-credit-card"></i></span></button>
                            <button type="submit" class="btn btn-yellow btn-giveby-paypal" alt="PayPal - The safer, easier way to pay online!"><span><?php _e('Give by','tfuse');?> <i class="tficon-paypal"></i></span></button>
                    </form>
                    <div class="text">
                       <?php echo $instance['desc']; ?>
                    </div>
            </div>
			<style>
				.widget-make-donation form label:before {
					content: '<?php echo $sign; ?>';
				}
				.widget-make-donation form label:after {
					content: '<?php echo $code; ?>';
				}
			</style>

                    <?php
        }

	function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $new_instance = wp_parse_args((array) $new_instance, array( 'title' => '','sign' => '', 'total' => '','desc' => '','email' => '','code' => '','amount' => ''));
            $instance['title'] = $new_instance['title'];
            $instance['total'] = $new_instance['total'];
            $instance['email'] = $new_instance['email'];
			$instance['code'] = $new_instance['code'];
			$instance['amount'] = $new_instance['amount'];
            $instance['desc'] = $new_instance['desc'];
			$instance['sign'] = $new_instance['sign'];
            return $instance;
	}

	function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, array( 'sign' => '','title' => '','total' => '','desc' => '','email' => '','code' => '','amount' => '') );
            $title = $instance['title'];
            $total = $instance['total'];
            $email = $instance['email'];
            $desc = $instance['desc'];
			$code = $instance['code'];
            $amount = $instance['amount'];
			$sign = $instance['sign'];
?>

            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email:','tfuse'); ?> <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo esc_attr($email); ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('total'); ?>"><?php _e('Total Donate:','tfuse'); ?> <input class="widefat" id="<?php echo $this->get_field_id('total'); ?>" name="<?php echo $this->get_field_name('total'); ?>" type="text" value="<?php echo esc_attr($total); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('code'); ?>"><?php _e('Currency code:','tfuse'); ?> <input class="widefat" id="<?php echo $this->get_field_id('code'); ?>" name="<?php echo $this->get_field_name('code'); ?>" type="text" value="<?php echo esc_attr($code); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('sign'); ?>"><?php _e('Currency Sign:','tfuse'); ?> <input class="widefat" id="<?php echo $this->get_field_id('sign'); ?>" name="<?php echo $this->get_field_name('sign'); ?>" type="text" value="<?php echo esc_attr($sign); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('amount'); ?>"><?php _e('Amount:','tfuse'); ?> <input class="widefat" id="<?php echo $this->get_field_id('amount'); ?>" name="<?php echo $this->get_field_name('amount'); ?>" type="text" value="<?php echo esc_attr($amount); ?>" /></label></p>
            
            <label for="<?php echo $this->get_field_id('desc'); ?>"><?php _e('Short Description:','tfuse'); ?></label>
            <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('desc'); ?>" name="<?php echo $this->get_field_name('desc'); ?>"><?php echo $desc; ?></textarea>
<?php
	}
}

register_widget('TFuse_Widget_Donate');

<?php
function tfuse_shortcode_donate($atts, $content = null)
{
    extract(shortcode_atts(array('img' => '', 'title' => '', 'email' => '', 'label' => '', 'code' => '', 'amount' => ''), $atts));
    
    return '<section class="make-donation" style="background: url(\''.$img.'\')">
			<div class="donation-form">
				<h5 class="title">'.$title.':</h5>
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <label for="amount">'.$label.'</label>
                                    <input type="hidden" name="cmd" value="_donations">
                                    <input type="hidden" name="business" value="'.$email.'">
                                    <input type="hidden" name="lc" value="US">
                                    <input type="hidden" name="item_name" value="">
                                    <input type="hidden" name="no_note" value="0">
                                    <input type="hidden" name="currency_code" value="'.$code.'">
                                    <input type="hidden" name="bn" value="PP-DonationsBF:btn_donate_LG.gif:NonHostedGuest">
                                    <input type="text" id="amount" name="amount"  placeholder="'.$amount.'" value="'.$amount.'">

                                    <button type="submit" class="btn btn-yellow btn-donate-form"><span>'.__('Donate Now','tfuse').'</span></button>
                                    <span class="info-donate-form">'.__('Payments handled securely through','tfuse').' <a href="https://www.paypal.com/">PayPal</a></span>
				</form>
			</div>
		</section>';
}

$atts = array(
    'name' => __('Donate','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_donate_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Bg','tfuse'),
            'desc' => __('Background Image','tfuse'),
            'id' => 'tf_shc_donate_img',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Paypal Email','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_donate_email',
            'value' => '',
            'type' => 'text'
        ),
		array(
            'name' => __('Label','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_donate_label',
            'value' => 'USD ($):',
            'type' => 'text'
        ),
		array(
            'name' => __('Currency Code','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_donate_code',
            'value' => 'USD',
            'type' => 'text'
        ),
		array(
            'name' => __('Amount','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_donate_amount',
            'value' => '245',
            'type' => 'text'
        ),
    )
);

tf_add_shortcode('donate', 'tfuse_shortcode_donate', $atts);

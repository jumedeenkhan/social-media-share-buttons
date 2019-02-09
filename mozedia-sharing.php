<?php

/*
Plugin Name: Social Media Share Buttons
Plugin URI: https://www.mozedia.com/
Description: #1 Fast Loading Social Media Sharing Buttons, no need JavaScript and jQuery.
Author: Jumedeen khan
Author URI: https://www.mozedia.com
Version: 1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.txt
Text Domain: social-media-share-buttons
*/

// * Quit files
defined('ABSPATH') || exit;
define('SMSB_PAGE', 'mozedia-social-sharing');

add_filter('the_content', 'add_mozedia_social_sharing_buttons');

function mozedia_smsb_menu() {
    add_submenu_page('options-general.php', 'Social Sharing', 'Social Sharing', 'manage_options', SMSB_PAGE, 'SMSB_PAGE');
}

add_action('admin_menu', 'mozedia_smsb_menu');
add_action('mozedia_smsb_settings_tab', 'mozedia_smsb_welcome_tab', 1);

function mozedia_smsb_welcome_tab() {
    global $smsb_active_tab; ?>
	<a class="nav-tab <?php echo $smsb_active_tab == 'inline' || '' ? 'nav-tab-active' : ''; ?>" href="<?php echo admin_url( 'options-general.php?page=mozedia-social-sharing&tab=inline' ); ?>"><?php _e( 'Inline Sharing', 'mozedia' ); ?> </a>
   <?php
}

add_action('mozedia_settings_content', 'mozedia_smsb_welcome_options_page');

function mozedia_smsb_welcome_options_page() {
    global $smsb_active_tab;
    if ('' || 'inline' != $smsb_active_tab)
        return;
?>
   <div class="mozedia wrap" style="margin:0;background:#fff;padding:10px 20px;border:1px solid #ccc;margin-bottom:20px;max-width:600px;">
         <form method="post" action="options.php">
                <?php
    settings_fields("mozedia_smsb_config_section");
    do_settings_sections("mozedia-social-sharing");
    submit_button();
?>
       </form>
    </div>
     <div>Need help, check this <a href="https://www.mozedia.com/social-media-share-buttons" target="_blank">Guidelines</a> for more details.</div>
    <?php
}

add_action( 'mozedia_smsb_settings_tab', 'mozedia_cos_tab2' );
function mozedia_cos_tab2(){
	global $smsb_active_tab; ?>
	<a class="nav-tab <?php echo $smsb_active_tab == 'floating' ? 'nav-tab-active' : ''; ?>" href="<?php echo admin_url( 'options-general.php?page=mozedia-social-sharing&tab=floating' ); ?>"><?php _e( 'Floating Sharing', 'mozedia' ); ?> </a>
	<?php
}

add_action( 'mozedia_settings_content', 'mozedia_smsb_another_options_page' );

function mozedia_smsb_another_options_page() {
	global $smsb_active_tab;
	if ( 'floating' != $smsb_active_tab )
		return;
	?>
   <div class="mozedia wrap" style="margin:0;background:#fff;padding:10px 20px;border:1px solid #ccc;margin-bottom:20px;max-width:600px;">
         <form method="post" action="options.php">
                <?php
    settings_fields("mozedia_float_config_section");
    do_settings_sections("mozedia-floating-sharing");
    submit_button();
?>
       </form>
    </div>
     <div>Need help, check this <a href="https://www.mozedia.com/social-media-share-buttons" target="_blank">Guidelines</a> for more details.</div>

	<?php
}

function SMSB_PAGE() {
    global $smsb_active_tab;
    $smsb_active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'inline'; ?>
      <h1 style="font-weight: 500;">Social Share Buttons</h1>
		<h2 class="nav-tab-wrapper">
		<?php
			do_action( 'mozedia_smsb_settings_tab' );
		?>
		</h2>

        <?php
    do_action('mozedia_settings_content');
}

function mozedia_smsb_settings() {
    add_settings_section("mozedia_smsb_config_section", "", null, "mozedia-social-sharing");
    add_settings_section("mozedia_float_config_section", "", null, "mozedia-floating-sharing");
    add_settings_field("mozedia-social-sharing-global", "Activate", "mozedia_cos_sharing_global", "mozedia-social-sharing", "mozedia_smsb_config_section");
    add_settings_field("mozedia-social-sharing-title", "Share Title", "mozedia_cos_sharing_title", "mozedia-social-sharing", "mozedia_smsb_config_section");
    add_settings_field("mozedia-social-sharing-facebook", "Choose Icons", "mozedia_cos_sharing_post_page_options", "mozedia-social-sharing", "mozedia_smsb_config_section");
    add_settings_field("mozedia-social-sharing-twitter", "Twitter Username", "mozedia_cos_sharing_twitter", "mozedia-social-sharing", "mozedia_smsb_config_section");
    add_settings_field("mozedia-social-sharing-nofollow", "Add Nofollow", "mozedia_cos_sharing_nofollow", "mozedia-social-sharing", "mozedia_smsb_config_section");
    add_settings_field("mozedia-social-sharing-floating", "Activate", "mozedia_cos_sharing_float_global", "mozedia-floating-sharing", "mozedia_float_config_section");
    add_settings_field("mozedia-social-sharing-float-facebook", "Choose Icons", "mozedia_cos_sharing_float_options", "mozedia-floating-sharing", "mozedia_float_config_section");
    add_settings_field("mozedia-social-sharing-top-padding", "Top padding", "mozedia_cos_top_padding", "mozedia-floating-sharing", "mozedia_float_config_section");
    add_settings_field("mozedia-social-sharing-mobile-hide", "Hide on Mobile", "mozedia_cos_mobile_hide", "mozedia-floating-sharing", "mozedia_float_config_section");
	
    register_setting("mozedia_smsb_config_section", "mozedia-social-sharing-facebook");
    register_setting("mozedia_smsb_config_section", "mozedia-social-sharing-twitter");
	register_setting("mozedia_smsb_config_section", "mozedia-social-sharing-twitter-name");
    register_setting("mozedia_smsb_config_section", "mozedia-social-sharing-googleplus");
    register_setting("mozedia_smsb_config_section", "mozedia-social-sharing-pinterest");
    register_setting("mozedia_smsb_config_section", "mozedia-social-sharing-linkedin");
    register_setting("mozedia_smsb_config_section", "mozedia-social-sharing-whatsapp");
    register_setting("mozedia_smsb_config_section", "mozedia-social-sharing-rel-nofollow");
    register_setting("mozedia_smsb_config_section", "mozedia-social-sharing-custom-label");
    register_setting("mozedia_smsb_config_section", "mozedia-social-sharing-email");
    register_setting("mozedia_smsb_config_section", "mozedia-social-sharing-post-page-global");
	
    register_setting("mozedia_float_config_section", "mozedia-social-sharing-float-facebook");
    register_setting("mozedia_float_config_section", "mozedia-social-sharing-float-twitter");
    register_setting("mozedia_float_config_section", "mozedia-social-sharing-float-googleplus");
    register_setting("mozedia_float_config_section", "mozedia-social-sharing-float-pinterest");
    register_setting("mozedia_float_config_section", "mozedia-social-sharing-float-linkedin");
    register_setting("mozedia_float_config_section", "mozedia-social-sharing-float-whatsapp");
    register_setting("mozedia_float_config_section", "mozedia-social-sharing-float-email");
    register_setting("mozedia_float_config_section", "mozedia-social-sharing-top-padding");
    register_setting("mozedia_float_config_section", "mozedia-social-sharing-mobile-hide");
    register_setting("mozedia_float_config_section", "mozedia-social-sharing-float-global");
}

function mozedia_cos_sharing_global() {
?>
      <div class="postbox" style="padding: 15px;">
                <input type="checkbox" name="mozedia-social-sharing-post-page-global" value="1" <?php
    checked(1, get_option('mozedia-social-sharing-post-page-global'), true);
?> /> Enable (display share button on Post/Page)
            <?php
}

function mozedia_cos_sharing_float_global() {
?>
      <div class="postbox" style="padding: 15px;">
                <input type="checkbox" name="mozedia-social-sharing-float-global" value="1" <?php
    checked(1, get_option('mozedia-social-sharing-float-global'), true);
?> /> Enable (display share button in left side)
            <?php
}

function mozedia_cos_sharing_title() {
?>
      <div class="postbox" style="padding: 15px;">
                <input type="text" name="mozedia-social-sharing-custom-label" value="<?php
    echo esc_attr(get_option('mozedia-social-sharing-custom-label'));
?>" /> (Eg: Share this post.)
            </div>
            <?php
}

function mozedia_cos_sharing_post_page_options() {
?>
  <div class="postbox" style="padding: 30px;">
        <input type="checkbox" name="mozedia-social-sharing-facebook" value="1" <?php
    checked(1, get_option('mozedia-social-sharing-facebook'), true);
?> /> Facebook
        <br /><br /><input type="checkbox" name="mozedia-social-sharing-twitter" value="1" <?php
    checked(1, get_option('mozedia-social-sharing-twitter'), true);
?> /> Twitter
        <br /><br /><input type="checkbox" name="mozedia-social-sharing-googleplus" value="1" <?php
    checked(1, get_option('mozedia-social-sharing-googleplus'), true);
?> /> Google+
        <br /><br /><input type="checkbox" name="mozedia-social-sharing-pinterest" value="1" <?php
    checked(1, get_option('mozedia-social-sharing-pinterest'), true);
?> /> Pinterest
        <br /><br /><input type="checkbox" name="mozedia-social-sharing-linkedin" value="1" <?php
    checked(1, get_option('mozedia-social-sharing-linkedin'), true);
?> /> Linkedin
        <br /><br /><input type="checkbox" name="mozedia-social-sharing-email" value="1" <?php
    checked(1, get_option('mozedia-social-sharing-email'), true);
?> /> Email
        <br /><br /><input type="checkbox" name="mozedia-social-sharing-whatsapp" value="1" <?php
    checked(1, get_option('mozedia-social-sharing-whatsapp'), true);
?> /> WhatsApp

    </div>
   <?php
}

function mozedia_cos_sharing_float_options() {
?>
  <div class="postbox" style="padding: 30px;">
        <input type="checkbox" name="mozedia-social-sharing-float-facebook" value="1" <?php
    checked(1, get_option('mozedia-social-sharing-float-facebook'), true);
?> /> Facebook
        <br /><br /><input type="checkbox" name="mozedia-social-sharing-float-twitter" value="1" <?php
    checked(1, get_option('mozedia-social-sharing-float-twitter'), true);
?> /> Twitter
        <br /><br /><input type="checkbox" name="mozedia-social-sharing-float-googleplus" value="1" <?php
    checked(1, get_option('mozedia-social-sharing-float-googleplus'), true);
?> /> Google+
        <br /><br /><input type="checkbox" name="mozedia-social-sharing-float-pinterest" value="1" <?php
    checked(1, get_option('mozedia-social-sharing-float-pinterest'), true);
?> /> Pinterest
        <br /><br /><input type="checkbox" name="mozedia-social-sharing-float-linkedin" value="1" <?php
    checked(1, get_option('mozedia-social-sharing-float-linkedin'), true);
?> /> Linkedin
        <br /><br /><input type="checkbox" name="mozedia-social-sharing-float-email" value="1" <?php
    checked(1, get_option('mozedia-social-sharing-float-email'), true);
?> /> Email
        <br /><br /><input type="checkbox" name="mozedia-social-sharing-float-whatsapp" value="1" <?php
    checked(1, get_option('mozedia-social-sharing-float-whatsapp'), true);
?> /> WhatsApp

    </div>
   <?php
}

function mozedia_cos_sharing_twitter() {
?>
      <div class="postbox" style="padding: 15px;">
                 <input type="text" name="mozedia-social-sharing-twitter-name" value="<?php
    echo esc_attr(get_option('mozedia-social-sharing-twitter-name'));
?>" /> (without @)
            </div>
            <?php
}

function mozedia_cos_sharing_nofollow() {
?>
      <div class="postbox" style="padding: 15px;">
                 <input type="checkbox" name="mozedia-social-sharing-rel-nofollow" value="1" <?php
    checked(1, get_option('mozedia-social-sharing-rel-nofollow'), true);
?> /> add rel="nofollow" to all links
            </div>
            <?php
}

function mozedia_cos_top_padding() {
?>
      <div class="postbox" style="padding: 15px;">
                <input type="text" style="width:50px;" name="mozedia-social-sharing-top-padding" value="<?php
    echo esc_attr(get_option('mozedia-social-sharing-top-padding'));
?>" /> Set padding from top (Eg: 150-200)
            </div>
            <?php
}

function mozedia_cos_mobile_hide() {
?>
      <div class="postbox" style="padding: 15px;">
                <input type="text" style="width:50px;" name="mozedia-social-sharing-mobile-hide" value="<?php
    echo esc_attr(get_option('mozedia-social-sharing-mobile-hide'));
?>" /> (Recommended: 1200.)
            </div>
            <?php
}

add_action("admin_init", "mozedia_smsb_settings");

function add_mozedia_social_sharing_buttons($content) {
    
    // Get current page URL
    
    $mozediaURL = get_permalink();
    
    // Get current page title
    
    $mozediaTitle = str_replace(' ', '%20', get_the_title());
    
    // Get Post Thumbnail for pinterest
    
    $mozediaThumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
		
	// Open link in Popup
	$openpopup ='window.open(this.href,\'\', \'left=20,top=20,width=550,height=320\');return false;';
    
    // Twitter username
    $twitterUserName = get_option("mozedia-social-sharing-twitter-name");
    if (!empty($twitterUserName)) {
        $twitterURL .= '&amp;via=' . $twitterUserName;
    }
	
    // Social share button URLs
    $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u=' . $mozediaURL;
    $twitterURL      = 'https://twitter.com/intent/tweet?text=' . $mozediaTitle . '&amp;url=' . $mozediaURL;
    $googleURL   = 'https://plus.google.com/share?url=' . $mozediaURL;
    $linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $mozediaURL . '&amp;title=' . $mozediaTitle;
    $pinterestURL = 'https://pinterest.com/pin/create/button/?url=' . $mozediaURL . '&amp;media=' . $mozediaThumbnail[0] . '&amp;description=' . $mozediaTitle;
    $emailURL     = 'mailto:?subject=' . $mozediaTitle . '&amp;body= ' . $mozediaURL . '" title="Share by Email';
    $whatsappURL = 'https://api.whatsapp.com/send?text=' . $mozediaTitle . ' ' . $mozediaURL;
    
    // Nofollow tags
    if (get_option("mozedia-social-sharing-rel-nofollow") == 1) {
        $rel_nofollow = 'rel="nofollow"';
    } else {
        $rel_nofollow = '';
    }
    if (!is_singular()) {
        return;
    }
    
    if (get_option("mozedia-social-sharing-post-page-global") == 1) {
        
        // Add share button at the end of page/page content
        
        $content .= '<div class="social-share inline">';
        $content .= '<h6 class="title">' . get_option("mozedia-social-sharing-custom-label") . '</h6><ul class="share-list">';
        if (get_option("mozedia-social-sharing-facebook") == 1) {
            $content .= '<li class="icon facebook"><a ' . $rel_nofollow . ' href="' . $facebookURL . '" onclick="'.$openpopup.'" target="_blank"><i class="fa fa-facebook"></i><span>Facebook</span></a></li>';
        }
        
        if (get_option("mozedia-social-sharing-twitter") == 1) {
            $content .= '<li class="icon twitter"><a ' . $rel_nofollow . ' href="' . $twitterURL . '" onclick="'.$openpopup.'" target="_blank"><i class="fa fa-twitter"></i><span>Twitter</span></a></li>';
        }
        
        if (get_option("mozedia-social-sharing-googleplus") == 1) {
            $content .= '<li class="icon googleplus"><a ' . $rel_nofollow . ' href="' . $googleURL . '" onclick="'.$openpopup.'" target="_blank"><i class="fa fa-google-plus"></i><span>Google+</span></a></li>';
        }
        
        if (get_option("mozedia-social-sharing-pinterest") == 1) {
            $content .= '<li class="icon pinterest"><a ' . $rel_nofollow . ' href="' . $pinterestURL . '" onclick="'.$openpopup.'" target="_blank"><i class="fa fa-pinterest-p"></i><span>Pinterest</span></a></li>';
        }
        
        if (get_option("mozedia-social-sharing-linkedin") == 1) {
            $content .= '<li class="icon linkedin"><a ' . $rel_nofollow . ' href="' . $linkedInURL . '" onclick="'.$openpopup.'" target="_blank"><i class="fa fa-linkedin"></i><span>Linkedin</span></a></li>';
        }
        
        if (get_option("mozedia-social-sharing-email") == 1) {
            $content .= '<li class="icon email"><a ' . $rel_nofollow . ' href="' . $emailURL . '"><i class="fa fa-envelope-o"></i><span>Email</span></a></li>';
        }
        
        if (get_option("mozedia-social-sharing-whatsapp") == 1) {
            $content .= '<li class="icon whatsapp"><a ' . $rel_nofollow . ' href="' . $whatsappURL . '" onclick="'.$openpopup.'" target="_blank"><i class="fa fa-whatsapp"></i><span>WhatsApp</span></a></li>';
        }
        
        $content .= '</ul></div>';
    }
    
    if (get_option("mozedia-social-sharing-float-global") == 1) {
        
        // Add share buttons in left side of content
        
        $content .= '<div class="social-share flt"><div class="flt-bar"><input type="checkbox" id="foggle"><div class="flt-bar-button"><ul class="float-list">';
        if (get_option("mozedia-social-sharing-float-facebook") == 1) {
            $content .= '<li class="icon facebook"><a ' . $rel_nofollow . ' href="' . $facebookURL . '" onclick="'.$openpopup.'" target="_blank"><i class="fa fa-facebook"></i><span>Facebook</span></a></li>';
        }
        
        if (get_option("mozedia-social-sharing-float-twitter") == 1) {
            $content .= '<li class="icon twitter"><a ' . $rel_nofollow . ' href="' . $twitterURL . '" onclick="'.$openpopup.'" target="_blank"><i class="fa fa-twitter"></i><span>Twitter</span></a></li>';
        }
        
        if (get_option("mozedia-social-sharing-float-googleplus") == 1) {
            $content .= '<li class="icon googleplus"><a ' . $rel_nofollow . ' href="' . $googleURL . '" onclick="'.$openpopup.'" target="_blank"><i class="fa fa-google-plus"></i><span>Google+</span></a></li>';
        }
        
        if (get_option("mozedia-social-sharing-float-pinterest") == 1) {
            $content .= '<li class="icon pinterest"><a ' . $rel_nofollow . ' href="' . $pinterestURL . '" onclick="'.$openpopup.'" target="_blank"><i class="fa fa-pinterest-p"></i><span>Pinterest</span></a></li>';
        }
        
        if (get_option("mozedia-social-sharing-float-linkedin") == 1) {
            $content .= '<li class="icon linkedin"><a ' . $rel_nofollow . ' href="' . $linkedInURL . '" onclick="'.$openpopup.'" target="_blank"><i class="fa fa-linkedin"></i><span>Linkedin</span></a></li>';
        }
        
        if (get_option("mozedia-social-sharing-float-email") == 1) {
            $content .= '<li class="icon email"><a ' . $rel_nofollow . ' href="' . $emailURL . '"><i class="fa fa-envelope-o"></i><span>Email</span></a></li>';
        }
        
        if (get_option("mozedia-social-sharing-float-whatsapp") == 1) {
            $content .= '<li class="icon whatsapp"><a ' . $rel_nofollow . ' href="' . $whatsappURL . '" onclick="'.$openpopup.'" target="_blank"><i class="fa fa-whatsapp"></i><span>WhatsApp</span></a></li>';
        }
        
        $content .= '</ul><label for="foggle" class="foggle"></label></div></div></div>';
    }
    
    return $content;
};

function admin_register_head() {
    $siteurl = get_option('siteurl');
    echo "<style>.nav-tab-active,.nav-tab-active:focus,.nav-tab-active:focus:active,.nav-tab-active:hover{background:#fff;border-bottom:1px solid #fff}.form-table th{width:120px;padding:10px}.mozedia .form-table td{padding:0}.nav-tab-wrapper,.postbox{border:0;box-shadow:none}</style>";
}

add_action('admin_head', 'admin_register_head');

function mozedia_smsb_header() {
		$top_padding = get_option("mozedia-social-sharing-top-padding");
		$mobile_hide = get_option("mozedia-social-sharing-mobile-hide");
    wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    echo '<style>.icon span,.social-share .icon,.social-share .icon a,.social-share .icon a:hover,.social-share a{text-decoration:none}.social-share .share-list{display:table;width:100%;border-spacing:5px}.social-share.flt{float:left;position:fixed;top:' . $top_padding . 'px;left:5px}.social-share.flt .icon{display:block}.social-share.flt .icon a,.social-share.flt .icon a:hover{line-height:1.7;padding:10px;text-align:center}.social-share.flt .icon:hover span{display:inline}.social-share .title{display:block;margin:0 10px 0 0;color:rgba(0,0,0,.6);font-size:15px;font-weight:600;line-height:30px}.social-share .icon:hover span{left:0;display:inline}.social-share .icon{color:#fff;padding:0;width:55px;height:auto;margin:2px;cursor:pointer;text-align:center;display:inline-block;transition:.3s;vertical-align:middle;overflow:hidden;white-space:nowrap}.social-share .icon:hover{background:#555;transition:.3s}.social-share .share-list .icon{display:table-cell;width:100px;transition:.3s}.social-share .share-list .icon:hover{width:150px;transition:.3s}.social-share ul{margin:0;padding:0}.social-share .fa{display:inline-block;font-family:fontawesome;text-rendering:auto;font-size:14px}.icon span{margin-left:10px;font-size:14px}.social-share .icon.facebook{background:#6788ce}.social-share .icon.twitter{background:#29c5f6}.social-share .icon.googleplus{background:#f16321}.social-share .icon.linkedin{background:#0d77b7}.social-share .icon.whatsapp{background:#25d366}.social-share .icon.pinterest{background:#cd2029}.social-share .icon.email{background:#0098f8}.social-share .icon .ts,.social-share .icon:hover .td{display:none}.social-share .icon .td,.social-share .icon:hover .ts{display:inline}.social-share .icon a{display:block;line-height:1.5;font-size:15px;padding:5px 10px;color:#fff}.social-share .icon span,.social-share p:empty,.social-share ul>li:before{display:none}.social-share.flt .icon{width:60px}.social-share.flt .icon:hover{width:100px;transition:.3s}.social-share .icon svg{width:20px;vertical-align:top;margin-top:-2px}.social-sharer #foggle{position:absolute}.social-share .flt-bar #foggle,.social-share .flt-bar #foggle:checked+div .float-list,.social-share .flt-bar .float-list{opacity:0;transition:.3s}.social-share .flt-bar #foggle:checked+div .float-list{transform:translateX(-150%);-webkit-transform:translateX(-150%);-ms-transform:translateX(-150%)}.social-share .flt-bar .foggle:after{display:inline;content:"\f104";font-family:fontawesome}.social-share .flt-bar #foggle:checked+div .foggle:after{content:"\f105"}.foggle,.social-share .flt-bar .float-list{opacity:1;transition:.3s}.social-share .flt-bar .foggle{color:#333;display:inline;line-height:1;margin:5px 15px;left:5px;padding:2px 15px 4px;cursor:pointer;font-family:icons;user-select:none;opacity:0;border-radius:100px}.social-share .flt-bar #foggle:checked+div .foggle,.social-share .flt-bar .foggle:hover{background:#777;color:#fff;opacity:1}.social-share:hover .flt-bar .foggle{opacity:1}@media only screen and (max-width:' . $mobile_hide . 'px){.social-share.flt{display:none}.social-share .title{text-align:center}}</style>';
}

add_action('wp_head', 'mozedia_smsb_header', 100);

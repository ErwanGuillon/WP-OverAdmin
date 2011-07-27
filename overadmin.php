<?php
/*
Plugin Name: Over Admin
Plugin URI: http://erwan.guillon.me
Description: Allow  you some aditionnal stuff in WP admin interface
Version: 0.1
Author: Erwan Guillon
Author URI: http://erwan.guillon.me
*/

class OverAdmin
{
    private static $options = array(
                            'oa_top_bar' => '',
                            'oa_wp_generator' => '',
                            'oa_rsd' => '',
                            'oa_wlwmanifest' => '',
                            'oa_index' => 1,
                            'oa_rss' => 1,
                            'oa_rss_comments' => 1,
                            'oa_start' => '',
                            'oa_parent' => '',
                            'oa_from_email' => '',
                            'oa_email_email' => '',
                            'oa_update_notification' => ''
                            );
    
    static function install()
    {
        foreach(self::$options as $o => $val)
        {
            if(!get_option($o))
            {
                add_option($o, $val);
            }
        }
    }
    
    static function options_page()
    {
        if (!current_user_can('manage_options')) 
        {
            wp_die( __('You do not have sufficient permissions to access this page.') );
        }
        
        if(isset($_POST['Submit']))
        {
            foreach(self::$options as $o => $val)
            {
                if(isset($_POST[$o])) $new_val = $_POST[$o];
                else $new_val = '';
                update_option($o, $new_val);
            }
        }
        
        foreach(self::$options as $o => $val)
        {
            ${$o} = get_option($o);
        }
        ?>
        <div class="wrap oa">
            <h2>OverAdmin</h2>

            <form name="overadmin" method="post" action="">
                <div id="tab-wraps">
                    <p class="submit">
                        <input type="submit" name="Submit" class="button-primary" value="<?php _e('Save'); ?>" />
                    </p>
                    <ul class="tabs">
                        <li><a href="#header-links">Header links</a></li>
                        <li><a href="#mail">Mail</a></li>
                    </ul>
                    <div id="header-links" class="panel">
                        <table>
                            <tr>
                                <th>
                                    <label for="oa_top_bar">Remove Top bar when logged in</label>
                                </th>
                                <td>
                                    <input type="checkbox" name="oa_top_bar" id="oa_top_bar" value="1" <?php if($oa_top_bar == '1') echo 'checked'; ?>/>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <label for="oa_wp_generator">Remove WP version in head</label>
                                </th>
                                <td>
                                    <input type="checkbox" name="oa_wp_generator" id="oa_wp_generator" value="1" <?php if($oa_wp_generator == '1') echo 'checked'; ?>/>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <label for="oa_rsd">Remove rsd link in head</label>
                                </th>
                                <td>
                                    <input type="checkbox" name="oa_rsd" id="oa_rsd" value="1" <?php if($oa_rsd == '1') echo 'checked'; ?>/>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <label for="oa_wlwmanifest">Remove wlwmanifest link in head</label>
                                </th>
                                <td>
                                    <input type="checkbox" name="oa_wlwmanifest" id="oa_wlwmanifest" value="1" <?php if($oa_wlwmanifest == '1') echo 'checked'; ?>/>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <label for="oa_index">Remove index link in head</label>
                                </th>
                                <td>
                                    <input type="checkbox" name="oa_index" id="oa_index" value="1" <?php if($oa_index == '1') echo 'checked'; ?>/>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <label for="oa_rss">Remove RSS link in head</label>
                                </th>
                                <td>
                                    <input type="checkbox" name="oa_rss" id="oa_rss" value="1" <?php if($oa_rss == '1') echo 'checked'; ?>/>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <label for="oa_rss_comments">Remove RSS for comments link in head</label>
                                </th>
                                <td>
                                    <input type="checkbox" name="oa_rss_comments" id="oa_rss_comments" value="1" <?php if($oa_rss_comments == '1') echo 'checked'; ?>/>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <label for="oa_start">Remove start/prev/next link in head</label>
                                </th>
                                <td>
                                    <input type="checkbox" name="oa_start" id="oa_start" value="1" <?php if($oa_start == '1') echo 'checked'; ?>/>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <label for="oa_parent">Remove parent page link in head</label>
                                </th>
                                <td>
                                    <input type="checkbox" name="oa_parent" id="oa_parent" value="1" <?php if($oa_parent == '1') echo 'checked'; ?>/>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <label for="oa_update_notification">Remove Update notification in admin</label>
                                </th>
                                <td>
                                    <input type="checkbox" name="oa_update_notification" id="oa_update_notification" value="1" <?php if($oa_update_notification == '1') echo 'checked'; ?>/>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="mail" class="panel">
                        <table>
                            <tr>
                                <th><label for="oa_from_email">From</label></th>
                                <td><input type="text" name="oa_from_email" id="oa_from_email" value="<?php echo $oa_from_email; ?>"/></td>
                            </tr>
                            <tr>
                                <th><label for="oa_email_email">Email</label></th>
                                <td><input type="text" name="oa_email_email" id="oa_email_email" value="<?php echo $oa_email_email; ?>"/></td>
                            </tr>
                        </table>
                    </div>
                    <p class="submit">
                        <input type="submit" name="Submit" class="button-primary" value="<?php _e('Save'); ?>" />
                    </p>
                </div>
            </form>
        </div>
                <script type="text/javascript"> 
	jQuery(function() {
	    // Tabs
		jQuery('ul.tabs').show();
		jQuery('ul.tabs li:first').addClass('active');
		jQuery('div.panel:not(div.panel:first)').hide();
		jQuery('ul.tabs a').click(function(){
			jQuery('ul.tabs li').removeClass('active');
			jQuery(this).parent().addClass('active');
			jQuery('div.panel').hide();
			jQuery( jQuery(this).attr('href') ).show();
 
			return false;
		});
		
	});
	</script>
        <?php
    }
    
    static function menu()
    {
        add_management_page('OverAdmin', 'OverAdmin', 'manage_options', 'overadmin', array('OverAdmin', 'options_page'));
    }
    
    static function css()
    {
        echo '<link rel="stylesheet" type="text/css" href="' . WP_PLUGIN_URL . "/" . plugin_basename( dirname(__FILE__)) . '/assets/oa.css" />';
    }

    static function run()
    {
        foreach(self::$options as $o => $val)
        {
            if(get_option($o) != '')
            {
                switch($o)
                {
                    case 'oa_top_bar' : add_filter( 'show_admin_bar', '__return_false' );
                        break;
                    
                    case 'oa_wp_generator' : remove_action( 'wp_head', 'wp_generator' );
                        break;
                    
                    case 'oa_rsd' : remove_action( 'wp_head', 'rsd_link' );
                        break;
                    
                    case 'oa_wlwmanifest' : remove_action( 'wp_head', 'wlwmanifest_link' );
                        break;
                    
                    case 'oa_index' : remove_action( 'wp_head', 'index_rel_link' );
                        break;
                    
                    case 'oa_rss' : remove_action( 'wp_head', 'feed_links', 2 );
                        break;
                    
                    // TODO : Remove link to comment RSS not only comment on specifiq post
                    case 'oa_rss_comments' : remove_action( 'wp_head', 'feed_links_extra', 3 );
                        break;
                    
                    case 'oa_start' : remove_action( 'wp_head', 'start_post_rel_link');
                        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
                        break;
                    
                    case 'oa_parent' : remove_action( 'wp_head', 'parent_post_rel_link');
                        break;
                    
                    case 'oa_from_email' : add_filter('wp_mail_from_name',function($name){ return get_option('oa_from_email'); });
                        break;
                    
                    case 'oa_email_email' : add_filter('wp_mail_from',function($name){ return get_option('oa_email_email'); });
                        break;
                    
                    case 'oa_update_notification' : add_filter( 'pre_site_transient_update_core', function($a){return null;} );
                        break;
                    
                    default : break;
                }
            }
        }
    }
    
    static function uninstall()
    {
        foreach(self::$options as $o => $val)
        {
            if(!get_option($o))
            {
                delete_option($o);
            }
        }
    }
}

register_activation_hook(__FILE__, array('OverAdmin', 'install'));
add_action('admin_menu', array('OverAdmin', 'menu'));
add_action('admin_print_styles', array('OverAdmin', 'css'), 31);

OverAdmin::run();

register_uninstall_hook(__FILE__, array('OverAdmin', 'uninstall'));
<?php

/*
Plugin Name: Eazy Policy &amp; Cookies Pages GDR Compliant
Plugin URI: http://www.eazythemes.com
Description: Create page for Cookies e Privacy for GDPR
Version: 2.2
Author: Alessandro Alessio
Author URI: http://www.a2area.it
*/

/**
 * Admin Page Options Register
 */
add_action( 'admin_menu', 'eazy_legal_opt_page' );
function eazy_legal_opt_page() {
    // Create top level menu
	add_menu_page( 'Privacy & Cookies', 'Privacy & Cookies', 'manage_options', 'eazy_legal_options', 'eazy_legal_display_opt_page', 'dashicons-visibility', 100  );
    // Call register settings function
    add_action( 'admin_init', 'eazy_legal_register_options_settings' );
}

/**
 * Register Settings
 *
 * @return void
 */
function eazy_legal_register_options_settings() {
	register_setting( 'eazy-legal-settings-group', 'eazy_company_name' );
	register_setting( 'eazy-legal-settings-group', 'eazy_company_headquarters' );
    register_setting( 'eazy-legal-settings-group', 'eazy_company_address' );
    register_setting( 'eazy-legal-settings-group', 'eazy_company_phone' );
    register_setting( 'eazy-legal-settings-group', 'eazy_company_email' );
    register_setting( 'eazy-legal-settings-group', 'eazy_company_responsible' );
    register_setting( 'eazy-legal-settings-group', 'eazy_company_start_date' );

    register_setting( 'eazy-legal-settings-group', 'eazy_company_data_stat' );
    register_setting( 'eazy-legal-settings-group', 'eazy_company_data_cf' );
    register_setting( 'eazy-legal-settings-group', 'eazy_company_data_nl' );
    register_setting( 'eazy-legal-settings-group', 'eazy_company_data_contracts' );
    register_setting( 'eazy-legal-settings-group', 'eazy_company_data_ux' );
    register_setting( 'eazy-legal-settings-group', 'eazy_company_data_third' );

    register_setting( 'eazy-legal-settings-group', 'eazy_company_start_date_cookie');
    register_setting( 'eazy-legal-settings-group', 'eazy_company_cookie_tech');
    register_setting( 'eazy-legal-settings-group', 'eazy_company_cookie_analytics');
    register_setting( 'eazy-legal-settings-group', 'eazy_company_cookie_aggregated');
    register_setting( 'eazy-legal-settings-group', 'eazy_company_cookie_third_party');
    register_setting( 'eazy-legal-settings-group', 'eazy_company_cookie_maps');
    register_setting( 'eazy-legal-settings-group', 'eazy_company_cookie_social');
    register_setting( 'eazy-legal-settings-group', 'eazy_company_cookie_list');

    register_setting( 'eazy-legal-settings-group', 'eazy_gtm_code');
}

/**
 * Cookie List Default Value
 */
$eazy_cookie_list_default = [
    'google_analytics' => 'Google Analytics',
    'google_adsense' => 'Google ADS/Adsense',
    'google_tag_manager' => 'Google Tag Manager',
    'google_web_fonts' => 'Google Web Fonts',
    'google_maps' => 'Google Maps',
    'facebook_pixel' => 'Meta/Facebook Pixel',
    'youtube' => 'YouTube',
    'twitter' => 'Twitter',
    'hotjar' => 'Hotjar',
    'vimeo' => 'Vimeo',
];
$eazy_cookie_list_default_string = '';
foreach ( $eazy_cookie_list_default as $key => $value ) :
    $eazy_cookie_list_default_string .= ' - '.$value. "\n";
endforeach;

/**
 * Check if pages exist
 *
 * @param string $page_slug
 * @return void
 */
function eazy_check_page_exists($page_slug) {
    $page = get_page_by_path( $page_slug , OBJECT );

    if ( isset($page) ) :
        return true;
    else:
        return false;
    endif;
}

/**
 * Display Options Page
 *
 * @return void
 */
function eazy_legal_display_opt_page(){
    global $eazy_cookie_list_default_string;
    ?>
    <div class="wrap">
        <form method="post" action="options.php">
            <h2><?php _e('Options for Privacy &amp; Cookies', 'eazylegal'); ?></h2>
            <p><?php _e('Configure the below field and then user the following shortcode to put inside your pages', 'eazylegal') ?></p>
            <p>
                Use <code>[eazylegalprivacy][/eazylegalprivacy]</code> for Privacy Page (URL must be yourdomain.com/privacy/).<br>
                Use <code>[eazylegalcookie][/eazylegalcookie]</code> for Cookie Page (URL must be yourdomain.com/cookie/).
            </p>

            <?php settings_fields( 'eazy-legal-settings-group' ); ?>
            <?php do_settings_sections( 'eazy-legal-settings-group' ); ?>
            <table>
                <tr>
                    <td><label for="eazy_company_name"><?php _e('Company Name', 'eazylegal') ?> :</label></td>
                    <td><input type="text" value="<?php echo esc_attr( get_option('eazy_company_name') ); ?>" name="eazy_company_name" placeholder="<?php _e('Company Name', 'eazylegal') ?>"></td>
                </tr>
                <tr>
                    <td><label for="eazy_company_headquarters"><?php _e('Company Headquarters', 'eazylegal') ?> :</label></td>
                    <td><input type="text" value="<?php echo esc_attr( get_option('eazy_company_headquarters') ); ?>" name="eazy_company_headquarters" placeholder="<?php _e('Company Headquarters', 'eazylegal') ?>"></td>
                </tr>
                <tr>
                    <td><label for="eazy_company_address"><?php _e('Company Address', 'eazylegal') ?> :</label></td>
                    <td><input type="text" value="<?php echo esc_attr( get_option('eazy_company_address') ); ?>" name="eazy_company_address" placeholder="<?php _e('Company Address', 'eazylegal') ?>"></td>
                </tr>
                <tr>
                    <td><label for="eazy_company_phone"><?php _e('Company Phone', 'eazylegal') ?> :</label></td>
                    <td><input type="text" value="<?php echo esc_attr( get_option('eazy_company_phone') ); ?>" name="eazy_company_phone" placeholder="<?php _e('Company Phone', 'eazylegal') ?>"></td>
                </tr>
                <tr>
                    <td><label for="eazy_company_email"><?php _e('Company Email', 'eazylegal') ?> :</label></td>
                    <td><input type="text" value="<?php echo esc_attr( get_option('eazy_company_email') ); ?>" name="eazy_company_email" placeholder="<?php _e('Company Email', 'eazylegal') ?>"></td>
                </tr>
                <tr>
                    <td><label for="eazy_company_responsible"><?php _e('Responsible for data processing', 'eazylegal') ?> :</label></td>
                    <td><input type="text" value="<?php echo esc_attr( get_option('eazy_company_responsible') ); ?>" name="eazy_company_responsible" placeholder="<?php _e('Responsible for data processing', 'eazylegal') ?>"></td>
                </tr>            
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td><label for="eazy_company_start_date"><?php _e('Start date for Privacy Policy', 'eazylegal') ?> :</label></td>
                    <td><input type="text" value="<?php echo esc_attr( get_option('eazy_company_start_date') ); ?>" name="eazy_company_start_date" placeholder="DD/MM/YYYY"></td>
                </tr> 
                <tr>
                    <td><label for="eazy_company_data_stat"><?php _e('This site get statistics data from users', 'eazylegal') ?> :</label></td>
                    <td><input type="checkbox" value="on" <?php if ( get_option('eazy_company_data_stat')=='on' ) echo 'checked="checked"'; ?> name="eazy_company_data_stat"></td>
                </tr>
                <tr>
                    <td><label for="eazy_company_data_cf"><?php _e('This site use a contact form', 'eazylegal') ?> :</label></td>
                    <td><input type="checkbox" value="on" <?php if ( get_option('eazy_company_data_cf')=='on' ) echo 'checked="checked"'; ?> name="eazy_company_data_cf"></td>
                </tr>
                <tr>
                    <td><label for="eazy_company_data_nl"><?php _e('This site have a newsletter subscription', 'eazylegal') ?> :</label></td>
                    <td><input type="checkbox" value="on" <?php if ( get_option('eazy_company_data_nl')=='on' ) echo 'checked="checked"'; ?> name="eazy_company_data_nl"></td>
                </tr>
                <tr>
                    <td><label for="eazy_company_data_contracts"><?php _e('This site obtains data to create contracts', 'eazylegal') ?> :</label></td>
                    <td><input type="checkbox" value="on" <?php if ( get_option('eazy_company_data_contracts')=='on' ) echo 'checked="checked"'; ?> name="eazy_company_data_contracts"></td>
                </tr>
                <tr>
                    <td><label for="eazy_company_data_ux"><?php _e('This site obtains statistical data to improve usability and identify traffic', 'eazylegal') ?> :</label></td>
                    <td><input type="checkbox" value="on" <?php if ( get_option('eazy_company_data_ux')=='on' ) echo 'checked="checked"'; ?> name="eazy_company_data_ux"></td>
                </tr>
                <tr>
                    <td><label for="eazy_company_data_third"><?php _e('This site shares your data with third parties', 'eazylegal') ?> :</label></td>
                    <td><input type="checkbox" value="on" <?php if ( get_option('eazy_company_data_third')=='on' ) echo 'checked="checked"'; ?> name="eazy_company_data_third"></td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td><label for="eazy_company_start_date_cookie"><?php _e('Start date for Cookie Policy', 'eazylegal') ?> :</label></td>
                    <td><input type="text" value="<?php echo esc_attr( get_option('eazy_company_start_date_cookie') ); ?>" name="eazy_company_start_date_cookie" placeholder="DD/MM/YYYY"></td>
                </tr>
                <tr>
                    <td><label for="eazy_company_cookie_tech"><?php _e('This site use technical cookies', 'eazylegal') ?> :</label></td>
                    <td><input type="checkbox" value="on" <?php if ( get_option('eazy_company_cookie_tech')=='on' ) echo 'checked="checked"'; ?> name="eazy_company_cookie_tech"></td>
                </tr>
                <tr>
                    <td><label for="eazy_company_cookie_analytics"><?php _e('This site use statistical cookies', 'eazylegal') ?> :</label></td>
                    <td><input type="checkbox" value="on" <?php if ( get_option('eazy_company_cookie_analytics')=='on' ) echo 'checked="checked"'; ?> name="eazy_company_cookie_analytics"></td>
                </tr>
                <tr>
                    <td><label for="eazy_company_cookie_aggregated"><?php _e('This site use aggregated statistical cookies', 'eazylegal') ?> :</label></td>
                    <td><input type="checkbox" value="on" <?php if ( get_option('eazy_company_cookie_aggregated')=='on' ) echo 'checked="checked"'; ?> name="eazy_company_cookie_aggregated"></td>
                </tr>
                <tr>
                    <td><label for="eazy_company_cookie_third_party"><?php _e('This site use third-party cookies', 'eazylegal') ?> :</label></td>
                    <td><input type="checkbox" value="on" <?php if ( get_option('eazy_company_cookie_third_party')=='on' ) echo 'checked="checked"'; ?> name="eazy_company_cookie_third_party"></td>
                </tr>
                <tr>
                    <td><label for="eazy_company_cookie_maps"><?php _e('This site use cookies for interactive maps', 'eazylegal') ?> :</label></td>
                    <td><input type="checkbox" value="on" <?php if ( get_option('eazy_company_cookie_maps')=='on' ) echo 'checked="checked"'; ?> name="eazy_company_cookie_maps"></td>
                </tr>
                <tr>
                    <td><label for="eazy_company_cookie_social"><?php _e('This site use cookies for social plugins or widget', 'eazylegal') ?> :</label></td>
                    <td><input type="checkbox" value="on" <?php if ( get_option('eazy_company_cookie_social')=='on' ) echo 'checked="checked"'; ?> name="eazy_company_cookie_social"></td>
                </tr>
                <tr>
                    <td><label for="eazy_company_cookie_list"><?php _e('Cookie List', 'eazylegal') ?> :</label></td>
                    <td>
                        <textarea name="eazy_company_cookie_list" cols="30" rows="10"><?php echo (empty(get_option('eazy_company_cookie_list'))) ? $eazy_cookie_list_default_string : esc_attr( get_option('eazy_company_cookie_list') ); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><hr></td>
                </tr>
                <tr>
                    <td><label for="eazy_gtm_code"><?php _e('Google Tag Manager Code', 'eazylegal') ?> :</label></td>
                    <td><input type="text" value="<?php echo esc_attr( get_option('eazy_gtm_code') ); ?>" name="eazy_gtm_code" placeholder="<?php _e('GTM-XXXXXXX', 'eazylegal') ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><?php submit_button(); ?></td>
                </tr>
            </table>
        </form>
	</div>
    <?php
}

/**
 * Enable Shortcode Output for Privacy
 *
 * @param [type] $atts
 * @return void
 */
add_shortcode('eazylegalprivacy', 'eazy_legal_ouput_privacy');
function eazy_legal_ouput_privacy($atts) {

    // Customize Ouput
    extract(shortcode_atts(array(
        'lang' => 'it',
        'cookie_url' => '/cookies/'
    ), $atts));

    // get options
    $eazy_company_data_stat = get_option( 'eazy_company_data_stat' );
    $eazy_company_data_cf = get_option( 'eazy_company_data_cf' );
    $eazy_company_data_nl = get_option( 'eazy_company_data_nl' );
    $eazy_company_data_contracts = get_option( 'eazy_company_data_contracts' );
    $eazy_company_data_ux = get_option( 'eazy_company_data_ux' );
    $eazy_company_data_third = get_option( 'eazy_company_data_third' );

    switch ( $lang ):
        
        // IT
        case 'it':
        case 'it_IT':
            $template = plugin_dir_path( __FILE__ ) . 'templates/privacy-policy/it_IT.html';
            $output = file_get_contents( $template );

            $label_company_data_stat = 'Dati statistici ottenuti da utenti';
            $label_company_data_cf = 'Dati di contatto tramite form';
            $label_company_data_nl = 'Dati personali da moduli newsletter';
            $label_company_data_contracts = 'Dati personali per la creazione di contratti';
            $label_company_data_ux = 'Dati personali per il miglioramento dell\'esperienza utente';
            $label_company_data_third = 'Dati personali condivisi con terzi';
        break;

    endswitch;

    // Get Options
    $eazy_company_name = get_option( 'eazy_company_name' );
    $eazy_company_headquarters = get_option( 'eazy_company_headquarters' );
    $eazy_company_address = get_option( 'eazy_company_address' );
    $eazy_company_phone = get_option( 'eazy_company_phone' );
    $eazy_company_email = '<a href="mailto:'.get_option( 'eazy_company_email' ).'">'.get_option( 'eazy_company_email' ).'</a>';
    $eazy_company_start_date = get_option( 'eazy_company_start_date' );
    $eazy_company_responsible = get_option( 'eazy_company_responsible' );
    $eazy_http_host = $_SERVER['HTTP_HOST'];

    // Replace config options
    $output = str_replace( 
        [ '{eazy_company_name}', '{eazy_company_headquarters}', '{eazy_company_address}', '{eazy_company_phone}', '{eazy_company_email}', '{eazy_company_start_date}', '{eazy_http_host}' ],
        [ $eazy_company_name, $eazy_company_headquarters, $eazy_company_address, $eazy_company_phone, $eazy_company_email, $eazy_company_start_date, $eazy_http_host ],
        $output
    );

    // Replace data processing options
    $processing_options = '<ul>';
    if ( $eazy_company_data_stat=='on' ) $processing_options .= '<li>'.$label_company_data_stat.'</li>';
    if ( $eazy_company_data_cf=='on' ) $processing_options .= '<li>'.$label_company_data_cf.'</li>';
    if ( $eazy_company_data_nl=='on' ) $processing_options .= '<li>'.$label_company_data_nl.'</li>';
    if ( $eazy_company_data_contracts=='on' ) $processing_options .= '<li>'.$label_company_data_contracts.'</li>';
    if ( $eazy_company_data_ux=='on' ) $processing_options .= '<li>'.$label_company_data_ux.'</li>';
    if ( $eazy_company_data_third=='on' ) $processing_options .= '<li>'.$label_company_data_third.'</li>';
    $processing_options .= '</ul>';

    $output = str_replace('{eazy_processing_options}', $processing_options, $output);

    return $output;
}


/**
 * Enable Shortcode Output for Cookies
 *
 * @param [type] $atts
 * @return void
 */
add_shortcode('eazylegalcookie', 'eazy_legal_ouput_cookies');
function eazy_legal_ouput_cookies($atts) {

    // Customize Ouput
    extract(shortcode_atts(array(
        'lang' => 'it',
        'privacy_url' => '/privacy/'
    ), $atts));

    // get options
    $eazy_company_data_stat = get_option( 'eazy_company_data_stat' );
    $eazy_company_data_cf = get_option( 'eazy_company_data_cf' );
    $eazy_company_data_nl = get_option( 'eazy_company_data_nl' );
    $eazy_company_data_contracts = get_option( 'eazy_company_data_contracts' );
    $eazy_company_data_ux = get_option( 'eazy_company_data_ux' );
    $eazy_company_data_third = get_option( 'eazy_company_data_third' );

    // get cookie options
    $eazy_company_start_date_cookie = get_option( 'eazy_company_start_date_cookie' );
    $eazy_company_cookie_tech = get_option( 'eazy_company_cookie_tech' );
    $eazy_company_cookie_analytics = get_option( 'eazy_company_cookie_analytics' );
    $eazy_company_cookie_aggregated = get_option( 'eazy_company_cookie_aggregated' );
    $eazy_company_cookie_third_party = get_option( 'eazy_company_cookie_third_party' );
    $eazy_company_cookie_maps = get_option( 'eazy_company_cookie_maps' );
    $eazy_company_cookie_social = get_option( 'eazy_company_cookie_social' );
    $eazy_company_cookie_list = get_option( 'eazy_company_cookie_list' );

    switch ( $lang ):

        // IT
        case 'it':

            $template = plugin_dir_path( __FILE__ ) . 'templates/cookies/it_IT.html';
            $output = file_get_contents( $template );

            $label_cookie_tech = 'Il sito utilizza cookie tecnici';
            $label_company_data_cf = 'Il sito utilizza cookie analitici';
            $label_company_data_nl = 'Il sito utilizza cookie statistici aggregati';
            $label_company_data_contracts = 'Il sito utilizza altri cookies di terze parte';
            $label_company_data_ux = 'Il sito utilizza cookies che forniscono mappe interattive';
            $label_company_data_third = 'Il sito utilizza social buttons plugins e widget';

            $label_cookie_tech_no = 'Il sito non utilizza cookie tecnici';
            $label_company_data_cf_no = 'Il sito non utilizza cookie analitici';
            $label_company_data_nl_no = 'Il sito non utilizza cookie statistici aggregati';
            $label_company_data_contracts_no = 'Il sito non utilizza altri cookies di terze parte';
            $label_company_data_ux_no = 'Il sito non utilizza cookies che forniscono mappe interattive';
            $label_company_data_third_no = 'Il sito non utilizza social buttons plugins e widget';
        break;

    endswitch;

    // Get Options
    $eazy_company_name = get_option( 'eazy_company_name' );
    $eazy_company_headquarters = get_option( 'eazy_company_headquarters' );
    $eazy_company_address = get_option( 'eazy_company_address' );
    $eazy_company_phone = get_option( 'eazy_company_phone' );
    $eazy_company_email = '<a href="mailto:'.get_option( 'eazy_company_email' ).'">'.get_option( 'eazy_company_email' ).'</a>';
    $eazy_company_start_date = get_option( 'eazy_company_start_date' );
    $eazy_company_responsible = get_option( 'eazy_company_responsible' );
    $eazy_http_host = $_SERVER['HTTP_HOST'];

    // Replace config options
    $output = str_replace(
        [ '{eazy_company_name}', '{eazy_company_headquarters}', '{eazy_company_address}', '{eazy_company_phone}', '{eazy_company_email}', '{eazy_company_start_date}', '{eazy_http_host}' ],
        [ $eazy_company_name, $eazy_company_headquarters, $eazy_company_address, $eazy_company_phone, $eazy_company_email, $eazy_company_start_date, $eazy_http_host ],
        $output
    );

    // Replace cookie options
    $output = str_replace( '{eazy_use_cookies_tech}', ($eazy_company_cookie_tech=='on') ? $label_cookie_tech : $label_cookie_tech_no, $output );
    $output = str_replace( '{eazy_use_cookies_analytics}', ($eazy_company_cookie_analytics=='on') ? $label_company_data_cf : $label_company_data_cf_no, $output );
    $output = str_replace( '{eazy_use_cookies_aggregated}', ($eazy_company_cookie_aggregated=='on') ? $label_company_data_nl : $label_company_data_nl_no, $output );
    $output = str_replace( '{eazy_use_cookies_third_parts}', ($eazy_company_cookie_third_party=='on') ? $label_company_data_contracts : $label_company_data_contracts_no, $output );
    $output = str_replace( '{eazy_use_cookies_maps}', ($eazy_company_cookie_maps=='on') ? $label_company_data_ux : $label_company_data_ux_no, $output );
    $output = str_replace( '{eazy_use_cookies_social}', ($eazy_company_cookie_social=='on') ? $label_company_data_third : $label_company_data_third_no, $output );
    $output = str_replace( '{eazy_use_cookies_list}', (!empty($eazy_company_cookie_list)) ? '<p><strong>Cookie List</strong></p><pre>'.$eazy_company_cookie_list.'</pre>' : '', $output );

    return $output;
}

/**
 * Add GTM code in header
 */
add_action( 'wp_head', 'eazy_add_gtm_code_head' );
function eazy_add_gtm_code_head() {
    $eazy_gtm_code = get_option( 'eazy_gtm_code' );
    if ( !empty($eazy_gtm_code) ) :
        echo '<!-- Google Tag Manager -->';
        echo '<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({"gtm.start":new Date().getTime(),event:"gtm.js"});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!="dataLayer"?"&l="+l:"";j.async=true;j.src="https://www.googletagmanager.com/gtm.js?id="+i+dl;f.parentNode.insertBefore(j,f);})(window,document,"script","dataLayer","'.esc_attr( $eazy_gtm_code ).'");</script>';
        echo '<!-- End Google Tag Manager -->';
    endif;
}

/**
 * Add GTM code in body
 */
add_action( 'wp_body_open', 'eazy_add_gtm_code_body' );
function eazy_add_gtm_code_body() {
    $eazy_gtm_code = get_option( 'eazy_gtm_code' );
    if ( !empty($eazy_gtm_code) ) :
        echo '<!-- Google Tag Manager (noscript) -->';
        echo '<noscript><iframe src="https://www.googletagmanager.com/ns.html?id='.esc_attr( $eazy_gtm_code ).'" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>';
        echo '<!-- End Google Tag Manager (noscript) -->';
    endif;
}

// Test only
?>
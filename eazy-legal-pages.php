<?php

/*
Plugin Name: Eazy Policy &amp; Cookies Pages GDR Compliant
Plugin URI: http://www.eazythemes.com
Description: Create page for Cookies e Privacy for GDPR
Version: 2.0
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
}

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
    ?>
    <div class="wrap">
        <form method="post" action="options.php">
            <h2><?php _e('Options for Privacy &amp; Cookies', 'eazylegal'); ?></h2>
            <p><?php _e('Configure the below field and then user the following shortcode to put inside your pages', 'eazylegal') ?></p>
            <p>
                Use <code>[eazylegalprivacy][/eazylegalprivacy]</code> for Privacy Page.<br>
                Use <code>[eazylegalcookie][/eazylegalcookie]</code> for Cookie Page.
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
                    <td><textarea name="eazy_company_cookie_list" cols="30" rows="10"><?php echo esc_attr( get_option('eazy_company_cookie_list') ); ?></textarea></td>
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
            $output = '<p>{eazy_company_name} con sede in {eazy_company_headquarters}, in qualità di Titolare del trattamento dei dati personali ai sensi del GDPR UE 679/2016 Regolamento Generale sulla Protezione dei Dati riconosce l’importanza della protezione dei dati personali e considera la sua tutela uno degli obiettivi principali della propria attività.</p><p> Prima di comunicare qualsiasi dato personale, {eazy_company_name} Vi invita a leggere con attenzione la presente privacy policy, poiché contiene informazioni importanti sulla tutela dei dati personali e sulle misure di sicurezza adottate per garantirne la riservatezza nel pieno rispetto del GDPR e:</p><p> - si intende resa solo per il sito {eazy_http_host}(“Sito”) mentre non si applica ad altri siti web eventualmente consultati tramite link esterni;</p><p> - è da intendersi quale Informativa resa ai sensi dell’art. 13 del GDPR a coloro che interagiscono con il Sito;</p><p> - si conforma alla Raccomandazione n. 2/2001 relativa ai requisiti minimi per la raccolta di dati on-line nell’Unione Europea, adottata il 17 maggio 2001 dal Gruppo di Lavoro Articolo 29.</p><p>{eazy_company_name} Vi informa che il trattamento dei Vostri dati personali sarà improntato ai principi di liceità, correttezza, trasparenza, limitazione delle finalità e della conservazione, minimizzazione dei dati, esattezza, integrità e riservatezza. I Vostri dati personali verranno pertanto trattati in accordo alle disposizioni legislative del GDPR e degli obblighi di riservatezza ivi previsti.</p><p> <strong> INDICE <br/> </strong> La presente Privacy Policy è composta dalle seguenti voci:</p><p> 1. TITOLARE DEL TRATTAMENTO</p><p> 2. I DATI PERSONALI OGGETTO DI TRATTAMENTO</p><p> a. Dati di navigazione</p><p> b. Dati forniti volontariamente</p><p> c. Cookie e tecnologie affini</p><p> 3. FINALITA’, BASE GIURIDICA E NATURA OBBLIGATORIA O FACOLTATIVA DEL TRATTAMENTO</p><p> 4. DESTINATARI</p><p> 5. TRASFERIMENTI</p><p> 6. CONSERVAZIONE DEI DATI</p><p> 7. I DIRITTI DELL’INTERESSATO</p><p> 8. MODIFICHE</p><p> <strong></strong></p><p> <strong>1. TITOLARE DEL TRATTAMENTO</strong></p><p> Il Titolare del trattamento del Sito è {eazy_company_name} con sede legale in via {eazy_company_address}, contattabile all’indirizzo e-mail {eazy_company_email} oppure al numero di telefono {eazy_company_phone} o scrivendo a {eazy_company_name} via {eazy_company_address} per qualunque informazione inerente il trattamento dei dati.</p><p> <strong>2. I DATI PERSONALI OGGETTO DI TRATTAMENTO</strong></p><p> Per “Dati Personali” si intende qualsiasi informazione riguardante una persona fisica identificata o identificabile con particolare riferimento a un identificativo come il nome, un numero di identificazione, dati relativi all’ubicazione, un identificativo online o a uno o più elementi caratteristici della sua identità fisica, fisiologica, psichica, economica, culturale o sociale.</p><p> I Dati Personali raccolti dal Sito sono i seguenti:</p><p> <strong>a. Dati di navigazione</strong></p><p> I sistemi informatici del Sito raccolgono alcuni Dati Personali la cui trasmissione è implicita nell’uso dei protocolli di comunicazione di Internet. Si tratta di informazioni che non sono raccolte per essere associate a te, ma che per loro stessa natura potrebbero, attraverso elaborazioni ed associazioni con dati detenuti da terzi, permettere di identificarti. Tra questi ci sono gli indirizzi IP o i nomi a dominio dei dispositivi utilizzati per connetterti al Sito, gli indirizzi in notazione URI (Uniform Resource Identifier) delle risorse richieste, l’orario della richiesta, il metodo utilizzato nel sottoporre la richiesta al server, la dimensione del file ottenuto in risposta, il codice numerico indicante lo stato della risposta data dal server (buon fine, errore, ecc.) ed altri parametri relativi al tuo sistema operativo e ambiente informatico.</p>';
            
            if ( $eazy_company_data_stat=='on' ) $output .= '<p>Questi dati vengono utilizzati al fine di ricavare informazioni statistiche anonime sull’uso del Sito e per controllarne il corretto funzionamento; per permettere<br> – vista l’architettura dei sistemi utilizzati<br> – la corretta erogazione delle varie funzionalità da te richieste.</p>';
            
            $output .= '<p> <strong>b. Dati forniti volontariamente</strong></p>';
            
            if ( $eazy_company_data_nl=='on' || $eazy_company_data_cf=='on' ) $output .= '<p>Attraverso il Sito hai la possibilità di fornire volontariamente Dati Personali come il nome e l’indirizzo e-mail per l’iscrizione al servizio di newsletter o per contattarci attraverso il form “Contattaci”.</p>';
            
            $output .= '{eazy_company_name} tratterà questi dati nel rispetto del GDPR, assumendo che siano riferiti a te o a terzi soggetti che ti hanno espressamente autorizzato a conferirli in base ad un’idonea base giuridica che legittima il trattamento dei dati in questione. Rispetto a tali ipotesi, ti poni come autonomo titolare del trattamento, assumendoti tutti gli obblighi e le responsabilità di legge. In tal senso, conferisci sul punto la più ampia manleva rispetto ad ogni contestazione, pretesa, richiesta di risarcimento del danno da trattamento, etc. che dovesse pervenire a {eazy_company_name} da terzi soggetti i cui Dati Personali siano stati trattati attraverso il tuo utilizzo del Sito in violazione del GDPR.</p><p> <strong>c. Cookie e tecnologie affini</strong></p><p>{eazy_company_name} raccoglie Dati Personali attraverso cookies. <a href="'.$cookie_url.'">Maggiori informazioni sull’uso dei cookie e tecnologie affini sono disponibili</a>.</p><p> <strong> 3. FINALITA’, BASE GIURIDICA E NATURA OBBLIGATORIA O FACOLTATIVA DEL TRATTAMENTO </strong></p><p> I Dati Personali che fornisci attraverso il Sito saranno trattati da {eazy_company_name} per le seguenti finalità:</p>';
            
            if ( $eazy_company_data_contracts=='on' ) $output .= '<p>a) finalità inerenti l’esecuzione di un contratto di cui sei parte o all’esecuzione di misure precontrattuali adottate su tua richiesta (es: richiesta di contatto tramite il modulo Contatti, registrazione al servizio newsletter, ecc.);</p>';
            
            if ( $eazy_company_data_ux=='on' ) $output .= '<p> b) finalità di ricerche/analisi statistiche su dati aggregati o anonimi, senza dunque possibilità di identificare l’utente, volti a misurare il funzionamento del Sito, misurare il traffico e valutare usabilità e interesse</p>';
            
            $output .= '<p> c) finalità relative all’adempimento di un obbligo legale al quale {eazy_company_name} è soggetto;</p><p> La base legale del trattamento di Dati Personali per le finalità di cui al punto a) è l’erogazione di un servizio o il riscontro ad una richiesta che non richiedono il consenso ai sensi del GDPR.</p><p> La finalità di cui al punto b) non comporta il trattamento di Dati Personali, mentre a finalità di cui al punto c) rappresenta un trattamento legittimo di Dati Personali ai sensi del GDPR in quanto il trattamento è necessario per adempiere ad un obbligo di legge a cui{eazy_company_name} è soggetto. <br/> Il conferimento dei tuoi Dati Personali per la finalità sopra elencate è facoltativo, ma il loro eventuale mancato conferimento potrebbe rendere impossibile riscontrare una tua richiesta o adempiere ad un obbligo legale a cui {eazy_company_name} è soggetto.</p><p> <strong>4. DESTINATARI</strong></p><p> I tuoi Dati Personali potranno essere condivisi, per le finalità specificate al punto 3, con:</p>';
            
            if ( $eazy_company_data_nl=='on' ) $output .= '<p> a. soggetti necessari per l’erogazione dei servizi offerti dal Sito tra cui a titolo esemplificativo l’invio di e-mail e l’analisi del funzionamento del Sito che agiscono tipicamente in qualità di responsabili del trattamento di {eazy_company_name} ;</p>';
            
            if ( $eazy_company_data_third=='on' ) $output .= '<p> b. persone autorizzate da {eazy_company_name} al trattamento dei Dati Personali che si siano impegnate alla riservatezza o abbiano un adeguato obbligo legale di riservatezza; (es. dipendenti e collaboratori di{eazy_company_name} ); (a. e b. sono collettivamente “Destinatari”);</p>';
            
            $output .= '<p> c. autorità giurisdizionali nell’esercizio delle loro funzioni quando richiesto dal GDPR.</p><p> <strong> 5. TRASFERIMENTI <br/> </strong> Spazio Economico Europeo</p><p> <strong>6. CONSERVAZIONE DEI DATI</strong></p><p>{eazy_company_name} tratterà i tuoi Dati Personali per il tempo strettamente necessario a raggiungere gli scopi indicati al punto 3. A titolo esemplificativo,{eazy_company_name} tratterà i Dati Personali per il servizio newsletter fino a quando non deciderai di disiscriverti dal servizio. Fatto salvo quanto sopra,{eazy_company_name} tratterà i tuoi Dati Personali fino al tempo permesso dalla legge Italiana a tutela dei propri interessi (Art. 2947(1)(3) c.c.). Maggiori informazioni in merito al periodo di conservazione dei Dati Personali e ai criteri utilizzati per determinare tale periodo possono essere richieste scrivendo al Titolare del trattamento ai riferimenti indicati al punto 1.</p><p> <strong>7. I TUOI DIRITTI</strong></p><p> Nei limiti del GDPR, hai il diritto di chiedere a {eazy_company_name} , in qualunque momento, l’accesso ai tuoi Dati Personali, la rettifica o la cancellazione degli stessi o di opporti al loro trattamento, la limitazione del trattamento nonché di ottenere in un formato strutturato, di uso comune e leggibile da dispositivo automatico i dati che ti riguardano.</p><p> Le richieste vanno rivolte via e-mail all’indirizzo:{eazy_company_email}</p><p> Ai sensi del GDPR, hai in ogni caso il diritto di proporre reclamo all’autorità di controllo competente (Garante per la Protezione dei Dati Personali) qualora ritenessi che il trattamento dei tuoi Dati Personali sia contrario alla normativa vigente.</p><p> <strong>8. MODIFICHE</strong></p><p> La presente Privacy Policy è in vigore dal {eazy_company_start_date}.{eazy_company_name} si riserva di modificarne o semplicemente aggiornarne il contenuto, in parte o completamente, anche a causa di variazioni della Normativa Applicabile.{eazy_company_name} ti informerà di tali variazioni non appena verranno introdotte e saranno vincolanti non appena pubblicate sul Sito.{eazy_company_name} ti invita quindi a visitare con regolarità questa sezione per prendere cognizione della più recente ed aggiornata versione della Privacy Policy in modo che tu sia sempre aggiornato sui dati raccolti e sull’uso che se ne fanno.</p><p> {eazy_company_start_date}</p>';
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
            $output = '<p>La presente Cookie Policy è parte integrante della Privacy Policy di {eazy_company_name} disponibile al seguente link: <a href="'.$privacy_url.'">Privacy Policy</a>.</p><p> <strong>Introduzione</strong></p><p> Un cookie è un piccolo file di lettere e numeri che viene scaricato su \'apparecchiatura terminale\' (ad esempio un computer o uno smartphone) quando l\'utente accede a un sito Web. Consente al sito Web di riconoscere il dispositivo dell\'utente e memorizzare alcune informazioni sulle preferenze dell\'utente o sulle azioni passate per periodi di tempo variabili in funzione dell\'esigenza.</p><p> L\'utente può manifestare le proprie opzioni sull\'uso dei cookies presenti sul presente sito (';

            if ( $eazy_company_cookie_tech=='on' ) $output .= 'Cookie tecnici, ';
            if ( $eazy_company_cookie_analytics=='on' ) $output .= 'Cookie analitici, ';
            if ( $eazy_company_cookie_aggregated=='on' ) $output .= 'Cookie statistici aggregati, ';
            if ( $eazy_company_cookie_third_party=='on' ) $output .= 'Altri cookies di terza parte, ';
            if ( $eazy_company_cookie_maps=='on' ) $output .= 'Cookies che forniscono mappe interattive, ';
            if ( $eazy_company_cookie_social=='on' ) $output .= 'Social buttons plugins e widget, ';

            $output = rtrim( $output, ', ' );

            $output .= ') anche attraverso le impostazioni del/i browser seguendo le istruzioni fornite. L\'utente può inoltre impostare la "navigazione anonima" che gli consente di navigare in internet senza salvare alcuna informazione sui siti, sulle pagine visitate, su eventuali password inserite e su altre informazioni che possano ricondurre alla sua identità.</p><p> Nel corso della navigazione, l\'utente può ricevere sul suo terminale anche cookies di “terze parti” che vengono cioè inviati da siti o da web server diversi, sui quali possono risiedere alcuni elementi (quali, ad esempio, immagini o specifici link a pagine di altri domini) presenti sul sito che lo stesso sta visitando.</p><p> I cookies, sono usati per differenti finalità: esecuzione di autenticazioni informatiche, monitoraggio di sessioni, memorizzazione di informazioni su specifiche configurazioni riguardanti gli utenti che accedono al server, ecc. Alcune delle finalità di installazione dei cookies potrebbero, inoltre, necessitare del consenso dell\'utente.</p><p>Al fine di giungere a una corretta regolamentazione di tali dispositivi, posto che non vi sono delle caratteristiche tecniche che li differenziano gli uni dagli altri, è necessario distinguerli proprio sulla base delle finalità perseguite da chi li utilizza.</p><p> Infatti, in attuazione delle disposizioni contenute nella direttiva 2009/136/CE, vi è l\'obbligo di acquisire il consenso preventivo e informato degli utenti all\'installazione di cookie utilizzati per finalità diverse da quelle meramente tecniche (cfr. art. 1, comma 5, lett. a), del D. Lgs. 28 maggio 2012, n. 69, che ha modificato l\'art. 122 del Codice).</p><p> In linea con la Normativa Applicabile, il tuo preventivo consenso per l’uso dei cookie non è sempre richiesto. In particolare, tale consenso non è richiesto per i “cookie tecnici”, es. quelli usati per il solo scopo di trasportare una comunicazione attraverso una rete di comunicazione elettronica, o strettamente necessari per fornire un servizio espressamente richiesto dall’utente. In altre parole, i cookie che sono indispensabili l’operatività di un sito.</p><p> Il tuo preventivo consenso è invece richiesto per i cookie “analitici” non anonimizzati e per cookie di profilazione, es. quelli che forniscono analisi statistiche sull’utilizzo di un sito web o che creano profili di utenti per inviargli messaggi pubblicitari in linea con le preferenze che hanno espresso durante la navigazione.</p><p> <strong>Come controllare ed eventualmente disabilitare i cookies</strong></p><p>Nel caso in cui l’utente abbia dubbi o preoccupazioni in merito all\'utilizzo dei cookies è sempre possibile intervenire per impedirne l\'impostazione e la lettura, ad esempio modificando le impostazioni sulla privacy all\'interno del browser utilizzato sul proprio terminale, al fine di bloccarne determinati tipi.</p><p> L\'utente può dunque gestire le preferenze relative ai cookies direttamente all\'interno del proprio browser ed impedire – ad esempio – che terze parti possano installarne. Tramite le preferenze del browser è inoltre possibile eliminare i cookies installati in passato, incluso il cookie in cui venga eventualmente salvato il consenso all\'installazione di cookie da parte di questo sito. È importante notare che disabilitando tutti i cookies, il funzionamento di questo sito potrebbe essere compromesso.</p><p> L\'utente può trovare informazioni su come gestire o disabilitare i cookies nel suo browser ai seguenti indirizzi:</p><p> <a href="https://support.google.com/chrome/answer/95647?hl=it"> Google Chrome </a> : https://support.google.com/chrome/answer/95647?hl=it</p><p> <a href="https://support.mozilla.org/it/kb/Attivare%20e%20disattivare%20i%20cookie"> Mozilla Firefox </a> : https://support.mozilla.org/it/kb/Attivare%20e%20disattivare%20i%20cookie</p><p> <a href="http://support.apple.com/kb/HT1677?viewlocale=it_IT"> Apple Safari </a> : http://support.apple.com/kb/HT1677?viewlocale=it_IT</p><p> <a href="http://support.apple.com/kb/HT1677?viewlocale=it_IT"> Microsoft Windows Explorer </a>: http://windows.microsoft.com/it-It/windows7/Block-enable-or-allow-cookies</p><p> http://windows.microsoft.com/it-it/windows7/how-to-manage-cookies-in-internet-explorer-9</p><p> <a href="http://help.opera.com/Windows/10.00/it/cookies.html">Opera</a> : http://help.opera.com/Windows/10.00/it/cookies.html</p><p> Per i browser non presenti nel precedente elenco si prega di fare riferimento alla documentazione relativa dello stesso.</p><p> Si precisa che il Titolare non si assume alcuna responsabilità in caso di eventuali modifiche ai link su menzionati e si ribadisce che la disattivazione da parte dell\'utente di tutte le tipologie di cookie (tecnici compresi) potrebbe ridurre o rendere non disponibili alcune funzionalità del sito.</p><p> <strong>Cookies utilizzati dal sito</strong></p><p> Il presente sito web utilizza vari tipi di cookie, alcuni per rendere più efficace la navigazione, altri per abilitare determinate funzionalità.</p><p> Per consentire la fruizione del presente sito e l’erogazione dei servizi ad esso associati, viene fatto uso:</p><ul>';

            if ( $eazy_company_cookie_tech=='on' ) $output .= '<li>Cookie tecnici</li>';
            if ( $eazy_company_cookie_analytics=='on' ) $output .= '<li>Cookie analitici</li>';
            if ( $eazy_company_cookie_aggregated=='on' ) $output .= '<li>Cookie statistici aggregati</li>';
            if ( $eazy_company_cookie_third_party=='on' ) $output .= '<li>Altri cookies di terza parte</li>';
            if ( $eazy_company_cookie_maps=='on' ) $output .= '<li>Cookies che forniscono mappe interattive</li>';
            if ( $eazy_company_cookie_social=='on' ) $output .= '<li>Social buttons plugins e widget</li>';

            $output .= '</ul><p> Si precisa inoltre che i cookies di prima parte sono quelli generati ed utilizzati dal presente sito, mentre quelli di terza parte sono generati, sempre nel presente sito, da soggetti terzi.</p><p> Su questo sito sono operativi cookies di tipologie differenti - con specifiche funzioni - che possono appartenere a una o più delle seguenti categorie descritte di seguito.</p><p>';

            $output .= '<strong>Cookie tecnici</strong></p><p> I cookies tecnici sono quelli che permettono la memorizzazione di azioni precedenti o di salvare la sessione dell’utente oppure di svolgere altre attività strettamente necessarie ed essenziali al corretto funzionamento del sito e per tali cookies non è previsto il rilascio del consenso da parte dell’interessato.</p><p>I cookies funzionali (assimilabili ai cookies tecnici nell’ottica del Provvedimento del Garante dell\'8 Maggio 2014 pubblicato in G.U. n.126 il 3 giugno 2014, di recepimento della direttiva 2002/58/CE) permettono al sito di ricordare le scelte dell’utente per fornire a quest’ultimo una navigazione più personalizzata ed ottimizzata.</p><p> Questi tipi di cookies possono essere necessari per mantenere aperta una sessione di navigazione o per consentire all’utente di accedere ad eventuali aree riservate oppure ricordare temporaneamente i testi inseriti durante la compilazione di un modulo all’interno della stessa sessione. Non risultano essere indispensabili al funzionamento del sito, ma ne migliorano la qualità e l\'esperienza di navigazione; se non si accettano questi cookies, la resa e la funzionalità del sito potrebbero risultare non ottimali e l’accesso ai suoi contenuti potrebbe risultare limitato.</p>';
            if ( $eazy_company_cookie_tech=='on' ) :
                $output .= '<p>Il sito utilizza questa tipologia di cookies</p>';
            else:
                $output .= '<p>Il sito non utilizza questa tipologia di cookies</p>';
            endif;

            $output .= '<p> <strong>Cookies analitici</strong></p><p> Sono i cookies utilizzati per raccogliere e analizzare informazioni che aiutano a capire come gli utenti interagiscono con il sito, fornendo ad esempio:</p><p>	&#9679; informazioni statistiche sugli accessi e le visite al sito web relative all’ultima pagina visitata;</p><p> &#9679; il numero di sezioni e pagine visitate ed il numero di visitatori;</p><p>	&#9679; informazioni statistiche relative al tempo trascorso sul sito dalla media degli utenti;</p><p> Queste informazioni potrebbero essere associate a dettagli dell’utente quali indirizzo IP, dominio o browser; tuttavia, quando vengono analizzate al solo fine di ricavare informazioni statistiche anonime sull\'uso del sito, i cookies che le raccolgono possono essere assimilati ai cookies tecnici.</p>';
            if ( $eazy_company_cookie_analytics=='on' ) :
                $output .= '<p>Il sito utilizza questa tipologia di cookies</p>';
            else:
                $output .= '<p>Il sito non utilizza questa tipologia di cookies</p>';
            endif;

            $output .= '<p> <strong>Cookie statistici aggregati</strong></p>';
            if ( $eazy_company_cookie_aggregated=='on' ) :
                $output .= '<p>Il sito utilizza questa tipologia di cookies</p>';
            else:
                $output .= '<p>Il sito non utilizza questa tipologia di cookies</p>';
            endif;

            $output .= '<p> <strong>Altri cookies di terza parte</strong></p>';
            if ( $eazy_company_cookie_third_party=='on' ) :
                $output .= '<p>Il sito utilizza questa tipologia di cookies</p>';
            else:
                $output .= '<p>Il sito non utilizza questa tipologia di cookies</p>';
            endif;

            $output .= '<p><strong>Cookies che forniscono mappe interattive</strong></p><p> Questi cookies consentono di includere mappe interattive personalizzabili all\'interno del sito.</p>';
            if ( $eazy_company_cookie_maps=='on' ) :
                $output .= '<p>Il sito utilizza questa tipologia di cookies</p>';
            else:
                $output .= '<p>Il sito non utilizza questa tipologia di cookies</p>';
            endif;

            $output .= '<p><strong>Social buttons plugins e widget</strong></p>';
            if ( $eazy_company_cookie_social=='on' ) :
                $output .= '<p>Il sito utilizza questa tipologia di cookies</p>';
            else:
                $output .= '<p>Il sito non utilizza questa tipologia di cookies</p>';
            endif;

            $output .= '<p> L\'utilizzo più comune è quello finalizzato alla condivisione dei contenuti dei social network. La presenza dei plug in comporta la trasmissione di cookie da e verso tutti i siti gestiti da terze parti. La gestione delle informazioni raccolte da "terze parti" è disciplinata dalle relative informative cui si prega di fare riferimento.</p><p> <strong></strong></p>';


            if ( $eazy_company_cookie_list=='on' ) :
                $output .= '<p><strong> Descrizione specifica e analitica dei cookie installati dal sito </strong></p>';
                $output .= '<div>'.$eazy_company_cookie_list.'</div>';
            endif;

            $output .= '<p> <strong></strong></p><p> <strong>Il banner dei “cookies” – consenso al loro utilizzo</strong></p><p> Come imposto dal Provvedimento “Individuazione delle modalità semplificate per l’informativa e l’acquisizione del consenso per l’uso dei cookie” dell’8 maggio 2014 e come richiamato anche all\'art. 122, comma 2, del Codice, quando previsto, è necessario che l’utente esprima il proprio consenso all’utilizzo dei cookies.</p><p> Utilizzando per la prima volta l’applicazione, l’utente vedrà apparire una sintetica informativa sull’utilizzo dei cookies.</p><p> Proseguendo nell’utilizzo, chiudendo la fascetta informativa o facendo click in una qualsiasi parte della pagina o scorrendola per evidenziare ulteriore contenuto, si accetta la Cookie Policy e verranno impostati e raccolti i cookies.</p><p> In caso di mancata accettazione dei cookies mediante abbandono della navigazione, eventuali cookies già registrati localmente nel dispositivo dell’utente rimarranno ivi registrati (fatte salve eventuali cancellazioni effettuate dal browser del terminale dell’utente o con modalità simili) ma non saranno più letti né utilizzati fino ad una successiva ed eventuale accettazione della Cookie Policy.</p><p> L’applicazione ricorda la scelta effettuata dall’utente, pertanto l’informativa breve non verrà riproposta nei collegamenti successivi dallo stesso dispositivo. Tuttavia, l’utente ha sempre la possibilità di revocare in tutto o in parte il consenso già espresso.</p><p> Qualora si riscontrassero problemi di natura tecnica legati alla prestazione del consenso, l’utente è pregato di contattare il Titolare del trattamento tramite gli appositi canali indicati sul sito.</p>';

            $output .= '<p>'.$eazy_company_start_date_cookie.'</p>';
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

    return $output;
}
?>
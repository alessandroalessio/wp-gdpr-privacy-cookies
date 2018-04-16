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
                    <td>&nbsp;</td>
                    <td><?php submit_button(); ?></td>
                </tr>
            </table>
        </form>
	</div>
    <?php
}

/**
 * Undocumented function
 *
 * @param [type] $atts
 * @return void
 */
add_shortcode('eazylegalprivacy', 'eazy_legal_ouput_privacy');
function eazy_legal_ouput_privacy($atts) {

    // Customize Ouput
    extract(shortcode_atts(array(
        'lang' => 'it',
        'cookie_url' => '/it/cookies/'
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
            $output = '<p>{eazy_company_name} con sede in {eazy_company_headquarters}, in qualità di Titolare del trattamento dei dati personali ai sensi del GDPR UE 679/2016 Regolamento Generale sulla Protezione dei Dati riconosce l’importanza della protezione dei dati personali e considera la sua tutela uno degli obiettivi principali della propria attività.</p><p> Prima di comunicare qualsiasi dato personale,{eazy_company_name} Vi invita a leggere con attenzione la presente privacy policy, poiché contiene informazioni importanti sulla tutela dei dati personali e sulle misure di sicurezza adottate per garantirne la riservatezza nel pieno rispetto del GDPR e:</p><p> - si intende resa solo per il sito {eazy_http_host}(“Sito”) mentre non si applica ad altri siti web eventualmente consultati tramite link esterni;</p><p> - è da intendersi quale Informativa resa ai sensi dell’art. 13 del GDPR a coloro che interagiscono con il Sito;</p><p> - si conforma alla Raccomandazione n. 2/2001 relativa ai requisiti minimi per la raccolta di dati on-line nell’Unione Europea, adottata il 17 maggio 2001 dal Gruppo di Lavoro Articolo 29.</p><p>{eazy_company_name} Vi informa che il trattamento dei Vostri dati personali sarà improntato ai principi di liceità, correttezza, trasparenza, limitazione delle finalità e della conservazione, minimizzazione dei dati, esattezza, integrità e riservatezza. I Vostri dati personali verranno pertanto trattati in accordo alle disposizioni legislative del GDPR e degli obblighi di riservatezza ivi previsti.</p><p> <strong> INDICE <br/> </strong> La presente Privacy Policy è composta dalle seguenti voci:</p><p> 1. TITOLARE DEL TRATTAMENTO</p><p> 2. I DATI PERSONALI OGGETTO DI TRATTAMENTO</p><p> a. Dati di navigazione</p><p> b. Dati forniti volontariamente</p><p> c. Cookie e tecnologie affini</p><p> 3. FINALITA’, BASE GIURIDICA E NATURA OBBLIGATORIA O FACOLTATIVA DEL TRATTAMENTO</p><p> 4. DESTINATARI</p><p> 5. TRASFERIMENTI</p><p> 6. CONSERVAZIONE DEI DATI</p><p> 7. I DIRITTI DELL’INTERESSATO</p><p> 8. MODIFICHE</p><p> <strong></strong></p><p> <strong>1. TITOLARE DEL TRATTAMENTO</strong></p><p> Il Titolare del trattamento del Sito è {eazy_company_name} con sede legale in via {eazy_company_address}, contattabile all’indirizzo e-mail {eazy_company_email} oppure al numero di telefono {eazy_company_phone} o scrivendo a {eazy_company_name} via {eazy_company_address} per qualunque informazione inerente il trattamento dei dati.</p><p> <strong>2. I DATI PERSONALI OGGETTO DI TRATTAMENTO</strong></p><p> Per “Dati Personali” si intende qualsiasi informazione riguardante una persona fisica identificata o identificabile con particolare riferimento a un identificativo come il nome, un numero di identificazione, dati relativi all’ubicazione, un identificativo online o a uno o più elementi caratteristici della sua identità fisica, fisiologica, psichica, economica, culturale o sociale.</p><p> I Dati Personali raccolti dal Sito sono i seguenti:</p><p> <strong>a. Dati di navigazione</strong></p><p> I sistemi informatici del Sito raccolgono alcuni Dati Personali la cui trasmissione è implicita nell’uso dei protocolli di comunicazione di Internet. Si tratta di informazioni che non sono raccolte per essere associate a te, ma che per loro stessa natura potrebbero, attraverso elaborazioni ed associazioni con dati detenuti da terzi, permettere di identificarti. Tra questi ci sono gli indirizzi IP o i nomi a dominio dei dispositivi utilizzati per connetterti al Sito, gli indirizzi in notazione URI (Uniform Resource Identifier) delle risorse richieste, l’orario della richiesta, il metodo utilizzato nel sottoporre la richiesta al server, la dimensione del file ottenuto in risposta, il codice numerico indicante lo stato della risposta data dal server (buon fine, errore, ecc.) ed altri parametri relativi al tuo sistema operativo e ambiente informatico.</p>';
            
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
    $eazy_company_email = get_option( 'eazy_company_email' );
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
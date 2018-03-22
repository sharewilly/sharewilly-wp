<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://muennecke-vollmers.de
 * @since      1.0.1
 *
 * @package    Sharewilly_Wp
 * @subpackage Sharewilly_Wp/public/partials
 * 
 * Copyright (c) 2017 Münnecke & Vollmers GbR | widilo® - Eine Marke der Münnecke & Vollmers GbR
 *
 */
 
?>
	<style>
	@import url('https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900');

	h1.sw-options {
		font-size: 3em;
		line-height: 1.1em;
		font-family:"Roboto Condensed", sans-serif;
		font-weight:900;
	}

	li.myli {
    padding-left: 1.28571429em;
    text-indent: -1.28571429em;
}
	div.ulli {
    position: relative;
	display: inline-block;

}
	</style>

	<!-- Our form wraper -->
	<div class="wrap" style="background: #fff; padding:30px; width:60%;">
			<img style="display: inline-block; float: left; margin-bottom: 10px;" src="http://localhost/wordpress/taskwilly/plugins/sharewilly-wp/public/images/sharewilly-promotion-badge.png" width="100%" height="auto" />
		<p>Ein kostenfreies WordPress-Plugin der <a href="http://muennecke-vollmers.de" target="_blank">Münnecke & Vollmers GbR.</a> Wir wünschen dir viel Spass mit Sharewilly WP!</p>
		<form method="post" action="options.php">
            <?php
                settings_fields( 'sharewilly_fields' );
                do_settings_sections( 'sharewilly_fields' );
                submit_button();
            ?>
		</form>
		<p style="margin: 0 0 25px 0;">Wenn du nicht weiter kommst: <a href="https://sharewilly.github.io/sharewilly/">Sharewilly WP FAQ / Hilfe</a> | Support: <a href="http://muennecke-vollmers.de/kontakt/">Sende uns eine E-Mail mit deinem Anliegen</a></p>
		<code style="font-size: 12px; margin-top: 15px;"> © 2018 <a href="http://muennecke-vollmers.de" target="_blank">Münnecke & Vollmers GbR</a> | widilo® - Eine Marke der Münnecke & Vollmers GbR</code>
	</div> 
	
	<!-- Notice "Settings saved" -->
	<?php if( isset($_GET['settings-updated']) ) { ?>
		<div id="message" class="updated">
			<p><strong><?php _e('Settings saved.') ?></strong></p>
		</div>
	<?php } ?>
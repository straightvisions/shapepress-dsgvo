<?php

function SPDSGVODownloadMyDataShortcode($atts){

    $firstName = '';
    $lastName  = '';
    $email     = '';
    if(is_user_logged_in()){
        $firstName = wp_get_current_user()->user_firstname;
        $lastName  = wp_get_current_user()->user_lastname;
		$email     = wp_get_current_user()->user_email;
    }      

    ob_start();
    ?>  
        <?php if(isset($_REQUEST['result']) && $_REQUEST['result'] === 'success'): ?>

            <p>Ihr Antrag wurde eingereicht. <br> Sie erhalten eine Email von uns mit einem aktuellen Auszug Ihrer bei uns gespeicherten Daten.</p>

        <?php else: ?>
            <form method="post" action="<?= SPDSGVOSubjectAccessRequestAction::url() ?>" class="sp-dsgvo-framework">
                <fieldset>

                	<div class="row">
                		<div class="column">
                			<label for="email-field">Vorname</label>
    		                <input required type="text" id="first-name-field" name="first_name" value="<?= $firstName ?>" placeholder="Vorname" spellcheck="false" />
                		</div>

                		<div class="column">
                			<label for="email-field">Nachname</label>
    		                <input required type="text" id="last-name-field" name="last_name" value="<?= $lastName ?>" placeholder="Nachname" spellcheck="false" />
                		</div>
                	</div>

                    <div class="row">
						<div class="column">
                    		<label for="email-field">Email</label>
                   			 <input required type="email" id="email-field" name="email" value="<?= $email ?>" placeholder="Email" spellcheck="false" />
						</div>
                    </div>
                    <div class="row">
						<div class="column">
                    		<label for="dsgvo-checkbox">
                   			 	<input required type="checkbox" id="dsgvo-checkbox" name="dsgvo_checkbox" value="1" />
                   			 	<span style="font-weight:normal"><?= convDeChars(SPDSGVOSettings::get('sar_dsgvo_accepted_text'));  ?></span>
                   			 </label>
						</div>
                    </div>
                    <br>
                    <input type="submit" value="Anfrage absenden" />
                </fieldset>
            </form>
        <?php endif; ?>
    <?php

    return ob_get_clean();
}

add_shortcode('subject_access_request', 'SPDSGVODownloadMyDataShortcode');
add_shortcode('sar_form', 'SPDSGVODownloadMyDataShortcode');
add_shortcode('SAR', 'SPDSGVODownloadMyDataShortcode');
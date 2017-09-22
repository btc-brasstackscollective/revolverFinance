<?php
/**
 * Developer: Doug Ingalls
 * Project: Revolver Financial
 */
// Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);

?>
<?php
function plugin_admin_page()
{
    ?>
    <div id="wrapper" class="application-form-container">
        <h2>Application Form Plugin</h2><br>
    
		<a href="?page=review_applications">Review Applications</a><br/>
		<a href="?page=application_form_settings">Settings</a>
    </div>
<?php
}
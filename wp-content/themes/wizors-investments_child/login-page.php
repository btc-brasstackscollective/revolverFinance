<?php
/**
 * The template to display the Loan Application Login/Register page
 *
 * @package WordPress
 * @subpackage WIZORS_INVESTMENTS
 * @since WIZORS_INVESTMENTS 1.0
 */
 
/*
Template Name: Loan Application Login/Register 
*/

require_once('includes/passwordLib.php');

function isUser()
{
    global $wpdb;
    $userTbl = $wpdb->prefix ."application_user";
    $userCheck = false;
	
	$values = $_POST['loginForm'];
    $userEmail = $values['email'];
    $userPassword = $values['password'];
    
    $password = $wpdb->get_var("SELECT user_password FROM ".$userTbl." WHERE ".$userTbl.".user_email='" . $userEmail ."' AND ".$userTbl.".user_status='1'");
    
    if(password_verify($userPassword, $password))
	    $userCheck = true;
    	
    if($userCheck)
    	$_SESSION['loan_application_user_id'] = $wpdb->get_var("SELECT id
    FROM ".$userTbl." WHERE ".$userTbl.".user_email='" . $userEmail ."' AND ".$userTbl.".user_status='1'");
    
    return $userCheck;
}

function checkUserExists($userEmail)
{
	global $wpdb;
    $userTbl = $wpdb->prefix ."application_user";
    
    $userCheck = $wpdb->get_var("SELECT COUNT(*)
    FROM ".$userTbl." WHERE ".$userTbl.".user_email='" . $userEmail ."'");
    
    return $userCheck;
}

if(isUser() && $_SESSION['loggedIn'])
{
	// Redirect to "Loan Application" page
	header("Location: /loan-application");
	exit;
}

function saveLoanApplication()
{
	// Redirect to "Loan Application Data Saved Success" page
	header("Location: /loan-application?save_application=true");
	exit;
}

// Redirected From the Loan Application page :: Save POST form data
if(isset($_POST['application_form_borrowers_name']))
{
	// Store Loan Application Data (for "Save for Later" feature)
	$_SESSION['loan-application-data'] = $_POST;
}

// Login Page
else if(isset($_POST['loginForm']))
{
	
	if(isUser())
	{
		//if(isset($_REQUEST['save_application']) && $_REQUEST['save_application'] == true)
		//{
			// Save Loan Application
			//saveLoanApplication();
		//}
		
		//else
		//{
			//$_SESSION['loggedIn'] = true;
			
			// Redirect to "Loan Application Data Saved Success" page
			//header("Location: /user-settings");
			//exit;
		//}
		
		$_SESSION['loggedIn'] = true;
		
		// After user logs in, then redirect to the Loan Application
		header("Location: /loan-application");
		exit;
	}
	
	// If Login attempt failed, render error message
	else
	{
		?>
			<style type="text/css">
				#application_login_not_user_error {
					display:block !important;
				}
			</style>
		<?php
	}
}

// Register Page
else if(isset($_POST['registerForm']))
{
	$registerValues = $_POST['registerForm'];
	
	// if user does NOT exist already in the DB
	if(!checkUserExists($registerValues['email']))
	{
		global $wpdb;
		$userTbl = $wpdb->prefix ."application_user";
    
		$userValues = $_POST['registerForm'];
    
		$userEmail = $userValues['email'];
		$userPassword = password_hash($userValues['password'], PASSWORD_DEFAULT);
		$userFirstName = $userValues['firstname'];
		$userLastName = $userValues['lastname'];
		$userType = "user";
    
		$applicationUserCol = 'SELECT COLUMN_NAME, EXTRA FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = "'.$wpdb->dbname.'" AND TABLE_NAME ="'.$userTbl.'"';
		$applicationUserColumnNames_run_qry = $wpdb->get_results($applicationUserCol);

		$applicationUserColumnNames = array();
		
		// Loop through Application Forms Table and collect all of the columns that are not "AUTO_INCREMENT"
		foreach($applicationUserColumnNames_run_qry as $row)
		{
			if($row->EXTRA != 'auto_increment')
				$applicationUserColumnNames[] = $row->COLUMN_NAME;
		}
		
		$db_cols_implode = implode(',', $applicationUserColumnNames);
		$values = array('"'.$userEmail.'"','"'.$userPassword.'"','"'.$userFirstName.'"','"'.$userLastName.'"','1', '"'.$userType.'"');
        $values_implode = implode(',', $values);
        
		// Save Loan Application Form to the DB
		$wpdb->query('INSERT INTO ' . $userTbl . ' (' . $db_cols_implode . ') ' . 'VALUES (' . $values_implode.  ')');
		
		$_SESSION['loan_application_user_id'] = $wpdb->insert_id;
		$_SESSION['loggedIn'] = true;
		
		//if(isset($_REQUEST['save_application']) && $_REQUEST['save_application'] == true)
		//{
			// Save Loan Application
			//saveLoanApplication();
		//}
		
		//else
		//{
			// Redirect to "Loan Application Data Saved Success" page
			//header("Location: /user-settings");
			//exit;
		//}
		
		// After user registers, then redirect to the Loan Application
		header("Location: /loan-application");
		exit;
	}
	
	// if the user exists already, render error message
	else
	{
		?>
			<style type="text/css">
				#application_register_user_exists_error {
					display:block !important;
				}
			</style>
		<?php
	}
}

get_header();

while ( have_posts() ) { the_post();

	get_template_part( 'content', 'page' );

	// If comments are open or we have at least one comment, load up the comment template.
	if ( !is_front_page() && ( comments_open() || get_comments_number() ) ) {
		comments_template();
	}
}

get_footer();
?>
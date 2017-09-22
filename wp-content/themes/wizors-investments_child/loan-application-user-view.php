<?php
/**
 * The template to display the Loan Application User View
 *
 * @package WordPress
 * @subpackage WIZORS_INVESTMENTS
 * @since WIZORS_INVESTMENTS 1.0
 */
 
/*
Template Name: Loan Application User View
*/

session_start();

get_header();

// Show list of Loan Applications for the Logged in User
function tl_get_applications_for_user() {
    global $wpdb;
    $applicationFormTable = $wpdb->prefix ."application_forms";
    $applicationFormUserTable = $wpdb->prefix ."application_form_user";
    
    $userID = $_SESSION['loan_application_user_id'];
    
    $applicationForms = $wpdb->get_results("SELECT ".$applicationFormTable.".form_id, ".$applicationFormTable.".borrower_application_path, ".$applicationFormTable.".application_status, ".$applicationFormTable.".date_created, ".$applicationFormTable.".date_modified
    FROM ".$applicationFormTable."
    JOIN ".$applicationFormUserTable." ON ".$applicationFormUserTable.".application_id = ".$applicationFormTable.".form_id
    WHERE ".$applicationFormUserTable.".user_id='".$userID."'
    ORDER BY ".$applicationFormTable.".date_created ASC");
    
    return $applicationForms;
}

if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true)
{
	global $wpdb;
    $applicationFormUserTable = $wpdb->prefix ."application_form_user";
    
    $userID = $_SESSION['loan_application_user_id'];
    
    $rowcount = $wpdb->get_var('SELECT COUNT(*) FROM '.$applicationFormUserTable.' WHERE '.$applicationFormUserTable.'.user_id="'. $userID .'"');
    
    $userTbl = $wpdb->prefix ."application_user";
	$userName = $wpdb->get_results("SELECT ".$userTbl.".user_firstname, ".$userTbl.".user_lastname
    FROM ".$userTbl." WHERE ".$userTbl.".id='" .$userID. "'");

    ?>

    <div class="wrap">
        <div class="icon32" id="icon-edit"><br></div>
        <h2><?php _e('Loan Applications'); echo " for ".$userName[0]->user_firstname." ".$userName[0]->user_lastname; ?></h2>
        <form method="post" action="" id="tl_form_action">
            <table class="widefat page fixed" cellpadding="0" width="100%">
                <thead>
                <tr>
                    <th id="cb" class="manage-column column-cb check-column" style="" scope="col">
                    </th>
                    <th class="manage-column"><?php _e("Application Form")?></th>
                    <th class="manage-column"><?php _e("Status")?></th>
                    <th class="manage-column"><?php _e("Date Created")?></th>
                    <th class="manage-column"><?php _e("Date Modified")?></th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th id="cb" class="manage-column column-cb check-column" style="" scope="col">
                    </th>
                    <th class="manage-column"></th>
                    <th class="manage-column"></th>
                    <th class="manage-column"></th>
                    <th class="manage-column">Total Records: <?php echo $rowcount;?></th>
                </tr>
                </tfoot>
                <tbody>

                <?php
                $table = tl_get_applications_for_user();
                
                if($table)
                {
                    $i=0;
                    foreach($table as $applicationForm)
                    {
                        $i++;
                        ?>
                        <tr class="<?php echo (ceil($i/2) == ($i/2)) ? "" : "alternate"; ?>">
                            <th class="check-column" scope="row"><?php echo $i; ?></th>
                            <td><a href="/loan-application?view=<?php echo $applicationForm->form_id?>" target="_blank">View Application</a></td>
                            <td><?php echo $applicationForm->application_status?></td>
                            <td><?php echo $applicationForm->date_created?></td>
                            <td><?php echo $applicationForm->date_modified?></td>
                        </tr>
                        <?php
                    }
                }
                else
                {
                    ?>
                    <tr><td colspan="4"><?php _e('No Records Found.')?></td></tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </form>
    </div>
    
    <?php
}

//not logged in : redirect to homepage
else
{
	header("Location: /test");
	exit;
}

while ( have_posts() ) { the_post();

	get_template_part( 'content', 'page' );

	// If comments are open or we have at least one comment, load up the comment template.
	if ( !is_front_page() && ( comments_open() || get_comments_number() ) ) {
		comments_template();
	}
}

get_footer();
?>
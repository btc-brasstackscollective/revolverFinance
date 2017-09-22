<?php
/**
 * Developer: Doug Ingalls
 * Project: Revolver Financial
 */

// Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);


function settings_config_page()
{
    tl_view_settings();
}

function tl_view_settings()
{
    global $wpdb;
    $applicationFormsTable = $wpdb->prefix . 'application_forms';
    $rowcount = $wpdb->get_var('SELECT COUNT(*) FROM '.$applicationFormsTable.' WHERE '.$applicationFormsTable.'.application_status="review"');
    ?>

    <div class="wrap">
        <div class="icon32" id="icon-edit"><br></div>
        <h2><?php _e('Applications For Review') ?></h2>
        <form method="post" action="" id="tl_form_action">
            <table class="widefat page fixed" cellpadding="0">
                <thead>
                <tr>
                    <th id="cb" class="manage-column column-cb check-column" style="" scope="col">
                    </th>
                    <th class="manage-column"><?php _e("Borrower's First Name")?></th>
                    <th class="manage-column"><?php _e("Borrower's Last Name")?></th>
                    <th class="manage-column"><?php _e("Application Form")?></th>
                    <th class="manage-column"><?php _e("Date Created")?></th>
                    <th class="manage-column"><?php _e("Date Modified")?></th>
                    <th class="manage-column"><?php _e("Date Reviewed")?></th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th id="cb" class="manage-column column-cb check-column" style="" scope="col">
                    </th>
                    <th class="manage-column"></th>
                    <th class="manage-column"></th>
                    <th class="manage-column"></th>
                    <th class="manage-column"></th>
                    <th class="manage-column"></th>
                    <th class="manage-column"><strong>Total Records:</strong> <?php echo $rowcount;?></th>
                </tr>
                </tfoot>
                <tbody>

                <?php
                $table = tl_get_applications_for_review();
                
                if($table)
                {
                    $i=0;
                    foreach($table as $applicationForm)
                    {
                        $i++;
                        ?>
                        <tr class="<?php echo (ceil($i/2) == ($i/2)) ? "" : "alternate"; ?>">
                            <th class="check-column" scope="row"></th>
                            <td><?php echo $applicationForm->first_name?></td>
                            <td><?php echo $applicationForm->last_name?></td>
                            <td><a href="<?php echo $applicationForm->borrower_application_path?>" target="_blank">Open Application</a></td>
                            <td><?php echo $applicationForm->date_created?></td>
                            <td><?php echo $applicationForm->date_modified?></td>
                            <td><?php echo $applicationForm->date_reviewed?></td>
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
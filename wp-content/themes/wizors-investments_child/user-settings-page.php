<?php
/**
 * The template to display the User Setting View
 *
 * @package WordPress
 * @subpackage WIZORS_INVESTMENTS
 * @since WIZORS_INVESTMENTS 1.0
 */
 
/*
Template Name: User Settings
*/

if(!isUser() || !isset($_SESSION['loggedIn']))
{
	// Redirect to "Login" page
	header("Location: /apply");
	exit;
}

get_header();

function isUser()
{
    global $wpdb;
    $userTbl = $wpdb->prefix ."application_user";
    
    $userID = $_SESSION['loan_application_user_id'];
    
    $userCheck = $wpdb->get_var("SELECT COUNT(*)
    FROM ".$userTbl." WHERE ".$userTbl.".id='" . $userID ."' AND ".$userTbl.".user_status='1'");
    
    return $userCheck;
}

function isUserAdmin()
{
    global $wpdb;
    $userTbl = $wpdb->prefix ."application_user";
    
    $userID = $_SESSION['loan_application_user_id'];
    
    $userCheck = $wpdb->get_var("SELECT COUNT(*)
    FROM ".$userTbl." WHERE ".$userTbl.".id='" . $userID ."' AND ".$userTbl.".user_status='1' AND ".$userTbl.".user_type='admin'");
    
    return $userCheck;
}

if(isUser() && $_SESSION['loggedIn'])
{
	// Admin View
	if(isUserAdmin())
		adminSettings();

	// User View
	else
		userSettings();
}

// Approve/Deny Loan Application
global $wpdb;
$applicationFormsTable = $wpdb->prefix ."application_forms";

$applicationFormDateModified = date('Y-m-d H:i:s');
    
if(isset($_POST['loan_application_approve']))
{
	$wpdb->query("UPDATE " .$applicationFormsTable. " SET ".$applicationFormsTable.".application_status = 'approved' WHERE ".$applicationFormsTable.".form_id='" .$_POST['loan_application_form_id'] ."'");
	
	$wpdb->query("UPDATE " .$applicationFormsTable. " SET ".$applicationFormsTable.".date_modified = '". $applicationFormDateModified ."' WHERE ".$applicationFormsTable.".form_id='" .$_POST['loan_application_form_id'] ."'");
}

else if(isset($_POST['loan_application_decline']))
{
	$wpdb->query("UPDATE " .$applicationFormsTable. " SET ".$applicationFormsTable.".application_status = 'declined' WHERE ".$applicationFormsTable.".form_id='" .$_POST['loan_application_form_id'] ."'");
	
	$wpdb->query("UPDATE " .$applicationFormsTable. " SET ".$applicationFormsTable.".date_modified = '". $applicationFormDateModified ."' WHERE ".$applicationFormsTable.".form_id='" .$_POST['loan_application_form_id'] ."'");
}

function adminSettings()
{
	if(isset($_REQUEST['review']))
	{
		?>
			<script type="text/javascript">
				jQuery(function() {
					jQuery('#review_loan_application_container').removeClass('hidden').css('border', 'solid 1px red');
					jQuery('#review_loan_application_container').attr('style','display: block !important');
				});
				
				//document.getElementById('review_loan_application_container').classList.remove('hidden');
			</script>
		<?php	
	}
	
	?>
		<div class="user_settings_container col-xs-12">
			<div class="col-xs-2 nav_panel_container">
				<!-- <a href="" class="" data-trigger="user_container">Users</a> -->
				<a href="" class="" data-trigger="all_loan_application_container">All Loan Applications</a>
				<a href="" class="" data-trigger="review_loan_application_container">Loan Applications for Review</a>
			</div>
			
			<div class="col-xs-10 content_settings_container">
				<!-- <div id="user-container">
					
				</div> -->
				
				<div id="all_loan_application_container">
					<?php
						global $wpdb;
					    $applicationFormsTable = $wpdb->prefix ."application_forms";
					    
					    $applicationForms = $wpdb->get_results("SELECT ".$applicationFormsTable.".form_id, ".$applicationFormsTable.".borrower_application_path, 
					    ".$applicationFormsTable.".borrowers_name, ".$applicationFormsTable.".application_status, ".$applicationFormsTable.".date_created, ".$applicationFormsTable.".date_modified, ".$applicationFormsTable.".date_reviewed
					    FROM ".$applicationFormsTable."
					    ORDER BY ".$applicationFormsTable.".date_created ASC");
					    
					    $rowcount = $wpdb->get_var('SELECT COUNT(*) FROM '.$applicationFormsTable.' WHERE '.$applicationFormsTable.'.application_status="submitted"');
					    
					    if($rowcount > 0)
					    {
					?>
							<div class="header_row_container col-xs-12">
								<div class="header_row col-xs-3">Borrower's Name</div>
								<div class="header_row col-xs-3">Application Form</div>
								<div class="header_row col-xs-2">Date Created</div>
								<div class="header_row col-xs-2">Date Modified</div>
								<div class="header_row col-xs-2">Date Reviewed</div>
							</div>
							
						<?php
							if($applicationForms)
							{
								$i=0;
								
			                    foreach($applicationForms as $applicationForm)
			                    {
			                        $i++;
			            ?>
			                        <div class="col-xs-12 <?php echo (ceil($i/2) == ($i/2)) ? "alternate" : ""; ?>">
			                            <div class="col-xs-3"><?php echo $applicationForm->borrowers_name?></div>
			                            <div class="col-xs-3"><a href="?review=<?php echo $applicationForm->form_id?>" target="_blank">Review Application</a></div>
			                            <div class="col-xs-2"><?php echo $applicationForm->date_created?></div>
			                            <div class="col-xs-2"><?php echo $applicationForm->date_modified?></div>
			                            <div class="col-xs-2"><?php echo $applicationForm->date_reviewed?></div>
			                        </div>
			                        <?php
			                    }
							}
						}
					?>
				</div>
				
				<div id="review_loan_application_container" class="hidden">
				
					<?php
						global $wpdb;
					    $applicationFormsTable = $wpdb->prefix ."application_forms";
					
						$formID = $_REQUEST['review'];
					    
					    $applicationFormForReview = $wpdb->get_results("SELECT *
					    FROM ".$applicationFormsTable." WHERE ".$applicationFormsTable.".form_id='" .$formID. "'");
					    
					    $applicationItem = $applicationFormForReview[0];
					?>
	
						<div class="revolver_application_form">
							<form id="loan_application_form" method="post" action="/">
								<!-- Section 1 -->
								<div class="application_form_section_header col-xs-12">Section 1 - Loan Overview</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Borrower's Name:</label>
									<span><?php echo $applicationItem->borrowers_name;?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<div class="no_gutter col-xs-12">
										<label for="">Loan Amount: (90%)</label>
										<span><?php echo $applicationItem->loan_amount; ?></span>
									</div>
									
									<div class="no_gutter col-xs-12">
										<label for="">Maturity Term: (e.x. 12 months)</label>
										<span><?php echo $applicationItem->maturity_term; ?></span>
									</div>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Exit Strategy:</label>
									<span><?php echo $applicationItem->exit_strategy; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Purchase/Refinance:</label>
									<span><?php echo $applicationItem->purchase_refinance; ?></span>
								</div>
								
								<!-- Section 2 -->
								<div class="application_form_section_header col-xs-12">Section 2 - Property</div>
								
								<div class="col-sm-6 col-xs-12">
									<label for="">Address:</label>
									<span><?php echo $applicationItem->address; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<div class="no_gutter col-xs-12">
										<label for="">Current "As-Is" Value:</label>
										<span><?php echo $applicationItem->as_is_value; ?></span>
									</div>
									
									<div class="no_gutter col-xs-12">
										<label for="">Purchase Price/Acquisition</label>
										<span><?php echo $applicationItem->purchase_price; ?></span>
									</div>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Property Type:</label>
									<span><?php echo $applicationItem->application_property_type; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">"As Completed" Value/ARV:</label>
									<span><?php echo $applicationItem->as_completed_value; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Units:</label>
									<span><?php echo $applicationItem->units_count; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Rehab Amount:</label>
									<span><?php echo $applicationItem->rehab_amount; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">EMD:</label>
									<span><?php echo $applicationItem->emd; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Contract Expiration.Acquisition Date:</label>
									<span><?php echo $applicationItem->contract_expiration; ?></span>
								</div>
								
								<!-- Seperator -->
								<div class="col-xs-12 application_form_seperator"></div>
								
								<div class="col-sm-6 col-xs-12">
									<label for="">Is this a distress sale (foreclosure, short sale auction)?</label>
									<span><?php echo $applicationItem->is_distress_sale; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Is there a contract assignment or situation where seller is not holding title?</label>
									<span><?php echo $applicationItem->is_contract_assignment; ?></span>
								</div>
								
								<!-- Seperator -->
								<div class="col-xs-12 application_form_seperator"></div>
								
								<div class="col-sm-6 col-xs-12">
									<label for="">Will this property be occupied at any time by any owner or guarantor?</label>
									<span><?php echo $applicationItem->occupied_at_any_time; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Are there any lawsuits outstanding against this property?</label>
									<span><?php echo $applicationItem->lawsuits_outstanding; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Is this property subject to any default or foreclosure proceedings?</label>
									<span><?php echo $applicationItem->foreclosure_proceedings; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Are there any known environmental issues?</label>
									<span><?php echo $applicationItem->environmental_issues; ?></span>
								</div>
								
								<!-- Section 3 -->
								<div class="application_form_section_header col-xs-12">Section 3 - Renovation and Construction</div>
								
								<div class="col-sm-6 col-xs-12">
									<label for="">Construction Budget:</label>
									<span><?php echo $applicationItem->construction_budget; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Will a licensed GC be used?</label>
									<span><?php echo $applicationItem->licensed_gc; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Months to Complete:</label>
									<span><?php echo $applicationItem->months_to_complete; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Is a building permit required?</label>
									<span><?php echo $applicationItem->building_permit_required; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Number of prior projects by borrower:</label>
									<span><?php echo $applicationItem->number_prior_projects; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Is the usage of the property changing?</label>
									<span><?php echo $applicationItem->property_usage_changing; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Number of draw requests expected:</label>
									<span><?php echo $applicationItem->draw_requests_expected; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Are any additions being made?</label>
									<span><?php echo $applicationItem->additions_made; ?></span>
								</div>
								<div class="footer_notes col-xs-12">
									<a href="http://www.revolverfinance.com">www.revolverfinance.com</a>
									<p>11/22/16</p>
								</div>
								
								<!-- Section 4 -->
								<div class="application_form_section_header col-xs-12">Section 4 - Individual Owner and Guarantor Info</div>
								
								<div class="application_form_section_sub_header col-xs-12">
									<div class="no_gutter col-xs-6">Guarantor 1</div>
									<div class="no_gutter col-xs-6">Guarantor 2</div>
								</div>
								
								<div class="col-sm-6 col-xs-12">
									<label for="">Name:</label>
									<span><?php echo $applicationItem->guarantor_1_name; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Name:</label>
									<span><?php echo $applicationItem->guarantor_2_name; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Ownership %:</label>
									<span><?php echo $applicationItem->guarantor_1_ownership_percentage; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Ownership %:</label>
									<span><?php echo $applicationItem->guarantor_2_ownership_percentage; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">SSN:</label>
									<span><?php echo $applicationItem->guarantor_1_ssn; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">SSN:</label>
									<span><?php echo $applicationItem->guarantor_2_ssn; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Drivers License #:</label>
									<span><?php echo $applicationItem->guarantor_1_drivers_license; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Drivers License #:</label>
									<span><?php echo $applicationItem->guarantor_2_drivers_license; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Date of Birth:</label>
									<span><?php echo $applicationItem->guarantor_1_date_of_birth; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Date of Birth:</label>
									<span><?php echo $applicationItem->guarantor_2_date_of_birth; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Present Address:</label>
									<span><?php echo $applicationItem->guarantor_1_address; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Present Address:</label>
									<span><?php echo $applicationItem->guarantor_2_address; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Owner/Renter:</label>
									<span><?php echo $applicationItem->guarantor_1_own_or_rent; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Owner/Renter:</label>
									<span><?php echo $applicationItem->guarantor_2_own_or_rent; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Phone:</label>
									<span><?php echo $applicationItem->guarantor_1_phone; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Phone:</label>
									<span><?php echo $applicationItem->guarantor_2_phone; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Email:</label>
									<span><?php echo $applicationItem->guarantor_1_email; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Email:</label>
									<span><?php echo $applicationItem->guarantor_2_email; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Liquid Assets ($):</label>
									<span><?php echo $applicationItem->guarantor_1_liquid_assets; ?></span>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label for="">Liquid Assets ($):</label>
									<span><?php echo $applicationItem->guarantor_2_liquid_assets; ?></span>
								</div>
								
								<div class="application_form_section_sub_header top_space col-xs-12">
									<div class="no_gutter col-xs-12 text-center">Experience</div>
								</div>
								
								<div class="col-xs-12 text-center">List most recent completed transactions (preferably the last 3 years) - Attached separate document if preffered</div>
								
								<div class="col-xs-2 text-center">Property Address</div>
								<div class="col-xs-2 text-center">Property Type</div>
								<div class="col-xs-1 text-center">Date Purchased</div>
								<div class="col-xs-1 text-center">Date Sold</div>
								<div class="col-xs-1 text-center">Acquisition Cost</div>
								<div class="col-xs-1 text-center">Rehab Cost</div>
								<div class="col-xs-2 text-center">Financing Source</div>
								<div class="col-xs-1 text-center">Sale Price</div>
								<div class="col-xs-1 text-center">Net Profit</div>
								
								<div class="col-xs-2 text-center">
									<span><?php echo $applicationItem->experience_property_address_1; ?></span>
								</div>
								<div class="col-xs-2 text-center">
									<span><?php echo $applicationItem->experience_property_type_1; ?></span>
								</div>
								<div class="col-xs-1 text-center">
									<span><?php echo $applicationItem->experience_date_purchased_1; ?></span>
								</div>
								<div class="col-xs-1 text-center">
									<span><?php echo $applicationItem->experience_date_sold_1; ?></span>
								</div>
								<div class="col-xs-1 text-center">
									<span><?php echo $applicationItem->experience_acquisition_cost_1; ?></span>
								</div>
								<div class="col-xs-1 text-center">
									<span><?php echo $applicationItem->experience_rehab_cost_1; ?></span>
								</div>
								<div class="col-xs-2 text-center">
									<span><?php echo $applicationItem->experience_financing_source_1; ?></span>
								</div>
								<div class="col-xs-1 text-center">
									<span><?php echo $applicationItem->experience_sale_price_1; ?></span>
								</div>
								<div class="col-xs-1 text-center">
									<span><?php echo $applicationItem->experience_net_profit_1; ?></span>
								</div>
								
								<div class="col-xs-2 text-center">
									<span><?php echo $applicationItem->experience_property_address_2; ?></span>
								</div>
								<div class="col-xs-2 text-center">
									<span><?php echo $applicationItem->experience_property_type_2; ?></span>
								</div>
								<div class="col-xs-1 text-center">
									<span><?php echo $applicationItem->experience_date_purchased_2; ?></span>
								</div>
								<div class="col-xs-1 text-center">
									<span><?php echo $applicationItem->experience_date_sold_2; ?></span>
								</div>
								<div class="col-xs-1 text-center">
									<span><?php echo $applicationItem->experience_acquisition_cost_2; ?></span>
								</div>
								<div class="col-xs-1 text-center">
									<span><?php echo $applicationItem->experience_rehab_cost_2; ?></span>
								</div>
								<div class="col-xs-2 text-center">
									<span><?php echo $applicationItem->experience_financing_source_2; ?></span>
								</div>
								<div class="col-xs-1 text-center">
									<span><?php echo $applicationItem->experience_sale_price_2; ?></span>
								</div>
								<div class="col-xs-1 text-center">
									<span><?php echo $applicationItem->experience_net_profit_2; ?></span>
								</div>
								
								<div class="col-xs-2 text-center">
									<span><?php echo $applicationItem->experience_property_address_3; ?></span>
								</div>
								<div class="col-xs-2 text-center">
									<span><?php echo $applicationItem->experience_property_type_3; ?></span>
								</div>
								<div class="col-xs-1 text-center">
									<span><?php echo $applicationItem->experience_date_purchased_3; ?></span>
								</div>
								<div class="col-xs-1 text-center">
									<span><?php echo $applicationItem->experience_date_sold_3; ?></span>
								</div>
								<div class="col-xs-1 text-center">
									<span><?php echo $applicationItem->experience_acquisition_cost_3; ?></span>
								</div>
								<div class="col-xs-1 text-center">
									<span><?php echo $applicationItem-experience_rehab_cost_3; ?></span>
								</div>
								<div class="col-xs-2 text-center">
									<span><?php echo $applicationItem->experience_financing_source_3; ?></span>
								</div>
								<div class="col-xs-1 text-center">
									<span><?php echo $applicationItem->experience_sale_price_3; ?></span>
								</div>
								<div class="col-xs-1 text-center">
									<span><?php echo $applicationItem->experience_net_profit_3; ?></span>
								</div>
								
								<div class="col-xs-2 text-center">
									<span><?php echo $applicationItem->experience_property_address_4; ?></span>
								</div>
								<div class="col-xs-2 text-center">
									<span><?php echo $applicationItem->experience_property_type_4; ?></span>
								</div>
								<div class="col-xs-1 text-center">
									<span><?php echo $applicationItem->experience_date_purchased_4; ?></span>
								</div>
								<div class="col-xs-1 text-center">
									<span><?php echo $applicationItem->experience_date_sold_4; ?></span>
								</div>
								<div class="col-xs-1 text-center">
									<span><?php echo $applicationItem->experience_acquisition_cost_4; ?></span>
								</div>
								<div class="col-xs-1 text-center">
									<span><?php echo $applicationItem->experience_rehab_cost_4; ?></span>
								</div>
								<div class="col-xs-2 text-center">
									<span><?php echo $applicationItem->experience_financing_source_4; ?></span>
								</div>
								<div class="col-xs-1 text-center">
									<span><?php echo $applicationItem->experience_sale_price_4; ?></span>
								</div>
								<div class="col-xs-1 text-center">
									<span><?php echo $applicationItem->experience_net_profit_4; ?></span>
								</div>
								
								<div class="footer_notes col-xs-12">
									<a href="http://www.revolverfinance.com">www.revolverfinance.com</a>
								</div>
								
								<div class="application_form_section_sub_header top_space col-xs-12">
									<div class="no_gutter col-xs-12 text-center">Declarations</div>
								</div>
								
								<div class="col-xs-12">
									<label for="application_form_convicted_crime">Have you even been convicted of, or plead guilty, to a criminal offense?</label>
									<span><?php echo $applicationItem->declaration_convicted_of_crime; ?></span>
								</div>
								
								<div class="col-xs-12">
									<label for="application_form_outstanding_judgement">Are there any outstanding judgement or lawsuits against you, the borrowing entity or any entity in which you are the principal?</label>
									<span><?php echo $applicationItem->declaration_outstanding_judgement; ?></span>
								</div>
								
								<div class="col-xs-12">
									<label for="application_form_litigation_defendant">Have you, the borrowing entity or any entity in which you are the principal been named as a defendant in any litigation within the past ten years?</label>
									<span><?php echo $applicationItem->declaration_litigation_defendant; ?></span>
								</div>
								
								<div class="col-xs-12">
									<label for="application_form_property_foreclosed">Have you, the borrowing entity or any entity in which you are the principal had a property foreclosed upon or given title or deed in lieu thereof in the past ten years?</label>
									<span><?php echo $applicationItem->declaration_property_foreclosed; ?></span>
								</div>
								
								<div class="col-xs-12">
									<label for="application_form_loan_delinquent">Have you, the borrowing entity or any entity in which you are the principal presently delinquent or in default on any loan, financial obligation, bond or loan guarantee?</label>
									<span><?php echo $applicationItem->declaration_delinquent_loan; ?></span>
								</div>
								
								<div class="col-xs-12">
									<label for="application_form_bankruptcy">Have you, the borrowing entity or any entity in which you are the principal filed for bankruptcy in the past ten years?</label>
									<span><?php echo $applicationItem->declaration_bankruptcy; ?></span>
								</div>
								
								<div class="col-xs-12">
									<label for="application_form_potential_litigation">Are you aware of any potential litigation involving the borrowing entity or the collateral property?</label>
									<span><?php echo $applicationItem->declaration_potential_litigation_collateral_property; ?></span>
								</div>
								
								<div class="col-xs-12">
									<label for="application_form_tax_returns_contested">Are any tax returns of yours, the borrowing entity or any entity in which you are the principal currently being contested?</label>
									<span><?php echo $applicationItem->declaration_contested_tax_returns; ?></span>
								</div>
								
								<div class="col-xs-12">
									<label for="application_form_us_citizen">Are you a US Citizen?</label>
									<span><?php echo $applicationItem->declaration_us_citizen; ?></span>
								</div>
								
								<div class="col-xs-12">
									<label for="application_form_resident_alien">Are you a permanent resident alien?</label>
									<span><?php echo $applicationItem->declaration_permanent_resident_alien; ?></span>
								</div>
								
								<!-- Section 5 -->
								<div class="application_form_section_header col-xs-12">Section 5 - Disclosures and Acknowledgment</div>
								
								<div class="col-xs-12">
									<p>It's a crime to knowingly falsify information on this application<br/>Each of the undersigned specifically represents to Revolver Finance , LLC and to Revolver's  potential agents, affiliates, subsidiaries, brokers, processors, attorneys,insurers, servicers, successors and assigns and agrees and acknowledges that: (1) the information provided in this application and its associated addenda is true and correct as of the date set forth opposite my signature and that any intentional or negligent misrepresentation of this information contained in this
				application may result in civil liability, including monetary damages, to any person who may suffer any loss due to reliance upon any misrepresentation that I
				have made on this application or its addenda, and/or in criminal penalties including, but not limited to, fine or imprisonment or both under provisions of Title
				18, United States Code, Sec. 1001, et seq; (2) the loan requested pursuant to this application (the “Loan”) will be secured by a mortgage or deed of trust on
				the property described in this application; (3) the collateral property will not be used for any illegal or prohibited purpose or use; (4) all statements made in
				this application are made for the purpose of obtaining a mortgage loan; (5) the collateral property will be used for the purposes indicated in this application;
				(6) Revolver, its servicers, successors or assigns may retain the original and/or an electronic record of this application, whether or not the loan is approved; (7)
				Revolver and its agents, brokers, insurers, servicers, successors, and assigns may continuously rely on the information contained in this application, and I am
				obligated to amend and/or supplement the information provided in this application if any of the material facts that I have represented herein should change
				prior to closing of the Loan; (8) in the event that my payments on the Loan become delinquent, Revolver, its servicers, successors or assigns may, in addition to
				any other rights and remedies that it may have relating to such delinquency, report my name and account information to one or more consumer reporting
				agencies; (9) ownership of the Loan and/or administration of the Loan account may be transferred with such notice as may be required by law; (10) neither
				Revolver nor its agents, brokers, insurers, servicers, successors or assigns has made any representation or warranty, express or implied, to me regarding the
				property or the condition or value of the property; and (11) my transmission of this application as an “electronic record” containing my “electronic
				signature,” as those terms are defined in applicable federal and/or state laws, or my facsimile transmission of this application containing a facsimile of my
				signature, shall be as effective, enforceable and valid as if a paper version of this application were delivered containing my original written signature.</p>
				
									<p>Authorization to Obtain and Release Information<br/>The undersigned hereby understands and consents that, during the review of this loan request, Revolver Finance, LLC and/or its subsidiaries and affiliates will conduct due diligence and/or background investigations on the individuals listed in this application. By signing below, the undersigned expressly authorizes Revolver to gather financial, credit, background, reference, and other information for the purposes of reviewing this loan request. Additionally, the undersigned authorizes Revolver to share such information with affiliates or third parties as a matter of course during the due diligence process. In connection with any such due diligence, Revolver is authorized to disclose to affiliates and/or third parties any and all documents and information necessary to complete its investigations. Other than for the necessary business purposes of Revolver, all personal and/or non-public information of the undersigned will be treated by Revolver as strictly confidential and will not be shared with third parties.</p>
				
									<p>Credit Report Authorization<br/> I hereby authorize Revolver Finance, LLC and/or its subsidiaries and affiliates such as Lima One Capital to obtain a copy of my credit report from a credit reporting agency of Revolver's choice. I understand that Revolver Finance  intends to use the credit report to determine whether to extend credit to me and, if so, upon what terms. I understand that an inquiry will appear on my credit report as a result of this action. I authorize the credit reporting agency to use a copy of this form to request and obtain any information deemed necessary to complete my credit report and further authorize Revolver and all third parties to provide requested information to the credit reporting agency in the fulfillment of this loan application request.</p>
									
									<p>Business Purpose Affidavit<br/>The undersigned hereby specifically represent to Revolver that (1) no owner or guarantor will occupy this property as a residence and (2) this loan will be used primarily for business and commercial purposes and not for personal or consumer use.</p>
				
									<p>Notice of Prohibition Against Discrimination<br/>The Federal Equal Credit Opportunity Act prohibits lenders from discriminating against loan applicants on the basis of race, color, religion, national origin, sex, marital status, or age (provided the applicant has the legal capacity to enter into a binding contract); or because all or part of the applicant's income derives from any public assistance program; or because the applicant has in good faith exercised any right under the Consumer Credit Protection Act. The Federal Agency that administers compliance with this law concerning this Lender is the Federal Trade Commission, 225 Peachtree Street NE, Atlanta, GA 30303, 877-FTC-HELP, http://www.ftc.gov/about-ftc/bureaus-offices/regional-offices/southeast-region.</p>
				
									<p>Notice of Right to Receive Appraisal Report<br/>You have the right to receive a copy of any appraisal report obtained in connection with this application. If you would like to receive a copy, please write to us at PO Box 770040, Winter Garden, FL 34777. We must hear from you no later than 90 days after the date that we notify you of the action taken on your application or that you withdraw your application. In your letter, please provide your name and mailing address, as well as the address of the property on which the appraisal was performed. If you have not previously paid for the cost of the appraisal, you will be required to do so before your request is fulfilled.</p>
				
									<p>Please note that any appraisal we obtain in connection with this application will be solely for the purpose of assisting us in determining whether to extend credit secured by the appraised property and, if so, upon what terms. Depending upon the amount and the nature of the loan requested among other factors,
				the appraisal may be conducted by a certified appraiser, a licensed appraiser, or someone who is neither licensed nor certified. The person performing the
				appraisal may be a Revolver employee or an independent contractor. The appraisal report should not be relied upon by you or anyone else to determine the
				value, description, or condition of the property. If you wish to obtain professional assistance in determining those matters, you should retain your own
				appraiser or other advisor.</p>
								</div>
								
								<div class="application_form_section_sub_header col-xs-12">
									<div class="col-xs-12 text-center">Signatures</div>
								</div>
								
								<div class="col-xs-12">
									<div class="no_gutter col-xs-6">
										<label for="">Guarantor 1:</label>
										<img src="<?php echo $applicationItem->guarantor_1_signature_pad_image_url; ?>" />
									</div>
									<div class="no_gutter col-xs-6">
										<label for="">Date:</label>
										<span><?php echo $applicationItem->guarantor_1_signature_date; ?></span>
									</div>
								</div>
								
								<div class="col-xs-12">
									<div class="no_gutter col-xs-6">
										<label for="">Guarantor 2:</label>
										<img src="<?php echo $applicationItem->guarantor_2_signature_pad_image_url; ?>" />
									</div>
									<div class="no_gutter col-xs-6">
										<label for="">Date:</label>
										<span><?php echo $applicationItem->guarantor_2_signature_date; ?></span>
									</div>
								</div>
								
								<div class="application_form_section_sub_header col-xs-12">
									<div class="col-xs-12 text-center">Financial Document Checklist</div>
								</div>
								
								<div class="col-xs-12">
									<p><strong>Bank Statements (personal and business) - 60 days</strong></p>
									<p><strong>Articles of Incorporation/Operating Agreement</strong></p>
									<p><strong>Personal Financial Statement (Included)</strong></p>
									<p><strong>Tax Returns (most recent year)</strong></p>
									<p><strong>Executed Purchase Contract (Deed if this is a refinance)</strong></p>
								</div>
								
								<div class="col-xs-12 text-center">
									<input type="hidden" value="<?php echo $applicationItem->form_id; ?>" name="loan_application_form_id" />
									<input type="submit" name="loan_application_approve" value="Approve" />
									<input type="submit" name="loan_application_decline" value="Decline" />
								</div>
							</form>
						</div>
			</div>
		</div>
	<?php
}

function userSettings()
{
	?>
		<div class="user_settings_container col-xs-12">
			<div class="col-xs-2 nav_panel_container">
				<!-- <a href="" class="" data-trigger="user_container">Users</a> -->
				<a href="" class="" data-trigger="all_loan_application_container">My Application(s)</a>
				<a href="/user-settings?loggedOut=true" class="nav_panel_logged_out">Log Out</a>
			</div>
			
			<div class="col-xs-10 content_settings_container">
				<!-- <div id="user-container">
					
				</div> -->
				
				<div id="all_loan_application_container">
					<?php
						global $wpdb;
					    $applicationFormTable = $wpdb->prefix ."application_forms";
					    $applicationFormUserTable = $wpdb->prefix ."application_form_user";
					    
					    $userID = $_SESSION['loan_application_user_id'];
					    
					    $applicationForms = $wpdb->get_results("SELECT ".$applicationFormTable.".form_id, ".$applicationFormTable.".borrower_application_path, ".$applicationFormTable.".borrowers_name, ".$applicationFormTable.".application_status, ".$applicationFormTable.".date_created, ".$applicationFormTable.".date_modified
    FROM ".$applicationFormTable."
    LEFT JOIN ".$applicationFormUserTable." ON ".$applicationFormUserTable.".application_id = ".$applicationFormTable.".form_id
    WHERE ".$applicationFormUserTable.".user_id='".$userID."'
    ORDER BY ".$applicationFormTable.".date_created ASC");
    
						$rowcount = $wpdb->get_var('SELECT COUNT(*) FROM '.$applicationFormUserTable.' WHERE '.$applicationFormUserTable.'.user_id="'. $userID .'"');
					    
					    if($rowcount > 0)
					    {
					?>
							<div class="header_row_container col-xs-12">
								<div class="header_row col-xs-3">Borrower's Name</div>
								<div class="header_row col-xs-3">Application Form</div>
								<div class="header_row col-xs-2">Date Created</div>
								<div class="header_row col-xs-2">Date Modified</div>
								<div class="header_row col-xs-2">Date Reviewed</div>
							</div>
							
						<?php
							if($applicationForms)
							{
								$i=0;
								
			                    foreach($applicationForms as $applicationForm)
			                    {
			                        $i++;
			            ?>
			                        <div class="col-xs-12 <?php echo (ceil($i/2) == ($i/2)) ? "alternate" : ""; ?>">
			                            <div class="col-xs-3"><?php echo $applicationForm->borrowers_name?></div>
			                            <div class="col-xs-3"><a href="/loan-application?view=<?php echo $applicationForm->form_id?>" target="_blank">Review Application</a></div>
			                            <div class="col-xs-2"><?php echo $applicationForm->date_created?></div>
			                            <div class="col-xs-2"><?php echo $applicationForm->date_modified?></div>
			                            <div class="col-xs-2"><?php echo $applicationForm->date_reviewed?></div>
			                        </div>
			                        <?php
			                    }
							}
						}
						
						else
						{
							?>
								<div class="col-xs-12">
									<p>You have no Loan Applications</p>
								</div>
							<?php
						}
					?>
				</div>
			</div>
		</div>
	<?php
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
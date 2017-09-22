<?php

session_start();

//Import PHPMailer classes into the global namespace
include('PHPMailer/PHPMailer.php');
include('PHPMailer/Exception.php');

use PHPMailer\PHPMailer;
use PHPMailer\Exception;

// 
if(isset($_REQUEST['save_application']) && $_REQUEST['save_application'] == true)
{
	// Store Loan Application Data (for "Save for Later" feature)
	$_SESSION['loan-application-data'] = $_POST;
	
	// User is logged in
	//if($_SESSION['loggedIn'] == true && isset($_SESSION['loan_application_user_id']))
	//{
		global $wpdb;
		$applicationFormTable = $wpdb->prefix ."application_forms";
		
		$applicationFormStatus = "saved";
		$applicationFormDateCreated = date('Y-m-d H:i:s');
		
		$applicationFormBorrowersName = $_SESSION['applicationItem']->borrowers_name;
		$applicationFormLoanAmount = $_SESSION['applicationItem']->loan_amount;
		$applicationFormMaturityTerm = $_SESSION['applicationItem']->maturity_term;
		$applicationFormExitStrategy = $_SESSION['applicationItem']->exit_strategy;
		$applicationFormPurchaseRefinance = $_SESSION['applicationItem']->purchase_refinance;
		$applicationFormAddress = $_SESSION['applicationItem']->address;
		$applicationFormCurrentValue = $_SESSION['applicationItem']->as_is_value;
		$applicationFormPurchasePrice = $_SESSION['applicationItem']->purchase_price;
		$applicationFormPropertyType = $_SESSION['applicationItem']->application_property_type;
		$applicationFormCompletedValue = $_SESSION['applicationItem']->as_completed_value;
		$applicationFormUnits = $_SESSION['applicationItem']->units_count;
		$applicationFormRehabAmount = $_SESSION['applicationItem']->rehab_amount;
		$applicationFormEMD = $_SESSION['applicationItem']->emd;
		$applicationFormContractExpirationDate = $_SESSION['applicationItem']->contract_expiration;
		$applicationFormIsDistressSale = $_SESSION['applicationItem']->is_distress_sale;
		$applicationFormIsContractAssignment = $_SESSION['applicationItem']->is_contract_assignment;
		$applicationFormOccupiedByOwner = $_SESSION['applicationItem']->occupied_at_any_time;
		$applicationFormLawsuitsOutstanding = $_SESSION['applicationItem']->lawsuits_outstanding;
		$applicationFormIsForeclosure = $_SESSION['applicationItem']->foreclosure_proceedings;
		$applicationFormEnvironmentalIssues = $_SESSION['applicationItem']->environmental_issues;
		$applicationFormConstructionBudget = $_SESSION['applicationItem']->construction_budget;
		$applicationFormLicensedGC = $_SESSION['applicationItem']->licensed_gc;
		$applicationFormMonthsToComplete = $_SESSION['applicationItem']->months_to_complete;
		$applicationFormBuildingPermit = $_SESSION['applicationItem']->building_permit_required;
		$applicationFormNumberOfProjects = $_SESSION['applicationItem']->number_prior_projects;
		$applicationFormUsageChanging = $_SESSION['applicationItem']->property_usage_changing;
		$applicationFormDrawRequestsExpected = $_SESSION['applicationItem']->draw_requests_expected;
		$applicationFormAdditionsBeingMade = $_SESSION['applicationItem']->additions_made;
		$applicationFormGuarantor1Name = $_SESSION['applicationItem']->guarantor_1_name;
		$applicationFormGuarantor1OwnershipPercentage = $_SESSION['applicationItem']->guarantor_1_ownership_percentage;
		$applicationFormGuarantor1SSN = $_SESSION['applicationItem']->guarantor_1_ssn;
		$applicationFormGuarantor1DriversLicense = $_SESSION['applicationItem']->guarantor_1_drivers_license;
		$applicationFormGuarantor1DateOfBirth = $_SESSION['applicationItem']->guarantor_1_date_of_birth;
		$applicationFormGuarantor1PresentAddress = $_SESSION['applicationItem']->guarantor_1_address;
		$applicationFormGuarantor1OwnRent = $_SESSION['applicationItem']->guarantor_1_own_or_rent;
		$applicationFormGuarantor1PhoneNumber = $_SESSION['applicationItem']->guarantor_1_phone;
		$applicationFormGuarantor1EmailAddress = $_SESSION['applicationItem']->guarantor_1_email;
		$applicationFormGuarantor1LiquidAssets = $_SESSION['applicationItem']->guarantor_1_liquid_assets;
		$applicationFormGuarantor2Name = $_SESSION['applicationItem']->guarantor_2_name;
		$applicationFormGuarantor2OwnershipPercentage = $_SESSION['applicationItem']->guarantor_2_ownership_percentage;
		$applicationFormGuarantor2SSN = $_SESSION['applicationItem']->guarantor_2_ssn;
		$applicationFormGuarantor2DriversLicense = $_SESSION['applicationItem']->guarantor_2_drivers_license;
		$applicationFormGuarantor2DateOfBirth = $_SESSION['applicationItem']->guarantor_2_date_of_birth;
		$applicationFormGuarantor2PresentAddress = $_SESSION['applicationItem']->guarantor_2_address;
		$applicationFormGuarantor2OwnRent = $_SESSION['applicationItem']->guarantor_2_own_or_rent;
		$applicationFormGuarantor2PhoneNumber = $_SESSION['applicationItem']->guarantor_2_phone;
		$applicationFormGuarantor2EmailAddress = $_SESSION['applicationItem']->guarantor_2_email;
		$applicationFormGuarantor2LiquidAssets = $_SESSION['applicationItem']->guarantor_2_liquid_assets;
		$applicationFormPropertyAddress1 = $_SESSION['applicationItem']->experience_property_address_1;
		$applicationFormPropertyAddress2 = $_SESSION['applicationItem']->experience_property_address_2;
		$applicationFormPropertyAddress3 = $_SESSION['applicationItem']->experience_property_address_3;
		$applicationFormPropertyAddress4 = $_SESSION['applicationItem']->experience_property_address_4;
		$applicationFormPropertyType1 = $_SESSION['applicationItem']->experience_property_type_1;
		$applicationFormPropertyType2 = $_SESSION['applicationItem']->experience_property_type_2;
		$applicationFormPropertyType3 = $_SESSION['applicationItem']->experience_property_type_3;
		$applicationFormPropertyType4 = $_SESSION['applicationItem']->experience_property_type_4;
		$applicationFormDatePurchased1 = $_SESSION['applicationItem']->experience_date_purchased_1;
		$applicationFormDatePurchased2 = $_SESSION['applicationItem']->experience_date_purchased_2;
		$applicationFormDatePurchased3 = $_SESSION['applicationItem']->experience_date_purchased_3;
		$applicationFormDatePurchased4 = $_SESSION['applicationItem']->experience_date_purchased_4;
		$applicationFormDateSold1 = $_SESSION['applicationItem']->experience_date_sold_1;
		$applicationFormDateSold2 = $_SESSION['applicationItem']->experience_date_sold_2;
		$applicationFormDateSold3 = $_SESSION['applicationItem']->experience_date_sold_3;
		$applicationFormDateSold4 = $_SESSION['applicationItem']->experience_date_sold_4;
		$applicationFormAcquisitionCost1 = $_SESSION['applicationItem']->experience_acquisition_cost_1;
		$applicationFormAcquisitionCost2 = $_SESSION['applicationItem']->experience_acquisition_cost_2;
		$applicationFormAcquisitionCost3 = $_SESSION['applicationItem']->experience_acquisition_cost_3;
		$applicationFormAcquisitionCost4 = $_SESSION['applicationItem']->experience_acquisition_cost_4;
		$applicationFormRehabCost1 = $_SESSION['applicationItem']->experience_rehab_cost_1;
		$applicationFormRehabCost2 = $_SESSION['applicationItem']->experience_rehab_cost_2;
		$applicationFormRehabCost3 = $_SESSION['applicationItem']->experience_rehab_cost_3;
		$applicationFormRehabCost4 = $_SESSION['applicationItem']->experience_rehab_cost_4;
		$applicationFormFinancingSource1 = $_SESSION['applicationItem']->experience_financing_source_1;
		$applicationFormFinancingSource2 = $_SESSION['applicationItem']->experience_financing_source_2;
		$applicationFormFinancingSource3 = $_SESSION['applicationItem']->experience_financing_source_3;
		$applicationFormFinancingSource4 = $_SESSION['applicationItem']->experience_financing_source_4;
		$applicationFormSalePrice1 = $_SESSION['applicationItem']->experience_sale_price_1;
		$applicationFormSalePrice2 = $_SESSION['applicationItem']->experience_sale_price_2;
		$applicationFormSalePrice3 = $_SESSION['applicationItem']->experience_sale_price_3;
		$applicationFormSalePrice4 = $_SESSION['applicationItem']->experience_sale_price_4;
		$applicationFormNetProfit1 = $_SESSION['applicationItem']->experience_net_profit_1;
		$applicationFormNetProfit2 = $_SESSION['applicationItem']->experience_net_profit_2;
		$applicationFormNetProfit3 = $_SESSION['applicationItem']->experience_net_profit_3;
		$applicationFormNetProfit4 = $_SESSION['applicationItem']->experience_net_profit_4;
		$applicationFormConvictedCrime = $_SESSION['applicationItem']->declaration_convicted_of_crime;
		$applicationFormOutstandingJudgement = $_SESSION['applicationItem']->declaration_outstanding_judgement;
		$applicationFormLitigationDefendant = $_SESSION['applicationItem']->declaration_litigation_defendant;
		$applicationFormPropertyForeclosed = $_SESSION['applicationItem']->declaration_property_foreclosed;
		$applicationFormLoanDelinquent = $_SESSION['applicationItem']->declaration_delinquent_loan;
		$applicationFormBankruptcy = $_SESSION['applicationItem']->declaration_bankruptcy;
		$applicationFormPotentialLitigation = $_SESSION['applicationItem']->declaration_potential_litigation_collateral_property;
		$applicationFormTaxReturnsContested = $_SESSION['applicationItem']->declaration_contested_tax_returns;
		$applicationFormUSCitizen = $_SESSION['applicationItem']->declaration_us_citizen;
		$applicationFormResidentAlien = $_SESSION['applicationItem']->declaration_permanent_resident_alien;
		$applicationFormGuarantor1Signature = $_SESSION['applicationItem']->guarantor_1_signature_pad_image_url;
		$applicationFormGuarantor1SignatureDate = $_SESSION['applicationItem']->guarantor_1_signature_date;
		$applicationFormGuarantor2Signature = $_SESSION['applicationItem']->guarantor_2_signature_pad_image_url;
		$applicationFormGuarantor2SignatureDate = $_SESSION['applicationItem']->guarantor_2_signature_date;
		
		$applicationFormsCol = 'SELECT COLUMN_NAME, EXTRA FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = "'.$wpdb->dbname.'" AND TABLE_NAME ="'.$applicationFormTable.'"';
		$applicationFormsColumnNames_run_qry = $wpdb->get_results($applicationFormsCol);
		
		$applicationFormsColumnNames = array();
		
		// Loop through Application Forms Table and collect all of the columns that are not "AUTO_INCREMENT"
		foreach($applicationFormsColumnNames_run_qry as $row)
		{
			if($row->EXTRA != 'auto_increment')
				$applicationFormsColumnNames[] = $row->COLUMN_NAME;
		}
		
		$db_cols_implode = implode(',', $applicationFormsColumnNames);
		
		$values = array('"'.$applicationFormPDFPath.'"','"'.$applicationFormStatus.'"','"'.$applicationFormBorrowersName.'"','"'.$applicationFormLoanAmount.'"','"'.$applicationFormMaturityTerm.'"','"'.$applicationFormExitStrategy.'"','"'.$applicationFormPurchaseRefinance.'"','"'.$applicationFormAddress.'"','"'.$applicationFormCurrentValue.'"','"'.$applicationFormPurchasePrice.'"','"'.$applicationFormPropertyType.'"','"'.$applicationFormCompletedValue.'"','"'.$applicationFormUnits.'"','"'.$applicationFormRehabAmount.'"','"'.$applicationFormEMD.'"','"'.$applicationFormContractExpirationDate.'"','"'.$applicationFormIsDistressSale.'"','"'.$applicationFormIsContractAssignment.'"','"'.$applicationFormOccupiedByOwner.'"','"'.$applicationFormLawsuitsOutstanding.'"','"'.$applicationFormIsForeclosure.'"','"'.$applicationFormEnvironmentalIssues.'"','"'.$applicationFormConstructionBudget.'"','"'.$applicationFormLicensedGC.'"','"'.$applicationFormMonthsToComplete.'"','"'.$applicationFormBuildingPermit.'"','"'.$applicationFormNumberOfProjects.'"','"'.$applicationFormUsageChanging.'"','"'.$applicationFormDrawRequestsExpected.'"','"'.$applicationFormAdditionsBeingMade.'"','"'.$applicationFormGuarantor1Name.'"','"'.$applicationFormGuarantor1OwnershipPercentage.'"','"'.$applicationFormGuarantor1SSN.'"','"'.$applicationFormGuarantor1DriversLicense.'"','"'.$applicationFormGuarantor1DateOfBirth.'"','"'.$applicationFormGuarantor1PresentAddress.'"','"'.$applicationFormGuarantor1OwnRent.'"','"'.$applicationFormGuarantor1PhoneNumber.'"','"'.$applicationFormGuarantor1EmailAddress.'"','"'.$applicationFormGuarantor1LiquidAssets.'"','"'.$applicationFormGuarantor2Name.'"','"'.$applicationFormGuarantor2OwnershipPercentage.'"','"'.$applicationFormGuarantor2SSN.'"','"'.$applicationFormGuarantor2DriversLicense.'"','"'.$applicationFormGuarantor2DateOfBirth.'"','"'.$applicationFormGuarantor2PresentAddress.'"','"'.$applicationFormGuarantor2OwnRent.'"','"'.$applicationFormGuarantor2PhoneNumber.'"','"'.$applicationFormGuarantor2EmailAddress.'"','"'.$applicationFormGuarantor2LiquidAssets.'"','"'.$applicationFormPropertyAddress1.'"','"'.$applicationFormPropertyAddress2.'"','"'.$applicationFormPropertyAddress3.'"','"'.$applicationFormPropertyAddress4.'"','"'.$applicationFormPropertyType1.'"','"'.$applicationFormPropertyType2.'"','"'.$applicationFormPropertyType3.'"','"'.$applicationFormPropertyType4.'"','"'.$applicationFormDatePurchased1.'"','"'.$applicationFormDatePurchased2.'"','"'.$applicationFormDatePurchased3.'"','"'.$applicationFormDatePurchased4.'"','"'.$applicationFormDateSold1.'"','"'.$applicationFormDateSold2.'"','"'.$applicationFormDateSold3.'"','"'.$applicationFormDateSold4.'"','"'.$applicationFormAcquisitionCost1.'"','"'.$applicationFormAcquisitionCost2.'"','"'.$applicationFormAcquisitionCost3.'"','"'.$applicationFormAcquisitionCost4.'"','"'.$applicationFormRehabCost1.'"','"'.$applicationFormRehabCost2.'"','"'.$applicationFormRehabCost3.'"','"'.$applicationFormRehabCost4.'"','"'.$applicationFormFinancingSource1.'"','"'.$applicationFormFinancingSource2.'"','"'.$applicationFormFinancingSource3.'"','"'.$applicationFormFinancingSource4.'"','"'.$applicationFormSalePrice1.'"','"'.$applicationFormSalePrice2.'"','"'.$applicationFormSalePrice3.'"','"'.$applicationFormSalePrice4.'"','"'.$applicationFormNetProfit1.'"','"'.$applicationFormNetProfit2.'"','"'.$applicationFormNetProfit3.'"','"'.$applicationFormNetProfit4.'"','"'.$applicationFormConvictedCrime.'"','"'.$applicationFormOutstandingJudgement.'"','"'.$applicationFormLitigationDefendant.'"','"'.$applicationFormPropertyForeclosed.'"','"'.$applicationFormLoanDelinquent.'"','"'.$applicationFormBankruptcy.'"','"'.$applicationFormPotentialLitigation.'"','"'.$applicationFormTaxReturnsContested.'"','"'.$applicationFormUSCitizen.'"','"'.$applicationFormResidentAlien.'"','"'.$applicationFormGuarantor1Signature.'"','"'.$applicationFormGuarantor1SignatureDate.'"','"'.$applicationFormGuarantor2Signature.'"','"'.$applicationFormGuarantor2SignatureDate.'"','"'.$applicationFormDateCreated.'"','""','""');
		
		$values_implode = implode(',', $values);
		
		// Save Loan Application Form to the DB
		$wpdb->query('INSERT INTO ' . $applicationFormTable . ' (' . $db_cols_implode . ') ' . 'VALUES (' . $values_implode.  ')');
		
		// Save Loan Application ID with the User ID to relation tbl
		$applicationFormID = $wpdb->insert_id;
		$applicationFormUserTable = $wpdb->prefix ."application_form_user";
		$userID = $_SESSION['loan_application_user_id'];
		$wpdb->query('INSERT INTO ' . $applicationFormUserTable . ' (user_id, application_id) ' . 'VALUES (' . $userID .  ', ' . $applicationFormID . ')');
		
		// Get User email address
		$userTbl = $wpdb->prefix ."application_user";
		$userEmailAddress = $wpdb->get_results("SELECT ".$userTbl.".user_email
    FROM ".$userTbl." WHERE ".$userTbl.".id='" .$userID. "'");
		
		// Send email to the user with link to their saved Loan Application
		sendEmail($userEmailAddress[0]->user_email);
		
		// Redirect to "Loan Application Data Saved Success" page
		header("Location: /application-save-success");
		exit;
	//}
	
	// User is NOT logged in // Redirect to Sign in / Register page
	//else
	//{
		// Redirect to "Loan Application Data Saved Success" page
		//header("Location: /apply-sign-in?save_application=true");
		//exit;
	//}
}

else if(isset($_POST['application_form_borrowers_name']))
	loan_application_submit();

if(isset($_REQUEST['view']))
{
	// check Form ID against the Logged in User ID and make certain that the User is able to view the Form
	$applicationFormUserTable = $wpdb->prefix ."application_form_user";
	$formID = $_REQUEST['view'];
	$userID = $_SESSION['loan_application_user_id'];
	
	$userCheck = $wpdb->get_var('SELECT COUNT(*) FROM '.$applicationFormUserTable.' WHERE '.$applicationFormUserTable.'.user_id="'. $userID .'" AND '.$applicationFormUserTable.'.application_id="'. $formID .'"');
	
	// check if User actually can view the requested Form
	if($userCheck)
	{
		// Get Loan Application Form record
		global $wpdb;
		$applicationFormsTable = $wpdb->prefix ."application_forms";
    
		$applicationFormForReview = $wpdb->get_results("SELECT *
    FROM ".$applicationFormsTable." WHERE ".$applicationFormsTable.".form_id='" .$formID. "'");
    
    	$_SESSION['applicationItem'] = $applicationFormForReview[0];
	}
}

function sendEmail($recipient)
{
	/*$mail = new PHPMailer(true);
	try {
	    //Server settings
	    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
	    $mail->isSMTP();                                      // Set mailer to use SMTP
	    $mail->Host = 'relay-hosting.secureserver.net';  		      // Specify main and backup SMTP servers
	    $mail->SMTPAuth = false;                               // Enable SMTP authentication
	    //$mail->Username = 'revolver@brasstackscollective.com';                 // SMTP username
	    //$mail->Password = 'password1';                           // SMTP password
	    $mail->SMTPSecure = 'false';                            // Enable TLS encryption, `ssl` also accepted
	    $mail->Port = 25;                                    // TCP port to connect to
	
	    //Recipients
	    $mail->setFrom('revolver@brasstackscollective.com', 'Mailer');
	    $mail->addAddress($recipient, '');     // Add a recipient
	
	    //Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'Your Revolver Loan Application';
	    $mail->Body    = 'Thank you for filling out a Loan Application with Revolver Financial. <p><a href="http://local.revolverfinancial.com/loan-application-view" target="_blank">See your Loan Applications</a></p>';
	
	    $mail->send();
	    echo 'Message has been sent';
	} catch (Exception $e) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	}*/
	$headers = 'From: revolver@brasstackscollective.com' . "\r\n" .
    'Reply-To: revolver@brasstackscollective.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
	
	$subject = "View your Loan Application";
	
	$body = 'Thank you for filling out a Loan Application with Revolver Financial. <p><a href="http://local.revolverfinancial.com/loan-application-view" target="_blank">See your Loan Applications</a></p>';
	
	$success = mail($recipient, $subject, $body, $headers);
	
	if (!$success) {
	    $errorMessage = error_get_last()['message'];
	    echo $errorMessage;
	}
}

function loan_application_submit()
{
	global $wpdb;
    $applicationFormTable = $wpdb->prefix ."application_forms";
    
	if(isset($_POST['application_form_borrowers_name']))
	{
		$applicationFormPDFPath = "";
		$applicationFormStatus = "submitted";
		$applicationFormDateCreated = date('Y-m-d H:i:s');
		
		$applicationFormBorrowersName = $_POST['application_form_borrowers_name'];
		$applicationFormLoanAmount = $_POST['application_form_loan_amount'];
		$applicationFormMaturityTerm = $_POST['application_form_maturity_term'];
		$applicationFormExitStrategy = $_POST['application_form_exit_strategy'];
		$applicationFormPurchaseRefinance = $_POST['application_form_purchase_refinance'];
		$applicationFormAddress = $_POST['application_form_address'];
		$applicationFormCurrentValue = $_POST['application_form_current_value'];
		$applicationFormPurchasePrice = $_POST['application_form_purchase_price'];
		$applicationFormPropertyType = $_POST['application_form_property_type'];
		$applicationFormCompletedValue = $_POST['application_form_as_completed_value'];
		$applicationFormUnits = $_POST['application_form_units'];
		$applicationFormRehabAmount = $_POST['application_form_rehab_amount'];
		$applicationFormEMD = $_POST['application_form_emd'];
		$applicationFormContractExpirationDate = $_POST['application_form_contract_expiration_date'];
		$applicationFormIsDistressSale = $_POST['application_form_is_distress_sale'];
		$applicationFormIsContractAssignment = $_POST['application_form_as_is_contract_assignment'];
		$applicationFormOccupiedByOwner = $_POST['application_form_occupied_by_owner'];
		$applicationFormLawsuitsOutstanding = $_POST['application_form_lawsuits_outstanding'];
		$applicationFormIsForeclosure = $_POST['application_form_is_property_foreclosure_proceeding'];
		$applicationFormEnvironmentalIssues = $_POST['application_form_environmental_issues'];
		$applicationFormConstructionBudget = $_POST['application_form_construction_budget'];
		$applicationFormLicensedGC = $_POST['application_form_licensed_gc'];
		$applicationFormMonthsToComplete = $_POST['application_form_months_to_complete'];
		$applicationFormBuildingPermit = $_POST['application_form_building_permit'];
		$applicationFormNumberOfProjects = $_POST['application_form_number_of_projects'];
		$applicationFormUsageChanging = $_POST['application_form_is_usage_changing'];
		$applicationFormDrawRequestsExpected = $_POST['application_form_draw_requests_expected'];
		$applicationFormAdditionsBeingMade = $_POST['application_form_addition_being_made'];
		$applicationFormGuarantor1Name = $_POST['application_form_guarantor_1_name'];
		$applicationFormGuarantor1OwnershipPercentage = $_POST['application_form_guarantor_1_ownership_percentage'];
		$applicationFormGuarantor1SSN = $_POST['application_form_guarantor_1_ssn'];
		$applicationFormGuarantor1DriversLicense = $_POST['application_form_guarantor_1_drivers_license'];
		$applicationFormGuarantor1DateOfBirth = $_POST['application_form_guarantor_1_date_of_birth'];
		$applicationFormGuarantor1PresentAddress = $_POST['application_form_guarantor_1_present_address'];
		$applicationFormGuarantor1OwnRent = $_POST['application_form_guarantor_1_owner_renter'];
		$applicationFormGuarantor1PhoneNumber = $_POST['application_form_guarantor_1_phone_number'];
		$applicationFormGuarantor1EmailAddress = $_POST['application_form_guarantor_1_email_address'];
		$applicationFormGuarantor1LiquidAssets = $_POST['application_form_guarantor_1_liquid_assets'];
		$applicationFormGuarantor2Name = $_POST['application_form_guarantor_2_name'];
		$applicationFormGuarantor2OwnershipPercentage = $_POST['application_form_guarantor_2_ownership_percentage'];
		$applicationFormGuarantor2SSN = $_POST['application_form_guarantor_2_ssn'];
		$applicationFormGuarantor2DriversLicense = $_POST['application_form_guarantor_2_drivers_license'];
		$applicationFormGuarantor2DateOfBirth = $_POST['application_form_guarantor_2_date_of_birth'];
		$applicationFormGuarantor2PresentAddress = $_POST['application_form_guarantor_2_present_address'];
		$applicationFormGuarantor2OwnRent = $_POST['application_form_guarantor_2_owner_renter'];
		$applicationFormGuarantor2PhoneNumber = $_POST['application_form_guarantor_2_phone_number'];
		$applicationFormGuarantor2EmailAddress = $_POST['application_form_guarantor_2_email_address'];
		$applicationFormGuarantor2LiquidAssets = $_POST['application_form_guarantor_2_liquid_assets'];
		$applicationFormPropertyAddress1 = $_POST['application_form_property_address_1'];
		$applicationFormPropertyAddress2 = $_POST['application_form_property_address_2'];
		$applicationFormPropertyAddress3 = $_POST['application_form_property_address_3'];
		$applicationFormPropertyAddress4 = $_POST['application_form_property_address_4'];
		$applicationFormPropertyType1 = $_POST['application_form_property_type_1'];
		$applicationFormPropertyType2 = $_POST['application_form_property_type_2'];
		$applicationFormPropertyType3 = $_POST['application_form_property_type_3'];
		$applicationFormPropertyType4 = $_POST['application_form_property_type_4'];
		$applicationFormDatePurchased1 = $_POST['application_form_date_purchased_1'];
		$applicationFormDatePurchased2 = $_POST['application_form_date_purchased_2'];
		$applicationFormDatePurchased3 = $_POST['application_form_date_purchased_3'];
		$applicationFormDatePurchased4 = $_POST['application_form_date_purchased_4'];
		$applicationFormDateSold1 = $_POST['application_form_date_sold_1'];
		$applicationFormDateSold2 = $_POST['application_form_date_sold_2'];
		$applicationFormDateSold3 = $_POST['application_form_date_sold_3'];
		$applicationFormDateSold4 = $_POST['application_form_date_sold_4'];
		$applicationFormAcquisitionCost1 = $_POST['application_form_acquisition_cost_1'];
		$applicationFormAcquisitionCost2 = $_POST['application_form_acquisition_cost_2'];
		$applicationFormAcquisitionCost3 = $_POST['application_form_acquisition_cost_3'];
		$applicationFormAcquisitionCost4 = $_POST['application_form_acquisition_cost_4'];
		$applicationFormRehabCost1 = $_POST['application_form_rehab_cost_1'];
		$applicationFormRehabCost2 = $_POST['application_form_rehab_cost_2'];
		$applicationFormRehabCost3 = $_POST['application_form_rehab_cost_3'];
		$applicationFormRehabCost4 = $_POST['application_form_rehab_cost_4'];
		$applicationFormFinancingSource1 = $_POST['application_form_financing_source_1'];
		$applicationFormFinancingSource2 = $_POST['application_form_financing_source_2'];
		$applicationFormFinancingSource3 = $_POST['application_form_financing_source_3'];
		$applicationFormFinancingSource4 = $_POST['application_form_financing_source_4'];
		$applicationFormSalePrice1 = $_POST['application_form_sale_price_1'];
		$applicationFormSalePrice2 = $_POST['application_form_sale_price_2'];
		$applicationFormSalePrice3 = $_POST['application_form_sale_price_3'];
		$applicationFormSalePrice4 = $_POST['application_form_sale_price_4'];
		$applicationFormNetProfit1 = $_POST['application_form_net_profit_1'];
		$applicationFormNetProfit2 = $_POST['application_form_net_profit_2'];
		$applicationFormNetProfit3 = $_POST['application_form_net_profit_3'];
		$applicationFormNetProfit4 = $_POST['application_form_net_profit_4'];
		$applicationFormConvictedCrime = $_POST['application_form_convicted_crime'];
		$applicationFormOutstandingJudgement = $_POST['application_form_outstanding_judgement'];
		$applicationFormLitigationDefendant = $_POST['application_form_litigation_defendant'];
		$applicationFormPropertyForeclosed = $_POST['application_form_property_foreclosed'];
		$applicationFormLoanDelinquent = $_POST['application_form_loan_delinquent'];
		$applicationFormBankruptcy = $_POST['application_form_bankruptcy'];
		$applicationFormPotentialLitigation = $_POST['application_form_potential_litigation'];
		$applicationFormTaxReturnsContested = $_POST['application_form_tax_returns_contested'];
		$applicationFormUSCitizen = $_POST['application_form_us_citizen'];
		$applicationFormResidentAlien = $_POST['application_form_resident_alien'];
		$applicationFormGuarantor1Signature = $_POST['guarantor_1_signature_pad_image_url'];
		$applicationFormGuarantor1SignatureDate = $_POST['application_form_guarantor_1_signature_date'];
		$applicationFormGuarantor2Signature = $_POST['guarantor_2_signature_pad_image_url'];
		$applicationFormGuarantor2SignatureDate = $_POST['application_form_guarantor_2_signature_date'];
		
		$applicationFormsCol = 'SELECT COLUMN_NAME, EXTRA FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = "'.$wpdb->dbname.'" AND TABLE_NAME ="'.$applicationFormTable.'"';
		$applicationFormsColumnNames_run_qry = $wpdb->get_results($applicationFormsCol);

		$applicationFormsColumnNames = array();
		
		// Loop through Application Forms Table and collect all of the columns that are not "AUTO_INCREMENT"
		foreach($applicationFormsColumnNames_run_qry as $row)
		{
			if($row->EXTRA != 'auto_increment')
				$applicationFormsColumnNames[] = $row->COLUMN_NAME;
		}
		
		$db_cols_implode = implode(',', $applicationFormsColumnNames);
		
		$values = array('"'.$applicationFormPDFPath.'"','"'.$applicationFormStatus.'"','"'.$applicationFormBorrowersName.'"','"'.$applicationFormLoanAmount.'"','"'.$applicationFormMaturityTerm.'"','"'.$applicationFormExitStrategy.'"','"'.$applicationFormPurchaseRefinance.'"','"'.$applicationFormAddress.'"','"'.$applicationFormCurrentValue.'"','"'.$applicationFormPurchasePrice.'"','"'.$applicationFormPropertyType.'"','"'.$applicationFormCompletedValue.'"','"'.$applicationFormUnits.'"','"'.$applicationFormRehabAmount.'"','"'.$applicationFormEMD.'"','"'.$applicationFormContractExpirationDate.'"','"'.$applicationFormIsDistressSale.'"','"'.$applicationFormIsContractAssignment.'"','"'.$applicationFormOccupiedByOwner.'"','"'.$applicationFormLawsuitsOutstanding.'"','"'.$applicationFormIsForeclosure.'"','"'.$applicationFormEnvironmentalIssues.'"','"'.$applicationFormConstructionBudget.'"','"'.$applicationFormLicensedGC.'"','"'.$applicationFormMonthsToComplete.'"','"'.$applicationFormBuildingPermit.'"','"'.$applicationFormNumberOfProjects.'"','"'.$applicationFormUsageChanging.'"','"'.$applicationFormDrawRequestsExpected.'"','"'.$applicationFormAdditionsBeingMade.'"','"'.$applicationFormGuarantor1Name.'"','"'.$applicationFormGuarantor1OwnershipPercentage.'"','"'.$applicationFormGuarantor1SSN.'"','"'.$applicationFormGuarantor1DriversLicense.'"','"'.$applicationFormGuarantor1DateOfBirth.'"','"'.$applicationFormGuarantor1PresentAddress.'"','"'.$applicationFormGuarantor1OwnRent.'"','"'.$applicationFormGuarantor1PhoneNumber.'"','"'.$applicationFormGuarantor1EmailAddress.'"','"'.$applicationFormGuarantor1LiquidAssets.'"','"'.$applicationFormGuarantor2Name.'"','"'.$applicationFormGuarantor2OwnershipPercentage.'"','"'.$applicationFormGuarantor2SSN.'"','"'.$applicationFormGuarantor2DriversLicense.'"','"'.$applicationFormGuarantor2DateOfBirth.'"','"'.$applicationFormGuarantor2PresentAddress.'"','"'.$applicationFormGuarantor2OwnRent.'"','"'.$applicationFormGuarantor2PhoneNumber.'"','"'.$applicationFormGuarantor2EmailAddress.'"','"'.$applicationFormGuarantor2LiquidAssets.'"','"'.$applicationFormPropertyAddress1.'"','"'.$applicationFormPropertyAddress2.'"','"'.$applicationFormPropertyAddress3.'"','"'.$applicationFormPropertyAddress4.'"','"'.$applicationFormPropertyType1.'"','"'.$applicationFormPropertyType2.'"','"'.$applicationFormPropertyType3.'"','"'.$applicationFormPropertyType4.'"','"'.$applicationFormDatePurchased1.'"','"'.$applicationFormDatePurchased2.'"','"'.$applicationFormDatePurchased3.'"','"'.$applicationFormDatePurchased4.'"','"'.$applicationFormDateSold1.'"','"'.$applicationFormDateSold2.'"','"'.$applicationFormDateSold3.'"','"'.$applicationFormDateSold4.'"','"'.$applicationFormAcquisitionCost1.'"','"'.$applicationFormAcquisitionCost2.'"','"'.$applicationFormAcquisitionCost3.'"','"'.$applicationFormAcquisitionCost4.'"','"'.$applicationFormRehabCost1.'"','"'.$applicationFormRehabCost2.'"','"'.$applicationFormRehabCost3.'"','"'.$applicationFormRehabCost4.'"','"'.$applicationFormFinancingSource1.'"','"'.$applicationFormFinancingSource2.'"','"'.$applicationFormFinancingSource3.'"','"'.$applicationFormFinancingSource4.'"','"'.$applicationFormSalePrice1.'"','"'.$applicationFormSalePrice2.'"','"'.$applicationFormSalePrice3.'"','"'.$applicationFormSalePrice4.'"','"'.$applicationFormNetProfit1.'"','"'.$applicationFormNetProfit2.'"','"'.$applicationFormNetProfit3.'"','"'.$applicationFormNetProfit4.'"','"'.$applicationFormConvictedCrime.'"','"'.$applicationFormOutstandingJudgement.'"','"'.$applicationFormLitigationDefendant.'"','"'.$applicationFormPropertyForeclosed.'"','"'.$applicationFormLoanDelinquent.'"','"'.$applicationFormBankruptcy.'"','"'.$applicationFormPotentialLitigation.'"','"'.$applicationFormTaxReturnsContested.'"','"'.$applicationFormUSCitizen.'"','"'.$applicationFormResidentAlien.'"','"'.$applicationFormGuarantor1Signature.'"','"'.$applicationFormGuarantor1SignatureDate.'"','"'.$applicationFormGuarantor2Signature.'"','"'.$applicationFormGuarantor2SignatureDate.'"','"'.$applicationFormDateCreated.'"','""','""');

        $values_implode = implode(',', $values);
        
		// Save Loan Application Form to the DB
		$wpdb->query('INSERT INTO ' . $applicationFormTable . ' (' . $db_cols_implode . ') ' . 'VALUES (' . $values_implode.  ')');
		
		// Save Loan Application Form to PDF
		//save_loan_application_form_to_pdf($values_implode);
		
		$applicationFormID = $wpdb->insert_id;
		$applicationFormUserTable = $wpdb->prefix ."application_form_user";
		$userID = $_SESSION['loan_application_user_id'];
		$wpdb->query('INSERT INTO ' . $applicationFormUserTable . ' (user_id, application_id) ' . 'VALUES (' . $userID .  ', ' . $applicationFormID . ')');
		
		$userTbl = $wpdb->prefix ."application_user";
		$userEmailAddress = $wpdb->get_results("SELECT ".$userTbl.".user_email
    FROM ".$userTbl." WHERE ".$userTbl.".id='" .$userID. "'");
		
		// Send email to the user with link to their saved Loan Application
		sendEmail($userEmailAddress[0]->user_email);
		
		header("Location: /application-save-success");
		exit;
	}
}

/*function save_loan_application_form_to_pdf($values_imp)
{
	require(ABSPATH . 'wp-content/plugins/btc-application-form/fpdm/fpdm.php');
	
	$name = "Test";
	
	$fields = array(
		'Borrower Name' => $name
	);
	
	$pdf = new FPDM(ABSPATH . 'wp-content/loan_applications/original/Revolver_Loan_Application.pdf');
	$pdf->Load($fields, false);
	$pdf->Merge();
	
	$fileName = ABSPATH . 'wp-content/loan_applications/loan_application_' . $name . '.pdf';
	$pdf->Output($fileName, 'D');
}*/
	
function revolver_application_form_1()
{
	?>
		<script type="text/javascript">
			function submitForm(action)
			{
				var form = document.getElementById('loan_application_form');
				form.action = action;
				form.submit();	
			}
		</script>
	
		<div id="revolver_application_form" class="revolver_application_form">
			<form id="loan_application_form" method="post" action="">
				<!-- Section 1 -->
				<div class="application_form_section_header col-xs-12">Section 1 - Loan Overview</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Borrower's Name:</label>
					<input name="application_form_borrowers_name" class="" type="text" value="<?php echo $applicationFormBorrowersName; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<div class="no_gutter col-xs-12">
						<label for="">Loan Amount: (90%)</label>
						<input name="application_form_loan_amount" class="" type="text" value="<?php echo $applicationFormLoanAmount; ?>" />
					</div>
					
					<div class="no_gutter col-xs-12">
						<label for="">Maturity Term: (e.x. 12 months)</label>
						<input name="application_form_maturity_term" class="" type="text" placeholder="12 Months" value="<?php echo $applicationFormMaturityTerm; ?>" />
					</div>
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Exit Strategy:</label>
					<input name="application_form_exit_strategy" class="" type="text" value="<?php echo $applicationFormExitStrategy; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Purchase/Refinance:</label>
					<input name="application_form_purchase_refinance" class="" type="text" value="<?php echo $applicationFormPurchaseRefinance; ?>" />
				</div>
				
				<!-- Section 2 -->
				<div class="application_form_section_header col-xs-12">Section 2 - Property</div>
				
				<div class="col-sm-6 col-xs-12">
					<label for="">Address:</label>
					<input name="application_form_address" class="" type="text" value="<?php echo $applicationFormAddress; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<div class="no_gutter col-xs-12">
						<label for="">Current "As-Is" Value:</label>
						<input name="application_form_current_value" class="" type="text" value="<?php echo $applicationFormCurrentValue; ?>" />
					</div>
					
					<div class="no_gutter col-xs-12">
						<label for="">Purchase Price/Acquisition</label>
						<input name="application_form_purchase_price" class="" type="text" value="<?php echo $applicationFormPurchasePrice; ?>" />
					</div>
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Property Type:</label>
					<input name="application_form_property_type" class="" type="text" value="<?php echo $applicationFormPropertyType; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">"As Completed" Value/ARV:</label>
					<input name="application_form_as_completed_value" class="" type="text" value="<?php echo $applicationFormCompletedValue; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Units:</label>
					<input name="application_form_units" class="" type="text" value="<?php echo $applicationFormUnits; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Rehab Amount:</label>
					<input name="application_form_rehab_amount" class="" type="text" value="<?php echo $applicationFormRehabAmount; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">EMD:</label>
					<input name="application_form_emd" class="" type="text" value="<?php echo $applicationFormEMD; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Contract Expiration.Acquisition Date:</label>
					<input name="application_form_contract_expiration_date" class="" type="text" value="<?php echo $applicationFormContractExpirationDate; ?>" />
				</div>
				
				<!-- Seperator -->
				<div class="col-xs-12 application_form_seperator"></div>
				
				<div class="col-sm-6 col-xs-12">
					<label for="">Is this a distress sale (foreclosure, short sale auction)?</label>
					<input name="application_form_is_distress_sale" class="" type="text" value="<?php echo $applicationFormIsDistressSale; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Is there a contract assignment or situation where seller is not holding title?</label>
					<input name="application_form_as_is_contract_assignment" class="" type="text" value="<?php echo $applicationFormIsContractAssignment; ?>" />
				</div>
				
				<!-- Seperator -->
				<div class="col-xs-12 application_form_seperator"></div>
				
				<div class="col-sm-6 col-xs-12">
					<label for="">Will this property be occupied at any time by any owner or guarantor?</label>
					<input name="application_form_occupied_by_owner" class="" type="text" value="<?php echo $applicationFormOccupiedByOwner; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Are there any lawsuits outstanding against this property?</label>
					<input name="application_form_lawsuits_outstanding" class="" type="text" value="<?php echo $applicationFormLawsuitsOutstanding; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Is this property subject to any default or foreclosure proceedings?</label>
					<input name="application_form_is_property_foreclosure_proceeding" class="" type="text" value="<?php echo $applicationFormIsForeclosure; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Are there any known environmental issues?</label>
					<input name="application_form_environmental_issues" class="" type="text" value="<?php echo $applicationFormEnvironmentalIssues; ?>" />
				</div>
				
				<!-- Section 3 -->
				<div class="application_form_section_header col-xs-12">Section 3 - Renovation and Construction</div>
				
				<div class="col-sm-6 col-xs-12">
					<label for="">Construction Budget:</label>
					<input name="application_form_construction_budget" class="" type="text" value="<?php echo $applicationFormConstructionBudget; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Will a licensed GC be used?</label>
					<input name="application_form_licensed_gc" class="" type="text" value="<?php echo $applicationFormLicensedGC; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Months to Complete:</label>
					<input name="application_form_months_to_complete" class="" type="text" value="<?php echo $applicationFormMonthsToComplete; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Is a building permit required?</label>
					<input name="application_form_building_permit" class="" type="text" value="<?php echo $applicationFormBuildingPermit; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Number of prior projects by borrower:</label>
					<input name="application_form_number_of_projects" class="" type="text" value="<?php echo $applicationFormNumberOfProjects; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Is the usage of the property changing?</label>
					<input name="application_form_is_usage_changing" class="" type="text" value="<?php echo $applicationFormUsageChanging; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Number of draw requests expected:</label>
					<input name="application_form_draw_requests_expected" class="" type="text" value="<?php echo $applicationFormDrawRequestsExpected; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Are any additions being made?</label>
					<input name="application_form_addition_being_made" class="" type="text" value="<?php echo $applicationFormAdditionsBeingMade; ?>" />
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
					<input name="application_form_guarantor_1_name" class="" type="text" value="<?php echo $applicationFormGuarantor1Name; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Name:</label>
					<input name="application_form_guarantor_2_name" class="" type="text" value="<?php echo $applicationFormGuarantor2Name; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Ownership %:</label>
					<input name="application_form_guarantor_1_ownership_percentage" class="" type="text" value="<?php echo $applicationFormGuarantor1OwnershipPercentage; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Ownership %:</label>
					<input name="application_form_guarantor_2_ownership_percentage" class="" type="text" value="<?php echo $applicationFormGuarantor2OwnershipPercentage; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">SSN:</label>
					<input name="application_form_guarantor_1_ssn" class="" type="text" value="<?php echo $applicationFormGuarantor1SSN; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">SSN:</label>
					<input name="application_form_guarantor_2_ssn" class="" type="text" value="<?php echo $applicationFormGuarantor2SSN; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Drivers License #:</label>
					<input name="application_form_guarantor_1_drivers_license" class="" type="text" value="<?php echo $applicationFormGuarantor1DriversLicense; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Drivers License #:</label>
					<input name="application_form_guarantor_2_drivers_license" class="" type="text" value="<?php echo $applicationFormGuarantor2DriversLicense; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Date of Birth:</label>
					<input name="application_form_guarantor_1_date_of_birth" class="" type="text" value="<?php echo $applicationFormGuarantor1DateOfBirth; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Date of Birth:</label>
					<input name="application_form_guarantor_2_date_of_birth" class="" type="text" value="<?php echo $applicationFormGuarantor2DateOfBirth; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Present Address:</label>
					<input name="application_form_guarantor_1_present_address" class="" type="text" value="<?php echo $applicationFormGuarantor1PresentAddress; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Present Address:</label>
					<input name="application_form_guarantor_2_present_address" class="" type="text" value="<?php echo $applicationFormGuarantor2PresentAddress; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Owner/Renter:</label>
					<input name="application_form_guarantor_1_owner_renter" class="" type="text" value="<?php echo $applicationFormGuarantor1OwnRent; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Owner/Renter:</label>
					<input name="application_form_guarantor_2_owner_renter" class="" type="text" value="<?php echo $applicationFormGuarantor2OwnRent; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Phone:</label>
					<input name="application_form_guarantor_1_phone_number" class="" type="text" value="<?php echo $applicationFormGuarantor1PhoneNumber; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Phone:</label>
					<input name="application_form_guarantor_2_phone_number" class="" type="text" value="<?php echo $applicationFormGuarantor2PhoneNumber; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Email:</label>
					<input name="application_form_guarantor_1_email_address" class="" type="text" value="<?php echo $applicationFormGuarantor1EmailAddress; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Email:</label>
					<input name="application_form_guarantor_2_email_address" class="" type="text" value="<?php echo $applicationFormGuarantor2EmailAddress; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Liquid Assets ($):</label>
					<input name="application_form_guarantor_1_liquid_assets" class="" type="text" value="<?php echo $applicationFormGuarantor1LiquidAssets; ?>" />
				</div>
				<div class="col-sm-6 col-xs-12">
					<label for="">Liquid Assets ($):</label>
					<input name="application_form_guarantor_2_liquid_assets" class="" type="text" value="<?php echo $applicationFormGuarantor2LiquidAssets; ?>" />
				</div>
				
				<div class="application_form_section_sub_header top_space col-xs-12">
					<div class="no_gutter col-xs-12 text-center">Experience</div>
				</div>
				
				<div class="col-xs-12 text-center">List most recent completed transactions (preferably the last 3 years) - Attached separate document if preferred</div>

				
				<div class="col-xs-12">
					<label>Property Address</label>
				</div>
				<div class="col-xs-3">
					<input name="application_form_property_address_1" class="" type="text" value="<?php echo $applicationFormPropertyAddress1; ?>" placeholder="1" />
				</div>
				<div class="col-xs-3">
					<input name="application_form_property_address_2" class="" type="text" value="<?php echo $applicationFormPropertyAddress2; ?>" placeholder="2" />
				</div>
				<div class="col-xs-3">
					<input name="application_form_property_address_3" class="" type="text" value="<?php echo $applicationFormPropertyAddress3; ?>" placeholder="3" />
				</div>
				<div class="col-xs-3">
					<input name="application_form_property_address_4" class="" type="text" value="<?php echo $applicationFormPropertyAddress4; ?>" placeholder="4" />
				</div>
				
				
				<div class="col-xs-12">
					<label>Property Type</label>
				</div>
				<div class="col-xs-3">
					<input name="application_form_property_type_1" class="" type="text" value="<?php echo $applicationFormPropertyType1; ?>" placeholder="1" />
				</div>
				<div class="col-xs-3">
					<input name="application_form_property_type_2" class="" type="text" value="<?php echo $applicationFormPropertyType2; ?>" placeholder="2" />
				</div>
				<div class="col-xs-3">
					<input name="application_form_property_type_3" class="" type="text" value="<?php echo $applicationFormPropertyType3; ?>" placeholder="3" />
				</div>
				<div class="col-xs-3">
					<input name="application_form_property_type_4" class="" type="text" value="<?php echo $applicationFormPropertyType4; ?>" placeholder="4" />
				</div>
				
				
				<div class="col-xs-12">
					<label>Date Purchased</label>
				</div>
				<div class="col-xs-3">
					<input name="application_form_date_purchased_1" class="" type="text" value="<?php echo $applicationFormDatePurchased1; ?>" placeholder="1" />
				</div>
				<div class="col-xs-3">
					<input name="application_form_date_purchased_2" class="" type="text" value="<?php echo $applicationFormDatePurchased2; ?>" placeholder="2" />
				</div>
				<div class="col-xs-3">
					<input name="application_form_date_purchased_3" class="" type="text" value="<?php echo $applicationFormDatePurchased3; ?>" placeholder="3" />
				</div>
				<div class="col-xs-3">
					<input name="application_form_date_purchased_4" class="" type="text" value="<?php echo $applicationFormDatePurchased4; ?>" placeholder="4" />
				</div>
				
				
				<div class="col-xs-12">
					<label>Date Sold</label>
				</div>
				<div class="col-xs-3">
					<input name="application_form_date_sold_1" class="" type="text" value="<?php echo $applicationFormDateSold1; ?>" placeholder="1" />
				</div>
				<div class="col-xs-3">
					<input name="application_form_date_sold_2" class="" type="text" value="<?php echo $applicationFormDateSold2; ?>" placeholder="2" />
				</div>
				<div class="col-xs-3">
					<input name="application_form_date_sold_3" class="" type="text" value="<?php echo $applicationFormDateSold3; ?>" placeholder="3" />
				</div>
				<div class="col-xs-3">
					<input name="application_form_date_sold_4" class="" type="text" value="<?php echo $applicationFormDateSold4; ?>" placeholder="4" />
				</div>
				
				
				<div class="col-xs-12">
					<label>Acquisition Cost</label>
				</div>
				<div class="col-xs-3">
					<input name="application_form_acquisition_cost_1" class="" type="text" value="<?php echo $applicationFormAcquisitionCost1; ?>" placeholder="1" />
				</div>
				<div class="col-xs-3">
					<input name="application_form_acquisition_cost_2" class="" type="text" value="<?php echo $applicationFormAcquisitionCost2; ?>" placeholder="2" />
				</div>
				<div class="col-xs-3">
					<input name="application_form_acquisition_cost_3" class="" type="text" value="<?php echo $applicationFormAcquisitionCost3; ?>" placeholder="3" />
				</div>
				<div class="col-xs-3">
					<input name="application_form_acquisition_cost_4" class="" type="text" value="<?php echo $applicationFormAcquisitionCost4; ?>" placeholder="4" />
				</div>
				
				
				<div class="col-xs-12">
					<label>Rehab Cost</label>
				</div>
				<div class="col-xs-3">
					<input name="application_form_rehab_cost_1" class="" type="text" value="<?php echo $applicationFormRehabCost1; ?>" placeholder="1" />
				</div>
				<div class="col-xs-3">
					<input name="application_form_rehab_cost_2" class="" type="text" value="<?php echo $applicationFormRehabCost2; ?>" placeholder="2" />
				</div>
				<div class="col-xs-3">
					<input name="application_form_rehab_cost_3" class="" type="text" value="<?php echo $applicationFormRehabCost3; ?>" placeholder="3" />
				</div>
				<div class="col-xs-3">
					<input name="application_form_rehab_cost_4" class="" type="text" value="<?php echo $applicationFormRehabCost4; ?>" placeholder="4" />
				</div>
				
				
				<div class="col-xs-12">
					<label>Financing Source</label>
				</div>
				<div class="col-xs-3">
					<input name="application_form_financing_source_1" class="" type="text" value="<?php echo $applicationFormFinancingSource1; ?>" placeholder="1" />
				</div>
				<div class="col-xs-3">
					<input name="application_form_financing_source_2" class="" type="text" value="<?php echo $applicationFormFinancingSource2; ?>" placeholder="2" />
				</div>
				<div class="col-xs-3">
					<input name="application_form_financing_source_3" class="" type="text" value="<?php echo $applicationFormFinancingSource3; ?>" placeholder="3" />
				</div>
				<div class="col-xs-3">
					<input name="application_form_financing_source_4" class="" type="text" value="<?php echo $applicationFormFinancingSource4; ?>" placeholder="4" />
				</div>
				
				
				<div class="col-xs-12">
					<label>Sale Price</label>
				</div>
				<div class="col-xs-3">
					<input name="application_form_sale_price_1" class="" type="text" value="<?php echo $applicationFormSalePrice1; ?>" placeholder="1" />
				</div>
				<div class="col-xs-3">
					<input name="application_form_sale_price_2" class="" type="text" value="<?php echo $applicationFormSalePrice2; ?>" placeholder="2" />
				</div>
				<div class="col-xs-3">
					<input name="application_form_sale_price_3" class="" type="text" value="<?php echo $applicationFormSalePrice3; ?>" placeholder="3" />
				</div>
				<div class="col-xs-3">
					<input name="application_form_sale_price_4" class="" type="text" value="<?php echo $applicationFormSalePrice4; ?>" placeholder="4" />
				</div>


				<div class="col-xs-12">
					<label>Net Profit</label>
				</div>
				<div class="col-xs-3">
					<input name="application_form_net_profit_1" class="" type="text" value="<?php echo $applicationFormNetProfit1; ?>" placeholder="1" />
				</div>
				<div class="col-xs-3">
					<input name="application_form_net_profit_2" class="" type="text" value="<?php echo $applicationFormNetProfit2; ?>" placeholder="2" />
				</div>
				<div class="col-xs-3">
					<input name="application_form_net_profit_3" class="" type="text" value="<?php echo $applicationFormNetProfit3; ?>" placeholder="3" />
				</div>
				<div class="col-xs-3">
					<input name="application_form_net_profit_4" class="" type="text" value="<?php echo $applicationFormNetProfit4; ?>" placeholder="4" />
				</div>
				
				<div class="footer_notes col-xs-12">
					<a href="http://www.revolverfinance.com">www.revolverfinance.com</a>
				</div>
				
				<div class="application_form_section_sub_header top_space col-xs-12">
					<div class="no_gutter col-xs-12 text-center">Declarations</div>
				</div>
				
				<div class="col-xs-12">
					<label for="application_form_convicted_crime">Have you even been convicted of, or plead guilty, to a criminal offense?</label>
					<input name="application_form_convicted_crime" class="" type="text" value="<?php echo $applicationFormConvictedCrime; ?>" />
				</div>
				
				<div class="col-xs-12">
					<label for="application_form_outstanding_judgement">Are there any outstanding judgement or lawsuits against you, the borrowing entity or any entity in which you are the principal?</label>
					<input name="application_form_outstanding_judgement" class="" type="text" value="<?php echo $applicationFormOutstandingJudgement; ?>" />
				</div>
				
				<div class="col-xs-12">
					<label for="application_form_litigation_defendant">Have you, the borrowing entity or any entity in which you are the principal been named as a defendant in any litigation within the past ten years?</label>
					<input name="application_form_litigation_defendant" class="" type="text" value="<?php echo $applicationFormLitigationDefendant; ?>" />
				</div>
				
				<div class="col-xs-12">
					<label for="application_form_property_foreclosed">Have you, the borrowing entity or any entity in which you are the principal had a property foreclosed upon or given title or deed in lieu thereof in the past ten years?</label>
					<input name="application_form_property_foreclosed" class="" type="text" value="<?php echo $applicationFormPropertyForeclosed; ?>" />
				</div>
				
				<div class="col-xs-12">
					<label for="application_form_loan_delinquent">Have you, the borrowing entity or any entity in which you are the principal presently delinquent or in default on any loan, financial obligation, bond or loan guarantee?</label>
					<input name="application_form_loan_delinquent" class="" type="text" value="<?php echo $applicationFormLoanDelinquent; ?>" />
				</div>
				
				<div class="col-xs-12">
					<label for="application_form_bankruptcy">Have you, the borrowing entity or any entity in which you are the principal filed for bankruptcy in the past ten years?</label>
					<input name="application_form_bankruptcy" class="" type="text" value="<?php echo $applicationFormBankruptcy; ?>" />
				</div>
				
				<div class="col-xs-12">
					<label for="application_form_potential_litigation">Are you aware of any potential litigation involving the borrowing entity or the collateral property?</label>
					<input name="application_form_potential_litigation" class="" type="text" value="<?php echo $applicationFormPotentialLitigation; ?>" />
				</div>
				
				<div class="col-xs-12">
					<label for="application_form_tax_returns_contested">Are any tax returns of yours, the borrowing entity or any entity in which you are the principal currently being contested?</label>
					<input name="application_form_tax_returns_contested" class="" type="text" value="<?php echo $applicationFormTaxReturnsContested; ?>" />
				</div>
				
				<div class="col-xs-12">
					<label for="application_form_us_citizen">Are you a US Citizen?</label>
					<input name="application_form_us_citizen" class="" type="text" value="<?php echo $applicationFormUSCitizen; ?>" />
				</div>
				
				<div class="col-xs-12">
					<label for="application_form_resident_alien">Are you a permanent resident alien?</label>
					<input name="application_form_resident_alien" class="" type="text" value="<?php echo $applicationFormResidentAlien; ?>" />
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
						
						<?php
							if(!isset($applicationFormGuarantor1Signature))
							{
						?>
								<canvas id="guarantor_1_signature_pad" height="150" width="400"></canvas>
								
								<div class="signature-pad">
									<div class="signature-pad--footer">
										<div class="description">Sign above</div>
						
										<button id="guarantor_1_signature_pad_clear_btn" type="button" class="button clear" data-action="clear">Clear</button>
									</div>
								</div>
								
								<input name="guarantor_1_signature_pad_image_url" type="hidden" value="" />
						<?php
							}
							
							else
							{
						?>
							
								<img src="<?php echo $applicationFormGuarantor1Signature; ?>" />
								<input name="guarantor_1_signature_pad_image_url" type="hidden" value="<?php echo $applicationFormGuarantor1Signature; ?>" />
						<?php
							}
						?>
					</div>
					<div class="no_gutter col-xs-6">
						<label for="">Date:</label>
						<input name="application_form_guarantor_1_signature_date" class="" type="text" value="<?php echo $applicationFormGuarantor1SignatureDate; ?>" />
					</div>
				</div>
				
				<div class="col-xs-12">
					<div class="no_gutter col-xs-6">
						<label for="">Guarantor 2:</label>
						
						<?php
							if(!isset($applicationFormGuarantor2Signature))
							{
						?>
								<canvas id="guarantor_2_signature_pad" height="150" width="400"></canvas>
								
								<div class="signature-pad">
									<div class="signature-pad--footer">
										<div class="description">Sign above</div>
						
										<button id="guarantor_2_signature_pad_clear_btn" type="button" class="button clear" data-action="clear">Clear</button>
									</div>
								</div>
								
								<input name="guarantor_2_signature_pad_image_url" type="hidden" value="" />
						<?php
							}
							
							else
							{
						?>
							
								<img src="<?php echo $applicationFormGuarantor2Signature; ?>" />
								<input name="guarantor_2_signature_pad_image_url" type="hidden" value="<?php echo $applicationFormGuarantor2Signature; ?>" />
						<?php
							}
						?>
					</div>
					<div class="no_gutter col-xs-6">
						<label for="">Date:</label>
						<input name="application_form_guarantor_2_signature_date" class="" type="text" value="<?php echo $applicationFormGuarantor2SignatureDate; ?>" />
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
				
				<div class="col-xs-12 text-center top_space">
					<input id="loan_application_save_application" type="button" value="Save Application" onclick="submitForm('/loan-application?save_application=true')" />
					<input id="loan_application_form_submit" type="button" value="Submit Application" onclick="submitForm('/loan-application')" />
				</div>
			</form>
		</div>
	<?php
}

add_shortcode('application_form_1', 'revolver_application_form_1');
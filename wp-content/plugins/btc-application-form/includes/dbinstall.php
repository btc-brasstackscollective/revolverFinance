<?php
/**
 * Developer: Doug Ingalls
 * Project: Revolver Financial
 */
// Function to create new database table
function application_form_create_table( $prefix )
{	
    // Prepare SQL query to create database table using received table prefix
    //create the application_forms table
    $application_forms_sql = 'CREATE TABLE IF NOT EXISTS ' . $prefix . 'application_forms (
		`form_id` int(20) AUTO_INCREMENT,
		`borrower_application_path` varchar(255) NULL,
		`application_status` varchar(50) NULL,
		`borrowers_name` varchar(50) NULL,
		`loan_amount` varchar(50) NULL,
		`maturity_term` varchar(50) NULL,
		`exit_strategy` varchar(255) NULL,
		`purchase_refinance` varchar(50) NULL,
		`address` varchar(255) NULL,
		`as_is_value` varchar(50) NULL,
		`purchase_price` varchar(50) NULL,
		`application_property_type` varchar(50) NULL,
		`as_completed_value` varchar(50) NULL,
		`units_count` varchar(50) NULL,
		`rehab_amount` varchar(50) NULL,
		`emd` varchar(50) NULL,
		`contract_expiration` varchar(50) NULL,
		`is_distress_sale` varchar(50) NULL,
		`is_contract_assignment` varchar(50) NULL,
		`occupied_at_any_time` varchar(50) NULL,
		`lawsuits_outstanding` varchar(50) NULL,
		`foreclosure_proceedings` varchar(50) NULL,
		`environmental_issues` varchar(50) NULL,
		`construction_budget` varchar(50) NULL,
		`licensed_gc` varchar(50) NULL,
		`months_to_complete` varchar(50) NULL,
		`building_permit_required` varchar(50) NULL,
		`number_prior_projects` varchar(50) NULL,
		`property_usage_changing` varchar(50) NULL,
		`draw_requests_expected` varchar(50) NULL,
		`additions_made` varchar(50) NULL,
		`guarantor_1_name` varchar(50) NULL,
		`guarantor_1_ownership_percentage` varchar(50) NULL,
		`guarantor_1_ssn` varchar(50) NULL,
		`guarantor_1_drivers_license` varchar(50) NULL,
		`guarantor_1_date_of_birth` varchar(50) NULL,
		`guarantor_1_address` varchar(255) NULL,
		`guarantor_1_own_or_rent` varchar(50) NULL,
		`guarantor_1_phone` varchar(50) NULL,
		`guarantor_1_email` varchar(50) NULL,
		`guarantor_1_liquid_assets` varchar(50) NULL,
		`guarantor_2_name` varchar(50) NULL,
		`guarantor_2_ownership_percentage` varchar(50) NULL,
		`guarantor_2_ssn` varchar(50) NULL,
		`guarantor_2_drivers_license` varchar(50) NULL,
		`guarantor_2_date_of_birth` varchar(50) NULL,
		`guarantor_2_address` varchar(255) NULL,
		`guarantor_2_own_or_rent` varchar(50) NULL,
		`guarantor_2_phone` varchar(50) NULL,
		`guarantor_2_email` varchar(50) NULL,
		`guarantor_2_liquid_assets` varchar(50) NULL,
		`experience_property_address_1` varchar(255) NULL,
		`experience_property_address_2` varchar(255) NULL,
		`experience_property_address_3` varchar(255) NULL,
		`experience_property_address_4` varchar(255) NULL,
		`experience_property_type_1` varchar(50) NULL,
		`experience_property_type_2` varchar(50) NULL,
		`experience_property_type_3` varchar(50) NULL,
		`experience_property_type_4` varchar(50) NULL,
		`experience_date_purchased_1` varchar(50) NULL,
		`experience_date_purchased_2` varchar(50) NULL,
		`experience_date_purchased_3` varchar(50) NULL,
		`experience_date_purchased_4` varchar(50) NULL,
		`experience_date_sold_1` varchar(50) NULL,
		`experience_date_sold_2` varchar(50) NULL,
		`experience_date_sold_3` varchar(50) NULL,
		`experience_date_sold_4` varchar(50) NULL,
		`experience_acquisition_cost_1` varchar(50) NULL,
		`experience_acquisition_cost_2` varchar(50) NULL,
		`experience_acquisition_cost_3` varchar(50) NULL,
		`experience_acquisition_cost_4` varchar(50) NULL,
		`experience_rehab_cost_1` varchar(50) NULL,
		`experience_rehab_cost_2` varchar(50) NULL,
		`experience_rehab_cost_3` varchar(50) NULL,
		`experience_rehab_cost_4` varchar(50) NULL,
		`experience_financing_source_1` varchar(50) NULL,
		`experience_financing_source_2` varchar(50) NULL,
		`experience_financing_source_3` varchar(50) NULL,
		`experience_financing_source_4` varchar(50) NULL,
		`experience_sale_price_1` varchar(50) NULL,
		`experience_sale_price_2` varchar(50) NULL,
		`experience_sale_price_3` varchar(50) NULL,
		`experience_sale_price_4` varchar(50) NULL,
		`experience_net_profit_1` varchar(50) NULL,
		`experience_net_profit_2` varchar(50) NULL,
		`experience_net_profit_3` varchar(50) NULL,
		`experience_net_profit_4` varchar(50) NULL,
		`declaration_convicted_of_crime` varchar(50) NULL,
		`declaration_outstanding_judgement` varchar(50) NULL,
		`declaration_litigation_defendant` varchar(50) NULL,
		`declaration_property_foreclosed` varchar(50) NULL,
		`declaration_delinquent_loan` varchar(50) NULL,
		`declaration_bankruptcy` varchar(50) NULL,
		`declaration_potential_litigation_collateral_property` varchar(50) NULL,
		`declaration_contested_tax_returns` varchar(50) NULL,
		`declaration_us_citizen` varchar(50) NULL,
		`declaration_permanent_resident_alien` varchar(50) NULL,
		`guarantor_1_signature_pad_image_url` blob NULL,
		`guarantor_1_signature_date` varchar(50) NULL,
		`guarantor_2_signature_pad_image_url` blob NULL,
		`guarantor_2_signature_date` varchar(50) NULL,
		`date_created` datetime NOT NULL,
		`date_modified` datetime NOT NULL,
		`date_reviewed` datetime NOT NULL,
		PRIMARY KEY (`form_id`)
	);';
	
	//create the settings table
	$settings_sql = 'CREATE TABLE IF NOT EXISTS ' . $prefix . 'application_form_settings (
		`email_address_application_review` varchar(50) NOT NULL
	);';
	
	//create the application user table
	$application_user_sql = 'CREATE TABLE IF NOT EXISTS ' . $prefix . 'application_user (
		`id` bigint(20) AUTO_INCREMENT,
		`user_email` varchar(60) NOT NULL,
		`user_password` varchar(255) NOT NULL,
		`user_firstname` varchar(50) NULL,
		`user_lastname` varchar(50) NULL,
		`user_status` int(11) NULL,
		`user_type` varchar(60) NOT NULL,
		PRIMARY KEY (`id`)
	);';
	
	//create the application form and user relation table
	$application_form_user_relation_sql = 'CREATE TABLE IF NOT EXISTS ' . $prefix . 'application_form_user (
		`user_id` bigint(20) NOT NULL,
		`application_id` int(20) NOT NULL
	);';
	
	//create the relational tbl for application user and application form tbls
	
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($application_forms_sql);
    dbDelta($settings_sql);
    dbDelta($application_user_sql);
    dbDelta($application_form_user_relation_sql);
}
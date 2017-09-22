<?php

// check if user is logged in
if($_SESSION["loggedIn"] != true)
{
	header("Location: /apply?redirect=/");
	exit;
}

// if not logged in redirect to sign in/register page

// get POST data

// create new entry in application_user tbl (user id with form id)

// save application form data to form tbl
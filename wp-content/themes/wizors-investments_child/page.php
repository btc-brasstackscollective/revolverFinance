<?php
/**
 * The template to display all single pages
 *
 * @package WordPress
 * @subpackage WIZORS_INVESTMENTS
 * @since WIZORS_INVESTMENTS 1.0
 */

get_header();
// include('/home/blackey1979/public_html/revolver.clients/wp-content/plugins/bridgeloannetwork.V3API.1.3.0/wrapper.php');

while ( have_posts() ) { the_post();

	get_template_part( 'content', 'page' );

	// If comments are open or we have at least one comment, load up the comment template.
	if ( !is_front_page() && ( comments_open() || get_comments_number() ) ) {
		comments_template();
	}

if ( get_the_ID()== 1219) { ?>

        <?php
                $url = 'http://www.testapi.bridgeloannetwork.com/V2/create_account.xml';

                $data = '"Post data":
                {
                  "api_key": "fVYc43UqPETezYpQd3yVEU",
                  "api_password": "VyEu9f7HqwyARBjQ2PCKDS",
                  "type": "broker",
                  "company_name": "acme",
                  "email": "duplicateborrower123@RCNRCNbln.com",
                  "fname": "Bugsy",
                  "lname": "Moran",
                  "phone": "(555)555-1212"
                }
                ';

                $additional_headers = array(                                                                          
                        'POST /v2/create_account.xml HTTP/1.1',
                        'HOST: stagingapi.bridgeloannetwork.com',
                        'content-type: application/x-www-form-urlencoded',
                        'cookie: CAKEPHP=52942a7d298af7bf8f5f50e2fa1b38a0',
                        'content-length: 160'
                );

                $ch = curl_init($url);                                                                      
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);                                                                  
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                curl_setopt($ch, CURLOPT_HTTPHEADER, $additional_headers); 

                $server_output = curl_exec ($ch);

                //echo  $server_output;
                ?>
        <h2>Test Create Account</h2>
        <p>Note: action="http://www.stagingapi.bridgeloannetwork.com/V2/create_account.json" method="POST"</p>
<form action="http://www.stagingapi.bridgeloannetwork.com/V2/create_account.json" method="POST">
                API Key:<br>
                <input type="text" name="api_key" value="fVYc43UqPETezYpQd3yVEU"><br>

                API Password:<br>
                <input type="text" name="api_password" value="VyEu9f7HqwyARBjQ2PCKDS"><br>

                Type:<br>
                <input type="text" name="type" value="broker"><br>

                Company Name:<br>
                <input type="text" name="company_name" value="acme"><br>

                Email:<br>
                <input type="text" name="email" value="duplicateborrower123@RCNRCNbln.com"><br>

                First name:<br>
                <input type="text" name="fname" value="Bugsy"><br>

                Last name:<br>
                <input type="text" name="lname" value="Moran"><br>

                Phone:<br>
                <input type="text" name="phone" value="(555)555-1212"><br>

                <input type="submit" value="Submit">
</form>
<?php } 


// change_password();

}

get_footer();
?>
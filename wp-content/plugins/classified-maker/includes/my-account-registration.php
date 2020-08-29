<?php
/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


function classified_maker_registration() {
	
    if (isset($_POST['submit'])) {
        classified_maker_registration_validation($_POST['username'],$_POST['password'],$_POST['email']);
		
		// sanitize user form input
        global $username, $password, $email;
        $username	= 	sanitize_user($_POST['username']);
        $password 	= 	esc_attr($_POST['password']);
        $email 		= 	sanitize_email($_POST['email']);


		// call @function complete_registration to create the user
		// only when no WP_error is found
        classified_maker_complete_registration(
        $username,
        $password,
        $email

		);
    }
else{
	global $username, $password, $email;
	}

    classified_maker_registration_form(
    	$username,
        $password,
        $email
		);
}

function classified_maker_registration_form( $username, $password, $email) {
	

    echo '
    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
	<p>
	<label for="username">'.__('Username',classified_maker_textdomain).' <strong>*</strong>
	<input type="text" name="username" value="' . (isset($_POST['username']) ? $username : null) . '">
	</label>
	</p>
	
	<p>
	<label for="password">'.__('Password',classified_maker_textdomain).' <strong>*</strong>
	<input type="password" name="password" value="' . (isset($_POST['password']) ? $password : null) . '">
	</label>
	</p>
	
	<p>
	<label for="email">'.__('Email',classified_maker_textdomain).' <strong>*</strong>
	<input type="text" name="email" value="' . (isset($_POST['email']) ? $email : null) . '">
	</label>
	</p>
	
	<input type="submit" name="submit" value="<?php echo __("Register", classified_maker_textdomain); ?>"/>
	</form>
	';
}

function classified_maker_registration_validation( $username, $password, $email )  {
    global $reg_errors;
    $reg_errors = new WP_Error;

    if ( empty( $username ) || empty( $password ) || empty( $email ) ) {
        $reg_errors->add('field', __('Required form field is missing',classified_maker_textdomain));
    }

    if ( strlen( $username ) < 4 ) {
        $reg_errors->add('username_length', __('Username too short. At least 4 characters is required',classified_maker_textdomain));
    }

    if ( username_exists( $username ) )
        $reg_errors->add('user_name',__( 'Sorry, that username already exists!',classified_maker_textdomain));

    if ( !validate_username( $username ) ) {
        $reg_errors->add('username_invalid', __('Sorry, the username you entered is not valid',classified_maker_textdomain));
    }

    if ( strlen( $password ) < 5 ) {
        $reg_errors->add('password', __('Password length must be greater than 5',classified_maker_textdomain));
    }

    if ( !is_email( $email ) ) {
        $reg_errors->add('email_invalid', __('Email is not valid',classified_maker_textdomain));
    }

    if ( email_exists( $email ) ) {
        $reg_errors->add('email', __('Email Already in use',classified_maker_textdomain));
    }
    


    if ( is_wp_error( $reg_errors ) ) {

        foreach ( $reg_errors->get_error_messages() as $error ) {
            echo '<div>';
            echo '<strong>'.__('ERROR',classified_maker_textdomain).'</strong>:';
            echo $error . '<br/>';

            echo '</div>';
        }
    }
}

function classified_maker_complete_registration() {
    global $reg_errors, $username, $password, $email;
    if ( count($reg_errors->get_error_messages()) < 1 ) {
        $userdata = array(
        'user_login'	=> 	$username,
        'user_email' 	=> 	$email,
        'user_pass' 	=> 	$password,

		);
        $user = wp_insert_user( $userdata );
        echo __('Registration complete.',classified_maker_textdomain);   
	}
}

// Register a new shortcode: [classified_maker_registration_form]
add_shortcode('classified_maker_registration_form', 'classified_maker_registration_shortcode');

// The callback function that will replace [book]
function classified_maker_registration_shortcode() {
    ob_start();
    classified_maker_registration();
    return ob_get_clean();
}

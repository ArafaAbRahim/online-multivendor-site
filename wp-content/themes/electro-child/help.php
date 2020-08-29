
<?php
/**
 *  Dokan Dashboard Template
 *
 *  Dokan Main Dahsboard template for Fron-end
 *
 *  @since 2.4
 *
 *  @package dokan
 */
?>
<div class="dokan-dashboard-wrap">
    <?php
        /**
         *  dokan_dashboard_content_before hook
         *
         *  @hooked get_dashboard_side_navigation
         *
         *  @since 2.4
         */
        do_action( 'dokan_dashboard_content_before' );
    ?>

    <div class="dokan-dashboard-content">

        <?php
            /**
             *  dokan_dashboard_content_before hook
             *
             *  @hooked show_seller_dashboard_notice
             *
             *  @since 2.4
             */
            do_action( 'dokan_help_content_inside_before' );
        ?>


<style>
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

#Home {background-color: white;}
#News {background-color: white;}

</style>
  


<button class="tablink" onclick="openPage('Home', this, '#19B5FE')" id="defaultOpen">Creat Your Ad</button>
<button class="tablink" onclick="openPage('News', this, '#19B5FE')" >Home Ad Details</button>
            
          

<div id="Home" class="tabcontent">

<?php echo do_shortcode("[table id=1 /]"); ?>





    <h1> Home Ad Form</h1>
    <h5>Fill all the Informations:</h5>
    <form action="" method="post">

          <p>

        <label for="location">Ad Location: <span>*</span> 

        <select name="location">

        <option value="Featured">Featured</option>

        <option value="On Sele">On Sale</option>

        <option value="Category">Category</option>

        </select>

        </p> 
        <br>
       Product Link: <input type="text" name="product_link"/><br><br>
       Product SKU: <input type="text" name="sku" /><br><br> 
       BKash Number: <input type="text" name="bk_no" /><br><br>
       BKash code: <input type="text" name="bk_code" /><br><br> 
       Days: <input type="text" name="days" /><br><br> 
       <input type="hidden" name="ad_status" value="Not Submitted"/>
       <input type="hidden" name="id" value="<?php echo esc_attr( $id );?>">
       <input type="submit" name="submit" />
    </form>

</div>

<div id="News" class="tabcontent">
  
  
  <div class="container">
    <div class="tab">
       <table id="table" border="2">
            <tr>
              <th>ID</th>
             <th>Location</th>
             <th>Product Link</th>
             <th>Product SKU</th>
             <th>BKash Number</th>
             <th>BKash Code</th>
             <th>Days</th>
            </tr>

          <?php
            global $current_user;
            wp_get_current_user();   
            ?>

            <?php global $wpdb;
            $userid=$current_user->user_login; 
            $result = $wpdb->get_results( "SELECT * FROM homead where username='$userid'");
            ?>

            <?php
            foreach ( $result as $print )   { ?>
              <tr>
                    
                  <td><?php echo $print->id; ?> </td>   
                  <td><?php echo $print->location; ?> </td>
                  <td><?php echo $print->product_link; ?> </td>
                   <td><?php echo $print->sku; ?> </td>
                  <td> <?php echo $print->bk_no ; ?> </td>
                  <td> <?php echo $print->bk_code; ?> </td>
                  <td><?php echo $print->days; ?> </td>
                
                
              </tr>
                <?php }
          ?>

        </table>
    </div>
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

<php
    global $current_user;
    $current_user = wp_get_current_user();    
    $_SESSION['WP']['userId'] = get_userdata( $current_user);

?>

 
</div>
        </article><!-- .dashboard-content-area -->

         <?php
            /**
             *  dokan_dashboard_content_inside_after hook
             *
             *  @since 2.4
             */
            do_action( 'dokan_dashboard_content_inside_after' );
        ?>


    </div><!-- .dokan-dashboard-content -->

    <?php
        /**
         *  dokan_dashboard_content_after hook
         *
         *  @since 2.4
         */
        do_action( 'dokan_dashboard_content_after' );
    ?>

</div><!-- .dokan-dashboard-wrap -->
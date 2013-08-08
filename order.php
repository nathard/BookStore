<?php include("inc/header.php") ?>


       <div class="center_content">
       	<div class="left_content">
            <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>Order</div>
        
        	
            
      <?php
         extract( $_POST );
         $iserror = false;
         require_once('inc/dbconnect.php');
		 require_once('inc/functions.php');
		 
		 
		 // Filter special characters
		 $uname = htmlentities($uname, ENT_QUOTES, "UTF-8");
         $email = htmlentities($email, ENT_QUOTES, "UTF-8");
         $phone = htmlentities($phone, ENT_QUOTES, "UTF-8");
         $cc_number = htmlentities($cc_number, ENT_QUOTES, "UTF-8");
		 $cc_name = htmlentities($cc_name, ENT_QUOTES, "UTF-8");	
		 $cc_expiry = htmlentities($cc_expiry, ENT_QUOTES, "UTF-8");
		 $address = htmlentities($address, ENT_QUOTES, "UTF-8");
		 $city = htmlentities($city, ENT_QUOTES, "UTF-8");
		 $postcode = htmlentities($postcode, ENT_QUOTES, "UTF-8");

         // ensure that all fields have been filled in correctly
         if ( isset ( $submit ) )
         {
            if ( $uname == "" )                   
            {
               $formerrors[ "unameerror" ] = true;
               $iserror = true;                   
            } // end if


            if ( !ereg("^[[:alpha:]]+@[[:alpha:]]+\.[[:alpha:]]+$", $email ) ) 
            {
               $formerrors[ "emailerror" ] = true;
               $iserror = true;
            } // end if			

			
            if ( !ereg( "^\([0-9]{3}\)[0-9]{3}-[0-9]{4}$", $phone ) ) 
            {
               $formerrors[ "phoneerror" ] = true;
               $iserror = true;
            } // end if
            
            
            if ( !ereg( "^[0-9]{16}", $cc_number ) )  
            {
               $formerrors[ "cc_numbererror" ] = true;
               $iserror = true;
            } // end if
            
            if ( $cc_name == "" ) 
            {
               $formerrors[ "cc_nameerror" ] = true;
               $iserror = true;
            } // end if
            
            if ( !ereg( "^[0-9]{4}", $cc_expiry ) ) 
            {
               $formerrors[ "cc_expiryerror" ] = true;
               $iserror = true;
            } // end if
            
            
            
            if ( $address == "" ) 
            {
               $formerrors[ "addresserror" ] = true;
               $iserror = true;
            } // end if
            
            if ( $city == "" ) 
            {
               $formerrors[ "cityerror" ] = true;
               $iserror = true;
            } // end if
            
            if ( !ereg( "^[0-9]{4}", $postcode ) ) 
            {
               $formerrors[ "postcodeerror" ] = true;
               $iserror = true;
            } // end if
            
            if ( !$iserror )  
            {
			  global $db;
			  
				// count the record in plants table and use id number $count+1 for the new record

			  $query_count = "SELECT max(ID) FROM purchases";
				 /* check the sql statement for errors and if errors report them */
			  $stmt = OCIParse($db, $query_count); 

			  if(!$stmt)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }

			  OCIExecute($stmt);			  

			  if (OCIFetch($stmt))  {
				
				$count = OCIResult($stmt,1);//returns the data for column 1 
				//echo $count."</br>";

			  } else {
				echo "An error occurred in retrieving order id.\n"; 
				exit; 
			  }

			  $count++;
			  
			   // build INSERT query
               $query = "INSERT INTO purchases ( ID, cont_name, cont_email, cont_phone, cc_number, cc_name, cc_expiry, ship_address, ship_city, ship_postcode, order_items, order_total ) " . 
			   "VALUES ( $count, '$uname', '$email', " . "'" . quotemeta( $phone ) . "', $cc_number, '$cc_name', $cc_expiry ,'$address', '$city', $postcode , '$cart', $grandtotal)";
				  
				  //echo "$query";
				  

				/* check the sql statement for errors and if errors report them */
			  $stmt = OCIParse($db, $query); 
			  //echo "SQL: $query<br>";
			  if(!$stmt)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
			  OCIExecute($stmt); 

               print( "
               	  <div class='feat_prod_box_details'>
               	  <p>Thank you <span><strong>$uname</strong></span>.<br />
                  Your order has been placed with Ted's Book Store.<br />
                  <strong>The following details have been stored in our database:</strong></p>
                  </div>
                  
				  <!-- print each form fields value -->
				  <table class='cart_table'>
                  <tr class='cart_title'>
                  <td>Order ID</td>
                  <td>Credit Card</td>
                  <td>Card holder name</td>
                  <td>Expiry date</td>
                  <td>Total charges</td>
                  </tr>
                  
                  <tr> 
                  <td>$count</td>
                  <td>**Protected**</td>
                  <td>$cc_name</td>
                  <td>$cc_expiry</td>
                  <td>$$grandtotal</td>
                  </tr></table><br />
                  
                  <table class='cart_table'>
                  <tr class='cart_title'>
                  <td>Contact name</td>
                  <td>Email address</td>
                  <td>Phone number</td>
                  </tr>
                  
                  <tr> 
                  <td>$uname</td>
                  <td>$email</td>
                  <td>$phone</td>
                  </tr></table><br />
                  
                  <table class='cart_table'>
                  <tr class='cart_title'>
                  <td>Shipping address</td>
                  <td>City</td>
                  <td>Postcode</td>
                  </tr>
                  
                  <tr>
                  <td>$address</td>
                  <td>$city</td>
                  <td>$postcode</td>
                  </tr></table><br />" );
			   
            } // end if 
         
		}
				
				// Prints the order form with validation
				
				// print cart contents read only
				print("<div class='feat_prod_box_details'>");
				echo readCart();
				print("</div>");
				
			 	
				if ( $iserror )                                                                                                 
					print( "<br /><p>Fields with * need to be filled in properly.</p>" );
				  
				print( "<form method='post' action='order.php'>" );
					
				// contact fields		
				print( "<div class='contact_form'>
                 <div class='form_subtitle'>Enter Contact Details</div>" );
					
				print( "<div class='form_row'>
                    <label class='contact'><strong>Username:</strong></label>
                    <input type='text' class='contact_input' name='uname' value = '" . $uname . "' />
                    </div>" );
                	if ( $formerrors[ "unameerror" ] == true ) 
					   print( "<span>*</span>" );
					   
				print( "<div class='form_row'>
                    <label class='contact'><strong>Email:</strong></label>
                    <input type='text' class='contact_input' name='email' value = '" . $email . "'/>
                    </div> " );
                    if ( $formerrors[ "emailerror" ] == true ) 
					   print( "<span>*</span>
					   			<div class='form_row'>e.g abc@email.com</div>" );
					   
				print( "<div class='form_row'>
                    <label class='contact'><strong>Phone:</strong></label>
                    <input type='text' class='contact_input' name='phone' value = '" . $phone . "'/>
                    </div> " );
                    if ( $formerrors[ "phoneerror" ] )
						print( "<span>*</span>" );
				  	print( "<div class='form_row'>e.g. (555)555-5555</div>" );
                
                print( "</div><!-- end of contact fields -->" );
                
                // payment fields
                print( "<div class='contact_form'>
                 <div class='form_subtitle'>Enter Payment Details</div>" );
                
				print( "<div class='form_row'>
                    <label class='order_large'><strong>Credit card Number:</strong></label>
                    <input type='text' class='contact_input' name='cc_number' maxlength='16' />
                    </div>" );
                    if ( $formerrors[ "cc_numbererror" ] == true ) 
					   print( "<span>*</span>
					   			<div class='form_row'>Must be 16 digits long</div>" );
					   
				print( "<div class='form_row'>
                    <label class='order_large'><strong>Card Holder Name:</strong></label>
                    <input type='text' class='contact_input' name='cc_name' value = '" . $cc_name . "'/>
                    </div> " );
                    if ( $formerrors[ "cc_nameerror" ] == true ) 
					   print( "<span>*</span>" );
					   
				print( "<div class='form_row'> 
					<label class='contact'><strong>Expiry date:</strong></label>
					<input type='text' class='order_small' name='cc_expiry' maxlength='4' value = '" . $cc_expiry . "'/> 
					</div> " );
					if ( $formerrors[ "cc_expiryerror" ] == true ) 
					   print( "<span>*</span>
					   			<div class='form_row'>Must be 4 digits long</div>" );
				
				print( "</div><!-- end of shipping fields -->" );
                
                // shipping fields
                print( "<div class='contact_form'>
                 <div class='form_subtitle'>Enter Shipping Details</div>" );
                
				print( "<div class='form_row'>
                    <label class='contact'><strong>Address:</strong></label>
                    <input type='text' class='contact_input' name='address' value = '" . $address . "'/>
                    </div>" );
                    if ( $formerrors[ "addresserror" ] == true ) 
					   print( "<span>*</span>" );
					   
				print( "<div class='form_row'>
                    <label class='contact'><strong>City:</strong></label>
                    <input type='text' class='contact_input' name='city' value = '" . $city . "'/>
                    </div> " );
                    if ( $formerrors[ "cityerror" ] == true ) 
					   print( "<span>*</span>" );
					   
				print( "<div class='form_row'> 
					<label class='contact'><strong>Postcode:</strong></label>
					<input type='text' class='order_small' name='postcode' maxlength='4' value = '" . $postcode . "'/> 
					</div> " );
					if ( $formerrors[ "postcodeerror" ] == true ) 
					   print( "<span>*</span>
					   			<div class='form_row'>Must be 4 digits long</div>" );
				
				print( "</div><!-- end of shipping fields -->" );
				
				print( "<!-- create a submit button -->
					<div class='form_row'>
                    <input type='submit' class='register' name='submit' value='continue' />
                    </div></form>" );
				
   ?><!-- end PHP script -->

				
                
        <div class="clear"></div>
        </div><!--end of left content-->
        
		<?php include("inc/right_content.php"); ?>
        
       <div class="clear"></div>
       </div><!--end of center content-->
	   
<?php include("inc/footer.php"); ?>

<?php include("inc/header.php") ?>


       <div class="center_content">
       	<div class="left_content">
            <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>Register</div>
        
        	<div class="feat_prod_box_details">
            <p class="details">
             Register your account to receive discounts and specials on books. The longer your a member the more exclusive access you will gain to rare titles. An account is also required if you want to save your details in the site for future use.
            </p>
            
      <?php
         extract( $_POST );
         $iserror = false;


         // Filter special characters
		 $uname = htmlentities($uname, ENT_QUOTES, "UTF-8");
		 $pword = htmlentities($pword, ENT_QUOTES, "UTF-8");
         $email = htmlentities($email, ENT_QUOTES, "UTF-8");
         $phone = htmlentities($phone, ENT_QUOTES, "UTF-8");
		 $address = htmlentities($address, ENT_QUOTES, "UTF-8");
		 $city = htmlentities($city, ENT_QUOTES, "UTF-8");
		 $postcode = htmlentities($postcode, ENT_QUOTES, "UTF-8");
		 
		 // encrypt password
		 $salt = 'ripSJ0511';
		 $pword = md5($salt. $pword);

         // ensure that all fields have been filled in correctly
         if ( isset ( $submit ) )
         {
            if ( $uname == "" )                   
            {
               $formerrors[ "unameerror" ] = true;
               $iserror = true;                   
            } // end if

            if ( $pword == "" ) 
            {
               $formerrors[ "pworderror" ] = true;
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
              require_once('inc/dbconnect.php');
			  global $db;
			  
				// count the record in plants table and use id number $count+1 for the new record

			  $query_count = "SELECT max(ID) FROM accounts";
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
				echo "An error occurred in retrieving account id.\n"; 
				exit; 
			  }

			  $count++;
			  
			   // build INSERT query
               $query = "INSERT INTO accounts ( ID, Username, Password, Email, Phone, Address, City, Postcode ) " . 
			   "VALUES ( $count, '$uname', '$pword', '$email', " . "'" . quotemeta( $phone ) . "', '$address', '$city', '$postcode' )";
				  
				  //echo "$query";
				  

				/* check the sql statement for errors and if errors report them */
			  $stmt = OCIParse($db, $query); 
			  //echo "SQL: $query<br>";
			  if(!$stmt)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
			  OCIExecute($stmt); 

               print( "<p>Hello<span>
                  <strong>$uname</strong></span>.<br />
                  Thank you for registering with Ted's Book Store.<br />

                  <strong>The following information has been saved 
                  to your account:</strong><br /></p>
				  <!-- print each form fields value -->
				  
                  <table class='cart_table'>
                  <tr class='cart_title'>
                  <td>Username:</td>
                  <td>Email:</td>
                  <td>Phone:</td>
                  <td>Address:</td>
                  <td>City:</td>
                  <td>Postcode:</td>
                  </tr>
                  
                  <tr> 
                  <td>$uname</td>
                  <td>$email</td>
                  <td>$phone</td>
                  <td>$address</td>
                  <td>$city</td>
                  <td>$postcode</td>
                  </tr></table>
                  <p>Remember to keep your password in a safe place.</p><br />" );

				  // Close the connection
				 //OCILogOff ($db); 
               //die();
			   
	
            }  
         
		} 
				
				 print( "<div class='contact_form'>
                 <div class='form_subtitle'>create new account</div>" );
			 
				 if ( $iserror )                                              
				 {                                                            
					print( "<br /><p>Fields with * need to be filled in properly.</p>" );
				 } // end if

				 print( "<!-- post form data to form.php -->
					<form method='post' action='register.php'>

					<!-- create text boxes for user input -->" );
					
				print( "<div class='form_row'>
                    <label class='contact'><strong>Username:</strong></label>
                    <input type='text' class='contact_input' name='uname' value = '" . $uname . "' />
                    </div>" );
                	if ( $formerrors[ "unameerror" ] == true ) 
					   print( "<span>*</span>" );
					
				print( "<div class='form_row'>
                    <label class='contact'><strong>Password:</strong></label>
                    <input type='password' class='contact_input' name='pword' />
                    </div> " );
                    if ( $formerrors[ "pworderror" ] == true ) 
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
				
				
				 print( "<!-- create a submit button -->
					<div class='form_row'>
                    <input type='submit' class='register' name='submit' value='register' />
                    </div></form></div>" );
				
   ?><!-- end PHP script -->

			</div>	
                
        <div class="clear"></div>
        </div><!--end of left content-->
        
		<?php include("inc/right_content.php"); ?>
        
       <div class="clear"></div>
       </div><!--end of center content-->
	   
<?php include("inc/footer.php"); ?>

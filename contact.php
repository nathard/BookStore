<?php

	include("inc/header.php");
	require_once("inc/captcha.php");
	
?>


       <div class="center_content">
       	<div class="left_content">
            <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>Contact Us</div>
        
        	<div class="feat_prod_box_details">
            <p class="details">
             Queries and Feedback welcome.<br /> 
			 Hours of Operation: 9am - 5pm, Monday to Friday, Eastern Standard Time.
            </p>
            
        <?php
         extract( $_POST );
         $iserror = false;
         
         
         /* Print neat arrays
         print("<pre>");
         print_r($_SESSION);
         print_r($_POST);
         print("</pre>");*/
         
         // filter special characters
         $uname = htmlentities($uname, ENT_QUOTES, "UTF-8");
         $email = htmlentities($email, ENT_QUOTES, "UTF-8");
         $phone = htmlentities($phone, ENT_QUOTES, "UTF-8");
         $company = htmlentities($company, ENT_QUOTES, "UTF-8");
         $message = htmlentities($message, ENT_QUOTES, "UTF-8");
         $code = htmlentities($code, ENT_QUOTES, "UTF-8");
         
         

		 
		 
		 	
         if ( isset ( $submit ) )
         {
         	
         	// error checking
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
            
            if ( $company == "" ) 
            {
               $formerrors[ "companyerror" ] = true;
               $iserror = true;
            } // end if
            
            if ( $message == "" ) 
            {
               $formerrors[ "messageerror" ] = true;
               $iserror = true;
            } // end if
            
            if ( $code != $captcha )  
            {
               $formerrors[ "codeerror" ] = true;
               $iserror = true;
            } // end if
            
            if ( !$iserror )  
            {
            	// references: http://www.freecontactform.com/email_form.php
              	// EDIT THE 2 LINES BELOW TO TEST 
    		  	$email_to = "nlha@deakin.edu.au";
    		  	$email_subject = "Ted's Contact form";
    		  
    		  	$email_message = "Contact form details below.\n\n";
     			
    			$email_message .= "Name: ".$uname."\n";
    			$email_message .= "Email: ".$email."\n";
    			$email_message .= "Phone: ".$phone."\n";
    			$email_message .= "Company: ".$company."\n";
    			$email_message .= "Message: ".$message."\n";
     
     
				// create email headers
				$headers = 'From: '.$email_from."\r\n".
				'Reply-To: '.$email_from."\r\n" .
				'X-Mailer: PHP/' . phpversion();
				@mail($email_to, $email_subject, $email_message, $headers);
				
				print("<p class='details'><strong>Your message has been sent to Ted's Book Store<br>
						We will get back to you as soon as possible.</strong></p>");

            }  
         
		} 
		
				//Create a new captcha
		 		$_SESSION['captcha'] = rand(100, 10000);
		 		unset($captcha);
		 		$captcha = new captcha();
		 		$captcha->create($_SESSION['captcha']);
				
				 print( "<div class='contact_form'>
                 <div class='form_subtitle'>all fields are required</div>" );
			 
				 if ( $iserror )                                              
				 {                                                            
					print( "<br /><p>Fields with * need to be filled in properly.</p>" );
				 } // end if

				 print( "<!-- post form data to contact.php -->
					<form method='post' action='contact.php'>

					<!-- create text boxes for user input -->" );
					
				print( "<div class='form_row'>
                    <label class='contact'><strong>Name:</strong></label>
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
                    
				print( "<div class='form_row'>
                    <label class='contact'><strong>Company:</strong></label>
                    <input type='text' class='contact_input' name='company' value = '" . $company . "'/>
                    </div>" );
                    if ( $formerrors[ "companyerror" ] == true ) 
					   print( "<span>*</span>" );
					   
				print( "<div class='form_row'>
                    <label class='contact'><strong>Message:</strong></label>
                    <textarea class='contact_textarea' name='message' cols='0' rows='0'></textarea>
                    </div> " );
                    if ( $formerrors[ "messageerror" ] == true ) 
					   print( "<span>*</span>" );
					   
				print( "<div class='form_row'> 
					<label class='contact'><strong>Enter code:</strong></label>
					<input type='text' class='order_small' name='code' maxlength='5' value = '" . $code . "'/> 
					</div> " );
					if ( $formerrors[ "codeerror" ] == true ) 
					   print( "<span>*</span>
					   			<div class='form_row'>Code did not match. Try again.</div>" );
					   			
				print("<div class='form_row'>
                    <img src='captcha.png' alt='' title='' border='0' />
                    </div>");
				
				
				 print( "<!-- create a submit button -->
					<div class='form_row'>
                    <input type='submit' class='register' name='submit' value='send' />
                    </div></form></div>" );
				
   		?><!-- end PHP script -->
            
            	<!--
              	<div class="contact_form">
              	
              	<form method='post' action='contact.php'>
                <div class="form_subtitle">all fields are required</div>          
                    <div class="form_row">
                    <label class="contact"><strong>Name:</strong></label>
                    <input type="text" class="contact_input" />
                    </div>  

                    <div class="form_row">
                    <label class="contact"><strong>Email:</strong></label>
                    <input type="text" class="contact_input" />
                    </div>


                    <div class="form_row">
                    <label class="contact"><strong>Phone:</strong></label>
                    <input type="text" class="contact_input" />
                    </div>
                    
                    <div class="form_row">
                    <label class="contact"><strong>Company:</strong></label>
                    <input type="text" class="contact_input" />
                    </div>


                    <div class="form_row">
                    <label class="contact"><strong>Message:</strong></label>
                    <textarea class="contact_textarea" cols="0" rows="0"></textarea>
                    </div>

					<div class="form_row">
                    <label class="contact"><strong>Enter Code:</strong></label>
                    <input type="text" class="order_small" name="captcha" />
                    </div>
                    
                    <div class="form_row">
                    <img src="captcha.png" alt="" title="" border="0" />
                    </div>
                    
                    <div class="form_row">
                    <input type='submit' class='register' name='submit' value='send' /></div>
                </form>
                
                </div>  -->
            
          </div>	
            
              

            

            
        <div class="clear"></div>
        </div><!--end of left content-->
        
		<?php include("inc/right_content.php") ?>
        
       <div class="clear"></div>
       </div><!--end of center content-->
<?php include("inc/footer.php") ?>       
              

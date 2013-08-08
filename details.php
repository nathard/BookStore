<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Ted's Book Store</title>
<link rel="stylesheet" type="text/css" href="style.css" />
	<link rel="stylesheet" href="lightbox.css" type="text/css" media="screen" />
	
	<script src="js/prototype.js" type="text/javascript"></script>
	<script src="js/scriptaculous.js?load=effects" type="text/javascript"></script>
	<script src="js/lightbox.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/java.js"></script>
    <script type="text/javascript">
		var tabber1 = new Yetii({
		id: 'demo'
		});
	</script>
	
</head>
<body>
<div id="wrap">

       <div class="header">
       		<div class="logo"><a href="index.html"><img src="images/logo.gif" alt="" title="" border="0" /></a></div>            
        <div id="menu">
            <ul>                                                                       
            <li><a href="index.php">home</a></li>
            <li><a href="about.php">about us</a></li>
            <li><a href="books.xml">books</a></li>
            <li><a href="search.php">search</a></li>
            <li><a href="specials.php">specials</a></li>
            <li><a href="myaccount.php">my account</a></li>
            <li><a href="register.php">register</a></li>
            <li><a href="order.php">order</a></li>
            <li><a href="specials.php">prices</a></li>
            <li><a href="contact.php">contact</a></li>
            </ul>
        </div>     
            
            
       </div> 
       
       
       <div class="center_content">
       	<div class="left_content">
       	
       		<?php
       		// connect to database and execute sql statement to retrieve book details
            	require_once('inc/dbconnect.php');
            	$id = $_GET['id']; // from book links
            	if(!$id){
            	
            	echo "Please select a book from our catalogue.\n";
            	exit;
            	}
            	
            	$sql = 'SELECT * FROM books WHERE id = '.$id;
						
				$stmt = OCIParse($db, $sql); 
  				
				if(!$stmt)  {
					echo "An error occurred in parsing the sql string.\n"; 
					exit; 
			  	}
				OCIExecute($stmt);
            	while(OCIFetch($stmt)) {
					
					$title = OCIResult($stmt,"TITLE");
					$author = OCIResult($stmt,"AUTHOR");
					$publisher = OCIResult($stmt,"PUBLISHER");
					$isbn = OCIResult($stmt,"ISBN");
					$year = OCIResult($stmt,"YEAR");
					$cover = OCIResult($stmt,"COVER");
					$price = OCIResult($stmt,"PRICE");
					$description = OCIResult($stmt,"DESCRIPTION");
					
					
				}
				
			?>
			
			
			<?php
			
				print '<div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" /></span>'.$title.'</div>';
				print '<div class="feat_prod_box_details">';
				print '<div class="prod_img"><img src="images/'.$cover.'" alt="" border="0" width="98" height="150"/>';
				print '<br /><br />';
				print '<a href="images/'.$cover.'" rel="lightbox"><img src="images/zoom.gif" alt="" border="0" /></a>';
				print '</div>';
			?>
			
			<div class="prod_det_box">
			<div class="box_top"></div>
			<div class="box_center">
			<div class="prod_title">Details</div>
			
			<?php 
			
				print '<p class="details">'.$description.'</p>';
				print '<div class="price"><strong>PRICE: </strong>';
				print '<span class="red">$'.$price.'</span></div>';
				print '<a href="cart.php?action=add&id='.$id.'" class="more"><img src="images/order_now.gif" alt="" border="0" /></a>';
			
			?>
			
			<div class="clear"></div>
			</div>
			
			<div class="box_bottom"></div>
			</div>
			
            <div class="clear"></div>
            </div>	
            
              
            <div id="demo" class="demolayout">

                <ul id="demo-nav" class="demolayout">
                <li><a class="active" href="#tab1">More details</a></li>
                <li><a class="" href="#tab2">Related books</a></li>
                </ul>
    
            <div class="tabs-container">
            
                    <div style="display: block;" class="tab" id="tab1">
                            <br />            
                            <ul class="list">
                        
                        <?php
                        
                            print '<li><a href="#">Author: </a>'.$author.'</li>';
                            print '<li><a href="#">Publisher: </a>'.$publisher.'</li>';
                            print '<li><a href="#">ISBN: </a>'.$isbn.'</li>';
                            print '<li><a href="#">Year of release: </a>'.$year.'</li>';
                            
                        ?>
                            </ul>                          
                    </div>	
                    
                            <div style="display: none;" class="tab" id="tab2">
                            
                    <div class="new_prod_box">
                        <a href="details.html">A Class Apart</a>
                        <div class="new_prod_bg">
                        <a href="details.html"><img src="bookimages/eduthumb2.jpg" alt="" title="" class="thumb" border="0" /></a>
                        </div>           
                    </div>
                    


                   
                    <div class="clear"></div>
                            </div>	
            
            </div>

			</div>
            

            
        <div class="clear"></div>
        </div><!--end of left content-->
        
        <?php include("inc/right_content.php") ?>
        
        
       
       
       <div class="clear"></div>
       </div><!--end of center content-->
       
              
<?php include("inc/footer.php") ?> 
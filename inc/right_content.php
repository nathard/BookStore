<?php require_once('inc/functions.php')?>

<div class="right_content">
        	<div class="languages_box">
            <span class="red">Languages:</span>
            <a href="#" class="selected"><img src="images/gb.gif" alt="" title="" border="0" /></a>
            <a href="#"><img src="images/fr.gif" alt="" title="" border="0" /></a>
            <a href="#"><img src="images/de.gif" alt="" title="" border="0" /></a>
            </div>
                <div class="currency">
                <span class="red">Currency: </span>
                <a href="#">GBP</a>
                <a href="#">EUR</a>
                <a href="#" class="selected">USD</a>
                </div>
                
                
                  <div class="cart">
                  <div class="title"><span class="title_icon"><img src="images/cart.gif" alt="" title="" /></span>My cart</div>
                  <div class="home_cart_content">
                  
                  <?php 
                  // display number of items in cart
                  echo writeShoppingCart();
                  
                  // display total 0 when empty
                  if (!$grandtotal) {
                  $grandtotal = 0.00;
                  }
                  print '<span class="red"> TOTAL: $'.$grandtotal.'</span>';
                  ?>
                  
                  </div>
                  <a href="cart.php" class="view_cart">view cart</a>
                 
              </div>
                       
            	
        
        
             <div class="title"><span class="title_icon"><img src="images/bullet3.gif" alt="" title="" /></span>About Ted's Store</div> 
             <div class="about">
             <p>
             <img src="images/about.gif" alt="" title="" class="right" />
             Ted's Book Store has been in business for over 75 years! We are rated highly by our customers for our exclusive titles offered by no other book store in the world. Check out some of our rare specials!
             </p>
             
             </div>
             
             <div class="right_box">
             
             	<div class="title"><span class="title_icon"><img src="images/bullet4.gif" alt="" title="" /></span>Promotions</div> 
                    <div class="new_prod_box">
                        <a href="details.php?id=4">The Geek Handbook</a>
                        <div class="new_prod_bg">
                        <span class="new_icon"><img src="images/promo_icon.gif" alt="" title="" /></span>
                        <a href="details.php?id=4"><img src="bookimages/compthumb1.jpg" alt="" title="" class="thumb" border="0" /></a>
                        </div>           
                    </div>
                    
                    <div class="new_prod_box">
                        <a href="details.php?id=6">Class Warfare</a>
                        <div class="new_prod_bg">
                        <span class="new_icon"><img src="images/promo_icon.gif" alt="" title="" /></span>
                        <a href="details.php?id=6"><img src="bookimages/eduthumb1.jpg" alt="" title="" class="thumb" border="0" /></a>
                        </div>           
                    </div>                    
                    
                    <div class="new_prod_box">
                        <a href="details.php?id=10">American Emperor</a>
                        <div class="new_prod_bg">
                        <span class="new_icon"><img src="images/promo_icon.gif" alt="" title="" /></span>
                        <a href="details.php?id=10"><img src="bookimages/histhumb2.jpg" alt="" title="" class="thumb" border="0" /></a>
                        </div>           
                    </div>              
             
             </div>
             
             <div class="right_box">
             
             	<div class="title"><span class="title_icon"><img src="images/bullet5.gif" alt="" title="" /></span>Categories</div> 
                
                <ul class="list">
              	<li><a href="#">Architecture</a></li>
              	<li><a href="#">Business</a></li>
              	<li><a href="#">Computers</a></li>
              	<li><a href="#">Education</a></li>
              	<li><a href="#">Games</a></li>
              	<li><a href="#">History</a></li>
              	<li><a href="#">Law</a></li>
              	<li><a href="#">Mathematics</a></li>
              	<li><a href="#">Nature</a></li>
              	<li><a href="#">Philosophy</a></li>
              	<li><a href="#">Sport</a></li>
            	</ul>
                
             	<div class="title"><span class="title_icon"><img src="images/bullet6.gif" alt="" title="" /></span>Members</div> 
                
                <ul class="list">
            	<li><a href="#">Accesories</a></li>
            	<li><a href="#">Favourite books</a></li>
            	<li><a href="#">Gift options</a></li>
            	<li><a href="#">History</a></li>
            	<li><a href="#">Recent purchases</a></li>
            	<li><a href="#">Specials</a></li>
            	<li><a href="#">Update details</a></li>
            	</ul>      
             
             </div>         
             
        
        </div>
        
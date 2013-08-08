<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method = "html" omit-xml-declaration = "no" doctype-system = "http://www.w3c.org/TR/xhtml1/DTD/xhtml1-strict.dtd" doctype-public = "-//W3C//DTD XHTML 1.0 Strict//EN"/>  
<!-- Built from category.html //-->

<xsl:template match="/">
  <html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
  <title>Ted's Book Store</title>
  <link rel="stylesheet" type="text/css" href="style.css" />

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
            <li><a href="details.php?id=1">prices</a></li>
            <li><a href="contact.php">contact</a></li>			
            </ul>
		</div>     
            
            
	</div>
  
       <div class="center_content">
        <div class="left_content">
            
        	<div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>All books</div>
           <div class="new_products">
           
           			<!-- Use for loop to display books of all categories from xml //-->
           			
           			<xsl:for-each select="bookstore/category/book">
                    <div class="new_prod_box">
                        <a href="details.php?id={@id}"><xsl:value-of select="title"/></a>
                        <div class="new_prod_bg">
                        <a href="details.php?id={@id}">
                        <img class="thumb" width="60" height="90">
                        <xsl:attribute name="src">
                        <xsl:value-of select="cover" />
                        </xsl:attribute>
                        </img></a>
                        </div>           
                    </div>
                    </xsl:for-each>
                                        
            
            <div class="pagination">
            <a href="#?page=200">&lt;&lt;</a><span class="current">1</span><a href="#?page=2">2</a><a href="#?page=3">3</a>…<a href="#?page=199">10</a><a href="#?page=200">11</a><a href="#?page=2">&gt;&gt;</a>
            </div>
            </div> 
            
          
            
        <div class="clear"></div>
        </div>
        
        <div class="right_content">
        	<div class="languages_box">
            <span class="red">Languages:</span>
            <a href="#"><img src="images/gb.gif" alt="" title="" border="0" /></a>
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
                  3 x items | <span class="red">TOTAL: $75.00</span>
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
             	
             		<!-- Use for loop to display promotions based on price conditions -->
             		
                    <xsl:for-each select="bookstore/category/book">
                    <xsl:if test="price &gt; 28.00">
                    <div class="new_prod_box">
                        <a href="details.php?id={@id}"><xsl:value-of select="title"/></a>
                        <div class="new_prod_bg">
                        <span class="new_icon"><img src="images/promo_icon.gif" alt="" title="" /></span>
                        <a href="details.php?id={@id}">
                        <img class="thumb" width="60" height="90">
                        <xsl:attribute name="src">
                        <xsl:value-of select="cover" />
                        </xsl:attribute>
                        </img></a>
                        </div>           
                    </div>
                    </xsl:if>
                    </xsl:for-each>              
             
             </div>
             
             <div class="right_box">
             
             	<div class="title"><span class="title_icon"><img src="images/bullet5.gif" alt="" title="" /></span>Categories</div> 
                
                <!-- Use for loop to display categories list -->
                
                <ul class="list">
                <xsl:for-each select="bookstore/category">
                <li><a href="#"><xsl:value-of select="@name"/></a></li>
                </xsl:for-each>
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
             
        
        </div><!--end of right content-->
        
        
       
       
       <div class="clear"></div>
       </div>
       
       <div class="footer">
       	<div class="left_footer"><img src="images/footer_logo.gif" alt="" title="" /><br /> <a href="http://csscreme.com/freecsstemplates/" title="free templates"><img src="images/csscreme.gif" alt="free templates" title="free templates" border="0" /></a></div>
        <div class="right_footer">
        <a href="#">home</a>
        <a href="#">about us</a>
        <a href="#">services</a>
        <a href="#">privacy policy</a>
        <a href="#">contact us</a>
       
        </div>
        
        <div>
        <p class="details">© Deakin University, School of Information Technology.<br />
        This web page has been developed as a student assignment for the unit SIT203:<br />
        Web Programming. Therefore it is not part of the University's authorised web site.<br />
        DO NOT USE THE INFORMATION CONTAINED ON THIS WEB PAGE IN ANY WAY.</p>
        </div>
       
       </div>
       
       
  </div>
  </body>
  </html>
  
</xsl:template>
</xsl:stylesheet>
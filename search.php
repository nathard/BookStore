<?php include('inc/header.php'); ?>
      
      <div class="center_content">
      
       	<div class="left_content">
          <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>Search</div>
          <div class="feat_prod_box_details">
          	<form action="results.php" method="get" >
            <div class="contact_form">
                <div class="form_subtitle">Enter Search Criteria</div>
                <div class="form_row">
                	<p>e.g. book title</p>
                	<!-- execute java/xml method to display suggestions 'onkeyup' -->
                	<input class="contact_input" type="text" onkeyup="showResult(this.value)" name="search" />
                	<input class="register" value="search" type="submit" />
                </div>
                <!-- print suggestions -->
              	<div id="hint">
        	  	</div>
            </div>

            
            </form>        
        
          </div>
        <div class="clear"></div>
        </div><!--end of left content-->
                
      	<?php include("inc/right_content.php") ?>
        
      <div class="clear"></div>
      </div>
      <!--end of center content-->
      
<?php include("inc/footer.php") ?>
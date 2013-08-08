<?php include("inc/header.php") ?>

       <div class="center_content">
       	<div class="left_content">
       	<div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>Search</div>
          <div class="feat_prod_box_details">
          	<form action="results.php" method="get" >
            <div class="contact_form">
                <div class="form_subtitle">Enter Search Criteria</div>
                <div class="form_row">
                	<p>e.g. book title</p>
                	<input class="contact_input" type="text" onkeyup="showResult(this.value)" name="search" />
                	<input class="register" value="search" type="submit" />
                </div>
              <div id="hint">
              
        	  </div>
            </div>

            
            </form>        
        
          </div>
    <?php    	
    require_once('inc/dbconnect.php'); 
    
    //print "<pre>";
	//print_r($_GET);
    $SQL_FROM = 'books';
	$SQL_WHERE = 'title';
	
	// set global session variable to return to results from other pages
	global $searchq;
	$searchq = strip_tags($_GET['search']);
	$_SESSION['searchq'] = $searchq;
	
	// filter special characters
	$searchq = htmlentities($searchq, ENT_QUOTES, "UTF-8");
	
	
	// convert search cases to lower to ignore sensitivity
	strtolower($searchq);
	$sql	=	"SELECT * FROM ".$SQL_FROM." WHERE lower(".$SQL_WHERE.") LIKE '%".$searchq."%'";
		
	$stmt = OCIParse($db, $sql); 
  
	if(!$stmt)  {
		echo "An error occurred in parsing the sql string.\n"; 
		exit; 
	  }
	OCIExecute($stmt); 

	// build result object
	while(OCIFetch($stmt)) {

		$title= OCIResult($stmt,"TITLE");
		$cover= OCIResult($stmt,"COVER");
		$id= OCIResult($stmt,"ID");
		
		$output[] = '<div class="new_prod_box">';
		$output[] = '<a href="details.php?id='.$id.'">'.$title.'</a>';
		$output[] = '<div class="new_prod_bg">';
		$output[] = '<a href="details.php?id='.$id.'"><img src="bookimages/'.$cover.'" class="thumb" alt="" border="0" /></a>';
		$output[] = '</div></div>';
	}	
	// print results
	if ($title == "")
		echo "<div class='new_prod_box'><strong>No results, try again</strong></div>";
	else
		echo join('',$output);
	
	
    ?>
        
        <div class="clear"></div>
        </div><!--end of left content-->
        
		<?php include("inc/right_content.php") ?>
        
       <div class="clear"></div>
       </div><!--end of center content-->
       
<?php include("inc/footer.php") ?>       
              

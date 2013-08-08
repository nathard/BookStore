<?php
	
	include('inc/header.php'); 
	require_once('inc/dbconnect.php');
	require_once('inc/functions.php');

	
?> 

<?php

$cart = $_SESSION['cart'];
$action = $_GET['action'];

switch ($action) {
	case 'add':
		if ($cart) {
			$cart .= ','.$_GET['id'];
		} else {
			$cart = $_GET['id'];
		}
		break;
	case 'delete':
		if ($cart) {
			$items = explode(',',$cart);
			$newcart = '';
			foreach ($items as $item) {
				if ($_GET['id'] != $item) {
					if ($newcart != '') {
						$newcart .= ','.$item;
					} else {
						$newcart = $item;
					}
				}
			}
			$cart = $newcart;
		}
		break;
	case 'update':
	if ($cart) {
		$newcart = '';
		foreach ($_POST as $key=>$value) {
			if (stristr($key,'qty')) {
				$id = str_replace('qty','',$key);
				$items = ($newcart != '') ? explode(',',$newcart) : explode(',',$cart);
				$newcart = '';
				foreach ($items as $item) {
					if ($id != $item) {
						if ($newcart != '') {
							$newcart .= ','.$item;
						} else {
							$newcart = $item;
						}
					}
				}
				for ($i=1;$i<=$value;$i++) {
					if ($newcart != '') {
						$newcart .= ','.$id;
					} else {
						$newcart = $id;
					}
				}
			}
		}
	}
	$cart = $newcart;
	break;
}
$_SESSION['cart'] = $cart;
?><!-- cart actions -->

       <div class="center_content">
       	<div class="left_content">
            <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>My cart</div>
        
        	
        	<div class="feat_prod_box_details">
            <p>Books are shipped at a flat rate of $4.95 per book.<br />
               Prices are GST inclusive.</p>
            
            <?php
			
			echo showCart();
            
            print '<a href="results.php?search='.$searchq.'" class="continue">&lt; continue</a>';
            print '<a href="order.php" class="checkout">checkout &gt;</a>';
            
			?>
            
            
            </div>	
            
        <div class="clear"></div>
        
         
			
        </div><!--end of left content-->
        
       <?php include('inc/right_content.php'); ?>
        
       <div class="clear"></div>
       </div><!--end of center content-->
                  
<?php include('inc/footer.php'); ?>
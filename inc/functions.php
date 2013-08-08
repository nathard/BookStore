<?php
function writeShoppingCart() {
	$cart = $_SESSION['cart'];
	
	if (!$cart) {
		return '0 x items | ';
	} else {
		// Parse the cart session variable
		$items = explode(',',$cart);
		$s = (count($items) > 1) ? 's':'';
		return ''.count($items).' x item'.$s.' | ';
	}
}

function showCart() {
	global $db;
	global $grandtotal;
	
	
	$cart = $_SESSION['cart'];
	if ($cart) {
		$items = explode(',',$cart);
		$contents = array();
		foreach ($items as $item) {
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
		}
		$output[] = '<form action="cart.php?action=update" method="post" id="cart">';
		$output[] = '<table class="cart_table">';
		$output[] = '<tr class="cart_title">';
		$output[] = '<td></td><td>Book name</td><td>Unit price</td><td>Qty</td><td>Total</td>';
		$output[] = '</tr>';
		
		foreach ($contents as $id=>$qty) {
		
			$sql = 'SELECT * FROM books WHERE id = '.$id;
			
						
			$stmt = OCIParse($db, $sql); 
  
			if(!$stmt)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
			OCIExecute($stmt); 

			while(OCIFetch($stmt)) {

				$title= OCIResult($stmt,"TITLE");
				$author = OCIResult($stmt,"AUTHOR");
				$price = OCIResult($stmt,"PRICE");
				$id = OCIResult($stmt,"ID");				
			}
			// calculate gst and shipping
			$gst = 0.1;
			$price = $price + ($price * $gst);
			$price = number_format($price, 2);
			$subtotal = number_format(($price * $qty), 2);
			$shipping += (4.95 * $qty);
			$total += $subtotal + $shipping;
			
			// display items in cart
			$output[] = '<tr>';
			$output[] = '<td><a href="cart.php?action=delete&id='.$id.'" class="r">Remove</a></td>';
			$output[] = '<td>'.$title.'</td>';
			$output[] = '<td>$'.$price.'</td>';
			$output[] = '<td><input type="text" name="qty'.$id.'" value="'.$qty.'" size="3" maxlength="3" /></td>';
			$output[] = '<td>$'.$subtotal.'</td>';
			$output[] = '</tr>';
		}
		
		// set global to use in right content
		$grandtotal = number_format($total, 2);
		$_SESSION['grandtotal'] = $grandtotal;
		
		// display shipping
		$totalshipping = number_format($shipping, 2);
		$output[] = '<tr>';
		$output[] = '<td colspan="4" class="cart_total"><span class="red">TOTAL SHIPPING:</span></td>';
		$output[] = '<td>$'.$totalshipping.'</td>';
		$output[] = '</tr>';
		// display total
		$output[] = '<tr>';
		$output[] = '<td colspan="4" class="cart_total"><span class="red">GRAND TOTAL:</span></td>';
		$output[] = '<td>$'.$grandtotal.'</td>';
		$output[] = '</tr>';
		$output[] = '</table>';
		$output[] = '<div><button type="submit">Update cart</button></div>';
		$output[] = '</form>';
		
	} else {
		$output[] = '<p>Your shopping cart is empty.</p>';
		$grandtotal = 0;
	}
	return join('',$output);
}

function readCart() {
	global $db;
	global $grandtotal;
	
	
	$cart = $_SESSION['cart'];
	if ($cart) {
		$items = explode(',',$cart);
		$contents = array();
		foreach ($items as $item) {
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
		}
		$output[] = '<table class="cart_table">';
		$output[] = '<tr class="cart_title">';
		$output[] = '<td>Book name</td><td>Unit price</td><td>Qty</td><td>Total</td>';
		$output[] = '</tr>';
		
		foreach ($contents as $id=>$qty) {
		
			$sql = 'SELECT * FROM books WHERE id = '.$id;
			
						
			$stmt = OCIParse($db, $sql); 
  
			if(!$stmt)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
			OCIExecute($stmt); 

			while(OCIFetch($stmt)) {

				$title= OCIResult($stmt,"TITLE");
				$author = OCIResult($stmt,"AUTHOR");
				$price = OCIResult($stmt,"PRICE");
				$id = OCIResult($stmt,"ID");				
			}
			// calculate gst and shipping
			$gst = 0.1;
			$price = $price + ($price * $gst);
			$price = number_format($price, 2);
			$subtotal = number_format(($price * $qty), 2);
			$shipping += (4.95 * $qty);
			$total += $subtotal + $shipping;
			
			// display items in cart
			$output[] = '<tr>';
			$output[] = '<td>'.$title.'</td>';
			$output[] = '<td>$'.$price.'</td>';
			$output[] = '<td>'.$qty.'</td>';
			$output[] = '<td>$'.$subtotal.'</td>';
			$output[] = '</tr>';
		}
		
		// set global totals to use in session
		$grandtotal = number_format($total, 2);
		$_SESSION['grandtotal'] = $grandtotal;
		
		// display shipping
		$totalshipping = number_format($shipping, 2);
		$output[] = '<tr>';
		$output[] = '<td colspan="3" class="cart_total"><span class="red">TOTAL SHIPPING:</span></td>';
		$output[] = '<td>$'.$totalshipping.'</td>';
		$output[] = '</tr>';
		// display total
		$output[] = '<tr>';
		$output[] = '<td colspan="3" class="cart_total"><span class="red">GRAND TOTAL:</span></td>';
		$output[] = '<td>$'.$grandtotal.'</td>';
		$output[] = '</tr>';
		$output[] = '</table>';
		
	} else {
		$output[] = '<p>Your shopping cart is empty.<br />Order books by selecting the <strong>Order Now</strong> button when viewing book details.</p>';
		$grandtotal = 0;
	}
	return join('',$output);
}

?>

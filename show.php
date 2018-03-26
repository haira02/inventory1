<?php

	 @require_once('initialized.php');

	 if($_POST['id'] != null){
	 	$id = $_POST['id'];
		 $item = Item::find_by_id($id);
		 if($item){
		 	echo "<h4>";
			 echo "Description: ";
			 echo $item->disc;
			 echo "</h4>";
			 echo "<h4>";
			 echo "<br>Price: ";
			 echo $item->price;
			 echo "</h4>";
			 echo "<input type='hidden' name='item_c' value='{$item->id}'>";
		} else {
			echo "<h4>Item code is not registered!</h4>";
		} 
		 
	} 
	 

?>
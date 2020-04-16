<?php
	// get the head of the html page
	//ensure that you include your name in the title
	include "./templates/head.php"; 

	
	// Check if the submit button has been clicked, if not then display the form
	// with the combo box (select box)
	// the name of the button must match (i.e. submit)
		?>
		<h1>Products</h1>
		<!-- the form action is this page -->
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class='centre'>
		<?php
		//connect to the database
			require('connect.php');
			
			// get the information for the selected supplier
			$supp = mysqli_query($conn, "SELECT * from product");
			$suppName = mysqli_fetch_row($supp);
			//get required the supplier information from the database
			$result = mysqli_query($conn, "SELECT Descr, CategoryID, CostPrice FROM Product");
			if(mysqli_num_rows($result) > 0)
			{
				
				//display the table
				echo "<table class ='centre'>";
				//display the header row of the table
				echo "	<tr>
							<th>Description</th>
							<th>Category</th>
							<th colspan=2>Cost Price</th>
						</tr>";
					
				//diplay each product from the selected supplier
				while ($row = mysqli_fetch_row($result)) 
				{
					//get the categoryID so that we can use to get category description
					$catId = $row[1];
					//$catSql = "SELECT Description from category WHERE ID = '$catId'"; 
					$catRes = mysqli_query($conn,"SELECT Descr from category WHERE ID = '$catId'");
					
					//calculate retail price i.e. CostPrice plus 50%
					$costPrice = $row['2'];
					$markup = $costPrice * 0.5;
					$price = (round(($costPrice + $markup), 2));
					$cat =  mysqli_fetch_row($catRes);
					
						echo "<tr>
								<td>$row[0]</td>
								<td>$cat[0]</td>
								<td>$</td>
								<td class='right'>$price</td>
							</tr>
						<br>";
						
				}//end while
			}
		
	include "templates/foot.php"; 
?>

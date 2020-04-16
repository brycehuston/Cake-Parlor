<?php
	// get the head of the html page
	//ensure that you include your name in the title
	include "./templates/head.php"; 

	
	// Check if the submit button has been clicked, if not then display the form
	// with the combo box (select box)
	// the name of the button must match (i.e. submit)
	if(!isset($_POST['submit']))
	{
		?>
		<h1>Products by Category</h1>
		<!-- the form action is this page -->
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class='centre'>
		<?php
		// get the connection script
		require('connect.php');
		
		// get all of the supplier info
		$res = mysqli_query($conn, "SELECT * FROM category");
		// make sure that something was returned
		if(mysqli_num_rows($res) > 0 )
		{
			echo "Choose Category: ";
			
			// Display the first option of the select box
			// Highly important
			echo "<select name='select_product'>
						<option value = '0'> Please Select...</option>";
						
			// iterate through the result and display the name for each supplier
			while($row=mysqli_fetch_array($res))
			{
				// the ID remains "hidden" but we use this as the identifier 
				// only the name is displayed
				echo "<option value='" . $row['ID'] . "'>" . $row['Descr'] . "</option>";
			}
			echo "</select>";
			
			// free the resources
			mysqli_free_result($res);
		}
		else
		{
			// if nothing was returned from the database 
			echo "<p>There are no products to display</p>";
		}
		
		//close the connection
		mysqli_close($conn);
		
		?>
			
			<input type="submit" name="submit" value="Submit">
		</form>
		
		<?php
	}
	else
	{
		// get the ID of the selected supplier from the submitted form
		$suppID = $_POST['select_product'];
		// if value is zero then nothing was selected
		if($suppID == 0)
		{
			echo "<p>Nothing selected, please go <a href='ProductsCat.php'>back</a> and try again.</p>";
		}
		else
		{
			//connect to the database
			require('connect.php');
			
			// get the information for the selected supplier
			$supp = mysqli_query($conn, "SELECT Name from product WHERE CategoryID = '$suppID'");
			$suppName = mysqli_fetch_row($supp);
			//get required the supplier information from the database
			$result = mysqli_query($conn, "SELECT Descr, CategoryID, CostPrice FROM Product WHERE CategoryID = '$suppID'");
			echo "<h2>Product Info</h2>";
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
		}
	}
		
	include "templates/foot.php"; 
?>

<?php
	// get the head of the html page
	//ensure that you include your name in the title
	include "./templates/head.php"; 

	
	// get the head of the html page
	//ensure that you include your namein the title
	
	/* This page should contain a drop down box that displays all
	** employees. When selected there should be a form that displays 
	** all information about that employee and is able to be updated
	*/
	
	// Check if the submit button has been clicked, if not then display the form
	// with the combo box (select box)
	// the name of the button must match (i.e. submit)
	if(!isset($_POST['submit']))
	{
		?>
		<h1>Employees</h1>
		<!-- the form action is this page -->
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class='centre'>
		<?php
		// get the connection script
		require('connect.php');
		
		// get all of the supplier info
		$res = mysqli_query($conn, "SELECT * FROM employee");
		// make sure that something was returned
		if(mysqli_num_rows($res) > 0 )
		{
			echo "Choose Employee: ";
			
			// Display the first option of the select box
			// Highly important
			echo "<select name='select_supplier'>
						<option value = '0'> Please Select...</option>";
						
			// iterate through the result and display the name for each supplier
			while($row=mysqli_fetch_array($res))
			{
				// the ID remains "hidden" but we use this as the identifier 
				// only the name is displayed
				echo "<option value='" . $row['ID'] . "'>" . $row['FName'] . "</option>";
			}
			echo "</select>";
			
			// free the resources
			mysqli_free_result($res);
		}
		else
		{
			// if nothing was returned from the database 
			echo "<p>There are no employees to display</p>";
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
		$suppID = $_POST['select_supplier'];
		// if value is zero then nothing was selected
		if($suppID == 0)
		{
			echo "<p>Nothing selected, please go <a href='Employees.php'>back</a> and try again.</p>";
		}
		else
		{
			//connect to the database
			require('connect.php');
		//get the customer details
		$sql = mysqli_query($conn, "SELECT invoice.InvoiceDate, invoice_line.Qty, invoice_line.InvoiceNo, invoice_line.ProdID, invoice.CustID FROM invoice INNER JOIN invoice_line ON invoice.InvoiceNo = invoice_line.InvoiceNo WHERE invoice.EmpID = '$suppID'");
		
		// note that the array elements relate to the order of the query above
		// you must use the index (not field names) when using mysqli_fetch_row
		echo "<h1>Employee</h1>";
		if(mysqli_num_rows($sql) > 0)
		{
			//display the table
				echo "<table class ='centre'>";
				//display the header row of the table
				echo "	<tr>
							<th>Date</th>
							<th>Quantity</th>
							<th>ID</th>
							<th>Cost</th>
							<th>Cake</th>
							<th>Buyer</th>
						</tr>";
								
			while ($row = mysqli_fetch_row($sql)) 
			{	
				$productID = $row[3];
				$customerID = $row[4];
				$cake = mysqli_query($conn, "SELECT CostPrice, Descr FROM product WHERE ID = '$productID'");
				$cakeUse =  mysqli_fetch_row($cake);
				$customer = mysqli_query($conn, "SELECT FName, LName FROM customer WHERE ID = '$customerID'");
				$customerUse =  mysqli_fetch_row($customer);
				echo "<tr>
					<td>$row[0]</td>
					<td>$row[1]</td>
					<td>$row[2]</td>
					<td>$cakeUse[0]</td>
					<td>$cakeUse[1]</td>
					<td>$customerUse[0]&nbsp;$customerUse[1]</td>
					</tr>
				<br>";
			}
			echo "</table>";
			mysqli_free_result($sql);
			mysqli_free_result($sql2);
			mysqli_close($conn);
		}
		}

	}	
	echo '<p><a href="AddEmployee.php">Add New Employee</a></p>';
	include "templates/foot.php"; 
?>

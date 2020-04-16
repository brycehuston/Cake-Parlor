<?php
	// get the head of the html page
	include "templates/head.php"; 
	
	if(!isset($_POST['submit']))
	{
	?>
	<h1>Add New Customer</h1>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class='centre'>
			<label for="FName">First Name</label>	
			<input type="FName" name="FName" id="FName"/>
			<label for="LName">Last Name</label>				
			<input type="LName" name="LName" id="LName"/>
			<label for="Address">Address</label>
			<input type="Address" name="Address"id="Address"/>
			<label for="Suburb">Suburb</label>	
			<input type="Suburb" name="Suburb" id="Suburb"/>
			<label for="State">State</label>				
			<input type="State" name="State" id="State"/>
			<label for="Phone">Phone</label>				
			<input type="Phone" name="Phone" id="Phone"/>
			<label for="Descr">Description</label>
			<input type="Descr" name="Descr" id="Descr"/>
			<label for="submit">&nbsp;</label>
			<input type="submit" name="submit" value="Submit"/>

		</form>
		
	<?php
	
	
	}
	else
	{
		//get all of the form data
		$FName = addslashes($_POST['FName']);//add a slash in case there was an apostrophe in it
		$LName = $_POST['LName'];
		$Address = $_POST['Address'];
		$Suburb = $_POST['Suburb'];
		$State = $_POST['State'];
		$Phone = $_POST['Phone'];
		$Descr = $_POST['Descr'];
		
		//get connection script
		require("connect.php");
		//Check if the Supplier exists in the database first
		$check = mysqli_query($conn, "SELECT ID FROM customer WHERE FName = '$FName'");
		//if a result was returned it means that a supplier of that name already exists in the db
		if(mysqli_num_rows($check) > 0)
		{
			echo "<p>$FName already exists in the database.</br >
			         Go <a href='AddCustomer.php'>back</a> and try again</p>";
		}
		else
		{
			
			//Insert into the database
			$qry = "INSERT INTO customer 
					(FName, LName, Address, Suburb, State, Phone, Descr)
					VALUES
					('$FName','$LName', '$Address', '$Suburb', '$State', '$Phone', '$Descr' )"; 
			
			//execute the query
			if(mysqli_query($conn, $qry))
			{
				//strip out an slashes that were added if there was an apostrophe in the name
				$supp = stripslashes($supp);
				echo "<h2>'$FName' inserted successfully!!</h2>
					  <p><a href='Customers.php'>Return to Customers</a></p>";
				
			}
			else
			{
				echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
			}
		}
		mysqli_free_result($check);
		mysqli_close($conn);
			
	}


	include "templates/foot.php"; 	
?>
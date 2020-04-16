<?php
	// get the head of the html page
	include "templates/head.php"; 
	
	if(!isset($_POST['submit']))
	{
	?>
	<h1>Edit Employee</h1>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class='centre'>
			<label for="ID">ID</label>	
			<input type="ID" name="ID" id="ID"/>
			<label for="FName">Full Name</label>				
			<input type="FName" name="FName" id="FName"/>
			<label for="LName">Last Name</label>
			<input type="LName" name="LName"id="LName"/>
			<label for="Address">Address</label>	
			<input type="Address" name="Address" id="Address"/>
			<label for="Suburb">Suburb</label>				
			<input type="Suburb" name="Suburb" id="Suburb"/>
			<label for="Salary">Salary</label>
			<input type="Salary" name="Salary" id="Salary"/>
			<label for="StartDate">Start Date</label>
			<input type="StartDate" name="StartDate" id="StartDate"/>
			<label for="submit">&nbsp;</label>
			<input type="submit" name="submit" value="Submit"/>

		</form>
		
	<?php
	
	
	}
	else
	{
		//get all of the form data
		$supp = addslashes($_POST['supp']);//add a slash in case there was an apostrophe in it
		$address = $_POST['address'];
		$suburb = $_POST['suburb'];
		$state = $_POST['state'];
		$postCode = $_POST['postCode'];
		$phone = $_POST['phone'];
		
		//get connection script
		require("connect.php");
		//Check if the Supplier exists in the database first
		$check = mysqli_query($conn, "SELECT ID FROM supplier WHERE Name = '$supp'");
		//if a result was returned it means that a supplier of that name already exists in the db
		if(mysqli_num_rows($check) > 0)
		{
			echo "<p>$supp already exists in the database.</br >
			         Go <a href='AddSupplier.php'>back</a> and try again</p>";
		}
		else
		{
			
			//Insert into the database
			$qry = "INSERT INTO supplier 
					(Name, Address, Suburb, State, PostCode, Phone)
					VALUES
					('$supp','$address', '$suburb', '$state', '$postCode', '$phone' )"; 
			
			//execute the query
			if(mysqli_query($conn, $qry))
			{
				//strip out an slashes that were added if there was an apostrophe in the name
				$supp = stripslashes($supp);
				echo "<h2>'$supp' inserted successfully!!</h2>
					  <p><a href='Suppliers.php'>Return to Suppliers</a></p>";
				
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
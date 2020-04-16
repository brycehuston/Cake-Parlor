<?php
	// get the head of the html page
	include "templates/head.php"; 
	
	if(!isset($_POST['submit']))
	{
	?>
	<h1>Add New Employee</h1>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class='centre'>
			<label for="FName">First Name</label>	
			<input type="FName" name="FName" id="FName"/>
			<label for="LName">Last Name</label>				
			<input type="LName" name="LName" id="LName"/>
			<label for="Address">Address</label>
			<input type="Address" name="Address"id="Address"/>
			<label for="Suburb">Suburb</label>	
			<input type="Suburb" name="Suburb" id="Suburb"/>
			<label for="Salary">Salary</label>
			<input type="Salary" name="Salary" id="Salary"/>
			<label for="StartDate">StartDate</label>				
			<input type="StartDate" name="StartDate" id="StartDate"/>
			<label for="TFN">TFN</label>				
			<input type="TFN" name="TFN" id="TFN"/>
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
		$State = $_POST['Salary'];
		$Phone = $_POST['StartDate'];
		$Descr = $_POST['TFN'];
		
		//get connection script
		require("connect.php");
		//Check if the Supplier exists in the database first
		$check = mysqli_query($conn, "SELECT ID FROM employee WHERE FName = '$FName'");
		//if a result was returned it means that a employee of that name already exists in the db
		if(mysqli_num_rows($check) > 0)
		{
			echo "<p>$FName already exists in the database.</br >
			         Go <a href='AddEmployee.php'>back</a> and try again</p>";
		}
		else
		{
			
			//Insert into the database
			$qry = "INSERT INTO customer 
					(FName, LName, Address, Suburb, Salary, StartDate, TFN)
					VALUES
					('$FName','$LName', '$Address', '$Suburb', '$Salary', '$StartDate', '$TFN' )"; 
			
			//execute the query
			if(mysqli_query($conn, $qry))
			{
				//strip out an slashes that were added if there was an apostrophe in the name
				$supp = stripslashes($supp);
				echo "<h2>'$FName' inserted successfully!!</h2>
					  <p><a href='Employees.php'>Return to Employees</a></p>";
				
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
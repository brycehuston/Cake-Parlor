<?php
	// get the head of the html page
	include "templates/head.php"; 
	
	/* This page should contain a way of showing invoices.
	** You could have a form with a drop down box showing all Invoice Numbers. 
	** When selected it would show all details of that invoice
	*/
		require('connect.php');
		//get the customer details
		$sql = mysqli_query($conn, "SELECT invoice.InvoiceDate, invoice_line.Qty, invoice_line.InvoiceNo, invoice_line.ProdID, invoice.CustID, invoice.EmpID FROM invoice INNER JOIN invoice_line ON invoice.InvoiceNo = invoice_line.InvoiceNo ORDER BY `invoice`.`EmpID` ASC");
		
		// note that the array elements relate to the order of the query above
		// you must use the index (not field names) when using mysqli_fetch_row
		echo "<h1>Invoices</h1>";
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
	

	include "templates/foot.php"; 
?>
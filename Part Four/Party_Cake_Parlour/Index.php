<?php
	// get the head of the html page
	//ensure that you include your namein the title
	include "./templates/head.php"; 

	/* This will be the home page of the site. 
	** for the moment is just has links to all
	** of the supplied pages.
	** Before handing in replace with something 
	** meaningful.
	*/
?>
	
		<p><a href="Index.php">Home</a><p>
		<p><a href="Suppliers.php">Suppliers</a><p>
		<p><a href="AddSupplier.php">Add Supplier</a><p>
		<p><a href="Products.php">Products</a><p>
		<p><a href="ProductsCat.php">Products by Category</a><p>
		<p><a href="ProductsSupp.php">Products by Supplier</a><p>
		<p><a href="Invoices.php">Invoices</a><p>
		<p><a href="Customers.php">Customers</a><p>
		<p><a href="Employees.php">Employees</a><p>
	
<?php		
	include "./templates/foot.php"; 
?>

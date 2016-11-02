<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Create Actor or Director</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/offcanvas.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    	.error {color: #FF0000;}
    </style>
</head>
<body>
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <a class="navbar-brand" href="index.php">Movie Database System</a>
	    </div>
		<form class="navbar-form navbar-right" method = "GET" action="Search_Actor_Movie.php?<?php echo htmlspecialchars($_GET['search']) ?>">
	        <input type="text" class="form-control" placeholder="Search..." name="name">
	        <button type="submit">Search</button>
		</form>
	  </div><!-- /.container-fluid -->
	</nav>

	<div class="container">

	  <div class="row row-offcanvas row-offcanvas-right">

	    <div class="col-xs-12 col-sm-9">
	      <p class="pull-right visible-xs">
	        <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
	      </p>
	      <div class="jumbotron">
	        <h2>Add an Actor or Director</h2>
	        <h5><span class="error">* required field.</span></h5>
	        	<form method = "GET" action="#">
	        		<span class="error">*</span><input type="radio" name="identity" value="Actor">Actor
	        	    <input type="radio" name="identity" value="Director">Director
	        	    <fieldset>
	        			<legend>Person Info:</legend>
	        			<div>
	        				<span class="error">*</span><label for="first_name">First Name:</label>
	        				<input type="text" id="first_name" placeholder="First Name" name="first"><br>

	        				<span class="error">*</span><label for="last_name"> Last Name:</label>
	        				<input type="text" id="last_name" placeholder="Last Name" name="last">
	        			</div>
	        			<div>
	        				<span class="error">*</span><label for="sex">Sex:</label><br>
	        				<input type="radio" id="sex" name="sex" value="male">Male
	        		    	<input type="radio" id="sex" name="sex" value="female">Female
	        	    	</div>
	        	    	<div>
	        				<span class="error">*</span><label for="dob">Date of Birth:</label>
	        				<input type="text" id="dob" placeholder="yyyy-mm-dd" name="dob"><br>
	        				<label for="dod">Date of Death:</label>
	        				<input type="text" id="dod" placeholder="yyyy-mm-dd"name="dod"><br>(leave blank if still alive)
	        			</div>
	        		</fieldset>
	        		<p></p>
	        		<button type="submit" name="submit" class="btn btn-primary">Submit</button>
	            </form>
	            

	            <?php
	            	$tableErr = $firstNameErr = $lastNameErr = $sexErr = $doberr ="";

	        		// Create connection
	        		$db = new mysqli('localhost', 'cs143', '', 'CS143');
	        		// Check connection
	        		if($db->connect_errno > 0){
	            		die('Unable to connect to database [' . $db->connect_error . ']');
	        		}

	        		// Check inputs
	        		if(!empty($_GET['identity'])) {
	        			$table = htmlspecialchars($_GET['identity']);
	        		}
	        		else {
	        			$err = true;
	        			$tableErr = "Identity must be selected";
	        		}
	        		if(!empty($_GET['first'])) {
	        			$first_name = htmlspecialchars($_GET['first']);
	        		}
	        		else {
	        			$err = true;
	        			$firstNameErr = "First name must be filled";
	        		}
	        		if(!empty($_GET['last'])) {
	        			$last_name = htmlspecialchars($_GET['last']);
	        		}
	        		else {
	        			$err = true;
	        			$lastNameErr = "Last name must be filled";
	        		}
	        		if(!empty($_GET['sex'])) {
	        			$sex = htmlspecialchars($_GET['sex']);
	        		}
	        		else {
	        			$err = true;
	        			$sexErr = "Sex must be selected";
	        		}
	        		if(!empty($_GET['dob'])) {
	        			$dob = htmlspecialchars($_GET['dob']);
	        		}
	        		else {
	        			$err = true;
	        			$doberr = "Date of birth must be filled";
	        		}
	        		//fetch valid id
		        	
		        	if (isset($_GET['submit'])) {
		        		if (!$err) {
			        		$query = "SELECT id FROM MaxPersonID;";
			        		$result = $db->query($query);
			        		$id = mysqli_fetch_assoc($result)['id'] + 1;
			        		//insert into Actor
			        		if ($table == 'Actor') {
			        			//dod is not null
			        			if(!empty($_GET['dod'])) {
			        				$dod = $_GET['dod'];
			        				$query = "INSERT INTO Actor VALUES ('$id', '$last_name', '$first_name', '$sex', '$dob', '$dod');";
			        			}
			        			//dod is null
			        			else {
			        				$query = "INSERT INTO Actor VALUES ('$id', '$last_name', '$first_name', '$sex', '$dob', NULL);";
			        			}
			        			$result = $db->query($query);
			        		}
			        		//insert into Director
			        		else if ($table == 'Director') {
			        			if(!empty($_GET['dod'])) {
			        				$dod = $_GET['dod'];
			        				$query = "INSERT INTO Director VALUES ('$id', '$last_name', '$first_name', '$dob', '$dod');";
			        			}
			        			else {
			        				$query = "INSERT INTO Director VALUES ('$id', '$last_name', '$first_name', '$dob', NULL);";
			        			}
			        			$result = $db->query($query);
			        		}
			        		if ($result === TRUE) {
			        			$query = "UPDATE MaxPersonID SET id = '$id';";
			        			$result = $db->query($query);
			        			echo "<h4 style=\"color: red\">$table created successfully</h4>";
			        		}
			        	}
			        	else {
			        		if (!empty($tableErr)) {
			        			echo "<h4 style=\"color: red\">Error! $tableErr!</h4>";
			        		}
			        		if (!empty($firstNameErr)) {
			        			echo "<h4 style=\"color: red\">Error! $firstNameErr!</h4>";
			        		}
			        		if (!empty($lastNameErr)) {
			        			echo "<h4 style=\"color: red\">Error! $lastNameErr!</h4>";
			        		}
			        		if (!empty($sexErr)) {
			        			echo "<h4 style=\"color: red\">Error! $sexErr!</h4>";
			        		}
			        		if (!empty($doberr)) {
			        			echo "<h4 style=\"color: red\">Error! $doberr!</h4>";
			        		}
			        	}
		        	}
	        	?>
	      </div>
	    </div><!--/.col-xs-12.col-sm-9-->

	    <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
	    	<div class="list-group">
	          <a href="Create_A_OR_D.php" class="list-group-item active">Create Actor/Actress or director</a>
	          <a href="Create_Movie.php" class="list-group-item">Create the records for a movie</a>
	          <a href="Actor_Movie.php" class="list-group-item">Assign an actor/actress to a movie</a>
	          <a href="Director_Movie.php" class="list-group-item">Assign an director to a movie</a>
	          <a href="Search_Actor_Movie.php" class="list-group-item">Search People/Movie</a>

	        </div>
	    </div><!--/.sidebar-offcanvas-->
	  </div><!--/row-->

	  <hr>

	  <footer>
	    <p>&copy; 2016 By Ning Xin, Aozhu Chen.</p>
	  </footer>

	</div><!--/.container-->
	<?php 
		// free the source
		$result->free();
		$db->close();
	?>
</body>
</html>
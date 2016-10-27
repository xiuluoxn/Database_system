<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create Actor or Director</title>
</head>
<body>
	<h3>Add an Actor or Director</h3>
	<form method = "GET" action="#">
		<input type="radio" name="identity" value="Actor">Actor
	    <input type="radio" name="identity" value="Director">Director
	    <fieldset>
			<legend>Person Info:</legend>
			<div>
				<label for="first_name">First Name:</label>
				<input type="text" id="first_name" placeholder="First Name" name="first">
				<label for="last_name"> Last Name:</label>
				<input type="text" id="last_name" placeholder="Last Name" name="last">
			</div>
			<div>
				<label for="sex">Sex:</label><br>
				<input type="radio" id="sex" name="sex" value="male">Male
		    	<input type="radio" id="sex" name="sex" value="female">Female
	    	</div>
	    	<div>
				<label for="dob">Date of Birth:</label>
				<input type="text" id="dob" placeholder="mm-dd-yy" name="dob"><br>
				<label for="dod">Date of Death:</label>
				<input type="text" id="dod" placeholder="mm-dd-yy"name="dod">(leave blank if still alive)
			</div>
		</fieldset>
		<button type="submit" class="btn btn-default">Submit</button>
    </form>
    

    <?php 
		// Create connection
		$db = new mysqli('localhost', 'cs143', '', 'CS143');
		// Check connection
		if($db->connect_errno > 0){
    		die('Unable to connect to database [' . $db->connect_error . ']');
		}
		//$query = "SELECT * FROM Actor;";
		//$result = $db->query($query);
		// Check inputs
		if(isset($_GET['identity'])) {
			$table = $_GET['identity'];
		}
		if(!empty($_GET['first'])) {
			$first_name = $_GET['first'];
		}
		if(!empty($_GET['last'])) {
			$last_name = $_GET['last'];
		}
		if(!empty($_GET['sex'])) {
			$sex = $_GET['sex'];
		}
		if(!empty($_GET['dob'])) {
			$dob = $_GET['dob'];
		}
		//fetch valid id
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
		}
		$result->free();
		$db->close();
		 
	?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Show Actor/Actress Detail</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/offcanvas.css" rel="stylesheet">
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
	        <!-- create connecting to database -->
	        <?php 
	        	// Create connection
	        	$db = new mysqli('localhost', 'cs143', '', 'CS143');
	        	// Check connection
	        	if($db->connect_errno > 0){
	        		die('Unable to connect to database [' . $db->connect_error . ']');
	        	}
	        ?>

	        <h3>Actor Infomation Page:</h3>

	        <!-- Actor/Actress Basic Info -->
	        <div>
	        	<h4>Actor/Actress Basic Info:</h4>
	        	<?php 
	        		//check id
	        		if (!empty($_GET['id'])) {
	        			$id = $_GET['id'];
	        		}
	        		else {
	        			$err = true;
	        		}
	        		if (!$err) {
	        			//Fetch the data from the database
	        			$query = "SELECT CONCAT(first,' ',last) Name, sex, dob, dod FROM Actor WHERE id = '$id'";
	        			$result = $db->query($query);
	        			?>
	        			<!-- creat the table for the data -->
	        			<table border="1" style="width: 100%">
	        				<tr>
	        					<th>Name</th>
	        					<th>Sex</th>
	        					<th>Date of Birth</th>
	        					<th>Date of Death</th>
	        				</tr>
	        				<?php 
	        				while($row = $result->fetch_assoc()) {
	        		    		echo "<tr>";
	        	    			echo "<td>{$row['Name']}</td>";
	        	    			echo "<td>{$row['sex']}</td>";
	        	    			echo "<td>{$row['dob']}</td>";  
	        					if (is_null($row['dod'])) {
	        						echo "<td>Still Alive</td>";
	        					} else {
	        	    				echo "<td>{$row['dod']}</td>";  
	        	    			}	
	        	    			echo "</tr>";
	        		    	}
	        				?>
	        			</table>
	        			<?php 
	        		}
	        	?>
	        </div>

	        <!-- movie involved -->
	        <div>
	        	<h4>Actor's Movies and Role:</h4>
	        	<?php 
	        		//check id
	        		if (!$err) {
	        			//Fetch the data from the database
	        			$query = "SELECT id, title, role FROM Movie M, MovieActor MA WHERE M.id = MA.mid AND aid = '$id';";
	        			$result = $db->query($query);
	        			?>
	        			<!-- creat the table for the data -->
	        			<table border="1" style="width: 60%">
	        				<tr>
	        					<th>Movie Title</th>
	        					<th>Roles</th>
	        				</tr>
	        				<?php 
	        				while($row = $result->fetch_assoc()) {
	        		    		echo "<tr>";
	        	    			echo "<td><a href=\"Show_Movie_Detail.php?id={$row['id']}\">{$row['title']}</a></td>";
	        	    			echo "<td>{$row['role']}</td>";
	        	    			echo "</tr>";
	        		    	}
	        				?>
	        			</table>
	        			<?php 
	        		}
	        	?>
	        </div>
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
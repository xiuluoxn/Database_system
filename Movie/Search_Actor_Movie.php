<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Show the Actor</title>
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

	  </div><!-- /.container-fluid -->
	</nav>

	<div class="container">

	  <div class="row row-offcanvas row-offcanvas-right">

	    <div class="col-xs-12 col-sm-9">
	      <p class="pull-right visible-xs">
	        <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
	      </p>
	      <div class="jumbotron">
	        <h2>Search Actor/Actress/Movie:</h2>
        	<form method = "GET" action="#">
        		<div>
        			<label for="name">Search:</label><br>
        			<input type="text" id="name" placeholder="Part of the name" name="name"><br>
        		</div>
        		<p></p>
        		<button type="submit" class="btn btn-primary">Search</button>
        	</form>
        	<?php 
    			// Create connection
    			$db = new mysqli('localhost', 'cs143', '', 'CS143');
    			// Check connection
    			if($db->connect_errno > 0){
    				die('Unable to connect to database [' . $db->connect_error . ']');
    			}
    			if (!empty($_GET['name'])) {
    				$input = explode(" ", $_GET['name']);
                    $len = sizeof($input);
    			}
    			else {
    				$err = true;
    			}
    			// Select
    			if (!$err) {
    				//SELECT Actor/Actress
                    $query = "SELECT id, CONCAT(first,' ',last) Name, dob FROM Actor WHERE UPPER(CONCAT(first,' ',last)) LIKE UPPER('%$input[0]%')";
                    for ($i = 1; $i < $len; $i++) { 
                        $query .= " AND UPPER(CONCAT(first,' ',last)) LIKE UPPER('%$input[$i]%')";
                    }
                    $query .= ";";
    				$result = $db->query($query);
    				?>
    				<div>
    					<h3>Matched Actor/Actress:</h3>
    					<?php if ($result->num_rows > 0): ?>
    						<table border="1" style="width:100%">
    							<tr>
    								<th>Name</th>
    								<th>Date of Birth</th>
    								<th></th>
    							</tr>
    							<?php 
    							while($row = $result->fetch_assoc()) {
    								    		echo "<tr>";
    							    			echo "<td>{$row['Name']}</td>";
    							    			echo "<td>{$row['dob']}</td>";  
    							    			echo "<td><a href=\"Show_Actor_Detail.php?id={$row['id']}\">Show Detail</a></td>";  			
    							    			echo "</tr>";
    								    	}
    							?>
    						</table>
    					<?php else: ?>
    						<p>No Record Found</p>
    					<?php endif ?>
    				</div>
    				<?php
    				//SELECT Movie
                    $query = "SELECT id, title, year FROM Movie WHERE UPPER(title) LIKE UPPER('%$input[0]%')";
        			for ($i = 1; $i < $len; $i++) {	
                        $query .= " AND UPPER(title) LIKE UPPER('%$input[$i]%')";
                    }
                    $query .= ";";
    				$result = $db->query($query);
    				?>
    				<div>
    					<h3>Matched Movie:</h3>
    					<?php if ($result->num_rows > 0): ?>
    						<table border="1" style="width:100%">
    							<tr>
    								<th>Title</th>
    								<th>Year Produced</th>
    								<th></th>
    							</tra>
    							<?php 
    							while($row = $result->fetch_assoc()) {
    								    		echo "<tr>";
    							    			echo "<td>{$row['title']}</td>";
    							    			echo "<td>{$row['year']}</td>";  
    							    			echo "<td><a href=\"Show_Movie_Detail.php?id={$row['id']}\">Show Detail</a></td>";    			
    							    			echo "</tr>";
    								    	}
    							?>
    						</table>
    					<?php else: ?>
    						<p>No Record Found</p>
    					<?php endif ?>
    				</div>
    				<?php 
    				$result->free();
    				$db->close();
    			}

    		?>
	      </div>
	    </div><!--/.col-xs-12.col-sm-9-->

	    <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
	    	<div class="list-group">
	          <a href="Create_A_OR_D.php" class="list-group-item">Create Actor/Actress or director</a>
	          <a href="Create_Movie.php" class="list-group-item">Create the records for a movie</a>
	          <a href="Actor_Movie.php" class="list-group-item">Assign an actor/actress to a movie</a>
	          <a href="Director_Movie.php" class="list-group-item">Assign an director to a movie</a>
	          <a href="Search_Actor_Movie.php" class="list-group-item active">Search People/Movie</a>

	        </div>
	    </div><!--/.sidebar-offcanvas-->
	  </div><!--/row-->

	  <hr>

	  <footer>
	    <p>&copy; 2016 By Ning Xin, Aozhu Chen.</p>
	  </footer>

	</div><!--/.container-->
</body>
</html>


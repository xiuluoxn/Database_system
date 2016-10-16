<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Calculator</title>
</head>
<body>
	<h1>Calculator</h1>
	
	<p>
		By Ning Xin and Aozhu Chen<br> 
		Type an expression in the following box:
	</p>

	<form method="get">
		<input type="text" name="expression">
		<input type="submit" value="calculate">
	</form>
	<p>
		<ul>
	    	<li>Only numbers and +,-,* and / operators are allowed in the expression.</li>
	    	<li>The evaluation follows the standard operator precedence.</li>
	    	<li>The calculator does not support parentheses.</li>
	    	<li>The calculator handles invalid input "gracefully". It does not output PHP error messages.</li>
		</ul>
	</p>

	<?php
	if(isset($_GET['expression'])) {
		$equ = $_GET['expression'];
		$pattern = "/^[\+\*\/\.]|^$|^\s*$|[\+\*\/\-]\s*\-\s+|^\s*\-\s+|^\-{2}|\-{3}|[\+\-\*\/\.]$|[\+\*\/\.]{2}|[\+\-\*\/]+\s*0+[0-9]|^0+[0-9]|[0-9]\.[\D]|[\D]\.|[0-9]\.\s+[0-9]|[0-9]\s+[0-9]|[^\+\-\*\/\d\.\s]+/i";
		if (!preg_match($pattern, $equ)) {
			$pattern_zero = "/\/0[\+\-\*\/]|\/0$/";
			if (!preg_match($pattern_zero, $equ)) {
					$equ = preg_replace("/(--)/", "- -", $equ);
					?>
					<h2>Result:</h2>
					<?php			
					$error=@eval("\$ans = $equ ;");
					if($error===FALSE) 
					{
						echo "Invalid Expression!";
					}
					else
					{
						echo "$equ = ".$ans;
					}
						
			} else {
				?>
				<h2>Result:</h2>
				<?php
				echo "Division by zero error!";
			}
		} else if (preg_match("/^$/", $equ)) {
		} else {
			?>
			<h2>Result:</h2>
			<?php
			echo "Invalid Expression!";
		}
	}
	?>
</body>
</html>

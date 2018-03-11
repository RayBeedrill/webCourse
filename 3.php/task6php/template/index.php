<?php
/*
 *
 * Template file needs to show results of class work 
 *
 *
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>PHP task 6</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<h3>Groups info</h3>
					<h4><?php echo $gunsInfo['name']; ?></h4>
					<p>genre: <?php echo $gunsInfo['genre']; ?></p>
					<table class="table-bordered">
						<tr>
							<td>name</td>
							<td>groups</td>
							<td>role</td>
							<td>instruments</td>
						</tr>

					<?php
					foreach ($gunsInfo['bandList'] as $role => $value) {
						echo "<tr>";
							echo "<td>";
								echo $value['name'];
							echo "</td>";
							echo "<td>";
								foreach ($value['bands'] as $band) 
								{
									echo $band . '<br>'; 
								}
							echo "</td>";
							echo "<td>";
								echo $role;
							echo "</td>";
							echo "<td>";
								foreach ($value['instruments'] as $instrument => $category) 
								{
									echo $instrument . '<br>';
								}
							echo "</td>";
						echo "</tr>";
					}

					?>
					</table>

					<h4><?php echo $revolverInfo['name']; ?></h4>
					<p>genre: <?php echo $revolverInfo['genre']; ?></p>
					<table class="table-bordered">
						<tr>
							<td>name</td>
							<td>groups</td>
							<td>role</td>
							<td>instruments</td>
						</tr>

					<?php
					foreach ($revolverInfo['bandList'] as $role => $value) {
						echo "<tr>";
							echo "<td>";
								echo $value['name'];
							echo "</td>";
							echo "<td>";
								foreach ($value['bands'] as $band) 
								{
									echo $band . '<br>'; 
								}
							echo "</td>";
							echo "<td>";
								echo $role;
							echo "</td>";
							echo "<td>";
								foreach ($value['instruments'] as $instrument => $category) 
								{
									echo $instrument . '<br>';
								}
							echo "</td>";
						echo "</tr>";
					}

					?>
					</table>
				</div>
			</div>
		</div>

    </body>
</html>

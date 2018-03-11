<?php
/*
 *
 * Template file needs to show results of queries to DB
 *
 *
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>PHP task 4</title>        
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        
		<div class="col-md-6 col-md-offset-3">
			<h3> Work Mysql class with Data base </h3>
			<table class="table-bordered">
				<?php
				if(is_array($sqlResult))
                {
                ?>    
                <tr>
					<td>key </td><td>data </td>
				</tr>
                <?php
					foreach($sqlResult as $row)
					{
						echo "<tr>";
						foreach($row as $key => $value)
						{
							echo "<td>" . $value . "</td>";
						}
						echo "</tr>";
					}
				}
				?>
			</table>
		</div>
		<div class="col-md-6 col-md-offset-3">
			<h3> Work Postgresql class with Data base </h3>
			<table class="table-bordered">
									<?php
				if(is_array($pgsqlResult))
                {
                ?>
                <tr>
			    	<td>key </td><td>data </td>
				</tr>
                <?php
					foreach($pgsqlResult as $row)
					{
						echo "<tr>";
						foreach($row as $key => $value)
						{
							echo "<td>" . $value . "</td>";
						}
						echo "</tr>";
					}
				}
				?>
			</table>
		</div>
    </body>
</html>

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
        <title>PHP task 5</title>
        
    </head>
    <body>
        <h3>Work with cookies</h3>
        <p>Cookie seted and geted: <?php echo $cookieData; ?> </p>        
        <p>Cookie unseted: <?php echo $cookieDataDelete; ?></p>        
        <h3>Work with Session</h3>        
        <p>Session variable :<?php echo $sessionData; ?></p>        
        <p>Deleted session variable:<?php echo $sessionDataDeleted; ?></p>        
        <h3>Work with MYSQL</h3>        
        <p>
		<?php 
				if(is_array($mysqlRes))
				{
                    echo "getData : <br>";
					foreach($mysqlRes as $row)
					{		
						foreach($row as $key => $value)
						{
							if($value == 'User4' || $value == 'SomeValue')
							{
								echo $key . "  |   " . $value . "<br>";		
							}
						}
					}
				}
				else
				{
					echo $mysqlRes;
				}
				echo "<br>Delete data:" . $mysqlDeleted;
        ?> </p>        
        <h3>Work with PGSQL</h3>        
        <p>
		<?php 
				if(is_array($pgsqlRes))
				{
					echo "getData : <br>";
                   
                    foreach($pgsqlRes as $row)
					{	
						foreach($row as $key => $value)
						{
							if($value === 'User4' || $value === 'someValuee')
							{
								echo $key . "  |   " . $value . "<br>";		
							}
						}
					}
				}
				else
				{
					echo $pgsqlRes;
				}
				echo "<br>Delete data:" . $pgsqlDeleted;
        ?> </p>
    </body>
</html>

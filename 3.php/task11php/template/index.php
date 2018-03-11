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
        <title>PHP task 11</title>        
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        
		<div class="col-md-6 col-md-offset-3">
<?php            if(empty($err))
                { ?>
                <h3> <?php echo $err;  ?> </h3>
            <?php } ?>
            <h3> Work Mysql class with Data base </h3>
            <table class="table-bordered">
                <?php
                if(is_array($result))
                {
                ?>    
                <tr>
                    <td>key </td><td>data </td>
                </tr>
                <?php
                    foreach($result as $row)
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

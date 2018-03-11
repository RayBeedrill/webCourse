<?php
/*
*
* Page with front-end. Where data outputs
*
*/
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>PHP task 3</title>
        <link href="css/bootstrap.min.css" ref="stylesheet">
        <link href="css/style.css" ref="stylesheet">
    </head>
    <body>
        <h3> Output with reading by strings method </h3>
		<p>
		<?php
        echo $dataStringRead;
		?>
		</p>
        <h3> Output with reading by chars method </h3>
		<p>
        <?php
        echo $dataCharsRead;
        ?>
		</p>
    </body>
</html>

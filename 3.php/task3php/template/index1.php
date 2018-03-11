<?php
/*
*
* Page with front-end. Where data outputs edited
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
        <h3> Output with reading by strings method original text </h3>
		<p>
        <?php
        if(is_array($originalText))
        {
		    foreach($originalText as $key => $value)
		    {
			    echo $value;
			    echo "<br>";
		    }
        }
        else
        {
            echo $originalText;
        }
		?>
		</p>
        <h3> Output with reading by chars method  edited text</h3>
		<p>
        <?php
        if(is_array($editedText))
        {
		    foreach($editedText as $key => $value)
		    {
			    echo $value;
			    echo "<br>";
	    	}
        }
        else
        {
            echo $editedText;
        }
		?>
		</p>
		
    </body>
</html>

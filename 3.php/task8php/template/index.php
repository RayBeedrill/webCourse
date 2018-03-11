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
        <title>PHP task 8</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
		<div class="container">
			<div class="row">
		    	<div class="col-md-6 col-md-offset-3">
                    <h3 style="text-align:center">Search</h3>
                    <form method="GET" style="text-align:center"class="form-inline">
                        <input type="text" name="query" class="form-control" placeholder="Search query">
                        <button class="btn btn-success" type="submit">Search</button>
                    </form>
                </div>
				<div style="text-align:left;" class="col-md-8 ">
<?php 
                    if(is_array($searchResult))
                    {
                        foreach($searchResult as $key )
                        {
                            echo '<a href="' . $key['href'] . '">' . $key['name'] . '</a><br>';
                            echo '<span>' . $key['desc'] . '</span><br><br>';
                        }
                    }
                    ?>
				</div>
			</div>
		</div>
    </body>
</html>

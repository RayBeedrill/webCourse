<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>SOAP task1</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" >
    
    <!-- Latest compiled and minified JavaScript -->
  
  </head>
  <body>
    <div class="container"  style="text-align:center">
        <div class="row">
            <h3>Get thumbnail with Soap class</h3>
            <p>enter website address to get screenshot</p>
            <div class="col-md-8 col-md-offset-2"><?php echo $imgSoap; ?></div>
            <div class="col-md-8 col-md-offset-2" style="margin-top:25px;">
                <form method="post">
                    <input type="text" name="webSrcSoap">
                    <input type="submit">
                </form>
            </div>
        </div>
        <div class="row">
            <h3>Get teams with Soap class</h3>
        <p>list of teams from <a href="http://footballpool.dataaccess.eu">website</a></p>
            <div class="col-md-8 col-md-offset-2"><?php echo $teamsSoap; ?></div>
        </div>
        <div class="row">
            <h3>Get thumbnail with Curl</h3>
            <p>enter website address to get screenshot</p>
            <div class="col-md-8 col-md-offset-2"><?php echo $imgCurl; ?></div>
            <div class="col-md-8 col-md-offset-2" style="margin-top:25px;">
                <form method="post">
                    <input type="text" name="webSrcCurl">
                    <input type="submit">
                </form>
            </div>
        </div>
        <div class="row">
            <h3>Get teams with Curl</h3>
        <p>list of teams from <a href="http://footballpool.dataaccess.eu">website</a></p>
            <div class="col-md-8 col-md-offset-2"><?php echo $teamsCurl; ?></div>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>

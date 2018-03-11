<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>PHP task 1</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <div class="container download-file-block">
            <div class="row">
               <div class="col-md-4 col-md-offset-4 form-group">
                    <form enctype="multipart/form-data" action="index.php" method="POST">         
                        <h3>Download some file</h3>
                        <input class="input-file"  type="file" name="userfile"/>
                        <input class="btn btn-default btn-submit center-block" type="submit" name="Send File"/>
                    </form>
					<div class="col-md-12 ">
						<p class="err-text"><em><?php echo $errDown . " " . $errDel; ?></em></p>
					</div> 
               </div>    
            </div>
        </div>
        <div class="container list-on-server-block">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
				<?php
				$dataCounter = count($data[0]);
				if( $dataCounter !== 0 && $data !== PATH_ERR){
				?>
					<h3>File list on server</h3>
                    <table class="table table-bordered">
						<tr>
							<td>id</td>
							<td>File Name</td>
							<td>File Size</td>
							<td>Action</td>
						</tr>
				<?php }else{
						echo "<h3>No files on server</h3>";
							if($data === PATH_ERR){
								echo '<h3>' . PATH_ERR . '</h3>';
							}
						}
					if( $dataCounter !== 0 && $data !== PATH_ERR){
						for($i=0 ; $i < count($data[0]) ;$i++){
							echo '<tr>';
								echo '<td>' .  $i . '</td>';
								echo '<td>' .  $data[0][$i] . '</td>';
								echo '<td>' .  $data[1][$i] . '</td>';
								echo '<td><a href="index.php?deleteFile=' . $data[0][$i] . '"> DELETE </td>';
							echo '</tr>';
						}
					}
					?>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>

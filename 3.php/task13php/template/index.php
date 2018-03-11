<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>PHP task 2</title>
    </head>
    <body>
        <div class="container download-file-block">
            <div class="row">
               <div class="col-md-4 col-md-offset-4 form-group">
                <h4>Values:</h4>
                <p> first value: <?php echo $firstVal;  ?></p> 
                <p>second value: <?php echo $secondVal;  ?></p> 
                <p>memory value: <?php echo $memVal;  ?></p> 
                <h4>Math operations:</h4>
                <p>sum value: <?php echo $sum; ?> </p> 
                <p>minus value: <?php echo $min; ?> </p> 
                <p>divide value: <?php echo $divide; ?> </p> 
                <p>multiply value: <?php echo $multiply; ?> </p> 
                <p>percentage of the number: <?php echo $percent; ?>% </p> 
                <p>sqrt of the first number: <?php echo $sqrtNum1; ?> </p> 
                <p>sqrt of the second number: <?php echo $sqrtNum2; ?> </p> 
                <h4>Work with memory:</h4>
                <p>Memeroy Recal before sum: <?php echo $memRec1; ?> </p> 
                <p>Memeroy Recal after sum: <?php echo $memRec2; ?> </p> 
                <p>Memeroy Recal after minus: <?php echo $memRec3; ?> </p> 
                <p>Memeroy Recal after clear: <?php echo $memRec4; ?> </p> 
               </div>    
            </div>
        </div>        
    </body>
</html>

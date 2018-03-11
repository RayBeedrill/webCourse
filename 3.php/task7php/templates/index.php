<html>
<head>
    <title>%TITLE%</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 title">
            <h2>Contact Form</h2>
        </div>
         <div class="col-md-4 col-md-offset-4 cf-class">
            <form method='POST'>
                <div class="form-group">
                     <input type="text" class="form-control" value="%NAME%" name="name" placeholder="Name">
                </div>
                 <div class="form-group">
                    <select class="form-control" name="subject">
                        <option %OPTION-0% value="0"> %SELECT_TEXT_0% </option>
                        <option %OPTION-1% value="1"> %SELECT_TEXT_1% </option>
                        <option %OPTION-2% value="2"> %SELECT_TEXT_2% </option>
                        <option %OPTION-3% value="3"> %SELECT_TEXT_3% </option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" value="%EMAIL%" name="email"  placeholder="Email">
                </div>
                <div class="form-group">
                    <textarea placeholder="Message"  class="form-control" name="msg"  rows="3">%MSG%</textarea>
                </div>
                <button type="submit" class="btn btn-success center-block">Send Message</button>
            </form>       
        </div>
        <div class="col-md-6 col-md-offset-3 errors ">
            <strong class="text-danger %MSG-CLASS%">%MESSAGES%</strong>
        </div>
    </div>
</div>
</body>
</html>


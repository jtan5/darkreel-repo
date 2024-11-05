<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Hello, world!</title>
    
    <style type="text/css">
        input[type=text], input[type=email]{
            float:left;
            clear:both;
            margin-top:20px;
            font-size:16px;
            width:200px;
        }
        
        input[type=submit] {
            float:left;
            clear:both;
            font-weight:bold;
            padding:5px 20px;
            margin-top:20px;
        }
    </style>
</head>

<body>
	<h1>Sample Form</h1>
    
    <form action="get-form.php" method="get">
        <input name="first_name" type="text" placeholder="First name"><br>
        
        <input name="last_name" type="text" placeholder="Last name"><br>
        
        <input name="email" type="email" placeholder="Email address"><br>
        
        <input name="submit" type="submit" value="Send">
    </form>
</body>
</html>
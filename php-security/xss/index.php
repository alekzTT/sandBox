<?php 

//Cross Site Scripting
//PHP prepared statements don't cover that part

$con = new PDO('mysql:host=localhost;dbname=sql_injection', 'root', 'root');

if (!empty($_POST)) {
	//if we display it without htmlspecialchars() then we'll insert any code passed in the form in db
	//htmlcpecialchars all html characters
	//htmlentities some of them in order to keep maybe formating and stuff

	 $email = htmlspecialchars(trim($_POST['email']));
	 $comment = htmlspecialchars(trim($_POST['comment']));


	$commentQuery = $con->prepare("INSERT INTO comments(email, comment) VALUES (:email, :comment)");
	$commentQuery->execute([
		'email' => $email, 
		'comment' => $comment
	]);


	//Show all entries
	$result=$con->prepare("SELECT * FROM comments");
		$result->execute();
		$result = $result -> fetchAll();
		foreach( $result as $row ) {
	    echo ($row[0]);
	    echo ($row[1]."<br/>");
	  }
}

?>


<!doctype html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>xss</title>
</head>
<body>
	
<form action="" method="POST">
	<label for="email">email</label>
	<input type = "text" name="email">
	<label for="comment">comment</label>
	<input type = "text" name="comment">
	<input type="submit" name="submit">
</form>

</body>
</html>
<?php 

//SQL injection
//';DROP TABLE users; --
//This will drop all 'users' table if exists

$con = new PDO('mysql:host=localhost;dbname=sql_injection', 'root', 'root');

if (!empty($_POST)) {
	$email = trim($_POST['email']);
	
	//simple query
	//$result=$con->query("SELECT * FROM comments WHERE email = '{$email}'");

	//sql injection works like the following query
	//$result=$con->query("SELECT * FROM comments WHERE email = '${email}';DROP TABLE users; --");

	//instead we use prepared statements
	$result=$con->prepare("SELECT * FROM comments WHERE email = :email");
	$result->execute([
		'email' => $email
	]);




	if($result){
		if ($result->rowCount() > 0) {
			echo "USER";
		} else {
				echo "No USER";
		}
	}
}

?>

<!doctype html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>sqlInj</title>
</head>
<body>
	
<form action="" method="POST">
	<label for="username">username</label>
	<input type = "text" name="username">
	<label for="email">email</label>
	<input type = "text" name="email">
	<input type="submit" name="submit">
</form>

</body>
</html>
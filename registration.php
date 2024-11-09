<?php
$sql = "SELECT * FROM `users`;";
$db_name = 'mysql:host=localhost;dbname=contact_db';
$username = 'root';
$password = '';

$conn = new PDO($db_name, $username, $password);

if(isset($_POST['send'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $guests = $_POST['guests'];
   $guests = filter_var($guests, FILTER_SANITIZE_STRING);

   $select_contact = $conn->prepare("SELECT * FROM `users`;";");
   $select_contact->execute(array($name, $number, $guests));

   if($select_contact->rowCount() > 0){
      $message[] = 'Message sent already!';
   }else{
      $insert_contact = $conn->prepare("INSERT INTO `contact_form`(name, number, guests) VALUES(?,?,?)");
      $insert_contact->execute(array($name, $number, $guests));
      $message[] = 'Message sent successfully!';
   }

}

?>
		<!DOCTYPE html>
			<html lang="ru">
			<head>
			    <meta charset="UTF-8">
			    <title>Регистрация</title>
			</head>
			<body>
			 
				<form action="registration" method="POST">
					<p>логин
				    <input type="text" name="login" id="login"></p>
				    <p>пароль
				    <input type="password" name="password" id="password"></p>
				    <input type="submit" id="button" value="Зарегистрироваться">
				</form>
				<p><a href="login">Авторизация</a> </p>
			                
			</body>
			</html>
	
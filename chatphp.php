<?php
$bdd = new PDO("mysql:host=127.0.0.1;dbname=chat;charset=utf8", "root", "");
if(isset($_POST['pseudo']) AND isset($_POST['message']) AND !empty(['pseudo']) AND !empty(['message']))
{
	$pseudo = htmlspecialchars($_POST['pseudo']);
	$message = htmlspecialchars($_POST['message']);
	$insertmsg = $bdd->prepare('INSERT INTO chat(pseudo, message) VALUES(?, ?)');
	$insertmsg->execute(array($pseudo, $message));
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>CHAT PHP</title>
	<meta charset="utf-8">
			<style>
			body{
				background-color: #FA0296;
			}
			.test {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
		</style>
</head>
<body>
	<center>
	<form method="post" action="">
		<input type="text" placeholder="PSEUDO" name="pseudo" />
		<br>
		<textarea type="text" placeholder="MESSAGE" name="message"></textarea>
		<br>
		<input type="submit" value="SEND !" name="test">
	</form>
	<?php
	$allmsg = $bdd->query('SELECT * FROM chat');
	while ($msg = $allmsg->fetch())
	{
	?>
	<b><?php echo $msg['pseudo'] ?> :</b> <?php echo $msg['message'] ?><br>
	<?php
}
	?>
	<center>
</body>
</html>
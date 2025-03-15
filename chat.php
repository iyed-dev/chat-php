<?php
session_start();

$bdd = new PDO("mysql:host=127.0.0.1;dbname=chat;charset=utf8", "root", "");

if (isset($_POST['pseudo']) && isset($_POST['message']) && !empty($_POST['pseudo']) && !empty($_POST['message'])) {
    $_SESSION['pseudo'] = htmlspecialchars($_POST['pseudo']); // Sauvegarde du pseudo dans la session
    $pseudo = $_SESSION['pseudo'];
    $message = htmlspecialchars($_POST['message']);

    $insertmsg = $bdd->prepare('INSERT INTO chat (pseudo, message) VALUES (?, ?)');
    $insertmsg->execute(array($pseudo, $message));
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>💬 Chat en PHP</title>
    <style>
        body {
            background-color: #FA0296;
            font-family: Arial, sans-serif;
            color: white;
            text-align: center;
        }
        .chat-container {
            width: 50%;
            margin: auto;
            background: #222;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        }
        input, textarea {
            width: 80%;
            padding: 10px;
            margin: 10px;
            border: none;
            border-radius: 5px;
        }
        .send-btn {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }
        .messages {
            margin-top: 20px;
            text-align: left;
            background: #333;
            padding: 10px;
            border-radius: 5px;
            max-height: 300px;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <h2>💬 Chat en PHP</h2>
        <form method="post" action="">
            <input type="text" placeholder="Pseudo" name="pseudo" value="<?php echo isset($_SESSION['pseudo']) ? $_SESSION['pseudo'] : ''; ?>" required>
            <br>
            <textarea placeholder="Message" name="message" required></textarea>
            <br>
            <input type="submit" value="Envoyer" class="send-btn">
        </form>
        <div class="messages">
            <?php
            $allmsg = $bdd->query('SELECT * FROM chat ORDER BY id DESC');
            while ($msg = $allmsg->fetch())
            {
            ?>
                <p><b><?php echo htmlspecialchars($msg['pseudo']); ?> :</b> <?php echo htmlspecialchars($msg['message']); ?></p>
            <?php
            }
            ?>
        </div>
    </div>
</body>
</html>

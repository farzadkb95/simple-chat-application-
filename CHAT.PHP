<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Simple Chat Application</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div id="messages">
  </div>
  <form action="" method="post">
    <input type="text" name="message" placeholder="Enter a message...">
    <input type="submit" value="Send">
  </form>
</body>
</html>

<?php

// Create a database connection
$db = new PDO('mysql:host=localhost;dbname=chat', 'root', '');

// Get the current user
session_start();
$user = $_SESSION['username'];

// Get the chat messages
$messages = $db->query('SELECT * FROM messages ORDER BY created_at DESC');

// Display the chat messages
foreach ($messages as $message) {
  echo '<div class="message">';
  echo '<span class="username">' . $message['username'] . '</span>: ';
  echo $message['message'];
  echo '</div>';
}

// Add a new message
if (isset($_POST['message'])) {
  $message = $_POST['message'];
  $db->query('INSERT INTO messages (username, message, created_at) VALUES (?, ?, NOW())', array($user, $message));
}

?>

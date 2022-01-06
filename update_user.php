<?php
   
  require 'database.php';
  require 'session.php';

  $message = '';

    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_POST['id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }

    if(!empty($_POST['email'])){
      $email=$_POST['email'];
    }else {
      $email=$user['email'];
    }

  if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])) {
    if ($_POST['confirm_password'] == $_POST['password']) {
      if (!empty($_POST['email']) != $user['email'] ||  !password_verify($_POST['password'], $user['password'])) {
        $sql = "UPDATE users
        SET `email`= :email, `password` = :password
        WHERE `id` = :id";
        $stmt = $conn->prepare($sql);
        $stmt -> bindParam(':id', $user['id'], PDO::PARAM_INT);
        $stmt->bindParam(':email', $_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
          $message = 'Successfully update user';
        } else {
          $message = 'Sorry, Sorry, there was a problem updating.';
        }
      }else {
        $message = 'You must enter a new password.';
      }
    }else {
      $message = 'Enter the same passwords.';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Update User</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>

    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Update User</h1>
    <span>or return <a href="index.php">home</a></span>

    <form  id="form-user" action="update_user.php" method="POST">
      <input name="id" value="<?php echo $user['id'] ?>" type="number" style="display:none">
      <input id="email" name="email" value="<?php echo $email ?>" type="text" placeholder="Enter your email">
      <input id="password" name="password" type="password" placeholder="Enter new password">
      <input id="confirm_password" name="confirm_password" type="password" placeholder="Confirm password">
      <input type="submit" value="Submit">
    </form>

  </body>
</html>

<script src="assets/js/scripts.js"></script>
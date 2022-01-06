<?php

  require 'database.php';
  require 'session.php';

  
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome to you WebApp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">

  </head>
  <body>
    <?php require 'partials/header.php' ?>

      <br> Welcome. <?= $user['email']; ?>
      <br>You are Successfully Logged In
      <a href="logout.php">
        Logout
      </a>
      <h2>User List</h2>
      <a href="new_user.php" class="button">Create User</a>
      <table id="users">
  <tr>
    <th>id</th>
    <th>email</th>
    <th>actions</th>
  </tr>
 <?php while ($row = $users->fetch()){ ?>
  <tr>
    <td><?php echo "{$row["id"]}"; ?></td>
    <td><?php echo "{$row["email"]}" ?></td>
    <?php echo "
    <td>
    <form method='POST' action='update_user.php'>
    <input type='hidden' name='id' value='".$row["id"]."'>
    <button name='update' class='button'>Update</button>
    </form> "; ?>
    <?php echo "
    <form  onsubmit=\"return confirm('You really want to delete the record?');\" method='POST' action='delete.php'>
    <input type='hidden' name='id' value='".$row["id"]."'>
    <button name='delete' class='button'>Delete</button>
    </form>
    </td> "; ?>
    
  </tr>
  <?php } ?>
</table>

  </body>
</html>

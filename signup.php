<?php
include_once 'DB/user_auth.php';
include_once 'DB/actions/navigation.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_POST['Username']) || empty($_POST['email']) || empty($_POST['password'])) {
        echo 'Please fill in all the fields';
    }
    else{
        $user = new User;
        $user->name = $_POST['Username'];
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];
    
        $registrationResult = $user->register();
    
        if ($registrationResult === -99) {
            echo 'User already exists';
        } elseif ($registrationResult) {
            echo 'Success';
        } else {
            echo 'Error in registering';
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>auth</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <h2>signup form</h2>
  <form action="signup.php" method="POST">

  <div class="mb-3 mt-3">
      <label for="text">Username:</label>
      <input type="text" class="form-control" id="Username" placeholder="Enter Username" name="Username">
    </div>

    <div class="mb-3 mt-3">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    <dijavascript:void(0);v class="mb-3">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
      <div class="form-check mb-3 pt-4">
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="login.php" class=" btn btn-dark">login</a>

    </div>
    </div>

    
  </form>
</div>

</body>
</html>
<?php
session_start();
$_SESSION['auth'] = false;

// Check if the email and password fields are set
// If yes - go to the next stage of authentication
// If not, displaying a message about the data absence
if(isset($_POST['Email']) and isset($_POST['Password'])){

  // Put the data of the input fields in separate variables for ease of use
  $email = $_POST['Email'];
  $password = $_POST['Password'];

  // Reading the file with users and decode data into an array
  $users = file_get_contents("users.json");
  $users = json_decode($users, true);

  // Iterate over the array of users
  // In case of correct authentication data: display a message about successful authentication
  // in other cases, displaying a message about data incorrectness
  foreach ($users as $user) {
      if($user["email"]==$email) {
        $pv = password_verify($password, $user["password"]);
        if ($pv) {
          $_SESSION['auth'] = true;
          $_SESSION['email'] = $email;
          echo "Authorization complete as ".$email;
          echo "<p><a href=\"/SEST/index.php\">Return to main page</a></p>";
        }
        else {
          echo "Password is wrong";
          echo "<p><a href=\"login.html\">Try again</a></p>";
        }
      }
      else {
        echo "Account with this email is not registered";
        echo "<p><a href=\"login.html\">Try again</a></p>";

  }
}
else {
  echo "Email and/or password are not entered";
  echo "<p><a href=\"login.html\">Try again</a></p>";
}
 ?>

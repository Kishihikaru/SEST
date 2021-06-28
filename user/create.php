<?php
session_start();

// Check if the email and password fields are set
// If yes - go to the next stage of registration
// If not, displaying a message about the data absence
if(isset($_POST['Email']) and isset($_POST['Password'])){
  // Put the data of the input fields in separate variables for ease of use
  $email = $_POST['Email'];
  $password = $_POST['Password'];

// Reading the file with users and decode data into an array
$users = file_get_contents("users.json");
$users = json_decode($users, true);

// Checking for the entered mail in the user base
$email_check = false;
foreach ($users as $user) {
    if($user["email"]==$email) $email_check = true;
}

// If there is no user with such email in the database
// Register a user
// Otherwise: displaying a message about the existence of a user with such email
if($email_check == false){
  $new_user = ["password" => password_hash($password, PASSWORD_BCRYPT) ,"email" => $email];
  array_push($users, $new_user);
  unlink("users.json");
  $users = json_encode($users);
  $fo = fopen("users.json","w");
  file_put_contents("users.json", $users);
  fclose($fo);
  $users = file_get_contents("users.json");
  $users = json_decode($users, true);
  foreach ($users as $user) {
      if($user["email"]==$email) echo "User was created";
      $_SESSION['auth'] = true;
      $_SESSION['email'] = $email;
  }
}
else {
  echo "User with this email already exist";
}
echo "<p><a href=\"/SEST/index.php\">Return to main page</a></p>";

}
 ?>

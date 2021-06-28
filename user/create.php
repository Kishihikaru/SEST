<?php
session_start();

// Проверяем установлены ли поля почты и пароля
// Если да - переходим на следующий этап регистрации
// Если нет - выводим сообщение об отсутствии данных
if(isset($_POST['Email']) and isset($_POST['Password'])){
  // Поместим данные полей ввода в отдельные переменные для простоты использования
  $email = $_POST['Email'];
  $password = $_POST['Password'];

// Считываем файл с юзерами и декодируем данные в массив
$users = file_get_contents("users.json");
$users = json_decode($users, true);

// Проверка на наличие введённой почты в базе юзеров
$email_check = false;
foreach ($users as $user) {
    if($user["email"]==$email) $email_check = true;
}

// Если в базе нет юзера с такой почтой
// Проводи регистрацию
// Иначе: выводим сообщение о существовании пользователя с такой почтой
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

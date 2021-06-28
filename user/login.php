<?php
session_start();
$_SESSION['auth'] = false;

// Проверяем установлены ли поля почты и пароля
// Если да - переходим на следующий этап аутентификации
// Если нет - выводим сообщение об отсутствии данных
if(isset($_POST['Email']) and isset($_POST['Password'])){

  // Поместим данные полей ввода в отдельные переменные для простоты использования
  $email = $_POST['Email'];
  $password = $_POST['Password'];

  // Считываем файл с юзерами и декодируем данные в массив
  $users = file_get_contents("users.json");
  $users = json_decode($users, true);

  // Перебираем массив юзеров
  // В случае правильных данных аутентификации: выводим сообщение об удачной аутентификации
  // в иных случаях выводим сообщение об неправильности данных
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

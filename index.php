<?php
session_start();
// Authentication check
if(isset($_SESSION['auth'])){
  if($_SESSION['auth'] == true){
    echo "Authorization complete as ".$_SESSION['email'];
  }
}
?>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>SEST btc</title>
</head>
<body>
  <header>
        <ul>
          <li>
              <a href="/SEST/user/create.html">register</a>
          </li>
          <li>
              <a href="/SEST/user/login.html">login</a>
          </li>
        </ul>
</header>
<li>
    <a href="/SEST/btc/btcRate.php">btc rate</a>
</li>
<!-- <p>
  <li>
    <a href="/SEST/test.php">test</a>
  </li>
</p> -->
</body>
</html>

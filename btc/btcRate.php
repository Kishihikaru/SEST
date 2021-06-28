<?php
session_start();
// Проверка аутентификации
if(isset($_SESSION['auth'])){
  if($_SESSION['auth'] == true){

    echo "Authorization complete as ".$_SESSION['email'];
    echo "</br>";
    // задаём поля запроса
    $data['fsym'] = 'BTC';
    $data['tsyms'] = 'UAH';
    $data['api_key'] = '69bdc08a0237cf0c544e563ef5641b4507cdf4f2b6c3f03eb2da5348b0120542';
    $url = 'https://min-api.cryptocompare.com/data/price';

    // Производим запрос
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url.'?'.http_build_query($data));
    $response= curl_exec($ch);
    curl_close($ch);

    // Результат запроса декодируем в массив и выводим нужный нам результат
    $response = json_decode($response, true);
    echo "Bitcoin currency: ".$response["UAH"]." гривень";

    echo "<p><a href=\"/SEST/index.php\">Return to main page</a></p>";

  }
}

?>

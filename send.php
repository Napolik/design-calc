<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $post_values = $_POST;

  foreach ($post_values as $key => $value) {
      if ($key == 'kvartira') {
        $key = "Квартира";
      }
      if ($key == 'house') {
        $key = "Будинок";
      }
      if ($key == 'office') {
        $key = "Офіс";
      }
      if ($key == 'cafe') {
        $key = "Ресторан/Кафе";
      }
      if ($key == 'beauty') {
        $key = "Салон краси";
      }
      if ($key == 'other') {
        $key = "Інше";
      }
      if ($key == 'other-text') {
        $key = "Інше: ";
      }
      if ($key == 'area') {
        $key = "Площа: ";
      }
      if ($key == 'city') {
        $key = "Місто: ";
      }
      if ($key == 'under-key') {
        $key = "Під ключ ";
      }
      if ($key == 'have-time') {
        $key = "У мене є час контролювати весь процес";
      }
      if ($key == 'need-designer') {
        $key = "Я готовий(а) брати участь, але потрібна допомога дизайнера";
      }
      if ($key == 'your-variant') {
        $key = "Ваша відповідь";
      }
      if ($key == 'your-answer') {
        $key = "Текст відповіді: ";
      }
      if ($key == 'minus15') {
        $key = "Знижка на дизайн-проєкт 15%";
      }
      if ($key == 'free') {
        $key = "Безкоштовна комплектація інтер'єру";
      }
      if ($key == 'minus50') {
        $key = "Знижка на ведення ремонту 50%";
      }
      if ($key == 'minus10') {
        $key = "Знижка на виробництво меблів 10%";
      }
      if ($key == 'name') {
        $key = "Ім'я";
      }
      if ($key == 'Phone') {
        $key = "Номер телефону";
      }
      if ($key == 'Email') {
        $key = "Електронна адреса";
      }

      $form_data .= $key . ": " . $value . "\n" . "<br/>";
  }
}

// Відправляємо електронний лист
$to = 'rv.setra@gmail.com'; // Встановіть сюди вашу електронну адресу
$subject = 'Заявка на розрахунок';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: admin@wecraft.site' . "\r\n"; // Встановіть сюди вашу електронну адресу

// Включаємо таблицю у вміст електронного листа
$message = '<html><body>';
$message .= $subject . "<br/>";
$message .= $form_data;
$message .= '</body></html>';

// Відправляємо лист
$mailSent = mail($to, $subject, $message, $headers);
die();
?>
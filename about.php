<?php
session_start();
$errorMessages = [];
$formData = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formData['name'] = trim($_POST['name']);
    $formData['email'] = trim($_POST['email']);
    $formData['age'] = trim($_POST['age']);
    $formData['region'] = $_POST['region'];
    if(isset($_POST['radio'])){$formData['radio'] = $_POST['radio'];}
    else{$formData['radio'] = null;}
    if(isset($_POST['checkbox'])){$formData['checkbox'] = true;}
    else{$formData['checkbox'] = false;}
    $formData['password'] = md5($_POST['password']);
    function name($name){if (empty($name)) {
        return("Поле 'Имя' обязательно для заполнения.");}}
    function email($mail){if (empty($mail)) {return("Поле 'Эл. Почта' обязательно для заполнения.");}}
    function password($password){if ($password== md5('')) {return("Введите пароль.");}}
    function age($i){;if (empty($i) && $i > 0) {return("Поле 'Возраст' обязательно для заполнения.");}}
    function region($reg){if (empty($reg)) {return("Поле 'Область' обязательно для выбора.");}}
    function radio($radio){if (empty($radio)) {return("Выберите пол.");}}
    function checkbox($val)
    {if (empty($val)) {return("Поддтвердите данные.");}}
    $errorMessages[] = name($formData['name']);$errorMessages[] = email($formData['email']);$errorMessages[] = age($formData['age']);$errorMessages[] = region($formData['region']);$errorMessages[] = radio($formData['radio']);$errorMessages[] = checkbox($formData['checkbox']);$errorMessages[] = password($formData['password']);

    if (empty($errorMessages[1]) && empty($errorMessages[2])&& empty($errorMessages[3])&& empty($errorMessages[4])&&empty($errorMessages[5])&&empty($errorMessages[6])&&empty($errorMessages[0])) {
        $logData = [
            'timestamp' => date('Y-m-d H:i:s'),
            'data' => $formData
        ];
        file_put_contents('log.json', json_encode($logData, JSON_PRETTY_PRINT) . PHP_EOL, FILE_APPEND);
        echo ('Данные успешно отправлены!');
        $formData = [];
        $errorMessages = [];
        $_SESSION["errorMessages"] = [];
    }
    else{
        $_SESSION["errorMessages"]=$errorMessages;
        header('Location: index.php');
    }
}
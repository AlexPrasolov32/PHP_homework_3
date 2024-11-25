<?php
session_start();
require_once('dictionary.php');
$errorMessages = [];
if (isset($_SESSION['errorMessages'])) {
    $errorMessages = $_SESSION['errorMessages'];}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div>
    <?php
    if (!empty($errorMessages)) {
        echo implode('<br>', $errorMessages);
    }
    ?>
</div>
<div class="parent">
    <div class="block">
        <form method="post" action="about.php">
            <label for="name">Введите имя:</label>
            <input type="text" id="name" name="name" >
            <br>
            <label for="email">Введите Эл. почту:</label>
            <input type="email" id="email" name="email" >
            <br>
            <label for="age">Введите фозраст:</label>
            <input type="number" id="age" name="age" >
            <br>
            <label for="region">Выберите регион:</label>
            <select id="region" name="region" >
                <option value=""></option>
                <?php foreach ($regions as $region): ?>
                    <option value="<?php echo htmlspecialchars($region); ?>"><?php echo htmlspecialchars($region); ?></option>
                <?php endforeach; ?>
            </select>
            <br>
            <label>Выберите пол:</label>
            <label><input type="radio" name="radio" value="Муж"> Мужской</label>
            <label><input type="radio" name="radio" value="Жен"> Женский</label>
            <br>
            <label for="password">Введите пароль:</label>
            <input type="password" id="password" name="password" >
            <br>
            <label><input type="checkbox" name="checkbox"> Данные верны</label>
            <br>
            <button type="submit">Отправить</button>
        </form>
    </div>
</div>
</body>
</html>


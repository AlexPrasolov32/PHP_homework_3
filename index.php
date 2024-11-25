<?php
$errorMessages = [];
$formData = [];
$regions = ["Адыгея",    "Алтай",    "Алтайский край",    "Амурская область",    "Архангельская область",    "Астраханская область",    "Башкортостан",    "Бурятия",    "Владимирская область",    "Волгогадская область",    "Вологодская область",    "Воронежская область",    "Дагестан",    "Еврейская автономная область",    "Забайкальский край",    "Ивановская область",    "Ингушетия",    "Иркутская область",    "Кабардино-Балкарская Республика",    "Калининградская область",    "Калужская область",    "Камчатский край",    "Карачаево-Черкесская Республика",    "Карелия",    "Кемеровская область",    "Кировская область",    "Костромская область",    "Краснодарский край",    "Красноярский край",    "Курганская область",    "Курская область",    "Ленинградская область",    "Липецкая область",    "Магаданская область",    "Марий Эл",    "Мордовия",    "Москва",     "Московская область",    "Ненецкий автономный округ",    "Нижегородская область",    "Новгородская область",    "Новосибирская область",    "Омская область",    "Оренбургская область",    "Орловская область",    "Пензенская область",    "Пермский край",    "Приморский край",    "Псковская область",   "Ростовская область",    "Рязанская область",    "Самарская область",    "Саратовская область",    "Сахалинская область",    "Свердловская область",    "Тамбовская область",    "Татарстан",    "Тверская область",    "Томская область",    "Тульская область",    "Тыва",    "Удмуртия",    "Ульяновская область",    "Челябинская область",    "Чечня",    "Чувашия",    "Ямало-Ненецкий автономный округ", "Ярославская область"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formData['name'] = trim($_POST['name']);
    $formData['email'] = trim($_POST['email']);
    $formData['age'] = trim($_POST['age']);
    $formData['region'] = $_POST['region'];
    if(isset($_POST['radio'])){$formData['radio'] = $_POST['radio'];}
    else{$formData['radio'] = null;}
    if(isset($_POST['checkbox'])){$formData['checkbox'] = true;}
    else{$formData['radio'] = false;}
    $formData['password'] = md5($_POST['password']);
    if (empty($formData['name'])) {$errorMessages[] = "Поле 'Имя' обязательно для заполнения.";}
    if (empty($formData['email'])) {$errorMessages[] = "Поле 'Эл. Почта' обязательно для заполнения.";}
    if (empty($formData['age']) && $formData['age']>0) {$errorMessages[] = "Поле 'Возраст' обязательно для заполнения.";}
    if (empty($formData['region'])) {$errorMessages[] = "Поле 'Область' обязательно для выбора.";}
    if (empty($formData['radio'])) {$errorMessages[] = "Выберите пол.";}
    if (empty($formData['password'])) {$errorMessages[] = "Введите пароль.";}
    if (empty($formData['checkbox'])) {$errorMessages[] = "Поддтвердите данные.";}
    if (empty($errorMessages)) {
        $logData = [
            'timestamp' => date('Y-m-d H:i:s'),
            'data' => $formData
        ];
        file_put_contents('log.json', json_encode($logData, JSON_PRETTY_PRINT) . PHP_EOL, FILE_APPEND);
        echo ('Данные успешно отправлены!');
        $formData = [];
        $errorMessages = [];
    }
}
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
        <form method="post" action="">
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


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Валидация регистрации</title>
</head>
<body>
<h1>Спасибо за регистрацию!</h1>

<p>
    Нам необходимо <a href='{{ url("register/confirm/{$user->confirmation_code}") }}'>подтвердить Ваш email</a>!
</p>
</body>
</html>
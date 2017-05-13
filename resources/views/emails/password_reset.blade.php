<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
<h3>
    @lang('texts.password reset')
</h3>
<p>
    Пользователь {{$user->name}} запросил смену пароля
</p>
<p>
    <a href="{!! url('users') !!}">Сменить</a>
</p>
</body>
</html>
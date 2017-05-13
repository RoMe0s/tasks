<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@lang('labels.new task')</title>
</head>
<body>
    <h3>
        @lang('texts.new task in project')
        {{$task->name}}
    </h3>
    <p>
        Добавлена задача {{$task->name}} в проекте: {{$task->project->name}}
    </p>
    <p>
        Описание: {{$task->description}}
    </p>
    <p>
        Доступна по ссылке: {{$task->project->getUrl()}}
    </p>
</body>
</html>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LARAVEL-db</title>
    <style>
        .Test {
        margin: 4px;
        padding: 4px;
        border: 1px solid red;
    }
    </style>
</head>
<body>
    <p>Test</p>
    
    @for ($index = 0; $index < count($Test); $index++)
        <div class="Test">
            <p class="email">{{ $Test[$index]->email }}</p>
            <p class="password">{{ $Test[$index]->password }}</p>
            <p class="passport">{{ $Test[$index]->passport }}</p>
            <p class="birth_day">{{ $Test[$index]->birth_day }}</p>
        </div>
    @endfor

</body>
</html>

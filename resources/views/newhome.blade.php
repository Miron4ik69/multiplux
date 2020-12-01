<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form action="{{ route('add') }}" method="post" enctype="multipart/form-data">
    @csrf
    <p>Картинка</p>
    <input type="file" name="image">
    <p>Заголовок</p>
    <input type="text" name="title">
    <p>Видео</p>
    <input type="text" name="video">
    <p>Стоимост</p>
    <input type="text" name="price">
    <p>Возраст</p>
    <input type="text" name="age">
    <p>duration</p>
    <input type="text" name="duration">
    <p>director</p>
    <input type="text" name="director">
    <p>country</p>
    <input type="text" name="country">
    <p>start_hire</p>
    <input type="text" name="start_hire">
    <p>end_hire</p>
    <input type="text" name="end_hire">
    <p>studio</p>
    <input type="text" name="studio">
    <p>language</p>
    <input type="text" name="language">
    <p>rating</p>
    <input type="text" name="rating">


    <p>Описание</p>
    <textarea name="description" id="" cols="30" rows="10">

    </textarea>
    <button type="submit">send</button>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

</body>
</html>
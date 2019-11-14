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
<h1>welcome to pooyaShop</h1>
dear {{ $contact->full_name ? $contact->full_name : "user"  }}: <br>
{{ $contact->response }}
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>login</h2>
    <form action="{{ url('api/login') }}" method="POST">
        <label for=""> email</label>
      <input type="email" name="" id="">
      <label for="">password</label>
        <input type="password" name="" id="">
        <button type="submit">Submit</button>
    </form>
</body>
</html>
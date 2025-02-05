<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .content {
            font-size: 16px;
            color: #555555;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
         Ваш код подтверждения: <strong>{{ $verificationCode }}</strong>
    </div>
</div>
</body>
</html>

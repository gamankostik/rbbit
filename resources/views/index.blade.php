<!DOCTYPE html>
<html>
<head>
    <title>Binance-Style Buttons</title>
    <!-- Подключение стилей Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Подключение стилей Binance -->
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #0E1F32;
            background-image: url('https://example.com/background-image.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0; /* Убираем отступы по умолчанию */
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 40px;
            border-radius: 20px;
            max-width: 800px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .binance-button {
            background-color: #F0B90B;
            border-color: #F0B90B;
            color: #fff;
            font-size: 28px;
            padding: 20px 40px;
            border-radius: 15px;
            margin: 15px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .binance-button:hover {
            background-color: #FFD439;
            border-color: #FFD439;
            color: #fff;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <a href="{{route('address')}}" class="binance-button">Create address</a>
        <a href="{{route('transaction')}}" class="binance-button">Create transaction</a>
    </div>
</div>

<!-- Подключение скриптов Bootstrap -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

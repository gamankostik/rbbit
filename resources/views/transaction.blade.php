<!DOCTYPE html>
<html>
<head>
    <title>RBbit</title>
    <!-- Подключение стилей Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Подключение стилей Binance -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #0E1F32;
            background-image: url({{'background.jpg'}});
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
        }

        .binance-input {
            padding: 10px;
            font-size: 16px;
            border-radius: 8px;
            margin-bottom: 10px;
            width: 100%;
        }

        .binance-checkbox-label {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .binance-button {
            background-color: #F0B90B;
            border-color: #F0B90B;
            color: #fff;
            font-size: 18px;
            padding: 10px 20px;
            border-radius: 8px;
            margin-top: 10px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .binance-button:hover {
            background-color: #FFD439;
            border-color: #FFD439;
            color: #fff;
        }

        .binance-inline-input {
            display: inline-block;
            width: calc(50% - 80px); /* Учитываем ширину чекбокса и небольшого инпута */
            margin-right: 10px;
        }

        .binance-custom-checkbox {
            display: inline-block;
            position: relative;
            padding-left: 30px;
            cursor: pointer;
            font-size: 16px;
            user-select: none;
        }

        .binance-custom-checkbox input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .binance-custom-checkbox .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: #fff;
            border: 1px solid #F0B90B;
            border-radius: 4px;
        }

        .binance-custom-checkbox input:checked ~ .checkmark {
            background-color: #F0B90B;
        }

        .binance-custom-checkbox .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .binance-custom-checkbox input:checked ~ .checkmark:after {
            display: block;
        }

        .binance-custom-checkbox .checkmark:after {
            left: 7px;
            top: 2px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        /* Стили для успешного сообщения в стиле Binance */
        .binance-success {
            color: #368c62;
            font-size: 32px;
            margin-bottom: 20px;
            text-align: center;
        }

        .binance-error-404 {
            color: #F44336;
            font-size: 32px;
            margin-bottom: 20px;
            text-align: center;
        }


        /* Сброс стилей для ссылок */
        a {
            text-decoration: none;
            color: inherit;
        }

        /* Стили кнопки */
        .binance-back-button {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            background-color: #F0B90B;
            border: 1px solid #F0B90B;
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
            color: #1F2635;
            transition: background-color 0.2s ease;
        }

        .binance-back-button:hover {
            background-color: #E6A008;
        }

        /* Стили стрелочки */
        .binance-arrow {
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 4px 0 4px 6px;
            border-color: transparent transparent transparent #1F2635;
            margin-right: 10px;
        }

        /* Изменение цвета стрелочки при наведении на кнопку */
        .binance-back-button:hover .binance-arrow {
            border-color: transparent transparent transparent #FFF;
        }

        .binance-button-right {
            display: block;
            margin-left: auto;
        }

        /* Стили для блока "loading" */
        .loading-container {
            display: none;
            justify-content: center; /* Выравнивание по горизонтали */
            align-items: center; /* Выравнивание по вертикали */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 9999;
        }

        .loading-icon {
            border: 6px solid #f3f3f3;
            border-top: 6px solid #3498db;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
<div class="container"  id="formContainer">
    <a href="{{route('index')}}" class="binance-back-button ">
        <span class="binance-arrow"></span>
        Home
    </a>
    <br>
    <br>
    <div class="invalid-feedback" id="input1Feedback">Required</div>
    <input type="text" name="address_from" id="input1" maxlength="150" required class="form-control binance-input" placeholder="Enter address from">

    <div class="form-group">
        <div class="invalid-feedback" id="input2Feedback">Required</div>
        <input type="text" name="amount" id="input2"  maxlength="8" class="form-control binance-inline-input" placeholder="Amount">
        <label class="binance-custom-checkbox">
            <input type="checkbox" checked disabled>
            <span class="checkmark"></span>
            Commission
        </label>
    </div>
    <div class="invalid-feedback" id="input3Feedback">Required</div>
    <input type="text" name="address_to"  id="input3" maxlength="150" required class="form-control binance-input" placeholder="Enter address to">

    <button id="submitButton" class="binance-button binance-button-right">Send</button>
</div>

<div class="container" id="successMessage" style="display: none;">
    <a href="{{route('index')}}" class="binance-back-button ">
        <span class="binance-arrow"></span>
        Home
    </a>
    <br>
    <br>
    <p class="binance-success">Success!</p>
</div>

<div class="container" id="notSuccessMessage" style="display: none;">
    <a href="{{route('index')}}" class="binance-back-button ">
        <span class="binance-arrow"></span>
        Home
    </a>
    <br>
    <br>
    <p class="binance-success">Not success!</p>
</div>

<div class="container" id="error404Message" style="display: none;">
    <a href="{{route('index')}}" class="binance-back-button ">
        <span class="binance-arrow"></span>
        Home
    </a>
    <br>
    <br>
    <p class="binance-error-404">ERROR 101</p>
</div>

<div class="loading-container" id="loadingContainer">
    <div class="loading-icon"></div>
</div>

<!-- Подключение скриптов Bootstrap -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Подключение скрипта JavaScript -->
<script src="{{asset('js/transaction.js')}}"></script>
</body>
</html>

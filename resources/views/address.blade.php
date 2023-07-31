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

        .binance-button {
            background-color: #F0B90B;
            border-color: #F0B90B;
            color: #fff;
            font-size: 18px;
            padding: 5px 10px; /* Уменьшение размеров кнопки */
            border-radius: 5px; /* Уменьшение радиуса скругления углов кнопки */
            margin: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .binance-button:hover {
            background-color: #FFD439;
            border-color: #FFD439;
            color: #fff;
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
<div class="container">
    <a href="{{route('index')}}" class="binance-back-button">
        <span class="binance-arrow"></span>
        Home
    </a>
    <table class="table table-borderless">
        <tr>
            <td style="display: flex; align-items: center;">
                <select id="selectOption" class="form-control form-control-sm" style="flex: 1;">
                    @foreach(\App\Model\Coin::TYPE as $type)
                        <option value="{{$type}}">{{$type}}</option>
                    @endforeach
                </select>
                <button id="submitButton" class="binance-button">Go</button>
            </td>
            <td><input type="text" readonly id="input1" class="form-control"></td>
        </tr>
        <tr>
            <td>TT1:</td>
            <td><input type="text" readonly style="width: 100px" id="input2" class="form-control"></td>
        </tr>
        <tr>
            <td>TX1:</td>
            <td><input type="text" readonly style="width: 100px" id="input3" class="form-control"></td>
        </tr>
    </table>

    <div class="loading-container" id="loadingContainer">
        <div class="loading-icon"></div>
    </div>
</div>

<!-- Подключение скриптов Bootstrap -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Подключение скрипта JavaScript -->
<script src="{{asset('js/address.js')}}"></script>
</body>
</html>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>หน้าแผนที่</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&family=Roboto:wght@100&display=swap"
        rel="stylesheet">
    <style>
        .grad {
            background: linear-gradient(to bottom, #6B4693, #BA5384);
            background-size: 100% 100%;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .text {
            font-family: 'Kanit', sans-serif;
            color: #FFFFFF;
            font-size: 25px;
            font-weight: bold;
        }

        .btn-color {
            font-family: 'Kanit', sans-serif;
            font-size: 20px;
            font-weight: bold;
            background-color: #382457;
            color: #FFFFFF;
            border: none;
            border-radius: 10px;
            border-bottom: 3px solid #FFFFFF;
            transition: background-color 0.3s;
        }

        .btn-color:hover {
            background-color: #A988BF;
            color: #382457;
        }

        a {
            color: inherit;
            text-decoration: none;
        }
    </style>
</head>

<body class="grad">
    <div class="container p-4 mt-3 ">
        <div>
            <h2 class="text-end text me-4">แผนที่</h2>
        </div>
    </div>
    <div class="container">
        <div class="container ">
            <div class="row" id="button-container">
                @foreach ($listmap as $map)
                    <button type="button" class="btn btn-color btn-lg mb-3 text-start ps-4" name="MapSelect"
                        data-name="{{ $map['name'] }}" data-id="{{ $map['id'] }}">
                        <a href="{{ route('building', ['id' => $map['id']]) }}">
                            {{ $map['name'] }}
                        </a>
                    </button>
                @endforeach
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>หน้าจัดการแผนที่อาคารและกิจกรรม</title>
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
        .font {
            font-family: 'Kanit', sans-serif;
        }
        .btn-color {
            font-family: 'Kanit', sans-serif;
            font-size: 20px;
            font-weight: bold;
            background-color: #382457;
            color: #FFFFFF;
            border: none;
        }

        .btn-color:hover {
            background-color: #A988BF;
            color: #382457;
        }
        .btn-subcolor {
            background-color: #A988BF;
            font-weight: bold;
            font-size: 17px;
            color: #382457;
        }
    </style>
</head>
<body class="grad">
    <div class="container p-2 mt-1 ">
        <div>
            <h2 class="text-end text me-2">{{ $maps->name }}</h2>
        </div>
    </div>
    <div class="container ">
        <img class="img-fluid " src="{{ $maps->img }}" alt="image">
    </div>    
    <div class="container">
        <div class="card mt-3">
            <div class="card-header font btn-subcolor">
                {{ $maps->name }}
            </div>
            <div class="card-body">
                @foreach ($listact as $item)
                    <h5 class="card-title font "> <strong>{{ $item['name'] }}</strong> </h5>
                    <div class="hstack">
                        <p class="card-text pt-3 me-3 font">{{ $item['date'] }}</p>
                        <p class="card-text font">{{ $item['time'] }}</p>
                    </div>
                    <p class="card-text font">{{ $item['description'] }}</p>
                    <hr />
                @endforeach
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>

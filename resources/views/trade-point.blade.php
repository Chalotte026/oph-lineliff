<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>จุดแลกรางวัล</title>
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
    </style>
</head>

<body class="grad">
    <div class="container">
        <h1 class="text-center mt-4 text">รายการรางวัล</h1>
        <div class="card m-3">
            <div class="card-body ">
                <img src="{{ $img }}" class="rounded mx-auto d-block" alt="..." height="400px">
            </div>
        </div>
        <h3 class="text-left mt-3 p-3 text">จุดแลกรางวัล</h3>
        <div class="card m-3">
            <div class="card-body font">
                <p>{{ $description }}</p>
                <div class="text-end font">
                    <a href="{{ $link }}">ตำแหน่งจุดแรกรางวัล</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>

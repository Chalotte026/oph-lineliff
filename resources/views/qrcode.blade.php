<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
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
            font-size: 30px;
            font-weight: bold;
        }

        p.text {
            font-family: 'Kanit', sans-serif;
            color: black;
            font-size: 20px;
            font-weight: bold;
        }

        p.text-sub {
            font-family: 'Kanit', sans-serif;
            font-size: 17px;
            font-weight: bold;
        }
    </style>
</head>

<body class="grad">
    <h1 class="text-center mt-5 text">My QRcode</h1>
    <div class="card m-3 mt-5 text-center">
        <div class="content">
            <div id="qrcode" style="margin: 2rem auto;">
                <?php echo QrCode::size(300)->generate(route('givepoint', ['id' => $user->id])); ?>
            </div>
            <p class="text">MyQrcode <br></p>
            <p class="text-sub">ใช้ในการรับคะเเนนการเข้าร่วมกิจกรรม</p>
        </div>
    </div>
    <!-- http://127.0.0.1:8000/give_point/{{ $user->id }} -->
    <p><a class="link-offset-1 text-center" href="{{ route('givepoint', ['id' => $user->id]) }}">ไปให้คะแนน</a></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>

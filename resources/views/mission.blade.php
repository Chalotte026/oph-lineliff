<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ภารกิจสะสมแต้ม</title>
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

        a.text {
            font-family: 'Kanit', sans-serif;
            text-decoration: none;
            color: #FFFFFF;
            font-size: 18px;
            font-weight: bold;
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
        .point {
            font-size: 50px;
        }
        p{
          font-family: 'Kanit', sans-serif;
        }
    </style>
</head>

<body class="grad">
    <div class="container">
        <section>
            <h1 class="text-center text mt-5">ภารกิจสะสมเเต้ม</h1>
            <!--เเต้มของฉัน-->
            <div class="card m-5">
                <div class="card-body">
                    <h1 class="text-center point">
                        @if ($user->point === null)
                            {{ '0' }}
                        @else
                            {{ $user->point }} 
                        @endif
                    </h1>
                    <hr />
                    <p class="text-center mt-3">แต้มของฉัน</p>
                </div>
            </div>
            <div class="container vstack gap-3 ">
                <a class="btn btn-color btn-lg" href="{{ route('how2point') }}" role="button">วิธีสะสมแต้ม</a>
                <a class="btn btn-color btn-lg" href="/map" role="button">แผนที่</a>
                <a class="btn btn-color btn-lg" href="{{ route('tradepoint') }}" role="button">จุดแลกรางวัล</a>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>

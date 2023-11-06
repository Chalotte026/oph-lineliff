<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>เกียรติบัตรที่ยังไม่ได้รับ</title>
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

        h5.font {
            font-family: 'Kanit', sans-serif;
            font-weight: bold;
        }

        p.font {
            font-family: 'Kanit', sans-serif;
            font-size: 15px;
        }

        .btn-select {
            background-color: #856bab;
            font-size: 12px;
            color: #FFFFFF;
            border: none;
        }

        .btn-unselect {
            background-color: #382457;
            font-size: 12px;
            color: #FFFFFF;
            border: none;
        }

        .btn-select:hover {
            background-color: #675385;
            font-size: 12px;
            color: #FFFFFF;
            border: none;
        }

        .btn-unselect:hover {
            background-color: #241737;
            font-size: 12px;
            color: #FFFFFF;
            border: none;
        }
    </style>
</head>

<body class="grad">
    <h1 class="text-center mt-4 text">My Certificated</h1>
    <div class="row justify-content-around mt-4">
        <a class="btn btn-select font col-4" href="{{ route('certicol', ['full_name' => $user->full_name]) }}"
            role="button">กิจกรรมที่ได้รับ</a>
        <a class="btn btn-unselect font col-4" href="{{ route('certinonecol', ['full_name' => $user->full_name]) }}"
            role="button">กิจกรรมที่ยังไม่ได้รับ</a>
    </div>
    <div class="container ">
        @foreach ($listcer as $item)
            <div class="card mx-auto mt-4" style="width: 20rem;">
                <div class="card-body ">
                    <h5 class="card-title font">{{ $item['name'] }}</h5>
                    <hr />
                    <p class="font ">
                        {{ $item['date-time'] }} <br>
                        {{ $item['building'] }} {{ $item['location'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>หน้าคณะและกิจกรรม</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&family=Roboto:wght@100&display=swap"
        rel="stylesheet">
    <style>
        .grad {
            background: linear-gradient(to bottom, #6B4693, #BA5384);
            background-size: 100% 100%;
            background-repeat: no-repeat;
            background-attachment: fixed;
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
            background-color: #382457;
            color: #FFFFFF;
        }

        .activity-text {
            font-family: 'Kanit', sans-serif;
            background-color: #A988BF;
            color: #FFFFFF;
            font-size: 18px;
            font-weight: bold;
        }

        .activity-text:hover {
            background-color: #A988BF;
            color: #382457;
        }

        .text {
            font-family: 'Kanit', sans-serif;
            color: #FFFFFF;
            font-size: 25px;
            font-weight: bold;
        }

        .custom-textarea {
            width: 100%;
            padding: 10px;
            border: none;
            background: transparent;
            resize: none;
            overflow: hidden;
            font-family: 'Kanit', sans-serif;
        }
    </style>
</head>

<body class="grad">
    <!--Header-->
    <section id="header">
        <div class="container">
            <h3 class="text-center mt-5 text">คณะเเละกิจกรรม</h3>
        </div>
    </section>
    <div class="accordion mt-4 m-3" id="d1">
        @foreach ($facultyNames as $faculty)
            <!--ชื่อคณะ-->
            <div class="accordion ">
                <h2 class="accordion-header " id="h{{ $faculty->id }}">
                    <button class="accordion-button collapsed btn-color mt-3 " type="button" data-bs-toggle="collapse"
                        data-bs-target="#bd{{ $faculty->id }}" aria-expanded="false"
                        aria-controls="bd{{ $faculty->id }}">
                        {{ $faculty->name }}
                    </button>
                </h2>
                <!--กิจกรรมของคณะ-->
                <div id="bd{{ $faculty->id }}" class="accordion-collapse collapse"
                    aria-labelledby="h{{ $faculty->id }}" data-bs-parent="#d1">
                    <div class="accordion " id="sub-dd{{ $faculty->id }}">
                        @foreach ($listact as $activity)
                            @if ($activity['faculty'] == $faculty->id)
                                <!-- แสดงกิจกรรมของคณะ -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="sub-h{{ $faculty->id }}-{{ $loop->index }}">
                                        <button class="accordion-button activity-text " type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#sub-bd{{ $faculty->id }}-{{ $loop->index }}"
                                            aria-expanded="false"
                                            aria-controls="sub-bd{{ $faculty->id }}-{{ $loop->index }}">
                                            {{ $activity['name'] }}
                                        </button>
                                    </h2>
                                    <div id="sub-bd{{ $faculty->id }}-{{ $loop->index }}"
                                        class="accordion-collapse collapse"
                                        aria-labelledby="sub-h{{ $faculty->id }}-{{ $loop->index }}"
                                        data-bs-parent="#sub-dd{{ $faculty->id }}">
                                        <div class="accordion-body custom-textarea">
                                            สาขา : {{ $activity['department'] }}<br />
                                            สถานที่ : {{ $activity['building'] }} {{ $activity['location'] }}<br />
                                            วัน : {{ $activity['date'] }} เวลา : {{ $activity['time'] }}<br />
                                            <p class="form-control-plaintext">{{ $activity['description'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>กรอกข้อมูลของผู้ให้คะเเนน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&family=Roboto:wght@100&display=swap"
        rel="stylesheet">
    <style>
        .grad {
            background: linear-gradient(to bottom, #6B4693, #BA5384);
            /* เปลี่ยนสีตรงนี้ตามที่คุณต้องการ */
            background-size: 100% 100%;
            /* ทำให้ gradient ขยายตามขนาดหน้าจอ */
            background-repeat: no-repeat;
            /* ไม่ให้ซ้ำซาก */
            background-attachment: fixed;
        }

        a.color {
            background-color: #382457;
            /* เปลี่ยนสีพื้นหลังเป็นสีแดง (#FF0000) */
            color: #FFFFFF;
            /* เปลี่ยนสีข้อความในปุ่มเป็นสีขาว (#FFFFFF) */
            border: none;
            /* ลบเส้นขอบของปุ่ม */
        }

        .text {
            font-family: 'Kanit', sans-serif;
            color: #FFFFFF;
            font-size: 25px;
            font-weight: bold;
        }

        .text-sub {
            font-family: 'Kanit', sans-serif;
            font-size: 17px;
        }
    </style>
</head>

<body class="grad">
    <h2 class="text-center mt-5 text">หน้าให้คะเเนน</h2>
    <div class="card mt-5 m-3">
        <div class="row m-1 mt-4">
            <div class="col-3 text-end text-sub">
                <p>เบอร์โทร </p>
            </div>
            <div class="col-9 mb-3">
                <select id="select-faculty" class="form-select">
                    <option selected>เลือกคณะ</option>
                    @foreach ($array1 as $item)
                        <option>{{ $item }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-3 text-end text-sub">
                <p>ให้หรือหัก </p>
            </div>
            <div class="col-auto mb-3">
                <select id="select-activity" class="form-select" size="1" aria-label="Size 6 select example">
                    <option selected>เลือกกิจกรรม</option>
                    @foreach ($array2 as $item)
                        <option>{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="container vstack gap-3 ">
        <a href="{{ route('scan') }}" role="button" class="btn btn-primary btn-lg">บันทึกข้อมูล</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>

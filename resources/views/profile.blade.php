<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ข้อมูลผู้ใช้งาน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
            font-family: 'Kanit', sans-serif;
            font-size: 20px;
            font-weight: bold;
            background-color: #382457;
            /* เปลี่ยนสีพื้นหลังเป็นสีแดง (#FF0000) */
            color: #FFFFFF;
            /* เปลี่ยนสีข้อความในปุ่มเป็นสีขาว (#FFFFFF) */
            border: none;
            /* ลบเส้นขอบของปุ่ม */
        }
        a.color:hover {
            background-color: #A988BF; 
            color: #382457; 
        }
        .text {
            font-family: 'Kanit', sans-serif;
            /* ระบุฟอนต์ที่คุณต้องการใช้ */
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>

<body class="grad">
    <!--Profile-->
    <div class="container text-center p-3">
        <img class="rounded mx-auto d-block mt-5 mb-3 "
            src="https://upload.wikimedia.org/wikipedia/th/thumb/9/9f/BULogo.svg/1200px-BULogo.svg.png" alt="logoBU"
            width="200px" height="200px">
        <div class="row">
            <div class="col-4 p-3 text-end text">
                ชื่อ
            </div>
            <div class="col-8 p-3 text-start text">
                {{ $user->full_name }}
            </div>
        </div>
        <div class="row">
            <div class="col-4 p-3 text-end text">
                เบอร์โทร
            </div>
            <div class="col-8 p-3 text-start text">
                {{ $user->phone }}
            </div>
        </div>
        <div class="row">
            <div class="col-4 p-3 text-end text">
                แต้มสะสม
            </div>
            <div class="col-8 p-3 text-start text">
                @if ($user->point === null)
                    {{ '0' }} point
                @else
                    {{ $user->point }} point
                @endif
            </div>
        </div>
        <!--Button-->
        <div class="container text-center vstack ">
            <a href="/activity" role="button" class="btn btn-lg color mb-3 mt-3">คณะเเละกิจกรรม</a>
            <a href="{{ url('/mission/') }}/{{ rawurlencode($user->full_name) }}" role="button"
                class="btn  btn-lg color mb-3">ภารกิจสะสมเเต้ม</a>
            <a href="{{ route('certicol', ['id' => $user->uuid, 'full_name' => $user->full_name]) }}" role="button"
                class="btn  btn-lg color mb-3">Certificated</a>
            <a href="{{ route('qrcode', ['id' => $user->uuid]) }}" role="button"
                class="btn btn-lg color mb-3">
                My QRcode</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>

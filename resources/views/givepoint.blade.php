<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>หน้าให้คะเเนน</title>
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
        .btn-color{
            background-color: rgb(21, 175, 21); 
            color: #ffffff; 
            border: none;
        }
        .btn-point {
            background-color: #2e2539;
            border: none;
            font-size: 20px;
            color: white;
        }
        .btn.active {
            background-color: #ab74ff;
            color: white;
        }
        .font-size {
            font-size: 18px;
        }
    </style>
</head>

<body class="grad">
    <div class="container">
        <h1 class="text-center mt-5 text">กรอกข้อมูลเพื่อให้คะเเนน</h1>
    </div>
    <div class="container vstack ">
        <form class="row" id="formText" action="{{ route('add.givepoint') }}" method="POST">
            @csrf
            <div class="card  mt-3  font">
                <div class="col-3 ms-3 mt-1">
                    <label for="staticName" class="visually-hidden">Name</label>
                    <input type="text" readonly class="form-control-plaintext fw-bold font-size" id="staticName"
                        value="ชื่อผู้รับ">
                </div>
                <div class="col-11 ms-3">
                    <input class="form-control" type="text" placeholder="{{ $user->full_name }}"
                        aria-label="Disabled input example" disabled id="userNameInput" name="userNameInput">

                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                </div>
                <div class="col-3 ms-3 mt-1">
                    <label for="staticActivity" class="visually-hidden">Activity</label>
                    <input type="text" readonly class="form-control-plaintext fw-bold font-size" id="staticActivity"
                        value="กิจกรรม">
                </div>
                <div class="col-11 ms-3">
                    <select class="form-select font-size" aria-label="Default select example" id="selectedActivity"
                        name="selectedActivity">
                        <option value="0" selected>เลือกกิจกรรมเพื่อให้คะเเนน</option>
                        @foreach ($activities as $id => $name)
                            <option value="{{ $id }}">{{ $id }}). {{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <p class="col-12 ms-3 fw-bold pt-3 font-size">เลือกจำนวนคะเเนน</p>
                <p class="col-12 lh-base ms-4 font-size">10 คะแนน สำหรับเช็คอินเข้ากิจกรรม ** <br>
                    20 คะแนน สำหรับการมีส่วนรวมกิจกรรม <br> (ตามดุลยพินิจของผู้จัด) ** <br>
                    30 คะแนน สำหรับตอบเเบบสอบถาม **<br>
                    70 คะแนน ขึ้นไปได้รับใบเกียรติบัตร **</p>
                <div class="row g-2 ms-2 me-2 mb-3 " id="buttonContainer">
                    <!-- ปุ่ม 10 ปุ่ม -->
                </div>
            </div>
            <input type="hidden" name="buttonpoint" id="buttonpoint" value="">
            <input class="btn btn-color btn-lg mt-3 font" type="submit" value="บันทึกข้อมูล" id="saveButton">
        </form>
    </div>
    <!-- script สร้างปุ่ม -->
    <script>
        const buttonContainer = document.getElementById('buttonContainer');

        function handleClick(button) {
            const buttons = buttonContainer.querySelectorAll('button');
            buttons.forEach((btn) => {
                btn.classList.remove('active');
            });

            button.classList.add('active');

            const buttonText = parseInt(button.textContent);
            const buttonpoint = document.getElementById('buttonpoint'); // เปลี่ยนเป็นการดึงโดยใช้ ID
            console.log(buttonText)
            // Update the buttonpoint value
            buttonpoint.value = buttonText; // แก้ไขการตั้งค่าให้เป็น buttonText * 10
        }
        for (let i = 0; i < 5; i++) {
            const row = document.createElement('div');
            row.classList.add('row', 'g-2');

            for (let j = 0; j < 2; j++) {
                const button = document.createElement('button');
                button.type = 'button';
                button.classList.add('btn', 'btn-dark','btn-point');
                const buttonText = i * 2 + j + 1;
                button.textContent = buttonText * 10;

                // Add the name attribute to the button
                button.name = 'buttonpoint'; // เปลี่ยนเป็นการกำหนดชื่อเป็น 'buttonpoint'
                button.addEventListener('click', () => {
                    handleClick(button); // แก้ไขการเรียกใช้ฟังก์ชัน
                });

                const column = document.createElement('div');
                column.classList.add('col-6', 'vstack', 'gap-3');
                column.appendChild(button);
                row.appendChild(column);
            }

            buttonContainer.appendChild(row);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>

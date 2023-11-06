<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>หน้าจัดการแผนที่</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <style>
        .custom-image {
            width: 300px;
            /* ปรับความกว้างตามต้องการ */
            height: 200px;
            /* ปรับความสูงตามต้องการ */
            object-fit: cover;
            /* เพื่อปรับขนาดรูปภาพอย่างถูกต้อง */
        }

        .subtitle {
            font-size: 13px;
        }
    </style>
</head>

<body>
    <!--Modal-->
    <section>
        <!--Modal Add Building in Map-->
        <div class="modal fade" id="addBuildingModal" tabindex="-1" aria-labelledby="addBuildingModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <form method="post" action="{{ route('backend.add.addbuilding') }}" >
                        @csrf
                        <div class="modal-body">
                            <div class="contaner-fluid">
                                <div class="row m-3">
                                    <div class="col-12">
                                        <button type="button" class="btn-close float-end" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <h5><strong>กรอกข้อมูลสถานที่</strong> <br></h5>
                                        <p class="subtitle">
                                            เป็นการกรอกข้อมูลรูปภาพสถานที่และชื่อเรียกที่ต้องการแสดงบนหน้าแผนที่ของ Line
                                            Official Account
                                        </p>
                                    </div>
                                    <div class="col-3">
                                        <p>URL รูปสถานที่ :</p>
                                    </div>
                                    <div class="col-9 mb-4">
                                        <input type="text" class="form-control" name="img" value="">
                                    </div>
                                    <div class="col-3">
                                        <p>ชื่อสถานที่ :</p>
                                    </div>
                                    <div class="col-9 mb-4">
                                        <input type="text" class="form-control" name="name" value="">
                                    </div>
                                    <div class="col align-self-end">
                                        <button class="btn btn-primary float-end" type="submit"
                                            id="submit">บันทึก</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Modal Create Activity in Building-->
        <div class="modal fade" id="createActivityModal" tabindex="-1" aria-labelledby="createActivityModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <!-- เนื้อหาของ Modal สำหรับเพิ่มกิจกรรม -->
                    <form method="post" action="{{ route('backend.add.addactivity') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row m-3 align-items-center">
                                    <div class="col-12">
                                        <button type="button" class="btn-close float-end" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <h5><strong>สร้างกิจกรรม</strong> <br></h5>
                                        <p class="subtitle">ส่วนจัดการสร้างกิจกรรมที่ต้องการเพิ่มเข้าไปในสถาณที่นั้นๆ
                                        </p>
                                    </div>

                                    <div class="row align-items-center mb-4">
                                        <div class="col-auto">
                                            <p class="col-form-label">ชื่อกิจกรรม*</p>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" name="name" value="">
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-4">
                                        <div class="col-auto ">
                                            <p class="col-form-label">ชื่อสถานที่*</p>
                                        </div>
                                        <div class="col">
                                            <select class="form-select" aria-label="Default select example"
                                                id="selectedMap" name="selectedMap">
                                                <option value="0" selected>กรุณาเลือกสถานที่ที่ต้องการเพิ่มกิจกรรม
                                                </option>
                                                @foreach ($listMap as $map)
                                                    <option value="{{ $map['id'] }}">{{ $map['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-4">
                                        <div class="col-auto ">
                                            <label for="inLocation"
                                                class="col-form-label">ที่ตั้ง/ตำแหน่ง/ห้องที่จัดกิจกรรม</label>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" name="location" value="">
                                        </div>
                                        <div class="col-auto">
                                            <span id="dateHelpInline" class="form-text">
                                                เช่น A4306 etc.
                                            </span>
                                        </div>
                                    </div>
                                    <!-- HTML -->
                                    <div class="row align-items-center mb-4">
                                        <div class="col-auto">
                                            <label for="inTstart" class="col-form-label">คณะ*</label>
                                        </div>
                                        <div class="col">
                                            <select class="form-select" aria-label="Default select example"
                                                id="selectedFaculty" name="selectedFaculty">
                                                <option value="0" selected>กรุณาเลือกคณะ</option>
                                                @foreach ($listFaculty as $faculty)
                                                    <option value="{{ $faculty['id'] }}">{{ $faculty['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row align-items-center mb-4">
                                        <div class="col-auto ">
                                            <label for="inTstart" class="col-form-label">สาขา</label>
                                        </div>
                                        <div class="col">
                                            <select class="form-select" aria-label="Default select example"
                                                id="selectedDepartment" name="selectedDepartment">
                                                <option value="0" selected>กรุณาเลือกสาขา</option>
                                                @foreach ($listDepartments as $depart)
                                                    <option value="{{ $depart['id'] }}"
                                                        data-faculty-id="{{ $depart['faculty_id'] }}">
                                                        {{ $depart['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <label for="indate" class="col-form-label">วันที่*</label>
                                        </div>
                                        <div class="col-auto">
                                            <input type="text" id="indate" class="form-control" name="date"
                                                aria-describedby="passwordHelpInline"
                                                placeholder="เช่น 9 พฤศจิกา , ทั้ง 3 วัน">
                                        </div>
                                        <div class="col-auto ">
                                            <label for="inTstart" class="col-form-label">เวลาเริ่มงาน*</label>
                                        </div>
                                        <div class="col-auto">
                                            <input type="text" class="form-control" name="timeStart"
                                                value="" placeholder="เช่น 09:00">
                                        </div>
                                        <div class="col-auto">
                                            <label for="inTend" class="col-form-label">เวลาจบงาน*</label>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" name="timeEnd" value=""
                                                placeholder="เช่น 16:00">
                                        </div>
                                    </div>
                                    <div class="row align-items-center mt-4">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="description"
                                                id="description" style="height: 150px" maxlength="500"></textarea>
                                            <label for="floatingTextarea" class="ms-3">คำอธิบายกิจกรรม*</label>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mt-4">
                                        <div class="col-auto ">
                                            <label for="checkCer" class="col-form-label">Certificate*</label>
                                        </div>
                                        <div class="col-auto hstack">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="certificate"
                                                    id="flexRadioDefault1" value="n" checked>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    ไม่มีเกียรติบัตร
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="certificate"
                                                    id="flexRadioDefault2" value="y">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    มีเกียรติบัตร
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <button class="btn btn-primary float-end" type="submit"
                                                id="submit">บันทึก</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Modal Edit Building in Map-->
        <div class="modal fade" id="editBuildingModal" tabindex="-1" aria-labelledby="editBuildingModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <form method="post" action="{{ route('backend.add.updatebuilding') }}">
                        <!-- เพิ่ม route สำหรับการอัปเดตข้อมูล -->
                        @csrf
                        <div class="modal-body">
                            <div class="contaner-fluid">
                                <div class="row m-3">
                                    <div class="col-12">
                                        <button type="button" class="btn-close float-end" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <h5><strong>แก้ไขข้อมูลสถานที่</strong> <br></h5>
                                        <p class="subtitle">
                                            แก้ไขข้อมูลรูปภาพสถานที่และชื่อเรียกที่ต้องการแสดงบนหน้าแผนที่ของ Line
                                            Official Account
                                        </p>
                                    </div>
                                    <div class="col-3">
                                        <p>URL รูปสถานที่ :</p>
                                    </div>
                                    <div class="col-9 mb-4">
                                        <input type="text" class="form-control" name="img" value="">
                                    </div>
                                    <div class="col-3">
                                        <p>ชื่อสถานที่ :</p>
                                    </div>
                                    <div class="col-9 mb-4">
                                        <input type="text" class="form-control" name="name" value="">
                                    </div>
                                    <input type="hidden" name="id" value="">
                                    <!-- เพิ่มฟิลด์ซ่อนสำหรับ ID -->
                                    <div class="col align-self-end">
                                        <button class="btn btn-primary float-end" type="submit"
                                            id="submit">บันทึก</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Modal delete Building in Map-->
        <div class="modal fade" id="DeleteBuildingModal" tabindex="-1" aria-labelledby="DeleteBuildingModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="{{ route('backend.map.delete') }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="DeleteBuildingModalLabel">ยืนยันการอาคารและสถานที่</h5>
                        </div>
                        <div class="modal-body">
                            คุณต้องการที่จะลบสถานที่นี้ใช่หรือไม่? <br>
                            การลบอาคารนี้หมายความว่ากิจกรรมที่อยูภายในอาคารนี้จะหายไป!
                        </div>
                        <input type="hidden" name="id" value="" id="deleteBuildingId">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            <button class="btn btn-danger" type="submit" id="deleteBuildingButton">ลบ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--dashboard Table Map-->
    <section>
        <div class="container">
            <h2 class="mt-5 mb-3">หน้าจัดการแผนที่</h2>
            <p>หน้าจัดการข้อมูลที่ใช้แสดงในหน้าแผนที่ของ Line Officeal Account</p>
            @if (session('warning'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <div>{{ session('warning') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card p-3">
                <div class="hstack mb-3">
                    <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal"
                        data-bs-target="#addBuildingModal">เพิ่มสถานที่</button>
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">ชื่อสถานที่</th>
                                    <th scope="col">แก้ไข</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- สร้างแต่ละแถวของข้อมูลที่คุณต้องการแสดง -->
                                @foreach ($listMap as $map)
                                    <tr data-img="{{ $map['img'] }}" data-name="{{ $map['name'] }}"
                                        data-id="{{ $map['id'] }}">
                                        <th scope="row">{{ $map['No'] }}</th>
                                        <td><img src="{{ $map['img'] }}" alt="Map Image" class="custom-image">
                                        </td>
                                        <td>
                                            <p>{{ $map['name'] }}</p>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor"
                                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path
                                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                        <path fill-rule="evenodd"
                                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                    </svg>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#"
                                                            data-bs-toggle="modal" data-bs-target="#editBuildingModal"
                                                            onclick="populateEditBuildingModal(this)">แก้ไขข้อมูลสถานที่</a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('backend.add.activity', ['id' => $map['id']]) }}">แก้ไขข้อมูลกิจกรรม</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#DeleteBuildingModal"
                                                            onclick="populateDeleteBuildingModal(this)">ลบสถานที่</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        // JavaScript function เพื่อดึงข้อมูลและใส่ใน Modal
        function populateEditBuildingModal(row) {
            const img = row.getAttribute('data-img');
            const name = row.getAttribute('data-name');
            const id = row.getAttribute('data-id'); // เพิ่มการรับ ID ของรายการที่ต้องการแก้ไข

            // ใส่ค่า URL, ชื่อสถานที่ และ ID ลงใน input ใน Modal
            document.querySelector('#editBuildingModal input[name="img"]').value = img;
            document.querySelector('#editBuildingModal input[name="name"]').value = name;
            document.querySelector('#editBuildingModal input[name="id"]').value = id; // กำหนดค่า ID ใน input
        }
        // ใช้ jQuery เพื่อรองรับการเปิด Modal
        $(document).ready(function() {
            $('.dropdown-item[data-bs-target="#editBuildingModal"]').click(function() {
                const row = $(this).closest('tr')[0];
                populateEditBuildingModal(row);
            });
        });

        function populateDeleteBuildingModal(link) {
            var buildingId = link.closest('tr').getAttribute('data-id');
            // ตรวจสอบค่าไม่ใช่ null หรือ undefined ก่อนกำหนดค่า
            if (buildingId !== null && buildingId !== undefined) {
                document.getElementById('deleteBuildingId').value = buildingId;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>
</html>

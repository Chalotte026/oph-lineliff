<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>หน้าเพิ่มกิจกรรมในแผนที่</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        {{-- แก้ไขเเละสร้างกิจกรรม --}}
        <section>
            <div class="modal fade" id="ActivityModal" tabindex="-1" aria-labelledby="ActivityModalLabel"
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
                                            <h5><strong>แก้ไขข้อมูลกิจกรรม</strong> <br></h5>
                                            <p class="subtitle">
                                                ส่วนจัดการแก้ไขข้อมูลกิจกรรมที่ต้องการในสถานที่นั้นๆ
                                            </p>
                                        </div>
                                        <div class="row align-items-center mb-4">
                                            <div class="col-auto">
                                                <p class="col-form-label">ชื่อกิจกรรม*</p>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" name="name"
                                                    id="nameDisplay" value="">
                                            </div>
                                        </div>
                                        <div class="row align-items-center mb-4">
                                            <div class="col-auto ">
                                                <p class="col-form-label">ชื่อสถานที่*</p>
                                            </div>
                                            <div class="col">
                                                <select class="form-select" aria-label="Default select example"
                                                    id="selectedMap" name="selectedMap" >
                                                    <option value="0" selected>
                                                        กรุณาเลือกสถานที่ที่ต้องการเพิ่มกิจกรรม
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
                                                <input type="text" class="form-control" name="location"
                                                    value="">
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
                                                <input type="text" class="form-control" name="timeEnd"
                                                    value="" placeholder="เช่น 16:00">
                                            </div>
                                        </div>
                                        <div class="row align-items-center mt-4">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Leave a comment here" id="description" name="description"
                                                    style="height: 150px" maxlength="500"></textarea>
                                                <label for="description" class="ms-3"
                                                    id="description">คำอธิบายกิจกรรม*</label>
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
                                            <input type="hidden" name="id" value="">
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
        </section>
        {{-- ลบกิจกรรม --}}
        <section>
            <div class="modal fade" id="DeleteActivityModal" tabindex="-1"
                aria-labelledby="DeleteActivityModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" action="{{ route('backend.activity.delete') }}">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="DeleteActivityModalLabel">ยืนยันการลบกิจกรรม</h5>
                            </div>
                            <div class="modal-body">
                                คุณต้องการที่จะลบกิจกรรมนี้ใช่หรือไม่?
                            </div>
                        
                            <input type="hidden" name="id" value="" id="deleteActivityId">
                        
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                <button class="btn btn-danger" type="submit" id="deleteActivityButton">ลบ</button>
                            </div>
                        </form>                        
                    </div>
                </div>
            </div>
        </section>
        <div class="mt-4 mb-3">
            <a class="btn btn-primary mb-4" href="{{ route('backend.map') }}">ย้อนกลับ</a>
            <h2>หน้าจัดการแก้ไขกิจกรรมในอาคาร</h2>
            <p>หน้าจัดแก้ไขกิจกรรมในอาคารของ Line Officeal Account</p>
        </div>
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
        <div class="card p-3 mb-5">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h6>ชื่ออาคาร: {{ $mapName }}</h6>
                    <h6>กิจกรรมทั้งหมด: {{ count($listActivity) }}</h6>
                </div>
                <div class="col">
                    <button class="btn btn-primary float-end" type="submit" id="addactivity" data-bs-toggle="modal"
                        data-bs-target="#ActivityModal">เพิ่มกิจกรรม</button>
                </div>
            </div>
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">ชื่อกิจกรรม</th>
                        <th scope="col">สถานที่</th>
                        <th scope="col">คณะ</th>
                        <th scope="col">วัน-เวลา</th>
                        <th scope="col">certificate</th>
                        <th scope="col">แก้ไข</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listActivity as $key => $activity)
                        <tr data-id="{{ $activity['id'] }}" data-name="{{ $activity['name'] }}"
                            data-location="{{ $activity['location'] }}" data-faculty="{{ $activity['faculty'] }}"
                            data-faculty-id="{{ $activity['faculty_id'] }}" data-date="{{ $activity['date'] }}"
                            data-department='{{ $activity['department'] }}'
                            data-department-id='{{ $activity['department_id'] }}'
                            data-timestart="{{ $activity['time_start'] }}"
                            data-timeend="{{ $activity['time_end'] }}"data-certificate="{{ $activity['certificate'] }}"
                            data-description="{{ $activity['description'] }}">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $activity['name'] }}</td>
                            <td>{{ $activity['location'] }}</td>
                            <td>{{ $activity['faculty'] }}</td>
                            <td>{{ $activity['date_time'] }}</td>
                            <td>{{ $activity['certificate_text'] }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false" id="editActivity">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                    </button>

                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item edit-activity-link" href="#"
                                                data-bs-toggle="modal" data-bs-target="#ActivityModal"
                                                id="editActivity"
                                                onclick="populateEditActivityModal(this)">แก้ไขข้อมูลกิจกรรม</a>
                                        </li>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#DeleteActivityModal"
                                                onclick="populateDeleteActivityModal(this)">ลบกิจกรรม</a>
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
    <script>
        function populateDeleteActivityModal(link) {
            var activityId = link.closest('tr').getAttribute('data-id');
            document.getElementById('deleteActivityId').value = activityId;
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // ดึงค่า ID จาก URL
            var url = window.location.href;
            var id = url.substring(url.lastIndexOf('/') + 1);
            // ตั้งค่าการเลือกใน dropdown โดยใช้ ID จาก URL
            document.getElementById('selectedMap').value = id;
            // Add click event listener for edit activity buttons
            const editActivityButtons = document.querySelectorAll('.edit-activity-button');
            editActivityButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    const row = event.target.closest('tr');
                    populateEditActivityModal(row.querySelector('.edit-activity-link'));
                });
            });
        });
    </script>
    <script>
        document.getElementById('selectedFaculty').addEventListener('change', function() {
            const selectedFacultyId = this.value;
            const departmentSelect = document.getElementById('selectedDepartment');
            // เคลียร์ค่าที่เลือกใน select สาขา
            departmentSelect.selectedIndex = 0;
            // ซ่อนหรือแสดง select สาขาตามคณะที่เลือก
            const departmentOptions = departmentSelect.getElementsByTagName('option');
            for (const option of departmentOptions) {
                if (option.getAttribute('data-faculty-id') === selectedFacultyId || selectedFacultyId === '0') {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            }
        });
    </script>
    <script>
        // Function to update the modal content
        function updateModalContent(title, subtitle) {
            document.querySelector('#ActivityModal h5 strong').textContent = title;
            document.querySelector('#ActivityModal .subtitle').textContent = subtitle;
        }

        function clearActivityModal() {
            document.querySelector('#ActivityModal input[name="id"]').value = '';
            document.querySelector('#ActivityModal input[name="name"]').value = '';
            document.querySelector('#ActivityModal input[name="location"]').value = '';
            document.querySelector('#selectedFaculty').value = '0';
            document.querySelector('#indate').value = '';
            document.querySelector('#selectedDepartment').value = '0';
            document.querySelector('#ActivityModal input[name="timeStart"]').value = '';
            document.querySelector('#ActivityModal input[name="timeEnd"]').value = '';
            document.querySelector('#ActivityModal #description').value = '';
            document.querySelector('input[name="certificate"][value="n"]').checked = true;
        }

        function populateEditActivityModal(button) {
            // Get the closest row to the button
            const row = button.closest('tr');
            // Extract data from the data attributes
            const id = row.getAttribute('data-id');
            const name = row.getAttribute('data-name');
            const location = row.getAttribute('data-location');
            const faculty_id = row.getAttribute('data-faculty-id');
            const date = row.getAttribute('data-date');
            const department_id = row.getAttribute('data-department-id');
            const timeStart = row.getAttribute('data-timestart');
            const timeEnd = row.getAttribute('data-timeend');
            const certificate = row.getAttribute('data-certificate');
            const description = row.getAttribute('data-description');
            // Set the values of the input fields in the ActivityModal
            document.querySelector('#ActivityModal input[name="id"]').value = id;
            document.querySelector('#ActivityModal input[name="name"]').value = name;
            document.querySelector('#ActivityModal input[name="location"]').value = location;
            document.querySelector('#selectedFaculty').value = faculty_id;
            document.querySelector('#indate').value = date;
            document.querySelector('#selectedDepartment').value = department_id;
            document.querySelector('#ActivityModal input[name="timeStart"]').value = timeStart;
            document.querySelector('#ActivityModal input[name="timeEnd"]').value = timeEnd;
            document.querySelector('#ActivityModal #description').value = description;
            document.querySelector(`input[name="certificate"][value="${certificate}"]`).checked = true;
        }
        // Add a click event listener to both buttons
        document.getElementById('addactivity').addEventListener('click', function() {
            clearActivityModal();
            var data = {
                title: 'สร้างกิจกรรม',
                subtitle: 'ส่วนจัดการสร้างกิจกรรมที่ต้องการเพิ่มเข้าไปในสถานที่นั้นๆ'
            };
            updateModalContent(data.title, data.subtitle, '');

        });
        document.getElementById('editActivity').addEventListener('click', function() {
            var data = {
                title: 'แก้ไขข้อมูลกิจกรรม',
                subtitle: 'ส่วนจัดการแก้ไขข้อมูลกิจกรรมที่ต้องการในสถานที่นั้นๆ',
            };
            updateModalContent(data.title, data.subtitle);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>

<?php

namespace App\Http\Controllers\lineliff;
use Illuminate\Support\Facades\Validator;
use App\Models\Map;
use App\Models\ActivityMap;
use App\Models\Activity;
use App\Models\ActivityTime;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Certificate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class MapController extends Controller
{
    function map() {
        $img = 'https://www.ryt9.com/img/files/20230807/iq2db2affc11b25f24d8ec6380c3958b31.jpg';
        $maps = Map::all();
        // ประกาศอาร์เรย์เพื่อเก็บชื่อที่ต้องการแสดง
        $listmap = [];
        $counter = 1; // สร้างตัวแปรนับ
        foreach ($maps as $map) {
            $name = $counter . ') ' . $map->name; // ใช้ตัวแปรนับในชื่อ
            $listmap[] = [
                'name' => $name,
                'id'=> $map->id,
                'img'=>$map->img,
            ];
            $counter++; // เพิ่มค่าตัวแปรนับ
        }
        return view('map')
            ->with(compact('img', 'listmap', 'maps'));
    }
    
    function building($id) {
        $maps = Map::select('img', 'name')->find($id);
        // ดึงข้อมูลกิจกรรมที่เกี่ยวข้องกับแผนที่นี้
        $activity_maps = ActivityMap::where('map_id', $id)->get();
        $listact = [];
        // สร้างรายการกิจกรรม
        foreach ($activity_maps as $activity_map) {
            $activity = Activity::find($activity_map->activity_id);
            $activity_time = ActivityTime::where('activity_id', $activity_map->activity_id)->first();
            // สร้างตัวแปรช่วยเพื่อเก็บข้อมูลก่อนนำมาใส่ใน listact
            $activityData = [
                'name' => $activity->name,
                'description' => $activity->description,
            ];
            // ตรวจสอบว่า $activity_time ไม่เป็น null และกำหนดค่าที่เก็บไว้ในตัวแปรช่วย
            if ($activity_time) {
                $activityData['date'] = $activity_time->date;
                // รวม time_start และ time_end ด้วยเครื่องหมาย "-"
                $activityData['time'] = $activity_time->time_start . " - " . $activity_time->time_end;
            } else {
                $activityData['date'] = " ";
                $activityData['time'] = " ";
            }
            // เพิ่มข้อมูลในตัวแปรช่วยเข้า listact
            $listact[] = $activityData;
        }
        return view('building')
            ->with(compact('maps', 'listact'));
    }
    
    // Backend Dashboard map 
    public function add_map(){
        $maps = Map::all();
        $faculties = Faculty::all();
        $departments = Department::all();
        $listMap = [];
        $listFaculty = [];
        $listDepartments = [];
        $count = 1; // เริ่มต้น Count ที่ 1
        foreach ($maps as $map) {
            $listMap[] = [
                'No' => $count, // Count จำนวนของ array ทั้งหมด
                'id' => $map->id, // ไอดีจาก DB Map
                'img' => $map->img, // ข้อมูลรูปภาพจาก DB Map
                'name' => $map->name, // ชื่อจาก DB Map
            ];
            $count++; // เพิ่ม Count ทีละ 1
        }
        foreach ($faculties as $faculty) {
            $listFaculty[] = [
                'id' => $faculty->id, // ไอดีจาก DB Map
                'name' => $faculty->name, // ชื่อจาก DB Map
            ];
        }
        foreach ($departments as $department) {
            $listDepartments[] = [
                'id' => $department->id, // ไอดีจาก DB Map
                'name' => $department->name,
                'faculty_id'=> $department->faculty_id // ชื่อจาก DB Map
            ];
        }
        return view('lineliff/backend/maps')
            ->with(compact('listMap','listFaculty','listDepartments'));
    }

    //หน้าสร้างกิจกรรมและตารางกิจกรรม
    public function activity($id){
        $map = Map::find($id);
        $mapName = $map->name;
        $maps = Map::all();
        $faculties = Faculty::all();
        $departments = Department::all();
        $listMap = [];
        $listFaculty = [];
        $listDepartments = [];
        foreach ($maps as $item) {
            $listMap[] = [
                'id' => $item->id, // ไอดีจาก DB Map
                'img' => $item->img, // ข้อมูลรูปภาพจาก DB Map
                'name' => $item->name, // ชื่อจาก DB Map
            ];
        }
        foreach ($faculties as $faculty) {
            $listFaculty[] = [
                'id' => $faculty->id, // ไอดีจาก DB Map
                'name' => $faculty->name, // ชื่อจาก DB Map
            ];
        }
        foreach ($departments as $department) {
            $listDepartments[] = [
                'id' => $department->id, // ไอดีจาก DB Map
                'name' => $department->name,
                'faculty_id'=> $department->faculty_id // ชื่อจาก DB Map
            ];
        }
        $listActivity =[];
        $activityMapEntries = ActivityMap::where('map_id', $map->id)->get();
        foreach ($activityMapEntries as $entry) {
            $activityId = $entry->activity_id;
            $location = $entry->location;
            $activity = Activity::find($activityId);
            if ($activity) {
                $faculty = Faculty::find($activity->faculty_id);
                $department = Department::find($activity->department_id);
                $activityTime = ActivityTime::where('activity_id', $activityId)->first();
                $certificate = $activity->certificate;
                // ตรวจสอบค่า certificate และกำหนดค่าที่เหมาะสม
                $certificateText = ($certificate === 'y') ? 'มีเกียรติบัตร' : 'ไม่มีเกียรติบัตร';
                $listActivity[] = [
                    'id' => $activity->id,
                    'name' => $activity->name,
                    'location' => $location,
                    'faculty' => $faculty->name,
                    'faculty_id' => $activity->faculty_id,
                    'department' => $department->name,
                    'department_id' => $activity->department_id,
                    'date' => $activityTime->date,
                    'time_start' => $activityTime->time_start,
                    'time_end' => $activityTime->time_end,
                    'date_time' => $activityTime->date . ' : ' . $activityTime->time_start . ' - ' . $activityTime->time_end,
                    'certificate' => $certificate,
                    'certificate_text' => $certificateText,
                    'description' => $activity->description,
                ];
            }
        }        
        //dd($listActivity);
        return view('lineliff/backend/editActivity')
            ->with(compact('id','listActivity','listMap','listFaculty','listDepartments', 'mapName'));
    }

    //การเพิ่มอาคารในแผนที่
    public function adding_building(Request $request){
        //guessExtension();
        //getMimeType()
        //store()
        //asStore()
        //storePublicly()
        //move()
        //getClientOriginalName()
        //getClientMimeType()
        //guessClietExtension()
        //getSize()
        //getError()
        //isValid()
        //$request->validate([
        //    'name'=>'required',
        //    'file'=>'required|mimes:jpg,png,jpeg|max:5048'
        //]);
        //$newImageName = time() . '-' . $request->name . '.' . $request->file->extension();
        //$test = $request->file->move(public_path('images'),$newImageName);
        $input = $request->all();
        //dd($input);
        if (in_array(null, $input)) {
            return redirect()->back()->with('warning', "คุณไม่ได้กรอกข้อมูล Url image หรือ ชื่ออาคาร, กรุณากรอกข้อมูลทั้งหมดก่อน 'บันทึก'");
        }
        Map::create([
            'name' => $request->input('name'),
            'img' => $request->input('img'),
        ]);
        return redirect()->back()->with('success', 'บันทึกข้อมูลอาคารสำเร็จ'); 
    }

    //การสร้างและแก้ไขกิจกรรมในแผนที่
    public function adding_Activity(Request $request){
        $input = $request->all();
        
        // Check if 'id' is provided in the input, which indicates an update.
        if (isset($input['id'])) {
            $activity = Activity::find($input['id']);
            if (!$activity) {
                return redirect()->back()->with('warning', 'ไม่พบข้อมูลกิจกรรมที่จะแก้ไข');
            }
            // Update the existing activity.
            $activity->update([
                'description' => $input['description'],
                'name' => $input['name'],
                'certificate' => $input['certificate'],
                'faculty_id' => $input['selectedFaculty'],
                'department_id' => $input['selectedDepartment'],
            ]);
            $activityMap = ActivityMap::where('activity_id', $activity->id)->first();
            if ($activityMap) {
                $activityMap->update([
                    'map_id' => $input['selectedMap'],
                    'location' => $input['location'],
                ]);
            }
            $activityTime = ActivityTime::where('activity_id', $activity->id)->first();
            if ($activityTime) {
                $activityTime->update([
                    'date' => $input['date'],
                    'time_start' => $input['timeStart'],
                    'time_end' => $input['timeEnd'],
                ]);
            }
            $certificate = Certificate::where('activity_id', $activity->id)->first();
            if (isset($certificate) && $input['certificate'] === 'y') {
                // สร้างข้อมูลในตาราง 'certificates'
                $certificate->update([
                    'name' => $input['name'],
                    'description' => $input['description'],
                ]);
            }elseif ($input['certificate'] === 'n') {
                Certificate::where('activity_id', $activity->id)->delete();
            }
            return redirect()->back()->with('success', 'แก้ไขข้อมูลกิจกรรมสำเร็จ');
        } 
        // สร้างกิจกรรมใหม่
        if ($input['name'] === null || $input['certificate'] === null || $input['selectedFaculty'] === null || $input['selectedDepartment'] === null || empty($input['name'])) {
            return redirect()->back()->with('warning', 'กรุณากรอกข้อมูลให้ครบถ้วน');
        }
        $activity = Activity::create([
            'description' => $input['description'],
            'name' => $input['name'],
            'certificate' => $input['certificate'],
            'faculty_id' => $input['selectedFaculty'],
            'department_id' => $input['selectedDepartment'],
        ]);
        if ($activity) {
            // สร้าง ActivityMap
            ActivityMap::create([
                'map_id' => $input['selectedMap'],
                'activity_id' => $activity->id,
                'location' => $input['location'],
            ]);
            // สร้าง ActivityTime
            ActivityTime::create([
                'activity_id' => $activity->id,
                'date' => $input['date'],
                'time_start' => $input['timeStart'],
                'time_end' => $input['timeEnd'],
            ]);
        }
        if (isset($input['certificate']) && $input['certificate'] === 'y') {
            // สร้างข้อมูลในตาราง 'certificates'
            Certificate::create([
                'activity_id' => $activity->id,
                'name' => $input['name'],
                'description' => $input['description'],
                'date' => now(),
            ]);
        }
        return redirect()->back()->with('success', 'บันทึกข้อมูลกิจกรรมสำเร็จ');
    }

    //การแก้ไขอาคารในแผนที่
    public function updateBuilding(Request $request) {
        $id = $request->input('id');
        $img = $request->input('img');
        $name = $request->input('name');
        // ตรวจสอบว่า ID ที่ต้องการแก้ไขมีอยู่ในฐานข้อมูลหรือไม่
        $existingMap = Map::find($id);
        if ($existingMap) {
            // ถ้ามี ก็ทำการอัปเดตข้อมูล
            $existingMap->img = $img;
            $existingMap->name = $name;
            $existingMap->save();
            return redirect()->back()->with('success', 'อัปเดตข้อมูลสถานที่สำเร็จ');
        } else {
            return redirect()->back()->with('warning', 'ไม่พบสถานที่ที่ต้องการแก้ไข');
        }
    }    

    //ลบ
    public function building_delete(Request $request) {
        //dd($request->all());
        // ค้นหาข้อมูลของอาคารหรือสถานที่
        $map = Map::find($request->id);
        if ($map) {
            // ค้นหาข้อมูลของ ActivityMap ที่เกี่ยวข้อง
            $activityMap = ActivityMap::where('map_id', $map->id)->first();
            if ($activityMap) {
                // เก็บค่า activity_id ไว้ในตัวแปร
                $activityId = $activityMap->activity_id;
                // ค้นหาข้อมูลของ ActivityTime ที่เกี่ยวข้อง
                $activityTime = ActivityTime::where('activity_id', $activityId)->first();
                if ($activityTime) {
                    // ลบข้อมูลจาก ActivityTime
                    $activityTime->delete();
                }
                // ลบข้อมูลจาก ActivityMap
                $activityMap->delete();
                // ค้นหาข้อมูลของ Activity โดยใช้ค่า 'activity_id'
                $activity = Activity::find($activityId);
                if ($activity) {
                    // ลบข้อมูลจาก Activity
                    $activity->delete();
                }
                $certificate = Certificate::find($activityId);
                if ($certificate) {
                    // ลบข้อมูลจาก Activity
                    $certificate->delete();
                }
            }
            // ลบข้อมูลจาก Map
            $map->delete();
            return redirect()->back()->with('success', 'ลบข้อมูลอาคารสำเร็จ');
        }
        return redirect()->back()->with('warning', 'ไม่พบข้อมูลอาคารที่ต้องการลบ');
    }
    
    public function activity_delete(Request $request) {
        $activity = Activity::find($request->id);
        if ($activity) {
            $activityMap = ActivityMap::where('activity_id', $activity->id)->first();
            $activityTime = ActivityTime::where('activity_id', $activity->id)->first();
            if ($activityMap) {
                $activityMap->delete();
            }
            if ($activityTime) {
                $activityTime->delete();
            }
            $activity->delete();
            return redirect()->back()->with('success', 'ลบข้อมูลกิจกรรมสำเร็จ');
        }
        return redirect()->back()->with('warning', 'ไม่พบกิจกรรมที่ต้องการลบ');
    }
}

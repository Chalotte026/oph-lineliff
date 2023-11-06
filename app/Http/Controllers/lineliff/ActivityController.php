<?php

namespace App\Http\Controllers\lineliff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\ActivityMap;
use App\Models\ActivityTime;
use App\Models\Map;
use App\Models\Faculty;
use App\Models\Department;
use App\Models\User;
use App\Models\UserCertificate;
use App\Models\UserActivity;
use App\Models\Certificate;

class ActivityController extends Controller
{
    public function activity() {
        $facultyNames = Faculty::all();
        $listact = [];
        foreach ($facultyNames as $faculty) {
            $activities = Activity::where('faculty_id', $faculty->id)->get();
            foreach ($activities as $activity) {
                $department = Department::find($activity->department_id);
                $activityMap = ActivityMap::where('activity_id', $activity->id)->first();
                $activityTime = ActivityTime::where('activity_id', $activity->id)->first();
                if (!$activityMap || !$activityTime) {
                    // ทำการข้ามรายการที่ไม่มีข้อมูล ActivityMap หรือ ActivityTime
                    continue;
                }
                $building = Map::where('id', $activityMap->map_id)->first(); // ดึงข้อมูล building จากตาราง Map
                $listact[] = [
                    'name' => $activity->name,
                    'department' => $department ? $department->name : " ",
                    'building' => $building ? $building->name : " ",
                    'location' => $activityMap ? $activityMap->location: " ",
                    'date' => $activityTime ? $activityTime->date : " ", // ตรวจสอบและใช้ " " ถ้า $activityTime เป็น null
                    'time' => $activityTime ? $activityTime->time_start . ' - ' . $activityTime->time_end : " ", // ตรวจสอบและใช้ " " ถ้า $activityTime เป็น null
                    'description' => $activity->description,
                    'faculty' => $activity->faculty_id,
                ];
            }
        }
        return view('activity')
            ->with(compact('listact','facultyNames'));
    }    

    protected function howpoint() {
        $img = '...';

        return view('how2collectP')
            ->with(compact('img'));
    }
    public function givepoint($id) {
        $activities = Activity::pluck('name', 'id');  // ดึงข้อมูลกิจกรรมเป็น array ['id' => 'name']
        $user = User::find($id);
        return view('givepoint')
        ->with(compact('activities', 'user'));
    }
    
    // store คะเเนน เข้า DB user_activity , user_certificate และ update คะเเนนใน DB users
    public function store(Request $request){
        $user_id = $request->get('user_id');
        $selectedActivity = $request->get('selectedActivity');
        $buttonPoint = $request->get('buttonpoint');
        // เช็คว่าเลือกกิจกรรมรึยัง
        if ($selectedActivity != 0){
            // เช็คว่าเลือกคะเเนนรึยัง
            if ($buttonPoint != null){
                // เช็คว่าคะเเนนที่ได้ถึง 70 ไหม
                if ($buttonPoint >= 70) {
                    // เช็คว่ากิจกรรมที่เลือกมี Certificate ไหม
                    $certificate = Certificate::where('activity_id', $selectedActivity)->first();
                    if ($certificate) {
                        $hascertificate = UserCertificate::where('user_id', $user_id)->where('certificate_id', $certificate->id)->first();
                        $certificate_id = $certificate->id;
                        // เช็คว่า User ทำ certificate รึยังถ้าทำแล้ว จะทำการัพเดทคะเเนนอย่างเดียว
                        if($hascertificate){ //update -> user_certificate 
                            $user_certificate = UserCertificate::find($user_id);
                            $user_certificate->update([
                                'point' => $buttonPoint,
                            ]);
                            $user = User::find($user_id); // ค้นหาผู้ใช้โดยใช้ user_id ที่รับมา
                            $currentPoints = $user->point; // ดึงคะแนนปัจจุบันของผู้ใช้
                            $oldPoints = $hascertificate->point; // คะเเนนเกียรติบัตรก่อนหน้า
                            $sumPoints = $currentPoints - $oldPoints; //คะเเนนจาก User คะเเนนรวม มาลบกับ คะเเนนกิจกรรมเก่านี้
                            $newPoints = $sumPoints + $buttonPoint; // แก้ไขคะเนน User + $buttonPoint
                            $user->point = $newPoints;
                            $user->save();
                        }
                        else{ //save -> user_certificate, user_activity, user
                            UserCertificate::create([
                                'user_id' => $user_id,
                                'certificate_id' => $certificate_id,
                                'point' => $buttonPoint,
                            ]);
                            $user = User::find($user_id); // ค้นหาผู้ใช้โดยใช้ user_id ที่รับมา
                            $currentPoints = $user->point; // ดึงคะแนนปัจจุบันของผู้ใช้
                            $newPoints = $currentPoints + $buttonPoint; // เพิ่มคะแนนจาก $buttonPoint
                            $user->point = $newPoints;
                            $user->save();
                        }
                        // User สามารถทำกิจกรรมเดิมได้หลายครั้ง 
                        UserActivity::create([
                            'user_id' => $user_id,
                            'activity_id' => $selectedActivity,
                        ]);
                        return redirect()->route('success');
                    }
                    else{
                        UserActivity::create([
                            'user_id' => $user_id,
                            'activity_id' => $selectedActivity,
                        ]);
                        $user = User::find($user_id); // ค้นหาผู้ใช้โดยใช้ user_id ที่รับมา
                        $currentPoints = $user->point; // ดึงคะแนนปัจจุบันของผู้ใช้
                        $newPoints = $currentPoints + $buttonPoint; // เพิ่มคะแนนจาก $buttonPoint
                        $user->point = $newPoints;
                        $user->save();
                        return redirect()->route('success');
                    }
                // คะเเนนน้อยกว่า 70 ไม่มี Certificate ให้ บันทึกแค่ user_activity กับ update คะนน user อย่างเดียว
                } else {
                    
                    UserActivity::create([
                        'user_id' => $user_id,
                        'activity_id' => $selectedActivity,
                    ]);
                    $user = User::find($user_id); // ค้นหาผู้ใช้โดยใช้ user_id ที่รับมา
                    $currentPoints = $user->point; // ดึงคะแนนปัจจุบันของผู้ใช้
                    $newPoints = $currentPoints + $buttonPoint; // เพิ่มคะแนนจาก $buttonPoint
                    $user->point = $newPoints;
                    $user->save();
                    return redirect()->route('success');
                }
            }
            else {
                return redirect()->back()->with('warning', 'กรุณากรอกคะเเนนก่อนบันทึก');
            }
        }
        else{
            return redirect()->back()->with('warning', 'กรุณาเลือกกิจกรรมก่อนบันทึก');
        }
    }    

    public function editPage(Request $request){ // ลบ
        $selectedActivity = $request->get('userNameInput');
        dd($selectedActivity);
    }
    public function update(Request $request){ // ลบ
        $selectedActivity = $request->get('userNameInput');
        dd($selectedActivity);
    }

    public function tradepoint() {
        $img = '...';
        $description = 'ในการแลกรางวัลสามารถแลกรางวัลได้ที่ อาคาร xxxxxxxx ก่อนเวลา 16.30 น ไม่งั้นเเต้มที่ได้ในวันนั้นจะหายไป';
        $link = '#';
        return view('trade-point')
            ->with(compact('img','description','link'));
    }
}


<?php

namespace App\Http\Controllers\lineliff;

use App\Models\User;
use App\Models\Activity;
use App\Models\ActivityMap;
use App\Models\Map;
use App\Models\ActivityTime;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\UserCertificate;
use App\Models\Certificate;

class userController extends Controller
{
// User function
    protected function user($uuid) {
        //dd($uuid);
        $user = User::select('full_name', 'phone','id','uuid', 'point')->find($uuid);
        if ($user) {
            return view('profile')
            ->with(compact('user'));
        }
    }

    protected function mission($full_name) {
        $user = User::select('point')->where('full_name', $full_name)->first();
        if ($user) {
            return view('mission')->with(compact('user'));
        }
    }

// certificate collect function
    protected function certificate_col($full_name) {
        $user = User::select('full_name', 'id','uuid')->where('full_name', $full_name)->first();
        $userId = $user->id;
        $certificates = UserCertificate::where('user_id', $userId)->get();
    
        $listcer = [];
    
        foreach ($certificates as $certificate) {
            $certificateId = $certificate->certificate_id;
            // ค้นหาชื่อของ Certificate จากตาราง Certificate โดยใช้ certificate_id
            $name = Certificate::where('id', $certificateId)->value('name');
            // เพิ่มข้อมูลลงในอาร์เรย์
            $listcer[] = [
                'id' => $certificate->id,
                'certificate_id' => $certificateId,
                'name' => $name,
                'point' => $certificate->point
            ];
        }
        // {{ route('download_certificate', ['id' => $certificate['id']]) }}
        return view('certificate-collect')->with(compact('certificates','user','listcer'));
    }


// certificate none collect function
    protected function certificate_none_col($full_name) {
        // ดึงข้อมูลผู้ใช้จากชื่อ
        $user = User::select('full_name', 'id','uuid')->where('full_name', $full_name)->first();
        $userId = $user->id;
        // ดึงรายการกิจกรรมที่ผู้ใช้มี Certificate
        $activitiesWithCertificate = UserCertificate::where('user_id', $userId)->pluck('certificate_id')->all();
        // ดึงรายการกิจกรรมทั้งหมดที่ผู้ใช้ยังไม่มีใบ Certificate มาแสดง
        $activitiesWithoutCertificate = Certificate::whereNotIn('id', $activitiesWithCertificate)->get();
        $listcer = [];
        foreach ($activitiesWithoutCertificate as $activity) {
            $acttime = ActivityTime::where('activity_id', $activity->activity_id )->first();
            $actmap = ActivityMap::where('activity_id', $activity->activity_id )->first();
            $map = Map::where('id', $actmap->map_id )->first();
            $listcer[] = [
                'name' => $activity->name,
                'date-time'=> $acttime->date . ' : ' . $acttime->time_start . ' - ' . $acttime->time_end,
                'building' => $map->name,
                'location' => $actmap->location,
            ];
        }
        //dd($listcer);
        return view('certificate-none-collect')->with(compact('listcer', 'user'));
    }


    protected function qrcode($id) {
        $user = User::find($id);
        if (!$user) {
            return abort(404); 
        }
        return view('qrcode')->with(compact('user'));
    }
    
    protected function scan(){
        $facul = 'คณะ';
        $act = 'กิจกรรม';
        return view('qrcode_scan')
            ->with(compact('facul','act'));
    }
//before admin scan qrcode 
    protected function scanqrcode() {
        $array1 = ['คณะ1','คณะ2','คณะ3','คณะ4','คณะ5'];
        $array2 = ['กิจกรรม1','กิจกรรม2','กิจกรรม3','กิจกรรม4','กิจกรรม5'];
        return view('index')
        ->with(compact('array1','array2'));
    }

    function success(){
        $img = '...';
        return view('success')
            ->with(compact('img'));
    }
}

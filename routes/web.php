<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\lineliff\userController;
use App\Http\Controllers\lineliff\MapController;
use App\Http\Controllers\lineliff\QandAController;
use App\Http\Controllers\lineliff\ActivityController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/profile/{uuid}', [userController::class, 'user']);
Route::get('/profile/{id}/qrcode', [userController::class, 'qrcode'])->name('qrcode');
Route::get('/profile/{full_name}/certificate-collect', [userController::class, 'certificate_col'])->name('certicol');
Route::get('/profile/{full_name}/certificate-none-collect', [userController::class,'certificate_none_col'])->name('certinonecol');
Route::get('/', [userController::class,'scanqrcode'])->name('scanqrcode');
Route::get('/scan/qrcode', [userController::class,'scan'])->name('scan');
Route::get('/mission/{full_name}', [userController::class, 'mission']);
Route::get('/success', [userController::class,'success'])->name('success');

Route::get('/Q&A', [QandAController::class, 'qa']);

Route::get('/activity', [ActivityController::class,'activity']);
Route::get('/howtocollectpoint', [ActivityController::class, 'howpoint'])->name('how2point');
Route::get('/trade-point', [ActivityController::class,'tradepoint'])->name('tradepoint');

Route::group([
    'prefix' => 'give_point',
    'as' => 'give_point.',
], function () {
    Route::get('{id}', [ActivityController::class,'givepoint'])->name('givepoint');
    Route::post('add', [ActivityController::class,'store'])->name('add.givepoint');
});

Route::get('/give_point/{id}', [ActivityController::class,'givepoint'])->name('givepoint');
Route::post('/give_point/add', [ActivityController::class,'store'])->name('add.givepoint');

Route::get('/map', [MapController::class,'map']);
Route::get('/map/building/{id}', [MapController::class,'building'])->name('building');


Route::group([
    'prefix' => 'backend',
    'as' => 'backend.',
], function () {
    //Backend หลังบ้านแผนที่
    Route::get('map', [MapController::class,'add_map'])->name('map');
    //หน้ากิจกรรมในอาคาร
    Route::get('adding_building/updateactivity/{id}', [MapController::class,'activity'])->name('add.activity');
    //สร้างอาคาร
    Route::post('adding_building/add', [MapController::class, 'adding_building'])->name('add.addbuilding');
    //แก้ไขอาคาร
    Route::post('adding_building/updatebuilding', [MapController::class, 'updateBuilding'])->name('add.updatebuilding');
    //สร้างและแก้ไขกิจกรรม
    Route::post('adding_building/activity/add', [MapController::class, 'adding_Activity'])->name('add.addactivity');
    //ลบอาคาร
    Route::post('delete/building', [MapController::class, 'building_delete'])->name('map.delete'); 
    //ลบกิจกรรม
    Route::post('delete/activity', [MapController::class, 'activity_delete'])->name('activity.delete'); 
});

Route::get('/css/lineliff', function () {
    return asset('lineliff/css/map.css');
});
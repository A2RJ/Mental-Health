<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/import-master', [App\Http\Controllers\Admin\ImportController::class, 'importMaster'])->name('import-master');
// Route::get('exel', function () {
//     $prov = (new FastExcel)->import('prov.xlsx');
//     $rs = (new FastExcel)->import('rs.xlsx');

//     $rs = $rs->map(function ($rs) use ($prov) {
//         $prov_id = $prov->filter(function ($item, $key) use ($rs) {
//             return Str::lower($item['prov_name']) == Str::lower($rs['province_id']);
//         })->first();
//         return [
//             'rumah_sakit_id' => $rs['rumah_sakit_id'],
//             'description_id' => $rs['description_id'],
//             'rumah_sakit_en' => $rs['rumah_sakit_id'],
//             'description_en' => $rs['description_en'],
//             'rumah_sakit_cn' => $rs['rumah_sakit_id'],
//             'description_cn' => $rs['description_cn'],
//             'website' => '-',
//             'province_id' => $prov_id ? $prov_id['prov_id'] : false,
//             // 'province_name' => $rs['province_id']
//         ];
//     });
//     $rs = $rs->filter(function ($rs) {
//         return $rs['province_id'] != false;
//     });
//     return (new FastExcel($rs))->download('rs-file.xlsx');
// });

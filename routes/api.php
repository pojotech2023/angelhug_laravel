<?php

use App\Models\ApplicationForm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

Route::post('/form_insert', function (Request $request) {
  $validate = Validator::make($request->all(), [
    "name" => "required|string",
    "email" => "required|email",
    "room_no" => "required|string",
    "mobile" => "required|regex:/^[6-9]\d{9}$/",
    "parent_mobile" => "required|regex:/^[6-9]\d{9}$/",
    "joining_date" => "required|date",
    "advance" => "required|string",
    "rent" => "required|string",
    "address" => "required|string",
    "aadhar_front" => "required|file|mimes:jpg,pdf,png,jpeg,webp",
    "aadhar_back" => "required|file|mimes:jpg,pdf,png,jpeg,webp",
    "employee_img" => "required|file|mimes:jpg,pdf,png,jpeg,webp",
    "company_id" => "required|file|mimes:jpg,pdf,png,jpeg,webp",
    "signature" => "required|file|mimes:jpg,pdf,png,jpeg,webp",
  ]);
  $joiningDate = Carbon::createFromFormat('d-m-Y', $request->joining_date)->format('Y-m-d');


  if ($validate->fails()) {
    return response()->json([
      'Status' => "Error",
      "Errors" => $validate->errors()
    ], 422);
  }
  if ($request->hasFile('aadhar_front')) {
    $aadhar_front = $request->file('aadhar_front')->store('aadhar_front', 'public');
  }
  if ($request->hasFile('aadhar_back')) {
    $aadhar_back = $request->file('aadhar_back')->store('aadhar_back', 'public');
  }
  if ($request->hasFile('employee_img')) {
    $employee_img = $request->file('employee_img')->store('employee_img', 'public');
  }
  if ($request->hasFile('company_id')) {
    $company_id = $request->file('company_id')->store('company_id', 'public');
  }
  if ($request->hasFile('signature')) {
    $signature = $request->file('signature')->store('signature', 'public');
  }

  $application = ApplicationForm::create([
    "name" => $request->name,
    "email" => $request->email,
    "room_no" => $request->room_no,
    "mobile" => $request->mobile,
    "parent_mobile" => $request->parent_mobile,
    "joining_date" => $joiningDate,
    "advance" => $request->advance,
    "rent" => $request->rent,
    "address" => $request->address,
    "aadhar_front_path" => $aadhar_front ?? null,
    "aadhar_back_path" => $aadhar_back ?? null,
    "employee_img_path" => $employee_img ?? null,
    "company_id_card_path" => $company_id ?? null,
    "signature_path" => $signature ?? null,
  ]);

  return response()->json([
    "status" => 'Success',
    "Message" => 'Application form submitted SuccessFully!'
  ], 200);
})->name('form_insert');

Route::delete('/form_delete/{id}', function(Request $request, $id){
  $applications = ApplicationForm::find($id);
  $applications->delete();
  return response()->json([
    "status" => 'Success',
    "Message" => 'Application form Deleted SuccessFully!'
  ], 200);
})->name('application_delete');


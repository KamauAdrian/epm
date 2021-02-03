<?php

use App\Http\Controllers\TestController;
use App\Models\Trainee;
use App\Models\TrainingSession;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes(['login'=>false,'register'=>false]);

Route::group(['middleware'=>'guest'],function (){
    Route::get('/',[App\Http\Controllers\AdminController::class, 'login']);
    Route::post('/auth-login',[App\Http\Controllers\AdminController::class, 'admin_login']);
});

Route::group(['middleware'=>'super_admin_register'],function (){
    Route::get('/su-admin/register',[App\Http\Controllers\SuperAdminController::class, 'su_admin_register']);
    Route::post('/su-admin-register',[App\Http\Controllers\SuperAdminController::class, 'su_admin_save']);
});
//super admin routes
Route::group(['middleware'=>'super_admin'],function (){
    //super admin user only
//    Route::get('/adm-dashboard',[App\Http\Controllers\SuperAdminController::class, 'index']);
    Route::get('/register/su-admin',[App\Http\Controllers\SuperAdminController::class, 'su_admin_register_su_admin']);
    Route::post('/adm-register-su-admin',[App\Http\Controllers\SuperAdminController::class, 'adm_save_su_admin']);
    Route::post('/adm/save/pm',[App\Http\Controllers\SuperAdminController::class, 'pm_save']);
    Route::get('/centers',[App\Http\Controllers\SuperAdminController::class, 'centers']);
    //shared responsibility
    //cms
    Route::get('/list-cms',[App\Http\Controllers\SuperAdminController::class, 'cms_list']);
    Route::get('/cms',[App\Http\Controllers\SuperAdminController::class, 'cms']);//json array of cms
    Route::get('/cms/new/{id}',[App\Http\Controllers\SuperAdminController::class, 'cms_new']);//json array of cms
    //trainers
    Route::get('/trainers/new/team/members/{id}',[App\Http\Controllers\SuperAdminController::class, 'trainers_team_new']);//json array of trainers
    //mentors
    //sessions and classes
    Route::get('/adm/{id}/confirm/session/session_id={session_id}',[App\Http\Controllers\SuperAdminController::class, 'confirm_session']);
    Route::get('/adm/{id}/list/classes',[App\Http\Controllers\SuperAdminController::class, 'view_classes']);
    Route::get('/adm/{id}/view/class/class_id={class_id}',[App\Http\Controllers\SuperAdminController::class, 'view_class']);
    Route::get('/adm/{id}/create/class',[App\Http\Controllers\SuperAdminController::class, 'create_class']);
    Route::post('/adm/{id}/save/class',[App\Http\Controllers\SuperAdminController::class, 'save_class']);
    Route::get('/session/classes',[App\Http\Controllers\AdminController::class, 'session_classes']);//json array of trainers
    //emobilis Hqs
    Route::get('/emobilis/hq/hqs',[App\Http\Controllers\SuperAdminController::class, 'emobilis_hqs']);
    //    reports
    Route::get('/reports/hqs',[App\Http\Controllers\SuperAdminController::class, 'reports_hqs']);
    Route::get('/reports/cms',[App\Http\Controllers\SuperAdminController::class, 'reports_cms']);
    Route::get('/reports/trainers',[App\Http\Controllers\SuperAdminController::class, 'reports_trainers']);
    Route::get('/reports/pms',[App\Http\Controllers\SuperAdminController::class, 'reports_pms']);
    //teams
    Route::get('/add-team-trainers',[App\Http\Controllers\SuperAdminController::class, 'team_trainers_add']);
    Route::post('/adm/{id}/save/team/trainers',[App\Http\Controllers\SuperAdminController::class, 'team_trainers_save']);
    Route::get('/adm/{id}/add/team/trainer/members/team_id={team_id}',[App\Http\Controllers\SuperAdminController::class, 'team_trainer_members_add']);
    Route::post('/adm/{id}/save/team/trainer/members/team_id={team_id}',[App\Http\Controllers\SuperAdminController::class, 'team_trainer_members_save']);
    Route::get('/cms/teams',[App\Http\Controllers\SuperAdminController::class, 'team_cms']);
    Route::get('/adm/{id}/add/team/cms',[App\Http\Controllers\SuperAdminController::class, 'team_cms_add']);
    Route::post('/adm/{id}/save/team/cms',[App\Http\Controllers\SuperAdminController::class, 'team_cms_save']);
    Route::get('/adm/{id}/add/team/cms/members/team_id={team_id}',[App\Http\Controllers\SuperAdminController::class, 'team_cms_members_add']);
    Route::post('/adm/{id}/save/team/cms/members/team_id={team_id}',[App\Http\Controllers\SuperAdminController::class, 'team_cms_members_save']);
    //ajira clubs
    Route::get('/ajira-clubs',[App\Http\Controllers\SuperAdminController::class, 'ajira_clubs']);

});
//guests confirm invitation
Route::get('/account/activate/{id}',[App\Http\Controllers\AdminController::class, 'activate_account'])->middleware('create.password');
Route::post('/update/account/{id}',[App\Http\Controllers\AdminController::class, 'update_account']);
// forgot password return form use phone to get email and then send reset password instructions
Route::get('/forgot/password',[App\Http\Controllers\AdminController::class, 'forgot_password'])->middleware('guest');
Route::post('/request/reset/password',[App\Http\Controllers\AdminController::class, 'request_reset_password']);
Route::get('/{token}/{id}',[App\Http\Controllers\AdminController::class, 'reset_password'])->middleware('guest');
Route::post('/update/password/{id}',[App\Http\Controllers\AdminController::class, 'update_password']);

//shared responsibility
Route::group(['middleware'=>'admin'],function (){
    // index dashboard
    Route::get('/adm/main/dashboard',[App\Http\Controllers\AdminController::class, 'index']);
    Route::get('/adm/get/admins/records',[App\Http\Controllers\AdminController::class, 'dashboard_actors']);
    Route::get('/adm/get/pms/records',[App\Http\Controllers\AdminController::class, 'dashboard_pms']);
    Route::get('/adm/get/cms/records',[App\Http\Controllers\AdminController::class, 'dashboard_cms']);
    Route::get('/adm/get/trainers/records',[App\Http\Controllers\AdminController::class, 'dashboard_trainers']);
    Route::get('/adm/get/mentors/records',[App\Http\Controllers\AdminController::class, 'dashboard_mentors']);
    Route::get('/adm/get/sessions/records',[App\Http\Controllers\AdminController::class, 'dashboard_sessions']);
    Route::get('/adm/get/trainees/records',[App\Http\Controllers\AdminController::class, 'dashboard_trainees']);
    //list admins
    Route::get('/adm/{id}/add/admin/role_name={role}',[App\Http\Controllers\AdminController::class, 'add_admin']);
    Route::get('/list/all/role_id={role_id}',[App\Http\Controllers\AdminController::class, 'list']);
    Route::get('/list/all/admins/role_id={role_id}',[App\Http\Controllers\AdminController::class, 'adms_list']);
    Route::get('/adm/{id}/list/all/trainees',[App\Http\Controllers\AdminController::class, 'trainees_list']);
    //logged in admin profile
    Route::get('/adm/{id}/profile/public/role_id={role_id}/view',[App\Http\Controllers\AdminController::class, 'view_logged_in_adm_profile']);
    //admin profile
    Route::get('/adm/view/adm/{id}/profile/role_id={role_id}',[App\Http\Controllers\AdminController::class, 'view_adm_profile']);
    Route::get('/adm/edit/adm/{id}/profile/role_id={role_id}',[App\Http\Controllers\AdminController::class, 'edit_adm_profile']);
    Route::post('/update/adm/{id}/profile/role_id={role_id}',[App\Http\Controllers\AdminController::class, 'adm_profile_update']);
    Route::post('/delete/admin/{id}/profile/role_id={role_id}',[App\Http\Controllers\AdminController::class, 'adm_delete']);
    //reports
    Route::get('/adm/{id}/view/reports/template',[App\Http\Controllers\AdminController::class, 'reports_templates']);
    Route::get('/adm/{id}/create/new/report/template',[App\Http\Controllers\AdminController::class, 'report_template_create']);
    Route::get('/actors',[App\Http\Controllers\AdminController::class, 'report_actors']);//json array of trainers
    Route::post('/adm/{id}/generate/report/template',[App\Http\Controllers\AdminController::class, 'report_template_generate']);
    Route::get('/adm/{id}/view/report/template/{template_id}',[App\Http\Controllers\AdminController::class, 'report_template_view']);
    Route::get('/adm/{id}/edit/report/template/{template_id}',[App\Http\Controllers\AdminController::class, 'report_template_edit']);
    Route::post('/adm/{id}/update/report/template/{template_id}',[App\Http\Controllers\AdminController::class, 'report_template_update']);
    Route::get('/adm/{id}/view/reports/template_id={report_id}',[App\Http\Controllers\AdminController::class, 'reports']);
    Route::get('/adm/{id}/view/reports/template_id={template_id}/report_id={report_id}',[App\Http\Controllers\AdminController::class, 'view_report']);
    Route::get('/adm/{id}/submit/report/{report_id}',[App\Http\Controllers\AdminController::class, 'submit_report']);
    Route::post('/adm/{id}/save/report/{report_id}',[App\Http\Controllers\AdminController::class, 'save_report']);
    Route::get('/adm/{id}/view/reports/target_group_id={target_group_id}',[App\Http\Controllers\AdminController::class, 'reports_by_role']);
    Route::get('/adm/{id}/view/reports/template_id={template_id}/report_target_group_id={report_id}',[App\Http\Controllers\AdminController::class, 'reports_by_role_list']);
    //trainers reports
    Route::get('/adm/{id}/view/trainer/reports',[App\Http\Controllers\AdminController::class, 'reports_by_trainers']);
    Route::get('/adm/{id}/view/training/sessions/allocations',[App\Http\Controllers\AdminController::class, 'session_allocations']);
    Route::get('/adm/{id}/view/trainer/daily/attendance/reports',[App\Http\Controllers\AdminController::class, 'reports_by_trainers_attendance']);
    Route::get('/adm/{id}/view/trainer/daily/virtual/training/reports',[App\Http\Controllers\AdminController::class, 'reports_by_trainers_virtual']);
    Route::get('/adm/{id}/view/trainer/daily/physical/training/reports',[App\Http\Controllers\AdminController::class, 'reports_by_trainers_physical']);
    Route::get('/adm/{id}/view/trainer/assignment/submission/reports',[App\Http\Controllers\AdminController::class, 'reports_by_trainers_assignment']);
    Route::get('/adm/{id}/view/daily/attendance/reports',[App\Http\Controllers\TrainerController::class, 'daily_attendance_reports']);
    Route::get('/adm/{id}/view/daily/attendance/report/report_id={report_id}',[App\Http\Controllers\TrainerController::class, 'daily_attendance_report']);
    Route::get('/adm/{id}/submit/daily/attendance/report',[App\Http\Controllers\TrainerController::class, 'daily_attendance_report_submit']);
    Route::post('/adm/{id}/save/daily/attendance/report',[App\Http\Controllers\TrainerController::class, 'daily_attendance_report_save']);
    Route::get('/adm/{id}/view/daily/virtual/training/reports',[App\Http\Controllers\TrainerController::class, 'virtual_training_reports']);
    Route::get('/adm/{id}/view/daily/virtual/training/report/report_id={report_id}',[App\Http\Controllers\TrainerController::class, 'virtual_training_report']);
    Route::get('/adm/{id}/submit/daily/virtual/training/report',[App\Http\Controllers\TrainerController::class, 'virtual_training_report_submit']);
    Route::post('/adm/{id}/save/daily/virtual/training/report',[App\Http\Controllers\TrainerController::class, 'virtual_training_report_save']);
    Route::get('/adm/{id}/view/daily/physical/training/reports',[App\Http\Controllers\TrainerController::class, 'daily_physical_reports']);
    Route::get('/adm/{id}/view/daily/physical/training/report/report_id={report_id}',[App\Http\Controllers\TrainerController::class, 'daily_physical_report']);
    Route::get('/adm/{id}/submit/daily/physical/training/report',[App\Http\Controllers\TrainerController::class, 'daily_physical_report_submit']);
    Route::post('/adm/{id}/save/daily/physical/training/report',[App\Http\Controllers\TrainerController::class, 'daily_physical_report_save']);
    Route::get('/adm/{id}/view/assignment/submission/reports',[App\Http\Controllers\TrainerController::class, 'assignment_submission_reports']);
    Route::get('/adm/{id}/view/assignment/submission/report/report_id={report_id}',[App\Http\Controllers\TrainerController::class, 'assignment_submission_report']);
    Route::get('/adm/{id}/submit/assignment/report',[App\Http\Controllers\TrainerController::class, 'assignment_submission_report_submit']);
    Route::post('/adm/{id}/save/assignment/report',[App\Http\Controllers\TrainerController::class, 'assignment_submission_report_save']);

    //centers list
    Route::get('/adm/{id}/list/centers',[App\Http\Controllers\AdminController::class, 'centers_list']);
    Route::get('/adm/{id}/view/center/{center_id}',[App\Http\Controllers\AdminController::class, 'view_center']);
    Route::get('/adm/{id}/add/center',[App\Http\Controllers\AdminController::class, 'center_add']);
    Route::post('/adm/save/center',[App\Http\Controllers\AdminController::class, 'center_save']);
    Route::get('/adm/edit/center/{id}',[App\Http\Controllers\AdminController::class, 'edit_center']);
    Route::post('/adm/update/center/{id}',[App\Http\Controllers\AdminController::class, 'update_center']);
    Route::post('/adm/delete/center/{id}',[App\Http\Controllers\AdminController::class, 'delete_center']);
    //trainers
    Route::get('/trainers',[App\Http\Controllers\AdminController::class, 'trainers']);//json array of trainers
    Route::post('/save-trainer',[App\Http\Controllers\AdminController::class, 'trainer_save']);
    Route::get('/adm/{id}/asses/trainer/competence',[App\Http\Controllers\TrainerController::class, 'asses_trainer']);
    Route::post('/adm/{id}/save/trainer/competence/assessment',[App\Http\Controllers\TrainerController::class, 'save_trainer_assessment']);
    Route::get('/adm/{id}/view/competence/reports',[App\Http\Controllers\TrainerController::class, 'trainer_competence_reports']);
    Route::get('/adm/{id}/view/trainer/competence/reports',[App\Http\Controllers\TrainerController::class, 'adm_view_trainer_competence_reports']);
    Route::get('/adm/{id}/view/competence/report/report_id={report_id}',[App\Http\Controllers\TrainerController::class, 'trainer_competence_report']);
    //sessions
    Route::get('/adm/{id}/list/sessions',[App\Http\Controllers\AdminController::class, 'sessions_list']);
    Route::get('/adm/{id}/view/session/{session_id}',[App\Http\Controllers\AdminController::class, 'view_session']);
    Route::get('/adm/{id}/add/session',[App\Http\Controllers\AdminController::class, 'session_add']);
    Route::post('/adm/{id}/save/session',[App\Http\Controllers\AdminController::class, 'session_save']);
    Route::get('/new/session/trainers/{id}',[App\Http\Controllers\AdminController::class, 'new_session_trainers']);//json array of trainers not in the session
    Route::get('/adm/{id}/session/{session_id}/add/trainers',[App\Http\Controllers\AdminController::class, 'session_add_trainers']);
    Route::post('/adm/{id}/session/{session_id}/save/trainers',[App\Http\Controllers\AdminController::class, 'session_save_trainers']);
    Route::get('/adm/{id}/session/{session_id}/add/trainees',[App\Http\Controllers\AdminController::class, 'session_add_trainees']);
    Route::get('/adm/{id}/session/{session_id}/upload/trainees',[App\Http\Controllers\AdminController::class, 'session_upload_trainees']);
    Route::get('/download/trainees/excel/template',[App\Http\Controllers\AdminController::class, 'download_trainees_excel_template']);
    Route::post('/adm/{id}/session/{session_id}/save/trainees',[App\Http\Controllers\AdminController::class, 'session_save_trainees']);
    Route::post('/adm/{id}/session/{session_id}/save/uploaded/trainees',[App\Http\Controllers\AdminController::class, 'upload_trainees']);
    //teams
    Route::get('/adm/{id}/list/team/cms',[App\Http\Controllers\AdminController::class, 'team_cms_list']);
    Route::get('/adm/{id}/list/team/trainers',[App\Http\Controllers\AdminController::class, 'team_trainers_list']);
    //center managers
    Route::post('/save-cm',[App\Http\Controllers\AdminController::class, 'cm_save']);
    //mentors
    Route::post('/save-mentor',[App\Http\Controllers\AdminController::class, 'mentor_save']);

    //employee leave form
    Route::get('/adm/{id}/apply/employee/leave',[App\Http\Controllers\AdminController::class,'employee_leave_form']);
    Route::get('/adm/{id}/view/leave/applications',[App\Http\Controllers\AdminController::class,'employee_leave_applications']);
    Route::get('/adm/{id}/view/leave/applications',[App\Http\Controllers\AdminController::class,'trainer_leave_applications']);
    Route::get('/adm/{id}/view/trainer/leave/applications',[App\Http\Controllers\AdminController::class,'adm_view_trainer_leave_applications']);
    Route::get('/adm/{id}/view/leave/application/application_id={application_id}',[App\Http\Controllers\AdminController::class,'employee_leave_application']);
    Route::post('/adm/{id}/request/employee/leave',[App\Http\Controllers\AdminController::class,'employee_leave_request']);

});
//project managers routes
Route::group(['middleware'=>'project.managers'],function (){
    Route::get('/pm-dashboard',[App\Http\Controllers\ProjectManagerController::class, 'index']);
    Route::get('/pm-list-pms',[App\Http\Controllers\ProjectManagerController::class, 'pms']);
    Route::get('/pm-list-centers',[App\Http\Controllers\ProjectManagerController::class, 'centers']);
    Route::get('/pm-list-cms',[App\Http\Controllers\ProjectManagerController::class, 'cms_list']);
    Route::get('/pm-add-cm',[App\Http\Controllers\ProjectManagerController::class, 'cm_add']);
    Route::get('/pm-list-trainers',[App\Http\Controllers\ProjectManagerController::class, 'trainers_list']);
    Route::get('/pm-add-trainer',[App\Http\Controllers\ProjectManagerController::class, 'trainer_add']);
    Route::get('/pm-list-mentors',[App\Http\Controllers\ProjectManagerController::class, 'mentors_list']);
    Route::get('/pm-add-mentor',[App\Http\Controllers\ProjectManagerController::class, 'mentor_add']);
    Route::get('/pm-list-sessions',[App\Http\Controllers\ProjectManagerController::class, 'sessions_list']);
    Route::get('/pm-add-session',[App\Http\Controllers\ProjectManagerController::class, 'session_add']);
});

//Center managers routes
Route::group(['middleware'=>'center.managers'],function (){
    //center Manager reports
    Route::get('/adm/{id}/pre/registration/checklist',[App\Http\Controllers\CenterManagerController::class, 'check_list']);
    Route::get('/adm/{id}/submit/pre/registration/checklist',[App\Http\Controllers\CenterManagerController::class, 'check_list_submit']);
    Route::get('/adm/{id}/3/months/work/plan',[App\Http\Controllers\CenterManagerController::class, 'work_plan']);
    Route::get('/adm/{id}/monthly/reports',[App\Http\Controllers\CenterManagerController::class, 'monthly_reports']);

    Route::get('/cm/list/centers',[App\Http\Controllers\CenterManagerController::class, 'centers']);
    Route::get('/cm/list/trainers',[App\Http\Controllers\CenterManagerController::class, 'trainers_list']);
    Route::get('/cm/add/trainer',[App\Http\Controllers\CenterManagerController::class, 'trainer_add']);
    Route::get('/cm/list/sessions',[App\Http\Controllers\CenterManagerController::class, 'sessions_list']);
    Route::get('/cm/add/session',[App\Http\Controllers\CenterManagerController::class, 'session_add']);
});

//trainers routes
Route::group(['middleware'=>'trainers'],function (){
    Route::get('/trainer-dashboard',[App\Http\Controllers\TrainerController::class, 'index']);
    Route::get('/trainer-list-pms',[App\Http\Controllers\TrainerController::class, 'pms']);
    Route::get('/trainer-list-centers',[App\Http\Controllers\TrainerController::class, 'centers']);
    Route::get('/trainer-list-cms',[App\Http\Controllers\TrainerController::class, 'cms_list']);
    Route::get('/trainer-list-trainers',[App\Http\Controllers\TrainerController::class, 'trainers_list']);
    Route::get('/trainer-list-session',[App\Http\Controllers\TrainerController::class, 'sessions_list']);
    Route::get('/trainer-add-session',[App\Http\Controllers\TrainerController::class, 'session_add']);
});
Route::group(['middleware'=>'auth'],function (){
    Route::get('/admin-logout',[App\Http\Controllers\AdminController::class, 'admin_logout']);
    Route::get('/adm-profile/{id}',[App\Http\Controllers\AdminController::class, 'admin_profile']);
});

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/test', [TestController::class, 'index'])->name('test');

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
    Route::post('/su-admin-save',[App\Http\Controllers\SuperAdminController::class, 'su_admin_save']);
});
//super admin routes
Route::group(['middleware'=>'super_admin'],function (){
    //super admin user only
//    Route::get('/adm-dashboard',[App\Http\Controllers\SuperAdminController::class, 'index']);
    Route::get('/register/su-admin',[App\Http\Controllers\SuperAdminController::class, 'su_admin_register_su_admin']);
    Route::post('/save/su-admin',[App\Http\Controllers\SuperAdminController::class, 'adm_save_su_admin']);
});
    //shared responsibility
Route::get('/centers',[App\Http\Controllers\SuperAdminController::class, 'centers']);
    //cms
//    Route::get('/list-cms',[App\Http\Controllers\SuperAdminController::class, 'cms_list']);
    Route::get('/cms',[App\Http\Controllers\SuperAdminController::class, 'cms']);//json array of cms
    Route::get('/cms/new/{id}',[App\Http\Controllers\SuperAdminController::class, 'cms_new']);//json array of cms
    //trainers
    Route::get('/trainers/new/team/members/{id}',[App\Http\Controllers\SuperAdminController::class, 'trainers_team_new']);//json array of trainers
    //mentors
    //Classes
    Route::get('/adm/{id}/list/classes',[App\Http\Controllers\ClassController::class, 'index']);
    Route::get('/adm/{id}/create/class',[App\Http\Controllers\ClassController::class, 'create']);
    Route::post('/adm/{id}/save/class',[App\Http\Controllers\ClassController::class, 'store']);
    Route::get('/adm/{id}/view/class/class_id={class_id}',[App\Http\Controllers\ClassController::class, 'show']);
    Route::get('/adm/{id}/edit/class/class_id={class_id}',[App\Http\Controllers\ClassController::class, 'edit']);
    Route::post('/adm/{id}/update/class/class_id={class_id}',[App\Http\Controllers\ClassController::class, 'update']);
    Route::post('/adm/{id}/delete/class/class_id={class_id}',[App\Http\Controllers\ClassController::class, 'destroy']);
    Route::get('/session/classes',[App\Http\Controllers\ClassController::class, 'classes']);//json array of classes


    //emobilis Hqs
    Route::get('/emobilis/hq/hqs',[App\Http\Controllers\SuperAdminController::class, 'emobilis_hqs']);
    //    reports
    Route::get('/reports/hqs',[App\Http\Controllers\SuperAdminController::class, 'reports_hqs']);
    Route::get('/reports/cms',[App\Http\Controllers\SuperAdminController::class, 'reports_cms']);
    Route::get('/reports/trainers',[App\Http\Controllers\SuperAdminController::class, 'reports_trainers']);
    Route::get('/reports/pms',[App\Http\Controllers\SuperAdminController::class, 'reports_pms']);
    //teams
    //teams (Center Managers)
    Route::get('/adm/{id}/list/team/cms',[App\Http\Controllers\TeamCenterManager::class, 'index']);
    Route::get('/adm/{id}/list/team/trainers',[App\Http\Controllers\AdminController::class, 'team_trainers_list']);
    Route::get('/add-team-trainers',[App\Http\Controllers\SuperAdminController::class, 'team_trainers_add']);
    Route::post('/adm/{id}/save/team/trainers',[App\Http\Controllers\SuperAdminController::class, 'team_trainers_save']);
    Route::get('/adm/{id}/add/team/trainer/members/team_id={team_id}',[App\Http\Controllers\SuperAdminController::class, 'team_trainer_members_add']);
    Route::post('/adm/{id}/save/team/trainer/members/team_id={team_id}',[App\Http\Controllers\SuperAdminController::class, 'team_trainer_members_save']);
    Route::get('/cms/teams',[App\Http\Controllers\SuperAdminController::class, 'team_cms']);
    Route::get('/adm/{id}/add/team/cms',[App\Http\Controllers\TeamCenterManager::class, 'create']);
    Route::post('/adm/{id}/save/team/cms',[App\Http\Controllers\TeamCenterManager::class, 'store']);
    Route::get('/adm/{id}/add/team/cms/members/team_id={team_id}',[App\Http\Controllers\TeamCenterManager::class, 'add_members']);
    Route::post('/adm/{id}/save/team/cms/members/team_id={team_id}',[App\Http\Controllers\TeamCenterManager::class, 'store_members']);
    //ajira clubs
    Route::get('/ajira-clubs',[App\Http\Controllers\SuperAdminController::class, 'ajira_clubs']);

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
    Route::get('/adm/get/centers/records',[App\Http\Controllers\AdminController::class, 'dashboard_centers']);
    Route::get('/adm/get/cms/records',[App\Http\Controllers\AdminController::class, 'dashboard_cms']);
    Route::get('/adm/get/trainers/records',[App\Http\Controllers\AdminController::class, 'dashboard_trainers']);
    Route::get('/adm/get/mentors/records',[App\Http\Controllers\AdminController::class, 'dashboard_mentors']);
    Route::get('/adm/get/sessions/records',[App\Http\Controllers\AdminController::class, 'dashboard_sessions']);
    Route::get('/adm/get/trainees/records',[App\Http\Controllers\AdminController::class, 'dashboard_trainees']);
    //save admins
    Route::post('/adm/{id}/save/pm',[App\Http\Controllers\ProjectManagerController::class, 'store']);
    //list admins
    Route::get('/adm/{id}/add/admin/role_name={role}',[App\Http\Controllers\AdminController::class, 'add_admin']);
    Route::get('/list/all/role_id={role_id}',[App\Http\Controllers\AdminController::class, 'list']);
    Route::get('/list/all/admins/role_id={role_id}',[App\Http\Controllers\AdminController::class, 'adms_list']);
    Route::get('/adm/{id}/list/all/trainees',[App\Http\Controllers\TraineeController::class, 'index']);
    //logged in admin profile
    Route::get('/adm/{id}/profile/public/role_id={role_id}/view',[App\Http\Controllers\AdminController::class, 'view_logged_in_adm_profile']);
    //admin profile
    Route::get('/adm/view/adm/{id}/profile/role_id={role_id}',[App\Http\Controllers\AdminController::class, 'view_adm_profile']);
    Route::get('/adm/edit/adm/{id}/profile/role_id={role_id}',[App\Http\Controllers\AdminController::class, 'edit_adm_profile']);
    Route::post('/update/adm/{id}/profile/role_id={role_id}',[App\Http\Controllers\AdminController::class, 'adm_profile_update']);
    Route::post('adm/{id}/delete/admin/{admin_id}/profile/role_id={role_id}',[App\Http\Controllers\AdminController::class, 'destroy']);
    //reports
    Route::get('/adm/{id}/view/reports/templates',[App\Http\Controllers\AdminController::class, 'reports_templates']);
    Route::get('/adm/{id}/create/new/report/template',[App\Http\Controllers\AdminController::class, 'report_template_create']);
    Route::get('/adm/{id}/create/new/pmo/report/template',[App\Http\Controllers\AdminController::class, 'report_template_create_pmo']);
    Route::get('/adm/{id}/create/new/cm/report/template',[App\Http\Controllers\AdminController::class, 'report_template_create_cm']);
    Route::get('/adm/{id}/create/new/trainer/report/template',[App\Http\Controllers\AdminController::class, 'report_template_create_trainer']);
    Route::get('/actors',[App\Http\Controllers\AdminController::class, 'report_actors']);//json array of trainers
    Route::get('/pmos',[App\Http\Controllers\AdminController::class, 'report_actors_pmos']);//json array of trainers
    Route::post('/adm/{id}/generate/report/template',[App\Http\Controllers\AdminController::class, 'report_template_generate']);
    Route::post('/adm/{id}/generate/report/template',[App\Http\Controllers\AdminController::class, 'report_template_generate']);
    // Performance Appraisals
    Route::get('/adm/{id}/view/performance/appraisals',[App\Http\Controllers\AppraisalController::class, 'index']);
    Route::get('/adm/{id}/create/new/performance/appraisal',[App\Http\Controllers\AppraisalController::class, 'create']);
    Route::post('/adm/{id}/add/pmo/performance/appraisal',[App\Http\Controllers\AppraisalController::class, 'store']);
    Route::get('/adm/{id}/view/performance/appraisal/template/appraisal_id={appraisal_id}',[App\Http\Controllers\AppraisalController::class, 'show']);
    Route::get('/adm/{id}/view/performance/appraisal/appraisal_id={appraisal_id}',[App\Http\Controllers\AppraisalController::class, 'appraisal']);
    Route::get('/adm/{id}/submit/performance/appraisal/appraisal_id={appraisal_id}',[App\Http\Controllers\AppraisalController::class, 'submit']);
    Route::get('/adm/{id}/view/my/performance/appraisals',[App\Http\Controllers\AdminController::class, 'performance_appraisals_all']);
    Route::post('/adm/{id}/save/my/performance/appraisal/appraisal_id={appraisal_id}',[App\Http\Controllers\AppraisalController::class, 'pmo_save_appraisal']);
    Route::get('/adm/{id}/list/pending/pmo/performance/supervision/appraisals',[App\Http\Controllers\AppraisalController::class, 'supervisions']);
    Route::get('/adm/{id}/view/pmo/performance/appraisals',[App\Http\Controllers\AdminController::class, 'supervisor_view_performance_appraisal']);
    Route::get('/adm/{id}/supervise/pmo/performance/appraisal_id={appraisal_id}/{pmo_id}',[App\Http\Controllers\AppraisalController::class, 'supervise']);
    Route::post('/adm/{id}/save/pmo/performance/appraisal/appraisal_id={appraisal_id}/{pmo_id}',[App\Http\Controllers\AppraisalController::class, 'supervision_save']);
    Route::get('/adm/{id}/view/report/template/{template_id}',[App\Http\Controllers\AdminController::class, 'report_template_view']);
    Route::get('/adm/{id}/edit/report/template/{template_id}',[App\Http\Controllers\AdminController::class, 'report_template_edit']);
    Route::post('/adm/{id}/update/report/template/{template_id}',[App\Http\Controllers\AdminController::class, 'report_template_update']);
    Route::get('/adm/{id}/view/reports/template_id={report_id}',[App\Http\Controllers\AdminController::class, 'reports']);
    Route::get('/adm/{id}/view/reports/template_id={template_id}/target_group_id={target_group_id}/key={key}',[App\Http\Controllers\AdminController::class, 'view_reports_by_key']);
    Route::get('/adm/{id}/view/reports/template_id={template_id}/report_id={report_id}',[App\Http\Controllers\AdminController::class, 'view_report_by_key']);
    Route::get('/adm/{id}/submit/report/{report_id}',[App\Http\Controllers\AdminController::class, 'submit_report']);
    Route::post('/adm/{id}/save/report/{report_id}',[App\Http\Controllers\AdminController::class, 'save_report']);
    Route::get('/adm/{id}/view/reports/target_group_id={target_group_id}',[App\Http\Controllers\AdminController::class, 'reports_by_role']);
    Route::get('/adm/{id}/view/reports/template_id={template_id}/report_target_group_id={report_target_group_id}',[App\Http\Controllers\AdminController::class, 'reports_by_role_list']);
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

    //centers
    Route::get('/adm/{id}/list/centers',[App\Http\Controllers\CenterController::class, 'index']);
    Route::get('/adm/{id}/view/center/{center_id}',[App\Http\Controllers\CenterController::class, 'show']);
    Route::get('/adm/{id}/add/center',[App\Http\Controllers\CenterController::class, 'create']);
    Route::post('/adm/{id}/save/center',[App\Http\Controllers\CenterController::class, 'store']);
    Route::get('/adm/{id}/edit/center/{center_id}',[App\Http\Controllers\CenterController::class, 'edit']);
    Route::post('/adm/{id}/update/center/{center_id}',[App\Http\Controllers\CenterController::class, 'update']);
    Route::post('/adm/{id}/delete/center/{center_id}',[App\Http\Controllers\CenterController::class, 'destroy']);
    //center Managers
    Route::post('/adm/{id}/save/cm',[App\Http\Controllers\CenterManagerController::class, 'store']);
    Route::get('/adm/{id}/request/upload/cms',[App\Http\Controllers\CenterManagerController::class, 'request_upload_cms']);
    Route::get('/download/cms/excel/template',[App\Http\Controllers\CenterManagerController::class, 'download_cms_excel_template']);
    Route::post('/adm/{id}/upload/cms',[App\Http\Controllers\CenterManagerController::class, 'upload_cms']);

    //trainers
    Route::get('/adm/{id}/request/upload/trainers',[App\Http\Controllers\TrainerController::class, 'request_upload_trainers']);
    Route::get('/download/trainers/excel/template',[App\Http\Controllers\TrainerController::class, 'download_trainers_excel_template']);
    Route::post('/adm/{id}/upload/trainers',[App\Http\Controllers\TrainerController::class, 'upload_trainers']);
    Route::get('/trainers',[App\Http\Controllers\TrainerController::class, 'trainers']);//json array of trainers
    Route::post('/save-trainer',[App\Http\Controllers\TrainerController::class, 'store']);
    Route::get('/adm/{id}/asses/trainer/competence',[App\Http\Controllers\TrainerController::class, 'asses_trainer']);
    Route::post('/adm/{id}/save/trainer/competence/assessment',[App\Http\Controllers\TrainerController::class, 'save_trainer_assessment']);
    Route::get('/adm/{id}/view/competence/reports',[App\Http\Controllers\TrainerController::class, 'trainer_competence_reports']);
    Route::get('/adm/{id}/view/trainer/competence/reports',[App\Http\Controllers\TrainerController::class, 'adm_view_trainer_competence_reports']);
    Route::get('/adm/{id}/view/competence/report/report_id={report_id}',[App\Http\Controllers\TrainerController::class, 'trainer_competence_report']);
    //Sessions
    Route::get('/adm/{id}/list/sessions',[App\Http\Controllers\SessionController::class, 'index']);
    Route::get('/adm/{id}/add/session',[App\Http\Controllers\SessionController::class, 'create']);
    Route::post('/adm/{id}/save/session',[App\Http\Controllers\SessionController::class, 'store']);
    Route::get('/adm/{id}/view/session/{session_id}',[App\Http\Controllers\SessionController::class, 'show']);
    Route::get('/adm/{id}/confirm/session/session_id={session_id}',[App\Http\Controllers\SessionController::class, 'session_approve']);
    Route::get('/adm/{id}/edit/session/session_id={session_id}',[App\Http\Controllers\SessionController::class, 'edit']);
    Route::get('/adm/{id}/update/session/session_id={session_id}',[App\Http\Controllers\SessionController::class, 'update']);
    Route::get('/adm/{id}/delete/session/session_id={session_id}',[App\Http\Controllers\SessionController::class, 'destroy']);
    //Session (Trainers)
    Route::get('/new/session/trainers/{id}',[App\Http\Controllers\SessionController::class, 'new_session_trainers']);//json array of trainers not in the session
    Route::get('/adm/{id}/session/{session_id}/add/trainers',[App\Http\Controllers\SessionController::class, 'create_trainers']);
    Route::post('/adm/{id}/session/{session_id}/save/trainers',[App\Http\Controllers\SessionController::class, 'store_trainers']);
    //Session (Trainees)
    Route::get('/adm/{id}/session/{session_id}/add/trainees',[App\Http\Controllers\SessionController::class, 'create_trainees']);
    Route::post('/adm/{id}/session/{session_id}/save/trainees',[App\Http\Controllers\SessionController::class, 'store_trainees']);
    Route::get('/adm/{id}/session/{session_id}/upload/trainees',[App\Http\Controllers\SessionController::class, 'upload_trainees']);
    Route::get('/download/trainees/excel/template',[App\Http\Controllers\SessionController::class, 'download_excel_template']);
    Route::post('/adm/{id}/session/{session_id}/save/uploaded/trainees',[App\Http\Controllers\SessionController::class, 'store_uploaded_trainees']);

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

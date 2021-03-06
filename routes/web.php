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
    Route::get('/login/as/{id}',[App\Http\Controllers\SuperAdminController::class, 'login_as']);
});

//guests confirm invitation
Route::get('/account/activate/{id}',[App\Http\Controllers\AdminController::class, 'activate_account'])->middleware('create.password');
Route::post('/update/account/{id}',[App\Http\Controllers\AdminController::class, 'update_account']);

// forgot password return a form, use phone to get email and then send reset password instructions
Route::get('/forgot/password',[App\Http\Controllers\AdminController::class, 'forgot_password'])->middleware('guest');
Route::post('/request/reset/password',[App\Http\Controllers\AdminController::class, 'request_reset_password']);
Route::get('/{token}/{id}',[App\Http\Controllers\AdminController::class, 'reset_password'])->middleware('guest');
Route::post('/update/password/{id}',[App\Http\Controllers\AdminController::class, 'update_password']);

//shared responsibility
Route::group(['middleware'=>'admin'],function (){
    // index dashboard
    Route::get('/adm/main/dashboard',[App\Http\Controllers\AdminController::class, 'index']);

    //admins -> (Profile,list)
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

    //Reports ->Center Managers
    Route::get('/adm/{id}/view/cms/reports',[App\Http\Controllers\CmsReportController::class, 'index']);
    Route::get('/adm/{id}/create/cms/report/template',[App\Http\Controllers\CmsReportController::class, 'create']);
    Route::post('/adm/{id}/generate/cms/report/template',[App\Http\Controllers\CmsReportController::class, 'store']);
//    Route::get('/adm/{id}/view/cms/report/template/{report_id}',[App\Http\Controllers\CmsReportController::class, 'template']);
    Route::get('/question/{question_id}/options',[App\Http\Controllers\CmsReportController::class, 'options']);//json array of options for a select question
    Route::get('/adm/{id}/view/cms/report/{report_id}',[App\Http\Controllers\CmsReportController::class, 'show']);
    //Reports
    Route::get('/adm/{id}/view/reports/templates',[App\Http\Controllers\AdminController::class, 'reports_templates']);
    Route::get('/adm/{id}/create/new/report/template',[App\Http\Controllers\AdminController::class, 'report_template_create']);
    Route::get('/adm/{id}/create/new/pmo/report/template',[App\Http\Controllers\AdminController::class, 'report_template_create_pmo']);
    Route::get('/adm/{id}/create/new/cm/report/template',[App\Http\Controllers\AdminController::class, 'report_template_create_cm']);
    Route::get('/adm/{id}/create/new/trainer/report/template',[App\Http\Controllers\AdminController::class, 'report_template_create_trainer']);
    Route::get('/actors',[App\Http\Controllers\AdminController::class, 'report_actors']);//json array of trainers
    Route::get('/pmos',[App\Http\Controllers\AdminController::class, 'report_actors_pmos']);//json array of trainers
//    Route::post('/adm/{id}/generate/report/template',[App\Http\Controllers\AdminController::class, 'report_template_generate']);




//    Reports Template With question types
    Route::get('/adm/{id}/create/report/template',[App\Http\Controllers\ReportTemplateController::class, 'index']);
    Route::post('/adm/{id}/generate/template',[App\Http\Controllers\ReportTemplateController::class, 'store']);

    // Project managers
    Route::get('/list/all/pmo',[App\Http\Controllers\ProjectManagerController::class, 'pmo']);//json array of trainers
    Route::post('/adm/{id}/save/pm',[App\Http\Controllers\ProjectManagerController::class, 'store']);

    //projects
    Route::get('/adm/{id}/list/projects',[App\Http\Controllers\ProjectController::class, 'index']);
    Route::get('/adm/list/projects',[App\Http\Controllers\ProjectController::class, 'project_names']);//json array of project names
    Route::get('/adm/get/project/tasks',[App\Http\Controllers\ProjectController::class, 'project_tasks']);//json array of total tasks per projects
    Route::get('/adm/{id}/list/my/projects',[App\Http\Controllers\ProjectController::class, 'index_my_projects']);
    Route::get('/adm/{id}/list/project/collaborations',[App\Http\Controllers\ProjectController::class, 'index_project_collaborations']);
    Route::get('/list/collaborators/{id}',[App\Http\Controllers\ProjectController::class, 'collaborators']);//json array of collaborators added to project
    Route::get('/adm/{id}/create/new/project',[App\Http\Controllers\ProjectController::class, 'create']);
    Route::post('/adm/{id}/save/new/project',[App\Http\Controllers\ProjectController::class, 'store']);
    Route::get('/adm/{id}/view/project/{project_id}',[App\Http\Controllers\ProjectController::class, 'show']);
    Route::get('/adm/{id}/project/{project_id}/overview',[App\Http\Controllers\ProjectController::class, 'overview']);
    Route::get('/new/collaborators/project_id={project_id}',[App\Http\Controllers\ProjectController::class, 'invite_collaborators']);//json array of new collaborators not in project
    Route::get('/adm/{id}/edit/project/{project_id}',[App\Http\Controllers\ProjectController::class, 'edit']);
    Route::post('/adm/{id}/update/project/{project_id}',[App\Http\Controllers\ProjectController::class, 'update']);
    Route::post('/adm/{id}/delete/project/{project_id}',[App\Http\Controllers\ProjectController::class, 'destroy']);
    //Project tasks overview
    Route::get('/adm/get/project/{project_id}/complete/tasks',[App\Http\Controllers\ProjectController::class, 'complete_tasks']);//json array of tasks marked as complete
    Route::get('/adm/get/project/{project_id}/incomplete/tasks',[App\Http\Controllers\ProjectController::class, 'incomplete_tasks']);//json array of tasks Marked incomplete(status 0)
    Route::get('/adm/get/project/{project_id}/overdue/tasks',[App\Http\Controllers\ProjectController::class, 'overdue_tasks']);//json array of tasks past the due date
    //Projects -> Boards/Activities
    Route::post('/adm/{id}/create/new/board/project_id={project_id}',[App\Http\Controllers\BoardController::class, 'store']);
    Route::post('/adm/{id}/update/activity/{activity_id}',[App\Http\Controllers\BoardController::class, 'update']);

    //Projects -> Tasks
    Route::get('/adm/get/complete/tasks',[App\Http\Controllers\TaskController::class, 'complete_tasks']);//json array of tasks marked as complete
    Route::get('/adm/get/incomplete/tasks',[App\Http\Controllers\TaskController::class, 'incomplete_tasks']);//json array of tasks Marked incomplete(status 0)
    Route::get('/adm/get/overdue/tasks',[App\Http\Controllers\TaskController::class, 'overdue_tasks']);//json array of tasks past the due date
    Route::get('/adm/get/open/tasks',[App\Http\Controllers\TaskController::class, 'open_tasks']);//json array of tasks
    Route::post('/adm/{id}/create/new/task/board_id={board_id}',[App\Http\Controllers\TaskController::class, 'store']);
    Route::get('/adm/{id}/view/task/task_id={task_id}',[App\Http\Controllers\TaskController::class, 'show']);
    Route::post('/adm/{id}/add/task/comment/task_id={task_id}',[App\Http\Controllers\TaskCommentController::class, 'store']);
    Route::post('/adm/{id}/assign/task/{task_id}/new/collaborator',[App\Http\Controllers\TaskController::class, 'update_assignees']);
    Route::post('/adm/{id}/update/task/{task_id}/name',[App\Http\Controllers\TaskController::class, 'update_task_name']);
    Route::post('/adm/{id}/update/task/{task_id}/due_date',[App\Http\Controllers\TaskController::class, 'update_due_date']);
    Route::post('/adm/{id}/mark/task/{task_id}/complete',[App\Http\Controllers\TaskController::class, 'mark_complete']);
    //projects -> Tasks (Attachments)
    Route::get('/adm/{id}/view/complete/tasks',[App\Http\Controllers\TaskController::class, 'complete_tasks_overview']);
    Route::get('/adm/{id}/view/incomplete/tasks',[App\Http\Controllers\TaskController::class, 'incomplete_tasks_overview']);
    Route::get('/adm/{id}/view/overdue/tasks',[App\Http\Controllers\TaskController::class, 'overdue_tasks_overview']);

    //projects -> Tasks (Attachments)
    Route::post('/adm/{id}/add/task/{task_id}/attachment',[App\Http\Controllers\TaskAttachmentController::class, 'store']);
    Route::post('/adm/{id}/delete/task/attachment/{attachment_id}',[App\Http\Controllers\TaskAttachmentController::class, 'destroy']);
    Route::post('/adm/{id}/delete/task/attachment/{attachment_id}',[App\Http\Controllers\TaskAttachmentController::class, 'destroy']);

    //projects -> Tasks (links)
    Route::post('/adm/{id}/add/task/{task_id}/link',[App\Http\Controllers\TaskLinkController::class, 'store']);
    Route::post('/adm/{id}/delete/task/link/{link_id}',[App\Http\Controllers\TaskLinkController::class, 'destroy']);


    // Performance Appraisals
    Route::get('/adm/{id}/view/performance/appraisals',[App\Http\Controllers\AppraisalController::class, 'index']);
    Route::get('/adm/{id}/archive/performance/appraisals/{appraisal_id}',[App\Http\Controllers\AppraisalController::class, 'archive']);
    Route::get('/adm/{id}/list/archived/performance/appraisals',[App\Http\Controllers\AppraisalController::class, 'index_archived']);
    Route::get('/adm/{id}/create/new/performance/appraisal',[App\Http\Controllers\AppraisalController::class, 'create']);
    Route::post('/adm/{id}/add/pmo/performance/appraisal',[App\Http\Controllers\AppraisalController::class, 'store']);
    Route::get('/adm/{id}/view/performance/appraisal/template/appraisal_id={appraisal_id}',[App\Http\Controllers\AppraisalController::class, 'show']);
    Route::get('/adm/{id}/view/performance/appraisal/appraisal_id={appraisal_id}',[App\Http\Controllers\AppraisalController::class, 'appraisal']);
    Route::get('/adm/{id}/submit/performance/appraisal/appraisal_id={appraisal_id}',[App\Http\Controllers\AppraisalController::class, 'submit']);
    Route::get('/adm/{id}/view/my/performance/appraisals',[App\Http\Controllers\AdminController::class, 'performance_appraisals_all']);
    Route::post('/adm/{id}/save/my/performance/appraisal/appraisal_id={appraisal_id}',[App\Http\Controllers\AppraisalController::class, 'pmo_save_appraisal']);
    Route::get('/adm/{id}/list/pending/pmo/performance/supervision/appraisals',[App\Http\Controllers\AppraisalController::class, 'supervisions']);
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
//    Route::get('/adm/{id}/view/trainer/daily/attendance/reports',[App\Http\Controllers\AdminController::class, 'reports_by_trainers_attendance']);
    Route::get('/adm/{id}/view/trainer/daily/virtual/training/reports',[App\Http\Controllers\AdminController::class, 'reports_by_trainers_virtual']);
    Route::get('/adm/{id}/view/trainer/daily/physical/training/reports',[App\Http\Controllers\AdminController::class, 'reports_by_trainers_physical']);
    Route::get('/adm/{id}/view/trainer/assignment/submission/reports',[App\Http\Controllers\TrainerAssignmentSubmissionReportController::class, 'index']);
    Route::get('/adm/{id}/submit/assignment/report',[App\Http\Controllers\TrainerAssignmentSubmissionReportController::class, 'create']);
    Route::post('/adm/{id}/save/assignment/report',[App\Http\Controllers\TrainerAssignmentSubmissionReportController::class, 'store']);

    //Trainer Daily Attendance Reports
    Route::get('/adm/{id}/view/daily/attendance/reports',[App\Http\Controllers\TrainerDailyAttedanceReportController::class, 'index']);
    Route::get('/adm/{id}/view/daily/attendance/report/report_id={report_id}',[App\Http\Controllers\TrainerDailyAttedanceReportController::class, 'show']);
    Route::get('/adm/{id}/submit/daily/attendance/report',[App\Http\Controllers\TrainerDailyAttedanceReportController::class, 'create']);
    Route::post('/adm/{id}/save/daily/attendance/report',[App\Http\Controllers\TrainerDailyAttedanceReportController::class, 'store']);
//    Route::get('/adm/{id}/view/daily/virtual/training/reports',[App\Http\Controllers\TrainerController::class, 'virtual_training_reports']);
//    Route::get('/adm/{id}/view/daily/virtual/training/report/report_id={report_id}',[App\Http\Controllers\TrainerController::class, 'virtual_training_report']);

    //Trainer Training Reports
    Route::get('/adm/{id}/view/daily/training/reports',[App\Http\Controllers\TrainerDailyTrainingReportController::class, 'index']);
    Route::get('/adm/{id}/submit/daily/training/report',[App\Http\Controllers\TrainerDailyTrainingReportController::class, 'create']);
    Route::post('/adm/{id}/save/daily/training/report',[App\Http\Controllers\TrainerDailyTrainingReportController::class, 'store']);
    Route::get('/adm/{id}/view/daily/training/report/{report_id}',[App\Http\Controllers\TrainerDailyTrainingReportController::class, 'show']);
//    Route::get('/adm/{id}/submit/daily/virtual/training/report',[App\Http\Controllers\TrainerController::class, 'virtual_training_report_submit']);
//    Route::post('/adm/{id}/save/daily/virtual/training/report',[App\Http\Controllers\TrainerController::class, 'virtual_training_report_save']);
//    Route::get('/adm/{id}/view/daily/physical/training/reports',[App\Http\Controllers\TrainerController::class, 'daily_physical_reports']);
//    Route::get('/adm/{id}/view/daily/physical/training/report/report_id={report_id}',[App\Http\Controllers\TrainerController::class, 'daily_physical_report']);
//    Route::get('/adm/{id}/submit/daily/physical/training/report',[App\Http\Controllers\TrainerController::class, 'daily_physical_report_submit']);
//    Route::post('/adm/{id}/save/daily/physical/training/report',[App\Http\Controllers\TrainerController::class, 'daily_physical_report_save']);
//    Route::get('/adm/{id}/view/assignment/submission/reports',[App\Http\Controllers\TrainerController::class, 'assignment_submission_reports']);
//    Route::get('/adm/{id}/view/assignment/submission/report/report_id={report_id}',[App\Http\Controllers\TrainerController::class, 'assignment_submission_report']);

    //centers
    Route::get('/adm/{id}/list/centers',[App\Http\Controllers\CenterController::class, 'index']);
    Route::get('/centers',[App\Http\Controllers\CenterController::class, 'centers']);
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
    Route::get('/trainer/job/categories',[App\Http\Controllers\JobCategoryController::class, 'job_categories']);//job categories for trainers
    Route::get('/adm/{id}/request/upload/trainers',[App\Http\Controllers\TrainerController::class, 'request_upload_trainers']);
    Route::get('/download/trainers/excel/template',[App\Http\Controllers\TrainerController::class, 'download_trainers_excel_template']);
    Route::post('/adm/{id}/upload/new/trainers',[App\Http\Controllers\TrainerController::class, 'upload_trainers']);
    Route::get('/trainers',[App\Http\Controllers\TrainerController::class, 'trainers']);//json array of trainers
    Route::post('/save-trainer',[App\Http\Controllers\TrainerController::class, 'store']);
    Route::get('/adm/{id}/asses/trainer/competence',[App\Http\Controllers\TrainerController::class, 'asses_trainer']);
    Route::post('/adm/{id}/save/trainer/competence/assessment',[App\Http\Controllers\TrainerController::class, 'save_trainer_assessment']);
    Route::get('/adm/{id}/view/competence/reports',[App\Http\Controllers\TrainerController::class, 'trainer_competence_reports']);
    Route::get('/adm/{id}/view/trainer/competence/reports',[App\Http\Controllers\TrainerController::class, 'adm_view_trainer_competence_reports']);
    Route::get('/adm/{id}/view/competence/report/report_id={report_id}',[App\Http\Controllers\TrainerController::class, 'trainer_competence_report']);

    //Trainings
    Route::get('/adm/{id}/list/trainings',[App\Http\Controllers\TrainingController::class, 'index']);
    Route::get('/training/{training_id}/trainers',[App\Http\Controllers\TrainingController::class, 'trainers']);//json array of trainers added to training
    Route::get('/training/{training_id}/centers',[App\Http\Controllers\TrainingController::class, 'centers']);//json array of centers where training taking place
    Route::get('/training/{training_id}/cohorts',[App\Http\Controllers\TrainingController::class, 'cohorts']);//json array of classes added to training
    Route::get('/training/{training_id}/institutions',[App\Http\Controllers\TrainingController::class, 'institutions']);//json array of institutions added to training
    Route::get('/adm/{id}/add/new/training',[App\Http\Controllers\TrainingController::class, 'create']);
    Route::post('/adm/{id}/save/training',[App\Http\Controllers\TrainingController::class, 'store']);
    Route::get('/adm/{id}/view/training/{training_id}',[App\Http\Controllers\TrainingController::class, 'show']);
    Route::get('/adm/{id}/confirm/training/{training_id}',[App\Http\Controllers\TrainingController::class, 'approve']);
    Route::get('/adm/{id}/edit/training/{training_id}',[App\Http\Controllers\TrainingController::class, 'edit']);
    Route::get('/adm/{id}/update/training/{training_id}',[App\Http\Controllers\TrainingController::class, 'update']);
    Route::get('/adm/{id}/delete/training/{training_id}',[App\Http\Controllers\TrainingController::class, 'destroy']);

    //Training -> (Updates)
    Route::post('/adm/{id}/update/training/{training_id}/trainers',[App\Http\Controllers\TrainingController::class, 'update_trainers']);
    Route::post('/adm/{id}/update/training/{training_id}/center',[App\Http\Controllers\TrainingController::class, 'update_center']);
    Route::post('/adm/{id}/update/training/{training_id}/cohort',[App\Http\Controllers\TrainingController::class, 'update_cohort']);
    Route::post('/adm/{id}/update/training/{training_id}/institution',[App\Http\Controllers\TrainingController::class, 'update_institution']);

    //Training -> (Session Allocations)
    Route::get('/adm/{id}/view/training/{training_id}/session/allocations',[App\Http\Controllers\TrainingSessionAllocationController::class, 'index']);

    //Trainings per category (if  virtual training)
    Route::get('/adm/{id}/view/training/{training_id}/category/{category_id}',[App\Http\Controllers\TrainingCategoryController::class, 'index']);
    Route::get('/adm/{id}/view/training/{training_id}/category/{category_id}/day/{day_id}',[App\Http\Controllers\TrainingCategoryController::class, 'show']);

    //Trainings(Per Day Day one ...)
    Route::get('/adm/{id}/view/training/{training_id}/day/{day_id}',[App\Http\Controllers\TrainingDayController::class, 'show']);
    Route::post('/adm/{id}/add/training/{training_id}/day/{day_id}/facilitators',[App\Http\Controllers\TrainingDayController::class, 'update_facilitators']);
    Route::get('/training/{training_id}/facilitators',[App\Http\Controllers\TrainingDayController::class, 'trainers']);
    Route::get('/adm/{id}/edit/training/{training_id}/day/{day}/{day_id}/session/{session_id}',[App\Http\Controllers\TrainingDayController::class, 'edit']);

    //Trainings(Sessions)
    Route::get('/training/session/{session_id}/facilitators',[App\Http\Controllers\SessionController::class, 'facilitators']);

    //Trainings(Time tables)
    Route::get('/adm/{id}/view/physical/training/timetable',[App\Http\Controllers\TrainingController::class, 'physical']);
    Route::get('/adm/{id}/view/virtual/training/timetable',[App\Http\Controllers\TrainingController::class, 'virtual']);

    //Trainings(Sessions)
    Route::get('/adm/{id}/list/sessions',[App\Http\Controllers\SessionController::class, 'index']);
    Route::get('/adm/{id}/add/session',[App\Http\Controllers\SessionController::class, 'create']);
    Route::post('/adm/{id}/save/session',[App\Http\Controllers\SessionController::class, 'store']);
    Route::get('/adm/{id}/view/session/{session_id}',[App\Http\Controllers\SessionController::class, 'show']);
    Route::get('/adm/{id}/view/session/{session_id}/training/day/{day_id}',[App\Http\Controllers\SessionController::class, 'training_per_day']);
    Route::get('/adm/{id}/confirm/session/session_id={session_id}',[App\Http\Controllers\SessionController::class, 'session_approve']);
    Route::get('/adm/{id}/edit/session/session_id={session_id}',[App\Http\Controllers\SessionController::class, 'edit']);
    Route::get('/adm/{id}/update/session/session_id={session_id}',[App\Http\Controllers\SessionController::class, 'update']);
    Route::get('/adm/{id}/delete/session/session_id={session_id}',[App\Http\Controllers\SessionController::class, 'destroy']);

    //Training (Trainees)
    Route::get('/adm/{id}/register/new/training/{training_id}/trainee',[App\Http\Controllers\TraineeController::class, 'create']);
    Route::post('/adm/{id}/training/{training_id}/save/trainee',[App\Http\Controllers\TraineeController::class, 'store']);
//    Route::post('/adm/{id}/training/{training_id}/day/{day_id}/save/trainees',[App\Http\Controllers\TraineeController::class, 'store_physical_tot']);
    Route::post('/adm/{id}/training/{training_id}/category/{category_id}/save/trainees',[App\Http\Controllers\TraineeController::class, 'store_virtual']);
    Route::get('/adm/{id}/mark/training/{training_id}/trainees/register',[App\Http\Controllers\TrainingController::class, 'mark_register_physical_tot']);
    Route::post('/adm/{id}/mark/training/{training_id}/day/{day_id}/trainee/{trainee_id}/present',[App\Http\Controllers\TrainingController::class, 'mark_trainee_physical_tot_present']);
    Route::post('/adm/{id}/mark/training/{training_id}/day/{day_id}/trainee/{trainee_id}/absent',[App\Http\Controllers\TrainingController::class, 'mark_trainee_physical_tot_absent']);
    Route::get('/adm/{id}/mark/training/{training_id}/category/{category_id}/trainees/register',[App\Http\Controllers\TrainingController::class, 'mark_trainee_virtual_present']);
    Route::post('/adm/{id}/mark/training/{training_id}/category/{category_id}/day/{day_id}/trainee/{trainee_id}/present',[App\Http\Controllers\TrainingController::class, 'mark_register_virtual']);
//    Route::get('/adm/{id}/training/{training_id}/day/{day_id}/category/{category_id}/trainees/register',[App\Http\Controllers\TraineeController::class, 'show_with_category']);
    Route::get('/adm/{id}/upload/training/{training_id}/trainees',[App\Http\Controllers\TraineeController::class, 'upload_physical_tot']);
    Route::post('/adm/{id}/save/training/{training_id}/trainees',[App\Http\Controllers\TraineeController::class, 'upload_store_physical_tot']);
    Route::get('/adm/{id}/upload/training/{training_id}/category/{category_id}/trainees',[App\Http\Controllers\TraineeController::class, 'upload_virtual']);
    Route::post('/adm/{id}/save/training/{training_id}/category/{category_id}/trainees',[App\Http\Controllers\TraineeController::class, 'upload_store_virtual']);
    Route::get('/download/trainees/excel/template',[App\Http\Controllers\TraineeController::class, 'excel_template']);

    //Trainings ->Physical Training Resources
    Route::get('/adm/{id}/view/physical/training/resources',[App\Http\Controllers\PhysicalTrainingResourceController::class, 'index']);
    Route::get('/adm/{id}/add/physical/training/resources',[App\Http\Controllers\PhysicalTrainingResourceController::class, 'create']);
    Route::post('/adm/{id}/save/physical/training/resources',[App\Http\Controllers\PhysicalTrainingResourceController::class, 'store']);


    //Trainings ->Virtual Training Resources
    Route::get('/adm/{id}/view/virtual/training/resources',[App\Http\Controllers\VirtualTrainingResourceController::class, 'index']);
    Route::get('/adm/{id}/add/virtual/training/resources',[App\Http\Controllers\VirtualTrainingResourceController::class, 'create']);
    Route::post('/adm/{id}/save/virtual/training/resources',[App\Http\Controllers\VirtualTrainingResourceController::class, 'store']);


    //Trainings ->Tot Training Resources
    Route::get('/adm/{id}/view/tot/training/resources',[App\Http\Controllers\TotTrainingResourceController::class, 'index']);
    Route::get('/adm/{id}/add/tot/training/resources',[App\Http\Controllers\TotTrainingResourceController::class, 'create']);
    Route::post('/adm/{id}/add/save/training/resources',[App\Http\Controllers\TotTrainingResourceController::class, 'store']);

    //Session (Trainers)
    Route::get('/new/session/trainers/{id}',[App\Http\Controllers\SessionController::class, 'new_session_trainers']);//json array of trainers not in the session
    Route::get('/new/session/classes/{id}',[App\Http\Controllers\SessionController::class, 'new_session_classes']);//json array of classes not in the session
    Route::get('/adm/{id}/session/{session_id}/day/{day_id}/add/trainers',[App\Http\Controllers\SessionController::class, 'create_trainers']);
    Route::post('/adm/{id}/session/{session_id}/day/{day_id}/save/trainers',[App\Http\Controllers\SessionController::class, 'store_trainers']);
    Route::get('/adm/{id}/session/{session_id}/day/{day_id}/add/classes',[App\Http\Controllers\SessionController::class, 'create_classes']);
    Route::post('/adm/{id}/session/{session_id}/day/{day_id}/save/classes',[App\Http\Controllers\SessionController::class, 'store_classes']);

    //employee Leave form
    Route::get('/adm/{id}/view/leave/applications',[App\Http\Controllers\LeaveApplicationController::class,'index']);
    Route::get('/adm/{id}/apply/employee/leave',[App\Http\Controllers\LeaveApplicationController::class,'create']);
    Route::post('/adm/{id}/request/employee/leave',[App\Http\Controllers\LeaveApplicationController::class,'store']);
    Route::get('/adm/{id}/view/leave/application/application_id={application_id}',[App\Http\Controllers\LeaveApplicationController::class,'show']);
    Route::get('/adm/{id}/accept/employee/leave/{application_id}',[App\Http\Controllers\LeaveApplicationController::class,'accept_leave']);
    Route::post('/adm/{id}/accept/employee/leave/{application_id}',[App\Http\Controllers\LeaveApplicationController::class,'accept_leave_save']);
    Route::get('/adm/{id}/reject/employee/leave/{application_id}',[App\Http\Controllers\LeaveApplicationController::class,'reject_leave']);
    Route::post('/adm/{id}/reject/employee/leave/{application_id}',[App\Http\Controllers\LeaveApplicationController::class,'reject_leave_save']);
//    Route::get('/adm/{id}/view/Leave/applications',[App\Http\Controllers\AdminController::class,'employee_leave_applications']);

    //Awards
    Route::get('/adm/{id}/list/awards',[App\Http\Controllers\AwardController::class,'index']);
    Route::get('/adm/{id}/create/new/award',[App\Http\Controllers\AwardController::class,'create']);
    Route::post('/adm/{id}/save/new/award',[App\Http\Controllers\AwardController::class,'store']);
    Route::get('/adm/{id}/view/award/{award_id}',[App\Http\Controllers\AwardController::class,'show']);
    Route::get('/adm/{id}/edit/award/{award_id}',[App\Http\Controllers\AwardController::class,'edit']);
    Route::post('/adm/{id}/update/award/{award_id}',[App\Http\Controllers\AwardController::class,'update']);
    Route::get('/list/all/users',[App\Http\Controllers\AdminController::class,'admins']);

//    Announcements
    Route::get('/adm/{id}/list/announcements',[App\Http\Controllers\AnnouncementController::class,'index']);
    Route::get('/adm/{id}/add/new/announcement',[App\Http\Controllers\AnnouncementController::class,'create']);
    Route::post('/adm/{id}/save/new/announcement',[App\Http\Controllers\AnnouncementController::class,'store']);
    Route::get('/adm/{id}/view/announcement/{announcement_id}',[App\Http\Controllers\AnnouncementController::class,'show']);
    Route::get('/adm/{id}/edit/announcement/{announcement_id}',[App\Http\Controllers\AnnouncementController::class,'edit']);
    Route::post('/adm/{id}/update/announcement/{announcement_id}',[App\Http\Controllers\AnnouncementController::class,'update']);

    //Cohorts -> (Classes)
    Route::get('/adm/{id}/list/cohorts',[App\Http\Controllers\CohortController::class, 'index']);
    Route::get('/adm/{id}/create/cohort',[App\Http\Controllers\CohortController::class, 'create']);
    Route::post('/adm/{id}/save/cohort',[App\Http\Controllers\CohortController::class, 'store']);
    Route::get('/adm/{id}/view/cohort/{cohort_id}',[App\Http\Controllers\CohortController::class, 'show']);
    Route::get('/adm/{id}/edit/cohort/{cohort_id}',[App\Http\Controllers\CohortController::class, 'edit']);
    Route::post('/adm/{id}/update/cohort/{cohort_id}',[App\Http\Controllers\CohortController::class, 'update']);
    Route::post('/adm/{id}/delete/cohort/{cohort_id}',[App\Http\Controllers\CohortController::class, 'destroy']);
    Route::get('/cohorts',[App\Http\Controllers\CohortController::class, 'cohorts']);//json array of cohorts

    //Institutions
    Route::get('/adm/{id}/list/institutions',[App\Http\Controllers\InstitutionController::class, 'index']);
    Route::get('/institutions',[App\Http\Controllers\InstitutionController::class, 'institutions']);//json array of cohorts

    //TEAMS
    //teams (Center Managers)
    Route::get('/cms',[App\Http\Controllers\CenterManagerController::class, 'cms']);//json array of all cms
//    Route::get('/cms/new/{id}',[App\Http\Controllers\SuperAdminController::class, 'cms_new']);//json array of cms(new ->not in team)
    Route::get('/team/{team_id}/cms',[App\Http\Controllers\TeamCenterManagerController::class, 'cms']);//json array of cms in team
    Route::get('/adm/{id}/list/team/cms',[App\Http\Controllers\TeamCenterManagerController::class, 'index']);
//    Route::get('/cms/teams',[App\Http\Controllers\SuperAdminController::class, 'team_cms']);
    Route::get('/adm/{id}/create/team/cms',[App\Http\Controllers\TeamCenterManagerController::class, 'create']);
    Route::post('/adm/{id}/save/team/cms',[App\Http\Controllers\TeamCenterManagerController::class, 'store']);
    Route::post('/adm/{id}/update/cms/team/{team_id}/leaders',[App\Http\Controllers\TeamCenterManagerController::class, 'update_leaders']);
    Route::post('/adm/{id}/update/cms/team/{team_id}/members',[App\Http\Controllers\TeamCenterManagerController::class, 'update_members']);

    //teams (Trainers)
    Route::get('/adm/{id}/list/team/trainers',[App\Http\Controllers\TeamTrainerController::class, 'index']);
    Route::get('/trainers/new/team/members/{id}',[App\Http\Controllers\SuperAdminController::class, 'trainers_team_new']);//json array of trainers
    Route::get('/adm/{id}/create/team/trainers',[App\Http\Controllers\TeamTrainerController::class, 'create']);
    Route::post('/adm/{id}/save/team/trainers',[App\Http\Controllers\TeamTrainerController::class, 'store']);
    Route::get('/adm/{id}/add/team/trainer/members/team_id={team_id}',[App\Http\Controllers\TeamTrainerController::class, 'edit']);
    Route::post('/adm/{id}/save/team/trainer/members/team_id={team_id}',[App\Http\Controllers\TeamTrainerController::class, 'update']);

    // Email Messaging
    Route::get('/adm/{id}/emails/inbox',[App\Http\Controllers\EmailMessageController::class, 'index']);
    Route::get('/adm/{id}/compose/email',[App\Http\Controllers\EmailMessageController::class, 'create']);
    Route::get('/adm/{id}/read/email/{mail_id}',[App\Http\Controllers\EmailMessageController::class, 'show']);
});

//Center managers routes
Route::group(['middleware'=>'center.managers'],function (){
    //center Manager reports
    Route::get('/adm/{id}/pre/registration/checklist',[App\Http\Controllers\CenterManagerController::class, 'check_list']);
    Route::get('/adm/{id}/submit/pre/registration/checklist',[App\Http\Controllers\CenterManagerController::class, 'check_list_submit']);
    Route::get('/adm/{id}/3/months/work/plan',[App\Http\Controllers\CenterManagerController::class, 'work_plan']);
    Route::get('/adm/{id}/monthly/reports',[App\Http\Controllers\CenterManagerController::class, 'monthly_reports']);
});

Route::group(['middleware'=>'auth'],function (){
    Route::get('/admin-logout',[App\Http\Controllers\AdminController::class, 'admin_logout']);
    Route::get('/adm-profile/{id}',[App\Http\Controllers\AdminController::class, 'admin_profile']);
});

//Route::get('/twitterUserTimeLine', 'TwitterController@twitterUserTimeLine');
Route::get('/twitterUserTimeLine',[App\Http\Controllers\TwitterController::class, 'index']);
//Route::get('/tweet',[App\Http\Controllers\TwitterController::class, 'create']);
Route::post('/tweet', ['as'=>'post.tweet','uses'=>'TwitterController@create']);

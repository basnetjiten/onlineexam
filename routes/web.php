<?php


//use Auth;

use App\category;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
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


Route::post('test',function(){
    echo 'GET';
});

Route::put('test',function(){
    echo 'GET';
});

Route::delete('test',function(){
    echo 'GET';
});
//redirects to home view
    Route::get('/', function () {
        $category = Category::all();
      //  $admin_id = Auth::user()->admin_id;
        return view('welcome',compact('category','admin_id'));
    });


    Route::get('order', 'HomeController@Order');


    Route::get('StudentLogin/{id}', 'Auth\StudentRegController@showLoginForm');

    Auth::routes();
    
    //Student
    Route::post('Studentlogout', 'HomeController@Logout');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/result', 'HomeController@ResultList');
    Route::get('/admit_card', 'HomeController@PrintAdmitCard');
    Route::post('/countquestionasked', 'HomeController@CountQuestionAsked');
    Route::post('/checkforcorrectanswer', 'HomeController@CheckCorrectAnswer');
    Route::post('/updatestudentability', 'HomeController@UpdateStudentAbility');
    Route::post('/getdetailresult', 'HomeController@Get_Detail_Result');
    Route::post('/getsingleresult', 'HomeController@Get_Single_Result');
    Route::post('/updateexamlist', 'HomeController@Updateexamlist');
    Route::post('/updateresultlist', 'HomeController@Updateresultlist');
    Route::post('/chespassorfaillevel', 'HomeController@FetchNextLevelQuestionBasedOnThisRequest');
    Route::post('/ajaxupdateexamcount', 'HomeController@updateExamCount');
    Route::post('/nextlevelsubject', 'HomeController@nextLevelSubject');
    Route::post('/adduserreponse', 'HomeController@Adduserresponse');
    Route::post('/updatesubjectlevel', 'HomeController@UpdateSubjectLevel');
    Route::post('/refresult', 'HomeController@AttemptNewExam');
    Route::get('/exam/start/{subject_id}/{title}/{tname}/{time}/{first_time}/{examcode}', 'HomeController@startexam');

    Route::post('/ajaxstudentsignup', 'Auth\StudentRegController@Student_SignUp');
    Route::post('/ajaxstudentlogin', 'Auth\LoginController@StudentLogin');
//    Route::get('/mytest', 'HomeController@mytest');

    //Admin
    Route::get('/Exams', 'AdminController@showExams')->name('MyExams');
    Route::get('/addstudent', 'AdminController@Addstudent')->name('addstudent');
     Route::post('/studentability', 'AdminController@StudentAbility');
    Route::get('/liststudent', 'AdminController@showstudent')->name('studentlist');
    Route::post('/addquestion', 'AdminController@Addquestion');
    Route::get('/deleteexam/{examcode}', 'AdminController@DeleteExam')->name('trash-exam');
    Route::post('/examreview', 'AdminController@ExamReview');
    Route::post('/updatequestion', 'AdminController@updatequestion');
    Route::post('/QuestionRandom', 'AdminController@QuestionRandom');
    Route::post('/liststudent', 'AdminController@Addstudent');
    Route::get('/StudentResult', 'AdminController@StudentResult');
    Route::post('/update_studentresultlist', 'AdminController@Update_Students_Result_List');
    Route::post('/getallresult', 'AdminController@Get_All_Result');
    Route::post('/getfulldetailresult', 'AdminController@Get_Full_Detail_Result');
    Route::post('/publish', 'AdminController@Publish');

    Route::post('/Addquestiontodb', 'AdminController@Addsubject');
    Route::post('/addexam', 'Addexam@Add_Exam');
    Route::post('/updateexam', 'Addexam@Update_Exam');
    Route::post('/ChangePassword', 'StudentController@ChangePassword');
    Route::post('/RemoveStudent', 'StudentDelete@Delete');
    Route::post('/RemoveQuestion','AdminController@DeleteQuestion');
    Route::get('/addquestion/examcode/{id}/{title}/{tname}/{cat}/{time}', 'AdminController@addquest');
    Route::prefix('admin')->group(function(){
        Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
        Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
        Route::post('/adminregister', 'Auth\AdminLoginController@register');
        Route::get('', 'AdminController@index')->name('admin.dashboard');
    });
    
Route::post('logout', 'AdminController@Logout');


Route::post('/date',function(Request $req){
   

});
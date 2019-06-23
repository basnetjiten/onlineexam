<?php

namespace App\Http\Controllers;

use App\ExamAttempt;
use PDF;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Student;
use App\category;
use App\Addquestion;
use App\examsubject;
use App\result;
use App\ref_result;
use response;
use Illuminate\Support\Facades\input;
use App\Http\Requests;

use Validator;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$created_yr = Carbon::parse(Auth::user()->created_at)->format('Y');
        $created_d = Carbon::parse(Auth::user()->created_at)->format('d');
        $created_m = Carbon::parse(Auth::user()->created_at)->format('m');

        $validity_yr = Carbon::parse(Auth::user()->validity)->format('Y');
        $validity_d = Carbon::parse(Auth::user()->validity)->format('d');
        $validity_m = Carbon::parse(Auth::user()->validity)->format('m');

      ////  $created_dt = Carbon::create($created_yr, $created_m, $created_d, 0, 0, 0);
      //  $validity_dt = Carbon::create($validity_yr, $validity_m, $validity_d, 0, 0, 0);*/


        $data = [
            'publish' => 'Publish',
            'admin_id' => Auth::user()->admin_id

        ];


      //  $exam = DB::table('exam')->where($data)->whereIn('category', json_decode(Auth::user()->category))->get();

        $exam = DB::table('exam_attempts')
            ->Join('exam', 'exam_attempts.examcode', '=', 'exam.examcode')
            ->Join('users', 'users.student_id', '=', 'exam_attempts.student_id')
            ->select('exam_attempts.examattempt_count', 'exam.*','users.category')
            ->where('exam_attempts.student_id', '=', Auth::user()->student_id)
            ->get();


       // if ($created_dt->diffInDays($validity_dt, false) > 0 && Auth::user()->validity != null) {
            return view('home', compact('exam'));
       /* } else {
            return redirect('/order');
        }*/

    }

    public function ResultList()
    {

        $result = DB::table('ref_result')
            ->Join('exam', 'ref_result.examcode', '=', 'exam.examcode')
            ->select('ref_result.*', 'exam.*')
            ->where('ref_result.student_id', '=', Auth::user()->student_id)
            ->get();
      //  dd($result);

        return view('Resultlist', compact('result'));
    }


    public function Updateresultlist(Request $req)
    {
        $data = [
            //        'publish'  => 'Publish',
            'ref_result.student_id' => Auth::user()->student_id,
            'category' => $req->val
        ];

        $result = DB::table('ref_result')
            ->Join('exam', 'ref_result.examcode', '=', 'exam.examcode')
            ->select('ref_result.*', 'exam.*')
            ->where($data)
            ->get();
        return response()->json(array('exam' => $result));
    }


    public function Get_Single_Result(Request $req)
    {

        $result = DB::table('result')
            ->join('exam_question', 'result.ques_id', '=', 'exam_question.id')
            ->join('users', 'users.student_id', '=', 'result.student_id')
            ->select('result.student_id', 'users.name','users.allow_exam_review','result.givenmarks', 'exam_question.subject')
            ->where(['exam_question.examcode' => $req->examcode])//->sum('result.givenmarks');
            ->get();


        $exam_subject = DB::table('exam_subject')->where('examcode', $req->examcode)->get();

        return response()->json(array('result' => $result, 'exam_subject' => $exam_subject));
    }

    public function Get_Detail_Result(Request $req)
    {

        $question = DB::table('exam_question')
            ->where(['examcode' => $req->examcode])//->sum('result.givenmarks');
            ->get();

        $result = DB::table('exam_question')
            ->leftJoin('result', 'result.ques_id', '=', 'exam_question.id')
            ->select('result.*')
            ->where(['exam_question.examcode' => $req->examcode, 'result.student_id' => Auth::user()->student_id])
            ->get();

        return response()->json(array('result' => $result, 'question' => $question));
    }

    public function Updateexamlist(Request $req)
    {
        $data = [
            'publish' => 'Publish',
            'admin_id' => Auth::user()->admin_id,
            'category' => $req->val
        ];

        $exam = DB::table('exam')->where($data)->get();
        //    dump($exam);
        //    return response()->json($exam);
        return response()->json(array('exam' => $exam));
        //   dump($req);
    }

    public function Adduserresponse(Request $req)
    {

        $data = [
            'id' => $req->ques_id,
            'student_id' => Auth::user()->student_id
        ];

        $result = result::updateOrCreate(
            ['ques_id' => $req->ques_id, 'student_id' => Auth::user()->student_id],
            ['selected_option' => $req->selected_option, 'givenmarks' => $req->givenmarks]
        );

        return response()->json($result);
    }

    public function AttemptNewExam(Request $req)
    {
        //  $ref_result = new ref_result;

        $ref_result = ref_result::updateOrCreate(
            ['student_id' => Auth::user()->student_id, 'examcode' => $req->examcode]
        );
        //    $ref_result->student_id = Auth::user()->student_id;
        //    $ref_result->examcode = $req->examcode;
        //    $ref_result->save();
        return response()->json($ref_result);
    }

    public function startexam($id, $title, $tname, $cat, $time)
    {

        $data = [
            'admin_id' => Auth::user()->admin_id,
            'examcode' => $id
        ];
        $data1 = [
            'owner_id' => Auth::user()->admin_id,
            'examcode' => $id
        ];

        $subject = DB::table('exam_subject')->where($data)->get();
        $question = DB::table('exam_question')->where($data1)->get();
        $userId = Auth::user()->student_id;
        //    $question = response()->json(array('question' => $exam));


        return view('Startexam', compact('question', 'subject', 'time', 'id', 'userId'));
    }


    public function Order()
    {
        $admin = DB::table('admins')->where('id', Auth::user()->admin_id)->get();
        //  dump($admin);
        $prd_name = "Test Series";
        $price = $admin[0]->student_fee;

        if ($price == NULL) {
            $price = 100;
        }
        // Price calculation with tax and fee
        $fee = 3 + ($price * .02);
        $tax = 0;
        $prd_price = $fee + $tax + $price;
        return view('payment/order', compact('admin', 'prd_name', 'price', 'fee', 'tax', 'prd_price'));
    }


    public function Logout()
    {

        $admin_id = Auth::user()->admin_id;

        auth()->logout();

        session()->flash('message', 'goodbye');

        if ($admin_id)
            return redirect('/StudentLogin/' . $admin_id);
        return redirect('/login');
    }

    public function updateExamCount()
    {

        $examcode = Input::get('examcode');
        $studentid = Input::get('student_id');


        $examAttempt = ExamAttempt::where('student_id', $studentid)->where('examcode',$examcode)->first();
        if ($examAttempt == null) {
            $examAttempt = ExamAttempt::create(array('student_id' => $studentid, 'examcode' => $examcode, 'examattempt_count' => 1));
        } else {
            $examAttempt->examattempt_count = $examAttempt->examattempt_count + 1;
            $examAttempt->save();

        }

        return response()->json($examAttempt);

    }


    public function PrintAdmitCard()

    {

        $id =  Auth::user()->student_id;
        $students = User::where('student_id',$id)->first();

        //dd($students);
        $customPaper = array(0,0,567.00,283.80);
        return PDF::loadView('admit_card', compact('students'))->setPaper($customPaper)->stream();


    }



}

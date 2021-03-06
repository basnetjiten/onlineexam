<?php

namespace App\Http\Controllers;

use App\Aexam;
use App\ExamAttempt;
use App\nextLevelSubject;
use App\StudentAbility;
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

$subquest = null;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
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

        $exam = DB::table('exam_subject')
            ->leftJoin('exam', 'exam.examcode', '=', 'exam_subject.examcode')
            ->select('exam.*', 'exam_subject.*')
            ->where('exam_subject.admin_id', '=', Auth::user()->admin_id)
            ->get();


        $attemptedSubject = DB::table('next_level_subject')
            ->Join('exam_subject', 'exam_subject.id', '=', 'next_level_subject.subject_id')
            ->Join('exam', 'exam.examcode', '=', 'next_level_subject.examcode')
            ->select('exam_subject.*', 'exam.*')
            ->where('next_level_subject.student_id', '=', Auth::user()->student_id)
            ->get();


        /* $exam = DB::table('exam')
             ->Join('exam_subject', 'exam_subject.examcode', '=', 'exam.examcode')
             ->Join('users', 'users.student_id', '=', 'exam_subject.student_id')
             ->select('exam.*', 'exam_subject.*')
             ->where('exam_subject.student_id', '=', Auth::user()->student_id)
             ->where('exam_subject.student_id', '=', Auth::user()->student_id)
             ->get();*/


        // if ($created_dt->diffInDays($validity_dt, false) > 0 && Auth::user()->validity != null) {
        return view('home', compact('exam', 'attemptedSubject'));
        /* } else {
             return redirect('/order');
         }*/

    }

    public function ResultList()
    {
        $result = DB::table('exam_attempts')
            ->Join('exam', 'exam.examcode', '=', 'exam_attempts.examcode')
            ->Join('exam_subject', 'exam_subject.subject_id', '=', 'exam_attempts.subject_id')
            ->select('exam.*', 'exam_subject.*', 'exam_attempts.*')
            ->where('exam_attempts.student_id', '=', Auth::user()->student_id)
            ->get();
        // dd($result);


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
            ->select('result.student_id', 'users.name', 'users.allow_exam_review', 'result.givenmarks', 'exam_question.subject')
            ->where(['exam_question.subject_code' => $req->subject_id])//->sum('result.givenmarks');
            ->get();


        $exam_subject = DB::table('exam_subject')->where('subject_id', $req->subject_id)->get();

        return response()->json(array('result' => $result, 'exam_subject' => $exam_subject));
    }

    public function Get_Detail_Result(Request $req)
    {

        $question = DB::table('exam_question')
            ->where(['subject_code' => $req->subject_id])//->sum('result.givenmarks');
            ->get();

        $result = DB::table('exam_question')
            ->leftJoin('result', 'result.ques_id', '=', 'exam_question.id')
            ->select('result.*')
            ->where(['exam_question.subject_code' => $req->subject_id, 'result.student_id' => Auth::user()->student_id])
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

        //  $exam = DB::table('exam')->where($data)->get();
        $exam = DB::table('exam_subject')
            ->join('exam', 'exam.examcode', '=', 'exam_subject.examcode')
            ->select('exam_subject.*', 'exam.*')
            ->where(['exam.admin_id' => Auth::user()->admin_id, 'exam.publish' => 'Publish', 'category' => $req->val, 'exam_subject.subject_level' => 'level_one'])
            ->get();
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
            ['ques_id' => $req->ques_id, 'student_id' => Auth::user()->student_id,
                'selected_option' => $req->selected_option, 'givenmarks' => $req->givenmarks,
                'subject_id' => $req->subject_id]
        );

        // $exammark =Addquestion::where('$result',$result->ques_id)->get()

        /* $isCorrect = DB::table('result')
             ->join('exam_question','exam_question.id','=','result.ques_id')
             ->select('exam_question.marks')
             ->where(['result.student_id'=>Auth::user()->student_id]);*/
        //dd($result->ques_id);

        if ($result->givenmarks > 0) {

            $nextDifficultQuestion = DB::table('exam_question')
                ->select('exam_question.*')->where('exam_question.marks', $result->givenmarks + (2 / $result->count()))->get();
            // dd($nextDifficultQuestion);
            return response()->json(array($result, $nextDifficultQuestion));
        } else {
            $nextEasyQuestion = DB::table('exam_question')
                ->select('exam_question.*')->where('exam_question.marks', $result->givenmarks - (2 / $result->count()))->get();
            // dd($nextDifficultQuestion);
            return response()->json(array($result, $nextEasyQuestion));
        }


    }

    public function AttemptNewExam(Request $req)
    {
        //  $ref_result = new ref_result;

        $ref_result = ref_result::updateOrCreate(
            ['student_id' => Auth::user()->student_id, 'subject_id' => $req->subject_id, 'examcode' => $req->examcode]
        );
        //    $ref_result->student_id = Auth::user()->student_id;
        //    $ref_result->examcode = $req->examcode;
        //    $ref_result->save();
        return response()->json($ref_result);
    }

    //getting individual subject and question to be attempted by student
    public function startexam($id, $title, $tname, $time, $first_time, $examcode)
    {

        $data = [
            'admin_id' => Auth::user()->admin_id,
            'subject_id' => $id
        ];
        $data1 = [
            'owner_id' => Auth::user()->admin_id,
            'subject_code' => $id
        ];


        //sum the total difficulty level of the particular subject's question

        //pass only the subject id
        $subjectId = examsubject::where('subject_id', $id)->pluck('id')->first();
        //also pass only the exam id
        $examId = Aexam::where('examcode', $examcode)->pluck('id')->first();


        $userId = Auth::user()->student_id;

        //get question count for particular question
        $qCount = DB::table('exam_question')
            ->where('subject_code', '=', $id)
            ->count();
        $sumQuestionDiff = DB::table('exam_question')->where('subject_code', '=', $id)->sum('qdifficulty');

        $qmean = $qCount / $sumQuestionDiff;

        $ACCURACY = 0.7;
        //starting ability is between 90 - 95

        // random numbers
        $random = (float)rand() / (float)getrandmax();

        $ABILITY = $qmean - (0.5 + 0.5 * $random);
        // dd($ABILITY);

        $ABILITYRIGHT = $ABILITY + 1;
        $SE = $ACCURACY;

        $student = StudentAbility::where(['student_id' => Auth::user()->student_id])->first();
        if ($student != null) {
            $student->pability = $ABILITY;
            $student->subject_id = $id;
            $student->abilityright = $ABILITYRIGHT;
            $student->se = $SE;
            $student->save();

        }


        $subquest = DB::table('exam_question')
            ->join('exam_subject', 'exam_subject.subject_id', '=', 'exam_question.subject_code')
            ->leftJoin('result', 'result.ques_id', '=', 'exam_question.id')
            ->select('exam_subject.*', 'exam_question.*')
            ->whereNull('result.ques_id')
            ->where(['exam_question.examcode' => $examcode, 'exam_subject.subject_id' => $id])
            ->get()->toArray();

        if ($subquest == []) {

            DB::table('result')
                ->leftjoin('ref_result', 'ref_result.subject_id', '=', 'result.subject_id')
                ->select('result.*')
                ->where(['result.student_id' => Auth::user()->student_id])
                ->delete();

            return redirect()->back();


        } else {
            $subjectquestion = null;
            shuffle($subquest);
            for ($i = 0; $i < count($subquest); $i++) {
                $halfability = (($student->pability + $student->abilityright) * 0.1);
                $qhold = ABS($subquest[$i]->qdifficulty * 0.1 - $halfability);

                //dd("qdiff".$subquest[$i]->qdifficulty  .">=".$student->pability."qdiff".$subquest[$i]->qdifficulty * 0.1."<=".$student->abilityright);

                if (($subquest[$i]->qdifficulty * 0.1 >= $student->pability) && ($subquest[$i]->qdifficulty * 0.1 <= $student->abilityright)) {
                    $subjectquestion = $subquest[$i];
                    // dd($subjectquestion);

                } else if (ABS($subquest[$i]->qdifficulty * 0.1 - $halfability) < $qhold) {

                    $subjectquestion = $subquest[$i];
                } else {
                    $subjectquestion = $subquest[$i];
                }
            }


            // dd($subjectquestion);


            return view('Startexam', compact('id', 'examcode', 'subjectquestion', 'time', 'subjectId', 'examId', 'userId', 'first_time', 'student', 'halfability'));
        }
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
        $subjectid = Input::get('subject_id');
        $subjectPassed = Input::get('subject_passed');
        $subjectLevel = Input::get('subjectLevel');


        $examAttempt = ExamAttempt::where('student_id', $studentid)->where('examcode', $examcode)->where('subject_id', $subjectid)->first();
        if ($examAttempt == null) {
            $examAttempt = ExamAttempt::create(array('student_id' => $studentid, 'examcode' => $examcode, 'subject_level' => $subjectLevel, 'subject_id' => $subjectid, 'subject_passed' => $subjectPassed, 'examattempt_count' => 1));
        } else {
            $examAttempt->examattempt_count = $examAttempt->examattempt_count + 1;
            $examAttempt->subject_passed = $subjectPassed;
            $examAttempt->save();

        }

        return response()->json($examAttempt);

    }


    public function nextLevelSubject()
    {

        $examcode = Input::get('examcode');
        $studentid = Input::get('student_id');
        $subjectid = Input::get('subject_id');
        $subjectLevel = Input::get('subjectLevel');
        if ($subjectLevel == "level_one") {
            $nextLevelSubject = nextLevelSubject::updateOrCreate(array('student_id' => $studentid, 'examcode' => $examcode, 'subject_level' => "level_two", 'subject_id' => $subjectid + 1));
            return response()->json($nextLevelSubject);
        }

        if ($subjectLevel == "level_two") {
            $nextLevelSubject = nextLevelSubject::updateOrCreate(array('student_id' => $studentid, 'examcode' => $examcode, 'subject_level' => "level_three", 'subject_id' => $subjectid + 1));
            return response()->json($nextLevelSubject);
        }

        if ($subjectLevel == "level_three") {
            $nextLevelSubject = nextLevelSubject::updateOrCreate(array('student_id' => $studentid, 'examcode' => $examcode, 'subject_level' => "level_four", 'subject_id' => $subjectid + 1));
            return response()->json($nextLevelSubject);
        }

        if ($subjectLevel == "level_four") {
            $nextLevelSubject = nextLevelSubject::updateOrCreate(array('student_id' => $studentid, 'examcode' => $examcode, 'subject_level' => "level_five", 'subject_id' => $subjectid + 1));
            return response()->json($nextLevelSubject);
        }

        if ($subjectLevel == "level_five") {
            $nextLevelSubject = nextLevelSubject::updateOrCreate(array('student_id' => $studentid, 'examcode' => $examcode, 'subject_level' => "level_completed", 'subject_id' => $subjectid + 1));
            return response()->json($nextLevelSubject);
        }


    }


    public function PrintAdmitCard()

    {

        $id = Auth::user()->student_id;
        $students = User::where('student_id', $id)->first();

        //dd($students);
        $customPaper = array(0, 0, 567.00, 283.80);
        return PDF::loadView('admit_card', compact('students'))->setPaper($customPaper)->stream();


    }


    public function FetchNextLevelQuestionBasedOnThisRequest(Request $req)
    {

        $hasPassedOrFailedResult = DB::table('result')
            ->join('exam_question', 'result.ques_id', '=', 'exam_question.id')
            ->join('users', 'users.student_id', '=', 'result.student_id')
            ->select('result.student_id', 'users.name', 'users.allow_exam_review', 'result.givenmarks', 'exam_question.subject', 'exam_question.id')
            ->where(['exam_question.examcode' => $req->examcode])//->sum('result.givenmarks');
            ->get();


        //$exam_subject = DB::table('exam_subject')->where('examcode', $req->examcode)->get();

        return response()->json(array('level_result' => $hasPassedOrFailedResult));
    }


    public function UpdateSubjectLevel()
    {

        $subjectType = Input::get('subject_type');
        $subjectId = Input::get('subject_id');


        if ($subjectType == "h1") {
            $examSubject = examsubject::find($subjectId + 1)->where('subject_type', "h2")->first();
            $examSubject->subject_level = "next_level";
            $examSubject->update();
            return response()->json($examSubject);
        }

        if ($subjectType == "h2") {
            $examSubject = examsubject::find($subjectId + 1)->where('subject_type', "h3")->first();
            $examSubject->subject_level = "next_level";
            $examSubject->update();
            return response()->json($examSubject);
        }

        if ($subjectType == "h3") {
            $examSubject = examsubject::find($subjectId + 1)->where('subject_type', "h4")->first();
            $examSubject->subject_level = "next_level";
            $examSubject->update();
            return response()->json($examSubject);
        }

        if ($subjectType == "h4") {
            $examSubject = examsubject::find($subjectId + 1)->where('subject_type', "h5")->first();
            $examSubject->subject_level = "next_level";
            $examSubject->update();
            return response()->json($examSubject);
        }


    }


    public function UpdateStudentAbility(Request $req)
    {


        $ability = StudentAbility::where(['student_id' => Auth::user()->student_id])->first();
        if ($ability != null) {
            $ability->pability = round($req->pability, 5);
            $ability->subject_id = $req->subjectId;
            $ability->abilityright = round($req->abilityright, 5);
            $ability->se = round($req->se, 5);
            $ability->save();

        }


        return response()->json($ability);


    }


    public function CountQuestionAsked(Request $request)
    {

        $qasked = DB::table('result')
            ->join('exam_question', 'exam_question.id', '=', 'result.ques_id')
            ->select('result.*', 'exam_question.qdifficulty')
            ->where(['result.student_id' => Auth::user()->student_id])
            ->get();


        return response()->json([$qasked]);
    }

    public function CheckCorrectAnswer(Request $request)
    {


        $iscorrectAnswer = DB::table('result')
            ->select('result.*')
            ->where(['result.student_id' => Auth::user()->student_id, 'result.ques_id' => $request->ques_id])
            ->get();

        // dd($iscorrectAnswer);

        return response()->json([$iscorrectAnswer]);


    }

    public function fetchNextQuestion(Request $req)
    {

        $student = StudentAbility::where(['student_id' => Auth::user()->student_id])->first();
        $subquest = DB::table('exam_question')
            ->join('exam_subject', 'exam_subject.subject_id', '=', 'exam_question.subject_code')
            ->leftJoin('result', 'result.ques_id', '=', 'exam_question.id')
            ->select('exam_subject.*', 'exam_question.*')
            ->whereNull('result.ques_id')
            ->where(['exam_question.examcode' => $req->examCode, 'exam_subject.subject_id' => $req->subjectId])
            ->get()->toArray();


        $subjectquestion = null;
        shuffle($subquest);
        for ($i = 0; $i < count($subquest); $i++) {
            $halfability = (($student->pability + $student->abilityright) * 0.1);
            $qhold = ABS($subquest[$i]->qdifficulty * 0.1 - $halfability);

            //dd("qdiff".$subquest[$i]->qdifficulty  .">=".$student->pability."qdiff".$subquest[$i]->qdifficulty * 0.1."<=".$student->abilityright);

            if (($subquest[$i]->qdifficulty * 0.1 >= $student->pability) && ($subquest[$i]->qdifficulty * 0.1 <= $student->abilityright)) {
                $subjectquestion = $subquest[$i];
                // dd($subjectquestion);

            } else if (ABS($subquest[$i]->qdifficulty * 0.1 - $halfability) < $qhold) {

                $subjectquestion = $subquest[$i];
            } else {
                $subjectquestion = $subquest[$i];
            }
        }

        return response()->json([$subjectquestion]);
    }


    public function StudentInitialAbility(Request $req)
    {

        $studentAbility = StudentAbility::updateOrCreate(
            ['student_id' => $req->student_id, 'subject_id'=>"none",'pability' => $req->pability, 'abilityright' => $req->abilityright, 'se' => $req->se]
        );
        return response()->json($studentAbility);
    }


}

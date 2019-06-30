<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Student;
use App\Aexam;
use App\category;
use Illuminate\Support\Facades\input;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Admin;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Artisan;
use App;



class Addexam extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin');
    }

    public function Add_Exam(Request $req)
    {

        $validator = Validator::make($req->all(), [
            'tname' => 'required',
            'examtime' => 'required',
            'category' => 'required',
            'examtitle' => 'required',
            'examattempt' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->errors()));
        } else {
            $exam = new Aexam;
            $exam->tname = $req->tname;
            $exam->examcode = md5(microtime());
            $exam->examtitle = $req->examtitle;
            $exam->admin_id = $req->admin_id;
            $exam->admin_email = $req->admin_email;
            $exam->category = $req->category;
            $exam->random = 1;
            $exam->examtime = $req->examtime;
            $exam->examattempt = $req->examattempt;
            $exam->save();

            return response()->json($exam);
        }

    }

    public function Update_Exam(Request $req)
    {

        $validator = Validator::make($req->all(), [
            'tname' => 'required',
            'examtime' => 'required',
            'category' => 'required',
            'examtitle' => 'required',
            'examattempt' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->errors()));
        } else {
            $exam = new Aexam;
            $exam->tname = $req->tname;
            $exam->examcode = md5(microtime());
            $exam->examtitle = $req->examtitle;
            $exam->admin_id = $req->admin_id;
            $exam->admin_email = $req->admin_email;
            $exam->category = $req->category;
            $exam->random = 1;
            $exam->examtime = $req->examtime;
            $exam->examattempt = $req->examattempt;
            $exam->save();

            return response()->json($exam);
        }

    }
}

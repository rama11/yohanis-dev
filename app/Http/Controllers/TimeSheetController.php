<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;

use App\User;
use App\TimeSheet;
use App\CustomerID;
use App\CustomerPID;

class TimeSheetController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('time-sheet.index');
    }

    public function getData(Request $req){
        $data = TimeSheet::select(
                'time_sheet.*',
                'customer_id.code',
                'customer_pid.pid',
                DB::raw("`users`.`name` AS `pic`"),
                DB::raw("DATE_FORMAT(`time_sheet`.`execute_at`, '%Y%m%d') AS `execute_at_sort`")
            )
            ->join('customer_id','customer_id.id','=','time_sheet.id_customer')
            ->join('customer_pid','customer_pid.id','=','time_sheet.id_pid')
            ->join('users','users.id','=','time_sheet.id_user');

        if(Auth::user()->roles != "Supervisor"){
            $data->where('id_user',$req->id_user);
        }
        return array('data' => $data->get());
    }

    public function getParameter(){
        return collect([
            'PIC' => User::select('id',DB::raw('`name` AS `text`'))->get(),
            'customer' => CustomerID::select('id',DB::raw('CONCAT(`customer_id`.`code`," - ",`customer_id`.`customer_name`) AS `text`'))->get(),
            'PID' => CustomerPID::select(
                    'customer_pid.id',
                    DB::raw('CONCAT(`customer_id`.`code`," - ",`customer_pid`.`pid`) AS `text`'))
                ->join('customer_id','customer_id.id','=','customer_pid.id_customer')
                ->get()
        ]);
    }

    public function getParameterPID(Request $req){
        return collect([
            'PID' => CustomerPID::select(
                    'customer_pid.id',
                    DB::raw('CONCAT(`customer_id`.`code`," - ",`customer_pid`.`pid`) AS `text`'))
                ->join('customer_id','customer_id.id','=','customer_pid.id_customer')
                ->where('customer_pid.id_customer','=',$req->id_customer)
                ->get()
        ]);
    }

    public function addActivity(Request $req){
        $newActivity = new TimeSheet();

        $newActivity->id_customer = $req->addCustomerID;
        $newActivity->id_pid = $req->addPID;
        $newActivity->id_user = $req->addUser;
        $newActivity->activity = $req->addDescription;
        $newActivity->site = $req->addSiteLocation;
        $newActivity->duration = $req->addDuration;
        $newActivity->duration_num = $this->choseDurationNum($req->addDuration);
        $newActivity->status = $req->addStatus;
        $newActivity->approved = "Not-yet";
        $newActivity->submited = "Not-yet";
        $newActivity->execute_at = Carbon::parse($req->addDateTime)->toDateTimeString();
        // $newActivity->submited_at = Carbon::now()->toDateTimeString();

        // sleep(5);

        $newActivity->save();
    }

    public function deleteActivity(Request $req){
        $deleteActivity = TimeSheet::find($req->id_activity);

        $deleteActivity->delete();
    }

    public function getDataUnsubmited(Request $req){
        return TimeSheet::where('id_user',$req->id_user)
            ->select('time_sheet.*','customer_id.code','customer_pid.pid')
            ->join('customer_id','customer_id.id','=','time_sheet.id_customer')
            ->join('customer_pid','customer_pid.id','=','time_sheet.id_pid')
            ->where('submited','=','Not-yet')
            ->get();
    }

    public function getActivityEdit(Request $req){
        return TimeSheet::find($req->id_activity);
    }

    public function editActivity(Request $req){
        $editActivity = TimeSheet::find($req->id_activity);

        $editActivity->id_customer = $req->editCustomerID;
        $editActivity->id_pid = $req->editPID;
        $editActivity->id_user = $req->editUser;
        $editActivity->activity = $req->editDescription;
        $editActivity->site = $req->editSiteLocation;
        $editActivity->duration = $req->editDuration;
        $editActivity->duration_num = $this->choseDurationNum($req->editDuration);
        $editActivity->status = $req->editStatus;
        $editActivity->approved = "Not-yet";
        $editActivity->submited = "Not-yet";
        $editActivity->execute_at = Carbon::parse($req->editDateTime)->toDateTimeString();
        // $editActivity->submited_at = Carbon::now()->toDateTimeString();

        // sleep(5);

        $editActivity->save();
    }

    public function submitActivity(Request $req){
        return TimeSheet::where('id_user',$req->id_user)
            ->where('submited','=','Not-yet')
            // ->get();
            ->update(['submited' => 'Submited','submited_at' => Carbon::now()->toDateTimeString()]);
    }

    public function getDataUnapproved(){
        return TimeSheet::select(
                'time_sheet.*',
                'customer_id.code',
                'customer_pid.pid',
                DB::raw("`users`.`name` AS `pic`"),
                DB::raw("CONCAT(DATE_FORMAT(`submited_at`, '%e-%M-%Y'),' - ',`users`.`name`) AS `submited_pic`")
            )
            ->join('customer_id','customer_id.id','=','time_sheet.id_customer')
            ->join('customer_pid','customer_pid.id','=','time_sheet.id_pid')
            ->join('users','users.id','=','time_sheet.id_user')
            ->where('submited','=','Submited')
            ->where('approved','=','Not-yet')
            ->orderBy('submited_at','DESC')
            ->get()
            ->groupBy('submited_pic');
    }

    public function approveAllActivity(Request $req){
        $explode = explode(' - ',$req->parameter);
        $userID = User::where('name','=',$explode[1])->first()->id;

        return TimeSheet::where('id_user','=',$userID)
            ->where('submited_at','LIKE',Carbon::parse($explode[0])->format("Y-m-d") . "%")
            ->update(['approved' => 'Approved','approve_at' => Carbon::now()->toDateTimeString()]);
    }

    public function commentActivity(Request $req){
        return TimeSheet::where('id','=',$req->id_activity)
            ->update(['comment' => $req->comment]);
    }

    public function getCommentActivity(Request $req){
        $comment = TimeSheet::where('id','=',$req->id_activity)
            ->first()
            ->comment;
        return $comment == "" ? "No Comment" : $comment;
    }

    public function choseDurationNum($duration){
        if($duration == "1 Hari / Lebih") {
            return 1.00;
        } else if($duration == "7 Jam") {
            return 0.88;
        } else if($duration == "6 Jam") {
            return 0.75;
        } else if($duration == "5 Jam") {
            return 0.63;
        } else if($duration == "4 Jam") {
            return 0.50;
        } else if($duration == "3 Jam") {
            return 0.38;
        } else if($duration == "2 Jam") {
            return 0.25;
        } else if($duration == "1 Jam") {
            return 0.13;
        } else if($duration == "30 Menit") {
            return 0.06;
        } else if($duration == "15 Menit"){
            return 0.03;
        }
    }
}

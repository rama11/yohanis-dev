<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TimeSheet;
use App\CustomerPID;
use Auth;
use App\User;
use DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('dashboard.index');
    }

    public function getData(Request $req){
        $color = [
            "#00bcd4",
            "#f44336",
            "#ff9800",
            "#4caf50"
        ];

        if($req->type == "Manager"){
            $dataByIdProject = CustomerPID::joinSub(TimeSheet::selectRaw('COUNT(*) AS `counted`')
                    ->selectRaw('`id_pid`')
                    ->groupBy('id_pid'),'time_sheet_counted',function($join){
                        $join->on('time_sheet_counted.id_pid','=','customer_pid.id');
                    })
                ->orderBy('time_sheet_counted.counted','DESC')
                ->limit(4)
                ->get();

            $dataBySite = TimeSheet::selectRaw('COUNT(*) AS `counted`')
                ->selectRaw('`site`')
                ->groupBy('site')
                ->get();

            $dataByIdProjectYear = TimeSheet::selectRaw('COUNT(*) AS `counted`')
                ->selectRaw("DATE_FORMAT(`execute_at`, '%Y-%m') AS `month`")
                ->groupBy(DB::raw("DATE_FORMAT(`execute_at`, '%Y-%m')"))
                ->orderBy('month','DESC')
                ->limit(6)
                ->get();

            foreach($dataByIdProjectYear as $data){
                $data->month_formated = Carbon::parse($data->month)->format("M");
            }

            $dataOveralMandays = TimeSheet::selectRaw('ROUND(SUM(`duration_num`), 2) AS `sum_duration`')
                ->selectRaw("DATE_FORMAT(`execute_at`, '%Y-%m') AS `month`")
                ->orderBy('month','DESC')
                ->limit(6)
                ->groupBy(DB::raw("DATE_FORMAT(`execute_at`, '%Y-%m')"))
                ->get();

            foreach($dataOveralMandays as $data){
                $data->month_formated = Carbon::parse($data->month)->format("M");
            }

            // $top_3 = TimeSheet::selectRaw('ROUND(SUM(`duration_num`), 2) AS `sum_duration`,`id_user`')
            //     ->groupBy('id_user')
            //     ->orderBy('sum_duration','DESC')
            //     ->limit(3)
            //     ->get()
            //     ->pluck('id_user');
            $perRoles = User::selectRaw('DISTINCT `roles`')->pluck('roles');
            // return $perRoles;

            $allDataOveralMandays = [];

            array_push($allDataOveralMandays,array_reverse($dataOveralMandays->pluck('sum_duration')->toArray()));

            // foreach($top_3 as $data){
            foreach($perRoles as $data){
                // $dataOveralMandaysPerUser = TimeSheet::where('id_user','=',$data)
                $dataOveralMandaysPerUser = TimeSheet::where('users.roles','=',$data)
                    ->join('users','time_sheet.id_user','=','users.id')
                    ->selectRaw('ROUND(SUM(`duration_num`), 2) AS `sum_duration`')
                    ->selectRaw("DATE_FORMAT(`execute_at`, '%Y-%m') AS `month`")
                    ->orderBy('month','DESC')
                    ->limit(6)
                    ->groupBy(DB::raw("DATE_FORMAT(`execute_at`, '%Y-%m')"))
                    ->get();

                array_push($allDataOveralMandays,array_reverse($dataOveralMandaysPerUser->pluck('sum_duration')->toArray()));
            }

            // return $allDataOveralMandays;

            $dataMonthlyMandays = TimeSheet::where('id_user','=',Auth::user()->id)
                ->selectRaw('ROUND(SUM(`duration_num`), 2) AS `sum_daily`')
                ->selectRaw("DATE_FORMAT(`execute_at`, '%m-%d') AS `date`")
                ->whereRaw('DATE_FORMAT(`execute_at`,"%Y-%m") = "2021-12"')
                ->groupBy(DB::raw("DATE_FORMAT(`execute_at`, '%m-%d')"))
                ->get();

            // foreach($dataMonthlyMandays as $data){
            //     $data->month_formated = Carbon::parse($data->date)->format("M");
            // }

            // return $dataMonthlyMandays;

            $allDataOveralMandaysLegend = $perRoles->toArray();
            array_unshift($allDataOveralMandaysLegend, "All");
            // return $allDataOveralMandaysLegend;

            return collect([
                "dataByIdProject" => [
                    "label" => $dataByIdProject->pluck('pid'),
                    "series" => $dataByIdProject->pluck('counted'),
                    "color" => $color
                ],
                "dataBySite" => [
                    "label" => $dataBySite->pluck('site'),
                    "series" => $dataBySite->pluck('counted'),
                    "color" => $color
                ],
                "dataByIdProjectYear" => [
                    "label" => array_reverse($dataByIdProjectYear->pluck('month_formated')->toArray()),
                    "series" => [
                        array_reverse($dataByIdProjectYear->pluck('counted')->toArray()),
                    ]
                ],
                "dataOveralMandays" => [
                    "label" => array_reverse($dataOveralMandays->pluck('month_formated')->toArray()),
                    "series" => $allDataOveralMandays,
                    "legend" => $allDataOveralMandaysLegend
                ],
                "dataMonthlyMandays" => [
                    "label" => $dataMonthlyMandays->pluck('date'),
                    "series" => [
                        $dataMonthlyMandays->pluck('sum_daily')
                    ]
                ],
            ]);
        } else {
            $dataByIdProject = CustomerPID::joinSub(TimeSheet::where('id_user','=',Auth::user()->id)
                    ->selectRaw('COUNT(*) AS `counted`')
                    ->selectRaw('`id_pid`')
                    ->groupBy('id_pid'),'time_sheet_counted',function($join){
                        $join->on('time_sheet_counted.id_pid','=','customer_pid.id');
                    })
                ->orderBy('time_sheet_counted.counted','DESC')
                ->limit(4)
                ->get();

            $dataBySite = TimeSheet::where('id_user','=',Auth::user()->id)
                ->selectRaw('COUNT(*) AS `counted`')
                ->selectRaw('`site`')
                ->groupBy('site')
                ->get();

            $dataByIdProjectYear = TimeSheet::where('id_user','=',Auth::user()->id)
                ->selectRaw('COUNT(*) AS `counted`')
                ->selectRaw("DATE_FORMAT(`execute_at`, '%Y-%m') AS `month`")
                ->orderBy('month','DESC')
                ->limit(6)
                ->groupBy(DB::raw("DATE_FORMAT(`execute_at`, '%Y-%m')"))
                ->get();

            foreach($dataByIdProjectYear as $data){
                $data->month_formated = Carbon::parse($data->month)->format("M");
            }

            $dataOveralMandays = TimeSheet::where('id_user','=',Auth::user()->id)
                ->selectRaw('ROUND(SUM(`duration_num`), 2) AS `sum_duration`')
                ->selectRaw("DATE_FORMAT(`execute_at`, '%Y-%m') AS `month`")
                ->groupBy(DB::raw("DATE_FORMAT(`execute_at`, '%Y-%m')"))
                ->get();

            foreach($dataOveralMandays as $data){
                $data->month_formated = Carbon::parse($data->month)->format("M");
            }

            $dataMonthlyMandays = TimeSheet::where('id_user','=',Auth::user()->id)
                ->selectRaw('ROUND(SUM(`duration_num`), 2) AS `sum_daily`')
                ->selectRaw("DATE_FORMAT(`execute_at`, '%m-%d') AS `date`")
                // ->whereRaw('DATE_FORMAT(`execute_at`,"%Y-%m") = "' . Carbon::now()->format("Y-m") . '"')
                ->orderBy('date','DESC')
                ->groupBy(DB::raw("DATE_FORMAT(`execute_at`, '%m-%d')"))
                ->limit(10)
                ->get();

            // foreach($dataMonthlyMandays as $data){
            //     $data->month_formated = Carbon::parse($data->date)->format("M");
            // }

            // return $dataMonthlyMandays;

            return collect([
                "dataByIdProject" => [
                    "label" => $dataByIdProject->pluck('pid'),
                    "series" => $dataByIdProject->pluck('counted'),
                    "color" => $color
                ],
                "dataBySite" => [
                    "label" => $dataBySite->pluck('site'),
                    "series" => $dataBySite->pluck('counted'),
                    "color" => $color
                ],
                "dataByIdProjectYear" => [
                    "label" => array_reverse($dataByIdProjectYear->pluck('month_formated')->toArray()),
                    "series" => [
                        array_reverse($dataByIdProjectYear->pluck('counted')->toArray()),
                    ]
                ],
                "dataOveralMandays" => [
                    "label" => $dataOveralMandays->pluck('month_formated'),
                    "series" => [
                        $dataOveralMandays->pluck('sum_duration')
                    ]
                ],
                "dataMonthlyMandays" => [
                    "label" => array_reverse($dataMonthlyMandays->pluck('date')->toArray()),
                    "series" => [
                       array_reverse($dataMonthlyMandays->pluck('sum_daily')->toArray())
                    ]
                ],
            ]);
        }
    }
}

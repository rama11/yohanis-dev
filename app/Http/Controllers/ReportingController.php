<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\TimeSheet;
use App\CustomerID;
use App\CustomerPID;
use DB;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ReportingController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('reporting.index');
    }

    public function getParameter(){
        return collect([
            "user" => User::select('id',DB::raw('CONCAT(`roles`," - ",`name`) AS `text`'))->get(),
            "customer" => CustomerID::select('id',DB::raw('CONCAT(`code`," - ",`customer_name`) AS `text`'))->get(),
            "customerID" => CustomerPID::select('id',DB::raw('CONCAT(`pid`) AS `text`'))->get()
        ]);
    }

    public function generateReportUser(Request $req){

        $user = User::find($req->reportUserSelected);
        $data = TimeSheet::where('id_user',$req->reportUserSelected)
            ->select(
                // 'time_sheet.id',
                'time_sheet.execute_at',
                'customer_id.code',
                'customer_pid.pid',
                'time_sheet.activity',
                'time_sheet.site',
                'time_sheet.duration',
                'time_sheet.status'
            )
            ->join('customer_id','customer_id.id','=','time_sheet.id_customer')
            ->join('customer_pid','customer_pid.id','=','time_sheet.id_pid')
            ->get();

        $nameReport = 'Report by User - ' . $user->name;
        $nameTittle = 'Report by User';

        // return $data;
        return $this->generateExcel($data,$nameReport,$nameTittle);
        
    }

    public function generateReportCustomer(Request $req){

        $customer = CustomerID::find($req->reportCustomerSelected);
        $data = TimeSheet::where('time_sheet.id_customer',$req->reportCustomerSelected)
            ->select(
                // 'time_sheet.id',
                'time_sheet.execute_at',
                'customer_id.code',
                'customer_pid.pid',
                'time_sheet.activity',
                'time_sheet.site',
                'time_sheet.duration',
                'time_sheet.status',
                'time_sheet.approved'
            )
            ->join('customer_id','customer_id.id','=','time_sheet.id_customer')
            ->join('customer_pid','customer_pid.id','=','time_sheet.id_pid')
            ->get();

        $nameReport = 'Report by Customer - ' . $customer->code . ' - ' . $customer->customer_name;
        $nameTittle = 'Report by Customer';

        // return $data;
        return $this->generateExcel($data,$nameReport,$nameTittle);
        
    }

    public function generateReportCustomerID(Request $req){

        $customerID = CustomerPID::find($req->reportCustomerIDSelected);
        $data = TimeSheet::where('time_sheet.id_pid',$req->reportCustomerIDSelected)
            ->select(
                // 'time_sheet.id',
                'time_sheet.execute_at',
                'customer_id.code',
                'customer_pid.pid',
                'time_sheet.activity',
                'time_sheet.site',
                'time_sheet.duration',
                'time_sheet.status',
                'time_sheet.approved'
            )
            ->join('customer_id','customer_id.id','=','time_sheet.id_customer')
            ->join('customer_pid','customer_pid.id','=','time_sheet.id_pid')
            ->get();

        $nameReport = 'Report by Customer - ' . $customerID->customerID->code . ' - ' . str_replace("/","_",$customerID->pid);
        $nameTittle = 'Report by Customer';

        // return $data;
        return $this->generateExcel($data,$nameReport,$nameTittle);
        
    }

    public function generateReportApproved(Request $req){

        // $customerID = CustomerPID::find($req->reportCustomerIDSelected);
        $data = TimeSheet::where('time_sheet.approved','approved')
            ->select(
                // 'time_sheet.id',
                'time_sheet.execute_at',
                'customer_id.code',
                'customer_pid.pid',
                'time_sheet.activity',
                'time_sheet.site',
                'time_sheet.duration',
                'time_sheet.status',
                'time_sheet.approved'
            )
            ->join('customer_id','customer_id.id','=','time_sheet.id_customer')
            ->join('customer_pid','customer_pid.id','=','time_sheet.id_pid')
            ->get();

        $nameReport = 'Report by Approved [' . str_replace("/","-",$req->reportApprovedStart) . ' - ' . str_replace("/","-",$req->reportApprovedEnd) .']';
        $nameTittle = 'Report by Approved';

        // return $data;
        return $this->generateExcel($data,$nameReport,$nameTittle);
        
    }

    public function generateExcel($data,$nameReport,$nameTittle){
        $spreadsheet = new Spreadsheet();

        $prSheet = new Worksheet($spreadsheet,$nameTittle);
        $spreadsheet->addSheet($prSheet);
        $spreadsheet->removeSheetByIndex(0);
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->mergeCells('A1:H1');
        $normalStyle = [
            'font' => [
                'name' => 'Calibri',
                'size' => 11
            ],
        ];

        $titleStyle = $normalStyle;
        $titleStyle['alignment'] = ['horizontal' => Alignment::HORIZONTAL_CENTER];
        $titleStyle['borders'] = ['outline' => ['borderStyle' => Border::BORDER_THIN]];
        $titleStyle['fill'] = ['fillType' => Fill::FILL_SOLID, 'startColor' => ["argb" => "FFFCD703"]];
        $titleStyle['font']['bold'] = true;

        $sheet->getStyle('A1:I1')->applyFromArray($titleStyle);
        $sheet->setCellValue('A1',$nameReport);

        $headerStyle = $normalStyle;
        $headerStyle['font']['bold'] = true;
        $sheet->getStyle('A2:I2')->applyFromArray($headerStyle);;


        $headerContent = ['#','Date','Customer','ID Project','Description Activity','Site Location','Duration','Status','Approved'];
        $sheet->fromArray($headerContent,NULL,'A2');

        foreach ($data as $key => $eachLead) {
            $sheet->fromArray(array_merge([$key + 1],array_values($eachLead->toArray())),NULL,'A' . ($key + 3));
        }

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        
        $fileName = $nameReport . ' ' . date('d-m-Y') . '.xlsx';

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $location = public_path() . '/report/' . $fileName;
        $writer->save($location);

        // return $writer->save('php://output');
        return url('report/' . $fileName);
    }
}

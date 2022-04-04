<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\CustomerID;
use App\CustomerPID;
use Hash;

class SettingController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('setting.index');
    }

    public function getUsers(){
        return array('data' => User::all());
    }

    public function getEachUser(Request $req){
        return User::find($req->id_user);
    }

    public function editUser(Request $req){
        $user = User::find($req->id_user);
        $user->name = $req->editFullname;
        $user->email = $req->editEmail;
        $user->roles = $req->editRoles;
        $user->save();

        return ;
    }

    public function deleteUser(Request $req){
        $customer = User::find($req->id_user);
        $customer->delete();
    }

    public function addUsers(Request $req){
        $user = new User();
        $user->name = $req->addFullname;
        $user->email = $req->addEmail;
        $user->roles = $req->addRoles;
        $user->password = Hash::make('asdasdasd');
        $user->save();

        return ;
    }

    public function getCustomer(){
        return array('data' => CustomerID::all());
    }

    public function getEachCustomer(Request $req){
        return CustomerID::find($req->id_customer);
    }

    public function editCustomer(Request $req){
        $customer = CustomerID::find($req->id_customer);
        $customer->code = $req->editAcronym;
        $customer->customer_name = $req->editCustomerName;
        $customer->save();
    }

    public function deleteCustomer(Request $req){
        $customer = CustomerID::find($req->id_customer);
        $customer->delete();
    }

    public function addCustomer(Request $req){
        $customer = new CustomerID();
        $customer->code = $req->addAcronym;
        $customer->customer_name = $req->addCustomerName;
        $customer->save();

        return ;
    }

    public function getCustomerID(){
        return array('data' => CustomerPID::with('customerID:id,code,customer_name')->get());
    }

    public function getEachCustomerID(Request $req){
        return CustomerPID::with('customerID:id,code,customer_name')->find($req->id_customerID);
    }

    public function editCustomerID(Request $req){
        $customerID = CustomerPID::find($req->id_customerID);
        $customerID->id_customer = $req->editCustomerID_ID;
        $customerID->pid = $req->editCustomerID_Customer;
        $customerID->save();
    }

    public function deleteCustomerID(Request $req){
        $customer = CustomerPID::find($req->id_customerID);
        $customer->delete();
    }

    public function addCustomerID(Request $req){
        $customerID = new CustomerPID();
        $customerID->id_customer = $req->addID;
        $customerID->pid = $req->addPID;
        $customerID->save();

        return ;
    }
}

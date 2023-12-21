<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result['data']=Customer::all();
        return view('admin/customer',$result);
    }


    public function show(Request $request,$id='')
    {
        $arr=Customer::where(['id'=>$id])->get();
        $result['customer_list']=$arr['0'];
        return view('admin/show_customer',$result);
    }

    public function status(Request $request,$status,$id){
        $model=Customer::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Customer status updated');
        return redirect('admin/customer');
    }
    public function store(Request $request){



        $request->validate([
            'name' => 'required',
            'email' => 'required | email| unique:customers',
            'mobile' => 'required|numeric',
            'password' => 'required'
        ]);
        $record = new Customer();
        $record->name = $request->input('name');
        $record->email = $request->input('email');
        $record->mobile = $request->input('mobile');
        $record->password =  Hash::make($request->input('password'));
        $rand_id = rand(111111111,999999999);
        $record->rand_id = $rand_id;


        $record->save();
        $data= ['name'=>$request->name, 'rand_id'=>$rand_id];
        $user['to'] = $request->email;
        Mail::send('front/email_verification', $data, function ($message) use ($user){
            $message->to($user['to']);
            $message->subject('Email ID verification');
        });
        session()->flash('success', 'Registration successful. Please check your email for verification');
        return redirect()->back()->withInput();
    }

    public function email_verification(Request $request, $id){
        $result = DB::table('customers')
            ->where(['rand_id' => $id])
            ->where(['is_verify'=>0])
            ->get();
        if (isset($result[0])){
            DB::table('customers')
                ->where(['id' => $result[0]->id])
                ->update(['is_verify' => 1, 'rand_id' => '']);
            return view('front.verification');
        }
        else{
            return redirect('/');
        }
    }

    public function forgot_process(Request $request){
        $result = DB::table('customers')
            ->where(['email' => $request->str_forgot_email])
            ->get();
        $rand_id = rand(111111111,999999999);

        if (isset($result[0])){

            DB::table('customers')
                ->where(['email'=>$request->str_forgot_email])
                ->update(['is_forgot_password'=>1, 'rand_id'=>$rand_id]);

            $data= ['name'=>$request->name, 'rand_id'=>$rand_id];
            $user['to'] = $request->str_forgot_email;
            Mail::send('front/forgot_password', $data, function ($message) use ($user){
                $message->to($user['to']);
                $message->subject('Forgot Password');
            });
            return response()->json(['status' => 'success', 'msg' => 'Please check your Email']);

        }
        else{
            return response()->json(['status' => 'error', 'msg' => 'Please enter a registered Email ID']);
        }
    }

    public function forgot_password_change(Request $request, $id){
        $result = DB::table('customers')
            ->where(['rand_id' => $id])
            ->where(['is_forgot_password'=>1])
            ->get();
        if (isset($result[0])){
            $request->session()->put('FORGOT_PASSWORD_USER_ID', $result[0]->id);
            return view('front.forgot_password_change');
        }
        else{
            return redirect('/');
        }
    }

    public function forgot_password_change_process(Request $request){
        DB::table('customers')
            ->where(['id' => $request->session()->get('FORGOT_PASSWORD_USER_ID')])
            ->update([
                'is_forgot_password' => 0,
                'password' => Hash::make($request->input('password')),
                'rand_id' => ''
            ]);
        return response()->json(['status' => 'success', 'msg' => 'Password Changed']);

    }
}

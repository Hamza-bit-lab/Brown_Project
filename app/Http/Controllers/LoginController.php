<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function login_process(Request $request)
    {
        $result = DB::table('customers')
            ->where(['email' => $request->str_login_email])
            ->get();

        if (isset($result[0])) {
            $db_pwd_check = Hash::check($request->str_login_password, $result[0]->password);
            $status = $result[0]->status;
            $is_verify = $result[0]->is_verify;

            if ($is_verify == 0) {
                return response()->json(['status' => "error", 'msg' => "Please Verify your Email first"]);
            }
            if ($status == 0) {
                return response()->json(['status' => "error", 'msg' => "Your account has been deactivated"]);
            }

            if ($db_pwd_check) {

                if ($request->rememberme === null) {
                    setcookie('login_email', $request->str_login_email, 100);
                    setcookie('login_pwd', $request->str_login_password, 100);
                } else {
                    setcookie('login_email', $request->str_login_email, time() + 60 * 60 * 24 * 100);
                    setcookie('login_pwd', $request->str_login_password, time() + 60 * 60 * 24 * 100);
                }


                $request->session()->put('FRONT_USER_LOGIN', true);
                $request->session()->put('FRONT_USER_ID', $result[0]->id);
                $request->session()->put('FRONT_USER_NAME', $result[0]->name);
                $status = "success";
                $msg = "";
                $getUserTempId = getUserTempId();
                DB::table('cart')
                    ->where(['user_id' => $getUserTempId, 'user_type' => 'Not-Reg'])
                    ->update([
                        'user_id' => $result[0]->id, 'user_type' => 'Reg'
                    ]);
            } else {
                $status = "error";
                $msg = "Please enter a valid password";
            }
        } else {
            $status = "error";
            $msg = "Please enter a valid email id";
        }
        return response()->json(['status' => $status, 'msg' => $msg]);

    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->forget('name');
        return redirect('/');
    }

    public function register(){
        return view('front.register');
    }

    public function login(){
        return view('front.login');
    }
}

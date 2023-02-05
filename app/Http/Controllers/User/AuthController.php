<?php

namespace App\Http\Controllers\User;
use App\Helpers\Message;
use App\Helpers\MailHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function login(Request $request){
        $user = User::where('name',$request->name)->first();
        if($user){
            if($user->status == 'block')
            {
            toastr()->error('You are Blocked,Kindly Contact Support');
            return redirect()->back();
             }
            //  if($user->email_verified == false)
            // {
            //     toastr()->error('Verify Your Account on Email Address');
            //     return redirect()->back();
            //  }
        }
        if(!$user){
            toastr()->error('Please register your account');
            return redirect()->back();
        }

        $creds = [
            'name' => $request->name,
            'password' => $request->password
        ];
        if(Auth::guard('user')->attempt($creds)){
            $user = Auth::guard('user')->user();
            if($user->total_referrals() >= 15000)
            {
                $user->update([
                    'type' =>'Senior Member'
                ]);
            }elseif($user->total_referrals() >= 50000){
                $user->update([
                    'type' =>'Leader'
                ]);
            }elseif($user->total_referrals() >= 100000){
                $user->update([
                    'type' =>'Senior Leader'
                ]);
            }elseif($user->total_referrals() >= 200000){
                $user->update([
                    'type' =>'Top Leader'
                ]);
            }
            $user->update([
                'last_login' => Carbon::today()
            ]);
            request()->session()->put('cash_wallet', $user->cash_wallet);
            request()->session()->put('name', $user->name);
            // toastr()->success('Login Successfully');
            return redirect('user/dashboard');
        } else {
            toastr()->error('Wrong Password','Please Contact Support');
            return redirect()->back();
            
        }
    }
    public function register(Request $request)
    {
        
        if($request->code)
        { 
            if($request->password != $request->confirm_password){
                toastr()->error('Password Dont Match');
                return redirect()->back()->withInput();
            }
            $image = $request->image->getClientOriginalExtension();
            if($image != "jpeg" && $image != "jpg" && $image != "png"){
                toastr()->error('Only Image File get Upload');
                return redirect()->back()->withInput();
            }
            $user= User::where('code',$request->code)->first();
            if($user){
            //     $user->balance+= (($user->package->r_earning/100)*$user->package->price);
            //     $user->save();
           
                $validator = Validator::make($request->all(),[
                    'name' => 'required|unique:users'
                ]);
                
                if($validator->fails()){
                    toastr()->error('Username  already exists');
                    return redirect()->back();
                }
                $new_user =  User::create([
                    'code' => uniqid(),
                    'verification' => uniqid(),
                    'refer_by' => $user->id,
                    'temp_password' => $request->password,
                ]+$request->all());
                
            }
        }else{
           $validator = Validator::make($request->all(),[
                'name' => 'required|unique:users'
            ]);

            if($validator->fails()){
                toastr()->error('Username  already exists');
                return redirect()->back();
            }
            toastr()->error('Contact Support.');
            return redirect()->back();
            // User::create([
            //     'left' => uniqid(),
            //     'right' => uniqid(),
            //     'balance' => 0,
            // ]+$request->all());
            
        }
        try {
            MailHelper::EmailVerified($new_user);
        } catch (\Exception $e) {
            info("Error in sending reminder email to $new_user->email " . $e->getMessage());
        }
        toastr()->success('Your Account Has Been successfully Created, Please Verify Your Email Account via Link.');
        return redirect(route('user.login'));
    }
    public function code($code)
    {
        $user= User::where('code',$code)->first();
        return view('user.auth.register')->with('code',$code)->with('user',$user);
    }
    public function logout()
    {
        
        request()->session()->forget('cash_wallet');
        request()->session()->forget('name');
        Auth::logout();
        // toastr()->success('You Logout Successfully');
        return redirect('/');
    }

    public function sendVerification(Request $request){
        $user = User::where('name',$request->email)->first();
        if(!$user){
            toastr()->error('User not found');
            return redirect()->back();
        }
        $user->verification = uniqid();
        $user->save();
        MailHelper::sendVerification($user);
        return redirect()->route('user.reset');
    } 
    public function resendEmail(Request $request){
        $user = User::where('name',$request->name)->first();
        if(!$user){
            toastr()->error('User not found');
            return redirect()->back();
        }
        if($user->email_verified == true){
            toastr()->error('Your Account is already Verified');
            return redirect()->back();
        }
        $user->verification = uniqid();
        $user->save();
        try {
            MailHelper::EmailVerified($user);
            toastr()->success('Email Send Successfully!');
            return redirect()->route('user.login');
        } catch (\Exception $e) {
            $error  =  $e->getmessage();
            info("Email Error $error");
            toastr()->error('Invalid Email Contact Support!!');
            return redirect()->back();
        }
     
    }
    public function VerifyAccount($code){
        $user = User::where('verification',$code)->first();
        if(!$user){
            toastr()->error('Invalid Input');
            return redirect()->back();
        }
        $user->update([
            'verification' => uniqid(),
            'email_verified' => true,
        ]);
        toastr()->success('Email Verify Successfully');
        return redirect()->route('user.login');
    }

    public function resetPassword(Request $request){
        $user = User::where('verification',$request->verfication)->first();
        if($user){
            $user->update([
                'password' => $request->password,
                'temp_password' => $request->password
            ]);
            toastr()->success('Password reset successfully');
            return redirect('user/login');
        } else {
            toastr()->error('Incorrect code');
            return redirect()->back();
        }
    }
    public function index(){
        return redirect('user/login');
    }

}

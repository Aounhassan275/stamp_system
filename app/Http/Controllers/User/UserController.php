<?php

namespace App\Http\Controllers\User;

use App\Helpers\MailHelper;
use App\Helpers\ReferralIncome;
use App\Helpers\UserHepler;
use App\Http\Controllers\Controller;
use App\Models\CompanyAccount;
use App\Models\Earning;
use App\Models\User;
use App\Models\UserImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = User::find($request->id);
        if($request->banner)
        {
            if($user->banner())
            {
                $banner_image = $user->images->where('name','Banner')->first();
                $banner_image->update([
                    'image' => $request->banner
                ]);
            }else{
                UserImages::create([
                    'name' => 'Banner',
                    'image' => $request->banner,
                    'user_id' => $user->id
                ]);
            }
            
        }         
        if($request->cnic_front)
        {
            if($user->cnicFront())
            {
                $cnic_front = $user->images->where('name','Cnic Front')->first();
                $cnic_front->update([
                    'image' => $request->cnic_front
                ]);
            }else{
                UserImages::create([
                    'name' => 'Cnic Front',
                    'image' => $request->cnic_front,
                    'user_id' => $user->id
                ]);
            }
            
        }      
        if($request->cnic_back)
        {
            if($user->cnicBack())
            {
                $cnic_back = $user->images->where('name','Cnic Back')->first();
                $cnic_back->update([
                    'image' => $request->cnic_back
                ]);
            }else{
                UserImages::create([
                    'name' => 'Cnic Back',
                    'image' => $request->cnic_back,
                    'user_id' => $user->id
                ]);
            }
            
        }      
        if($request->password)
        {
            $user->update([
                'password' => $request->password,
                'temp_password' => $request->password
            ]);
        }
        $request->merge(['hide_profile' => $request->hide_profile?1:0]);
        $user->update($request->except('password'));
        toastr()->success('Your Informations Updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    public function refer()
    {
        $user = Auth::user();
        if($user->checkStatus() == false)   
        {
          toastr()->success('Your Package is Expire');
           return redirect(route('user.dashboard.index'));
        }
        return view('user.refer.index')->with('user',$user);
    }
    public function emailVerification()
    {
        $user = Auth::user();
        if($user->email_verified == true){
            toastr()->error('Your Account is already Verified');
            return redirect()->back();
        }
        $user->verification = uniqid();
        $user->save();
        try {
            MailHelper::EmailVerified($user);
            toastr()->success('Email Send Successfully!');
            return redirect()->back();
        } catch (\Exception $e) {
            $error  =  $e->getmessage();
            info("Email Error $error");
            toastr()->error('Invalid Email Contact Support!!');
            return redirect()->back();
        }
    }
    public function transferFunds(Request $request)
    {
        $user = Auth::user();
        $amount = $request->cash_wallet + $request->community_pool;
        if($amount > $user->total_income)
        {
            return response()->json([
                'status' => false,
                'message' => 'Amount is greater than temp income'
            ]);
           
        }
        if($amount < 5)
        {
            return response()->json([
                'status' => false,
                'message' => 'Amount must be $ 5 or more'
            ]);
           
        }
        if($user->package->price >= 1000)
        {
            $amount_to_divide = $request->community_pool/2;
            $amount_for_packages = $amount_to_divide + $user->community_pool;
            $total_packages = $amount_for_packages/50;
            $total_packages = (int)$total_packages;
            $package_amount = $total_packages * 50;
            $community_amount = $amount_for_packages - $package_amount;
            info("Amount To Transfer For Community Pool $user->name : $amount_to_divide");
            ReferralIncome::CommunityPoolIncome($user,$amount_to_divide);
            if($total_packages > 0)
            {
                for($i = 0;$i < $total_packages;$i++)     
                {
                    UserHepler::CreateUser($user);
                }     
            }
            if($community_amount > 0)
            {
                $user->update([
                    'community_pool' =>  $community_amount,
                ]);
            }else{
                $user->update([
                    'community_pool' =>  0,
                ]);
            }
            info("Amount To Deduct From Total Amount $user->name  ($user->total_income) : $amount");
            $user->update([
                'cash_wallet' => $user->cash_wallet + $request->cash_wallet,
                'total_income' => $user->total_income - $amount
            ]);
        }else{
            $user->update([
                'cash_wallet' => $user->cash_wallet + $request->cash_wallet,
                // 'community_pool' =>  $user->community_pool +$request->community_pool,
                'investment_amount' =>  $user->investment_amount +$request->community_pool,
                'total_income' => $user->total_income - $amount
            ]);
            ReferralIncome::CommunityPoolIncome($user,$request->community_pool);
        }
        toastr()->success('Amount Transferred Successfully');
        return response()->json([
            'status' => true,
            'message' => 'Amount Transferred Successfully!!'
        ]);
    }
    
}
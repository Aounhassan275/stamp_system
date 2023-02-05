<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->type == 2) 
        {
            toastr()->warning('You dont have access');
            return redirect()->route('admin.dashboard.index');
        }else{
            return view('admin.employee.index');
        }
    }
    public function dashboard()
    {
        if(Auth::user()->type == 2) 
        {
            return view('admin.dashboard.employee');
        }else{
            return view('admin.dashboard.index');
        }
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
        Admin::create($request->all());
        toastr()->success('Employee Account is Created Successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $admin = Admin::find($id);
        if($request->password)
        {
            $admin->update([
                'password' => $request->password,
                'temp_password' => $request->password,
                'name' => $request->name,
                'email' => $request->email,
                'community_income' => $request->community_income,
                'new_arrival_income' => $request->new_arrival_income,
            ]);
        }else{
            $admin->update([
                'name' => $request->name,
                'email' => $request->email,
                'community_income' => $request->community_income,
                'new_arrival_income' => $request->new_arrival_income,
            ]);
        }
        toastr()->success('Employee Informations Updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        toastr()->success('Employee Account Deleted successfully');
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stamp;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class StampController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stamps = Stamp::all();
        return view('admin.stamp.index',compact('stamps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.stamp.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $total_stamp = Stamp::count() + 1;
            $request->merge([
                'stamp_id' => $request->stamp_id.''.$total_stamp,
            ]);
            if(!$request->issue_date)
            {
                $request->merge([
                    'issue_date' => Carbon::now(),
                    'validity_date' => date('Y-m-d', strtotime("+7 days")),
                ]);
            }else{
                $issue_date = $request->issue_date->format('Y-m-d');
                $request->merge([
                    'issue_date' => Carbon::now(),
                    'validity_date' => date($issue_date, strtotime("+7 days")),
                ]);
    
            }
            $stamp = Stamp::create($request->all());
            toastr()->success('Stamp Added Successfully');
            return redirect()->route('admin.stamp.show',$stamp->id);  
        }catch (Exception $e) {
            toastr()->error($e->getMessage());
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stamp  $stamp
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stamp = Stamp::find($id);
        $url = "https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=E-stamp-id:".
        $stamp->stamp_id."%0a Amount: ".$stamp->amount." Description: ".$stamp->description->name.
        " Applicant: ".$stamp->applicant." Issue Date: ".$stamp->issue_date->format('d-M-Y h:m:s A').
        " Validity Date: ".$stamp->validity_date->format('d-M-Y')." Agent: ".$stamp->agent." Status: VENDOR ISSUED Vendor Info: "
        .$stamp->vendor->name;
        return view('admin.stamp.show',compact('stamp','url'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stamp  $stamp
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stamp = Stamp::find($id);
        return view('admin.stamp.edit',compact('stamp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stamp  $stamp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $stamp = Stamp::find($id);
        $stamp->update($request->all());
        toastr()->success('Your Informations Updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stamp  $stamp
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stamp = Stamp::find($id);
        $stamp->delete();
        toastr()->success('Stamp Deleted successfully');
        return redirect()->back();
    }
}

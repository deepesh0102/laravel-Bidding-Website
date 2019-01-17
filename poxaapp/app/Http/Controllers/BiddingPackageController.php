<?php

namespace App\Http\Controllers;

use App\BiddingPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Auth;
use Config;
use DB;
use Log;

class BiddingPackageController extends Controller
{
    
    
    public function __construct() {
        $this->middleware('auth:admin');
    }

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $BiddingPackages = BiddingPackage::where(['is_delete'=>1])->get();
//        dd($BiddingPackages);
        $title ="Auctions";
        return view('admin.bidding.bidding_package_listing')->with(compact('BiddingPackages', 'title'))->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add Bidding Package';
        $button_title = 'Add Bidding Package';
        $action = URL::route('bidding.store');
        return view('admin.bidding.add_bidding_package')->with(compact('BiddingPackages', 'title', 'button_title', 'action'))->with('no', 1);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messsages = array(
		'name.required'=>'You cant leave name field empty',
		'price.required'=>'You cant leave price field empty',
		'number_of_bids.required'=>'You cant leave number of bids field empty',
                		
                );
                $rules = array(
		'name'=>'required',
		'price'=>'required',
		'number_of_bids'=>'required',
		
                );
                $validator = Validator::make($request->all(), $rules, $messsages);
                //server side errors
                if ($validator->fails()) {
                    return redirect()->route('bidding.create',['id'=>$id])
                                    ->withErrors($validator)
                                    ->withInput($request->name,$request->price);
                }
                
                $BiddingPackage = new BiddingPackage;
                $BiddingPackage->name = $request->name;
                $BiddingPackage->price = $request->price;
                $BiddingPackage->number_of_bids = $request->number_of_bids;
                if ($request->has('status')) {
                $BiddingPackage->status = $request->status;
                }
                $BiddingPackage->save();
                return redirect()->route('bidding.index')->with('flash_message_success','Bidding Package has been added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BiddingPackage  $biddingPackage
     * @return \Illuminate\Http\Response
     */
    public function show(BiddingPackage $biddingPackage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BiddingPackage  $biddingPackage
     * @return \Illuminate\Http\Response
     */
    public function edit(BiddingPackage $biddingPackage, $bidding_package_id)
    {
        $BiddingPackage = BiddingPackage::where(['id'=>$bidding_package_id])->first();
//        dd($BiddingPackage);
        $title = 'Edit Bidding Package';
        $button_title = 'Update Bidding Package';
        $action = URL::route('bidding.update', ['bidding_package_id'=>$bidding_package_id]);
        return view('admin.bidding.add_bidding_package')->with(compact('BiddingPackage', 'button_title', 'title', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BiddingPackage  $biddingPackage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BiddingPackage $biddingPackage, $bidding_package_id)
    {
        $messsages = array(
		'name.required'=>'You cant leave Start Month field empty',
		'price.required'=>'You cant leave Start Days field empty',
                'number_of_bids.required'=>'You cant leave number of bids field empty',		
                );
                $rules = array(
		'name'=>'required',
		'price'=>'required',
                'number_of_bids'=>'required',
		
                );
                $validator = Validator::make($request->all(), $rules, $messsages);
                //server side errors
                if ($validator->fails()) {
                    return redirect()->route('bidding.edit',['id'=>$bidding_package_id])
                                    ->withErrors($validator)
                                    ->withInput([$request->name,$request->price]);
                }
                if (!$request->has('status')) {
                $status = 0;
                } else {
                $status = $request->status;
                }
                BiddingPackage::where(['id' => $bidding_package_id])->update(['name' => $request->name, 'price' => $request->price, 'number_of_bids' => $request->number_of_bids, 'status'=>$status]);
                return redirect()->route('bidding.index')->with('flash_message_success','Bidding Package updated successfully!');
            
                
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BiddingPackage  $biddingPackage
     * @return \Illuminate\Http\Response
     */
    public function destroy(BiddingPackage $biddingPackage, Request $request, $bidding_package_id)
    {
        if (!empty($bidding_package_id)) {
            BiddingPackage::where(['id' => $bidding_package_id])->update(['is_delete' => 0]);
            return redirect()->back()->with('flash_message_success', 'Bidding Package deleted Successfully!');
        }
         return redirect()->back()->with('flash_message_success', 'Something Went Wrong!');
    }
}

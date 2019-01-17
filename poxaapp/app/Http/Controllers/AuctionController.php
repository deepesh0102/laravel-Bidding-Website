<?php

namespace App\Http\Controllers;

use App\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Auth;
use Session;
use Image;
use App\Category;
use App\Product;
use App\bidingHistories;
use Config;
use DB;
use Log;
use DateTime;

class AuctionController extends Controller
{
    
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
       $auctions = Auction::where(['is_delete'=>1, 'product_id'=>$id])->with([
           'product'=> function($q){
            $q->select('id','product_name','category_id');
           },
           'product.category'=> function ($query){
               
               $query->select('id','name');
            }
           ])->get();
           $product_name = Product::where(['id'=>$id])->select('product_name')->first();
           $title ="Auctions";
//       dd($products);
        return view('admin.auctions.view_auctions')->with(compact('auctions','product_name', 'title'))->with('no', 1);
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
    public function store(Request $request, $id = 'null')
    {
       
//        echo Config::get('constants.base_path'); exit();
    	if($request->isMethod('post')){
            
                $messsages = array(
		'smonth.required'=>'You cant leave Start Month field empty',
		'sdays.required'=>'You cant leave Start Days field empty',
                'syear.required'=>'You cant leave Start Years field empty',
		'shours.required'=>'You cant leave Start Hours field empty',
		'smin.required'=>'You cant leave Start Minutes field empty',
                'ssec.required'=>'You cant leave Start Seconds field empty',
		'emonth.required'=>'You cant leave End Month field empty',
		'edays.required'=>'You cant leave End Days field empty',
                'eyear.required'=>'You cant leave End Years field empty',
		'ehours.required'=>'You cant leave End Hours field empty',
		'emin.required'=>'You cant leave End Minutes field empty',
                'esec.required'=>'You cant leave End Seconds field empty',
		
                );
                $rules = array(
		'smonth'=>'required',
		'sdays'=>'required',
		'syear'=>'required',
		'shours'=>'required',
		'smin'=>'required',
		'ssec'=>'required',
		'smonth'=>'required',
		'edays'=>'required',
		'eyear'=>'required',
		'ehours'=>'required',
		'emin'=>'required',
		'esec'=>'required',
                );
                $validator = Validator::make($request->all(), $rules, $messsages);
                //server side errors
                if ($validator->fails()) {
                    return redirect()->route('auction.store',['id'=>$id])
                                    ->withErrors($validator)
                                    ->withInput();
                }
               
    		$data = $request->all();
                
//    		echo "<pre>"; print_r($data); die; Y-m-d H:i:s
            
                $start_time = $request->syear.'-'.$request->smonth.'-'.$request->sdays.' '.$request->shours.':'.$request->smin.':'.$request->ssec ;
                $start_time = new DateTime($start_time);
                $start_time = $start_time->getTimestamp();
                
                
                $end_time = $request->eyear.'-'.$request->emonth.'-'.$request->edays.' '.$request->ehours.':'.$request->emin.':'.$request->esec ;
//                echo $end_time;
                $end_time = new DateTime($end_time);
                $end_time = $end_time->getTimestamp();
//                dd($start_time->getTimestamp());
//                echo '....................'.$start_time.'..................'.$end_time; exit;
                
    		$auction = new Auction;
    		$auction->product_id = $id;
    		$auction->start_time = $start_time;
    		$auction->end_time = $end_time;
    		$auction->price_inc = $request->price_inc;
    		$auction->time_inc = $request->time_inc;
    		$auction->min_real_bids = $request->min_real_bids;
                $auction->autobid_limit = $request->autobid_limit;
                if ($request->has('status')) {
                $auction->status = $request->status;
                }
                $auction->save();
    		/*return redirect()->back()->with('flash_message_success','Product has been added successfully!');->where(['is_delete' => 0]);*/
            return redirect()->route('product.viewproduct')->with('flash_message_success','Auction has been added successfully!');
    	}
//        $date = new DateTime();
////        dd($date);
//        dd($date->getTimestamp());
//        echo $year = $date->format('Y'); exit;
        $title = 'Add Auction';
        $button_title = 'Add Auction';
        $action = URL::route('auction.store', ['id' => $id]);
        $current_year = new DateTime();
        $current_year = $current_year->format('Y');
        $yearArray = range($current_year, $current_year+19);
        $date = new \DateTime();
//        $date->setTimezone(new \DateTimeZone('Asia/Calcutta'));
        $start_current_year = $date->format('Y (e)');
        $end_current_year = $date->format('Y (e)');
        $start_years_dropdown = "";
        $end_years_dropdown = "";
        foreach($yearArray as $year){
                // if you want to select a particular year
                $start_selected = ($year == $start_current_year) ? 'selected' : '';
                $start_years_dropdown .='<option '.$start_selected.' value="'.$year.'">'.$year.'</option>';
                $end_selected = ($year == $end_current_year) ? 'selected' : '';
                $end_years_dropdown .='<option '.$end_selected.' value="'.$year.'">'.$year.'</option>';
    		
    	}
        $start_days_dropdown = "";
        $end_days_dropdown = "";
        $start_current_day = $date->format('j (e)');
        $end_current_day = $date->format('j (e)');
//        print_r($current_date); exit;
        for($i=1; $i<=31; $i++){
            
                // if you want to select a particular year
                $start_selected = ($i == $start_current_day) ? 'selected' : '';
                $start_days_dropdown .='<option '.$start_selected.' value="'.$i.'">'.$i.'</option>';
                $end_selected = ($i == $end_current_day) ? 'selected' : '';
                $end_days_dropdown .='<option '.$end_selected.' value="'.$i.'">'.$i.'</option>';
    		
    	}
    	
        $start_months_dropdown = "";
        $start_current_month = $date->format('n (e)');
        $end_months_dropdown = "";
        $end_current_month = $date->format('n (e)');
//        print_r($current_date); exit;
        for($i=1; $i<=12; $i++){
            
                // if you want to select a particular year
                $start_selected = ($i == $start_current_month) ? 'selected' : '';
                $start_months_dropdown .='<option '.$start_selected.' value="'.$i.'">'.DateTime::createFromFormat('!m', $i)->format('F').'</option>';
                $end_selected = ($i == $end_current_month) ? 'selected' : '';
                $end_months_dropdown .='<option '.$end_selected.' value="'.$i.'">'.DateTime::createFromFormat('!m', $i)->format('F').'</option>';
    		
    	}
        $start_hours_dropdown = "";
        $start_current_hour= $date->format('G (e)');
        $end_hours_dropdown = "";
        $end_current_hour= $date->format('G (e)');
//        print_r($current_date); exit;
        for($i=0; $i<=23; $i++){
            
                // if you want to select a particular year
                $start_selected = ($i == $start_current_hour) ? 'selected' : '';
                $start_hours_dropdown .='<option '.$start_selected.' value="'.$i.'">'.$i.'</option>';
                $end_selected = ($i == $end_current_hour) ? 'selected' : '';
                $end_hours_dropdown .='<option '.$end_selected.' value="'.$i.'">'.$i.'</option>';
    		
    	}
        $start_minutes_dropdown = "";
        $start_current_minutes = $date->format('i (e)');
        $end_minutes_dropdown = "";
        $end_current_minutes = $date->format('i (e)');
//        print_r($current_date); exit;
        for($i=00; $i<=59; $i++){
            
                // if you want to select a particular year
                $start_selected = ($i == $start_current_minutes) ? 'selected' : '';
                $start_minutes_dropdown .='<option '.$start_selected.' value="'.$i.'">'.$i.'</option>';
                $end_selected = ($i == $end_current_minutes) ? 'selected' : '';
                $end_minutes_dropdown .='<option '.$end_selected.' value="'.$i.'">'.$i.'</option>';
    		
    	}
        $start_seconds_dropdown = "";
        $start_current_seconds = $date->format('s (e)');
        $end_seconds_dropdown = "";
        $end_current_seconds = $date->format('s (e)');
//        print_r($current_seconds); exit;
        for($i=0; $i<=59; $i++){
            
                // if you want to select a particular year
                $start_selected = ($i == $start_current_seconds) ? 'selected' : '';
                $start_seconds_dropdown .='<option '.$start_selected.' value="'.$i.'">'.$i.'</option>';
                $end_selected = ($i == $end_current_seconds) ? 'selected' : '';
                $end_seconds_dropdown .='<option '.$end_selected.' value="'.$i.'">'.$i.'</option>';
    		
    	}
    	
    	return view('admin.auctions.add_auction')->with(compact('button_title', 'title', 'action', 'start_years_dropdown', 'start_days_dropdown', 'start_months_dropdown', 'start_hours_dropdown', 'start_minutes_dropdown', 'start_seconds_dropdown', 'end_years_dropdown', 'end_days_dropdown', 'end_months_dropdown', 'end_hours_dropdown', 'end_minutes_dropdown', 'end_seconds_dropdown'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function show(Auction $auction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function edit(Auction $auction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $auction_id)
    {
         
//        echo Config::get('constants.base_path'); exit();
    	if($request->isMethod('post')){
            
                $messsages = array(
		'smonth.required'=>'You cant leave Start Month field empty',
		'sdays.required'=>'You cant leave Start Days field empty',
                'syear.required'=>'You cant leave Start Years field empty',
		'shours.required'=>'You cant leave Start Hours field empty',
		'smin.required'=>'You cant leave Start Minutes field empty',
                'ssec.required'=>'You cant leave Start Seconds field empty',
		'emonth.required'=>'You cant leave End Month field empty',
		'edays.required'=>'You cant leave End Days field empty',
                'eyear.required'=>'You cant leave End Years field empty',
		'ehours.required'=>'You cant leave End Hours field empty',
		'emin.required'=>'You cant leave End Minutes field empty',
                'esec.required'=>'You cant leave End Seconds field empty',
		
                );
                $rules = array(
		'smonth'=>'required',
		'sdays'=>'required',
		'syear'=>'required',
		'shours'=>'required',
		'smin'=>'required',
		'ssec'=>'required',
		'smonth'=>'required',
		'edays'=>'required',
		'eyear'=>'required',
		'ehours'=>'required',
		'emin'=>'required',
		'esec'=>'required',
                );
                $validator = Validator::make($request->all(), $rules, $messsages);
                //server side errors
                if ($validator->fails()) {
                    return redirect()->route('auction.update',['auction_id'=>$auction_id])
                                    ->withErrors($validator)
                                    ->withInput();
                }
               

                if (!$request->has('status')) {
                $status = 0;
                } else {
                $status = $request->status;
                }
//    		echo "<pre>"; print_r($data); die; Y-m-d H:i:s
            
                $start_time = $request->syear.'-'.$request->smonth.'-'.$request->sdays.' '.$request->shours.':'.$request->smin.':'.$request->ssec ;
                $start_time = new DateTime($start_time);
                $start_time = $start_time->getTimestamp();
                
                
                $end_time = $request->eyear.'-'.$request->emonth.'-'.$request->edays.' '.$request->ehours.':'.$request->emin.':'.$request->esec ;
//                echo $end_time;
                $end_time = new DateTime($end_time);
                $end_time = $end_time->getTimestamp();
//                dd($start_time->getTimestamp());
//                echo '....................'.$start_time.'..................'.$end_time; exit;
                
    		$auction = new Auction;
    		$start_time = $start_time;
    		$end_time = $end_time;
    		$price_inc = $request->price_inc;
    		$time_inc = $request->time_inc;
    		$min_real_bids = $request->min_real_bids;
                $autobid_limit = $request->autobid_limit;
                
                
                Auction::where(['id' => $auction_id])->update(['start_time' => $start_time, 'end_time' => $end_time, 'price_inc' => $price_inc, 'time_inc' => $time_inc, 'min_real_bids' => $min_real_bids, 'autobid_limit' => $autobid_limit, 'status'=>$status]);
            
                
    		/*return redirect()->back()->with('flash_message_success','Product has been added successfully!');->where(['is_delete' => 0]);*/
            return redirect()->route('product.viewproduct')->with('flash_message_success','Auction updated successfully!');
    	}
//        $date = new DateTime();
////        dd($date);
//        dd($date->getTimestamp());
//        echo $year = $date->format('Y'); exit;
        
        $title = 'Edit Auction';
        $button_title = 'Update Auction';
        $action = URL::route('auction.update', ['auction_id' => $auction_id]);
        $auctionDetails = Auction::where(['id' => $auction_id])->first();
//        dd($auctionDetails);
        
        $current_year = new DateTime();
        $current_year = $current_year->format('Y');
        $yearArray = range($current_year, $current_year+19);
        $start_time_date = new \DateTime();
        $start_time_date->setTimestamp($auctionDetails->start_time);
        $end_time_date = new \DateTime();
        $end_time_date->setTimestamp($auctionDetails->end_time);
//        $current_year = $date->format('Y (e)');

        $start_current_year = $start_time_date->format('Y');
        $end_current_year = $end_time_date->format('Y');
        $start_years_dropdown = "";
        $end_years_dropdown = "";
        foreach($yearArray as $year){
                // if you want to select a particular year
                $start_selected = ($year == $start_current_year) ? 'selected' : '';
                $start_years_dropdown .='<option '.$start_selected.' value="'.$year.'">'.$year.'</option>';
                $end_selected = ($year == $end_current_year) ? 'selected' : '';
                $end_years_dropdown .='<option '.$end_selected.' value="'.$year.'">'.$year.'</option>';
    		
    	}
        $start_days_dropdown = "";
        $end_days_dropdown = "";
        $start_current_day = $start_time_date->format('j');//gmdate('j', $auctionDetails->start_time);
        $end_current_day = $end_time_date->format('j');//gmdate('j', $auctionDetails->end_time);
//        print_r($current_date); exit;
        for($i=1; $i<=31; $i++){
            
                // if you want to select a particular year
                $start_selected = ($i == $start_current_day) ? 'selected' : '';
                $start_days_dropdown .='<option '.$start_selected.' value="'.$i.'">'.$i.'</option>';
                $end_selected = ($i == $end_current_day) ? 'selected' : '';
                $end_days_dropdown .='<option '.$end_selected.' value="'.$i.'">'.$i.'</option>';
    		
    	}
    	
        $start_months_dropdown = "";
        $start_current_month = $start_time_date->format('n');//gmdate('n', $auctionDetails->start_time);
        $end_months_dropdown = "";
        $end_current_month = $end_time_date->format('n');//gmdate('n', $auctionDetails->end_time);
//        print_r($current_date); exit;
        for($i=1; $i<=12; $i++){
            
                // if you want to select a particular year
                $start_selected = ($i == $start_current_month) ? 'selected' : '';
                $start_months_dropdown .='<option '.$start_selected.' value="'.$i.'">'.DateTime::createFromFormat('!m', $i)->format('F').'</option>';
                $end_selected = ($i == $end_current_month) ? 'selected' : '';
                $end_months_dropdown .='<option '.$end_selected.' value="'.$i.'">'.DateTime::createFromFormat('!m', $i)->format('F').'</option>';
    		
    	}
        $start_hours_dropdown = "";
        $start_current_hour= $start_time_date->format('G');//gmdate('G', $auctionDetails->start_time);
        $end_hours_dropdown = "";
        $end_current_hour= $end_time_date->format('G');//gmdate('G', $auctionDetails->end_time);
//        print_r($current_date); exit;
        for($i=0; $i<=23; $i++){
            
                // if you want to select a particular year
                $start_selected = ($i == $start_current_hour) ? 'selected' : '';
                $start_hours_dropdown .='<option '.$start_selected.' value="'.$i.'">'.$i.'</option>';
                $end_selected = ($i == $end_current_hour) ? 'selected' : '';
                $end_hours_dropdown .='<option '.$end_selected.' value="'.$i.'">'.$i.'</option>';
    		
    	}
        $start_minutes_dropdown = "";
        $start_current_minutes = $start_time_date->format('i');//gmdate('i', $auctionDetails->start_time);
        $end_minutes_dropdown = "";
        $end_current_minutes = $end_time_date->format('i');//gmdate('i', $auctionDetails->end_time);
//        print_r($current_date); exit;
        for($i=00; $i<=59; $i++){
            
                // if you want to select a particular year
                $start_selected = ($i == $start_current_minutes) ? 'selected' : '';
                $start_minutes_dropdown .='<option '.$start_selected.' value="'.$i.'">'.$i.'</option>';
                $end_selected = ($i == $end_current_minutes) ? 'selected' : '';
                $end_minutes_dropdown .='<option '.$end_selected.' value="'.$i.'">'.$i.'</option>';
    		
    	}
        $start_seconds_dropdown = "";
        $start_current_seconds = $start_time_date->format('s');//gmdate('s', $auctionDetails->start_time);
        $end_seconds_dropdown = "";
        $end_current_seconds = $end_time_date->format('s');//gmdate('s', $auctionDetails->end_time);
//        print_r($current_seconds); exit;
        for($i=0; $i<=59; $i++){
            
                // if you want to select a particular year
                $start_selected = ($i == $start_current_seconds) ? 'selected' : '';
                $start_seconds_dropdown .='<option '.$start_selected.' value="'.$i.'">'.$i.'</option>';
                $end_selected = ($i == $end_current_seconds) ? 'selected' : '';
                $end_seconds_dropdown .='<option '.$end_selected.' value="'.$i.'">'.$i.'</option>';
    		
    	}
    	
    	
    	return view('admin.auctions.add_auction')->with(compact('auctionDetails', 'button_title', 'title', 'action', 'start_years_dropdown', 'start_days_dropdown', 'start_months_dropdown', 'start_hours_dropdown', 'start_minutes_dropdown', 'start_seconds_dropdown', 'end_years_dropdown', 'end_days_dropdown', 'end_months_dropdown', 'end_hours_dropdown', 'end_minutes_dropdown', 'end_seconds_dropdown'));
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
               
         if (!empty($id)) {
            Auction::where(['id' => $id])->update(['is_delete' => 0]);
            return redirect()->back()->with('flash_message_success', 'Auction deleted Successfully!');
        }
         return redirect()->back()->with('flash_message_success', 'Something Went Wrong!');
    }
    
    /**
     * Display a listing of the all live auction.
     *
     * @return \Illuminate\Http\Response
     */
    public function liveAuctions()
    {
        $auctions = Auction::where(['is_delete'=>1, 'auction_status'=>1, ['is_sold', '=', 0] ])->with([
           'product'=> function($q){
            $q->select('id','product_name','category_id');
           },
           'product.category'=> function ($query){
               
               $query->select('id','name');
            }
           ])->get();
        $title = 'Live Auctions';   
//       dd($products);
        return view('admin.auctions.view_live_auctions')->with(compact('auctions','title'))->with('no', 1);
    }
    
    /**
     * Display a listing of the all Up Coming Auction.
     *
     * @return \Illuminate\Http\Response
     */
    public function upComingAuctions()
    {
        $current_time_stamp = new DateTime();

        $current_time_stamp = $current_time_stamp->getTimestamp();
        
       $auctions = Auction::where(['is_delete'=>1, 'auction_status'=>1, ['start_time', '>', $current_time_stamp], ['is_sold', '=', 0]  ])->with([
           'product'=> function($q){
            $q->select('id','product_name','category_id');
           },
           'product.category'=> function ($query){
               
               $query->select('id','name');
            }
           ])->get();
           
           $title = 'Future Auctions';
           
           
//       dd($products);
        return view('admin.auctions.view_live_auctions')->with(compact('auctions','title'))->with('no', 1);
    }
    
    
    
    /**
     * Display a listing of the all Up Coming Auction.
     *
     * @return \Illuminate\Http\Response
     */
    public function wonAuctions()
    {
        
       $auctions = Auction::where(['is_delete'=>1, 'auction_status'=>1, ['is_sold', '=', 1] ])->with([
           'product'=> function($q){
            $q->select('id','product_name','category_id');
           },
           'product.category'=> function ($query){
               
               $query->select('id','name');
            }
           ])->get();
           
           $title = 'Won Auctions';
           
           
//       dd($products);
        return view('admin.auctions.view_live_auctions')->with(compact('auctions','title'))->with('no', 1);
    }
    
    
    
    
    public function winner($product_id, $auction_id){
        
        
        $bidingHistories = bidingHistories::where(['is_delete'=>1, 'product_id'=>$product_id, 'auction_id'=>$auction_id])->with([
            
            'user'=> function($q){
             $q->select('id','name');
            },

        ])->get();
        $product_name = Product::where(['id'=>$product_id])->select('product_name')->first();
        
        return view('admin.auctions.winner_auctions')->with(compact('bidingHistories','product_name'))->with('no', 1);
        
        
    }
    
    
    public function bidListing(){
        
        
        $bidingHistories = bidingHistories::where(['is_delete'=>1])->with([
            'auction'=> function ($query){
                $query->select('id','product_id');
            },
            'product'=> function ($query){
                $query->select('id','product_name');
            },
            'user'=> function($q){
             $q->select('id','name');
            },

        ])->get();
        $title = 'Bid Listing';
//        dd($bidingHistories);
        return view('admin.auctions.bid_listing')->with(compact('bidingHistories','title'))->with('no', 1);
        
        
    }
    
    
    
    
    
}

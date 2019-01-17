<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Config;
use Auth;
use DateTime;
use App\User;
use App\Auction;
use App\Product;
use App\BiddingPackage;
use App\bidingHistories;


class UsersController extends Controller
{


    public function __construct()
    {

        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        dd(Auth::user());

        return view('user.home');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('user.view_profile');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('user.edit_profile');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    
    public function changePassword(){
        
        return view('user.change_password');
        
    }
    
    
    public function watchList(){
        
        return view('user.watch_list');
        
    }
    
    
    public function addresses(){
        
        return view('user.addresses');
        
    }
    
    
    public function wonAuctions(){
        
        return view('user.won_auctions');
        
    }
    
    public function myBids(){
        
        return view('user.my_bids');
        
    }
    
    public function accounts(){
        
        return view('user.accounts');
        
    }
    
    
    
}

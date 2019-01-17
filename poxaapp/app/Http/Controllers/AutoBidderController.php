<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Config;
use DB;
use Log;
use DateTime;

class AutoBidderController extends Controller
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
    public function index()
    {
        $autobidders = User::where([['is_auto', '=', '1'],'is_delete'=>'1'])->get();
//        dd($autobidders);
        return view('admin.users.autobidder_listing')->with(compact('autobidders'))->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add Autobidder';
        $button_title = 'Add Autobidder';
        $action = URL::route('autobidder.store');
        return view('admin.users.add-autobidder')->with(compact('button_title', 'title', 'action'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->isMethod('post')){

            $messsages = array(
                'name.required'=>'You cant leave Name field empty',
            );
            $rules = array(
                'name'=>'required',
            );
            $validator = Validator::make($request->all(), $rules, $messsages);
            //server side errors
            if ($validator->fails()) {
                return redirect()->route('autobidder.create')
                    ->withErrors($validator)
                    ->withInput();
            }
            $user_count = User::count();
            $email = 'autobidder'.$user_count.'@poxaapp.com';
            $user = new User;
            $user->name = $request->name;
            $user->email = $email;
            $user->password = bcrypt('poxaapp1234567890');;
            $user->is_auto = 1;

            if ($request->has('status')) {
                $user->status = $request->status;
            }
            $user->save();
            /*return redirect()->back()->with('flash_message_success','Product has been added successfully!');->where(['is_delete' => 0]);*/
//            return redirect()->route('autobidder.index')->with('flash_message_success'," User's Details Updated successfully!");
            return redirect()->route('autobidder.index')->with('flash_message_success'," User Details Added successfully!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AutoBidder  $autoBidder
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AutoBidder  $autoBidder
     * @return \Illuminate\Http\Response
     */
    public function edit($autobidder_id)
    {
        $autobidders = User::where(['id'=>$autobidder_id, 'is_auto'=>'1'])->first();
        $title = 'Edit Auction';
        $button_title = 'Update Auction';
        $action = URL::route('autobidder.update', ['autobidder_id'=>$autobidder_id]);
        return view('admin.users.add-autobidder')->with(compact('autobidders', 'button_title', 'title', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AutoBidder  $autoBidder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $autobidder_id)
    {

        if($request->isMethod('post')){

            $messsages = array(
                'name.required'=>'You cant leave Name field empty',
            );
            $rules = array(
                'name'=>'required',
            );
            $validator = Validator::make($request->all(), $rules, $messsages);
            //server side errors
            if ($validator->fails()) {
                return redirect()->route('autobidder.edit',['autobidder_id'=>$autobidder_id])
                    ->withErrors($validator)
                    ->withInput();
            }
            $user_count = User::count();
            $email = 'autobidder'.$user_count.'@poxaapp.com';
            $user = new User;
            $user->name = $request->name;

            if ($request->has('status')) {
                $user->status = $request->status;
            } else {
                $request->status = 0 ;
            }
            $user->where(['id'=>$autobidder_id])->update(['name'=>$request->name, 'status'=>$request->status]);
            /*return redirect()->back()->with('flash_message_success','Product has been added successfully!');->where(['is_delete' => 0]);*/
            return redirect()->route('autobidder.index')->with('flash_message_success'," User Details Updated successfully!");
//            return redirect()->route('autobidder.index')->with('flash_message_success'," User Details Added successfully!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AutoBidder  $autoBidder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!empty($id)) {
            User::where(['id' => $id])->update(['is_delete' => 0]);
            return redirect()->back()->with('flash_message_success', 'User deleted Successfully!');
        }
        return redirect()->back()->with('flash_message_success', 'Something Went Wrong!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userListing()
    {
        $users = User::where([['is_auto', '=', '0'],'is_delete'=>'1'])->orderBy('id','DESC')->get();
//        dd($users);
        return view('admin.users.user_listing')->with(compact('users'))->with('no', 1);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUser()
    {
        $title = 'Add User';
        $button_title = 'Add User';
        $action = URL::route('user.store');
        return view('admin.users.add-user')->with(compact('button_title', 'title', 'action'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeUser(Request $request)
    {
        if($request->isMethod('post')){


            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);


            //server side errors
            if ($validator->fails()) {
                return redirect()->route('user.create')
                    ->withErrors($validator)
                    ->withInput();
            }
//            dd(Hash::make($request->password));
            $user_count = User::count();
            $email = 'autobidder'.$user_count.'@poxaapp.com';
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->is_auto = 0;

            if ($request->has('status')) {
                $user->status = $request->status;
            }
            $user->save();
            /*return redirect()->back()->with('flash_message_success','Product has been added successfully!');->where(['is_delete' => 0]);*/
//            return redirect()->route('autobidder.index')->with('flash_message_success'," User's Details Updated successfully!");
            return redirect()->route('user.userlisting')->with('flash_message_success'," User Details Added successfully!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AutoBidder  $autoBidder
     * @return \Illuminate\Http\Response
     */
    public function showUser()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AutoBidder  $autoBidder
     * @return \Illuminate\Http\Response
     */
    public function editUser($user_id)
    {
        $users = User::where(['id'=>$user_id, 'is_auto'=>'0'])->first();
        $title = 'Edit User';
        $button_title = 'Update User';
        $action = URL::route('user.update', ['user_id'=>$user_id]);
        return view('admin.users.add-user')->with(compact('users', 'button_title', 'title', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AutoBidder  $autoBidder
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request, $user_id)
    {

        if($request->isMethod('post')){


           $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);
            //server side errors
            if ($validator->fails()) {
                return redirect()->route('user.edit',['user_id'=>$user_id])
                    ->withErrors($validator)
                    ->withInput();
            }
            $user_count = User::count();
            $email = $request->email;
            $user = new User;


            if ($request->has('status')) {
                $request->status = $request->status;
            } else {
                $request->status = 0 ;
            }
            $user->where(['id'=>$user_id])->update(['name'=>$request->name, 'password'=>Hash::make($request->password), 'status'=>$request->status]);
            /*return redirect()->back()->with('flash_message_success','Product has been added successfully!');->where(['is_delete' => 0]);*/
            return redirect()->route('user.userlisting')->with('flash_message_success'," User Details Updated successfully!");
//            return redirect()->route('autobidder.index')->with('flash_message_success'," User Details Added successfully!");
        }
    }


}

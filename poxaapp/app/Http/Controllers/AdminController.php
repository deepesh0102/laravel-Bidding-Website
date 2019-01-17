<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Admin;
use Auth;

class AdminController extends Controller {

  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct() {
    $this->middleware('auth:admin');
  }

  /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Http\Response
  */
  public function index() {
    //        return view('admin');
    return view('admin.dashboard');
  }

  public function error404() {
    return view('admin.admin_error404');
  }

  public function updatepassword(Request $request) {
    if ($request->isMethod('post')) {
      $user = Auth::guard('admin')->user();
      $data = $request->all();
      $current_password = $data['current_pwd'];
      $check_password = Admin::where(['id' => $user->id])->first();
      if (Hash::check($current_password, $check_password->password)) {
        $password = bcrypt($data['new_pwd']);
        Admin::where('id', $user->id)->update(['password' => $password]);
        return redirect()->route('admin.updatepassword')->with('flash_message_success', 'Password updated Successfully!');
      } else {
        return redirect()->route('admin.updatepassword')->with('flash_message_error', 'Current Password is Incorrect');
      }
    }
    return view('admin.admin_updatepassword');
  }

}

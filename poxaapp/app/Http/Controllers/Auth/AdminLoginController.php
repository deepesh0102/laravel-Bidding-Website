<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Html\FormFacade;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;

class AdminLoginController extends Controller
{
    
    
    public function __construct() {
        
        $this->middleware('guest:admin')->except('logout');;
        
    }

    

    /**
     * Show the application's Admin login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
//        return view('auth.admin_login');
        return view('admin.admin_login');
    }
    
    
    
    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        
        // validate the form data
        
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        
        // Attempt to log the user in
        
        if(Auth::guard('admin')->attempt(['email'=>$request->email, 'password'=>$request->password], $request->remember)){
            // if successful, then redirect to their intended location
            
 //            return redirect()->route('admin.dashboard');
            return redirect()->intended(route('admin.dashboard'));
        }
        // if unsuccessful, then redirect bck to the login with the form data 
        return $this->sendFailedLoginResponse($request);
//        return redirect()->back()->withInput($request->only('email','password'));
        
    
    }
    
    
     /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect('/');//->intended(route('home'));
    }
    
    
    
    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }
    
}

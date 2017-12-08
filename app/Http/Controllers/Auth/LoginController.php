<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/admin/dashboard';

    /**
      * Get the post register / login redirect path.
      *
      * @return string
      */
      protected function redirectTo()
      {
            if (\Auth::user()->user_type == 0) {
                return '/admin/dashboard';
                
            }else{


              if (\Auth::user()->approved == 1) {
                return '/admin/dashboard';
              }else {

                    \Auth::logout();
                    Session::put('message','You are not approved yet!');
                  return '/admin/login';
              }
        }

      }

    /**
     * lockoutTime
     *
     * @var
     */
    protected $lockoutTime=1;
     
    /**
     * maxLoginAttempts
     *
     * @var
     */
    protected $maxLoginAttempts=3;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    //Use for custom login attempts as follows

    /**
     * lockoutTime
     *
     * @var
     */
    //protected $lockoutTime=1;
     
    /**
     * maxLoginAttempts
     *
     * @var
     */
    //protected $maxLoginAttempts=3;

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
 
    /*protected function hasTooManyLoginAttempts(Request $request)
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), $this->maxLoginAttempts, $this->lockoutTime
        );
    }*/



    //public function doLogin(Request $request)
   // {
        /*If the class is using the ThrottlesLogins trait, we can automatically throttle
        the login attempts for this application. We'll key this by the username and
        the IP address of the client making these requests into this application.*/
      
/*
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);


 
            return $this->sendLockoutResponse($request);
        }

        $userdata = array(

            'username' => $request->get('username'),
            'password' => $request->get('password')
        );
        

        if (Auth::attempt($userdata)) {*/

            // SUCCESS: If the login attempt was successful we redirect to the dashboard. but first, we 
            // clear the login attempts session
            /*$request->session()->regenerate();
            $this->clearLoginAttempts($request);

            Log::add('Login','Login Successful');
            Session::flash('flash_message', 'Welcome ' . Auth::user()->full_name . "!! login is successful");

           if(Auth::user()->status == 'Approved') {
               return Redirect::to('admin/dashboard');
           }else{
               Session::flash('flash_message', 'User Not Approved Yet');
               return Redirect::to('admin/login');
           }

        } else {*/
            // FAIL: If the login attempt was unsuccessful we will increment the number of attempts
            // to login and redirect the user back to the login form. Of course, when this
            // user surpasses their maximum number of attempts they will get locked out.
            /*$this->incrementLoginAttempts($request);

            Session::flash('flash_message', 'Username or password incorrect');
            return Redirect::to('admin/login');

        }


    }*/



}

<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;
use Illuminate\Auth\Events\Registered;
use App\Jobs\SendVerificationEmail;
use App\Mail\EmailVerification;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function register(Request $request)
    {  
        //dd($request->all());

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        //These steps are for using queue jobs
        /*event(new Registered($user = $this->create($request->all())));
        dispatch(new SendVerificationEmail($user));
*/
        $user = $this->create($request->all());
         $email = new EmailVerification($user);
        Mail::to($user->email)->send($email);

        return redirect('admin/login')->with('message','You have successfully registered. An email is sent to you for verification');
    
        // create the user
        //$user = $this->create($request->all());
        // Login and "remember" the given user...
        //Auth::login($user, true);
        //return redirect('/admin/dashboard');

       
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'username' => 'required|string|unique:users|max:20',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|same:password',
            //'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
        [
                
                'name.required'         => 'Name is required',
                'email.required'        => 'Email is required',
                'email.email'           => 'Email is invalid',
                'username.required'     => 'Username is required',
                'password.required'     => 'Password is required',
                'password.min'          => 'Password needs to have at least 6 characters',
                'password.max'          => 'Password maximum length is 20 characters',
            ]
            );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'user_type' => 2,
            'password' => bcrypt($data['password']),
            'email_token' => base64_encode($data['email'])
        ]);
    }

    /**
    * Handle a registration request for the application.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    /*public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        dispatch(new SendVerificationEmail($user));
        return view(‘verification’);
    }*/

    /**
    * Handle a registration request for the application.
    *
    * @param $token
    * @return \Illuminate\Http\Response
    */
    public function verify($token)
        {
        $user = User::where('email_token',$token)->first();
        $user->verified = 1;
        if($user->save()){
        return redirect('admin/login')->with('message','Your email has been verified! Please Login with your correct credentials.');
        }
    }


}

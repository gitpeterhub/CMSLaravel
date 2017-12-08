<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
use File;
use Illuminate\Support\Facades\Session;
//use Illuminate\Support\Facades\Crypt;
use App\Models\User;

class UserController extends Controller
{
     /**
     * @var Film
     */
    private $userRepo;
 
    public function __construct(UserRepository $userRepo) {
 
        $this->userRepo = $userRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('backend.admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // i have used modal in page for this purpose
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //dd($request->all());

           $rules = array(
                'name' => 'required',
                'email' => 'required | unique:users',
                'username' => 'required | between:3,15 | unique:users',
                'password' => 'required',
                'password_confirmation' => 'required|same:password',
                //'user_type' => 'required',
                //'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            );

           $input = $request->all();
            $validation = Validator::make($input, $rules);

            $validator = $validation;

            if ($validation->fails()) {
                //dd($validator->errors());
                return $validator->errors();
            }

            if ($request->hasFile('photo')){

                  $input = $this->makeThumbnails($request);
                   
               }

            //dd($input);
            $input['password'] = bcrypt($input['password']);
            //$input['status'] = "Not Approved";

            
            $user = $this->userRepo->create($input);
            
            Session::put('message', 'User Successfully Created!');
            Session::put('alert-class', 'alert-success');

             return null;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // i have use edit method both for viewing and editing purpose
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userRepo->find($id);

        //$user->password = Crypt::decrypt($user->password);

        return view('backend.admin.users.form')->with('user',$user);
        
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
        
        //dd($request->all());

        $input = $request->all();

        if ($request->hasFile('photo')){

                  if (file_exists(public_path() . '/uploads/thumbnails/' . $request['prev_photo'])) {

                    // Delete a single file
                    File::delete(public_path() . '/uploads/thumbnails/' . $request['prev_photo']);
                    File::delete(public_path() . '/uploads/profile-pics/' . $request['prev_photo']);

                }
                  $input = $this->makeThumbnails($request);                   
               }
               
               if (isset($input['password'])) {
                $input['password'] = bcrypt($input['password']);   
               }

               unset($input['_token']);
               unset($input['prev_photo']);
            //dd($input);
        $this->userRepo->update($input,$id);

       Session::flash('message','User updated successfully!');
       Session::flash('alert-class', 'alert-success');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $this->userRepo->delete($id);

       Session::flash('message','User deleted successfully!');
       Session::flash('alert-class', 'alert-success');

        return back();
    }

     public function getAll(Request $request)
    {
        
        $this->userRepo->getAll($request);
        
    }


    public function approved($id)
    {
        // $id = $request->get('id');

        //dd($id);
        $user = User::findOrFail($id);

        //dd($user);

        if ($user->approved == 1){
            //dd("jlkjl;kjl31550");
            $user->approved = 0;
        }else{
            //dd("fsdafsafsaf");
            $user->approved = 1;
        }
        $user->save();
        Session::flash('flash_message', "User successfully Approved");
        return back();
    }
/*
     public function changePassword(Request $request)
    {

        $user = User::findOrFail($request->get('id'));
        $input = $request->all();
        $input['password'] = Hash::make($input['password2']);
        $user->fill($input)->save();
        $message = "Password Successfully Updated";
        Session::flash('success_message', $message);

        return redirect('/message-resident');

    }

    public function resetPassword(Request $request)
    {
        $user_id=Session::get('reset_user_id');
        $chkAdmin=Session::get('chk_admin');
        $user = User::findOrFail($user_id);
        $input = $request->all();
        $input['password'] = Hash::make($input['password1']);
        $user->fill($input)->save();
        $message = "Password Successfully Updated";
        Session::flash('success_message', $message);
        Session::forget('reset_user_id');
        Session::forget('chk_admin');
        Session::flash('message', 'Your new password is Reset');
        $redirect = '/message-resident';
        if ($chkAdmin == "y") $redirect = 'admin';

        return redirect($redirect);


    }
*/

    protected function makeThumbnails($request){

        $path = public_path('/uploads/profile-pics');

        if (!is_dir($path)) {

             mkdir($path, 0777, true);
             mkdir(public_path('/uploads/thumbnails'));
        }

        //dd('created!');

            /*if (!file_exists('path/to/directory')) {
                mkdir('path/to/directory', 0777, true);
                }*/

        $photo = $request->file('photo');

            //creating an array of required indexs from $request object 
              $input = $request->all();
              //dd($input);

                $image_name = time() .'_'. md5($photo->getClientOriginalName()) .'.'. $photo->getClientOriginalExtension(); 
                
                $input['photo'] = $image_name;
                $input['photo_url'] = url('uploads/thumbnails/'.$image_name);
                $destinationPath = public_path('uploads/thumbnails');

                //image manupulation only using image/intervention package
                $thumb_img = Image::make($photo->getRealPath())->resize(250, 200);
                $thumb_img->save($destinationPath.'/'.$image_name,80);
                            
                $destinationPath = public_path('uploads/profile-pics');
                $photo->move($destinationPath, $image_name);
                return $input;
    }


     public function testRepo(){
        dd($this->userRepo->save([

                        'name'=> 'James',
                        'email'=> 'p.mr44@yahoo.com',
                        'username'=>'james9',
                        'user_type'=>2,
                        'password'=>bcrypt('secret'),
                        'photo'=>null,
                        'photo_url'=>null
                            ]));
    }

    
}

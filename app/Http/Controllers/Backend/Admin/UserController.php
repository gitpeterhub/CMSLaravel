<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
//use File;
use Illuminate\Support\Facades\Session;

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
                'user_type' => 'required',
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

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
        //i have used edit method both for viewing form and editing
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return view('backend.admin.users.form');
        //for updating group that user belongs
        if ($request->group_id != '0') {

            $result = DB::table('group_user')
                ->where('user_id',$request->user_id)
                ->exists();
            
            if ($result) {
                
                
                DB::table('group_user')
                    ->where('user_id', $request->user_id)
                    ->update([
                        'group_id' => $request->group_id

                        ]);
                    
            }else{

                DB::table('group_user')->insert([
                    'user_id' => $request->user_id, 
                    'group_id' => $request->group_id
                    ]);
            }
        }
        
        //updating user 
        User::where('id', $request->user_id)
          //->where('destination', 'San Diego')
          ->update([

            'name' => $request->name,
            'email' => $request->email,
            
            ]);

          return 1;
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
        ///Selecting the user to be deleted 
        //This gives instance/object of that user
        $user = $this->user->find($id);

        // delete rows from related models eg:  
        //$user->photo()->delete();

        //Deleting the record of user in which group he belongs
        DB::table('group_user')->where('user_id',$id)->delete();

        //finally deleting the user to be deleted
        $user->delete();

        return back();
    }

     public function getAll(Request $request)
    {
        
        $this->userRepo->getAll($request);
        
    }



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

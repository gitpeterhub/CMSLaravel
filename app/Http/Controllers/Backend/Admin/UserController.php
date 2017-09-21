<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

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
         return view('backend.admin.user-management.index');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
    
}

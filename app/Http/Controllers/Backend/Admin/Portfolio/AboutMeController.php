<?php

namespace App\Http\Controllers\Backend\Admin\Portfolio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\AboutMeRepository;
use Session;
use Intervention\Image\ImageManagerStatic as Image;
use File;

class AboutMeController extends Controller
{

    private $aboutMeRepo;

    function __construct(AboutMeRepository $aboutMeRepo){

        $this->aboutMeRepo = $aboutMeRepo;
    }    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $aboutMe = $this->aboutMeRepo->find(1);
        return view('backend.admin.portfolio.about-me.form',compact('aboutMe'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        //first check for photo
        if ($request->hasFile('photo')){

                  if (file_exists(public_path() . '/uploads/thumbnails/' . $request['prev_photo'])) {

                    // Delete a single file
                    File::delete(public_path() . '/uploads/thumbnails/' . $request['prev_photo']);
                    File::delete(public_path() . '/uploads/profile-pics/' . $request['prev_photo']);

                }
                  $data = $this->makeThumbnails($request);

               }

               unset($data['_token']);
               unset($data['prev_photo']);

        if ($data['id']) {
            $id = $data['id'];
            unset($data['id']);
            if ($this->aboutMeRepo->update($data,$id)) {
                $response['message'] = 'Your info updated successfully!';
                $response['alert-class'] = 'alert-success';
            }else{
                $response['message'] = 'Opps!Something went wrong.Please,try again later.';
                $response['alert-class'] = 'alert-danger';
            }

        }else{

            $this->aboutMeRepo->create($data);
            $response['message'] = 'Your info created successfully!';
            $response['alert-class'] = 'alert-success';
        }

        return $response;
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
        //
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


}

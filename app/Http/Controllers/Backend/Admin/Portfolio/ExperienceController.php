<?php

namespace App\Http\Controllers\Backend\Admin\Portfolio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ExperienceRepository;
use Session;

class ExperienceController extends Controller
{

    private $experienceRepo;

    function __construct(ExperienceRepository $experienceRepo){

        $this->experienceRepo = $experienceRepo;
    }
    /**
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.admin.portfolio.experiences.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.portfolio.experiences.add');
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
            unset($data['_token']);
            if ($this->experienceRepo->create($data)) {
                $response['message'] = 'New experience added successfully!.';
                $response['alert-class'] = 'alert-success';
            }else{
                $response['message'] = 'Opps!Something went wrong.Please,try again later.';
                $response['alert-class'] = 'alert-danger';
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
        $experience = $this->experienceRepo->find($id);
        return view('backend.admin.portfolio.experiences.edit',compact('experience'));
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
        $data = $request->all();
        unset($data['_token']);

       if ($this->experienceRepo->update($data,$id)) {
                $response['message'] = 'Experience updated successfully!.';
                $response['alert-class'] = 'alert-success';
            }else{
                $response['message'] = 'Opps!Something went wrong.Please,try again later.';
                $response['alert-class'] = 'alert-danger';
            }

            return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->experienceRepo->delete($id);

       Session::flash('message','Experience deleted successfully!');
       Session::flash('alert-class', 'alert-success');

        return back();
    }

    public function getList(Request $request){

        $this->experienceRepo->getAll($request);
    }
}

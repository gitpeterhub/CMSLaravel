<?php

namespace App\Http\Controllers\Backend\Admin\Portfolio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\EducationRepository;
use Session;

class EducationController extends Controller
{

    private $educationRepo;

    function __construct(EducationRepository $educationRepo){

        $this->educationRepo = $educationRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.admin.portfolio.education.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.portfolio.education.add');
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

            if ($this->educationRepo->create($data)) {
                $response['message'] = 'Got your message! I will contact you soon.';
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $education = $this->educationRepo->find($id);
        return view('backend.admin.portfolio.education.edit',compact('education'));
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

       if ($this->educationRepo->update($data,$id)) {
                $response['message'] = 'Got your message! I will contact you soon.';
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
        $this->educationRepo->delete($id);

       Session::flash('message','Record deleted successfully!');
       Session::flash('alert-class', 'alert-success');

        return back();
    }

    public function getList(Request $request){

        $this->educationRepo->getAll($request);
    }
}

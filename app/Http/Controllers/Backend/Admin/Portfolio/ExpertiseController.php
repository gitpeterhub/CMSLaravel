<?php

namespace App\Http\Controllers\Backend\Admin\Portfolio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ExpertiseRepository;
use Session;

class ExpertiseController extends Controller
{

    private $expertiseRepo;

    function __construct(ExpertiseRepository $expertiseRepo){

        $this->expertiseRepo = $expertiseRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.admin.portfolio.expertise.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.portfolio.expertise.add');
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
            if ($this->expertiseRepo->create($data)) {
                $response['message'] = 'Expertise updated successfully!';
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
        $expertise = $this->expertiseRepo->find($id);
        return view('backend.admin.portfolio.expertise.edit',compact('expertise'));
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

       if ($this->expertiseRepo->update($data,$id)) {
                $response['message'] = 'Expertise updated successfully!';
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
        $this->expertiseRepo->delete($id);

       Session::flash('message','Expertise deleted successfully!');
       Session::flash('alert-class', 'alert-success');

        return back();
    }

    public function getList(Request $request){

        $this->expertiseRepo->getAll($request);
    }
}

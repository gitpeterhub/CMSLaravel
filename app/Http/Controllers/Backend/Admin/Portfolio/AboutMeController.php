<?php

namespace App\Http\Controllers\Backend\Admin\Portfolio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\AboutMeRepository;
use Session;

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
        return view('backend.admin.portfolio.about-me.form');
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
        $data = $request->all();
        unset($data['_token']);

       if ($this->skillRepo->update($data,$id)) {
                $response['message'] = 'Skill updated successfully!';
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
        //
    }
}

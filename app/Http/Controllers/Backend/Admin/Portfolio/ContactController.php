<?php

namespace App\Http\Controllers\Backend\Admin\Portfolio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ContactRepository;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{

    private $contactRepo;

    function __construct(ContactRepository $contactRepo){

        $this->contactRepo = $contactRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        return view('backend.admin.portfolio.contact.list');
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
            $data = $request->all();
            unset($data['_token']);

            $rules = array(
                'name' => 'required|max:50',
                'email' => 'required|max:100|unique:contacts',
                'subject' => 'required|max:30',
                'message' => 'required|max:191'
            );

            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {
                //dd($validator->errors());
                return $validation->errors();
            }


            if ($this->contactRepo->create($data)) {
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


    public function getList(Request $request){

        $this->contactRepo->getAll($request);
    }
}

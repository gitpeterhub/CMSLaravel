<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use pagination;
use App\Models\Contact;

class AjaxLaravelPaginationController extends Controller

{


	public function __construct(){

	}


	public function index(){
		//dd('dfadsf');
		return view('ajax-pagination');


	}


	public function getContactList(Request $request)
	{
		$str = '';
		$data = Contact::orderBy('id', 'desc')->paginate(3);	
		if(!empty($data))
		{
			foreach ($data as  $contact) {
				$childprint = '';
				$str.='<tr><td style="text-transform:capitalize;">'.$contact->name.'</td>';
				$str.='<td>'.$childprint.'%</td>';
				$str.='<td >'.$contact->email.'%</td>
				<td>'.number_format((int)$contact->id, 2).'</td>
				<td>'.$contact->created_at.'</td>
				<td><button class="btn btn-danger" id='.$contact->id.'>Delete</button></td></tr>';
			}
			$json['success'] = $str;
			$json['pagi'] = ''.$data->links().'';	
		}
		else
		{
			$json['success'] = '<tr><td colspan="100%">No Record Found!!</td></tr>';
		}
		echo json_encode($json);
	}




}
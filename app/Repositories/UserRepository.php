<?php 

namespace App\Repositories;

//use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\Repository;
use DB;

class UserRepository extends Repository {


    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return new \App\Models\User;
    }


    public function getAll($request){


        $columns = array(   
                            0 => 'select_all',
                            1 =>'id', 
                            2 =>'name',
                            3 =>'email',
                            4 =>'approved',
                            5 =>'action',
                            
                        );
  
        $totalData = DB::select('SELECT COUNT(*) AS rowCount FROM users');
        $totalData = $totalData[0]->rowCount;
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $users = $this->makeModel()->offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }
        else {
            $search = $request->input('search.value'); 

            $users =  $this->makeModel()->where('id','LIKE',"%{$search}%")
                            ->orWhere('name', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = $users->count();
        }

        $data = array();
        if(!empty($users))
        {
            foreach ($users as $user)
            {
                /*$show =  route('posts.show',$user->id);
                $edit =  route('posts.edit',$user->id);*/
                //$nestedData['image'] = '<td class="text-center"><img src="storage/user/'.$user->image.'.jpg" class="user-img"></td>';
                $nestedData['select_all'] =$user->id;
                $nestedData['id'] = $user->id;
                $nestedData['name'] = $user->name;
                $nestedData['email'] = $user->email;
                if ($user->approved == 0) {
                    $nestedData["approved"] = '<a href="'.url("/admin/users/approved").'/'.$user->id.'"title="Edit" class="approved" btn-value="'.$user->id.'"><i class="fa fa-pencil-square-o fa-fw edit-icons "></i>Not Approved</a>';

                    $nestedData['action'] = '<a href="'.url("/admin/users/").'/'.$user->id.'/edit" title="Edit" class="userUpdate" btn-value="'.$user->id.'"><i class="fa fa-pencil-square-o fa-fw edit-icons edit"></i> </a>
                             <a href="'.url("/admin/users/").'/'.$user->id.'/delete" title="Delete" class="del"><i class="fa fa-trash edit-icons "></i></a>';

                }else{

                     //$nestedData['created_at'] = date('j M Y h:i a',strtotime($post->created_at));
                       if ($user->user_type == 0) {

                         $nestedData['approved'] = "";
                          
                          $nestedData['action'] = '<a href="'.url("/admin/users/").'/'.$user->id.'/edit" title="Edit" class="userUpdate" btn-value="'.$user->id.'"><i class="fa fa-pencil-square-o fa-fw edit-icons edit"></i> </a>';

                       }else{

                         $nestedData['approved'] = '<a href="'.url("/admin/users/approved").'/'.$user->id.'"title="Edit" class="approved" btn-value="'.$user->id.'"><i class="fa fa-pencil-square-o fa-fw edit-icons "></i>Approved</a>';

                            $nestedData['action'] = '<a href="'.url("/admin/users/").'/'.$user->id.'/edit" title="Edit" class="userUpdate" btn-value="'.$user->id.'"><i class="fa fa-pencil-square-o fa-fw edit-icons edit"></i> </a>
                             <a href="'.url("/admin/users/").'/'.$user->id.'/delete" title="Delete" class="del"><i class="fa fa-trash edit-icons "></i></a>';
                        
                       }


                   
                }
                
                //$nestedData['body'] = substr(strip_tags($post->body),0,50)."...";

               $data[] = $nestedData;
            }
        }
          
        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );

        echo json_encode($json_data);
         //return response()->toJson($json_data); 
        //return view('page',compact('$member'))

    }


}
<?php 

namespace App\Repositories;

//use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\Repository;
use DB;

class EducationRepository extends Repository {


    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'App\Models\Education';
    }


    public function getAll($request){


        $columns = array( 
                            0 =>'id', 
                            1 =>'degree',
                            2 =>'major',
                            3 =>'graduation_year',
                            4 =>'board_or_university',
                            5 =>'action',
                            
                        );
  
        $totalData = DB::select('SELECT COUNT(*) AS rowCount FROM contacts');
        $totalData = $totalData[0]->rowCount;
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $educations = $this->makeModel()->offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }
        else {
            $search = $request->input('search.value'); 

            $educations =  $this->makeModel()->where('id','LIKE',"%{$search}%")
                            ->orWhere('name', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = $contacts->count();
        }

        $data = array();
        if(!empty($educations))
        {
            foreach ($educations as $education)
            {
                /*$show =  route('posts.show',$user->id);
                $edit =  route('posts.edit',$user->id);*/
                //$nestedData['image'] = '<td class="text-center"><img src="storage/user/'.$user->image.'.jpg" class="user-img"></td>';
                $nestedData['id'] = $education->id;
                $nestedData['degree'] = $education->degree;
                $nestedData['major'] = $education->major;
                $nestedData['graduation_year'] = $education->graduation_year;
                $nestedData['board_or_university'] = $education->board_or_university;
                $nestedData['action'] = '<a href="'.url("/admin/portfolio/education/".'/'.$education->id.'/edit" title="Delete" onclick="userRemove()"><i class="fa fa-pencil-square-o fa-fw edit-icons edit"></i></a><a href="'.url("/admin/portfolio/education/delete/").'/'.$education->id.'" title="Delete" onclick="userRemove()"><i class="fa fa-trash edit-icons del"></i></a>';
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
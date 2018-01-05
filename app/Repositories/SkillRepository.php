<?php 

namespace App\Repositories;

//use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\Repository;
use DB;

class SkillRepository extends Repository {


    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'App\Models\Skill';
    }


    public function getAll($request){


        $columns = array( 
                            0 =>'id', 
                            1 =>'certificate_title',
                            2 =>'major',
                            3 =>'start_date',
                            4 =>'end_date',
                            5 =>'institution',
                            6 =>'action',
                            
                        );
  
        $totalData = DB::select('SELECT COUNT(*) AS rowCount FROM skills');
        $totalData = $totalData[0]->rowCount;
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $skills = $this->makeModel()->offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }
        else {
            $search = $request->input('search.value'); 

            $skills =  $this->makeModel()->where('id','LIKE',"%{$search}%")
                            ->orWhere('certificate_title', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = $skills->count();
        }

        $data = array();
        if(!empty($skills))
        {
            foreach ($skills as $skill)
            {
                /*$show =  route('posts.show',$user->id);
                $edit =  route('posts.edit',$user->id);*/
                //$nestedData['image'] = '<td class="text-center"><img src="storage/user/'.$user->image.'.jpg" class="user-img"></td>';
                $nestedData['id'] = $skill->id;
                $nestedData['certificate_title'] = $skill->certificate_title;
                $nestedData['major'] = $skill->major;
                $nestedData['start_date'] = $skill->start_date;
                $nestedData['end_date'] = $skill->end_date;
                $nestedData['institution'] = $skill->institution;
                $nestedData['action'] = '<a href="'.url("/admin/portfolio/skill/").'/'.$skill->id.'/edit" title="Delete" onclick="userRemove()"><i class="fa fa-pencil-square-o fa-fw edit-icons edit"></i></a><a href="'.url("/admin/portfolio/skill/").'/'.$skill->id.'/delete" title="Delete" onclick="userRemove()"><i class="fa fa-trash edit-icons del"></i></a>';
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
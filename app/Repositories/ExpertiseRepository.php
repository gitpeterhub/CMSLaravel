<?php 

namespace App\Repositories;

//use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\Repository;
use DB;

class ExpertiseRepository extends Repository {


    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'App\Models\Expertise';
    }


    public function getAll($request){


        $columns = array( 
                            0 =>'id', 
                            1 =>'field_of_expertise',
                            2 =>'expertise_details',
                            3 =>'research_topics',
                            4 =>'achievements',
                            5 =>'action',
                            
                        );
  
        $totalData = DB::select('SELECT COUNT(*) AS rowCount FROM expertises');
        $totalData = $totalData[0]->rowCount;
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $expertises = $this->makeModel()->offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }
        else {
            $search = $request->input('search.value'); 

            $expertises =  $this->makeModel()->where('id','LIKE',"%{$search}%")
                            ->orWhere('name', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = $expertises->count();
        }

        $data = array();
        if(!empty($expertises))
        {
            foreach ($expertises as $expertise)
            {
                /*$show =  route('posts.show',$user->id);
                $edit =  route('posts.edit',$user->id);*/
                //$nestedData['image'] = '<td class="text-center"><img src="storage/user/'.$user->image.'.jpg" class="user-img"></td>';
                $nestedData['id'] = $expertise->id;
                $nestedData['field_of_expertise'] = $expertise->field_of_expertise;
                $nestedData['expertise_details'] = $expertise->expertise_details;
                $nestedData['research_topics'] = $expertise->research_topics;
                $nestedData['achievements'] = $expertise->achievements;
                $nestedData['action'] = '<a href="/admin/portfolio/expertise/'.$expertise->id.'/edit" title="Delete" onclick="userRemove()"><i class="fa fa-pencil-square-o fa-fw edit-icons edit"></i></a><a href="/admin/portfolio/expertise/'.$expertise->id.'/delete" title="Delete" onclick="userRemove()"><i class="fa fa-trash edit-icons del"></i></a>';
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
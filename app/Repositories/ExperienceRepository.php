<?php 

namespace App\Repositories;

//use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\Repository;
use DB;

class ExperienceRepository extends Repository {


    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'App\Models\Experience';
    }


    public function getAll($request){


        $columns = array( 
                            0 =>'id', 
                            1 =>'company_name',
                            2 =>'joined_date',
                            3 =>'resigned_date',
                            4 =>'position',
                            5 =>'duties',
                            6 =>'action',
                            
                        );
  
        $totalData = DB::select('SELECT COUNT(*) AS rowCount FROM experiences');
        $totalData = $totalData[0]->rowCount;
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $experiences = $this->makeModel()->offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }
        else {
            $search = $request->input('search.value'); 

            $experiences =  $this->makeModel()->where('id','LIKE',"%{$search}%")
                            ->orWhere('company_name', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = $experiences->count();
        }

        $data = array();
        if(!empty($experiences))
        {
            foreach ($experiences as $experience)
            {
                /*$show =  route('posts.show',$user->id);
                $edit =  route('posts.edit',$user->id);*/
                //$nestedData['image'] = '<td class="text-center"><img src="storage/user/'.$user->image.'.jpg" class="user-img"></td>';
                $nestedData['id'] = $experience->id;
                $nestedData['company_name'] = $experience->company_name;
                $nestedData['joined_date'] = $experience->joined_date;
                $nestedData['resigned_date'] = $experience->resigned_date;
                $nestedData['position'] = $experience->position;
                $nestedData['duties'] = $experience->duties;
                $nestedData['action'] = '<a href="'.url("/admin/portfolio/experience/").'/'.$experience->id.'/edit" title="Delete" onclick="userRemove()"><i class="fa fa-pencil-square-o fa-fw edit-icons edit"></i></a><a href="'.url("/admin/portfolio/experience/").'/'.$experience->id.'/delete" title="Delete" onclick="userRemove()"><i class="fa fa-trash edit-icons del"></i></a>';
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
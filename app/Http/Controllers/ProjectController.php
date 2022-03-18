<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use App\Models\User;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $projects=Project::latest()->get();
        

        return view('projets/index', ['projects'=>$projects]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { $users=User::latest()->get();
       
        return view('projets/create',['users'=>$users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $proje=new Project();
        $proje->nom_projet= $request->input('NomProjet');
        $proje->abreviation= $request->input('Abreviation');
        $proje->thematique= $request->input('Thematique');
        $proje->structure_pilote= $request->input('StructurePilote');
        $proje->phase= $request->input('Description');

        $proje->region_test= $request->input('RegionTest');
        $proje->region_implementation= $request->input('RegionTest');
        $proje->region_exploitation= $request->input('RegionTest');
        $proje->budget= $request->input('budget');
        $proje->date_deb= $request->input('DateDebut');
        $proje->date_fin= $request->input('DateDebut');
        $proje->chef_projet= $request->input('ChefProjet');
        $proje->representant_EP= $request->input('RepresentantE&P');
        
        $proje->etude_echo= $request->input('inlineRadioOptions');

        $proje->description= $request->input('Description');
        
        $proje->save();
        
      return redirect('projet');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project=Project::find($id);

       
        
        if ($project==null) {
            return redirect('projet');
            
        }else{
        
        return view('projets/show', ['project'=>$project]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project=Project::find($id);
        $users=User::latest()->get();
        
        if ($project==null) {
            return redirect('projet');
            
        }else{
        
        return view('projets/edit', ['project'=>$project ,'users'=>$users]);
        }
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
        Project::where('id',$id)->update(
            [
                'description'=> $request->input('Description'),
            ]
            );
            return redirect('projet');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project=Project::find($id);
       
        $project->delete();

        return redirect('projet');
    }
}

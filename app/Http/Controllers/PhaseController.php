<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Phase;



class PhaseController extends Controller
{
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
        $ph=Phase::orderBy('position')->get()->whereNotNull('position');

        return view('projets/phase',['ph'=>$ph]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $ph=new Phase();
        $ph->position=$request->input('idphase');
        $ph->name=$request->input('namephase');

        DB::table('phases')->whereNotNull('position')->where('position','>=',$request->input('idphase'))->update(['position' =>DB::raw('position+1')]);

        $ph->save();
        return redirect('Phase/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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

        $dep=Phase::find($id);



        DB::table('phases')->where('id','=',$id)->update(['name' => $request->input('namephasemod') ])  ;

        return redirect('Phase/create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request ,$id)
    {
        DB::table('phases')->where('id','=',$id)->update(['position' => null ]);


        DB::table('phases')->where('position','!=',null)->where('position','>=',$request->input('pos'))->update(['position' =>DB::raw('position-1')]);

        return redirect('Phase/create');
    }
}

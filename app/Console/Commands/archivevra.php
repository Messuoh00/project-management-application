<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;
use App\Models\Project;
use Carbon\Carbon;
class archivevra extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'archivevra:month';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sauvgarde vra des projet month';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {


            $name = date('m-Y');


            $temp=array();

            $phase1 = Project::latest()->where('phase',1)->get();
            $temp[]=1;
            foreach ($phase1 as $phase) {
                $temp[]=$phase->id;
                $temp[]=$phase->visibilite;
                $temp[]=$phase->reactivite;
                $temp[]=$phase->avancement;
            }


            $phase1=serialize($temp);

            $temp= array();

            $phase2 = Project::latest()->where('phase',2)->get();
            $temp[]=2;
            foreach ($phase2 as $phase) {
                $temp[]=$phase->id;
                $temp[]=$phase->visibilite;
                $temp[]=$phase->reactivite;
                $temp[]=$phase->avancement;
            }

            $phase2=serialize($temp);

            $temp= array();


            $phase3 = Project::latest()->where('phase',3)->get();
            $temp[]=3;
            foreach ($phase3 as $phase) {
                $temp[]=$phase->id;
                $temp[]=$phase->visibilite;
                $temp[]=$phase->reactivite;
                $temp[]=$phase->avancement;
            }

            $phase3=serialize($temp);

            $temp= array();

            $phase4 = Project::latest()->where('phase',4)->get();
            $temp[]=4;
            foreach ($phase4 as $phase) {
                $temp[]=$phase->id;
                $temp[]=$phase->visibilite;
                $temp[]=$phase->reactivite;
                $temp[]=$phase->avancement;
            }

            $phase4=serialize($temp);

            $temp= array();

            $phase5 = Project::latest()->where('phase',5)->get();
            $temp[]=5;
            foreach ($phase5 as $phase) {
                $temp[]=$phase->id;
                $temp[]=$phase->visibilite;
                $temp[]=$phase->reactivite;
                $temp[]=$phase->avancement;
            }

            $phase5=serialize($temp);




            Storage::put('archiveVRA/'.$name.' Idee RD.txt',$phase1);
            Storage::put('archiveVRA/'.$name.' Maturation.txt',$phase2);
            Storage::put('archiveVRA/'.$name.' Recherche.txt',$phase3);
            Storage::put('archiveVRA/'.$name.' Test.txt',$phase4);
            Storage::put('archiveVRA/'.$name.' Implementation.txt',$phase5);



    }
}

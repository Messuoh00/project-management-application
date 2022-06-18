<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Project;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vra>
 */
class VraFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */




    public function definition()
    {


        $x=Project::factory()->create();
        return [

            'project_id'=>$x->id,
            'phase_id'=>$x->phase_id,


           'visibilite'=>rand(0,100),
           'reactivite'=>rand(0,100),
           'avancement'=>rand(0,100),

        ];
    }
}

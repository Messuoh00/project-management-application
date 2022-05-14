<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Departement;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $x=Departement::all()->random();
        $y=Departement::all()->random();
        return [




               'nom_projet'=> $this->faker->title,
               'abreviation' => $this->faker->title,
               'thematique'=> $y->nomdep,
            //    'departement_id'=>$x->id,
               'structure_pilote'=>$x->nomdep,
               'phase'=> $this->faker->randomElement(['0', '1', '2', '3', '4','5','6']),

               'region_test'=> $this->faker->name(),
               'region_implementation'=> $this->faker->name(),
               'region_exploitation'=> $this->faker->name(),

               'budget'=> $this->faker->biasedNumberBetween($min = 1000, $max = 2000, $function = 'sqrt'),

               'date_deb'=> now(),
               'date_fin'=>  now()->addDays(5),



               'etude_echo' => $this->faker->randomElement(['oui','non', 'na']),

               'description'=> $this->faker->paragraph(),





        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Division;
use App\Models\Phase;
use App\Models\Vra;

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
        $x=Division::all()->random();

        $z=Phase::all()->random();



        return [

               'nom_projet'=> $this->faker->catchPhrase,
               'abreviation' => $randomletter = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"),3,4),
               'thematique'=>$randomletter = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"),3,4),

               'division_id'=>$x->id,
               'files'=>'/fichier-projet/fichier-projet-'.$this->id,
               'phase_id'=>$z->id,


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

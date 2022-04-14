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
        return [
          
                
                
               
               'nom_projet'=> $this->faker->title,
               'chef_projet'=> User::all()->random()->id,
               'representant_EP'=> User::all()->random()->id,
               'abreviation' => $this->faker->title,
               'thematique'=> $this->faker->name(),
            //    'departement_id'=>$x->id,
               'structure_pilote'=>$x->nomdep,
               'phase'=> $this->faker->randomElement(['1.1', '1.2', '2.1', '2.2', '3.1','3.2']),
               
               'region_test'=> $this->faker->name(),
               'region_implementation'=> $this->faker->name(),
               'region_exploitation'=> $this->faker->name(),
               
               'budget'=> $this->faker->biasedNumberBetween($min = 1000, $max = 2000, $function = 'sqrt'),
    
               'date_deb'=> now(),
               'date_fin'=>  now(),
    
               'visibilite'=> $this->faker->biasedNumberBetween($min = 0, $max = 100, $function = 'sqrt'),
               'reactivite'=> $this->faker->biasedNumberBetween($min = 0, $max = 100, $function = 'sqrt'),
               'avancement'=> $this->faker->biasedNumberBetween($min = 0, $max = 100, $function = 'sqrt'),
    
               'etude_echo' => $this->faker->randomElement(['oui','non', 'na']),
                
                
    
    
               'description'=> $this->faker->paragraph(),
    
                
            
               
         
        ];
    }
}

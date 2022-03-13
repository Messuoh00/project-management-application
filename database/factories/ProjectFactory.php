<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
          
                
                
               
               'nom_projet'=> $this->faker->title,
               'abreviation' => $this->faker->title,
               'thematique'=> $this->faker->name(),
               'structure_pilote'=> $this->faker->name(),
               'phase'=> $this->faker->name(),
               
               'region_test'=> $this->faker->name(),
               'region_implementation'=> $this->faker->name(),
               'region_exploitation'=> $this->faker->name(),
               
               'budget'=> $this->faker->biasedNumberBetween($min = 1000, $max = 2000, $function = 'sqrt'),
    
               'date_deb'=> now(),
               'date_fin'=>  now(),
    
               'chef_projet'=> $this->faker->name(),
               'equipe' => $this->faker->name(),
               'representant_EP' => $this->faker->name(),
    
               'etude_echo' => $this->faker->name() ,
                
                
    
    
               'description'=> $this->faker->paragraph(),
    
                
            
               
         
        ];
    }
}

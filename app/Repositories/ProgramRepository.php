<?php
namespace App\Repositories;
use App\Repositories\Repository;
use App\Models\Program;
use Faker\Generator;

class ProgramRepository extends Repository 
{   
    protected $faker;
    protected $object;


    public function __construct(\Faker\Generator $faker)
    {
        $this->faker = $faker;
    } 


    public function create($json)
    {
        $this->object = json_decode($json);
        foreach($this->object->network as $network)
        {
            foreach($network->service as $service)
            {
                foreach ($service->event as $event) 
                {
                    foreach ($event->language as $language) 
                    {
                        foreach ($language->short_event as $shortEvent) 
                        {
                            $program = new Program;
                            $program->ext_program_id = $this->faker->randomNumber(2);
                            $program->show_type = 'movie';
                            $program->long_title = $shortEvent->name;
                            $program->save();
                        }
                    }
                }
            }
        }
        return $program;
    }
}



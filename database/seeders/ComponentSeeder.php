<?php

namespace Database\Seeders;

use App\Models\Component;
use App\Models\Turbine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $componentsData = [
            ['name' => 'Component 1', 'description' => 'Description for Component 1'],
            ['name' => 'Component 2', 'description' => 'Description for Component 2'],
            ['name' => 'Component 3', 'description' => 'Description for Component 3'],
            ['name' => 'Component 4', 'description' => 'Description for Component 4']
        ];

        $turbines = Turbine::all();
        foreach ($turbines as $turbine) {
            foreach ($componentsData as $componentData) {
                $component = new Component($componentData);
                $turbine->components()->save($component);
            }
        }
    }
}

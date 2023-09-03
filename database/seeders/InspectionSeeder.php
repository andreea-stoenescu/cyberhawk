<?php

namespace Database\Seeders;

use App\Models\Inspection;
use App\Models\Turbine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InspectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $turbines = Turbine::all();

        foreach ($turbines as $turbine) {
            // Create 2 or 3 inspections for each turbine
            $inspectionsCount = rand(2, 3);
            for ($i = 0; $i < $inspectionsCount; $i++) {
                $inspection = new Inspection([
                    'inspection_date' => now()->subDays(rand(1, 365))  // Random date in the past year
                ]);
                $turbine->inspections()->save($inspection);

                // Assign grades to each component for the inspection
                foreach ($turbine->components as $component) {
                    $grade = rand(1, 5);
                    $inspection->components()->attach($component->id, ['grade' => $grade]);
                }
            }
        }
    }
}

<?php

use App\Models\Classes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class FixClassColorSeeder extends Seeder
{
    /**
     * Run the datab
     * ase seeds.
     *
     * @return void
     */
    public function run()
    {
        $classes = Classes::withTrashed()->get();

        foreach($classes as $class) {
            $class->color = get_random_color_theme();
            $class->save();
            Log::info( sprintf("Updated color %s for class %s",
                $class->color,
                $class->getKey()
            ) );
        }
    }
}

<?php

namespace Database\Seeders;

use App\Functions\Helper;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectTableSeederCSV extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data_csv = fopen(__DIR__ . "\projects.csv","r");
        $index = 1;
        while ( ($row = fgetcsv($data_csv) ) !== FALSE ) {
            if( $index > 1) {
                $new_project = new Project();
                $new_project->name = $row[0];
                $new_project->slug = Helper::generateSlug($new_project->name, Project::class);
                // $new_project->slug = Project::generateSlug($new_project->name);
                // -----------------------------------
                // per dare ad ogni progetto un type_id randomico
                // dd(Tecnology::inRandomOrder()->first()->id);
                $new_project->type_id = Type::inRandomOrder()->first()->id;
                // -----------------------------------
                $start_date=date_create_from_format("d/m/Y",$row[1]);
                $new_project->start_date = date_format($start_date,"Y/m/d");

                if( $end_date=date_create_from_format("d/m/Y",$row[2]) ){
                    $new_project->end_date = date_format($end_date,"Y/m/d");
                }

                $new_project->description = $row[3];
                $new_project->status = $row[4];
                $new_project->is_group_project = $row[5];

                // dump( $new_project );
                $new_project->save();
            }
            $index++;
        }
    }
}

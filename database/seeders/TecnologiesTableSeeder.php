<?php

namespace Database\Seeders;

use App\Models\Tecnology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TecnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tecnologies = ['HTML','CSS','JavaScript','Angular','React','Vue.js','Node.js','Laravel','MySQL','API'];
        foreach ($tecnologies as $tecnology) {
            $new_tecnology = new Tecnology();
            $new_tecnology->name = $tecnology;
            $new_tecnology->slug = Str::slug($tecnology, '-');
            // dump($new_tecnology);
            $new_tecnology->save();
        }
    }
}

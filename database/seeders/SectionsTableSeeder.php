<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;
use DB;
class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->delete();
         $sectionsRecords = [
               ['id'=>1 , 'name'=>'Men','status'=>1],
               ['id'=>2 , 'name'=>'Women','status'=>1],
               ['id'=>3 , 'name'=>'Kids','status'=>1],
         ];

        
         DB::table('sections')->insert($sectionsRecords); 
    }
}

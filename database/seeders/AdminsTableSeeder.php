<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facedes\Str;
use App\Models\Admin;
class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        DB::table('admins')->delete();

        $adminsRecords = [
            [ 'id' => 1 , 'name' => 'admin' , 'type' => 'admin' , 'mobile' => '7864567567' , 'email' => 'admin@gmail.com' ,'password'=>'$2y$10$RzWI74I4Jm61skhRQJjC0Oi82T/OfxMJMoIk9rO6syDJxlHe12doq','image'=>'d','status'=>1 ],
            [ 'id' => 2 , 'name' => 'john' , 'type' => 'subadmin' , 'mobile' => '7864567567' , 'email' => 'subadmin@gmail.com' ,'password'=>'$2y$10$RzWI74I4Jm61skhRQJjC0Oi82T/OfxMJMoIk9rO6syDJxlHe12doq','image'=>'d','status'=>1 ],
            [ 'id' => 3 , 'name' => 'admin' , 'type' => 'subadmin' , 'mobile' => '7864567567' , 'email' => 'mks@gmail.com' ,'password'=>'$2y$10$RzWI74I4Jm61skhRQJjC0Oi82T/OfxMJMoIk9rO6syDJxlHe12doq','image'=>'d','status'=>1 ],
        ];

       DB::table('admins')->insert($adminsRecords); 
        
    }
}

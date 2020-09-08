<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'admin',
            'email' => 'admin@lucid.in',
            'password' => bcrypt('admin123'),
        ]);

        $layout = [
        ['layouts_name' => 'basic',"created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()],        
        ['layouts_name' => 'tables',"created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()],
        ['layouts_name' => 'columns',"created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()],

        ];



        DB::table('layouts')->insert($layout);

                $themes = [
        ['theme_name' => 'Dark_knight',"created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()],        
        ['theme_name' => 'Ghost_Rider',"created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()],
        ['theme_name' => 'Inception',"created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()],

        ];

        DB::table('themes')->insert($themes);
    }
}

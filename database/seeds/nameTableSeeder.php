<?php

use Illuminate\Database\Seeder;

class nameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Author::class,50)->create();
    }
}

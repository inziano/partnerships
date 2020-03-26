<?php

use Illuminate\Database\Seeder;

class PartnersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Partner::class, 100)->create()->each( function($partner){
            // create 
            factory(App\Agreement::class, 10)->create(['partner_id' => $partner->id])->each( function($agreement){
                $agreement->contacts()->saveMany( factory(App\Contact::class,2)->make());
            });
        });
    }
}

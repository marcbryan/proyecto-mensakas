<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {	
    	factory(App\Order::class, 50)->create()->each(function ($Order) {
		    DB::table('order_historical')->insert([     
		        'user_id'=>  $Order->user_id,
		        'business_id'=>  $Order->business_id,
		        'deliverer_id'=>  $Order->deliverer_id,
		        'json'=>  json_encode($Order->json),
		        'created_at'=>  $Order->created_at,
		        'updated_at'=>  $Order->updated_at,
		    ]);
	});

     
        factory(App\Order::class, 25)->create();
    }
}

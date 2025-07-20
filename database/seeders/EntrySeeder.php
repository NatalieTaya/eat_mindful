<?php

namespace Database\Seeders;

use App\Models\Entry;
use App\Models\Meal;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=User::all();
        $meals=Meal::all();
        $products=Product::all();

        foreach($users as $user){
            //every entry will contain 1-3 products
            $products_eaten=$products->random(rand(1,3));
            //choosing one meal
            $meal=$meals->random();
            $now = time(); // текущая метка времени
            $weekAgo = $now - (7 * 24 * 60 * 60); // 7 дней назад

            foreach($products_eaten as $product) {
                Entry::create([
                    'user_id'=>$user->id,
                    'meal_id'=>$meal->id,
                    'product_id'=>$product->id,
                    'weight' => rand(50, 300),
                    'date'=>date('Y-m-d', mt_rand($weekAgo, $now)),
                ]);
            }


        }    
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
use FakerRestaurant\Restaurant as Restaurant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'manager'
        ]);
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'admin'
        ]);
        DB::table('users')->insert([
            'name' => 'Customer',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'customer'
        ]);
        DB::table('users')->insert([
            'name' => 'Ina',
            'email' => 'ina@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'admin'
        ]);
        DB::table('users')->insert([
            'name' => 'Tomas',
            'email' => 'tomas@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'admin'
        ]);
        DB::table('users')->insert([
            'name' => 'Vytautas',
            'email' => 'vytautas@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'admin'
        ]);
        DB::table('users')->insert([
            'name' => 'Audrius',
            'email' => 'audrius@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'admin'
        ]);

        $faker = Faker::create();
        // $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));
        $faker->addProvider(new \FakerRestaurant\Provider\lt_LT\Restaurant($faker));
        // https://github.com/jzonta/FakerRestaurant
        // composer require jzonta/faker-restaurant

        $cities = [
            'Vilnius', 'Kaunas', 'Klaipėda', 'Panevėžys', 'Šiauliai'
        ];
        $category = [
            'Pasta', 'Pica', 'Breakfast', 'Salad', 'Soup', 'BBQ', 'Asian', 'Vegetarian', 'Sushi', 'Fish'
        ];
        $food_qty = 1500;

        foreach ($cities as $_) {
            DB::table('cities')->insert([
                'title' => $_,
            ]);
        }

        foreach ($category as $_) {
            $photo_food = rand(22, 49);
            DB::table('categories')->insert([
                'title' => $_,
                'photo' => '/images/temp/' . $photo_food . '.jpeg',
            ]);
        }

        foreach (range(1, 1) as $_) {
            $photo_rest = rand(1, 21);
            DB::table('ovners')->insert([
                'title' => $faker->company,
                'country' => $faker->country,
                'city' => $faker->city,
                'street' => $faker->streetName,
                'build' => $faker->buildingNumber,
                'postcode' => $faker->postcode,
                'open' => rand(7, 11) . ':00',
                'close' => rand(16, 19) . ':00',
                'photo' => '/images/temp/' . $photo_rest . '.jpg',
                'phone' => $faker->e164PhoneNumber,
                'mobile' => $faker->e164PhoneNumber,
                'email' => $faker->companyEmail,
                'bank' => $faker->iban,
                'account' => $faker->bankAccountNumber,
                'url' => $faker->url,
                'add' => $faker->realText(100, 5),
                'des' => $faker->paragraph($nbSentences = rand(5, 10), $variableNbSentences = true),
            ]);
        }

        foreach (range(1, 30) as $_) {
            $photo_rest = rand(1, 21);
            DB::table('restaurants')->insert([
                'title' => $faker->company,
                'addres' => $faker->streetAddress,
                'open' => rand(7, 11) . ':00',
                'close' => rand(18, 23) . ':00',
                'photo' => '/images/temp/' . $photo_rest . '.jpg',
                'phone' => $faker->e164PhoneNumber,
                'des' => $faker->paragraph($nbSentences = rand(5, 10), $variableNbSentences = true),
                // 'city' => $cities[rand(0,4)],
                // 'open' => $faker->time($format='H:i',$max='now'),
                // 'close' => $faker->time($format='H:i',$max='now'),                
            ]);
        }

        foreach (range(1, $food_qty) as $_) {
            $photo_food = rand(22, 49);
            DB::table('food')->insert([
                'rest_id' => rand(1, 30),
                'food_city_no' => rand(1, count($cities)),
                'food_category_no' => rand(1, count($category)),
                'title' => $faker->foodName,
                'counts' => 0,
                'price' => rand(499, 2999) / 100,
                'rating' => rand(100, 500) / 100,
                'add' => $faker->realText(100, 5),
                'photo' => '/images/temp/' . $photo_food . '.jpeg',
                'des' => $faker->paragraph($nbSentences = rand(5, 10), $variableNbSentences = true),
            ]);
        }
    }
}

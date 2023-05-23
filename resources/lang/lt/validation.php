<?php

return [
    'max' => [
        'array' => ' :attribute must not have more than :max items.',
        'file' => 'The :attribute must not be greater than :max kilobytes.',
        'numeric' => 'The :attribute must not be greater than :max.',
        'string' => ':attribute must not be greater than :max characters.',
    ],
    'max_digits' => 'The :attribute must not have more than :max digits.',
    'min' => [
        'array' => 'The :attribute must have at least :min items.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'numeric' => 'Šis :attribute privalo būti mažiausiai :min.',
        'string' => ' :Attribute privalo turėti mažiausiai :min ženklus.',
    ],
    'min_digits' => ':attribute privalo turėti bent :min skaitmenų .',
    'unique' => 'Šis :attribute jau yra užimtas.',
    'required' => ':Attribute laukelis yra privalomas.',
    'same' => ':Attribute and :other privalo sutapti.',
    'email' => ':Attribute laukelyje privalo būti galiojantis el-pašto adresas.',
    'confirmed' => ':Attribute ir slaptažodžio patvirtinimas neatitinka.',

    'attributes' => ['email' => 'el. paštas',
    'password' => 'slaptažodis', 'category_title_en' => 'kategorijos pavadinimo (en)',
    'category_title_lt' => 'kategorijos pavadinimo (lt)', 'photo'=> 'fotografijos',
    'name'=> 'vardas', 'rest_id' => 'restorano', 'city_id'=> 'miesto', 'roles'=> 'rolės',
    'food_title_en' => 'patiekalo pavadinimo (en)', 'food_title_lt' => 'patiekalo pavadinimo (lt)',
    'food_price' => 'patiekalo kainos', 'restaurant_title'=> 'restorano pavadinimo',
    'restaurant_addres'=> 'restorano adreso', 'city_title'=> 'miesto pavadinimo',
    'ovner_title' => 'pavadinimo', 'ovner_country'=>'valstybės',
    'ovner_city' => 'miesto', 'ovner_postcode' => 'pašto kodo', 'ovner_build' => 'pastato',
    'ovner_phone' => 'telefono', 'ovner_email' => 'el-pašto', 'ovner_url' => 'svetainės',
    'confirm-password' => 'pakartotas slaptažodis'


    ],
];

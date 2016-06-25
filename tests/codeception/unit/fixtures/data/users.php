<?php

$faker = Faker\Factory::create();

$res = [
    [
        'username'=>'admin@admin.a',
        //adminpass
        'auth_key'=>'dIq6Jcn7VMyizcwAVVzfDejBdQpE8gce',
        'password_hash'=>'$2y$13$9NGv8uTFJGn5IBwhkB0d5ezPc3eUS/X6EZxqlPu8YTjlFe9oefwOi',
        'email'=>'admin@admin.a',
        'status'=>10,
        'created_at'=>time(),
        'updated_at'=>time(),
    ],
    [
        'username' => 'demo@demo.d',
        'auth_key' => 'GmdyHxgzOS__KX8YLk6c2vdYzQTSVclU',
        // demopass
        'password_hash' => '$2y$13$Av0T8i/vBVz83JP6tjBhhOuxwVODnHpRtXSAjohh2ThShX1YLvia2',
        'email'=>'demo@demo.d',
        'status'=>10,
        'created_at'=>time(),
        'updated_at'=>time(),
    ],
];

for ( $i = 0; $i < 10; $i++ ) {
    $name = $faker->email;
    $res[] = [
        'username'=>$name,
        'auth_key'=>md5(time()),
        'password_hash'=>md5(time()),
        'email'=>$name,
        'status'=>10,
        'created_at'=>time(),
        'updated_at'=>time(),
    ];
}

return $res;

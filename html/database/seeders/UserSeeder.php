<?php

    namespace Database\Seeders;

    // use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;

    class UserSeeder extends Seeder
    {
        /**
         * Seed the application's database.
         *
         * @return void
         */
        public function run()
        {
            $categories =
                [
                    [
                        'id'    => 1,
                        'name' => '製材所'
                    ],
                    [
                        'id'    => 2,
                        'name' => '工務店'
                    ],
                    [
                        'id'    => 3,
                        'name' => '森林組合'
                    ],
                    [
                        'id'    => 4,
                        'name' => '流通'
                    ],
                    [
                        'id'    => 100,
                        'name' => '事務局'
                    ],

                ];

            foreach($categories as $category) {
                \App\Models\UserCategory::create($category);
            }

            \App\Models\User::query()->create([
                'id'    => 1,
                'name' => 'Admin',
                'user_category_id' => 100,
                'password' => bcrypt(env('DEFAULT_USER_PASS')),
                'email' => env('DEFAULT_USER_MAIL'),
            ]);

            \App\Models\User::query()->create([
                'id'    => 2,
                'name' => '製材所1',
                'user_category_id' => 1,
                'password' => bcrypt(env('DEFAULT_USER_PASS')),
                'email' => 'test2@test.jp',
            ]);
            \App\Models\User::query()->create([
                'id'    => 3,
                'name' => '工務店1',
                'user_category_id' => 2,
                'password' => bcrypt(env('DEFAULT_USER_PASS')),
                'email' => 'test3@test.jp',
            ]);

            // 他のSeederの呼び出し
            $this->call([
                ItemSeeder::class,
            ]);
        }
    }

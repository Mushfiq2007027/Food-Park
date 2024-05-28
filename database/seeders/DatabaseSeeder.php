<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(UserSeeder::class);
        $this->call(WhyChooseUsTitleSeeder::class);
        \App\Models\Slider::factory(3)->create(); //How Many contents we want in slider? Here is 3
        \App\Models\WhyChooseUs::factory(3)->create(); //How Many contents we want in why_choose_us section? Here is 3
        $this->call(CategorySeeder::class);
        \App\Models\Product::factory(10)->create(); //How Many contents we want? Here is 10
        \App\Models\Coupon::factory(3)->create();
    }
}

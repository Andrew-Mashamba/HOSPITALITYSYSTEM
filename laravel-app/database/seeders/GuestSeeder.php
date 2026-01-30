<?php

namespace Database\Seeders;

use App\Models\Guest;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guests = [
            [
                'phone_number' => '+255712000001',
                'name' => 'Andrew Mashamba',
                'first_visit_at' => Carbon::now()->subMonths(6),
                'last_visit_at' => Carbon::now()->subDays(2),
                'loyalty_points' => 150,
                'preferences' => json_encode([
                    'dietary' => ['no_pork'],
                    'favorite_table' => 'Table 5',
                    'favorite_items' => ['Grilled Tilapia', 'Mojito'],
                ]),
            ],
            [
                'phone_number' => '+255713000002',
                'name' => 'Sarah Johnson',
                'first_visit_at' => Carbon::now()->subMonths(3),
                'last_visit_at' => Carbon::now()->subDays(7),
                'loyalty_points' => 75,
                'preferences' => json_encode([
                    'dietary' => ['vegetarian'],
                    'favorite_items' => ['Vegetable Pasta', 'Fresh Orange Juice'],
                ]),
            ],
            [
                'phone_number' => '+255714000003',
                'name' => 'John Doe',
                'first_visit_at' => Carbon::now()->subMonths(1),
                'last_visit_at' => Carbon::now()->subDays(14),
                'loyalty_points' => 25,
                'preferences' => null,
            ],
            [
                'phone_number' => '+255715000004',
                'name' => 'Mary Smith',
                'first_visit_at' => Carbon::now()->subMonths(8),
                'last_visit_at' => Carbon::now()->subDays(1),
                'loyalty_points' => 200,
                'preferences' => json_encode([
                    'dietary' => ['gluten_free'],
                    'favorite_table' => 'Outdoor',
                    'favorite_items' => ['Grilled Chicken', 'Fruit Salad'],
                ]),
            ],
            [
                'phone_number' => '+255716000005',
                'name' => 'Peter Brown',
                'first_visit_at' => Carbon::now()->subWeeks(2),
                'last_visit_at' => Carbon::now()->subDays(5),
                'loyalty_points' => 30,
                'preferences' => null,
            ],
            [
                'phone_number' => '+255717000006',
                'name' => 'Grace Mwangi',
                'first_visit_at' => Carbon::now()->subMonths(4),
                'last_visit_at' => Carbon::now()->subDays(3),
                'loyalty_points' => 90,
                'preferences' => json_encode([
                    'favorite_items' => ['Seafood Platter', 'White Wine (Glass)'],
                ]),
            ],
            [
                'phone_number' => '+255718000007',
                'name' => 'David Kamau',
                'first_visit_at' => Carbon::now()->subMonths(2),
                'last_visit_at' => Carbon::now()->subDays(10),
                'loyalty_points' => 45,
                'preferences' => null,
            ],
            [
                'phone_number' => '+255719000008',
                'name' => 'Emma Wilson',
                'first_visit_at' => Carbon::now()->subMonths(5),
                'last_visit_at' => Carbon::now()->subDays(4),
                'loyalty_points' => 120,
                'preferences' => json_encode([
                    'favorite_table' => 'Bar Seat 3',
                    'favorite_items' => ['Chicken Wings', 'Local Beer'],
                ]),
            ],
            [
                'phone_number' => '+255720000009',
                'name' => 'James Ochieng',
                'first_visit_at' => Carbon::now()->subWeeks(3),
                'last_visit_at' => Carbon::now()->subDays(6),
                'loyalty_points' => 35,
                'preferences' => null,
            ],
            [
                'phone_number' => '+255721000010',
                'name' => 'Linda Kimani',
                'first_visit_at' => Carbon::now()->subMonths(7),
                'last_visit_at' => Carbon::now()->subHours(12),
                'loyalty_points' => 175,
                'preferences' => json_encode([
                    'dietary' => ['pescatarian'],
                    'favorite_items' => ['Fish & Chips', 'Calamari', 'Passion Juice'],
                ]),
            ],
        ];

        foreach ($guests as $guest) {
            Guest::create($guest);
        }

        $this->command->info('Guest records seeded successfully!');
        $this->command->info('Created 10 guests with varying visit history and loyalty points');
    }
}

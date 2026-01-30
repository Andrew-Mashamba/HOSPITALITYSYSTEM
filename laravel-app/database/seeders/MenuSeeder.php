<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menuItems = [
            // Appetizers
            [
                'name' => 'Chicken Wings',
                'description' => 'Crispy chicken wings with BBQ sauce',
                'category' => 'appetizer',
                'price' => 15000,
                'prep_area' => 'kitchen',
                'preparation_time' => 15,
                'is_available' => true,
            ],
            [
                'name' => 'Spring Rolls',
                'description' => 'Vegetable spring rolls with sweet chili sauce',
                'category' => 'appetizer',
                'price' => 12000,
                'prep_area' => 'kitchen',
                'preparation_time' => 10,
                'is_available' => true,
            ],
            [
                'name' => 'Calamari',
                'description' => 'Fried calamari with tartar sauce',
                'category' => 'appetizer',
                'price' => 18000,
                'prep_area' => 'kitchen',
                'preparation_time' => 12,
                'is_available' => true,
            ],
            [
                'name' => 'Samosas',
                'description' => 'Crispy beef samosas',
                'category' => 'appetizer',
                'price' => 8000,
                'prep_area' => 'kitchen',
                'preparation_time' => 8,
                'is_available' => true,
            ],
            [
                'name' => 'Bruschetta',
                'description' => 'Tomato and basil bruschetta',
                'category' => 'appetizer',
                'price' => 10000,
                'prep_area' => 'kitchen',
                'preparation_time' => 8,
                'is_available' => true,
            ],

            // Main Courses
            [
                'name' => 'Grilled Tilapia',
                'description' => 'Whole grilled tilapia with chips and salad',
                'category' => 'main',
                'price' => 25000,
                'prep_area' => 'kitchen',
                'preparation_time' => 20,
                'is_available' => true,
            ],
            [
                'name' => 'Beef Steak',
                'description' => '250g beef steak with mashed potatoes and vegetables',
                'category' => 'main',
                'price' => 35000,
                'prep_area' => 'kitchen',
                'preparation_time' => 25,
                'is_available' => true,
            ],
            [
                'name' => 'Chicken Biriyani',
                'description' => 'Spiced chicken biriyani with raita',
                'category' => 'main',
                'price' => 18000,
                'prep_area' => 'kitchen',
                'preparation_time' => 15,
                'is_available' => true,
            ],
            [
                'name' => 'Fish & Chips',
                'description' => 'Battered fish with french fries',
                'category' => 'main',
                'price' => 22000,
                'prep_area' => 'kitchen',
                'preparation_time' => 18,
                'is_available' => true,
            ],
            [
                'name' => 'Vegetable Pasta',
                'description' => 'Creamy vegetable pasta',
                'category' => 'main',
                'price' => 16000,
                'prep_area' => 'kitchen',
                'preparation_time' => 15,
                'is_available' => true,
            ],
            [
                'name' => 'Grilled Chicken',
                'description' => 'Grilled chicken breast with rice and vegetables',
                'category' => 'main',
                'price' => 20000,
                'prep_area' => 'kitchen',
                'preparation_time' => 20,
                'is_available' => true,
            ],
            [
                'name' => 'Pilau Rice with Beef',
                'description' => 'Spiced pilau rice with tender beef',
                'category' => 'main',
                'price' => 18000,
                'prep_area' => 'kitchen',
                'preparation_time' => 18,
                'is_available' => true,
            ],
            [
                'name' => 'Seafood Platter',
                'description' => 'Mixed seafood with garlic butter',
                'category' => 'main',
                'price' => 45000,
                'prep_area' => 'kitchen',
                'preparation_time' => 30,
                'is_available' => true,
            ],

            // Desserts
            [
                'name' => 'Chocolate Cake',
                'description' => 'Rich chocolate cake with vanilla ice cream',
                'category' => 'dessert',
                'price' => 10000,
                'prep_area' => 'kitchen',
                'preparation_time' => 5,
                'is_available' => true,
            ],
            [
                'name' => 'Tiramisu',
                'description' => 'Classic Italian tiramisu',
                'category' => 'dessert',
                'price' => 12000,
                'prep_area' => 'kitchen',
                'preparation_time' => 5,
                'is_available' => true,
            ],
            [
                'name' => 'Ice Cream Sundae',
                'description' => 'Three scoops with toppings',
                'category' => 'dessert',
                'price' => 8000,
                'prep_area' => 'kitchen',
                'preparation_time' => 5,
                'is_available' => true,
            ],
            [
                'name' => 'Fruit Salad',
                'description' => 'Fresh tropical fruit salad',
                'category' => 'dessert',
                'price' => 7000,
                'prep_area' => 'kitchen',
                'preparation_time' => 5,
                'is_available' => true,
            ],

            // Drinks (Bar)
            [
                'name' => 'Mojito',
                'description' => 'Classic mint mojito',
                'category' => 'drink',
                'price' => 12000,
                'prep_area' => 'bar',
                'preparation_time' => 5,
                'is_available' => true,
            ],
            [
                'name' => 'Piña Colada',
                'description' => 'Tropical piña colada',
                'category' => 'drink',
                'price' => 15000,
                'prep_area' => 'bar',
                'preparation_time' => 5,
                'is_available' => true,
            ],
            [
                'name' => 'Fresh Orange Juice',
                'description' => 'Freshly squeezed orange juice',
                'category' => 'drink',
                'price' => 6000,
                'prep_area' => 'bar',
                'preparation_time' => 3,
                'is_available' => true,
            ],
            [
                'name' => 'Passion Juice',
                'description' => 'Fresh passion fruit juice',
                'category' => 'drink',
                'price' => 6000,
                'prep_area' => 'bar',
                'preparation_time' => 3,
                'is_available' => true,
            ],
            [
                'name' => 'Mango Smoothie',
                'description' => 'Creamy mango smoothie',
                'category' => 'drink',
                'price' => 8000,
                'prep_area' => 'bar',
                'preparation_time' => 5,
                'is_available' => true,
            ],
            [
                'name' => 'Coffee',
                'description' => 'Espresso or Americano',
                'category' => 'drink',
                'price' => 5000,
                'prep_area' => 'bar',
                'preparation_time' => 3,
                'is_available' => true,
            ],
            [
                'name' => 'Cappuccino',
                'description' => 'Classic cappuccino',
                'category' => 'drink',
                'price' => 6000,
                'prep_area' => 'bar',
                'preparation_time' => 4,
                'is_available' => true,
            ],
            [
                'name' => 'Coca Cola',
                'description' => 'Chilled Coca Cola',
                'category' => 'drink',
                'price' => 3000,
                'prep_area' => 'bar',
                'preparation_time' => 1,
                'is_available' => true,
            ],
            [
                'name' => 'Bottled Water',
                'description' => 'Still or sparkling water',
                'category' => 'drink',
                'price' => 2000,
                'prep_area' => 'bar',
                'preparation_time' => 1,
                'is_available' => true,
            ],
            [
                'name' => 'Red Wine (Glass)',
                'description' => 'House red wine',
                'category' => 'drink',
                'price' => 10000,
                'prep_area' => 'bar',
                'preparation_time' => 2,
                'is_available' => true,
            ],
            [
                'name' => 'White Wine (Glass)',
                'description' => 'House white wine',
                'category' => 'drink',
                'price' => 10000,
                'prep_area' => 'bar',
                'preparation_time' => 2,
                'is_available' => true,
            ],
            [
                'name' => 'Local Beer',
                'description' => 'Kilimanjaro or Safari',
                'category' => 'drink',
                'price' => 5000,
                'prep_area' => 'bar',
                'preparation_time' => 1,
                'is_available' => true,
            ],
        ];

        foreach ($menuItems as $item) {
            MenuItem::create($item);
        }

        $this->command->info('Menu items seeded successfully!');
    }
}

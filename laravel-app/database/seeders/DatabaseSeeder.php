<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('🌱 Seeding database...');

        $this->call([
            StaffSeeder::class,
            MenuSeeder::class,
            TableSeeder::class,
            GuestSeeder::class,
        ]);

        $this->command->info('✅ Database seeding completed successfully!');
        $this->command->newLine();
        $this->command->info('📊 Summary:');
        $this->command->info('  - Staff: 8 members (admin, manager, waiters, chefs, bartender)');
        $this->command->info('  - Menu: 30 items (appetizers, mains, desserts, drinks)');
        $this->command->info('  - Tables: 23 (10 indoor, 5 outdoor, 8 bar seats)');
        $this->command->info('  - Guests: 10 (with varying loyalty points)');
        $this->command->newLine();
        $this->command->info('🔑 Login credentials:');
        $this->command->info('  Admin: admin@seacliff.com / password');
        $this->command->info('  Manager: manager@seacliff.com / password');
        $this->command->info('  All staff: password');
    }
}

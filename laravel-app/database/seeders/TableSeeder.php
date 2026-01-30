<?php

namespace Database\Seeders;

use App\Models\Table;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tables = [];

        // Indoor Tables (1-10)
        for ($i = 1; $i <= 10; $i++) {
            $tables[] = [
                'name' => "Table $i",
                'location' => 'indoor',
                'capacity' => ($i % 3 === 0) ? 6 : (($i % 2 === 0) ? 4 : 2),
                'status' => 'available',
            ];
        }

        // Outdoor Tables (11-15)
        for ($i = 11; $i <= 15; $i++) {
            $tables[] = [
                'name' => "Table $i (Outdoor)",
                'location' => 'outdoor',
                'capacity' => ($i % 2 === 0) ? 4 : 2,
                'status' => 'available',
            ];
        }

        // Bar Seats (1-8)
        for ($i = 1; $i <= 8; $i++) {
            $tables[] = [
                'name' => "Bar Seat $i",
                'location' => 'bar',
                'capacity' => 1,
                'status' => 'available',
            ];
        }

        foreach ($tables as $table) {
            Table::create($table);
        }

        $this->command->info('Tables seeded successfully!');
        $this->command->info('Created: 10 indoor tables, 5 outdoor tables, 8 bar seats');
    }
}

<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            ['name' => 'Adet', 'short_name' => 'adet'],
            ['name' => 'Kilogram', 'short_name' => 'kg'],
            ['name' => 'Gram', 'short_name' => 'g'],
            ['name' => 'Miligram', 'short_name' => 'mg'],
            ['name' => 'Litre', 'short_name' => 'L'],
            ['name' => 'Mililitre', 'short_name' => 'mL'],
            ['name' => 'Metre', 'short_name' => 'm'],
            ['name' => 'Kutu', 'short_name' => 'kt'],
            ['name' => 'Santimetre', 'short_name' => 'cm'],
            ['name' => 'Milimetre', 'short_name' => 'mm'],
            ['name' => 'Kilometre', 'short_name' => 'km'],
            ['name' => 'Metrekare', 'short_name' => 'm²'],
            ['name' => 'Metreküp', 'short_name' => 'm³'],
        ];

        foreach ($units as $unit) {
            Unit::updateOrCreate(
                ['name' => $unit['name']],
                ['short_name' => $unit['short_name']]
            );
        }
    }
}

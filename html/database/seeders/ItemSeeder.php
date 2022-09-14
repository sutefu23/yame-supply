<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        \App\Models\Unit::create([
            'id'    => 1,
            'name' => '本',
        ]);

        \App\Models\Warehouse::create([
            'id'    => 1,
            'name' => '倉庫名',
        ]);

        \App\Models\WoodSpecies::create([
            'id'    => 1,
            'name' => '杉',
        ]);

        $items =
            [
                [
                    'id'    => 1,
                    'length' => 3000,
                    'width' => 105,
                    'thickness' => 105,
                    'raw_wood_size' => 140,
                    'warehouse_id' => 1,
                    'memo' => '',
                    'quantity' => 150,
                    'essential_quantity' => 100,
                    'unit_id' => 1,
                    'wood_species_id' => 1,
                ],
                [
                    'id'    => 2,
                    'length' => 3000,
                    'width' => 105,
                    'thickness' => 150,
                    'raw_wood_size' => 200,
                    'warehouse_id' => 1,
                    'memo' => '',
                    'quantity' => 10,
                    'essential_quantity' => 10,
                    'unit_id' => 1,
                    'wood_species_id' => 1,
                ],
                [
                    'id'    => 3,
                    'length' => 3000,
                    'width' => 105,
                    'thickness' => 180,
                    'raw_wood_size' => 220,
                    'warehouse_id' => 1,
                    'memo' => '',
                    'quantity' => 145,
                    'essential_quantity' => 10,
                    'unit_id' => 1,
                    'wood_species_id' => 1,
                ],
                [
                    'id'    => 4,
                    'length' => 3000,
                    'width' => 105,
                    'thickness' => 210,
                    'raw_wood_size' => 240,
                    'warehouse_id' => 1,
                    'memo' => '',
                    'quantity' => 5,
                    'essential_quantity' => 7,
                    'unit_id' => 1,
                    'wood_species_id' => 1,
                ],
                [
                    'id'    => 5,
                    'length' => 3000,
                    'width' => 105,
                    'thickness' => 240,
                    'raw_wood_size' => 280,
                    'warehouse_id' => 1,
                    'memo' => '',
                    'quantity' => 10,
                    'essential_quantity' => 2,
                    'unit_id' => 1,
                    'wood_species_id' => 1,
                ],
                [
                    'id'    => 6,
                    'length' => 3000,
                    'width' => 105,
                    'thickness' => 270,
                    'raw_wood_size' => 300,
                    'warehouse_id' => 1,
                    'memo' => '',
                    'quantity' => 70,
                    'essential_quantity' => 3,
                    'unit_id' => 1,
                    'wood_species_id' => 1,
                ],
                [
                    'id'    => 7,
                    'length' => 4000,
                    'width' => 105,
                    'thickness' => 105,
                    'raw_wood_size' => 160,
                    'warehouse_id' => 1,
                    'memo' => '',
                    'quantity' => 120,
                    'essential_quantity' => 32,
                    'unit_id' => 1,
                    'wood_species_id' => 1,
                ],
                [
                    'id'    => 8,
                    'length' => 4000,
                    'width' => 105,
                    'thickness' => 150,
                    'raw_wood_size' => 200,
                    'warehouse_id' => 1,
                    'memo' => '',
                    'quantity' => 50,
                    'essential_quantity' => 10,
                    'unit_id' => 1,
                    'wood_species_id' => 1,
                ],
                [
                    'id'    => 9,
                    'length' => 4000,
                    'width' => 105,
                    'thickness' => 180,
                    'raw_wood_size' => 220,
                    'warehouse_id' => 1,
                    'memo' => '',
                    'quantity' => 10,
                    'essential_quantity' => 10,
                    'unit_id' => 1,
                    'wood_species_id' => 1,
                ],
                [
                    'id'    => 10,
                    'length' => 4000,
                    'width' => 105,
                    'thickness' => 210,
                    'raw_wood_size' => 260,
                    'warehouse_id' => 1,
                    'memo' => '',
                    'quantity' => 14,
                    'essential_quantity' => 6,
                    'unit_id' => 1,
                    'wood_species_id' => 1,
                ],
                [
                    'id'    => 11,
                    'length' => 4000,
                    'width' => 105,
                    'thickness' => 240,
                    'raw_wood_size' => 280,
                    'warehouse_id' => 1,
                    'memo' => '',
                    'quantity' => 26,
                    'essential_quantity' => 8,
                    'unit_id' => 1,
                    'wood_species_id' => 1,
                ],
                [
                    'id'    => 12,
                    'length' => 4000,
                    'width' => 105,
                    'thickness' => 270,
                    'raw_wood_size' => 300,
                    'warehouse_id' => 1,
                    'memo' => '',
                    'quantity' => 30,
                    'essential_quantity' => 2,
                    'unit_id' => 1,
                    'wood_species_id' => 1,
                ],
            ];
        //一括登録
        foreach($items as $item) {
            \App\Models\Item::create($item);
        }
    }
}

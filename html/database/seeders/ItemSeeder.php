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
    public function run()
    {
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
        \App\Models\WoodSpecies::create([
            'id'    => 2,
            'name' => '桧',
        ]);

        $items =
            [
                [
                    'length' => 3000,
                    'width' => 90,
                    'thickness' => 90,
                    'raw_wood_size' => 0,
                    'warehouse_id' => 1,
                    'memo' => '',
                    'quantity' => 0,
                    'essential_quantity' => 10,
                    'unit_id' => 1,
                    'wood_species_id' => 1,
                    'defective_quantity'  => 0,
                    'manufacturing_quantity'  => 0,
                    'raw_wood_arrival_quantity'  => 0,
                    'raw_wood_arrangement_quantity'  => 0,
                ],
                [
                    'length' => 3000,
                    'width' => 105,
                    'thickness' => 105,
                    'raw_wood_size' => 140,
                    'warehouse_id' => 1,
                    'memo' => '',
                    'quantity' => 0,
                    'essential_quantity' => 10,
                    'unit_id' => 1,
                    'wood_species_id' => 1,
                    'defective_quantity'  => 0,
                    'manufacturing_quantity'  => 0,
                    'raw_wood_arrival_quantity'  => 0,
                    'raw_wood_arrangement_quantity'  => 0,
                ],
                [
                    'length' => 3000,
                    'width' => 105,
                    'thickness' => 150,
                    'raw_wood_size' => 200,
                    'warehouse_id' => 1,
                    'memo' => '',
                    'quantity' => 0,
                    'essential_quantity' => 10,
                    'unit_id' => 1,
                    'wood_species_id' => 1,
                    'defective_quantity'  => 0,
                    'manufacturing_quantity'  => 0,
                    'raw_wood_arrival_quantity'  => 0,
                    'raw_wood_arrangement_quantity'  => 0,
                ],
                [
                    'length' => 3000,
                    'width' => 105,
                    'thickness' => 180,
                    'raw_wood_size' => 220,
                    'warehouse_id' => 1,
                    'memo' => '',
                    'quantity' => 0,
                    'essential_quantity' => 10,
                    'unit_id' => 1,
                    'wood_species_id' => 1,
                    'defective_quantity'  => 0,
                    'manufacturing_quantity'  => 0,
                    'raw_wood_arrival_quantity'  => 0,
                    'raw_wood_arrangement_quantity'  => 0,
                ],
                [
                    'length' => 3000,
                    'width' => 105,
                    'thickness' => 210,
                    'raw_wood_size' => 240,
                    'warehouse_id' => 1,
                    'memo' => '',
                    'quantity' => 0,
                    'essential_quantity' => 10,
                    'unit_id' => 1,
                    'wood_species_id' => 1,
                    'defective_quantity'  => 0,
                    'manufacturing_quantity'  => 0,
                    'raw_wood_arrival_quantity'  => 0,
                    'raw_wood_arrangement_quantity'  => 0,
                ],
                [
                    'length' => 3000,
                    'width' => 120,
                    'thickness' => 120,
                    'raw_wood_size' => 0,
                    'warehouse_id' => 1,
                    'memo' => '',
                    'quantity' => 0,
                    'essential_quantity' => 10,
                    'unit_id' => 1,
                    'wood_species_id' => 1,
                    'defective_quantity'  => 0,
                    'manufacturing_quantity'  => 0,
                    'raw_wood_arrival_quantity'  => 0,
                    'raw_wood_arrangement_quantity'  => 0,
                ],
                [
                    'length' => 4000,
                    'width' => 90,
                    'thickness' => 90,
                    'raw_wood_size' => 160,
                    'warehouse_id' => 1,
                    'memo' => '',
                    'quantity' => 0,
                    'essential_quantity' => 10,
                    'unit_id' => 1,
                    'wood_species_id' => 1,
                    'defective_quantity'  => 0,
                    'manufacturing_quantity'  => 0,
                    'raw_wood_arrival_quantity'  => 0,
                    'raw_wood_arrangement_quantity'  => 0,
                ],
                [
                    'length' => 4000,
                    'width' => 105,
                    'thickness' => 105,
                    'raw_wood_size' => 160,
                    'warehouse_id' => 1,
                    'memo' => '',
                    'quantity' => 0,
                    'essential_quantity' => 10,
                    'unit_id' => 1,
                    'wood_species_id' => 1,
                    'defective_quantity'  => 0,
                    'manufacturing_quantity'  => 0,
                    'raw_wood_arrival_quantity'  => 0,
                    'raw_wood_arrangement_quantity'  => 0,
                ],
                [
                    'length' => 4000,
                    'width' => 105,
                    'thickness' => 150,
                    'raw_wood_size' => 200,
                    'warehouse_id' => 1,
                    'memo' => '',
                    'quantity' => 0,
                    'essential_quantity' => 10,
                    'unit_id' => 1,
                    'wood_species_id' => 1,
                    'defective_quantity'  => 0,
                    'manufacturing_quantity'  => 0,
                    'raw_wood_arrival_quantity'  => 0,
                    'raw_wood_arrangement_quantity'  => 0,
                ],
                [
                    'length' => 4000,
                    'width' => 105,
                    'thickness' => 180,
                    'raw_wood_size' => 220,
                    'warehouse_id' => 1,
                    'memo' => '',
                    'quantity' => 0,
                    'essential_quantity' => 10,
                    'unit_id' => 1,
                    'wood_species_id' => 1,
                    'defective_quantity'  => 0,
                    'manufacturing_quantity'  => 0,
                    'raw_wood_arrival_quantity'  => 0,
                    'raw_wood_arrangement_quantity'  => 0,
                ],
                [
                    'length' => 4000,
                    'width' => 105,
                    'thickness' => 210,
                    'raw_wood_size' => 260,
                    'warehouse_id' => 1,
                    'memo' => '',
                    'quantity' => 0,
                    'essential_quantity' => 10,
                    'unit_id' => 1,
                    'wood_species_id' => 1,
                    'defective_quantity'  => 0,
                    'manufacturing_quantity'  => 0,
                    'raw_wood_arrival_quantity'  => 0,
                    'raw_wood_arrangement_quantity'  => 0,
                ],
                [
                    'length' => 4000,
                    'width' => 120,
                    'thickness' => 120,
                    'raw_wood_size' => 0,
                    'warehouse_id' => 1,
                    'memo' => '',
                    'quantity' => 0,
                    'essential_quantity' => 10,
                    'unit_id' => 1,
                    'wood_species_id' => 1,
                    'defective_quantity'  => 0,
                    'manufacturing_quantity'  => 0,
                    'raw_wood_arrival_quantity'  => 0,
                    'raw_wood_arrangement_quantity'  => 0,
                ],
                ///桧
                [
                    'length' => 3000,
                    'width' => 120,
                    'thickness' => 120,
                    'raw_wood_size' => 0,
                    'warehouse_id' => 1,
                    'memo' => '',
                    'quantity' => 0,
                    'essential_quantity' => 10,
                    'unit_id' => 1,
                    'wood_species_id' => 2,
                    'defective_quantity'  => 0,
                    'manufacturing_quantity'  => 0,
                    'raw_wood_arrival_quantity'  => 0,
                    'raw_wood_arrangement_quantity'  => 0,
                ],
                [
                    'length' => 3000,
                    'width' => 105,
                    'thickness' => 105,
                    'raw_wood_size' => 0,
                    'warehouse_id' => 1,
                    'memo' => '',
                    'quantity' => 0,
                    'essential_quantity' => 10,
                    'unit_id' => 1,
                    'wood_species_id' => 2,
                    'defective_quantity'  => 0,
                    'manufacturing_quantity'  => 0,
                    'raw_wood_arrival_quantity'  => 0,
                    'raw_wood_arrangement_quantity'  => 0,
                ],
                [
                    'length' => 4000,
                    'width' => 105,
                    'thickness' => 105,
                    'raw_wood_size' => 0,
                    'warehouse_id' => 1,
                    'memo' => '',
                    'quantity' => 0,
                    'essential_quantity' => 10,
                    'unit_id' => 1,
                    'wood_species_id' => 2,
                    'defective_quantity'  => 0,
                    'manufacturing_quantity'  => 0,
                    'raw_wood_arrival_quantity'  => 0,
                    'raw_wood_arrangement_quantity'  => 0,
                ],
                [
                    'length' => 4000,
                    'width' => 120,
                    'thickness' => 120,
                    'raw_wood_size' => 0,
                    'warehouse_id' => 1,
                    'memo' => '',
                    'quantity' => 0,
                    'essential_quantity' => 10,
                    'unit_id' => 1,
                    'wood_species_id' => 2,
                    'defective_quantity'  => 0,
                    'manufacturing_quantity'  => 0,
                    'raw_wood_arrival_quantity'  => 0,
                    'raw_wood_arrangement_quantity'  => 0,
                ],
            ];
        //一括登録
        foreach ($items as $item) {
            \App\Models\Item::create($item);
        }
    }
}

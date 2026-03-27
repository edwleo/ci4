<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class VehiculosSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            [
                'idmarca' => 1,
                'modelo' => 'Corolla',
                'anio' => '2020',
                'color' => 'Blanco',
                'precio' => 20000.00,
                'created_at' => $now
            ],
            [
                'idmarca' => 2,
                'modelo' => 'Civic',
                'anio' => '2019',
                'color' => 'Negro',
                'precio' => 22000.00,
                'created_at' => $now
            ]
        ];

        $this->db->table('vehiculos')->insertBatch($data);
    }
}

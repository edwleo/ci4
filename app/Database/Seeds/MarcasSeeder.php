<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MarcasSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            ["marca" => "Toyota", "created_at" => $now],
            ["marca" => "Honda", "created_at" => $now],
            ["marca" => "Ford", "created_at" => $now],
            ["marca" => "Chevrolet", "created_at" => $now],
            ["marca" => "Nissan", "created_at" => $now],
            ["marca" => "Volkswagen", "created_at" => $now],
            ["marca" => "Hyundai", "created_at" => $now],
            ["marca" => "Kia", "created_at" => $now],
            ["marca" => "Mazda", "created_at" => $now],
            ["marca" => "Subaru", "created_at" => $now]
        ];

        $this->db->table('marcas')->insertBatch($data);
    }
}

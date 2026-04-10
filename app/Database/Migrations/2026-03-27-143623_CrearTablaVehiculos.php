<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CrearTablaVehiculos extends Migration
{
    public function up()
    {
        //** PK = UNIQUE + NOT NULL ***
        //Campos de la tabla
        $this->forge->addField([
            "id" => [
                "type"=> "INT",
                "constraint" => 11,
                "unsigned" => true,
                "auto_increment" => true
            ],
            "idmarca" => [
                "type"=> "INT",
                "constraint" => 11,
                "unsigned" => true,
                "null" => false
            ],
            "modelo" => [
                "type"=> "VARCHAR",
                "constraint" => 50,
                "null" => false
            ],
            "anio" => [
                "type"=> "CHAR",
                "constraint" => 4,
                "null" => false
            ],
            "color" => [
                "type"=> "VARCHAR",
                "constraint" => 50,
                "null"=> false
            ],
            "precio" => [
                "type"=> "DECIMAL",
                "constraint" => "10,2",
                "null"=> false
            ],
            "create_at" => [
                "type"=> "DATETIME",
                "null" => true
            ],
            "update_at" => [
                "type" => "DATETIME",
                "null" => true
            ]
        ]);

        //Restricciones
        $this->forge->addPrimaryKey("id");
        $this->forge->addKey('');
        //campoForáneo, tabla, clavePrimaria, PermisoActualizar, PermisoEliminar
        $this->forge->addForeignKey("idmarca","marcas","id","RESTRICT","RESTRICT");

        //Creación de tabla
        $this->forge->createTable("vehiculos");
    }

    public function down()
    {
        $this->forge->dropTable("vehiculos");
    }
}

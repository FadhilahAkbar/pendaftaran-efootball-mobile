<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tournaments extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'        => ['type' => 'VARCHAR', 'constraint' => '255'],
            'description' => ['type' => 'TEXT', 'null' => true],
            'status'      => ['type' => 'ENUM', 'constraint' => ['open', 'ongoing', 'completed'], 'default' => 'open'],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tournaments');
    }

    public function down()
    {
        $this->forge->dropTable('tournaments');
    }
}

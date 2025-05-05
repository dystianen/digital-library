<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Books extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'book_id' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'isbn' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'author' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'year_published' => [
                'type' => 'YEAR',
            ],
            'quantity_available' => [
                'type' => 'INT',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);
        $this->forge->addKey('book_id', true);
        $this->forge->createTable('books');
    }

    public function down()
    {
        $this->forge->dropTable('books');
    }
}

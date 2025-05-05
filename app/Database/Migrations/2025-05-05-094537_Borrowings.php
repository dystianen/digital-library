<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Borrowings extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'borrowing_id' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'member_id' => [
                'type' => 'INT',
            ],
            'book_id' => [
                'type' => 'INT',
            ],
            'borrow_date' => [
                'type' => 'DATE',
            ],
            'return_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['borrowed', 'returned'],
                'default'    => 'borrowed',
            ],
        ]);
        $this->forge->addKey('borrowing_id', true);
        $this->forge->addForeignKey('member_id', 'members', 'member_id');
        $this->forge->addForeignKey('book_id', 'books', 'book_id');
        $this->forge->createTable('borrowings');
    }

    public function down()
    {
        $this->forge->dropTable('borrowings');
    }
}

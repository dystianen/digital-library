<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'isbn' => '978-3-0000000001',
                'title' => 'The Art of Programming',
                'author' => 'Donald Knuth',
                'year_published' => 1968,
                'quantity_available' => 5,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'isbn' => '978-3-0000000002',
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'year_published' => 2008,
                'quantity_available' => 3,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'isbn' => '978-3-0000000003',
                'title' => 'Design Patterns',
                'author' => 'Erich Gamma',
                'year_published' => 1994,
                'quantity_available' => 2,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'isbn' => '978-3-0000000004',
                'title' => 'Refactoring',
                'author' => 'Martin Fowler',
                'year_published' => 1999,
                'quantity_available' => 4,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'isbn' => '978-3-0000000005',
                'title' => 'You Don’t Know JS',
                'author' => 'Kyle Simpson',
                'year_published' => 2015,
                'quantity_available' => 6,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'isbn' => '978-3-0000000006',
                'title' => 'Eloquent JavaScript',
                'author' => 'Marijn Haverbeke',
                'year_published' => 2018,
                'quantity_available' => 5,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'isbn' => '978-3-0000000007',
                'title' => 'Introduction to Algorithms',
                'author' => 'Thomas H. Cormen',
                'year_published' => 2009,
                'quantity_available' => 3,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'isbn' => '978-3-0000000008',
                'title' => 'The Pragmatic Programmer',
                'author' => 'Andy Hunt',
                'year_published' => 1999,
                'quantity_available' => 4,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'isbn' => '978-3-0000000009',
                'title' => 'Code Complete',
                'author' => 'Steve McConnell',
                'year_published' => 2004,
                'quantity_available' => 2,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'isbn' => '978-3-0000000010',
                'title' => 'The Mythical Man-Month',
                'author' => 'Fred Brooks',
                'year_published' => 1975,
                'quantity_available' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'isbn' => '978-3-0000000011',
                'title' => 'Working Effectively with Legacy Code',
                'author' => 'Michael Feathers',
                'year_published' => 2005,
                'quantity_available' => 6,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'isbn' => '978-3-0000000012',
                'title' => "Don't Make Me Think",
                'author' => 'Steve Krug',
                'year_published' => 2000,
                'quantity_available' => 4,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'isbn' => '978-3-0000000013',
                'title' => 'Cracking the Coding Interview',
                'author' => 'Gayle Laakmann McDowell',
                'year_published' => 2015,
                'quantity_available' => 3,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'isbn' => '978-3-0000000014',
                'title' => 'Soft Skills: The Software Developer’s Life Manual',
                'author' => 'John Sonmez',
                'year_published' => 2014,
                'quantity_available' => 2,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'isbn' => '978-3-0000000015',
                'title' => 'Domain-Driven Design',
                'author' => 'Eric Evans',
                'year_published' => 2003,
                'quantity_available' => 3,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'isbn' => '978-3-0000000016',
                'title' => 'The Phoenix Project',
                'author' => 'Gene Kim',
                'year_published' => 2013,
                'quantity_available' => 5,
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('books')->insertBatch($data);
    }
}

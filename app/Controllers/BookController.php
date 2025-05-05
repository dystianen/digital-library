<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookModel;
use App\Models\BorrowingModel;
use CodeIgniter\API\ResponseTrait;

class BookController extends BaseController
{
    use ResponseTrait;
    protected $bookModel;
    protected $borrowingModel;

    public function __construct()
    {
        $this->bookModel = new BookModel();
        $this->borrowingModel = new BorrowingModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page') ? (int)$this->request->getVar('page') : 1;
        $totalLimit = 10;
        $offset = ($currentPage - 1) * $totalLimit;
        $books = $this->bookModel
            ->findAll($totalLimit, $offset);

        $totalRows = $this->bookModel
            ->countAllResults();

        $totalPages = ceil($totalRows / $totalLimit);
        $data = [
            "data" => $books,
            "pager" => [
                "totalPages" => $totalPages,
                "currentPage" => $currentPage,
                "limit" => $totalLimit,
            ],
        ];

        return view('admin/books/v_books', $data);
    }

    // CREATE
    public function create()
    {
        $data = $this->request->getPost([
            'isbn',
            'title',
            'author',
            'year_published',
            'quantity_available'
        ]);

        $this->bookModel->insert($data);
        return redirect()->back()->with('success', 'Buku berhasil ditambahkan.');
    }

    // UPDATE
    public function update($id)
    {
        $data = $this->request->getPost([
            'isbn',
            'title',
            'author',
            'year_published',
            'quantity_available'
        ]);

        $this->bookModel->update($id, $data);
        return redirect()->back()->with('success', 'Buku berhasil diperbarui.');
    }

    // DELETE
    public function delete($id)
    {
        // Check if the book is still borrowed
        $isBorrowed = $this->borrowingModel
            ->where('book_id', $id)
            ->where('status', 'borrowed')
            ->orWhere('status', 'returned')
            ->countAllResults();

        if ($isBorrowed > 0) {
            return redirect()->back()->with('failed', 'This book cannot be deleted because it is currently borrowed.');
        }

        // Proceed to delete if it's not being borrowed
        $this->bookModel->delete($id);
        return redirect()->back()->with('success', 'The book has been successfully deleted.');
    }
}

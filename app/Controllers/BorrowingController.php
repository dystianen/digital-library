<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookModel;
use App\Models\BorrowingModel;
use App\Models\MemberModel;
use CodeIgniter\API\ResponseTrait;

class BorrowingController extends BaseController
{
    use ResponseTrait;
    protected $borrowingModel;
    protected $bookModel;
    protected $memberModel;

    public function __construct()
    {
        $this->borrowingModel = new BorrowingModel();
        $this->bookModel = new BookModel();
        $this->memberModel = new MemberModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page') ? (int)$this->request->getVar('page') : 1;
        $totalLimit = 10;
        $offset = ($currentPage - 1) * $totalLimit;

        $borrowings = $this->borrowingModel
            ->select('members.full_name, books.title, borrow_date, return_date, borrowings.status AS borrow_status')
            ->join('members', 'members.member_id = borrowings.member_id')
            ->join('books', 'books.book_id = borrowings.book_id')
            ->findAll($totalLimit, $offset);

        $totalRows = $this->borrowingModel->countAllResults();
        $totalPages = ceil($totalRows / $totalLimit);

        $data = [
            "data" => $borrowings,
            "pager" => [
                "totalPages" => $totalPages,
                "currentPage" => $currentPage,
                "limit" => $totalLimit,
            ],
        ];

        return view('admin/borrowing/v_borrowing', $data);
    }


    public function borrow($bookId)
    {
        $book = $this->bookModel->find($bookId);

        if (!$book) {
            return redirect()->back()->with('failed', 'Book not found.');
        }

        $memberId = session()->get('member_id');

        // Check if this user has an active borrow for this book
        $existingBorrow = $this->borrowingModel
            ->where('member_id', $memberId)
            ->where('book_id', $bookId)
            ->where('status', 'borrowed')
            ->first();

        if ($existingBorrow) {
            // Mark as returned
            $this->borrowingModel->update($existingBorrow['borrowing_id'], [
                'status' => 'returned',
                'return_date' => date('Y-m-d')
            ]);

            // Increase book quantity
            $this->bookModel->update($bookId, [
                'quantity_available' => $book['quantity_available'] + 1
            ]);

            return redirect()->back()->with('success', 'Book has been returned.');
        }

        // If quantity not available
        if ($book['quantity_available'] < 1) {
            return redirect()->back()->with('failed', 'Book is not available for borrowing.');
        }

        // Insert new borrow record
        $this->borrowingModel->insert([
            'member_id' => $memberId,
            'book_id' => $bookId,
            'borrow_date' => date('Y-m-d'),
            'status' => 'borrowed'
        ]);

        // Decrease quantity
        $this->bookModel->update($bookId, [
            'quantity_available' => $book['quantity_available'] - 1
        ]);

        return redirect()->back()->with('success', 'Book has been borrowed.');
    }

    public function borrowed()
    {
        $memberId = session()->get('member_id');

        $borrowedBooks = $this->borrowingModel
            ->join('members', 'members.member_id = borrowings.member_id')
            ->join('books', 'books.book_id = borrowings.book_id')
            ->where('borrowings.member_id', $memberId)
            ->where('borrowings.status', 'borrowed')
            ->findAll();

        $data = [
            "data" => $borrowedBooks,
        ];

        return view('member/v_borrowed', $data);
    }
}

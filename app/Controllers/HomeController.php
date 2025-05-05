<?php

namespace App\Controllers;

use App\Models\BookModel;
use App\Models\BorrowingModel;
use CodeIgniter\API\ResponseTrait;

class HomeController extends BaseController
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

        $memberId = session()->get('member_id');

        $borrowedBooks = $this->borrowingModel
            ->select('book_id')
            ->where('member_id', $memberId)
            ->where('status', 'borrowed')
            ->findAll();

        $borrowedBookIds = array_column($borrowedBooks, 'book_id');

        $books = $this->bookModel
            ->findAll($totalLimit, $offset);

        foreach ($books as &$book) {
            $book['borrowed'] = in_array($book['book_id'], $borrowedBookIds);
        }

        $totalRows = $this->bookModel->countAllResults();
        $totalPages = ceil($totalRows / $totalLimit);

        $data = [
            "data" => $books,
            "pager" => [
                "totalPages" => $totalPages,
                "currentPage" => $currentPage,
                "limit" => $totalLimit,
            ],
        ];

        return view('member/v_home', $data);
    }
}

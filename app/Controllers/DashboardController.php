<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookModel;
use App\Models\BorrowingModel;
use App\Models\MemberModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    use ResponseTrait;
    protected $bookModel;
    protected $memberModel;
    protected $borrowingModel;

    public function __construct()
    {
        $this->bookModel = new BookModel();
        $this->memberModel = new MemberModel();
        $this->borrowingModel = new BorrowingModel();
    }

    public function index()
    {
        $totalBooks = $this->bookModel->countAllResults();
        $totalMembers = $this->memberModel->countAllResults();
        $totalBorrowing = $this->borrowingModel->countAllResults();

        $data = [
            "totalBooks" => $totalBooks,
            "totalMembers" => $totalMembers,
            "totalBorrowing" => $totalBorrowing
        ];

        return view('admin/dashboard/v_dashboard', $data);
    }
}

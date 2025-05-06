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

        $borrowings = $this->borrowingModel->select("MONTH(borrow_date) as month, COUNT(*) as total")
            ->groupBy("MONTH(borrow_date)")
            ->orderBy("MONTH(borrow_date)")
            ->findAll();

        // Siapkan data untuk chart
        $labels = [];
        $data = [];

        foreach ($borrowings as $b) {
            $labels[] = date('F', mktime(0, 0, 0, $b['month'], 1)); // Nama bulan
            $data[] = (int) $b['total'];
        }

        $data = [
            "totalBooks" => $totalBooks,
            "totalMembers" => $totalMembers,
            "totalBorrowing" => $totalBorrowing,
            'chartLabels' => json_encode($labels),
            'chartData' => json_encode($data)
        ];

        return view('admin/dashboard/v_dashboard', $data);
    }
}

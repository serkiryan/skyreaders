<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Book;
use App\Exports\XlsExport;
use App\Exports\PdfExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;


class HomeController extends Controller
{
    public function index() {
        return view('home.index', []);
    }

    public function exportXls(Request $r) 
    {
        $users = User::with(['books' => function($query) use ($r) { 
            $query->whereBetween('created_at', array(Carbon::create($r->from)->format('Y-m-d'), Carbon::create($r->to)->format('Y-m-d')));
        }])
        ->whereHas('books', function ($q) use ($r){
            $q->whereBetween('created_at', array(Carbon::create($r->from)->format('Y-m-d'), Carbon::create($r->to)->format('Y-m-d')));
        })
        ->get();
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->setCellValue('A1', 'Имя')->setCellValue('B1', 'Фамилия')->setCellValue('C1', 'Книги');
        $i = 1;
        foreach ($users as $user) {
            $sheet->setCellValue('A'.++$i, $user->first_name)->setCellValue('B'.$i, $user->last_name);
            foreach ($user->books as $book) {
                $sheet->setCellValue('C'.$i++, $book->title.' ( '.$book->author.' ) ');
            }
        }
        $writer = new Xls($spreadsheet);
        $writer->save('readers.xls');
        return response()->download('readers.xls');
    }

    public function exportPdf(Request $r) {
        $users = User::with(['books' => function($query) use ($r) { 
            $query->whereBetween('created_at', array(Carbon::create($r->from)->format('Y-m-d'), Carbon::create($r->to)->format('Y-m-d')));
        }])
        ->whereHas('books', function ($q) use ($r){
            $q->whereBetween('created_at', array(Carbon::create($r->from)->format('Y-m-d'), Carbon::create($r->to)->format('Y-m-d')));
        })
        ->get();
        
        $pdf = PDF::loadView('home.pdf', ['users' => $users]);
        return $pdf->stream();
    }

    public function getPdf() {
        $users = User::with('books')
        ->where('book_user.created_at', '>=', '2020-02-08 00:00:00')
        ->where('book_user.created_at', '<=', '2020-02-09 00:00:00')
        ->join('book_user', 'users.id', '=', 'book_user.user_id')->get();
        
        return view('home.pdf', ['users' => $users]);
    }
}

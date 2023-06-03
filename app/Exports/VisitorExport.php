<?php

namespace App\Exports;

use App\Models\Visitor;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class VisitorExport implements FromView, ShouldAutoSize
{
    use Exportable;

    private $visitors;

    public function __construct()
    {
        $this->visitors = Visitor::all();
    }

    public function view(): View
    {
        // dd($this->visitors);
        // $this->visitors = Visitor::all();
        // return view('pdf.visitorxls', ['visitors' => $this->visitors]);
        return view('exports.excelvisitors', ['visitors' => $this->visitors]);
    }

}

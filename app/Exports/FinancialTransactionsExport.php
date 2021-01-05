<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class FinancialTransactionsExport implements FromView,ShouldAutoSize,WithEvents
{

  /**
  * Assign model data from controller
  *
  * @param $Model Eloquent
  */
  public function __construct($Model)
  {
    $this->Model = $Model;
  }

  public function view() : View
  {
    return view('admin.exports.financial-transactions', [
      'Items' => $this->Model
    ]);
  }

  /**
  * @return array
  */
  public function registerEvents(): array
  {

    $cellRange = 'A1:F1';
    return [
      AfterSheet::class    => function(AfterSheet $event) use ($cellRange) {
        $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);
        $event->sheet->setAutoFilter($cellRange);
      }
      ];
    }
  }

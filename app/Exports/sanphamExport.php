<?php

namespace App\Exports;

use App\sanpham;
use App\loai;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Events\BeforeWriting;
class sanphamExport implements FromView, WithDrawings, WithEvents, ShouldAutoSize
{
    use Exportable, RegisterEventListeners;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('sanpham.excel', [
        'danhsachsanpham'=>sanpham::all(),
        'danhsachloai'=>loai::all(),
        ]);
    } 
    public function drawings()
    {
        $arrDrawings=[];
        $drawingLogo=new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawingLogo->setName('Logo');
        $drawingLogo->setDescription('Logo');
        $drawingLogo->setPath(public_path('storage/sunshine_wm64.png'));
        $drawingLogo->setHeight(90);
        $drawingLogo->setCoordinates('C4');
        $offsetX=40;
        $drawingLogo->setOffsetX($offsetX);
        $arrDrawings[]=$drawingLogo;
        $startRow=7;
        $ds_sanpham=sanpham::all();
        foreach($ds_sanpham as $index=>$sp)
        {
            $drawing=new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
            $drawing->setName($sp->sp_ten);
            $drawing->setDescription($sp->sp_thongTin);
            $drawing->setPath(public_path('storage/photos/'.$sp->sp_hinh));
            $drawing->setHeight(40);
            $drawing->setWidth(40);
            $drawing->setCoordinates('B'.($startRow + $index));
            $arrDrawings[]=$drawing;
        }
        return $arrDrawings;
    }
    public static function beforeExport(beforeExport $event)
    {
        //
    }  
    public static function beforeWriting(beforeWriting $event){
        //
    }
    public static function beforeSheet(beforeSheet $event)
    {
        //
    }
    public static function afterSheet(AfterSheet $event)
    {
        $event->sheet->getDelegate()->getPageSetup()
        ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $event->sheet->getDelegate()->getRowDimension('4')->setRowHeight(100);
        $event->sheet->getDelegate()->getStyle('A1:C5')->applyFromArray(
            [
                'font'=>[
                    'bold'=>true,
                ],
                'alignment'=>[
                    'horizontal'=>\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ]
            ]
        );
        $event->sheet->getDelegate()->getStyle('A5:F5')->applyFromArray(
            [
                'font'=>[
                    'bold'=>true,
                    ],
                   'alignment'=>[
                       'horizontal'=>\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                   ]
                ]
            );
        $event->sheet->getDelegate()->getStyle('A6:F6')->applyFromArray(
           [
               'font'=>[
                    'bold'=>true,
               ],
                'alignment'=>[
                    'horizontal'=>\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                'borders'=>[
                    'outline'=>[
                        'borderStyle'=>\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color'=>['argb'=>'00000000'],
                    ],
                ]
            ]
        );
        $startRow=7;
        $ds_sanpham=sanpham::all();
        foreach($ds_sanpham as $index=>$sp)
            {
                $currentRow=$startRow + $index;
                $event->sheet->getDelegate()->getRowDimension($currentRow)
                ->setRowHeight(50);
                $coordinate="A${currentRow}:F${currentRow}";
                $event->sheet->getDelegate()->getStyle($coordinate)->applyFromArray(
                    [
                        'alignment'=>[
                            'horizontal'=>\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                        ],
                        'borders'=>[
                            'outline'=>[
                                'borderStyle'=>\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color'=>['argb'=>'00000000'],
                            ],
                        ]
                    ]
                );
            }    
    }
}

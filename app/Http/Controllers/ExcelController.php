<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\Venta;

class ExcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Datos para excel */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $ventas = Venta::whereBetween('date', [$request->desde, $request->hasta])->with('validity')->with('service')->with('partner')->get();
        //dd($ventas);
        if($ventas->count() > 0)
        {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            
            $styleArray = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ];
            $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(13);
            $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(13);
            $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(25);
            $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(30);
            $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(12);
            $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(12);
            $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(18);
            $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(12);
            /* CABECERA */
            $sheet->getStyle('A1:N1')->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A1:N1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setRGB('17a2b8');
            $sheet->setCellValue('A1', 'N° SOLICITUD');
            $sheet->setCellValue('B1', 'FECHA');
            $sheet->setCellValue('C1', 'CEDULA / RUC');
            $sheet->setCellValue('D1', 'CLIENTE');
            $sheet->setCellValue('E1', 'VIGENCIA');
            $sheet->setCellValue('F1', 'SERVICIO');
            $sheet->setCellValue('G1', 'ESTATUS');
            $sheet->setCellValue('H1', 'SUB TOTAL');
            $sheet->setCellValue('I1', 'TOTAL');
            $sheet->setCellValue('J1', 'FORMA DE PAGO');
            $sheet->setCellValue('K1', 'BANCO');
            $sheet->setCellValue('L1', 'PARTNER');
            $sheet->setCellValue('M1', 'ADICIONAL COBRADOS');
            $sheet->setCellValue('N1', 'DESCUENTOS');
            /* PINTAMOS LOS DATOS */
            $col = 2;
            foreach($ventas as $key => $item)
            {
                $sheet->setCellValue('A' . $col, $key+1);
                $sheet->setCellValue('B' . $col, $item->date);
                $sheet->setCellValue('C' . $col, $item->identification);
                $sheet->setCellValue('D' . $col, $item->client);
                $sheet->setCellValue('E' . $col, $item->validity->years);
                $sheet->setCellValue('F' . $col, $item->service->name);
                $sheet->setCellValue('G' . $col, $item->status);
                $sheet->setCellValue('H' . $col, $item->sub_total);
                $sheet->setCellValue('I' . $col, $item->total);
                $sheet->setCellValue('J' . $col, $item->payment_form);
                $sheet->setCellValue('K' . $col, $item->bank);
                $sheet->setCellValue('L' . $col, $item->partner->name);
                $sheet->setCellValue('M' . $col, $item->aditional_price);
                $sheet->setCellValue('N' . $col, $item->discount);
                $col++;
            }

            $writer = new Xlsx($spreadsheet);

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="myfile.xlsx"');
            header('Cache-Control: max-age=0');

            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
        }else{
            dd('No tiene datos en este rango de fechas');
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

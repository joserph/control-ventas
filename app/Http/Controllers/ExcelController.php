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
        
        $ventas = Venta::whereBetween('date', [$request->desde, $request->hasta])->orderBy('date', 'ASC')->with('validity')->with('service')->with('partner')->get();
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
            $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(15);
            /* CABECERA */
            $sheet->getStyle('A1:P1')->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A1:P1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setRGB('17a2b8');
            $sheet->setCellValue('A1', 'N° SOLICITUD');
            $sheet->setCellValue('B1', 'FECHA');
            $sheet->setCellValue('C1', 'CEDULA / RUC');
            $sheet->setCellValue('D1', 'CLIENTE');
            $sheet->setCellValue('E1', 'VIGENCIA');
            $sheet->setCellValue('F1', 'SERVICIO');
            $sheet->setCellValue('G1', 'ESTATUS');
            $sheet->setCellValue('H1', 'SUB TOTAL PARTNER');
            $sheet->setCellValue('I1', 'TOTAL PARTNER');
            $sheet->setCellValue('J1', 'FORMA DE PAGO');
            $sheet->setCellValue('K1', 'BANCO');
            $sheet->setCellValue('L1', 'PARTNER');
            $sheet->setCellValue('M1', 'ADICIONAL COBRADOS');
            $sheet->setCellValue('N1', 'DESCUENTOS');
            $sheet->setCellValue('O1', 'COSTO ANDREA');
            $sheet->setCellValue('P1', 'GANACIA NETA');

            /* PINTAMOS LOS DATOS */
            $col = 2;
            foreach($ventas as $key => $item)
            {
                
                $spreadsheet->getActiveSheet()->getStyle('H' . $col)->getNumberFormat()->setFormatCode('#,##0.00');
                $spreadsheet->getActiveSheet()->getStyle('I' . $col)->getNumberFormat()->setFormatCode('#,##0.00');
                $spreadsheet->getActiveSheet()->getStyle('M' . $col)->getNumberFormat()->setFormatCode('#,##0.00');
                $spreadsheet->getActiveSheet()->getStyle('N' . $col)->getNumberFormat()->setFormatCode('#,##0.00');
                $spreadsheet->getActiveSheet()->getStyle('O' . $col)->getNumberFormat()->setFormatCode('#,##0.00');
                $spreadsheet->getActiveSheet()->getStyle('P' . $col)->getNumberFormat()->setFormatCode('#,##0.00');

                $sheet->setCellValue('A' . $col, $key+1);
                $sheet->setCellValue('B' . $col, date('d-m-Y', strtotime($item->date)));
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
                /* COSTO ANDREA */
                //$costoA = $item->validity->price_total;
                $sheet->setCellValue('O' . $col, $item->validity->price_total);
                /* CALCULO DE GANANCIA NETA */
                if($item->validity->type == 'Ecuafact mas firma' || $item->validity->type == 'Ecuafact mas firma partner nuevo')
                {
                    // $resta = $item->validity->price_total - $item->validity->price_partner;
                    // $gancia = 9 - $resta;
                    $sheet->setCellValue('P' . $col, '=+9-(O' .$col . '-I' .$col . ')');
                }elseif($item->validity->type == 'Facturito Ilimitado' || $item->validity->type == 'Facturito 100 doc'){
                    //$gancia = ($item->sub_total - $item->validity->price_total) + ($item->validity->price_total * 10 / 100);
                    $sheet->setCellValue('P' . $col, '=+(H' . $col . '-O' . $col . ')+(O' . $col . '*10/100)');
                }else{
                    //$gancia = ($item->sub_total - $item->validity->price_total) + $item->aditional_price;
                    $sheet->setCellValue('P' . $col, '=+(H' . $col . '-O' . $col . ')+M' . $col);
                }
                $col++;
            }
            $sheet->getStyle('A2:P' . $col)->applyFromArray($styleArray);
            //$col++;
            $sheet->setCellValue('H' . $col, '=SUM(H2:H' . ($col-1) . ')');
            $sheet->setCellValue('I' . $col, '=SUM(I2:I' . ($col-1) . ')');
            $sheet->setCellValue('M' . $col, '=SUM(M2:M' . ($col-1) . ')');
            $sheet->setCellValue('N' . $col, '=SUM(N2:N' . ($col-1) . ')');
            $sheet->setCellValue('O' . $col, '=SUM(O2:O' . ($col-1) . ')');
            $sheet->setCellValue('P' . $col, '=SUM(P2:P' . ($col-1) . ')');
            //dd($col);

            $writer = new Xlsx($spreadsheet);

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="Ventas_desde_' . $request->desde . '_hasta_' . $request->hasta . '_.xlsx"');
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

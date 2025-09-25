<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportExcelController extends Controller
{

    protected static $currentColum = '0';

    protected static $modelClasses = [
        \App\User::class,
        \App\AuslandsProjekte::class,
        \App\Dokumente::class,
        \App\Karriere::class,
        \App\KernKompetenz::class,
        \App\Mandat::class,
        \App\Schwerpunkte::class,
        \App\Skill::class,
        \App\Verantwortung::class,
    ];

    public static function getExportDatabase($sheet)
    {
        foreach (static::$modelClasses as $modelClass) {
            $data = $modelClass::export();
            if (! empty($data)) {
                $sheet->fromArray($data, null, \PHPExcel_Cell::stringFromColumnIndex(static::$currentColum) . '1');
                static::$currentColum += count($data[0]) + 1;
            }
        }
    }

    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();

        // Example: set column auto width
        $sheet->getDefaultColumnDimension()->setAutoSize(true);

        // Fetch users
        $users = \App\Models\User::all();

        // Add header row
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Email');

        $row = 2;
        foreach ($users as $user) {
            $sheet->setCellValue('A' . $row, $user->id);
            $sheet->setCellValue('B' . $row, $user->name);
            $sheet->setCellValue('C' . $row, $user->email);
            $row++;
        }

        $fileName = 'interim-jurist.xlsx';
        $writer   = new Xlsx($spreadsheet);
        $writer->save($fileName);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }

    public static function autoFitColumnWidthToContent($sheet, $fromCol, $toCol = null)
    {
        \PHPExcel_Shared_Font::setAutoSizeMethod(\PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);
        $cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(true);
        /** @var PHPExcel_Cell $cell */
        foreach ($cellIterator as $cell) {
            $sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
        }
    }
}

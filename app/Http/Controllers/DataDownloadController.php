<?php
namespace App\Http\Controllers;

use App\Models\TindakLanjut;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DataDownloadController extends Controller
{
    public function downloadXlsxMonth()
    {
        // Get the current month and year
        $currentMonth = now()->month;
        $currentYear = now()->year;
    
        // Fetch data from TindakLanjut for the current month only
        $data = TindakLanjut::with(['tipeObservasi', 'lokasi', 'kategori', 'clsr'])
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->get();
    
        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        // Set the column headers
        $sheet->setCellValue('A1', 'Tanggal');
        $sheet->setCellValue('B1', 'Tipe Observasi');
        $sheet->setCellValue('C1', 'Status');
        $sheet->setCellValue('D1', 'Deskripsi');
        $sheet->setCellValue('E1', 'Image');
        $sheet->setCellValue('F1', 'Laporan ID');
        $sheet->setCellValue('G1', 'Tanggal Akhir');
        $sheet->setCellValue('H1', 'Lokasi');
        $sheet->setCellValue('I1', 'Detail Lokasi');
        $sheet->setCellValue('J1', 'Kategori');
        $sheet->setCellValue('K1', 'CLSR');
        $sheet->setCellValue('L1', 'Direct Action');
        $sheet->setCellValue('M1', 'Non CLSR');
        $sheet->setCellValue('N1', 'Follow Up');
    
        // Add data rows
        $row = 2; // Start from the second row
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item->tanggal);
            $sheet->setCellValue('B' . $row, optional($item->tipeObservasi)->nama);
            $sheet->setCellValue('C' . $row, $item->status);
            $sheet->setCellValue('D' . $row, $item->deskripsi);
            $sheet->setCellValue('E' . $row, $item->img);
            $sheet->setCellValue('F' . $row, $item->laporan_id);
            $sheet->setCellValue('G' . $row, $item->tanggal_akhir);
            $sheet->setCellValue('H' . $row, optional($item->lokasi)->nama);
            $sheet->setCellValue('I' . $row, $item->detail_lokasi);
            $sheet->setCellValue('J' . $row, optional($item->kategori)->nama);
            $sheet->setCellValue('K' . $row, optional($item->clsr)->nama . ' - ' . optional($item->clsr)->deskripsi);
            $sheet->setCellValue('L' . $row, $item->direct_action);
            $sheet->setCellValue('M' . $row, $item->non_clsr);
            $sheet->setCellValue('N' . $row, $item->follow_up);
            $row++;
        }
    
        // Create a response for downloading the XLSX file
        $writer = new Xlsx($spreadsheet);
        $response = new StreamedResponse(function () use ($writer) {
            $writer->save('php://output');
        });
    
        // Set headers for the XLSX download
        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment; filename="tindak_lanjut_data_month.xlsx"');
        $response->headers->set('Cache-Control', 'max-age=0');
    
        return $response;
    }
    
    public function downloadXlsxWeek()
    {
        // Define start and end of the week (Saturday to Friday)
        $startOfWeek = now()->startOfWeek(\Carbon\Carbon::SATURDAY);
        $endOfWeek = now()->endOfWeek(\Carbon\Carbon::FRIDAY);
    
        // Fetch data from TindakLanjut for the current week only
        $data = TindakLanjut::with(['tipeObservasi', 'lokasi', 'kategori', 'clsr'])
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->get();
    
        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        // Set the column headers
        $sheet->setCellValue('A1', 'Tanggal');
        $sheet->setCellValue('B1', 'Tipe Observasi');
        $sheet->setCellValue('C1', 'Status');
        $sheet->setCellValue('D1', 'Deskripsi');
        $sheet->setCellValue('E1', 'Image');
        $sheet->setCellValue('F1', 'Laporan ID');
        $sheet->setCellValue('G1', 'Tanggal Akhir');
        $sheet->setCellValue('H1', 'Lokasi');
        $sheet->setCellValue('I1', 'Detail Lokasi');
        $sheet->setCellValue('J1', 'Kategori');
        $sheet->setCellValue('K1', 'CLSR');
        $sheet->setCellValue('L1', 'Direct Action');
        $sheet->setCellValue('M1', 'Non CLSR');
        $sheet->setCellValue('N1', 'Follow Up');
    
        // Add data rows
        $row = 2; // Start from the second row
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item->tanggal);
            $sheet->setCellValue('B' . $row, optional($item->tipeObservasi)->nama);
            $sheet->setCellValue('C' . $row, $item->status);
            $sheet->setCellValue('D' . $row, $item->deskripsi);
            $sheet->setCellValue('E' . $row, $item->img);
            $sheet->setCellValue('F' . $row, $item->laporan_id);
            $sheet->setCellValue('G' . $row, $item->tanggal_akhir);
            $sheet->setCellValue('H' . $row, optional($item->lokasi)->nama);
            $sheet->setCellValue('I' . $row, $item->detail_lokasi);
            $sheet->setCellValue('J' . $row, optional($item->kategori)->nama);
            $sheet->setCellValue('K' . $row, optional($item->clsr)->nama . ' - ' . optional($item->clsr)->deskripsi);
            $sheet->setCellValue('L' . $row, $item->direct_action);
            $sheet->setCellValue('M' . $row, $item->non_clsr);
            $sheet->setCellValue('N' . $row, $item->follow_up);
            $row++;
        }
    
        // Create a response for downloading the XLSX file
        $writer = new Xlsx($spreadsheet);
        $response = new StreamedResponse(function () use ($writer) {
            $writer->save('php://output');
        });
    
        // Set headers for the XLSX download
        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment; filename="tindak_lanjut_weekly_data.xlsx"');
        $response->headers->set('Cache-Control', 'max-age=0');
    
        return $response;
    }
    
        
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InputAspirasi;
use App\Models\Aspirasi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        // ✅ Tampilkan semua data yang statusnya "Selesai" by default
        $laporans = InputAspirasi::with(['siswa', 'aspirasi.kategori'])
            ->whereHas('aspirasi', function($q) {
                $q->where('status', 'Selesai');
            })
            ->latest()
            ->get();
        
        // Stats
        $totalPengaduan = InputAspirasi::count();
        $menunggu = Aspirasi::where('status', 'Menunggu')->count();
        $proses = Aspirasi::where('status', 'Proses')->count();
        $selesai = Aspirasi::where('status', 'Selesai')->count();
        
        return view('admin.laporan.index', compact(
            'laporans',
            'totalPengaduan',
            'menunggu',
            'proses',
            'selesai'
        ));
    }

    public function generate(Request $request)
    {
        $tanggalMulai = $request->query('tanggal_mulai');
        $tanggalSelesai = $request->query('tanggal_selesai');

        // Base query - hanya data yang selesai
        $query = InputAspirasi::with(['siswa', 'aspirasi.kategori'])
            ->whereHas('aspirasi', function($q) {
                $q->where('status', 'Selesai');
            });

        // Apply filter jika kedua tanggal diisi
        if ($tanggalMulai && $tanggalSelesai) {
            $query->whereBetween('created_at', [
                $tanggalMulai . ' 00:00:00', 
                $tanggalSelesai . ' 23:59:59'
            ]);
        }

        $laporans = $query->latest()->get();

        // Stats
        $totalPengaduan = InputAspirasi::count();
        $menunggu = Aspirasi::where('status', 'Menunggu')->count();
        $proses = Aspirasi::where('status', 'Proses')->count();
        $selesai = Aspirasi::where('status', 'Selesai')->count();

        return view('admin.laporan.index', compact(
            'laporans',
            'tanggalMulai',
            'tanggalSelesai',
            'totalPengaduan',
            'menunggu',
            'proses',
            'selesai'
        ));
    }

    public function exportPDF()
    {
        $laporans = InputAspirasi::with(['siswa', 'aspirasi.kategori'])
            ->whereHas('aspirasi', function($q) {
                $q->where('status', 'Selesai');
            })
            ->latest()
            ->get();

        $pdf = Pdf::loadView('admin.laporan.pdf', compact('laporans'));
        return $pdf->download('Laporan_Pengaduan_' . date('Y-m-d') . '.pdf');
    }

    public function exportExcel()
    {
        $laporans = InputAspirasi::with(['siswa', 'aspirasi.kategori'])
            ->whereHas('aspirasi', function($q) {
                $q->where('status', 'Selesai');
            })
            ->latest()
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'LAPORAN PENGADUAN SARANA SEKOLAH');
        $sheet->mergeCells('A1:F1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        
        $sheet->setCellValue('A2', 'No.');
        $sheet->setCellValue('B2', 'Tanggal');
        $sheet->setCellValue('C2', 'Nama Pelapor');
        $sheet->setCellValue('D2', 'Kelas');
        $sheet->setCellValue('E2', 'Kategori');
        $sheet->setCellValue('F2', 'Keterangan');
        
        $sheet->getStyle('A2:F2')->getFont()->setBold(true);
        $sheet->getStyle('A2:F2')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFD1FAE5');

        // Data
        $row = 3;
        foreach ($laporans as $index => $laporan) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $laporan->created_at->format('d/m/Y'));
            $sheet->setCellValue('C' . $row, $laporan->siswa->nama);
            $sheet->setCellValue('D' . $row, $laporan->siswa->kelas);
            $sheet->setCellValue('E' . $row, $laporan->kategori->ket_kategori);
            $sheet->setCellValue('F' . $row, $laporan->ket);
            $row++;
        }

        // Auto-size columns
        foreach (range('A', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan_Pengaduan_' . date('Y-m-d') . '.xlsx"');
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');
        exit;
    }
}
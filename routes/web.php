<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Models\ClassFunds;

Route::get('/test-pdf', function () {
    $records = ClassFunds::all(); // Fetch all ClassFunds data
    return view('pdf.class_funds', compact('records')); // Return the Blade view
});

Route::get('admin/class-funds/download-pdf', function () {
    // Fetch the ClassFunds records (all or filtered)
    $records = ClassFunds::all(); // Or you can use filters to fetch specific records
    
    // Generate PDF from the view with the records
    $pdf = Pdf::loadView('pdf.class_funds', compact('records'));

    // Return the generated PDF for download
    return $pdf->download('class_funds.pdf'); // This will force the download
});

use App\Http\Controllers\ClassFundsExportController;

Route::get('/export-class-funds-pdf', [ClassFundsExportController::class, 'exportPdf'])->name('export.class_funds_pdf');


// routes/web.php

use Barryvdh\DomPDF\Facade as Pdf;

Route::get('/test-pdf', function () {
    $pdf = Pdf::loadHTML('<h1>Test PDF</h1>');
    return $pdf->stream('test.pdf');
});

use App\Http\Controllers\PdfExportController;

Route::get('/export-pdf', [PdfExportController::class, 'export'])->name('export.pdf');



Route::get('/', function () {
    return view('welcome');
});



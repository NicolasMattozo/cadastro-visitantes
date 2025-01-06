<?php

use App\Http\Controllers\{
    
    VisitanteController

};
use Illuminate\Support\Facades\Route;

Route::get('/cadastro', [VisitanteController::class, 'index']);

// Rota para salvar o visitante
Route::post('visitante/save', [VisitanteController::class, 'saveVisitor'])->name('visitante.save');

// Rota para exportar visitantes para Excel
Route::get('visitante/export-excel', [VisitanteController::class, 'exportExcel'])->name('visitante.exportExcel');


Route::get('/', function () {
    return view('welcome');
});

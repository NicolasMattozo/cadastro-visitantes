<?php

namespace App\Http\Controllers;

use App\Models\Visitante;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as WriterXlsx;

class VisitanteController extends Controller
{
    public function index ()
    {
        return view('admin.visitantes.index');
    }
 
    public function saveVisitor(Request $request)
    {
        // Validação dos dados do formulário
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'endereco' => 'required|string|max:255',
            'congregacao' => 'required|string|max:255',
            'setor' => 'required|string|max:255',
            'observacoes' => 'nullable|string|max:500', // Observações são opcionais
        ]);
    
        // Criando um novo visitante no banco de dados
        $visitor = new Visitante();
        $visitor->nome = $request->input('nome');
        $visitor->telefone = $request->input('telefone');
        $visitor->endereco = $request->input('endereco');
        $visitor->congregacao = $request->input('congregacao');
        $visitor->setor = $request->input('setor');
        $visitor->observacoes = $request->input('observacoes');
        $visitor->save(); // Salvando no banco de dados
    
        // Retorna uma resposta de sucesso
        return redirect()->back()->with('success', 'Visitante cadastrado com sucesso!');
    }


    public function exportExcel()
{
    // Gerar o arquivo Excel com todos os visitantes
    $visitors = Visitante::all(); // Pega todos os visitantes no banco de dados

    // Criar a planilha Excel
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Preenchendo o cabeçalho da planilha
    $sheet->setCellValue('A1', 'Nome');
    $sheet->setCellValue('B1', 'Telefone');
    $sheet->setCellValue('C1', 'Endereço');
    $sheet->setCellValue('D1', 'Congregação');
    $sheet->setCellValue('E1', 'Setor');
    $sheet->setCellValue('F1', 'Observações');

    // Preenchendo os dados dos visitantes
    $row = 2; // Começa na linha 2 para não sobrescrever o cabeçalho
    foreach ($visitors as $visitor) {
        $sheet->setCellValue('A' . $row, $visitor->nome);
        $sheet->setCellValue('B' . $row, $visitor->telefone);
        $sheet->setCellValue('C' . $row, $visitor->endereco); // Acessando o endereço (se existir no banco)
        $sheet->setCellValue('D' . $row, $visitor->congregacao); // Acessando a congregação (se existir no banco)
        $sheet->setCellValue('E' . $row, $visitor->setor); // Acessando o setor (se existir no banco)
        $sheet->setCellValue('F' . $row, $visitor->observacoes); // Acessando as observações (se existir no banco)
        $row++; // Incrementa a linha para o próximo visitante
    }

     foreach (range('A', 'F') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // Escrevendo o arquivo Excel
    $writer = new WriterXlsx($spreadsheet);
    $filename = 'visitantes_' . date('Y-m-d') . '.xlsx';
    $writer->save($filename);

    // Retorna o arquivo para download
    return response()->download($filename)->deleteFileAfterSend(true);
}

}

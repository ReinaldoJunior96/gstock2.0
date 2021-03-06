<?php
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
require '../../back/controllers/CompraController.php';
$dados = new CompraController();
$dados_ordem = $dados->listOCwithEstoque($_GET['id_ordem']);
if (empty($dados_ordem['0']->item_compra)) {
    echo "<script language=\"javascript\">alert(\"Ordem sem itens!!\")</script>";
    echo "<script language=\"javascript\">window.history.back();</script>";
} else {
    require_once ("../../fpdf/fpdf.php");
    $pdf = new FPDF("P", "pt", "A4");
    $pdf->AddPage();
    $file = "Ordem_de_compra.pdf";
    $tipo_pdf = "I";

    $pdf->setDados($_GET['id_ordem'], $dados_ordem['0']->nome_f, $dados_ordem['0']->data_c);
    $pdf->SetFont('arial', '', 10);

    $pdf->Cell(360, 20, utf8_decode("Produto / Material"), 1, 0, "C");
    $pdf->Cell(30, 20, utf8_decode("Qtd"), 1, 0, "C");
    $pdf->Cell(80, 20, utf8_decode("Valor Un"), 1, 0, "C");
    $pdf->Cell(80, 20, utf8_decode("Valor Total"), 1, 0, "C");
    $pdf->Ln(25);
    $pdf->SetFont('arial', '', 11);
    $vTotal = 0;
    foreach ($dados_ordem as $v) {
        $vTotal += $v->valor_un_c * $v->qtde_compra;
        $pdf->Cell(360, 20, utf8_decode($v->produto_e), 1, 0, "C");
        $pdf->Cell(30, 20, utf8_decode($v->qtde_compra), 1, 0, "C");
        $valorUNFloat = floatval($v->valor_un_c);
        $valorTotalFloat = floatval($v->valor_un_c * $v->qtde_compra);
        $pdf->Cell(80, 20, utf8_decode("R$ " . $valorUNFloat), 1, 0, "C");
        $pdf->Cell(80, 20, utf8_decode("R$ " . number_format($valorTotalFloat, '2', ',', '.')), 1, 0, "C");
        $pdf->Ln(25);
    }
    $pdf->Cell(470, 20, utf8_decode("Total a Pagar"), 1, 0, "C");
    $pdf->SetFont('arial', 'B', 12);
    $valorGeral = floatval($vTotal);
    $pdf->Cell(80, 20, utf8_decode("R$ " . number_format($valorGeral, 2, ',', '.')), 1, 0, "C");
    $pdf->Ln(125);
    $pdf->Cell(550, 20, utf8_decode("____________________________________________"), 0, 0, "C");
    $pdf->Ln(15);
    $pdf->Cell(550, 20, utf8_decode("Responsável"), 0, 0, "C");
    $pdf->Output($file, $tipo_pdf);

}

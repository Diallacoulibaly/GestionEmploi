<?php
require "authen.php";
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_GET['groupe'])) {
    $groupe = mysqli_real_escape_string($cnx, $_GET['groupe']);

    $query = "SELECT * FROM emploi_du_temps WHERE groupe = '$groupe'";
    $result = mysqli_query($cn, $query);

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Add header
    $sheet->setCellValue('A1', 'Séance');
    $sheet->setCellValue('B1', 'Jour');
    $sheet->setCellValue('C1', 'Matière');
    $sheet->setCellValue('D1', 'Salle');

    // Add data
    $rowNum = 2;
    while ($row = mysqli_fetch_assoc($result)) {
        $sheet->setCellValue('A' . $rowNum, $row['seance']);
        $sheet->setCellValue('B' . $rowNum, $row['jour']);
        $sheet->setCellValue('C' . $rowNum, $row['matière']);
        $sheet->setCellValue('D' . $rowNum, $row['salle']);
        $rowNum++;
    }

    $writer = new Xlsx($spreadsheet);
    $filename = 'emploi_du_temps_' . $groupe . '.xlsx';

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . urlencode($filename) . '"');
    $writer->save('php://output');
}

mysqli_close($cn);
?>

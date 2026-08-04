<?php
require_once __DIR__ . '/fpdf/fpdf.php';

if (!class_exists('PDF_Certificate')) {
    class PDF_Certificate extends FPDF
    {
        function Polygon($points, $style = 'D')
        {
            if (count($points) % 2 != 0) {
                $this->Error('Polygon: Invalid number of points (must be an even number)');
            }
            $points[] = $points[0];
            $points[] = $points[1];
            $op = 'S';
            if ($style == 'F')
                $op = 'f';
            elseif ($style == 'FD' || $style == 'DF')
                $op = 'b';

            $this->_out(sprintf('%.2F %.2F m', $points[0] * $this->k, ($this->h - $points[1]) * $this->k));
            for ($i = 2; $i < count($points) - 2; $i += 2) {
                $this->_out(sprintf('%.2F %.2F l', $points[$i] * $this->k, ($this->h - $points[$i + 1]) * $this->k));
            }
            $this->_out($op);
        }

        function DrawShapeScaled($commands, $scaleX = 0.27, $scaleY = 0.2692, $style = 'F')
        {
            $op = 'f';
            if ($style == 'D') $op = 'S';
            elseif ($style == 'FD' || $style == 'DF') $op = 'B';

            $out = '';
            foreach ($commands as $cmd) {
                $type = $cmd[0];
                if ($type == 'M') {
                    $x = $cmd[1] * $scaleX;
                    $y = $cmd[2] * $scaleY;
                    $out .= sprintf('%.2F %.2F m ', $x * $this->k, ($this->h - $y) * $this->k);
                } elseif ($type == 'L') {
                    $x = $cmd[1] * $scaleX;
                    $y = $cmd[2] * $scaleY;
                    $out .= sprintf('%.2F %.2F l ', $x * $this->k, ($this->h - $y) * $this->k);
                } elseif ($type == 'C') {
                    $x1 = $cmd[1] * $scaleX;
                    $y1 = $cmd[2] * $scaleY;
                    $x2 = $cmd[3] * $scaleX;
                    $y2 = $cmd[4] * $scaleY;
                    $x3 = $cmd[5] * $scaleX;
                    $y3 = $cmd[6] * $scaleY;
                    $out .= sprintf(
                        '%.2F %.2F %.2F %.2F %.2F %.2F c ',
                        $x1 * $this->k,
                        ($this->h - $y1) * $this->k,
                        $x2 * $this->k,
                        ($this->h - $y2) * $this->k,
                        $x3 * $this->k,
                        ($this->h - $y3) * $this->k
                    );
                }
            }
            $out .= $op;
            $this->_out($out);
        }
    }
}

/**
 * Generates the certificate PDF and returns it via Output()
 * @param array $attempt Array containing 'username', 'quiz_title', and 'completed_at'
 * @param float|int $percentage Score percentage
 * @param string $outputMode 'D' for download, 'F' for save to file, 'S' for return as string
 * @param string $outputPath Path to save if $outputMode is 'F', or filename if 'D'
 * @return mixed PDF content or true on success
 */
function generateCertificatePDF($attempt, $percentage, $outputMode = 'S', $outputPath = '')
{
    $pdf = new PDF_Certificate('L', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);

    // Premium Color Palette 2 (Midnight Charcoal & Sunset Orange)
    $primaryViolet = [37, 52, 63];     // Midnight Charcoal (#25343F)
    $accentGold = [255, 155, 81];      // Sunset Orange (#FF9B51)
    $slateDark = [30, 41, 59];         // Dark slate
    $creamBg = [250, 252, 252];        // Ice Gray background

    // Background Fill
    $pdf->SetFillColor($creamBg[0], $creamBg[1], $creamBg[2]);
    $pdf->Rect(0, 0, 297, 210, 'F');

    // Draw Asymmetric Corner Triangles (Violet & Gold)
    // Top-Left Corner
    $pdf->SetFillColor($primaryViolet[0], $primaryViolet[1], $primaryViolet[2]);
    $pdf->Polygon([0, 0, 65, 0, 0, 65], 'F');
    $pdf->SetDrawColor($accentGold[0], $accentGold[1], $accentGold[2]);
    $pdf->SetLineWidth(1.5);
    $pdf->Line(0, 72, 72, 0);
    $pdf->SetLineWidth(0.5);
    $pdf->Line(0, 77, 77, 0);

    // Bottom-Right Corner
    $pdf->SetFillColor($primaryViolet[0], $primaryViolet[1], $primaryViolet[2]);
    $pdf->Polygon([297, 210, 232, 210, 297, 145], 'F');
    $pdf->SetLineWidth(1.5);
    $pdf->Line(297, 138, 225, 210);
    $pdf->SetLineWidth(0.5);
    $pdf->Line(297, 133, 220, 210);

    // Elegant Outer Double Border Frame (Gold)
    $pdf->SetDrawColor($accentGold[0], $accentGold[1], $accentGold[2]);
    $pdf->SetLineWidth(1.0);
    $pdf->Rect(8, 8, 281, 194);
    $pdf->SetLineWidth(0.3);
    $pdf->Rect(10.5, 10.5, 276, 189);

    // Draw corner bracket embellishments
    $pdf->SetLineWidth(0.8);
    // Top-Left Bracket
    $pdf->Line(13, 22, 22, 22);
    $pdf->Line(22, 13, 22, 22);
    // Top-Right Bracket
    $pdf->Line(284, 22, 275, 22);
    $pdf->Line(275, 13, 275, 22);
    // Bottom-Left Bracket
    $pdf->Line(13, 188, 22, 188);
    $pdf->Line(22, 197, 22, 188);
    // Bottom-Right Bracket
    $pdf->Line(284, 188, 275, 188);
    $pdf->Line(275, 197, 275, 188);

    // Right Royal Violet Ribbon & Seal
    $ribbonX = 250;
    $ribbonW = 24;
    $ribbonH = 118;
    $pdf->SetFillColor($primaryViolet[0], $primaryViolet[1], $primaryViolet[2]);
    $pdf->Polygon([
        $ribbonX, 0,
        $ribbonX + $ribbonW, 0,
        $ribbonX + $ribbonW, $ribbonH,
        $ribbonX + ($ribbonW / 2), $ribbonH - 12,
        $ribbonX, $ribbonH
    ], 'F');

    // Ribbon gold side borders
    $pdf->SetDrawColor($accentGold[0], $accentGold[1], $accentGold[2]);
    $pdf->SetLineWidth(0.6);
    $pdf->Line($ribbonX + 2, 0, $ribbonX + 2, $ribbonH - 11);
    $pdf->Line($ribbonX + $ribbonW - 2, 0, $ribbonX + $ribbonW - 2, $ribbonH - 11);

    // Badge Image Seal
    $sealSize = 66;
    $sealX = $ribbonX + ($ribbonW / 2) - ($sealSize / 2);
    $sealY = $ribbonH - 42;
    $imagePath = __DIR__ . '/../assets/images/Achievement Badge.png';
    if (file_exists($imagePath)) {
        $pdf->Image($imagePath, $sealX, $sealY, $sealSize, $sealSize, 'PNG');
    }

    // Typography Setup
    $centerX = 148.5;
    $username = htmlspecialchars_decode($attempt['username'] ?? '');
    $quiz_title = htmlspecialchars_decode($attempt['quiz_title'] ?? '');
    $completedDate = isset($attempt['completed_at']) ? date('M d, Y', strtotime($attempt['completed_at'])) : date('M d, Y');

    // "CERTIFICATE" Title
    $pdf->SetFont('Times', 'B', 44);
    $pdf->SetTextColor($primaryViolet[0], $primaryViolet[1], $primaryViolet[2]);
    $pdf->SetY(38);
    $pdf->SetX($centerX - 100);
    // Add letter spacing manually
    $titleString = "C E R T I F I C A T E";
    $pdf->Cell(200, 15, $titleString, 0, 1, 'C');

    // "OF EXCELLENCE" Subtitle
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->SetTextColor($accentGold[0], $accentGold[1], $accentGold[2]);
    $pdf->SetY(53);
    $pdf->SetX($centerX - 100);
    $pdf->Cell(200, 8, 'OF EXCELLENCE', 0, 1, 'C');

    // Accent lines below subtitle
    $pdf->SetDrawColor($accentGold[0], $accentGold[1], $accentGold[2]);
    $pdf->SetLineWidth(0.4);
    $pdf->Line($centerX - 48, 62, $centerX - 18, 62);
    $pdf->Line($centerX + 18, 62, $centerX + 48, 62);

    // Presented statement
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetTextColor($slateDark[0], $slateDark[1], $slateDark[2]);
    $pdf->SetY(76);
    $pdf->SetX($centerX - 100);
    $pdf->Cell(200, 8, 'THIS CERTIFICATE IS PROUDLY PRESENTED TO', 0, 1, 'C');

    // Recipient Name
    $pdf->SetFont('Times', 'BI', 36);
    $pdf->SetTextColor($primaryViolet[0], $primaryViolet[1], $primaryViolet[2]);
    $pdf->SetY(88);
    $pdf->SetX($centerX - 100);
    $pdf->Cell(200, 16, $username, 0, 1, 'C');

    // Divider line below name
    $pdf->SetDrawColor($accentGold[0], $accentGold[1], $accentGold[2]);
    $pdf->SetLineWidth(0.4);
    $pdf->Line($centerX - 60, 108, $centerX + 60, 108);

    // Quiz Course Title Subheader
    $pdf->SetFont('Arial', 'I', 10);
    $pdf->SetTextColor($slateDark[0], $slateDark[1], $slateDark[2]);
    $pdf->SetY(116);
    $pdf->SetX($centerX - 100);
    $pdf->Cell(200, 6, 'for successfully completing the assessment in', 0, 1, 'C');

    $pdf->SetFont('Arial', 'B', 13);
    $pdf->SetTextColor($accentGold[0], $accentGold[1], $accentGold[2]);
    $pdf->SetY(123);
    $pdf->SetX($centerX - 100);
    $pdf->Cell(200, 8, strtoupper($quiz_title), 0, 1, 'C');

    // Description text
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor($slateDark[0], $slateDark[1], $slateDark[2]);
    $pdf->SetY(135);
    $pdf->SetX($centerX - 80);
    $desc = "Demonstrating outstanding knowledge, skill, and proficiency in the subject matter\nwith a passing grade score of " . round($percentage) . "%.";
    $pdf->MultiCell(160, 5.5, $desc, 0, 'C');

    // Date Column
    $pdf->SetFont('Arial', '', 11);
    $pdf->SetTextColor($slateDark[0], $slateDark[1], $slateDark[2]);
    $pdf->SetY(162);
    $pdf->SetX($centerX - 80);
    $pdf->Cell(45, 5, $completedDate, 0, 0, 'C');
    $pdf->SetDrawColor(180, 180, 180);
    $pdf->SetLineWidth(0.3);
    $pdf->Line($centerX - 80, 169, $centerX - 35, 169);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetY(171);
    $pdf->SetX($centerX - 80);
    $pdf->Cell(45, 5, 'Date', 0, 0, 'C');

    // Signature Column
    $fontPath = __DIR__ . '/fpdf/font/GreatVibes-Regular.php';
    if (file_exists($fontPath)) {
        $pdf->AddFont('GreatVibes', '', 'GreatVibes-Regular.php');
        $pdf->SetFont('GreatVibes', '', 32);
    } else {
        $pdf->SetFont('Times', 'I', 22);
    }
    $pdf->SetTextColor($primaryViolet[0], $primaryViolet[1], $primaryViolet[2]);
    $pdf->SetY(158);
    $pdf->SetX($centerX + 35);
    $pdf->Cell(45, 10, 'Suraj Manani', 0, 0, 'C');
    $pdf->SetDrawColor(180, 180, 180);
    $pdf->SetLineWidth(0.3);
    $pdf->Line($centerX + 35, 169, $centerX + 80, 169);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetY(171);
    $pdf->SetX($centerX + 35);
    $pdf->Cell(45, 5, 'Signature', 0, 0, 'C');

    return $pdf->Output($outputMode, $outputPath);
}

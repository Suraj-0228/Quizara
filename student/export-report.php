<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
require_once '../includes/fpdf/fpdf.php';
requireLogin();

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'] ?? 'Registered Scholar';

// Fetch detailed history
$stmt = $pdo->prepare("
    SELECT qa.*, q.title, q.passing_score 
    FROM quiz_attempts qa 
    JOIN quizzes q ON qa.quiz_id = q.id 
    WHERE qa.user_id = ? AND qa.total_questions > 0
    ORDER BY qa.completed_at DESC
");
$stmt->execute([$user_id]);
$attempts = $stmt->fetchAll();

$total_attempts = count($attempts);
$passed_count = 0;
$total_pct = 0;

foreach ($attempts as $a) {
    $pct = ($a['total_questions'] > 0) ? ($a['score'] / $a['total_questions']) * 100 : 0;
    if ($pct >= $a['passing_score']) $passed_count++;
    $total_pct += $pct;
}

$pass_rate = $total_attempts > 0 ? round(($passed_count / $total_attempts) * 100) : 0;
$avg_score = $total_attempts > 0 ? round($total_pct / $total_attempts) : 0;

class PDF_Academic_Report extends FPDF {
    function Header() {
        // Midnight Charcoal Header Bar (#25343F)
        $this->SetFillColor(37, 52, 63);
        $this->Rect(0, 0, 210, 34, 'F');
        
        // Sunset Orange Accent Line (#FF9B51)
        $this->SetFillColor(255, 155, 81);
        $this->Rect(0, 34, 210, 2.5, 'F');
        
        // Brand Title (Vertically Centered at Y = 17mm)
        $this->SetFont('Arial', 'B', 20);
        $this->SetTextColor(255, 255, 255);
        $this->SetXY(15, 12);
        $this->Cell(100, 10, 'QUIZARA ACADEMICS', 0, 0, 'L');
        
        $this->SetFont('Arial', 'B', 9.5);
        $this->SetTextColor(255, 155, 81);
        $this->SetXY(105, 11);
        $this->Cell(90, 5, 'OFFICIAL ACADEMIC TRANSCRIPT', 0, 1, 'R');
        
        $this->SetFont('Arial', '', 8);
        $this->SetTextColor(148, 163, 184);
        $this->SetXY(105, 17);
        $this->Cell(90, 5, 'Verified LMS Educational Record', 0, 0, 'R');
        $this->Ln(22);
    }

    function Footer() {
        $this->SetY(-18);
        $this->SetFont('Arial', '', 8);
        $this->SetTextColor(148, 163, 184);
        $this->Cell(0, 4, 'This is an official computer-generated academic transcript issued by Quizara LMS Platform.', 0, 1, 'C');
        $this->Cell(0, 4, 'Security Hash: ' . strtoupper(hash('sha256', $_SESSION['username'] . date('Y-m-d'))), 0, 0, 'C');
    }

    function RoundedRect($x, $y, $w, $h, $r, $style = '') {
        $k = $this->k;
        $hp = $this->h;
        if($style=='F') $op='f';
        elseif($style=='FD' || $style=='DF') $op='b';
        else $op='s';
        $MyArc = 4/3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));
        $xc = $x+$w-$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));
        $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
        $xc = $x+$w-$r ;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l', ($x+$w)*$k,($hp-$yc)*$k));
        $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
        $xc = $x+$r ;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-($y+$h))*$k));
        $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
        $xc = $x+$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l', ($x)*$k,($hp-$yc)*$k));
        $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
    }

    function _Arc($x1, $y1, $x2, $y2, $x3, $y3) {
        $h = $this->h;
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
            $x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
    }
}

$pdf = new PDF_Academic_Report('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 25);

// Student Credentials Card (Spacious Line Spacing & Vertically Centered Content)
$pdf->SetFillColor(244, 247, 247);
$pdf->SetDrawColor(191, 201, 209);
$pdf->RoundedRect(15, 41, 180, 28, 4, 'DF');

// Left Column (Line 1: Tag, Line 2: Student Name, Line 3: Email)
$pdf->SetXY(22, 45.5);
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetTextColor(100, 116, 139);
$pdf->Cell(100, 4, 'STUDENT CREDENTIALS', 0, 1, 'L');

$pdf->SetXY(22, 52);
$pdf->SetFont('Arial', 'B', 15);
$pdf->SetTextColor(37, 52, 63);
$pdf->Cell(100, 7, $username, 0, 1, 'L');

$pdf->SetXY(22, 60.5);
$pdf->SetFont('Arial', '', 9.5);
$pdf->SetTextColor(71, 85, 105);
$pdf->Cell(100, 4.5, $email, 0, 0, 'L');

// Right Column (Line 1: Tag, Line 2: Issue Date)
$pdf->SetXY(125, 48.5);
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetTextColor(100, 116, 139);
$pdf->Cell(62, 4, 'DATE OF ISSUE', 0, 1, 'R');

$pdf->SetXY(125, 55.5);
$pdf->SetFont('Arial', 'B', 12.5);
$pdf->SetTextColor(37, 52, 63);
$pdf->Cell(62, 6.5, date('F j, Y'), 0, 1, 'R');

// Performance Highlights Section (4 Metric Boxes Vertically Centered)
$pdf->SetY(75);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(37, 52, 63);
$pdf->Cell(0, 8, 'PERFORMANCE HIGHLIGHTS', 0, 1, 'L');

$yStat = $pdf->GetY();
$boxWidth = 42.5;
$boxHeight = 22;
$gap = 3.3;

// Box 1: Total Quizzes
$pdf->SetFillColor(255, 255, 255);
$pdf->SetDrawColor(191, 201, 209);
$pdf->Rect(15, $yStat, $boxWidth, $boxHeight, 'DF');
$pdf->SetXY(15, $yStat + 5);
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(37, 52, 63);
$pdf->Cell($boxWidth, 7, (string)$total_attempts, 0, 1, 'C');
$pdf->SetXY(15, $yStat + 13);
$pdf->SetFont('Arial', 'B', 7.5);
$pdf->SetTextColor(100, 116, 139);
$pdf->Cell($boxWidth, 5, 'TOTAL QUIZZES', 0, 0, 'C');

// Box 2: Pass Rate
$x2 = 15 + $boxWidth + $gap;
$pdf->Rect($x2, $yStat, $boxWidth, $boxHeight, 'DF');
$pdf->SetXY($x2, $yStat + 5);
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(16, 185, 129);
$pdf->Cell($boxWidth, 7, $pass_rate . '%', 0, 1, 'C');
$pdf->SetXY($x2, $yStat + 13);
$pdf->SetFont('Arial', 'B', 7.5);
$pdf->SetTextColor(100, 116, 139);
$pdf->Cell($boxWidth, 5, 'SUCCESS RATE', 0, 0, 'C');

// Box 3: Avg Accuracy
$x3 = $x2 + $boxWidth + $gap;
$pdf->Rect($x3, $yStat, $boxWidth, $boxHeight, 'DF');
$pdf->SetXY($x3, $yStat + 5);
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(2, 132, 199);
$pdf->Cell($boxWidth, 7, $avg_score . '%', 0, 1, 'C');
$pdf->SetXY($x3, $yStat + 13);
$pdf->SetFont('Arial', 'B', 7.5);
$pdf->SetTextColor(100, 116, 139);
$pdf->Cell($boxWidth, 5, 'AVG ACCURACY', 0, 0, 'C');

// Box 4: XP Credits
$x4 = $x3 + $boxWidth + $gap;
$pdf->Rect($x4, $yStat, $boxWidth, $boxHeight, 'DF');
$pdf->SetXY($x4, $yStat + 5);
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(255, 155, 81);
$pdf->Cell($boxWidth, 7, (string)($total_attempts * 10), 0, 1, 'C');
$pdf->SetXY($x4, $yStat + 13);
$pdf->SetFont('Arial', 'B', 7.5);
$pdf->SetTextColor(100, 116, 139);
$pdf->Cell($boxWidth, 5, 'XP CREDITS', 0, 0, 'C');

// Table Log Section
$pdf->SetY($yStat + 29);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(37, 52, 63);
$pdf->Cell(0, 8, 'ASSESSMENT HISTORY LOG', 0, 1, 'L');

// Table Header Row
$pdf->SetFillColor(37, 52, 63);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(72, 9.5, ' ASSESSMENT TITLE', 0, 0, 'L', true);
$pdf->Cell(25, 9.5, 'SCORE', 0, 0, 'C', true);
$pdf->Cell(25, 9.5, 'ACCURACY', 0, 0, 'C', true);
$pdf->Cell(28, 9.5, 'STATUS', 0, 0, 'C', true);
$pdf->Cell(30, 9.5, 'DATE ', 0, 1, 'R', true);

// Table Data Rows
$pdf->SetFont('Arial', '', 8.5);
$fill = false;

foreach ($attempts as $a) {
    $pct = ($a['total_questions'] > 0) ? ($a['score'] / $a['total_questions']) * 100 : 0;
    $passed = $pct >= $a['passing_score'];
    
    $pdf->SetFillColor($fill ? 248 : 255, $fill ? 250 : 255, $fill ? 252 : 255);
    $pdf->SetTextColor(30, 41, 59);
    $pdf->Cell(72, 8.5, ' ' . substr($a['title'], 0, 36), 'B', 0, 'L', true);
    $pdf->Cell(25, 8.5, $a['score'] . ' / ' . $a['total_questions'], 'B', 0, 'C', true);
    
    $pdf->SetFont('Arial', 'B', 8.5);
    $pdf->Cell(25, 8.5, round($pct) . '%', 'B', 0, 'C', true);
    
    if ($passed) {
        $pdf->SetTextColor(5, 150, 105);
        $pdf->Cell(28, 8.5, 'PASSED', 'B', 0, 'C', true);
    } else {
        $pdf->SetTextColor(225, 29, 72);
        $pdf->Cell(28, 8.5, 'FAILED', 'B', 0, 'C', true);
    }
    
    $pdf->SetFont('Arial', '', 8.5);
    $pdf->SetTextColor(100, 116, 139);
    $pdf->Cell(30, 8.5, date('d M Y', strtotime($a['completed_at'])) . ' ', 'B', 1, 'R', true);
    $fill = !$fill;
}

// Signature & Center Badge Section
$pdf->Ln(12);
$ySig = $pdf->GetY();

if ($ySig > 230) {
    $pdf->AddPage();
    $ySig = 42;
}

// 1. Center Official Seal Badge
$badgePath = __DIR__ . '/../assets/images/Achievement Badge.png';
if (!file_exists($badgePath)) {
    $badgePath = __DIR__ . '/../assets/images/logo.png';
}

if (file_exists($badgePath)) {
    $pdf->Image($badgePath, 80, $ySig - 10, 50, 50);
}

// 2. Left Signature Line: Office of Academic Registrar
$pdf->SetDrawColor(191, 201, 209);
$pdf->SetLineWidth(0.4);
$pdf->Line(15, $ySig + 18, 75, $ySig + 18);

$pdf->SetXY(15, $ySig + 19.5);
$pdf->SetFont('Arial', 'B', 8.5);
$pdf->SetTextColor(100, 116, 139);
$pdf->Cell(60, 4, 'Office of Academic Registrar', 0, 0, 'C');

// 3. Right Signature Line: Authorized Signature ("Suraj Manani")
$fontPath = __DIR__ . '/../includes/fpdf/font/GreatVibes-Regular.php';
if (!file_exists($fontPath)) {
    $fontPath = __DIR__ . '/fpdf/font/GreatVibes-Regular.php';
}

if (file_exists($fontPath)) {
    $pdf->AddFont('GreatVibes', '', 'GreatVibes-Regular.php');
    $pdf->SetFont('GreatVibes', '', 26);
} else {
    $pdf->SetFont('Times', 'BI', 18);
}

$pdf->SetTextColor(37, 52, 63);
$pdf->SetXY(135, $ySig + 6);
$pdf->Cell(60, 10, 'Suraj Manani', 0, 1, 'C');

$pdf->SetDrawColor(191, 201, 209);
$pdf->SetLineWidth(0.4);
$pdf->Line(135, $ySig + 18, 195, $ySig + 18);

$pdf->SetXY(135, $ySig + 19.5);
$pdf->SetFont('Arial', 'B', 8.5);
$pdf->SetTextColor(100, 116, 139);
$pdf->Cell(60, 4, 'Authorized Signature', 0, 0, 'C');

$pdf->Output('D', 'Quizara_Academic_Report_' . $username . '.pdf');

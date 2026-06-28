<?php
require_once 'config/database.php';
require_once 'includes/functions.php';

// Default mock values
$name = 'Suraj Manani';
$quiz_title = 'Ultimate General Knowledge';
$score = 100;
$date = date('M d, Y');

if (isset($_GET['attempt_id'])) {
    $attempt_id = (int)$_GET['attempt_id'];
    $stmt = $pdo->prepare("
        SELECT qa.*, q.title as quiz_title, u.username 
        FROM quiz_attempts qa
        JOIN quizzes q ON qa.quiz_id = q.id
        JOIN users u ON qa.user_id = u.id
        WHERE qa.id = ? AND qa.completed_at IS NOT NULL
    ");
    $stmt->execute([$attempt_id]);
    $attempt = $stmt->fetch();
    if ($attempt) {
        $name = $attempt['username'];
        $quiz_title = $attempt['quiz_title'];
        $score = round(($attempt['score'] / $attempt['total_questions']) * 100);
        $date = date('M d, Y', strtotime($attempt['completed_at']));
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Achievement - Quizara</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&family=Montserrat:wght@400;500;600;700&family=Great+Vibes&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #ede9fe;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .cert-container {
            width: 1100px;
            height: 780px;
            background-color: #fdfbf7;
            position: relative;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(46, 16, 101, 0.15);
            border-radius: 4px;
        }

        .bg-svg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            pointer-events: none;
        }

        .cert-border-outer {
            position: absolute;
            top: 30px;
            bottom: 30px;
            left: 30px;
            right: 30px;
            border: 4px solid #c5a059;
            z-index: 4;
            pointer-events: none;
        }

        .cert-border-inner {
            position: absolute;
            top: 39px;
            bottom: 39px;
            left: 39px;
            right: 39px;
            border: 1px solid #c5a059;
            z-index: 4;
            pointer-events: none;
        }

        /* Bracket Embellishments */
        .corner-bracket {
            position: absolute;
            width: 32px;
            height: 32px;
            border: 3px solid #c5a059;
            z-index: 5;
            pointer-events: none;
        }

        .cb-tl { top: 48px; left: 48px; border-right: none; border-bottom: none; }
        .cb-tr { top: 48px; right: 48px; border-left: none; border-bottom: none; }
        .cb-bl { bottom: 48px; left: 48px; border-right: none; border-top: none; }
        .cb-br { bottom: 48px; right: 48px; border-left: none; border-top: none; }

        .right-ribbon {
            position: absolute;
            top: 0;
            right: 140px;
            width: 90px;
            height: 440px;
            background-color: #2e1065;
            clip-path: polygon(0 0, 100% 0, 100% 100%, 50% 90%, 0 100%);
            z-index: 6;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .ribbon-stripe-l {
            position: absolute;
            top: 0;
            left: 8px;
            bottom: 32px;
            width: 2px;
            background-color: #c5a059;
        }

        .ribbon-stripe-r {
            position: absolute;
            top: 0;
            right: 10px;
            bottom: 32px;
            width: 2px;
            background-color: #c5a059;
        }

        .gold-seal {
            position: absolute;
            bottom: 5px;
            left: 50%;
            transform: translateX(-50%);
            width: 240px;
            height: 240px;
            display: flex;
            justify-content: center;
            align-items: center;
            filter: drop-shadow(0 12px 20px rgba(0, 0, 0, 0.35));
            z-index: 7;
        }

        .gold-seal img {
            width: 100%;
            height: auto;
            display: block;
        }

        .content {
            position: absolute;
            top: 140px;
            left: 0;
            width: 100%;
            text-align: center;
            z-index: 15;
            padding: 0 60px;
        }

        .title {
            font-family: 'Playfair Display', serif;
            font-size: 58px;
            color: #2e1065;
            letter-spacing: 12px;
            margin-bottom: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .subtitle {
            font-size: 13px;
            color: #c5a059;
            font-weight: 700;
            letter-spacing: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 50px;
            text-transform: uppercase;
        }

        .subtitle::before,
        .subtitle::after {
            content: '';
            width: 80px;
            height: 1.5px;
            background-color: #c5a059;
            margin: 0 20px;
        }

        .presented {
            font-size: 11px;
            color: #1e293b;
            letter-spacing: 2px;
            margin-bottom: 25px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .recipient {
            font-family: 'Playfair Display', serif;
            font-size: 52px;
            color: #2e1065;
            margin-bottom: 10px;
            line-height: 1.1;
            font-style: italic;
            font-weight: 700;
        }

        .name-divider {
            width: 35%;
            height: 0;
            border-bottom: 1.5px solid #c5a059;
            margin: 0 auto 35px;
        }

        .lorem-gold {
            font-size: 11px;
            color: #1e293b;
            font-style: italic;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .quiz-title-main {
            font-size: 16px;
            color: #c5a059;
            font-weight: 700;
            letter-spacing: 2px;
            margin-bottom: 18px;
            text-transform: uppercase;
        }

        .lorem-desc {
            font-size: 13px;
            color: #334155;
            line-height: 1.7;
            max-width: 60%;
            margin: 0 auto;
            font-weight: 500;
        }

        .footer-sec {
            display: flex;
            justify-content: space-between;
            width: 58%;
            margin: 60px auto 0;
        }

        .sig-box {
            width: 170px;
            text-align: center;
        }

        .sig-date {
            font-size: 15px;
            color: #1e293b;
            margin-bottom: 5px;
            min-height: 24px;
            font-weight: 600;
        }

        .sig-line {
            width: 100%;
            height: 1px;
            background-color: #cbd5e1;
            margin-bottom: 8px;
        }

        .sig-label {
            font-size: 10px;
            color: #475569;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        @media (max-width: 1150px) {
            .cert-container {
                transform: scale(0.85);
            }
        }

        @media (max-width: 950px) {
            .cert-container {
                transform: scale(0.7);
            }
        }

        @media (max-width: 750px) {
            .cert-container {
                transform: scale(0.5);
            }
        }
    </style>
</head>

<body>

    <div class="cert-container">
        <!-- SVG Layout corner shapes -->
        <svg class="bg-svg" preserveAspectRatio="none" viewBox="0 0 1100 780">
            <!-- Asymmetric Corner Triangle - Top Left -->
            <path d="M0,0 L240,0 L0,240 Z" fill="#2e1065" />
            <!-- Gold accents Top Left -->
            <line x1="0" y1="265" x2="265" y2="0" stroke="#c5a059" stroke-width="5" />
            <line x1="0" y1="282" x2="282" y2="0" stroke="#c5a059" stroke-width="1.5" />

            <!-- Asymmetric Corner Triangle - Bottom Right -->
            <path d="M1100,780 L860,780 L1100,540 Z" fill="#2e1065" />
            <!-- Gold accents Bottom Right -->
            <line x1="1100" y1="515" x2="515" y2="780" stroke="#c5a059" stroke-width="5" />
            <line x1="1100" y1="498" x2="498" y2="780" stroke="#c5a059" stroke-width="1.5" />
        </svg>

        <!-- Elegant Borders -->
        <div class="cert-border-outer"></div>
        <div class="cert-border-inner"></div>

        <!-- Corner Brackets -->
        <div class="corner-bracket cb-tl"></div>
        <div class="corner-bracket cb-tr"></div>
        <div class="corner-bracket cb-bl"></div>
        <div class="corner-bracket cb-br"></div>

        <!-- Ribbon -->
        <div class="right-ribbon">
            <div class="ribbon-stripe-l"></div>
            <div class="ribbon-stripe-r"></div>
            <div class="gold-seal">
                <img src="assets/images/Achievement Badge.png" alt="Badge" />
            </div>
        </div>

        <div class="content">
            <h1 class="title">Certificate</h1>
            <div class="subtitle">of Excellence</div>
            <div class="presented">This certificate is proudly presented to</div>
            <div class="recipient"><?php echo sanitize($name); ?></div>
            <div class="name-divider"></div>
            <div class="lorem-gold">for successfully completing the assessment in</div>
            <div class="quiz-title-main"><?php echo sanitize($quiz_title); ?></div>
            <div class="lorem-desc">
                Demonstrating outstanding knowledge, skill, and proficiency in the subject matter with a passing grade score of <?php echo $score; ?>%.
            </div>
            
            <div class="footer-sec">
                <div class="sig-box">
                    <div class="sig-date"><?php echo $date; ?></div>
                    <div class="sig-line"></div>
                    <div class="sig-label">Date</div>
                </div>
                <div class="sig-box">
                    <div class="sig-date" style="font-family: 'Great Vibes', cursive; font-size: 38px; line-height: 0.8; margin-bottom: 2px; color: #2e1065;">Suraj Manani</div>
                    <div class="sig-line"></div>
                    <div class="sig-label">Authorized Signature</div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
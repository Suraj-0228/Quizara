<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../PHPMailer/src/Exception.php';
require_once __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer/src/SMTP.php';

function sendEmail($toEmail, $toName, $subject, $htmlBody, $plainTextBody = '', $attachmentPath = null, $attachmentName = '')
{
    $mail = new PHPMailer(true);

    try {
        // --- Server settings ---
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;

        // REPLACE THESE WITH YOUR NEW EMAIL CREDENTIALS
        $mail->Username   = 'projectadmin0@gmail.com';
        $mail->Password   = 'vpnj obyn egim qglc';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // --- Recipients ---
        $mail->setFrom('projectadmin0@gmail.com', 'Quizara System');
        $mail->addAddress($toEmail, $toName);

        // --- Attachments ---
        if ($attachmentPath && file_exists($attachmentPath)) {
            $mail->addAttachment($attachmentPath, $attachmentName ?: '');
        }

        // --- Content ---
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $htmlBody;
        $mail->AltBody = $plainTextBody ?: strip_tags($htmlBody);

        $mail->send();
        return true;
    } catch (Exception $e) {
        // Log error silently so it doesn't break the application
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}

/**
 * Send Payment Receipt Email to Registered Gmail
 */
function sendPurchaseReceipt($toEmail, $toName, $quizTitle, $amount, $transactionId, $paymentMethod = 'Credit / Debit Card')
{
    $subject = "Receipt for Order #{$transactionId} - Quizara";
    
    // Construct dynamic online receipt URL
    $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
    $receiptUrl = "http://" . $host . "/Quizara/student/receipt.php?transaction_id=" . urlencode($transactionId);
    
    $dateStr = date('F j, Y, g:i a');
    $formattedAmount = '₹' . number_format((float)$amount, 2);

    $htmlBody = '
    <div style="font-family: \'Inter\', Helvetica, Arial, sans-serif; max-width: 580px; margin: 0 auto; background-color: #EAEFEF; padding: 12px; border-radius: 16px;">
        <div style="background-color: #25343F; padding: 24px 16px; text-align: center; border-radius: 14px 14px 0 0; border-bottom: 4px solid #FF9B51;">
            <h1 style="color: #ffffff; margin: 0; font-size: 24px; font-weight: 800; letter-spacing: 1px;">🎓 Quizara</h1>
            <p style="color: #BFC9D1; margin: 4px 0 0 0; font-size: 13px; font-weight: 500;">Payment Confirmation & Receipt</p>
        </div>

        <div style="background-color: #ffffff; padding: 24px 16px; border-radius: 0 0 14px 14px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
            <div style="text-align: center; margin-bottom: 20px;">
                <span style="background-color: #e6f4ea; color: #137333; font-size: 11px; font-weight: 800; padding: 6px 14px; border-radius: 50px; text-transform: uppercase; letter-spacing: 0.5px; border: 1px solid #ceead6; display: inline-block;">
                    ✓ Payment Successful
                </span>
            </div>

            <h2 style="color: #25343F; margin-top: 0; font-size: 17px; font-weight: 700;">Hello ' . htmlspecialchars($toName) . ',</h2>
            <p style="color: #555555; line-height: 1.5; font-size: 13px; margin-bottom: 20px;">
                Thank you for your purchase! Your payment for <strong>' . htmlspecialchars($quizTitle) . '</strong> has been processed successfully. High Mode access is now unlocked on your account.
            </p>

            <!-- Order Details Box -->
            <table style="width: 100%; table-layout: fixed; border-collapse: collapse; background-color: #f8fafc; border: 1px solid #BFC9D1; border-radius: 12px; margin-bottom: 20px; font-size: 13px;">
                <tr>
                    <td style="width: 38%; padding: 10px 12px; color: #64748b; font-weight: 600; vertical-align: top; word-break: break-word;">Transaction ID:</td>
                    <td style="width: 62%; padding: 10px 12px; color: #25343F; font-weight: 700; text-align: right; font-family: monospace; word-break: break-all; word-wrap: break-word; overflow-wrap: break-word; vertical-align: top;">' . htmlspecialchars($transactionId) . '</td>
                </tr>
                <tr style="border-top: 1px solid #e2e8f0;">
                    <td style="width: 38%; padding: 10px 12px; color: #64748b; font-weight: 600; vertical-align: top;">Date & Time:</td>
                    <td style="width: 62%; padding: 10px 12px; color: #25343F; font-weight: 600; text-align: right; word-break: break-word; vertical-align: top;">' . $dateStr . '</td>
                </tr>
                <tr style="border-top: 1px solid #e2e8f0;">
                    <td style="width: 38%; padding: 10px 12px; color: #64748b; font-weight: 600; vertical-align: top;">Payment Method:</td>
                    <td style="width: 62%; padding: 10px 12px; color: #25343F; font-weight: 600; text-align: right; word-break: break-word; vertical-align: top;">' . htmlspecialchars($paymentMethod) . '</td>
                </tr>
                <tr style="border-top: 1px solid #e2e8f0;">
                    <td style="width: 38%; padding: 10px 12px; color: #64748b; font-weight: 600; vertical-align: top;">Item Purchased:</td>
                    <td style="width: 62%; padding: 10px 12px; color: #25343F; font-weight: 700; text-align: right; word-break: break-word; vertical-align: top;">' . htmlspecialchars($quizTitle) . ' (High Mode)</td>
                </tr>
                <tr style="border-top: 2px solid #25343F; background-color: #edf2f7;">
                    <td style="width: 38%; padding: 12px 12px; color: #25343F; font-weight: 800; font-size: 14px;">Amount Paid:</td>
                    <td style="width: 62%; padding: 12px 12px; color: #25343F; font-weight: 900; font-size: 16px; text-align: right;">' . $formattedAmount . '</td>
                </tr>
            </table>

            <!-- Receipt Button -->
            <div style="text-align: center; margin: 24px 0 16px 0;">
                <a href="' . $receiptUrl . '" style="background-color: #25343F; color: #ffffff; padding: 12px 24px; text-decoration: none; border-radius: 50px; font-weight: 700; font-size: 13px; display: inline-block; box-shadow: 0 4px 10px rgba(37,52,63,0.25);">
                    📄 View & Print Digital Receipt
                </a>
            </div>

            <p style="color: #94a3b8; font-size: 11px; text-align: center; margin-top: 20px; border-top: 1px solid #e2e8f0; padding-top: 14px; line-height: 1.4;">
                Questions about your order? Email us at <a href="mailto:support@quizara.com" style="color: #25343F; font-weight: 600;">support@quizara.com</a>.
            </p>
        </div>
    </div>';

    return sendEmail($toEmail, $toName, $subject, $htmlBody);
}

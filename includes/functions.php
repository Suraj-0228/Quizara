<?php
// Set session lifetime to 30 days (2592000 seconds)
$session_lifetime = 2592000;
ini_set('session.gc_maxlifetime', $session_lifetime);
ini_set('session.cookie_lifetime', $session_lifetime);

// Start session with persistent cookie params
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => $session_lifetime,
        'path' => '/Quizara/',
        'domain' => '',
        'secure' => isset($_SERVER['HTTPS']),
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    session_start();
}

/**
 * Sanitize input data
 */
function sanitize($data)
{
    return htmlspecialchars(strip_tags(trim($data)));
}

/**
 * Check if user is logged in
 */
function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}

/**
 * Check if current user is admin
 */
function isAdmin()
{
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

/**
 * Redirect if not logged in
 */
function requireLogin()
{
    if (!isLoggedIn()) {
        redirect('/Quizara/login.php');
    }

    // Verify user still exists in DB (prevents errors if DB was reset)
    global $pdo;
    $stmt = $pdo->prepare("SELECT id FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    if (!$stmt->fetch()) {
        session_destroy();
        redirect('/Quizara/login.php?error=session_expired');
    }
}

/**
 * Redirect if not admin
 */
function requireAdmin()
{
    requireLogin();
    if (!isAdmin()) {
        redirect('/Quizara/student/dashboard.php'); // Redirect non-admins to student dashboard
    }
}

/**
 * Redirect helper
 */
function redirect($url)
{
    header("Location: " . $url);
    exit;
}

/**
 * Flash message helper
 */
function flash($name = '', $message = '', $class = 'success')
{
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION[$name])) {
            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;
        } elseif (empty($message) && !empty($_SESSION[$name])) {
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : 'success';
            
            // Map status classes to premium Tailwind styles
            $bgColor = 'bg-primary-50';
            $textColor = 'text-primary-800';
            $borderColor = 'border-primary-100/30';
            $icon = '<i class="fas fa-info-circle mr-2.5 text-primary-500"></i>';

            if ($class === 'success') {
                $bgColor = 'bg-emerald-50';
                $textColor = 'text-emerald-800';
                $borderColor = 'border-emerald-100/40';
                $icon = '<i class="fas fa-check-circle mr-2.5 text-emerald-500"></i>';
            } elseif ($class === 'danger' || $class === 'error') {
                $bgColor = 'bg-rose-50';
                $textColor = 'text-rose-800';
                $borderColor = 'border-rose-100/40';
                $icon = '<i class="fas fa-exclamation-circle mr-2.5 text-rose-500"></i>';
            } elseif ($class === 'warning') {
                $bgColor = 'bg-amber-50';
                $textColor = 'text-amber-800';
                $borderColor = 'border-amber-100/40';
                $icon = '<i class="fas fa-exclamation-triangle mr-2.5 text-amber-500"></i>';
            }

            echo '<div class="alert-dismissible p-4 mb-6 rounded-2xl border flex items-center justify-between ' . $bgColor . ' ' . $textColor . ' ' . $borderColor . '" role="alert">
                    <div class="flex items-center text-xs font-bold">
                        ' . $icon . '
                        <span>' . $_SESSION[$name] . '</span>
                    </div>
                    <button type="button" class="text-slate-400 hover:text-slate-655 focus:outline-none flex items-center justify-center p-1" onclick="this.parentElement.remove()" aria-label="Close">
                        <i class="fas fa-times text-xs"></i>
                    </button>
                  </div>';
            
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }
}

/**
 * Base URL helper
 */
function base_url($path = '')
{
    return '/Quizara/' . ltrim($path, '/');
}
/**
 * Check Maintenance Mode
 */
function checkMaintenanceMode()
{
    global $pdo;

    $current_script = basename($_SERVER['PHP_SELF']);
    $allowed_scripts = ['maintenance.php', 'login.php', 'register.php'];

    if (in_array($current_script, $allowed_scripts)) {
        return;
    }

    if (isAdmin()) {
        return;
    }

    try {
        if (isset($pdo)) {
            $stmt = $pdo->prepare("SELECT setting_value FROM settings WHERE setting_key = 'maintenance_mode'");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && $result['setting_value'] === '1') {
                redirect('/Quizara/maintenance.php');
            }
        }
    } catch (PDOException $e) {
    }
}

function getSetting($key, $default = null)
{
    global $pdo;
    try {
        if (isset($pdo)) {
            $stmt = $pdo->prepare("SELECT setting_value FROM settings WHERE setting_key = ?");
            $stmt->execute([$key]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return $result['setting_value'];
            }
        }
    } catch (PDOException $e) {
        // error
    }
    return $default;
}

function isRegistrationAllowed()
{
    $val = getSetting('allow_registration', '1');
    return $val === '1';
}

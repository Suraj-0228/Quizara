<?php
// Set session lifetime to 30 days (2592000 seconds)
$session_lifetime = 2592000;
ini_set('session.gc_maxlifetime', $session_lifetime);
ini_set('session.cookie_lifetime', $session_lifetime);

// Start session with persistent cookie params
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => $session_lifetime,
        'path' => '/',
        'domain' => '',
        'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    session_start();
}

/**
 * Base URL helper (Auto-detects root vs subfolder)
 */
function base_url($path = '')
{
    $scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
    
    if (strpos($scriptName, '/Quizara/') !== false) {
        $base = '/Quizara/';
    } else {
        $base = '/';
    }
    
    return rtrim($base, '/') . '/' . ltrim($path, '/');
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
        redirect(base_url('login.php'));
    }

    // Verify user still exists in DB (prevents errors if DB was reset)
    global $pdo;
    $stmt = $pdo->prepare("SELECT id FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    if (!$stmt->fetch()) {
        session_destroy();
        redirect(base_url('login.php?error=session_expired'));
    }
}

/**
 * Redirect if not admin
 */
function requireAdmin()
{
    requireLogin();
    if (!isAdmin()) {
        redirect(base_url('student/dashboard.php')); // Redirect non-admins to student dashboard
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
            $msgText = $_SESSION[$name];
            $msgLower = strtolower(strip_tags($msgText));
            
            // Action Type Detection (Add = Green, Edit = Blue, Delete = Red, Warning = Amber)
            $type = 'info';
            
            if ($class === 'danger' || $class === 'error' || $class === 'delete' || stristr($msgLower, 'delete') || stristr($msgLower, 'remove') || stristr($msgLower, 'revoke') || stristr($msgLower, 'fail') || stristr($msgLower, 'invalid') || stristr($msgLower, 'error')) {
                $type = 'delete';
            } elseif ($class === 'edit' || $class === 'info' || stristr($msgLower, 'update') || stristr($msgLower, 'edit') || stristr($msgLower, 'change') || stristr($msgLower, 'save') || stristr($msgLower, 'setting')) {
                $type = 'edit';
            } elseif ($class === 'success' || $class === 'add' || stristr($msgLower, 'add') || stristr($msgLower, 'create') || stristr($msgLower, 'grant') || stristr($msgLower, 'success')) {
                $type = 'add';
            } elseif ($class === 'warning' || stristr($msgLower, 'warn')) {
                $type = 'warning';
            }

            // Apply Action Color Schemes
            if ($type === 'add') {
                // GREEN: Add / Create / Success
                $bgColor = 'bg-emerald-50';
                $textColor = 'text-emerald-600';
                $borderColor = 'border-emerald-200';
                $icon = '<i class="fas fa-check-circle mr-3 text-emerald-500 text-lg flex-shrink-0"></i>';
            } elseif ($type === 'edit') {
                // BLUE: Edit / Update / Settings
                $bgColor = 'bg-sky-50';
                $textColor = 'text-sky-600';
                $borderColor = 'border-sky-200';
                $icon = '<i class="fas fa-info-circle mr-3 text-sky-500 text-lg flex-shrink-0"></i>';
            } elseif ($type === 'delete') {
                // RED: Delete / Remove / Danger / Error
                $bgColor = 'bg-red-50';
                $textColor = 'text-red-500';
                $borderColor = 'border-red-200';
                $icon = '<i class="fas fa-trash-alt mr-3 text-red-500 text-lg flex-shrink-0"></i>';
            } else {
                // AMBER: Warning
                $bgColor = 'bg-amber-50';
                $textColor = 'text-amber-900';
                $borderColor = 'border-amber-200';
                $icon = '<i class="fas fa-exclamation-triangle mr-3 text-amber-500 text-lg flex-shrink-0"></i>';
            }

            $alertId = 'flash_' . uniqid();

            echo '<div id="' . $alertId . '" class="flash-alert-msg p-4 mb-6 rounded-2xl border shadow-sm flex items-center justify-between transition-all duration-500 transform translate-y-0 opacity-100 ' . $bgColor . ' ' . $textColor . ' ' . $borderColor . '" role="alert">
                    <div class="flex items-center text-sm font-extrabold">
                        ' . $icon . '
                        <span>' . $msgText . '</span>
                    </div>
                    <button type="button" class="ml-4 text-slate-400 hover:text-slate-700 focus:outline-none flex items-center justify-center p-1 transition-colors" onclick="closeFlashAlert(\'' . $alertId . '\')" aria-label="Close">
                        <i class="fas fa-times text-sm"></i>
                    </button>
                  </div>
                  <script>
                  if (typeof closeFlashAlert !== "function") {
                      window.closeFlashAlert = function(id) {
                          const el = document.getElementById(id);
                          if (el) {
                              el.style.transition = "opacity 0.5s ease-out, transform 0.5s ease-out, margin 0.5s ease-out";
                              el.style.opacity = "0";
                              el.style.transform = "translateY(-10px)";
                              setTimeout(function() { if (el && el.parentNode) el.remove(); }, 500);
                          }
                      };
                  }
                  setTimeout(function() {
                      closeFlashAlert("' . $alertId . '");
                  }, 2000);
                  </script>';
            
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }
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
                redirect(base_url('maintenance.php'));
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

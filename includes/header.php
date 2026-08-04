<?php
include_once __DIR__ . '/functions.php';

// Check for maintenance mode
checkMaintenanceMode();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - Quiz System' : 'Online Quiz System'; ?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo.png'); ?>" type="image/x-icon">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f2f5f8',
                            100: '#e1e7ec',
                            200: '#bfc9d1',
                            300: '#96a7b5',
                            400: '#677f93',
                            500: '#415769',
                            600: '#25343f', // Midnight Charcoal Primary
                            700: '#1d2a34',
                            800: '#172129',
                            900: '#10171e',
                        },
                        accent: {
                            50: '#fff7ed',
                            100: '#ffedd5',
                            200: '#fed7aa',
                            300: '#fdba74',
                            400: '#ffb375',
                            500: '#ff9b51', // Vibrant Sunset Orange Accent
                            600: '#f97316',
                            700: '#ea580c',
                            800: '#c2410c',
                            900: '#9a3412',
                        },
                        slate: {
                            50: '#EAEFEF', // Ice Gray Background
                            100: '#E2E8EC',
                            200: '#BFC9D1', // Slate Silver Borders
                            300: '#9DAEC0',
                            400: '#7B90A3',
                            500: '#5A7286',
                            600: '#3F5466',
                            700: '#2E3E4D',
                            800: '#25343F', // Midnight Charcoal
                            900: '#172129',
                        }
                    },
                    fontFamily: {
                        sans: ['Outfit', 'Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/Quizara/assets/css/style.css">
    <link rel="stylesheet" href="/Quizara/assets/css/quiz.css">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="flex flex-col min-h-screen bg-slate-50 text-slate-900 font-sans">
    <?php
    if (isLoggedIn()) {
        if (isAdmin()) {
            // Admin Sidebar Layout
            include_once __DIR__ . '/admin-sidebar.php';
            echo '<div class="admin-main-content flex flex-col min-h-screen bg-slate-50">';

            // Mobile Admin Sidebar Toggle
            echo '
            <nav class="bg-white lg:hidden sticky top-0 z-30 shadow-sm p-4 mb-4 border-b border-slate-200 glass-effect">
                <div class="w-full flex flex-row justify-between items-center">
                    <a href="' . base_url('admin/dashboard.php') . '" class="flex items-center text-slate-900">
                        <i class="fas fa-graduation-cap text-primary-600 text-xl mr-2"></i>
                        <span class="font-extrabold text-lg tracking-wider">Quizara</span>
                    </a>
                    <button class="border border-slate-200 hover:bg-slate-50 text-slate-700 px-3 py-1.5 rounded-lg transition-all focus:outline-none" type="button" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </nav>
            ';
        } else {
            // Student Sidebar Layout
            include_once __DIR__ . '/student-sidebar.php';
            echo '<div class="student-main-content flex flex-col min-h-screen bg-slate-50">';

            // Mobile Student Sidebar Toggle
            echo '
            <nav class="bg-white lg:hidden sticky top-0 z-30 shadow-sm p-4 mb-4 border-b border-slate-200 glass-effect">
                <div class="w-full flex flex-row justify-between items-center">
                    <a href="' . base_url('student/dashboard.php') . '" class="flex items-center text-slate-900">
                        <i class="fas fa-graduation-cap text-primary-600 text-xl mr-2"></i>
                        <span class="font-extrabold text-lg tracking-wider">Quizara</span>
                    </a>
                    <button class="border border-slate-200 hover:bg-slate-50 text-slate-700 px-3 py-1.5 rounded-lg transition-all focus:outline-none" type="button" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </nav>
            ';
        }
    } else {
        // Public Layout (Floating Navbar)
        include_once __DIR__ . '/navbar.php';
    }
    ?>

    <div class="<?php echo isLoggedIn() ? 'w-full px-4 md:px-8' : 'max-w-6xl mx-auto px-4 w-full'; ?> mt-<?php echo isLoggedIn() ? '6' : '28'; ?> mb-12 flex-grow">
        <?php flash('message'); ?>
        <?php include_once __DIR__ . '/modals.php'; ?>
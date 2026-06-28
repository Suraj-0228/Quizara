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
                            50: '#f5f3ff',
                            100: '#ede9fe',
                            200: '#ddd6fe',
                            300: '#c4b5fd',
                            400: '#a78bfa',
                            500: '#8b5cf6',
                            600: '#7c3aed', // Brand primary violet-600
                            700: '#6d28d9',
                            800: '#5b21b6',
                            900: '#4c1d95',
                        },
                        accent: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            200: '#a7f3d0',
                            300: '#6ee7b7',
                            400: '#34d399',
                            500: '#10b981', // Brand accent emerald-500
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                        },
                        slate: {
                            50: '#F8FAFC',
                            100: '#F1F5F9',
                            200: '#E2E8F0',
                            300: '#CBD5E1',
                            400: '#94A3B8',
                            500: '#64748B',
                            600: '#475569',
                            700: '#334155',
                            800: '#1E293B',
                            900: '#0F172A',
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
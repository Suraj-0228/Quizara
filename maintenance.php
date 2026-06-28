<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Under Maintenance - Quizara</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#7c3aed',
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
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/Quizara/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/Quizara/assets/css/maintenance.css">
</head>

<body class="flex items-center justify-center min-h-screen bg-slate-50 text-slate-900 font-sans p-4">

    <div class="bg-white/80 border border-slate-200 backdrop-blur-md rounded-[32px] text-center p-8 md:p-12 shadow-premium max-w-lg w-full relative overflow-hidden z-1">
        <!-- Accent top border gradient -->
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary-500 to-primary-600"></div>

        <div class="inline-flex items-center bg-slate-100/50 border border-slate-200/80 text-slate-700 px-4.5 py-1.5 rounded-full text-[11px] font-bold uppercase tracking-wider mb-10 mx-auto">
            <i class="fas fa-circle text-[8px] text-emerald-500 mr-2 animate-pulse"></i> System Status: Maintenance
        </div>

        <div class="mb-10 relative inline-block">
            <i class="fas fa-cog text-6xl text-amber-500 gear-icon"></i>
            <div class="absolute -bottom-2 -right-2 bg-primary-600 text-white w-10 h-10 rounded-xl flex items-center justify-center text-sm shadow-md border border-white/10 tool-icon">
                <i class="fas fa-wrench text-xs"></i>
            </div>
        </div>

        <h1 class="text-3xl font-black text-slate-900 mb-3">System Maintenance</h1>
        <p class="text-slate-500 text-xs md:text-sm font-medium px-4 mb-10 leading-relaxed">
            We are currently optimizing our quiz engine and refreshing core modules to serve you better. We'll be back online briefly.
        </p>

        <div class="flex flex-col sm:flex-row justify-center gap-4 w-full">
            <a href="/Quizara/logout.php" class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-bold px-6 py-3.5 rounded-full shadow-md text-xs flex items-center justify-center transition-all">
                <i class="fas fa-sign-out-alt mr-2 text-[10px]"></i>Exit Portal
            </a>
            <a href="#" onclick="window.location.reload()" class="w-full sm:w-auto bg-primary-600 hover:bg-primary-700 text-violet-600 font-bold px-8 py-3.5 rounded-full shadow-md hover:scale-105 transition-all text-xs flex items-center justify-center btn-glow">
                Re-verify Status <i class="fas fa-sync-alt ml-2 text-[10px]"></i>
            </a>
        </div>

        <div class="mt-10 pt-6 border-t border-slate-100">
            <div class="flex items-center justify-center text-slate-400 text-xs font-bold">
                <i class="fas fa-hourglass-half mr-2 text-primary-500"></i> Estimated Recovery: 60 Minutes
            </div>
        </div>
    </div>

</body>

</html>
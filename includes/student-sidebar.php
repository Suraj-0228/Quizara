<div class="student-sidebar flex flex-col flex-shrink-0 p-4 bg-white border-r border-slate-200 shadow-md">
    <a href="<?php echo base_url('student/dashboard.php'); ?>" class="flex items-center mb-6 text-primary-600 hover:text-primary-700 transition-colors font-extrabold text-xl tracking-wider">
        <i class="fas fa-graduation-cap text-2xl mr-2 text-primary-600"></i>
        <span class="text-xl font-extrabold text-slate-900 tracking-wider">Quizara</span>
    </a>
    <hr class="border-slate-200 my-2">
    
    <ul class="flex flex-col space-y-1 mb-auto">
        <?php
        global $pdo;
        $sidebar_user = null;
        if (isset($_SESSION['user_id']) && isset($pdo)) {
            $s_stmt = $pdo->prepare("SELECT username, email, role, profile_pic FROM users WHERE id = ?");
            $s_stmt->execute([$_SESSION['user_id']]);
            $sidebar_user = $s_stmt->fetch(PDO::FETCH_ASSOC);
        }

        $sidebar_username = $sidebar_user['username'] ?? $_SESSION['username'] ?? 'User';
        $sidebar_email = $sidebar_user['email'] ?? $_SESSION['email'] ?? '';
        $sidebar_pic = $sidebar_user['profile_pic'] ?? null;
        $sidebar_role = $sidebar_user['role'] ?? $_SESSION['role'] ?? 'Student';

        $current_page = basename($_SERVER['PHP_SELF']);
        $menu_items = [
            ['dashboard.php', 'Dashboard', 'fas fa-tachometer-alt', ['dashboard.php']],
            ['quizzes.php', 'Quizzes', 'fas fa-list-check', ['quizzes.php', 'take-quiz.php', 'results.php', 'review.php', 'upgrade-premium.php', 'checkout.php', 'receipt.php']],
            ['history.php', 'History', 'fas fa-history', ['history.php']],
            ['reports.php', 'Reports', 'fas fa-chart-line', ['reports.php']],
            ['profile.php', 'Profile', 'fas fa-id-card', ['profile.php']],
            ['settings.php', 'Settings', 'fas fa-cog', ['settings.php']]
        ];

        foreach ($menu_items as $item):
            $is_active = in_array($current_page, $item[3]);
            $active_classes = $is_active 
                ? 'bg-primary-600 text-white shadow-md' 
                : 'text-slate-600 hover:bg-primary-50 hover:text-primary-600';
            $icon_color = $is_active ? 'text-white' : 'text-slate-400 group-hover:text-primary-600';
        ?>
            <li>
                <a href="<?php echo base_url('student/' . $item[0]); ?>" class="group flex items-center px-4 py-2.5 rounded-lg text-sm font-semibold transition-all <?php echo $active_classes; ?>">
                    <i class="<?php echo $item[2]; ?> mr-3 w-5 text-center transition-colors <?php echo $icon_color; ?>"></i>
                    <?php echo $item[1]; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="mt-auto">
        <a href="<?php echo base_url('logout.php'); ?>" class="flex items-center justify-center w-full px-4 py-2.5 border border-red-200 hover:border-transparent text-red-600 hover:bg-red-600 hover:text-white rounded-lg text-sm font-bold transition-all mb-4">
            <i class="fas fa-sign-out-alt mr-2"></i> Log Out
        </a>

        <hr class="border-slate-200 my-3">

        <div class="flex items-center px-2 py-2 bg-slate-50 rounded-xl border border-slate-200">
            <div class="w-9 h-9 rounded-full bg-primary-600 border border-slate-200 flex items-center justify-center text-white font-bold text-sm mr-3 flex-shrink-0 shadow-sm overflow-hidden">
                <?php if (!empty($sidebar_pic) && file_exists(__DIR__ . '/../assets/images/profiles/' . $sidebar_pic)): ?>
                    <img src="<?php echo base_url('assets/images/profiles/' . sanitize($sidebar_pic)); ?>" alt="Profile" class="w-full h-full object-cover">
                <?php else: ?>
                    <span><?php echo strtoupper(substr($sidebar_username, 0, 1)); ?></span>
                <?php endif; ?>
            </div>
            <div class="min-w-0">
                <div class="font-bold text-slate-800 text-sm truncate max-w-[130px]" title="<?php echo sanitize($sidebar_username); ?>"><?php echo sanitize($sidebar_username); ?></div>
                <div class="text-slate-400 text-xs font-semibold truncate max-w-[130px]" title="<?php echo sanitize($sidebar_email); ?>"><?php echo sanitize($sidebar_email); ?></div>
            </div>
        </div>
    </div>
</div>

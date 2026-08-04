<?php include_once 'controllers/students-process.php'; ?>

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
    <div>
        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-2">Registered Students</h1>
        <p class="text-slate-500 text-sm mb-0">Monitor student progress and activity.</p>
    </div>
    <div class="flex-shrink-0">
        <div class="bg-primary-50 text-primary-600 border border-primary-100/30 text-sm font-bold px-4 py-2.5 rounded-full flex items-center shadow-sm">
            <i class="fas fa-users mr-2 text-xs"></i>
            <span><?php echo count($students); ?></span>&nbsp;<span class="text-primary-400 font-medium">Total Students</span>
        </div>
    </div>
</div>

<!-- Students Table -->
<div class="bg-white border border-slate-200 rounded-3xl shadow-premium overflow-hidden mb-8">
    <div class="overflow-x-auto w-full">
        <table class="w-full text-left text-sm text-slate-600 border-collapse">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr>
                    <th class="px-6 py-3.5 text-sm font-bold text-slate-400 uppercase tracking-wider">Student</th>
                    <th class="px-6 py-3.5 text-sm font-bold text-slate-400 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3.5 text-sm font-bold text-slate-400 uppercase tracking-wider">Joined</th>
                    <th class="px-6 py-3.5 text-sm font-bold text-slate-400 uppercase tracking-wider text-center">Quizzes Taken</th>
                    <th class="px-6 py-3.5 text-sm font-bold text-slate-400 uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($students) > 0): ?>
                    <?php foreach ($students as $student): ?>
                        <tr class="border-b border-slate-100 last:border-0 hover:bg-slate-50/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-9 h-9 bg-primary-50 border border-slate-100 flex items-center justify-center font-bold text-primary-600 mr-3 text-xs select-none flex-shrink-0 rounded-full">
                                        <?php echo strtoupper(substr($student['username'], 0, 1)); ?>
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-800"><?php echo sanitize($student['username']); ?></div>
                                        <div class="text-slate-400 text-xs font-bold">ID: #<?php echo $student['id']; ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-500 font-semibold"><?php echo sanitize($student['email']); ?></td>
                            <td class="px-6 py-4 text-slate-400 text-sm font-semibold">
                                <i class="far fa-calendar-alt mr-1.5 opacity-60"></i>
                                <?php echo date('M d, Y', strtotime($student['created_at'])); ?>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <?php if ($student['quizzes_taken'] > 0): ?>
                                    <span class="bg-emerald-50 text-emerald-600 border border-emerald-100 text-xs font-bold px-2.5 py-1 rounded-full uppercase tracking-wider inline-flex items-center">
                                        <?php echo $student['quizzes_taken']; ?> Quizzes
                                    </span>
                                <?php else: ?>
                                    <span class="bg-amber-50 text-amber-600 border border-amber-100 text-xs font-bold px-2.5 py-1 rounded-full uppercase tracking-wider inline-flex items-center">
                                        Inactive
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-1.5">
                                    <a href="student-details.php?id=<?php echo $student['id']; ?>" class="w-8 h-8 rounded-full flex items-center justify-center text-sky-500 hover:bg-sky-50 transition-all" title="View History">
                                        <i class="fas fa-chart-line"></i>
                                    </a>

                                    <!-- Block Toggle -->
                                    <form action="" method="POST" class="inline">
                                        <input type="hidden" name="user_id" value="<?php echo $student['id']; ?>">
                                        <input type="hidden" name="action" value="toggle_block">
                                        <button type="submit" class="w-8 h-8 rounded-full flex items-center justify-center <?php echo $student['is_blocked'] ? 'text-rose-500 hover:bg-rose-50' : 'text-amber-500 hover:bg-amber-50'; ?> transition-all focus:outline-none"
                                            title="<?php echo $student['is_blocked'] ? 'Unblock Student' : 'Block Student'; ?>">
                                            <i class="fas <?php echo $student['is_blocked'] ? 'fa-ban' : 'fa-user-lock'; ?>"></i>
                                        </button>
                                    </form>

                                    <!-- Delete -->
                                    <form action="" method="POST" class="inline" onsubmit="return confirm('Are you sure? This will delete the student and all their quiz attempts.');">
                                        <input type="hidden" name="user_id" value="<?php echo $student['id']; ?>">
                                        <input type="hidden" name="action" value="delete">
                                        <button type="submit" class="w-8 h-8 rounded-full flex items-center justify-center text-rose-500 hover:bg-rose-50 transition-all focus:outline-none" title="Delete Student">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-12">
                            <div class="mb-4">
                                <i class="fas fa-users-slash text-slate-350 text-5xl"></i>
                            </div>
                            <h5 class="font-bold text-slate-800 text-base mb-1">No students found</h5>
                            <p class="text-slate-400 text-sm">Share your quiz link to get students started.</p>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include_once '../includes/admin-footer.php'; ?>
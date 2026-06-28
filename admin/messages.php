<?php require_once 'controllers/message-proccess.php'; ?>

<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-8">
    <div>
        <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-1">Inbox</h2>
        <p class="text-slate-550 text-sm">Manage inquiries and support requests.</p>
    </div>
    <div class="flex-wrap gap-4 w-full lg:w-auto flex">
        <!-- Stat card 1 -->
        <div class="bg-white border border-slate-200 p-4 rounded-2xl shadow-sm flex items-center flex-grow sm:flex-initial min-w-[150px]">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center text-lg bg-primary-50 border border-primary-100/30 text-primary-600 mr-3.5 flex-shrink-0">
                <i class="fas fa-inbox"></i>
            </div>
            <div>
                <div class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-0.5">Total Messages</div>
                <div class="text-lg font-extrabold text-slate-800"><?php echo $total_messages; ?></div>
            </div>
        </div>
        <!-- Stat card 2 -->
        <div class="bg-white border border-slate-200 p-4 rounded-2xl shadow-sm flex items-center flex-grow sm:flex-initial min-w-[150px]">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center text-lg bg-emerald-50 text-emerald-500 mr-3.5 flex-shrink-0">
                <i class="fas fa-calendar-day"></i>
            </div>
            <div>
                <div class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-0.5">Today</div>
                <div class="text-lg font-extrabold text-slate-800"><?php echo $today_count; ?></div>
            </div>
        </div>
    </div>
</div>

<?php if ($message): ?>
    <div class="p-4 mb-6 rounded-2xl bg-primary-50 border border-primary-200 text-primary-700 text-sm font-medium flex items-center justify-between">
        <div class="flex items-center">
            <i class="fas fa-info-circle mr-2.5"></i> <?php echo $message; ?>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-primary-500 hover:text-primary-700"><i class="fas fa-times"></i></button>
    </div>
<?php endif; ?>

<!-- Main Content Card -->
<div class="bg-white border border-slate-200 rounded-3xl shadow-premium overflow-hidden mb-8">
    <!-- Toolbar -->
    <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4 bg-slate-50/50">
        <div class="w-full md:w-80">
            <form action="" method="GET" class="relative">
                <i class="fas fa-search absolute left-4 top-3.5 text-slate-400"></i>
                <input type="text" name="search" class="w-full pl-10 pr-4 py-2.5 rounded-full border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-600 text-slate-800 text-sm bg-white" placeholder="Search messages..." value="<?php echo htmlspecialchars($search); ?>">
            </form>
        </div>
        <div class="flex gap-2 w-full md:w-auto justify-end">
            <button class="border border-primary-200 text-primary-600 hover:bg-primary-50 font-bold px-4 py-2 rounded-full text-xs transition-all flex items-center focus:outline-none" onclick="window.location.reload()">
                <i class="fas fa-sync-alt mr-2 text-[10px]"></i>Refresh
            </button>
            <?php if (!empty($search)): ?>
                <a href="messages.php" class="border border-slate-250 text-slate-500 hover:bg-slate-50 font-bold px-4 py-2 rounded-full text-xs transition-all flex items-center focus:outline-none">Clear Search</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="divide-y divide-slate-100">
        <?php if (count($messages) > 0): ?>
            <?php foreach ($messages as $msg): ?>
                <?php
                // Generate Avatar Initials/Color
                $initial = strtoupper(substr($msg['name'], 0, 1));
                $colors = ['primary', 'emerald', 'rose', 'amber', 'sky', 'slate'];
                $color_index = ord($initial) % count($colors);
                $colorName = $colors[$color_index];
                
                // Map style mappings
                $avatarBg = $colorName === 'primary' ? 'bg-primary-50' : 'bg-' . $colorName . '-50';
                $avatarText = $colorName === 'primary' ? 'text-primary-600 border border-primary-100/30' : 'text-' . $colorName . '-600';
                ?>
                <div class="p-6 hover:bg-slate-50/30 transition-colors flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 relative group">
                    <!-- Avatar & Sender -->
                    <div class="flex items-center w-full lg:w-1/4 flex-shrink-0 min-w-0">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-[10px] mr-3.5 flex-shrink-0 select-none <?php echo $avatarBg; ?> <?php echo $avatarText; ?>">
                            <?php echo $initial; ?>
                        </div>
                        <div class="min-w-0">
                            <h6 class="font-bold text-slate-800 text-sm truncate"><?php echo sanitize($msg['name']); ?></h6>
                            <small class="text-slate-400 text-xs truncate d-block"><?php echo sanitize($msg['email']); ?></small>
                        </div>
                    </div>

                    <!-- Preview -->
                    <div class="flex-grow min-w-0 w-full lg:w-1/2 cursor-pointer" onclick="openViewModal('<?php echo $msg['id']; ?>')">
                        <div class="d-flex flex-column">
                            <span class="font-bold text-slate-800 text-sm truncate mb-0.5"><?php echo sanitize($msg['subject']); ?></span>
                            <span class="text-slate-400 text-xs truncate max-w-lg d-block">
                                <?php echo substr(sanitize($msg['message']), 0, 80) . '...'; ?>
                            </span>
                        </div>
                    </div>

                    <!-- Date & Actions -->
                    <div class="w-full lg:w-1/4 flex lg:flex-col items-center lg:items-end justify-between gap-2 lg:text-right flex-shrink-0">
                        <div class="text-slate-400 text-xs font-semibold"><?php echo date('M d, h:i A', strtotime($msg['created_at'])); ?></div>
                        <div class="flex items-center space-x-1.5 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <button class="w-8 h-8 rounded-full flex items-center justify-center text-sky-500 hover:bg-sky-50 transition-all" onclick="openViewModal('<?php echo $msg['id']; ?>')" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                            <form action="" method="POST" class="inline" onsubmit="return confirm('Delete this message?');">
                                <input type="hidden" name="message_id" value="<?php echo $msg['id']; ?>">
                                <input type="hidden" name="delete_message" value="1">
                                <button type="submit" class="w-8 h-8 rounded-full flex items-center justify-center text-rose-500 hover:bg-rose-50 transition-all focus:outline-none" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-center py-12">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                    <i class="fas fa-inbox text-3xl"></i>
                </div>
                <h5 class="font-bold text-slate-800 text-base mb-1">No messages found</h5>
                <p class="text-slate-400 text-xs">Try adjusting your search filters.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if ($total_pages > 1): ?>
        <div class="p-6 border-t border-slate-100 flex justify-center bg-slate-50/30">
            <nav class="flex items-center space-x-1.5">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <?php if ($page == $i): ?>
                        <span class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold bg-primary-600 text-white shadow-sm"><?php echo $i; ?></span>
                    <?php else: ?>
                        <a class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold text-slate-650 hover:bg-slate-50 hover:text-primary-600 transition-all" href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>">
                            <?php echo $i; ?>
                        </a>
                    <?php endif; ?>
                <?php endfor; ?>
            </nav>
        </div>
    <?php endif; ?>
</div>

<!-- Modals -->
<?php foreach ($messages as $msg): ?>
    <?php
    $initial = strtoupper(substr($msg['name'], 0, 1));
    $colors = ['primary', 'emerald', 'rose', 'amber', 'sky', 'slate'];
    $color_index = ord($initial) % count($colors);
    $colorName = $colors[$color_index];
    
    $modalAvatarBg = $colorName === 'primary' ? 'bg-white/10 border border-white/5' : 'bg-' . $colorName . '-50/10';
    $modalAvatarText = $colorName === 'primary' ? 'text-white' : 'text-' . $colorName . '-100';
    ?>
    <div class="modal fixed inset-0 z-50 items-center justify-center bg-slate-900/60 backdrop-blur-sm hidden" id="viewModal<?php echo $msg['id']; ?>" aria-hidden="true">
        <div class="bg-white rounded-3xl shadow-premium max-w-2xl w-full m-4 relative border border-slate-100 overflow-hidden animate-bounce-in">
            <div class="bg-primary-600 p-6 text-white relative flex items-center">
                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold mr-3.5 flex-shrink-0 select-none <?php echo $modalAvatarBg; ?> <?php echo $modalAvatarText; ?>">
                    <?php echo $initial; ?>
                </div>
                <div>
                    <h5 class="font-black text-white text-base leading-tight mb-0.5"><?php echo sanitize($msg['name']); ?></h5>
                    <small class="text-primary-100 text-xs opacity-75"><?php echo sanitize($msg['email']); ?></small>
                </div>
                <button type="button" class="absolute top-6 right-6 text-white/80 hover:text-white text-lg focus:outline-none" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="p-6 md:p-8 bg-white space-y-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                    <h4 class="font-extrabold text-slate-900 text-base md:text-lg leading-normal"><?php echo sanitize($msg['subject']); ?></h4>
                    <div class="bg-slate-50 text-slate-555 border border-slate-100 text-xs font-semibold px-3.5 py-1.5 rounded-full flex items-center shadow-sm text-nowrap">
                        <i class="far fa-clock mr-2"></i><?php echo date('F j, Y \a\t h:i A', strtotime($msg['created_at'])); ?>
                    </div>
                </div>
                
                <div class="p-6 rounded-2xl bg-slate-50 border border-slate-100 text-slate-600 text-xs md:text-sm leading-relaxed whitespace-pre-wrap">
                    <?php echo nl2br(sanitize($msg['message'])); ?>
                </div>
            </div>
            
            <div class="flex justify-end space-x-3 p-6 border-t border-slate-100 bg-slate-50/30">
                <a href="mailto:<?php echo sanitize($msg['email']); ?>" class="bg-primary-600 hover:bg-primary-700 text-white font-bold px-6 py-2.5 rounded-full shadow-md text-xs transition-all focus:outline-none hover:scale-105 flex items-center">
                    <i class="fas fa-reply mr-2 text-[10px]"></i>Reply via Email
                </a>
                <button type="button" class="border border-slate-200 text-slate-505 hover:bg-slate-50 font-bold px-5 py-2.5 rounded-full text-xs transition-all focus:outline-none" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    function openViewModal(msgId) {
        const modal = new bootstrap.Modal(document.getElementById(`viewModal${msgId}`));
        modal.show();
    }
</script>

<?php include_once '../includes/admin-footer.php'; ?>
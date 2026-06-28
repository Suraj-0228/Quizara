<?php
require_once 'controllers/dash-process.php';
requireAdmin();

// Fetch all categories
$stmt = $pdo->query("SELECT * FROM categories ORDER BY name ASC");
$categories = $stmt->fetchAll();

$pageTitle = 'Manage Categories';
include_once '../includes/header.php';
?>

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
    <div>
        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-2">Quiz Categories</h1>
        <p class="text-slate-500 text-sm md:text-base mb-0">Organize your quizzes into meaningful topics.</p>
    </div>
    <div class="flex-shrink-0">
        <button class="bg-primary-600 hover:bg-primary-700 text-white font-bold px-6 py-3 rounded-full shadow-md text-xs transition-all focus:outline-none hover:scale-105 flex items-center" onclick="openAddModal()">
            <i class="fas fa-plus mr-2 text-[10px]"></i>Add Category
        </button>
    </div>
</div>

<!-- Categories Cards Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <?php foreach ($categories as $cat): ?>
        <div class="bg-white border border-slate-200 rounded-3xl p-6 shadow-sm hover:shadow-premium hover:-translate-y-1.5 transition-all duration-300 flex flex-col h-full relative group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 bg-primary-50 text-primary-600 border border-primary-100/30 rounded-2xl flex items-center justify-center text-sm">
                    <i class="fas fa-folder-open"></i>
                </div>
                
                <!-- Action Dropdown Menu -->
                <div class="relative inline-block text-left">
                    <button class="text-slate-400 hover:text-slate-600 p-1 text-sm focus:outline-none" data-bs-toggle="dropdown">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu absolute right-0 mt-2 w-32 bg-white border border-slate-200 rounded-2xl shadow-premium py-2 z-20 hidden">
                        <li>
                            <button class="w-full text-left px-4 py-2 text-xs font-bold text-emerald-600 hover:bg-slate-50 flex items-center transition-colors" onclick='openEditModal(<?php echo json_encode($cat); ?>)'>
                                <i class="fas fa-edit mr-2"></i>Edit
                            </button>
                        </li>
                        <li class="border-t border-slate-100 my-1"></li>
                        <li>
                            <form action="controllers/category-process.php" method="POST" onsubmit="return confirm('Are you sure? This action cannot be undone.')">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo $cat['id']; ?>">
                                <button type="submit" class="w-full text-left px-4 py-2 text-xs font-bold text-red-600 hover:bg-slate-50 flex items-center transition-colors">
                                    <i class="fas fa-trash-alt mr-2"></i>Delete
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <h5 class="font-extrabold text-slate-900 text-base mb-2"><?php echo sanitize($cat['name']); ?></h5>
            <p class="text-slate-550 text-xs leading-relaxed mb-6 flex-grow line-clamp-3">
                <?php echo !empty($cat['description']) ? sanitize($cat['description']) : 'No description provided.'; ?>
            </p>

            <div class="flex items-center pt-4 border-t border-slate-100 mt-auto">
                <?php
                $quizCount = $pdo->prepare("SELECT COUNT(*) FROM quizzes WHERE category_id = ?");
                $quizCount->execute([$cat['id']]);
                $count = $quizCount->fetchColumn();
                ?>
                <span class="bg-primary-50 text-primary-600 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                    <?php echo $count; ?> Quizzes
                </span>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Add Category Modal -->
<div class="modal fixed inset-0 z-50 items-center justify-center bg-slate-900/60 backdrop-blur-sm hidden" id="addCategoryModal" aria-hidden="true">
    <div class="bg-white rounded-3xl shadow-premium max-w-md w-full m-4 relative border border-slate-100 overflow-hidden animate-bounce-in">
        <div class="bg-primary-600 p-6 text-white relative">
            <h4 class="text-xl font-black mb-1">Add New Category</h4>
            <p class="text-primary-100 text-xs opacity-75">Define a topic area to group and manage quizzes.</p>
            <button type="button" class="absolute top-6 right-6 text-white/80 hover:text-white text-lg focus:outline-none" data-bs-dismiss="modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-6 bg-white">
            <form action="controllers/category-process.php" method="POST" class="space-y-6">
                <input type="hidden" name="action" value="add">
                
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Category Name</label>
                    <input type="text" name="name" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 font-medium focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-600 transition-all" placeholder="e.g., Mathematics">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Description</label>
                    <textarea name="description" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 font-medium focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-600 transition-all resize-none" rows="3" placeholder="Brief overview of this category..."></textarea>
                </div>

                <div class="flex justify-end space-x-3 pt-3 border-t border-slate-100">
                    <button type="button" class="border border-slate-200 text-slate-505 hover:bg-slate-50 font-bold px-5 py-2.5 rounded-full text-xs transition-all focus:outline-none" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-bold px-6 py-2.5 rounded-full shadow-md text-xs transition-all focus:outline-none hover:scale-105">Create Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fixed inset-0 z-50 items-center justify-center bg-slate-900/60 backdrop-blur-sm hidden" id="editCategoryModal" aria-hidden="true">
    <div class="bg-white rounded-3xl shadow-premium max-w-md w-full m-4 relative border border-slate-100 overflow-hidden animate-bounce-in">
        <div class="bg-primary-600 p-6 text-white relative">
            <h4 class="text-xl font-black mb-1">Edit Category</h4>
            <p class="text-primary-100 text-xs opacity-75">Modify title and descriptions for category topic.</p>
            <button type="button" class="absolute top-6 right-6 text-white/80 hover:text-white text-lg focus:outline-none" data-bs-dismiss="modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-6 bg-white">
            <form action="controllers/category-process.php" method="POST" class="space-y-6">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id" id="edit_cat_id">
                
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Category Name</label>
                    <input type="text" name="name" id="edit_cat_name" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 font-medium focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-600 transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Description</label>
                    <textarea name="description" id="edit_cat_description" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 font-medium focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-600 transition-all resize-none" rows="3"></textarea>
                </div>

                <div class="flex justify-end space-x-3 pt-3 border-t border-slate-100">
                    <button type="button" class="border border-slate-200 text-slate-505 hover:bg-slate-50 font-bold px-5 py-2.5 rounded-full text-xs transition-all focus:outline-none" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-bold px-6 py-2.5 rounded-full shadow-md text-xs transition-all focus:outline-none hover:scale-105">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openAddModal() {
        const modal = new bootstrap.Modal(document.getElementById('addCategoryModal'));
        modal.show();
    }

    function openEditModal(cat) {
        document.getElementById('edit_cat_id').value = cat.id;
        document.getElementById('edit_cat_name').value = cat.name;
        document.getElementById('edit_cat_description').value = cat.description;
        const modal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
        modal.show();
    }
</script>

<?php include_once '../includes/admin-footer.php'; ?>
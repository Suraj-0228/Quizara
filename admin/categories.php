<?php
require_once 'controllers/dash-process.php'; 
requireAdmin();

// Fetch all categories
$stmt = $pdo->query("SELECT * FROM categories ORDER BY name ASC");
$categories = $stmt->fetchAll();

$pageTitle = 'Manage Categories';
?>

<div class="container py-5">
    <!-- Header Section -->
    <div class="row align-items-center mb-5">
        <div class="col-md-8">
            <h1 class="display-5 fw-bold text-light mb-2">Quiz Categories</h1>
            <p class="text-muted lead mb-0">Organize your quizzes into meaningful topics.</p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <button class="btn btn-gradient-primary rounded-pill px-4 hover-scale" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                <i class="fas fa-plus me-2"></i>Add Category
            </button>
        </div>
    </div>

    <!-- Categories Cards Grid -->
    <div class="row g-4">
        <?php foreach ($categories as $cat): ?>
            <div class="col-md-4">
                <div class="stat-card h-100 p-4 d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="feature-icon-wrapper bg-primary bg-opacity-10 text-primary mb-0">
                            <i class="fas fa-folder-open fa-lg"></i>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-link text-muted p-0" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end shadow-lg border-light border-opacity-10">
                                <li>
                                    <button class="dropdown-item py-2" onclick='openEditModal(<?php echo json_encode($cat); ?>)'>
                                        <i class="fas fa-edit me-2 text-primary"></i>Edit
                                    </button>
                                </li>
                                <li><hr class="dropdown-divider border-light border-opacity-10"></li>
                                <li>
                                    <form action="controllers/category-process.php" method="POST" onsubmit="return confirm('Are you sure? This action cannot be undone.')">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?php echo $cat['id']; ?>">
                                        <button type="submit" class="dropdown-item py-2 text-danger">
                                            <i class="fas fa-trash-alt me-2"></i>Delete
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <h5 class="text-light fw-bold mb-2"><?php echo sanitize($cat['name']); ?></h5>
                    <p class="text-muted small mb-4 flex-grow-1">
                        <?php echo !empty($cat['description']) ? sanitize($cat['description']) : 'No description provided.'; ?>
                    </p>
                    <div class="d-flex align-items-center pt-3 border-top border-light border-opacity-10">
                        <?php 
                            $quizCount = $pdo->prepare("SELECT COUNT(*) FROM quizzes WHERE category_id = ?");
                            $quizCount->execute([$cat['id']]);
                            $count = $quizCount->fetchColumn();
                        ?>
                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3">
                            <?php echo $count; ?> Quizzes
                        </span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark-glass border-light border-opacity-10 rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-light fw-bold">Add New Category</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="controllers/category-process.php" method="POST">
                <input type="hidden" name="action" value="add">
                <div class="modal-body py-4">
                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Category Name</label>
                        <input type="text" name="name" class="form-control bg-dark bg-opacity-50 border-light border-opacity-10 text-light py-2" placeholder="e.g., Mathematics" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label text-muted small text-uppercase fw-bold">Description</label>
                        <textarea name="description" class="form-control bg-dark bg-opacity-50 border-light border-opacity-10 text-light" rows="3" placeholder="Brief overview of this category..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-gradient-primary rounded-pill px-4">Create Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark-glass border-light border-opacity-10 rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-light fw-bold">Edit Category</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="controllers/category-process.php" method="POST">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id" id="edit_cat_id">
                <div class="modal-body py-4">
                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Category Name</label>
                        <input type="text" name="name" id="edit_cat_name" class="form-control bg-dark bg-opacity-50 border-light border-opacity-10 text-light py-2" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label text-muted small text-uppercase fw-bold">Description</label>
                        <textarea name="description" id="edit_cat_description" class="form-control bg-dark bg-opacity-50 border-light border-opacity-10 text-light" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-gradient-primary rounded-pill px-4">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openEditModal(cat) {
    document.getElementById('edit_cat_id').value = cat.id;
    document.getElementById('edit_cat_name').value = cat.name;
    document.getElementById('edit_cat_description').value = cat.description;
    new bootstrap.Modal(document.getElementById('editCategoryModal')).show();
}
</script>

<?php include_once '../includes/admin-footer.php'; ?>

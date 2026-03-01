<?php
require_once '../../config/database.php';
require_once '../../includes/functions.php';
requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add') {
        $name = sanitize($_POST['name']);
        $description = sanitize($_POST['description']);

        if (empty($name)) {
            flash('message', 'Category name is required.', 'danger');
        } else {
            $stmt = $pdo->prepare("INSERT INTO categories (name, description) VALUES (?, ?)");
            try {
                $stmt->execute([$name, $description]);
                flash('message', 'Category added successfully!', 'success');
            } catch (PDOException $e) {
                flash('message', 'Error adding category: ' . $e->getMessage(), 'danger');
            }
        }
    } elseif ($action === 'edit') {
        $id = (int)$_POST['id'];
        $name = sanitize($_POST['name']);
        $description = sanitize($_POST['description']);

        if (empty($name)) {
            flash('message', 'Category name is required.', 'danger');
        } else {
            $stmt = $pdo->prepare("UPDATE categories SET name = ?, description = ? WHERE id = ?");
            try {
                $stmt->execute([$name, $description, $id]);
                flash('message', 'Category updated successfully!', 'success');
            } catch (PDOException $e) {
                flash('message', 'Error updating category: ' . $e->getMessage(), 'danger');
            }
        }
    } elseif ($action === 'delete') {
        $id = (int)$_POST['id'];

        // Check if there are quizzes in this category
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM quizzes WHERE category_id = ?");
        $stmt->execute([$id]);
        if ($stmt->fetchColumn() > 0) {
            flash('message', 'Cannot delete category: It contains quizzes. Please move or delete the quizzes first.', 'warning');
        } else {
            $stmt = $pdo->prepare("DELETE FROM categories WHERE id = ?");
            try {
                $stmt->execute([$id]);
                flash('message', 'Category deleted successfully!', 'success');
            } catch (PDOException $e) {
                flash('message', 'Error deleting category: ' . $e->getMessage(), 'danger');
            }
        }
    }

    redirect('../../admin/categories.php');
}
?>

<?php include_once 'controllers/edit-question-process.php'; ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Navigation -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <a href="questions.php?quiz_id=<?php echo $quiz_id; ?>" class="btn btn-outline-light btn-sm rounded-pill px-3 opacity-75 hover-opacity-100">
                    <i class="fas fa-arrow-left me-2"></i>Back to Questions
                </a>
                <span class="badge bg-primary bg-opacity-25 text-primary border border-primary border-opacity-25 rounded-pill px-3 py-2">
                    <?php echo sanitize($quiz['title']); ?>
                </span>
            </div>

            <div class="glass-card border-0 shadow-lg position-relative overflow-hidden">
                <div class="card-header bg-transparent border-bottom border-secondary border-opacity-25 py-3 px-4">
                    <h5 class="mb-0 text-light fw-bold"><i class="fas fa-edit me-2 text-primary"></i> Edit Question</h5>
                </div>
                
                <div class="card-body p-4 p-md-5">
                    <form action="" method="POST">
                        <!-- Question Text -->
                        <div class="mb-5">
                            <label for="question_text" class="form-label text-light small text-uppercase fw-bold mb-2">Question Text</label>
                            <div class="position-relative">
                                <textarea class="form-control premium-control bg-transparent text-light border-secondary border-opacity-50 ps-4 pt-3" id="question_text" name="question_text" rows="3" required placeholder="Type your question here..." style="min-height: 100px; font-size: 1.1rem; box-shadow: none;"><?php echo sanitize($question['question_text']); ?></textarea>
                                <div class="position-absolute top-0 start-0 pt-3 ps-2 text-muted opacity-50"><i class="fas fa-quote-left"></i></div>
                            </div>
                        </div>

                        <!-- Difficulty Level -->
                        <div class="mb-4">
                            <label for="difficulty_level" class="form-label text-light small text-uppercase fw-bold mb-2">Difficulty Level</label>
                            <select class="form-select bg-dark bg-opacity-50 text-light border-secondary border-opacity-50" id="difficulty_level" name="difficulty_level" required>
                                <option value="low" <?php echo $question['difficulty_level'] == 'low' ? 'selected' : ''; ?>>Low</option>
                                <option value="medium" <?php echo $question['difficulty_level'] == 'medium' ? 'selected' : ''; ?>>Medium</option>
                                <option value="high" <?php echo $question['difficulty_level'] == 'high' ? 'selected' : ''; ?>>High</option>
                            </select>
                        </div>

                        <!-- Options & Correct Answer -->
                        <div class="mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <label class="form-label text-light small text-uppercase fw-bold mb-0">Answer Options</label>
                                <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25"><i class="fas fa-check-circle me-1"></i> Select current correct answer</span>
                            </div>
                            
                            <div class="row g-3">
                                <?php for($i=0; $i<4; $i++): ?>
                                <?php 
                                    $opt_val = isset($existing_options[$i]) ? sanitize($existing_options[$i]['option_text']) : '';
                                    $is_correct = isset($existing_options[$i]) && $existing_options[$i]['is_correct'] ? 'checked' : '';
                                ?>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-text bg-dark bg-opacity-50 border-secondary border-opacity-50">
                                            <input class="form-check-input mt-0 shadow-none cursor-pointer" type="radio" name="correct_option" value="<?php echo $i+1; ?>" <?php echo $is_correct; ?> aria-label="Correct answer">
                                        </div>
                                        <input type="text" class="form-control bg-transparent text-light border-secondary border-opacity-50" name="options[]" placeholder="Option <?php echo $i+1; ?>" value="<?php echo $opt_val; ?>" required>
                                    </div>
                                </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                        
                        <!-- Marks -->
                        <div class="mb-5">
                             <label for="marks" class="form-label text-light small text-uppercase fw-bold mb-2">Points</label>
                             <div class="d-flex align-items-center">
                                 <button type="button" class="btn btn-outline-secondary btn-sm border-opacity-25 text-light" onclick="this.nextElementSibling.stepDown()"><i class="fas fa-minus"></i></button>
                                 <input type="number" class="form-control bg-transparent text-light border-secondary border-opacity-50 text-center mx-2" id="marks" name="marks" value="<?php echo $question['marks']; ?>" min="1" style="width: 80px;">
                                 <button type="button" class="btn btn-outline-secondary btn-sm border-opacity-25 text-light" onclick="this.previousElementSibling.stepUp()"><i class="fas fa-plus"></i></button>
                             </div>
                        </div>

                        <!-- Actions -->
                        <div class="d-grid pt-2">
                            <button type="submit" class="btn btn-gradient-primary btn-lg shadow-lg fw-bold">
                                <i class="fas fa-save me-2"></i>Update Question
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once '../includes/admin-footer.php'; ?>

<?php include_once '../controllers/take-quiz-process.php'; ?>

<!-- Sticky Header info bar -->
<div class="sticky top-[10px] z-30 bg-white border border-slate-200 rounded-2xl mb-6 py-4 shadow-sm glass-effect px-6">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center">
            <div>
                <h5 class="mb-0 font-extrabold text-slate-800 text-sm md:text-base hidden md:block"><?php echo sanitize($quiz['title']); ?> - <span class="text-primary-600"><?php echo ucfirst($mode); ?> Mode</span></h5>
                <small class="text-slate-400 text-xs md:hidden font-bold uppercase tracking-wider">Question Progress</small>
            </div>

            <div class="flex items-center space-x-3">
                <span class="bg-primary-50 border border-primary-100/30 text-primary-600 rounded-full px-4 py-1.5 text-xs font-bold flex items-center">
                    <i class="fas fa-question-circle mr-1 text-[12px]"></i> <?php echo count($questions); ?> Questions
                </span>

                <?php if ($quiz['time_limit'] > 0): ?>
                    <div class="timer-badge flex items-center px-4 py-1.5 rounded-full bg-amber-50 text-amber-600 border border-amber-200/50 text-xs font-bold shadow-sm transition-all">
                        <i class="fas fa-clock mr-2"></i>
                        <span id="time-remaining" class="min-w-[45px]"><?php echo $quiz['time_limit']; ?>:00</span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="max-w-3xl mx-auto">
    <form action="" method="POST" id="quizForm">
        <?php
        $total_questions = count($questions);
        $time_per_question = $quiz['time_limit'] > 0 ? floor(($quiz['time_limit'] * 60) / $total_questions) : 0;
        ?>

        <?php foreach ($questions as $index => $q): ?>
            <div class="bg-white rounded-[32px] border border-slate-200 shadow-premium mb-8 relative overflow-hidden question-card <?php echo $index > 0 ? 'hidden' : 'block'; ?>" id="q_<?php echo $index; ?>">
                <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-primary-500 to-primary-600"></div>
                <div class="p-6 md:p-10">
                    <div class="flex items-start mb-6">
                        <span class="text-3xl md:text-4xl font-extrabold text-slate-200 mr-4 leading-none select-none">
                            <?php echo sprintf("%02d", $index + 1); ?>
                        </span>
                        <h4 class="font-extrabold text-slate-800 text-base md:text-lg leading-normal mb-0 pt-0.5">
                            <?php echo sanitize($q['question_text']); ?>
                        </h4>
                    </div>

                    <?php
                    $opt_stmt = $pdo->prepare("SELECT * FROM options WHERE question_id = ? ORDER BY RAND()");
                    $opt_stmt->execute([$q['id']]);
                    $options = $opt_stmt->fetchAll();
                    ?>

                    <div class="options-grid">
                        <?php foreach ($options as $opt): ?>
                            <div class="option-item">
                                <input class="option-input" type="radio" name="answers[<?php echo $q['id']; ?>]" id="opt_<?php echo $opt['id']; ?>" value="<?php echo $opt['id']; ?>">
                                <label class="option-label mb-2" for="opt_<?php echo $opt['id']; ?>">
                                    <div class="check-circle"></div>
                                    <span class="option-text"><?php echo sanitize($opt['option_text']); ?></span>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 mt-8">
                        <button type="button" onclick="cancelQuiz()" class="w-full sm:flex-1 border border-red-200 hover:border-red-300 text-red-600 hover:bg-red-50 font-bold py-3.5 rounded-full text-sm transition-all focus:outline-none text-center">
                            Cancel Quiz <i class="fas fa-times ml-2"></i>
                        </button>
                        <?php if ($index == $total_questions - 1): ?>
                            <button type="button" class="w-full sm:flex-1 bg-primary-600 hover:bg-primary-700 text-white font-bold py-3.5 rounded-full shadow-md text-sm transition-all focus:outline-none text-center next-btn uppercase tracking-wider">
                                Submit Quiz <i class="fas fa-paper-plane ml-2"></i>
                            </button>
                        <?php else: ?>
                            <button type="button" class="w-full sm:flex-1 bg-primary-600 hover:bg-primary-700 text-white font-bold py-3.5 rounded-full shadow-md text-sm transition-all focus:outline-none text-center next-btn uppercase tracking-wider">
                                Next Question <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </form>
</div>

<!-- Cancel Confirmation Modal -->
<div class="modal fixed inset-0 z-50 items-center justify-center bg-slate-900/60 backdrop-blur-sm hidden" id="cancelQuizModal" aria-hidden="true">
    <div class="bg-white rounded-3xl shadow-premium max-w-sm w-full m-4 relative p-8 border border-slate-100 text-center animate-bounce-in">
        <!-- Icon -->
        <div class="w-16 h-16 rounded-full bg-red-50 text-red-600 flex items-center justify-center text-xl mx-auto mb-5">
            <i class="fas fa-sign-out-alt"></i>
        </div>

        <!-- Text -->
        <h4 class="text-xl font-black text-slate-900 mb-2">Confirm Cancel!</h4>
        <p class="text-slate-500 text-sm font-medium mb-6 leading-relaxed">
            Are You Sure You Want To Cancel<br>This Quiz??
        </p>

        <!-- Buttons -->
        <div class="flex flex-col space-y-2">
            <button type="button" class="block w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3.5 rounded-full shadow-md transition-all focus:outline-none" onclick="confirmCancelQuiz()">
                Cancel Quiz
            </button>
            <button type="button" class="w-full text-slate-400 hover:text-slate-600 text-sm font-bold py-2 focus:outline-none" data-bs-dismiss="modal">
                Resume
            </button>
        </div>
    </div>
</div>

<script>
    let currentQuestionIndex = 0;
    const totalQuestions = <?php echo $total_questions ?? 0; ?>;
    const form = document.getElementById('quizForm');

    <?php if (isset($time_per_question) && $time_per_question > 0): ?>

        const timePerQuestion = <?php echo $time_per_question; ?>; // seconds
        let currentTimeLimit = timePerQuestion;
        let timerInterval;

        const timerDisplay = document.getElementById('time-remaining');
        const timerBadge = document.querySelector('.timer-badge');

        function startTimer() {
            currentTimeLimit = timePerQuestion;
            timerBadge.classList.remove('timer-warning');
            updateTimerDisplay();

            clearInterval(timerInterval);
            timerInterval = setInterval(() => {
                currentTimeLimit--;
                updateTimerDisplay();

                if (currentTimeLimit < 10) {
                    timerBadge.classList.add('timer-warning');
                }

                if (currentTimeLimit <= 0) {
                    clearInterval(timerInterval);
                    advanceQuestion(true);
                }
            }, 1000);
        }

        function updateTimerDisplay() {
            const minutes = Math.floor(currentTimeLimit / 60);
            const seconds = currentTimeLimit % 60;
            timerDisplay.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        }

    <?php endif; ?>

    // Prevent accidental navigation
    window.onbeforeunload = function() {
        return "Are You Sure? You're About To Leave The Quiz. Your Quiz Progress Will Be Lost!!";
    };

    function advanceQuestion(isAutoAdvance = false) {
        const currentCard = document.getElementById(`q_${currentQuestionIndex}`);

        if (!isAutoAdvance) {
            const checkedOption = currentCard.querySelector('input[type="radio"]:checked');
            if (!checkedOption) {
                let errorTxt = currentCard.querySelector('.error-text');
                if (!errorTxt) {
                    errorTxt = document.createElement('p');
                    errorTxt.className = 'error-text text-red-500 mt-4 mb-0 text-center font-bold text-sm';
                    errorTxt.innerHTML = '<i class="fas fa-exclamation-circle mr-1.5"></i> Please, Select an Answer Before Proceeding!!';
                    currentCard.querySelector('.p-6, .p-10').appendChild(errorTxt);

                    setTimeout(() => errorTxt.remove(), 3500);
                }
                return;
            }
        }

        currentCard.classList.add('hidden');
        currentCard.classList.remove('block');

        currentQuestionIndex++;

        if (currentQuestionIndex < totalQuestions) {
            const nextCard = document.getElementById(`q_${currentQuestionIndex}`);
            nextCard.classList.remove('hidden');
            nextCard.classList.add('block');

            <?php if (isset($time_per_question) && $time_per_question > 0): ?>
                startTimer();
            <?php endif; ?>
        } else {
            submitQuiz();
        }
    }

    function submitQuiz() {
        window.onbeforeunload = null;
        <?php if (isset($time_per_question) && $time_per_question > 0): ?>
            clearInterval(timerInterval);
        <?php endif; ?>
        form.submit();
    }

    function cancelQuiz() {
        const cancelModal = new bootstrap.Modal(document.getElementById('cancelQuizModal'));
        cancelModal.show();
    }

    function confirmCancelQuiz() {
        window.onbeforeunload = null; // Remove the standard beforeunload alert
        window.location.href = 'quizzes.php';
    }

    // Attach event listeners to next buttons
    document.querySelectorAll('.next-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            advanceQuestion(false);
        });
    });

    // Start timer for the first question
    <?php if (isset($time_per_question) && $time_per_question > 0): ?>
        startTimer();
    <?php endif; ?>
</script>

<?php include_once '../includes/footer.php'; ?>
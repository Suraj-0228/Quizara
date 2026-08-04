<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireLogin();

if (!isset($_GET['quiz_id'])) {
    redirect('quizzes.php');
}

$quiz_id = (int)$_GET['quiz_id'];
$user_id = $_SESSION['user_id'];

// Fetch Quiz
$stmt = $pdo->prepare("SELECT title FROM quizzes WHERE id = ?");
$stmt->execute([$quiz_id]);
$quiz = $stmt->fetch();

if (!$quiz) {
    redirect('quizzes.php');
}

$pageTitle = 'Secure Checkout';
include_once '../includes/header.php';
?>

<div class="max-w-xl mx-auto py-10 px-4">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl md:text-3xl font-black text-slate-900 flex items-center">
            <i class="fas fa-shield-alt text-emerald-500 mr-3"></i> Secure Checkout
        </h2>
        <span class="bg-emerald-50 text-emerald-600 border border-emerald-100 text-xs font-bold px-3 py-1.5 rounded-full flex items-center shadow-sm">
            <i class="fas fa-lock text-[10px] mr-1.5"></i> 256-Bit SSL Encrypted
        </span>
    </div>

    <?php flash('message'); ?>

    <div class="bg-white border border-slate-200 rounded-[32px] p-6 md:p-8 shadow-premium">
        <!-- Quiz Order Summary -->
        <div class="bg-slate-50 border border-slate-100 rounded-2xl p-5 mb-6 flex justify-between items-center">
            <div>
                <span class="text-slate-400 text-xs font-bold uppercase tracking-wider block mb-0.5">Item Summary</span>
                <h5 class="font-extrabold text-slate-900 text-base mb-0.5"><?php echo sanitize($quiz['title']); ?></h5>
                <p class="text-primary-600 text-xs font-bold mb-0 flex items-center">
                    <i class="fas fa-bolt text-amber-500 mr-1.5"></i> High Difficulty Mode Access
                </p>
            </div>
            <div class="text-right">
                <span class="text-slate-400 text-xs font-bold uppercase tracking-wider block mb-0.5">Total Due</span>
                <h4 class="text-2xl font-black text-slate-900">₹149</h4>
            </div>
        </div>

        <form action="../controllers/dummy-payment-process.php" method="POST" id="checkoutForm" class="space-y-6">
            <input type="hidden" name="quiz_id" value="<?php echo $quiz_id; ?>">
            <input type="hidden" name="amount" value="149">
            <input type="hidden" name="payment_method" id="paymentMethodInput" value="card">

            <!-- Payment Method Selector -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-3">Select Payment Method</label>
                <div class="grid grid-cols-2 gap-4">
                    <!-- Card Option -->
                    <button type="button" id="btnMethodCard" onclick="selectPaymentMethod('card')" class="payment-method-btn flex items-center justify-center p-4 rounded-2xl border-2 border-primary-600 bg-primary-50/40 text-primary-600 font-bold transition-all shadow-sm focus:outline-none">
                        <i class="fas fa-credit-card text-lg mr-2.5 text-primary-600"></i>
                        <span class="text-sm">Credit / Debit Card</span>
                    </button>

                    <!-- GPay Option -->
                    <button type="button" id="btnMethodGPay" onclick="selectPaymentMethod('gpay')" class="payment-method-btn flex items-center justify-center p-4 rounded-2xl border border-slate-200 bg-white text-slate-600 font-bold transition-all hover:border-slate-300 focus:outline-none">
                        <i class="fab fa-google-pay text-2xl mr-2.5 text-slate-800"></i>
                        <span class="text-sm">Google Pay</span>
                    </button>
                </div>
            </div>

            <!-- CARD PAYMENT FIELDS SECTION -->
            <div id="cardFieldsSection" class="space-y-5">
                <!-- Name on Card -->
                <div>
                    <label for="card_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Cardholder Name</label>
                    <div class="premium-input-group flex shadow-sm rounded-xl overflow-hidden border border-slate-200 bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-600 transition-all">
                        <span class="px-4 bg-slate-50 border-r border-slate-200 flex items-center text-slate-400 text-sm"><i class="fas fa-user"></i></span>
                        <input type="text" class="flex-grow px-4 py-3 text-sm bg-white focus:outline-none text-slate-800 font-medium" id="card_name" name="card_name" value="<?php echo sanitize($_SESSION['username']); ?>" placeholder="Full name on card">
                    </div>
                </div>

                <!-- Card Number -->
                <div>
                    <label for="card_number" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Card Number</label>
                    <div class="premium-input-group flex shadow-sm rounded-xl overflow-hidden border border-slate-200 bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-600 transition-all relative">
                        <span class="px-4 bg-slate-50 border-r border-slate-200 flex items-center text-slate-400 text-sm" id="cardBrandIcon"><i class="fas fa-credit-card"></i></span>
                        <input type="text" class="flex-grow px-4 py-3 text-sm bg-white focus:outline-none text-slate-800 font-mono tracking-wider" id="card_number" name="card_number" placeholder="4444 4444 4444 4444" maxlength="19" autocomplete="cc-number">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <!-- Expiry Date -->
                    <div>
                        <label for="card_expiry" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Expiry Date</label>
                        <div class="premium-input-group flex shadow-sm rounded-xl overflow-hidden border border-slate-200 bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-600 transition-all">
                            <span class="px-3 bg-slate-50 border-r border-slate-200 flex items-center text-slate-400 text-sm"><i class="fas fa-calendar-alt"></i></span>
                            <input type="text" class="flex-grow px-3 py-3 text-sm bg-white focus:outline-none text-slate-800 text-center font-mono" id="card_expiry" name="card_expiry" placeholder="MM/YY" maxlength="5" autocomplete="cc-exp">
                        </div>
                    </div>

                    <!-- CVV -->
                    <div>
                        <label for="card_cvv" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">CVV / CVC</label>
                        <div class="premium-input-group flex shadow-sm rounded-xl overflow-hidden border border-slate-200 bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-600 transition-all">
                            <span class="px-3 bg-slate-50 border-r border-slate-200 flex items-center text-slate-400 text-sm"><i class="fas fa-lock"></i></span>
                            <input type="password" class="flex-grow px-3 py-3 text-sm bg-white focus:outline-none text-slate-800 text-center font-mono" id="card_cvv" name="card_cvv" placeholder="123" maxlength="4" autocomplete="cc-csc">
                        </div>
                    </div>
                </div>
            </div>

            <!-- GPAY PAYMENT FIELDS SECTION (Hidden by default) -->
            <div id="gpayFieldsSection" class="space-y-5 hidden">
                <div class="p-4 rounded-2xl bg-amber-50/60 border border-amber-200/60 text-slate-700 text-xs md:text-sm font-medium flex items-start">
                    <i class="fab fa-google-pay text-2xl text-slate-900 mr-3 flex-shrink-0 mt-0.5"></i>
                    <div>
                        <strong class="text-slate-900 block font-bold mb-0.5">Google Pay / Instant UPI</strong>
                        Enter your GPay registered UPI ID (VPA) or mobile number below to approve payment via Google Pay app.
                    </div>
                </div>

                <!-- Quick GPay VPA Presets -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Quick Select GPay VPA</label>
                    <div class="flex flex-wrap gap-2">
                        <button type="button" onclick="setGPayPreset('<?php echo strtolower(sanitize($_SESSION['username'])); ?>@gpay')" class="text-xs bg-slate-100 hover:bg-primary-50 hover:text-primary-600 border border-slate-200 px-3 py-1.5 rounded-full font-semibold transition-all">
                            <?php echo strtolower(sanitize($_SESSION['username'])); ?>@gpay
                        </button>
                        <button type="button" onclick="setGPayPreset('<?php echo strtolower(sanitize($_SESSION['username'])); ?>@okaxis')" class="text-xs bg-slate-100 hover:bg-primary-50 hover:text-primary-600 border border-slate-200 px-3 py-1.5 rounded-full font-semibold transition-all">
                            <?php echo strtolower(sanitize($_SESSION['username'])); ?>@okaxis
                        </button>
                        <button type="button" onclick="setGPayPreset('9876543210@gpay')" class="text-xs bg-slate-100 hover:bg-primary-50 hover:text-primary-600 border border-slate-200 px-3 py-1.5 rounded-full font-semibold transition-all">
                            9876543210@gpay
                        </button>
                    </div>
                </div>

                <!-- GPay VPA / Phone Input -->
                <div>
                    <label for="gpay_vpa" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">GPay UPI ID or Mobile Number</label>
                    <div class="premium-input-group flex shadow-sm rounded-xl overflow-hidden border border-slate-200 bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-600 transition-all">
                        <span class="px-4 bg-slate-50 border-r border-slate-200 flex items-center text-slate-400 text-sm"><i class="fas fa-mobile-alt"></i></span>
                        <input type="text" class="flex-grow px-4 py-3 text-sm bg-white focus:outline-none text-slate-800 font-medium" id="gpay_vpa" name="gpay_vpa" placeholder="username@okaxis or 9876543210">
                    </div>
                    <small class="text-slate-400 text-xs font-medium mt-1.5 block">Format: username@okaxis, name@gpay, or 10-digit phone number</small>
                </div>
            </div>

            <!-- Submit Action -->
            <div class="pt-2">
                <button type="submit" id="btnSubmitPayment" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3.5 rounded-full shadow-md hover:scale-[1.02] transition-all text-sm flex items-center justify-center focus:outline-none">
                    <i class="fas fa-lock mr-2 text-xs"></i> Pay ₹149 & Unlock High Mode
                </button>
            </div>
        </form>
    </div>

    <div class="text-center mt-6">
        <a href="upgrade-premium.php?quiz_id=<?php echo $quiz_id; ?>" class="text-slate-400 hover:text-slate-600 text-sm font-bold transition-all inline-flex items-center">
            <i class="fas fa-arrow-left mr-2 text-xs"></i> Cancel & Return to Quiz Options
        </a>
    </div>
</div>

<script>
function selectPaymentMethod(method) {
    const cardSec = document.getElementById('cardFieldsSection');
    const gpaySec = document.getElementById('gpayFieldsSection');
    const methodInput = document.getElementById('paymentMethodInput');
    const btnCard = document.getElementById('btnMethodCard');
    const btnGPay = document.getElementById('btnMethodGPay');
    const btnSubmit = document.getElementById('btnSubmitPayment');

    const cardInputs = cardSec.querySelectorAll('input');
    const gpayInputs = gpaySec.querySelectorAll('input');

    methodInput.value = method;

    if (method === 'card') {
        cardSec.classList.remove('hidden');
        gpaySec.classList.add('hidden');

        btnCard.className = 'payment-method-btn flex items-center justify-center p-4 rounded-2xl border-2 border-primary-600 bg-primary-50/40 text-primary-600 font-bold transition-all shadow-sm focus:outline-none';
        btnGPay.className = 'payment-method-btn flex items-center justify-center p-4 rounded-2xl border border-slate-200 bg-white text-slate-600 font-bold transition-all hover:border-slate-300 focus:outline-none';

        gpayInputs.forEach(input => {
            input.classList.remove('is-invalid');
        });

        btnSubmit.innerHTML = '<i class="fas fa-credit-card mr-2 text-xs"></i> Pay ₹149 with Card';
    } else {
        cardSec.classList.add('hidden');
        gpaySec.classList.remove('hidden');

        btnGPay.className = 'payment-method-btn flex items-center justify-center p-4 rounded-2xl border-2 border-primary-600 bg-primary-50/40 text-primary-600 font-bold transition-all shadow-sm focus:outline-none';
        btnCard.className = 'payment-method-btn flex items-center justify-center p-4 rounded-2xl border border-slate-200 bg-white text-slate-600 font-bold transition-all hover:border-slate-300 focus:outline-none';

        cardInputs.forEach(input => {
            input.classList.remove('is-invalid');
        });

        btnSubmit.innerHTML = '<i class="fab fa-google-pay text-lg mr-2"></i> Pay ₹149 with Google Pay';
    }
}

function setGPayPreset(vpa) {
    const gpayInput = document.getElementById('gpay_vpa');
    gpayInput.value = vpa;
    if (typeof validateInput === 'function') {
        validateInput(gpayInput);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    // 1. Auto-format Card Number with spaces every 4 digits & detect brand
    const cardNumInput = document.getElementById('card_number');
    const brandIcon = document.getElementById('cardBrandIcon');

    if (cardNumInput) {
        cardNumInput.addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, ''); // digits only
            if (value.length > 16) value = value.slice(0, 16);

            // Format into 4-digit blocks
            const blocks = value.match(/.{1,4}/g);
            e.target.value = blocks ? blocks.join(' ') : value;

            // Brand detection icon
            if (value.startsWith('4')) {
                brandIcon.innerHTML = '<i class="fab fa-cc-visa text-blue-600 text-lg"></i>';
            } else if (/^(5[1-5]|2[2-7])/.test(value)) {
                brandIcon.innerHTML = '<i class="fab fa-cc-mastercard text-amber-600 text-lg"></i>';
            } else if (/^3[47]/.test(value)) {
                brandIcon.innerHTML = '<i class="fab fa-cc-amex text-sky-600 text-lg"></i>';
            } else if (/^6(?:011|5)/.test(value)) {
                brandIcon.innerHTML = '<i class="fab fa-cc-discover text-orange-600 text-lg"></i>';
            } else {
                brandIcon.innerHTML = '<i class="fas fa-credit-card"></i>';
            }
        });
    }

    // 2. Auto-format Expiry Date MM/YY
    const cardExpiryInput = document.getElementById('card_expiry');
    if (cardExpiryInput) {
        cardExpiryInput.addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 4) value = value.slice(0, 4);

            if (value.length >= 3) {
                e.target.value = value.slice(0, 2) + '/' + value.slice(2);
            } else {
                e.target.value = value;
            }
        });
    }

    // 3. Numeric only CVV
    const cardCvvInput = document.getElementById('card_cvv');
    if (cardCvvInput) {
        cardCvvInput.addEventListener('input', function (e) {
            e.target.value = e.target.value.replace(/\D/g, '').slice(0, 4);
        });
    }
});
</script>

<?php include_once '../includes/footer.php'; ?>
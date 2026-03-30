<?php
// Database Connection
require_once __DIR__ . '/includes/config.php';

$message = "";
$show_approval_popup = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $conn->real_escape_string($_POST['username']);
    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'] ?? '';

    if (strlen($pass) < 8) {
        $message = "<div class='bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl mb-6 text-sm'>Password must be at least 8 characters.</div>";
    } elseif ($pass !== $confirm_pass) {
        $message = "<div class='bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl mb-6 text-sm'>Passwords do not match. Please try again.</div>";
    } else {
        // Hash the password for security
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

        // Check if table exists, create if not
        $conn->query("CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL
        )");

        $sql = "INSERT INTO users (username, password) VALUES ('$user', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            $message = "<div class='bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl mb-6 text-sm'>Admin account '$user' created! <a href='login.php' class='underline font-bold'>Login here</a></div>";
            $show_approval_popup = true;
        } else {
            $message = "<div class='bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl mb-6 text-sm'>Error: " . $conn->error . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin - UPHSD</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .gradient-bg {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #0f766e 100%);
            animation: gradientShift 10s ease infinite;
            background-size: 200% 200%;
        }
        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        .register-card {
            animation: fadeInUp 0.6s ease-out;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }
        .shape {
            position: absolute;
            opacity: 0.1;
            animation: float 20s infinite ease-in-out;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(180deg); }
        }
        .input-field {
            transition: all 0.3s ease;
        }
        .input-field:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
        }
        .btn-register {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            transition: all 0.3s ease;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(139, 92, 246, 0.4);
        }
        .btn-register:disabled {
            background: #9ca3af;
            cursor: not-allowed;
            box-shadow: none;
            transform: none;
        }
        .btn-register:disabled:hover {
            box-shadow: none;
            transform: none;
        }
        .toggle-password-btn {
            color: #6b7280;
            transition: color 0.2s ease;
        }
        .toggle-password-btn:hover {
            color: #374151;
        }
        @media (max-width: 640px) {
            .floating-shapes {
                opacity: 0.45;
            }
            .shape {
                transform: scale(0.72);
                transform-origin: center;
            }
            .register-card {
                border-radius: 1.25rem;
            }
        }
    </style>
</head>
<body class="gradient-bg min-h-screen sm:min-h-[100dvh] flex items-start sm:items-center justify-center p-3 sm:p-4 relative overflow-x-hidden overflow-y-auto">
    <div class="floating-shapes">
        <div class="shape bg-white rounded-full w-96 h-96 absolute top-10 left-10"></div>
        <div class="shape bg-white rounded-full w-64 h-64 absolute bottom-10 right-20" style="animation-delay: -7s;"></div>
        <div class="shape bg-white rounded-full w-80 h-80 absolute top-1/3 right-10" style="animation-delay: -3s;"></div>
        <div class="shape bg-white rounded-full w-48 h-48 absolute bottom-1/4 left-1/3" style="animation-delay: -10s;"></div>
    </div>

    <div class="register-card bg-white p-5 sm:p-8 md:p-12 rounded-3xl shadow-2xl w-full max-w-md relative z-10 my-4 sm:my-6">
        <div class="text-center mb-6 sm:mb-8">
            <div class="w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-5 sm:mb-6 shadow-lg">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
            </div>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-3">Register</h2>
            <p class="text-xs sm:text-sm text-gray-600 font-medium">College of Computer Studies - UPHSD Molino</p>
        </div>
        
        <?php echo $message; ?>

        <form method="POST" id="registerForm" class="space-y-5 sm:space-y-6">
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-2 uppercase tracking-wide">Name</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V4H2v16h5m10 0v-2a4 4 0 00-8 0v2m8 0H9m8-10a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <input type="text" name="full_name" placeholder="Juan Dela Cruz" required class="input-field w-full pl-12 pr-4 py-3.5 sm:py-4 border-2 border-gray-200 rounded-xl focus:outline-none bg-gray-50 text-gray-700 font-medium">
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-2 uppercase tracking-wide">Username</label>
                <p class="text-xs text-gray-400 mb-3">Choose your admin username</p>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <input type="text" name="username" placeholder="juan.delacruz" required class="input-field w-full pl-12 pr-4 py-3.5 sm:py-4 border-2 border-gray-200 rounded-xl focus:outline-none bg-gray-50 text-gray-700 font-medium">
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-3 uppercase tracking-wide">Password</label>
                <p class="text-xs text-gray-400 mb-3">Use at least 8 characters</p>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <input type="password" id="password" name="password" required class="input-field w-full pl-12 pr-12 py-3.5 sm:py-4 border-2 border-gray-200 rounded-xl focus:outline-none bg-gray-50 text-gray-700 font-medium">
                    <button type="button" class="toggle-password-btn absolute inset-y-0 right-0 pr-4 flex items-center" data-target="password" aria-label="Show password">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
                <p id="password-inline-error" class="mt-2 text-xs text-red-600 hidden" aria-live="polite"></p>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-3 uppercase tracking-wide">Confirm Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <input type="password" id="confirm_password" name="confirm_password" required class="input-field w-full pl-12 pr-12 py-3.5 sm:py-4 border-2 border-gray-200 rounded-xl focus:outline-none bg-gray-50 text-gray-700 font-medium">
                    <button type="button" class="toggle-password-btn absolute inset-y-0 right-0 pr-4 flex items-center" data-target="confirm_password" aria-label="Show confirm password">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
                <p id="confirm-password-inline-error" class="mt-2 text-xs text-red-600 hidden" aria-live="polite"></p>
            </div>
            <button type="submit" id="createAccountBtn" disabled class="btn-register w-full text-white font-bold py-3.5 sm:py-4 rounded-xl shadow-lg text-sm sm:text-base uppercase tracking-wider flex items-center justify-center gap-2">
                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Create Account
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="login.php" class="text-xs sm:text-sm text-indigo-600 font-semibold hover:text-indigo-700 underline">Already have an account? Sign In</a>
        </div>
    </div>

    <script>
        const registerForm = document.getElementById('registerForm');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirm_password');
        const passwordInlineError = document.getElementById('password-inline-error');
        const confirmInlineError = document.getElementById('confirm-password-inline-error');
        const createAccountBtn = document.getElementById('createAccountBtn');
        const requiredInputs = registerForm ? Array.from(registerForm.querySelectorAll('input[required]')) : [];

        function setInlineError(element, message) {
            if (!element) return;
            if (message) {
                element.textContent = message;
                element.classList.remove('hidden');
            } else {
                element.textContent = '';
                element.classList.add('hidden');
            }
        }

        function validatePasswordSection() {
            if (!passwordInput || !confirmPasswordInput) return true;

            let isValid = true;
            const passwordValue = passwordInput.value;
            const confirmValue = confirmPasswordInput.value;

            if (passwordValue.length > 0 && passwordValue.length < 8) {
                passwordInput.setCustomValidity('Password must be at least 8 characters.');
                setInlineError(passwordInlineError, 'Password must be at least 8 characters.');
                isValid = false;
            } else {
                passwordInput.setCustomValidity('');
                setInlineError(passwordInlineError, '');
            }

            if (confirmValue.length > 0 && passwordValue !== confirmValue) {
                confirmPasswordInput.setCustomValidity('Passwords do not match.');
                setInlineError(confirmInlineError, 'Passwords do not match.');
                isValid = false;
            } else {
                confirmPasswordInput.setCustomValidity('');
                setInlineError(confirmInlineError, '');
            }

            return isValid;
        }

        function hasMissingRequiredFields() {
            return requiredInputs.some(input => {
                if (input.type === 'password') {
                    return input.value.length === 0;
                }
                return input.value.trim() === '';
            });
        }

        function updateSubmitButtonState() {
            const passwordValid = validatePasswordSection();
            const hasMissing = hasMissingRequiredFields();
            const canSubmit = !hasMissing && passwordValid;

            if (createAccountBtn) {
                createAccountBtn.disabled = !canSubmit;
                createAccountBtn.setAttribute('aria-disabled', canSubmit ? 'false' : 'true');
            }

            return canSubmit;
        }

        [passwordInput, confirmPasswordInput].forEach(input => {
            if (!input) return;
            input.addEventListener('input', updateSubmitButtonState);
            input.addEventListener('blur', updateSubmitButtonState);
        });

        requiredInputs.forEach(input => {
            input.addEventListener('input', updateSubmitButtonState);
            input.addEventListener('blur', updateSubmitButtonState);
        });

        if (registerForm) {
            registerForm.addEventListener('submit', function (e) {
                if (!updateSubmitButtonState()) {
                    e.preventDefault();
                }
            });
        }

        updateSubmitButtonState();

        document.querySelectorAll('.toggle-password-btn').forEach(button => {
            button.addEventListener('click', function () {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);
                if (!input) return;

                const isPassword = input.type === 'password';
                input.type = isPassword ? 'text' : 'password';
                this.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
            });
        });
    </script>
    <?php if ($show_approval_popup): ?>
        <script>
            window.addEventListener('DOMContentLoaded', function () {
                alert("Please wait for Admin's Approval of Account Creation");
            });
        </script>
    <?php endif; ?>
</body>
</html>
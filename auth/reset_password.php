<?php
session_start();
include('../configs/database.php');

$message = '';
$error = '';

// Check if token is provided
if (!isset($_GET['token'])) {
    $error = "Invalid reset link!";
    header("Location: login.php");
    exit;
}

$token = $_GET['token'];

// Verify token exists and is not expired
$query = "SELECT * FROM password_resets WHERE token = ? AND expires_at > NOW()";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $error = "Invalid or expired reset token!";
}

// Handle password reset
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !$error) {
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($new_password) || empty($confirm_password)) {
        $error = "All fields are required!";
    } elseif ($new_password !== $confirm_password) {
        $error = "Passwords do not match!";
    } elseif (strlen($new_password) < 8) {
        $error = "Password must be at least 8 characters long!";
    } else {
        // Get user from password resets table
        $reset_row = $result->fetch_assoc();
        $user_id = $reset_row['user_id'];

        // Hash new password
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        // Update user password
        $update_query = "UPDATE users SET password = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("si", $hashed_password, $user_id);

        if ($update_stmt->execute()) {
            // Delete used reset token
            $delete_query = "DELETE FROM password_resets WHERE token = ?";
            $delete_stmt = $conn->prepare($delete_query);
            $delete_stmt->bind_param("s", $token);
            $delete_stmt->execute();

            $message = "✅ Password reset successfully! Redirecting to login...";
            header("Refresh: 2; url=login.php");
        } else {
            $error = "Error updating password. Please try again!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - CyberGuard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-black text-white min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-lg mb-4">
                <i class="fas fa-key text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-white">Reset Password</h1>
            <p class="text-gray-400 mt-2">Create a new secure password</p>
        </div>

        <!-- Alert Messages -->
        <?php if (!empty($message)): ?>
            <div class="bg-green-900 border border-green-600 text-green-200 px-4 py-3 rounded-lg mb-6 flex items-center gap-3">
                <i class="fas fa-check-circle"></i>
                <span><?php echo htmlspecialchars($message); ?></span>
            </div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="bg-red-900 border border-red-600 text-red-200 px-4 py-3 rounded-lg mb-6 flex items-center gap-3">
                <i class="fas fa-exclamation-circle"></i>
                <span><?php echo htmlspecialchars($error); ?></span>
            </div>
        <?php else: ?>
            <!-- Reset Form -->
            <form method="POST" action="" class="bg-gray-900 border border-gray-800 rounded-lg p-8 shadow-2xl">
                <div class="mb-6">
                    <label for="new_password" class="block text-gray-300 font-semibold mb-2 text-sm">
                        <i class="fas fa-lock mr-2 text-cyan-500"></i>New Password
                    </label>
                    <input 
                        type="password" 
                        id="new_password" 
                        name="new_password" 
                        placeholder="Enter new password"
                        required
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-white rounded-lg focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/30 transition"
                    >
                    <p class="text-xs text-gray-500 mt-2">
                        <i class="fas fa-info-circle mr-1"></i>Minimum 8 characters
                    </p>
                </div>

                <div class="mb-6">
                    <label for="confirm_password" class="block text-gray-300 font-semibold mb-2 text-sm">
                        <i class="fas fa-lock mr-2 text-cyan-500"></i>Confirm Password
                    </label>
                    <input 
                        type="password" 
                        id="confirm_password" 
                        name="confirm_password" 
                        placeholder="Confirm password"
                        required
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-white rounded-lg focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/30 transition"
                    >
                </div>

                <!-- Password Strength Indicator -->
                <div class="mb-6 p-3 bg-gray-800 rounded-lg border border-gray-700">
                    <p class="text-xs text-gray-400 mb-2">Password Strength:</p>
                    <div class="flex gap-2">
                        <div id="strength-1" class="h-1 flex-1 bg-gray-700 rounded"></div>
                        <div id="strength-2" class="h-1 flex-1 bg-gray-700 rounded"></div>
                        <div id="strength-3" class="h-1 flex-1 bg-gray-700 rounded"></div>
                        <div id="strength-4" class="h-1 flex-1 bg-gray-700 rounded"></div>
                    </div>
                    <p id="strength-text" class="text-xs text-gray-500 mt-2">Weak</p>
                </div>

                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-500 hover:to-blue-500 text-white font-bold py-3 rounded-lg transition transform hover:scale-105 flex items-center justify-center gap-2"
                >
                    <i class="fas fa-check-circle"></i> Reset Password
                </button>

                <p class="text-center text-sm text-gray-400 mt-4">
                    Remember your password? 
                    <a href="login.php" class="text-cyan-500 hover:text-cyan-400 font-semibold">Back to Login</a>
                </p>
            </form>
        <?php endif; ?>

        <!-- Security Info -->
        <div class="bg-gray-900 border border-gray-800 rounded-lg p-4 mt-6 text-xs text-gray-400">
            <p class="flex items-center gap-2 mb-2">
                <i class="fas fa-shield-alt text-cyan-500"></i>
                <strong>Security Tips:</strong>
            </p>
            <ul class="space-y-1 ml-6">
                <li>✓ Use a unique password</li>
                <li>✓ Mix letters, numbers & symbols</li>
                <li>✓ Avoid personal information</li>
                <li>✓ Don't share your password</li>
            </ul>
        </div>
    </div>

    <!-- Password Strength Script -->
    <script>
        const passwordInput = document.getElementById('new_password');
        const strengthBars = [
            document.getElementById('strength-1'),
            document.getElementById('strength-2'),
            document.getElementById('strength-3'),
            document.getElementById('strength-4')
        ];
        const strengthText = document.getElementById('strength-text');

        function checkStrength(password) {
            let strength = 0;
            if (password.length >= 8) strength++;
            if (password.length >= 12) strength++;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password) && /[^a-zA-Z0-9]/.test(password)) strength++;

            // Update bars
            strengthBars.forEach((bar, index) => {
                if (index < strength) {
                    if (strength === 1) {
                        bar.classList.add('bg-red-500');
                    } else if (strength === 2) {
                        bar.classList.add('bg-yellow-500');
                    } else if (strength === 3) {
                        bar.classList.add('bg-blue-500');
                    } else {
                        bar.classList.add('bg-green-500');
                    }
                } else {
                    bar.className = 'h-1 flex-1 bg-gray-700 rounded';
                }
            });

            // Update text
            const texts = ['Weak', 'Fair', 'Good', 'Strong', 'Very Strong'];
            strengthText.textContent = texts[strength] || 'Weak';
            strengthText.className = strength === 0 ? 'text-xs text-red-500 mt-2' : 
                                    strength === 1 ? 'text-xs text-yellow-500 mt-2' :
                                    strength === 2 ? 'text-xs text-blue-500 mt-2' :
                                    strength === 3 ? 'text-xs text-green-500 mt-2' :
                                    'text-xs text-green-400 mt-2';
        }

        passwordInput?.addEventListener('input', (e) => checkStrength(e.target.value));
    </script>
</body>
</html>

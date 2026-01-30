<?php
session_start();
include('../configs/database.php');
// CREATE TABLE password_resets (
//     id INT PRIMARY KEY AUTO_INCREMENT,
//     user_id INT NOT NULL,
//     token VARCHAR(255) UNIQUE,
//     expires_at DATETIME,
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// );
$message = '';
$error = '';

// Handle forgot password request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email'] ?? '');

    if (empty($email)) {
        $error = "Email is required!";
    } else {
        // Check if user exists
        $query = "SELECT id FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $user_id = $user['id'];

            // Generate unique token
            $token = bin2hex(random_bytes(32));
            $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));

            // Delete old tokens for this user
            $delete_query = "DELETE FROM password_resets WHERE user_id = ?";
            $delete_stmt = $conn->prepare($delete_query);
            $delete_stmt->bind_param("i", $user_id);
            $delete_stmt->execute();

            // Insert new reset token
            $insert_query = "INSERT INTO password_resets (user_id, token, expires_at) VALUES (?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_query);
            $insert_stmt->bind_param("iss", $user_id, $token, $expires_at);

            if ($insert_stmt->execute()) {
                // Generate reset link
                $reset_link = "http://" . $_SERVER['HTTP_HOST'] . "/cyberpro/auth/reset_password.php?token=" . $token;
                
                // Redirect to reset password page with token
                header("Location: reset_password.php?token=" . $token);
                exit;
            } else {
                $error = "Error generating reset token. Please try again!";
            }
        } else {
            // Don't reveal if email exists (security best practice)
            $message = " If an account with this email exists, you'll receive a reset link shortly.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - CyberGuard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-black text-white min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-lg mb-4">
                <i class="fas fa-question-circle text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-white">Forgot Password?</h1>
            <p class="text-gray-400 mt-2">No worries! We'll help you reset it.</p>
        </div>

        <!-- Alert Messages -->
        <?php if (!empty($message)): ?>
            <div class="bg-red-900 border border-green-600 text-green-200 px-4 py-4 rounded-lg mb-6 flex items-start gap-3">
                <i class="fas fa-check-circle flex-shrink-0 mt-0.5"></i>
                <div>
                    <p class="font-semibold mb-2">Error!</p>
                    <p class="text-sm whitespace-pre-wrap"><?php echo htmlspecialchars($message); ?></p>
                    <?php if (isset($_SESSION['reset_link'])): ?>
                        <div class="mt-3 flex gap-2">
                            <!-- <input type="text" id="resetLink" value="<?php echo htmlspecialchars($_SESSION['reset_link']); ?>" readonly class="flex-1 bg-green-950 border border-green-700 px-3 py-2 rounded text-xs text-green-200">
                            <button onclick="copyToClipboard()" class="bg-green-600 hover:bg-green-500 px-3 py-2 rounded text-xs font-bold">Copy</button> -->
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="bg-red-900 border border-red-600 text-red-200 px-4 py-3 rounded-lg mb-6 flex items-center gap-3">
                <i class="fas fa-exclamation-circle"></i>
                <span>
               
                    <?php echo htmlspecialchars($error); ?>
                </span>
            </div>
        <?php endif; ?>

        <!-- Forgot Password Form -->
        <form method="POST" action="" class="bg-gray-900 border border-gray-800 rounded-lg p-8 shadow-2xl">
            <div class="mb-6">
                <label for="email" class="block text-gray-300 font-semibold mb-2 text-sm">
                    <i class="fas fa-envelope mr-2 text-cyan-500"></i>Email Address
                </label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="Enter your registered email"
                    required
                    class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-white rounded-lg focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/30 transition"
                >
                <p class="text-xs text-gray-500 mt-2">
                    <i class="fas fa-info-circle mr-1"></i>Enter the email associated with your account
                </p>
            </div>

            <button 
                type="submit" 
                class="w-full bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-500 hover:to-blue-500 text-white font-bold py-3 rounded-lg transition transform hover:scale-105 flex items-center justify-center gap-2"
            >
                <i class="fas fa-send"></i> Send Reset Link
            </button>

            <p class="text-center text-sm text-gray-400 mt-4">
                Remember your password? 
                <a href="login.php" class="text-cyan-500 hover:text-cyan-400 font-semibold">Back to Login</a>
            </p>
        </form>

        <!-- Security Info -->
        <div class="bg-gray-900 border border-gray-800 rounded-lg p-4 mt-6 text-xs text-gray-400">
            <p class="flex items-center gap-2 mb-2">
                <i class="fas fa-shield-alt text-cyan-500"></i>
                <strong>What happens next:</strong>
            </p>
            <ul class="space-y-1 ml-6">
                <li>✓ We'll verify your email</li>
                <li>✓ Send you a reset link</li>
                <li>✓ Link expires in 1 hour</li>
                <li>✓ Create a new secure password</li>
            </ul>
        </div>
    </div>

    <!-- Copy to Clipboard Script -->
    <script>
        function copyToClipboard() {
            const link = document.getElementById('resetLink');
            link.select();
            document.execCommand('copy');
            alert('Reset link copied to clipboard!');
        }
    </script>
</body>
</html>

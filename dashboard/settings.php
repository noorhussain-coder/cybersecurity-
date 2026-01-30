<?php
session_start();
include('../configs/database.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$message = '';
$error = '';

// Fetch current user data
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $full_name = $_POST['full_name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $profile_image = $user['profile_image'] ?? ''; // Keep existing image
    
    // Handle image upload
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../uploads/profile/';
        
        // Create directory if not exists
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        
        $file_tmp = $_FILES['profile_image']['tmp_name'];
        $file_name = basename($_FILES['profile_image']['name']);
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        // Allowed extensions
        $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];
        
        if (in_array($file_ext, $allowed_exts)) {
            // Generate unique filename
            $new_filename = 'profile_' . $user_id . '_' . time() . '.' . $file_ext;
            $upload_path = $upload_dir . $new_filename;
            
            if (move_uploaded_file($file_tmp, $upload_path)) {
                // Delete old image if exists
                if ($profile_image && file_exists('../' . $profile_image)) {
                    unlink('../' . $profile_image);
                }
                $profile_image = 'uploads/profile/' . $new_filename;
            } else {
                $error = "Error uploading image!";
            }
        } else {
            $error = "Only JPG, PNG, and GIF files are allowed!";
        }
    }
    
    if (empty($username) || empty($email)) {
        $error = "Username and Email are required!";
    } elseif (empty($error)) {
        // Update user profile
        $update_query = "UPDATE users SET username = ?, email = ?, full_name = ?, phone = ?, profile_image = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("sssssi", $username, $email, $full_name, $phone, $profile_image, $user_id);
        
        if ($update_stmt->execute()) {
            $message = "Profile updated successfully!";
            // Refresh user data
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
        } else {
            $error = "Error updating profile: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black min-h-screen flex items-center justify-center p-5">
    <div class="bg-gray-900 rounded-lg shadow-2xl max-w-2xl w-full p-10 border border-gray-800">
        <h1 class="text-3xl font-bold text-center text-white mb-2">🔧 Profile Settings</h1>
        <p class="text-center text-gray-400 mb-8 text-sm">Edit your profile information</p>
        
        <?php if (!empty($message)): ?>
            <div class="bg-green-900 border border-green-600 text-green-200 px-4 py-3 rounded-lg mb-6">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($error)): ?>
            <div class="bg-red-900 border border-red-600 text-red-200 px-4 py-3 rounded-lg mb-6">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="mb-7 text-center">
                <div class="w-24 h-24 mx-auto mb-4 rounded-full overflow-hidden border-4 border-cyan-500/30 bg-gray-800 flex items-center justify-center">
                    <?php if (!empty($user['profile_image']) && file_exists('../' . $user['profile_image'])): ?>
                        <img src="../<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile" class="w-full h-full object-cover">
                    <?php else: ?>
                        <i class="fas fa-user text-4xl text-gray-600"></i>
                    <?php endif; ?>
                </div>
                <label for="profile_image" class="block text-gray-300 font-semibold text-sm mb-2">Profile Image</label>
                <input type="file" id="profile_image" name="profile_image" accept="image/*" 
                    class="w-full px-4 py-2 bg-gray-800 border border-gray-700 text-gray-400 rounded-lg cursor-pointer focus:border-cyan-500">
                <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF (Max 5MB)</p>
            </div>
            
            <div class="mb-5">
                <label for="username" class="block text-gray-300 font-semibold text-sm mb-2">Username</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username'] ?? ''); ?>" required 
                    class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-white rounded-lg focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/30 transition">
            </div>
            
            <div class="mb-5">
                <label for="email" class="block text-gray-300 font-semibold text-sm mb-2">Email Address</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required 
                    class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-white rounded-lg focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/30 transition">
            </div>
            
            <div class="mb-5">
                <label for="full_name" class="block text-gray-300 font-semibold text-sm mb-2">Full Name</label>
                <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($user['full_name'] ?? ''); ?>" 
                    class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-white rounded-lg focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/30 transition">
            </div>
            
            <div class="mb-7">
                <label for="phone" class="block text-gray-300 font-semibold text-sm mb-2">Phone Number</label>
                <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>" 
                    class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-white rounded-lg focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/30 transition">
            </div>
            
            <div class="flex gap-3 mt-8">
                <button type="submit" class="flex-1 py-3 bg-gradient-to-r from-cyan-600 to-blue-600 text-white font-bold rounded-lg hover:shadow-lg hover:shadow-cyan-500/50 transition transform hover:-translate-y-0.5">
                    💾 Save Changes
                </button>
                <button type="button" onclick="history.back()" class="flex-1 py-3 bg-gray-700 hover:bg-gray-600 text-white font-bold rounded-lg transition">
                    Cancel
                </button>
            </div>
        </form>
        
        <div class="bg-gray-800 border border-gray-700 p-4 rounded-lg mt-8">
            <p class="text-gray-300 mb-2"><span class="text-cyan-400 font-bold">Account ID:</span> #<?php echo $user_id; ?></p>
            <p class="text-gray-300"><span class="text-cyan-400 font-bold">Member Since:</span> <?php echo isset($user['created_at']) ? date('M d, Y', strtotime($user['created_at'])) : 'N/A'; ?></p>
        </div>
    </div>
</body>
</html>

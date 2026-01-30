<?php
$allowed_roles=['admin'];
include('../configs/auth.php');
include('../configs/database.php');


// Fetch all users
$sql = "SELECT * FROM users ORDER BY id DESC";
$result = $conn->query($sql);

$users = ($result && $result->num_rows > 0)
         ? $result->fetch_all(MYSQLI_ASSOC)
         : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Users</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white min-h-screen p-6">
<div class="max-w-6xl mx-auto">
     
    <h2 class="text-4xl font-bold text-center mb-8">👥 All Users</h2>

    <div class="bg-gray-900 rounded-lg border border-gray-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-800 border-b border-gray-700">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold text-gray-300">#</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-300">Full Name</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-300">Email</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-300">Role</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-300">Created At</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-300">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-700">
                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-400">No users found.</td>
                    </tr>

                <?php else: ?>
                    <?php foreach ($users as $index => $user): ?>
                        <tr class="hover:bg-gray-800 transition">
                            <td class="px-6 py-4 text-gray-300 font-medium"><?= $index + 1 ?></td>
                            <td class="px-6 py-4 text-gray-300"><?= htmlspecialchars($user['username']) ?></td>
                            <td class="px-6 py-4 text-gray-300"><?= htmlspecialchars($user['email']) ?></td>
                            <td class="px-6 py-4">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold <?= $user['role'] == 'admin' ? 'bg-blue-900 text-blue-200' : 'bg-gray-700 text-gray-300' ?>">
                                    <?= ucfirst($user['role']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-400 text-sm"><?= date('M d, Y', strtotime($user['created_at'])) ?></td>
                            <td class="px-6 py-4">
                                <a href="update_role.php?id=<?= $user['id'] ?>" class="inline-block bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                                    ✏️ Edit Role
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>

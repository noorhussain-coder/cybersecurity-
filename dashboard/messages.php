<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('../configs/database.php');

// Check if user is admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

$update_status = '';

// Handle status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $message_id = intval($_POST['id']);
    $new_status = trim($_POST['status']);
    
    if (in_array($new_status, ['new', 'read', 'replied'])) {
        $stmt = $conn->prepare("UPDATE contact_messages SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $new_status, $message_id);
        if ($stmt->execute()) {
            $update_status = "Status updated successfully!";
        }
        $stmt->close();
    }
}

// Get all messages
$query = "SELECT * FROM contact_messages ORDER BY created_at DESC";
$result = $conn->query($query);
$messages = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

// Count by status
$status_counts = [];
foreach ($messages as $msg) {
    $status = $msg['status'];
    $status_counts[$status] = ($status_counts[$status] ?? 0) + 1;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Messages | CyberGuard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #05070a; color: white; }
        .glass-card { background: rgba(13, 17, 23, 0.7); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .status-badge { padding: 4px 12px; border-radius: 6px; font-size: 11px; font-weight: bold; }
        .status-new { background: #0f766e; color: #67e8f9; }
        .status-read { background: #1e40af; color: #93c5fd; }
        .status-replied { background: #15803d; color: #86efac; }
        .message-row:hover { background: rgba(6, 182, 212, 0.05); }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 10px; }
    </style>
</head>
<body>

<div class="min-h-screen p-6">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-black uppercase italic tracking-tighter mb-2">
                Contact <span class="text-cyan-500">Messages</span>
            </h1>
            <p class="text-gray-400 text-sm">Manage incoming messages from users</p>
        </div>

        <?php if ($update_status): ?>
            <div class="mb-6 p-4 bg-green-500/10 border border-green-500/30 rounded-xl">
                <p class="text-green-400 flex items-center gap-2"><i class="fas fa-check-circle"></i> <?php echo $update_status; ?></p>
            </div>
        <?php endif; ?>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="glass-card p-6 rounded-2xl border-l-4 border-l-cyan-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider">Total Messages</p>
                        <p class="text-3xl font-black text-cyan-500"><?php echo count($messages); ?></p>
                    </div>
                    <i class="fas fa-envelope text-cyan-500 text-3xl opacity-20"></i>
                </div>
            </div>

            <div class="glass-card p-6 rounded-2xl border-l-4 border-l-yellow-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider">New</p>
                        <p class="text-3xl font-black text-yellow-500"><?php echo $status_counts['new'] ?? 0; ?></p>
                    </div>
                    <i class="fas fa-star text-yellow-500 text-3xl opacity-20"></i>
                </div>
            </div>

            <div class="glass-card p-6 rounded-2xl border-l-4 border-l-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider">Read</p>
                        <p class="text-3xl font-black text-blue-500"><?php echo $status_counts['read'] ?? 0; ?></p>
                    </div>
                    <i class="fas fa-book text-blue-500 text-3xl opacity-20"></i>
                </div>
            </div>

            <div class="glass-card p-6 rounded-2xl border-l-4 border-l-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider">Replied</p>
                        <p class="text-3xl font-black text-green-500"><?php echo $status_counts['replied'] ?? 0; ?></p>
                    </div>
                    <i class="fas fa-check text-green-500 text-3xl opacity-20"></i>
                </div>
            </div>
        </div>

        <!-- Messages Table -->
        <div class="glass-card rounded-2xl overflow-hidden border">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-white/5 bg-black/30">
                            <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-gray-400">From</th>
                            <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-gray-400">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-gray-400">Subject</th>
                            <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-gray-400">Message</th>
                            <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-gray-400">Date</th>
                            <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-gray-400">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-black uppercase tracking-wider text-gray-400">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($messages) > 0): ?>
                            <?php foreach ($messages as $msg): ?>
                                <tr class="message-row border-b border-white/5 transition-all cursor-pointer">
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-bold text-white"><?php echo htmlspecialchars($msg['name']); ?></p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-xs text-gray-400 break-all"><?php echo htmlspecialchars($msg['email']); ?></p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm text-cyan-400 font-semibold"><?php echo htmlspecialchars($msg['subject']); ?></p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-xs text-gray-300 max-w-xs truncate"><?php echo htmlspecialchars($msg['message']); ?></p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-xs text-gray-500"><?php echo date('M d, Y H:i', strtotime($msg['created_at'])); ?></p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="status-badge status-<?php echo $msg['status']; ?>">
                                            <?php echo strtoupper($msg['status']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <form method="POST" class="inline">
                                            <input type="hidden" name="id" value="<?php echo $msg['id']; ?>">
                                            <input type="hidden" name="action" value="update">
                                            
                                            <?php if ($msg['status'] !== 'read'): ?>
                                                <button type="submit" name="status" value="read" class="text-blue-400 hover:text-blue-300 text-xs" title="Mark as Read">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            <?php endif; ?>
                                            
                                            <?php if ($msg['status'] !== 'replied'): ?>
                                                <button type="submit" name="status" value="replied" class="text-green-400 hover:text-green-300 text-xs ml-3" title="Mark as Replied">
                                                    <i class="fas fa-reply"></i>
                                                </button>
                                            <?php endif; ?>
                                            
                                            <button type="button" onclick="viewMessage(<?php echo htmlspecialchars(json_encode($msg)); ?>)" class="text-cyan-400 hover:text-cyan-300 text-xs ml-3" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <i class="fas fa-inbox text-gray-500 text-3xl opacity-50"></i>
                                        <p class="text-gray-500">No messages yet</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<!-- Message Modal -->
<div id="messageModal" class="hidden fixed inset-0 bg-black/80 flex items-center justify-center z-50 p-4">
    <div class="glass-card rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto p-8 relative">
        <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-white">
            <i class="fas fa-times text-xl"></i>
        </button>
        
        <div id="modalContent"></div>
    </div>
</div>

<script>
function viewMessage(msg) {
    const modal = document.getElementById('messageModal');
    const content = document.getElementById('modalContent');
    
    content.innerHTML = `
        <h2 class="text-2xl font-black text-cyan-500 mb-6 uppercase">Message Details</h2>
        
        <div class="space-y-4">
            <div>
                <p class="text-xs uppercase text-gray-500 tracking-wider mb-1">From</p>
                <p class="text-lg font-bold">${msg.name}</p>
            </div>
            
            <div>
                <p class="text-xs uppercase text-gray-500 tracking-wider mb-1">Email</p>
                <p class="text-sm text-cyan-400 break-all"><a href="mailto:${msg.email}">${msg.email}</a></p>
            </div>
            
            <div>
                <p class="text-xs uppercase text-gray-500 tracking-wider mb-1">Subject</p>
                <p class="text-sm font-semibold">${msg.subject}</p>
            </div>
            
            <div>
                <p class="text-xs uppercase text-gray-500 tracking-wider mb-1">Date</p>
                <p class="text-sm text-gray-400">${new Date(msg.created_at).toLocaleString()}</p>
            </div>
            
            <div>
                <p class="text-xs uppercase text-gray-500 tracking-wider mb-2">Status</p>
                <span class="inline-block status-badge status-${msg.status}">${msg.status.toUpperCase()}</span>
            </div>
            
            <hr class="border-white/10 my-4">
            
            <div>
                <p class="text-xs uppercase text-gray-500 tracking-wider mb-3">Message</p>
                <div class="bg-black/30 p-4 rounded-xl text-sm text-gray-300 whitespace-pre-wrap break-words">
                    ${msg.message}
                </div>
            </div>
        </div>
    `;
    
    modal.classList.remove('hidden');
}

function closeModal() {
    document.getElementById('messageModal').classList.add('hidden');
}

document.getElementById('messageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
</script>

</body>
</html>

<?php
 $allowed_roles=[];
include('../../configs/database.php');
include('../../configs/Session.php');

require 'vendor/autoload.php';
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Console\View\Components\Alert;

// ------------------------------
// ✅ Delete video (Cloudinary + DB)
// ------------------------------
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);

    // Get public_id
    $sql = "SELECT public_id FROM videos WHERE id = $delete_id";
    $res = $conn->query($sql);

    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $publicId = $row['public_id'];

        Configuration::instance([
            'cloud' => [
                'cloud_name' => 'dggldmj6z',
                'api_key'    => '597569858316692',
                'api_secret' => 'nzOwOOVFsPNNGqB56R8SiQbcJ2M'
            ],
            'url' => ['secure' => true]
        ]);

        try {
            (new UploadApi())->destroy($publicId, ['resource_type' => 'video']);
        } catch (Exception $e) {}
    }

    $conn->query("DELETE FROM videos WHERE id = $delete_id");
    header("Location: Edit_Video.php");
    
    exit;
}

// ------------------------------
// ✅ Fetch only videos table
// ------------------------------
$sql = "SELECT * FROM videos ORDER BY created_at DESC";
$result = $conn->query($sql);

$videos = ($result && $result->num_rows > 0)
            ? $result->fetch_all(MYSQLI_ASSOC)
            : [];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Videos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white min-h-screen p-6  py-8  ">

<div class="max-w-7xl mx-auto">

    <div class="flex justify-between items-center mb-8">
        <h2 class="text-4xl font-bold">🎬 Manage Videos</h2>
        <a href="upload2.php" class="bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white px-6 py-3 rounded-lg font-semibold transition">
            + Upload New Video
        </a>
    </div>

    <?php if (empty($videos)): ?>
        <div class="text-center py-12 bg-gray-900 rounded-lg border border-gray-800">
            <p class="text-gray-400 text-lg">No videos found. Start by uploading a new video.</p>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($videos as $index => $video): ?>
                <div class="bg-gray-900 rounded-lg border border-gray-800 overflow-hidden hover:border-cyan-500 transition duration-300">
                    <!-- Video Preview -->
                    <div class="relative bg-black aspect-video flex items-center justify-center">
                        <video width="100%" height="100%" controls class="w-full h-full object-cover">
                            <source src="<?= htmlspecialchars($video['video_url']) ?>" type="video/mp4">
                        </video>
                    </div>

                    <!-- Video Info -->
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-white mb-2">
                            <?= htmlspecialchars($video['title']) ?>
                        </h3>
                        
                        <p class="text-gray-400 text-sm mb-4 line-clamp-2">
                            <?= htmlspecialchars($video['description']) ?>
                        </p>

                        <div class="flex items-center justify-between mb-4 text-xs text-gray-500">
                            <span class="bg-gray-800 px-3 py-1 rounded-full">#<?= $index + 1 ?></span>
                            <span><?= date('M d, Y', strtotime($video['created_at'])) ?></span>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-2">
                            <a href="update_video.php?id=<?= $video['id'] ?>" 
                               class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 px-3 rounded-lg text-center font-semibold transition">
                                ✏️ Edit
                            </a>
                            <a href="Edit_Video.php?delete_id=<?= $video['id'] ?>"
                               onclick="return confirm('Are you sure you want to delete this video?');"
                               class="flex-1 bg-red-600 hover:bg-red-700 text-white py-2 px-3 rounded-lg text-center font-semibold transition">
                               🗑️ Delete
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>

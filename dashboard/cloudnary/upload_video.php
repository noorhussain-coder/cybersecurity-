<?php
 $allowed_roles=[];
require 'vendor/autoload.php';
include('../../configs/database.php');
include('../../configs/Session.php');

use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;
   
Configuration::instance([
    'cloud' => [
        'cloud_name' => 'dggldmj6z',
        'api_key'    => '597569858316692',
        'api_secret' => 'nzOwOOVFsPNNGqB56R8SiQbcJ2M'
    ],
    'url' => ['secure' => true]
]);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['video'])) {
    $title = htmlspecialchars(trim($_POST['title']));
    $file = $_FILES['video'];

    if ($file['error'] === UPLOAD_ERR_OK) {
        try {
            $upload = new UploadApi();
            $result = $upload->upload($file['tmp_name'], [
                'resource_type' => 'video',
                // 'folder' => 'awareness_videos'
                'folder' => 'videos'
            ]);

            $videoUrl = $result['secure_url'];
            $publicId = $result['public_id'];
            $description=$_POST['description'];
            $user_id=$_SESSION['user_id'];
           

if ($videoUrl) {
    $stmt = $conn->prepare("INSERT INTO videos (title, description, video_url, public_id, user_id)
                            VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $title, $description, $videoUrl, $publicId, $user_id);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Upload Successful!'); window.location='upload2.php';</script>";
    } else {
        echo " Database Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "⚠️ Something went wrong — video URL missing.";
}      
        } catch (Exception $e) {
            echo " Error: " . $e->getMessage();
        }
    }
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Upload Video</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen py-12">
 
  <div class="max-w-md mx-auto">
    <div class="bg-gray-900 border border-gray-800 rounded-lg p-8 shadow-2xl">
      <h3 class="text-3xl font-bold text-center mb-8">📤 Upload New Video</h3>
      <form action="" method="post" enctype="multipart/form-data" class="space-y-5">
        <div>
          <label class="block text-gray-300 font-semibold mb-2">Video Title</label>
          <input type="text" name="title" class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-white rounded-lg focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/30 transition" required>
        </div>
        <div>
          <label class="block text-gray-300 font-semibold mb-2">Video Description</label>
          <input type="text" name="description" class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-white rounded-lg focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/30 transition" required>
        </div>
        <div>
          <label class="block text-gray-300 font-semibold mb-2">Select Video</label>
          <input type="file" name="video" class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-white rounded-lg focus:outline-none focus:border-cyan-500 transition file:bg-cyan-600 file:text-white file:border-0 file:rounded file:px-3 file:py-1 file:mr-4 file:cursor-pointer hover:file:bg-cyan-700" accept="video/*" required>
        </div>
        <button type="submit" class="w-full bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-700 hover:to-blue-700 text-white font-bold py-3 rounded-lg transition transform hover:scale-105">
          🚀 Upload Video
        </button>
      </form>
    </div>
  </div>
</body>
</html>
<?php } ?>

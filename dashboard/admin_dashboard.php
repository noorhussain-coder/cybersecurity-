
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberGuard Academy | Intelligence Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #05070a; color: white; font-family: 'Inter', sans-serif; overflow-x: hidden; }
        .glass-panel { background: rgba(13, 17, 23, 0.7); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .aqua-glow { box-shadow: 0 0 20px rgba(6, 182, 212, 0.2); }
        .sidebar-link:hover { background: rgba(6, 182, 212, 0.1); color: #06b6d4; }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 10px; }
    </style>
    <script>
function loadPage(page) {
    document.getElementById("contentFrame").src = page;
}
</script>

</head>
<body class="flex h-screen">

    <aside class="w-64 glass-panel border-r border-white/5 hidden lg:flex flex-col p-6">
        <div class="mb-10 flex items-center gap-3">
            <div class="w-8 h-8 bg-cyan-500 rounded-lg flex items-center justify-center">
                <i class="fas fa-shield-alt text-black"></i>
            </div>
            <a href="../index.php"><span class="text-xl font-black tracking-tighter uppercase">CyberGuard</span></a>
        </div>

        <nav class="space-y-2 flex-1">
            <p class="text-[10px] uppercase tracking-[0.2em] text-gray-500 mb-4 ml-2">Main Menu</p>
            <a href="#" class="sidebar-link flex items-center gap-4 p-3 rounded-xl transition text-cyan-500 active:bg-cyan-500/10"
            onclick="loadPage('side.php')">
                <i class="fas fa-th-large w-5"></i> <span class="text-sm font-bold">Home</span>
            </a>
            <a href="#" class="sidebar-link flex items-center gap-4 p-3 rounded-xl transition text-cyan-500 active:bg-cyan-500/10" 
            onclick="loadPage('role.php')">
                <i class="fa-solid fa-user"></i> <span class="text-sm font-bold">Role</span>
            </a>
            <a href="#" class="sidebar-link flex items-center gap-4 p-3 rounded-xl transition text-gray-400 active:bg-cyan-500/10"
            onclick="loadPage('messages.php')">
                <i class="fas fa-envelope w-5"></i> <span class="text-sm font-bold">Messages</span>
            </a>
            <a href="#" class="sidebar-link flex items-center gap-4 p-3 rounded-xl transition text-gray-400 active:bg-cyan-500/10"
            onclick="loadPage('./cloudnary/upload_video.php')">
                <i class="fas fa-bolt w-5"></i> <span class="text-sm font-bold">Upload Video</span>
            </a>
       
            <a href="#" class="sidebar-link flex items-center gap-4 p-3 rounded-xl transition text-gray-400 active:bg-cyan-500/10"
            onclick="loadPage('./cloudnary/Edit_Video.php')">
                <i class="fas fa-bolt w-5"></i> <span class="text-sm font-bold">Edit Video</span>
            </a>
          
         
            <a href="#"
             onclick="loadPage('settings.php')"
            class="sidebar-link flex items-center gap-4 p-3 rounded-xl transition text-gray-400">
                <i class="fas fa-cog w-5"></i> <span class="text-sm font-bold">Settings</span>
            </a>
        </nav>

        <div class="mt-auto p-4 glass-panel rounded-2xl border border-cyan-500/20">
            <p class="text-[10px] text-cyan-400 font-bold uppercase mb-2">Pro Access</p>
            <p class="text-[11px] text-gray-500 mb-3">Unlock advanced labs and malware samples.</p>
            <button class="w-full py-2 bg-cyan-500 text-black text-[10px] font-black uppercase rounded-lg">Upgrade Now</button>
        </div>
    </aside>

    <main class="flex-1 flex flex-col overflow-hidden">
        
       <main class="flex-1 overflow-hidden">
    <iframe 
        id="contentFrame"
        src="side.php"
        class="w-full h-full border-0 bg-transparent">
    </iframe>

</body>
</html>
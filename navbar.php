
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    
                if (isset($_SESSION['user_id'])) {
                    // fetch user's profile image
                    include_once __DIR__ . '/configs/database.php';
                    $uid = intval($_SESSION['user_id']);
                    $profile_image = '';
                    $display_name = $_SESSION['username'] ?? '';
                    $stmt2 = $conn->prepare("SELECT full_name, profile_image FROM users WHERE id = ? LIMIT 1");
                    if ($stmt2) {
                        $stmt2->bind_param('i', $uid);
                        $stmt2->execute();
                        $res2 = $stmt2->get_result();
                        if ($row2 = $res2->fetch_assoc()) {
                            $profile_image = $row2['profile_image'];
                            if (!empty($row2['full_name'])) $display_name = $row2['full_name'];
                        }
                        $stmt2->close();
                    }
                    // avatar button + dropdown
                

?>
<nav class="fixed top-0 left-0 right-0 z-[9999] glass border-b border-cyan-900/30 backdrop-blur-lg bg-black/30">
    <div class="container mx-auto px-6 py-4">
        <div class="flex items-center justify-between">
           
            <a href="index.php" class="flex items-center gap-2 group">
                <div class="w-10 h-10 bg-cyan-500 rounded-lg flex items-center justify-center group-hover:shadow-[0_0_20px_rgba(0,212,255,0.6)] transition-all">
                    <i class="fas fa-user-shield text-black text-xl"></i>
                </div>
                <span class="text-2xl font-black tracking-tighter text-white uppercase">
                    Cyber<span class="text-cyan-500">Guard</span>
                </span>
            </a>
            <div class="hidden lg:flex items-center gap-6">
                <a href="index.php" class="nav-link text-xs font-black text-gray-300 hover:text-cyan-400 transition-colors tracking-widest">HOME</a>
               
                <a href="about_us.php" class="nav-link text-xs font-black text-gray-300 hover:text-cyan-400 transition-colors tracking-widest uppercase">ABOUT US</a>
                <div class="relative group">
                    <button class="flex items-center gap-1 text-xs font-black text-gray-300 group-hover:text-cyan-400 transition-all tracking-widest uppercase">
                        Awareness <i class="fas fa-chevron-down text-[10px] group-hover:rotate-180 transition-transform"></i>
                    </button>
                    <div class="absolute top-full left-0 mt-4 w-60 glass border border-cyan-900/50 rounded-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-y-2 group-hover:translate-y-0 p-2 shadow-2xl">
                        <a href="awareness.php" class="nav-link block px-4 py-3 text-[10px] font-black text-gray-300 hover:bg-cyan-500 hover:text-black rounded-lg transition-all">
                            <i class="fas fa-shield-halved text-sm mr-2"></i> Security Awareness
                        </a>
                        <a href="awareness.php#phishing" class="block px-4 py-3 text-[10px] font-black text-gray-300 hover:bg-cyan-500 hover:text-black rounded-lg transition-all">
                            <i class="fas fa-fish text-sm mr-2"></i> Phishing Defense
                        </a>
                        <a href="awareness.php#malware" class="block px-4 py-3 text-[10px] font-black text-gray-300 hover:bg-cyan-500 hover:text-black rounded-lg transition-all">
                            <i class="fas fa-virus-slash text-sm mr-2"></i> Malware Protection
                        </a>
                        <a href="awareness.php#social" class="block px-4 py-3 text-[10px] font-black text-gray-300 hover:bg-cyan-500 hover:text-black rounded-lg transition-all">
                            <i class="fas fa-users text-sm mr-2"></i> Social Engineering
                        </a>
                    </div>
                </div>
                <a href="tools.php" class="nav-link text-xs font-black text-gray-300 hover:text-cyan-400 transition-colors tracking-widest uppercase">TOOLS</a>
                <a href="videos.php" class="nav-link text-xs font-black text-gray-300 hover:text-cyan-400 transition-colors tracking-widest uppercase">VIDEOS</a>
                <a href="contact_us.php" class="nav-link text-xs font-black text-gray-300 hover:text-cyan-400 transition-colors tracking-widest uppercase">CONTACT US</a>
          <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
    <a href="./dashboard/admin_dashboard.php"
       class="nav-link text-xs font-black text-gray-300 hover:text-cyan-400 uppercase">
        DASHBOARD
    </a>
<?php endif; ?>
            </div>
            <div class="flex items-center gap-4">
              
                <a href="emergency.php" class="hidden md:block px-4 py-2 bg-red-600/10 border border-red-600/50 text-red-500 text-[10px] font-black rounded hover:bg-red-600 hover:text-white transition-all tracking-widest">
                    REPORT BREACH
                </a>
                <button id="mobile-menu-btn" class="lg:hidden text-gray-400 text-xl">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div class="list-none">
           
                    <div class="relative">
                        <button id="userMenuBtn" class="flex items-center gap-3 p-1 rounded-full hover:shadow-lg transition" aria-expanded="false" aria-haspopup="true">
                            <?php if (!empty($profile_image) && file_exists(__DIR__ . '/' . $profile_image)): ?>
                                <img src="<?php echo htmlspecialchars($profile_image); ?>" alt="avatar" class="w-10 h-10 rounded-full object-cover border-2 border-cyan-500">
                            <?php else: ?>
                                <div class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center border-2 border-cyan-500 text-gray-300">
                                    <i class="fas fa-user"></i>
                                </div>
                            <?php endif; ?>
                        </button>

                        <div id="userMenu" class="hidden absolute right-0 mt-2 w-48 bg-black/90 glass-panel border border-white/5 rounded-xl p-3 text-sm z-50">
                            <p class="text-xs text-gray-400 px-2 truncate">Signed in as</p>
                            <p class="font-bold text-white px-2 mb-2 truncate"><?php echo htmlspecialchars($display_name); ?></p>
                            <a href="auth/logout.php" class="block px-3 py-2 rounded hover:bg-cyan-500/10 text-red-400">Logout</a>
                            <a href="dashboard/settings.php" class="block px-3 py-2 rounded hover:bg-cyan-500/10 text-gray-300">Settings</a>
                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                                <a href="dashboard/admin_dashboard.php" class="block px-3 py-2 rounded hover:bg-cyan-500/10 text-gray-300">Admin</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                } else {
                    echo '<a href="./auth/login.php" class="text-xs font-black text-gray-300 hover:text-cyan-400">LOGIN</a>';
                }
                ?>
            </div>
        </div>
        <div id="mobile-menu" class="hidden lg:hidden mt-6 pb-4 space-y-4 border-t border-gray-800 pt-4">
            <a href="index.php" class="nav-link block text-gray-300 text-xs font-black hover:text-cyan-400">HOME</a>
            <a href="about_us.php" class="nav-link block text-gray-300 text-xs font-black hover:text-cyan-400">ABOUT US</a>
            <a href="awareness.php" class="nav-link block text-gray-300 text-xs font-black hover:text-cyan-400">AWARENESS</a>
            <a href="tools.php" class="nav-link block text-gray-300 text-xs font-black hover:text-cyan-400">TOOLS</a>
            <a href="videos.php" class="nav-link block text-gray-300 text-xs font-black hover:text-cyan-400">VIDEOS</a>
            <a href="contact_us.php" class="nav-link block text-gray-300 text-xs font-black hover:text-cyan-400">CONTACT US</a>
            
            <div class="border-t border-gray-700 pt-4">
                <?php
                if (isset($_SESSION['user_id'])) {
                    ?>
                    <div class="flex items-center gap-3 px-2 py-3 bg-gray-800/50 rounded-lg mb-3">
                        <?php if (!empty($profile_image) && file_exists(__DIR__ . '/' . $profile_image)): ?>
                            <img src="<?php echo htmlspecialchars($profile_image); ?>" alt="avatar" class="w-10 h-10 rounded-full object-cover border-2 border-cyan-500">
                        <?php else: ?>
                            <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center border-2 border-cyan-500 text-gray-300">
                                <i class="fas fa-user"></i>
                            </div>
                        <?php endif; ?>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-gray-400">Account</p>
                            <p class="font-bold text-white text-sm truncate"><?php echo htmlspecialchars($display_name); ?></p>
                        </div>
                    </div>
                    <a href="dashboard/settings.php" class="block px-3 py-2 text-xs font-black text-gray-300 hover:text-cyan-400 hover:bg-cyan-500/10 rounded">⚙️ Settings</a>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <a href="dashboard/admin_dashboard.php" class="block px-3 py-2 text-xs font-black text-gray-300 hover:text-cyan-400 hover:bg-cyan-500/10 rounded">📊 Admin</a>
                    <?php endif; ?>
                    <a href="auth/logout.php" class="block px-3 py-2 text-xs font-black text-red-400 hover:text-red-300 hover:bg-red-600/10 rounded">🚪 Logout</a>
                    <?php
                } else {
                    echo '<a href="./auth/login.php" class="block px-3 py-2 text-xs font-black text-cyan-400 hover:text-white">LOGIN</a>';
                }
                ?>
            </div>
        </div>
    </div>
</nav>
<!-- Active Link Styling -->
<style>
    .nav-link {
        transition: all 0.3s ease;
    }
    .nav-link.active,
    .nav-link.active:hover {
        color: #ffffff !important;
        font-weight: 900;
        text-shadow: 0 0 12px rgba(0, 212, 255, 0.8);
        border-bottom: 3px solid #00d4ff;
        padding-bottom: 4px;
    }
</style>
<!-- Yeh script ab bilkul sahi active link lagayega (har page pe test kiya) -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Current page ka clean filename nikalna
        let current = window.location.pathname.toLowerCase();
        if (current.endsWith('/')) current += 'index.php';
        current = current.split('/').pop() || 'index.php';
        // Sab nav links ko loop karo
        document.querySelectorAll('.nav-link').forEach(link => {
            let href = link.getAttribute('href').toLowerCase();
            href = href.split('#')[0]; // anchor remove
            let linkFile = href.split('/').pop() || 'index.php';
            // Exact ya partial match
            if (linkFile === current ||
                (current.includes('awareness') && linkFile.includes('awareness')) ||
                (current.includes('tools') && linkFile.includes('tools')) ||
                (current.includes('videos') && linkFile.includes('videos')) ||
                (current.includes('contact') && linkFile.includes('contact'))) {
                link.classList.add('active');
            }
        });

        // Mobile menu toggle
        const menuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // User menu toggle (avatar)
        const userBtn = document.getElementById('userMenuBtn');
        const userMenu = document.getElementById('userMenu');
        if (userBtn && userMenu) {
            userBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                userMenu.classList.toggle('hidden');
            });

            // Close when clicking outside
            document.addEventListener('click', (e) => {
                if (!userMenu.classList.contains('hidden') && !userMenu.contains(e.target) && e.target !== userBtn) {
                    userMenu.classList.add('hidden');
                }
            });
        }

    });
</script>           
       

  

  
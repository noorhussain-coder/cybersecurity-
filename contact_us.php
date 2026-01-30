<?php
include('configs/database.php');

$success_message = '';
$error_message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Validation
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error_message = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email address.";
    } else {
        // Prepare and execute insert
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message, created_at) VALUES (?, ?, ?, ?, NOW())");
        if ($stmt) {
            $stmt->bind_param("ssss", $name, $email, $subject, $message);
            if ($stmt->execute()) {
                $success_message = "Message sent successfully! We'll get back to you soon.";
                // JavaScript alert
                echo "<script>alert('✓ Message Sent Successfully!\\n\\nThank you for contacting CyberGuard.\\nWe will respond within 2-4 hours.');</script>";
                $name = $email = $subject = $message = '';
            } else {
                $error_message = "Error sending message. Please try again.";
            }
            $stmt->close();
        } else {
            $error_message = "Database error. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | CyberGuard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
       
    </style>
</head>
<body class="min-h-screen flex flex-col">

    <div id="navbar-placeholder"></div>

    <main class="flex-grow container mx-auto px-6 pt-32 pb-20">
        <div class="max-w-6xl mx-auto">
            
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-6xl font-black uppercase italic tracking-tighter">
                    Secure <span class="text-cyan-500">Communication</span>
                </h1>
                <p class="text-gray-500 mt-4 font-mono text-xs uppercase tracking-[0.4em]">Report Vulnerabilities or General Inquiries</p>
            </div>

            <?php if ($success_message): ?>
                <div class="mb-8 p-4 bg-green-500/10 border border-green-500/30 rounded-2xl">
                    <p class="text-green-400 flex items-center gap-3"><i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($success_message); ?></p>
                </div>
            <?php endif; ?>

            <?php if ($error_message): ?>
                <div class="mb-8 p-4 bg-red-500/10 border border-red-500/30 rounded-2xl">
                    <p class="text-red-400 flex items-center gap-3"><i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($error_message); ?></p>
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-stretch mb-20">
                <div class="space-y-8">
                    <div class="glass-card p-8 rounded-[2rem] border-l-4 border-l-cyan-500">
                        <h3 class="text-xl font-bold uppercase tracking-widest mb-6">Direct Channels</h3>
                        <div class="space-y-6">
                            <div class="flex items-center gap-6 group">
                                <div class="w-12 h-12 rounded-xl bg-cyan-500/10 flex items-center justify-center text-cyan-500 border border-cyan-500/20 group-hover:bg-cyan-500 group-hover:text-black transition duration-300">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] text-gray-500 uppercase font-bold">Encrypted Mail</p>
                                    <p class="text-white font-mono">support@cyberguard.secure</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-6 group">
                                <div class="w-12 h-12 rounded-xl bg-blue-500/10 flex items-center justify-center text-blue-500 border border-blue-500/20 group-hover:bg-blue-500 group-hover:text-black transition duration-300">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] text-gray-500 uppercase font-bold">HQ Location</p>
                                    <p class="text-white">Kotri, Hitech District, Jamshoro</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="glass-card p-8 rounded-[2rem] border-l-4 border-l-green-500 bg-green-500/5">
                        <div class="flex items-center gap-4">
                            <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                            <span class="text-sm font-bold uppercase tracking-widest text-green-500">System Status: Optimal</span>
                        </div>
                        <p class="text-xs text-gray-400 mt-3 italic">Our support protocols are currently operating at 99.9% efficiency. Response time: 2 Hours.</p>
                    </div>
                </div>

                <div class="glass-card p-10 rounded-[2.5rem]">
                    <form method="POST" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="text-[10px] uppercase font-bold text-gray-500 mb-2 block ml-2">Agent Name</label>
                                <input type="text" name="name" placeholder="Your Full Name" value="<?php echo htmlspecialchars($name ?? ''); ?>" class="input-field w-full px-6 py-4 rounded-2xl text-sm" required>
                            </div>
                            <div>
                                <label class="text-[10px] uppercase font-bold text-gray-500 mb-2 block ml-2">Return Address</label>
                                <input type="email" name="email" placeholder="your.email@example.com" value="<?php echo htmlspecialchars($email ?? ''); ?>" class="input-field w-full px-6 py-4 rounded-2xl text-sm" required>
                            </div>
                        </div>
                        <div>
                            <label class="text-[10px] uppercase font-bold text-gray-500 mb-2 block ml-2 ">Subject Matter</label>
                            <select name="subject" class="input-field w-full px-6 py-4 rounded-2xl text-sm appearance-none" required>
                                <option class="bg-gray-800 p-2" value="">Select a subject...</option>
                                <option class="bg-gray-800 p-2" value="Vulnerability Reporting" >Vulnerability Reporting</option>
                                <option class="bg-gray-800 p-2" value="General Inquiry">General Inquiry</option>
                                <option class="bg-gray-800 p-2" value="Partnership Request" >Partnership Request</option>
                                <option class="bg-gray-800 p-2" value="Technical Support" >Technical Support</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-[10px] uppercase font-bold text-gray-500 mb-2 block ml-2">Encrypted Message</label>
                            <textarea name="message" rows="4" placeholder="Type your message here..." class="input-field w-full px-6 py-4 rounded-2xl text-sm" required><?php echo htmlspecialchars($message ?? ''); ?></textarea>
                        </div>
                        <button type="submit" class="cyber-btn w-full py-5 rounded-2xl text-black font-black uppercase text-xs tracking-[0.3em]">
                            Transmit Message <i class="fas fa-paper-plane ml-2"></i>
                        </button>
                    </form>
                </div>
            </div>

            <section class="py-20 border-t border-white/5 bg-[#05070a] rounded-[3rem] mb-20">
                <div class="container mx-auto px-6">
                    <h2 class="text-3xl font-black uppercase italic tracking-tighter text-white mb-12">Global <span class="text-cyan-500">Nodes</span></h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="glass-card p-8 rounded-3xl group hover:border-cyan-500/50 transition-all">
                            <h4 class="text-cyan-500 font-black mb-2 italic">ASIA PACIFIC</h4>
                            <p class="text-white font-bold text-sm">Karachi, Pakistan</p>
                            <p class="text-gray-500 text-xs mt-4">Tech District, Floor 12, Cyber Tower.</p>
                        </div>
                        <div class="glass-card p-8 rounded-3xl group hover:border-blue-500/50 transition-all">
                            <h4 class="text-blue-500 font-black mb-2 italic">EUROPE</h4>
                            <p class="text-white font-bold text-sm">London, UK</p>
                            <p class="text-gray-500 text-xs mt-4">221B Baker Street, Digital Wing.</p>
                        </div>
                        <div class="glass-card p-8 rounded-3xl group hover:border-white/50 transition-all">
                            <h4 class="text-white font-black mb-2 italic">NORTH AMERICA</h4>
                            <p class="text-white font-bold text-sm">New York, USA</p>
                            <p class="text-gray-500 text-xs mt-4">Silicon Alley, Suite 404.</p>
                        </div>
                    </div>
                </div>
            </section>
<section class="py-12 mb-20" id="ir-section">
    <div class="glass-card border-l-4 border-red-600 bg-red-600/5 p-8 rounded-[2rem] flex flex-col md:flex-row items-center justify-between gap-6 transition-all duration-500 overflow-hidden" id="ir-container">
        
        <div class="flex items-center gap-6">
            <div class="w-16 h-16 rounded-full bg-red-600/20 flex items-center justify-center text-red-500 animate-pulse border border-red-600/20">
                <i class="fas fa-exclamation-triangle text-2xl"></i>
            </div>
            <div>
                <h3 class="text-xl font-black italic text-white uppercase tracking-tighter">Under Active Attack?</h3>
                <p class="text-gray-400 text-sm mt-1">Our Rapid Response Team is available 24/7.</p>
            </div>
        </div>

        <button onclick="toggleIRDetails()" class="px-8 py-4 bg-red-600 hover:bg-red-700 text-white font-black uppercase text-[10px] tracking-[0.2em] rounded-xl transition-all active:scale-95 shadow-[0_0_15px_rgba(220,38,38,0.3)]">
            Contact IR Team <i class="fas fa-phone-alt ml-2" id="ir-icon"></i>
        </button>

        <div id="ir-details" class="hidden w-full mt-6 pt-6 border-t border-red-600/20 grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
            <div class="p-4 bg-red-600/10 rounded-xl">
                <p class="text-[9px] uppercase font-bold text-red-400">Direct Line</p>
                <a href="tel:+923001234567" class="text-white font-mono hover:underline">+92 323392270</a>
            </div>
            <div class="p-4 bg-red-600/10 rounded-xl">
                <p class="text-[9px] uppercase font-bold text-red-400">Emergency Email</p>
                <p class="text-white font-mono">sos@cyberguard.com</p>
            </div>
            <div class="p-4 bg-red-600/10 rounded-xl">
                <p class="text-[9px] uppercase font-bold text-red-400">SLA Response</p>
                <p class="text-white font-mono">&lt; 15 Minutes</p>
            </div>
        </div>
    </div>
</section>
            <section class="py-20 border-t border-white/5">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-black uppercase italic tracking-tighter text-white">Security <span class="text-cyan-500">FAQ</span></h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="glass-card p-6 rounded-2xl">
                        <h4 class="text-white font-bold text-sm mb-3"><span class="text-cyan-500">01.</span> How secure is this form?</h4>
                        <p class="text-gray-500 text-xs">Every message is encrypted using AES-256 standards.</p>
                    </div>
                    <div class="glass-card p-6 rounded-2xl">
                        <h4 class="text-white font-bold text-sm mb-3"><span class="text-cyan-500">02.</span> Do you offer bug bounties?</h4>
                        <p class="text-gray-500 text-xs">Yes, we encourage responsible disclosure.</p>
                    </div>
                </div>
            </section>

            <section class="py-20 border-t border-white/5">
       <section class="py-12">
    <div class="glass-card p-10 rounded-[3rem] text-center relative overflow-hidden">
        <div class="absolute -top-10 -left-10 w-40 h-40 bg-cyan-500/5 rounded-full blur-3xl"></div>
        
        <h2 class="text-2xl font-black uppercase italic tracking-tighter text-white mb-2">
            Rate Our Support <span class="text-cyan-500 text-glow">Intelligence</span>
        </h2>
        
        <p class="text-gray-500 text-xs font-mono uppercase tracking-widest mb-8">
            How was your interaction with our security agents?
        </p>

        <div class="flex flex-wrap justify-center gap-3 md:gap-4 mb-6" id="rating-container">
            <button class="star-btn w-12 h-12 md:w-14 md:h-14 rounded-2xl glass-card border-cyan-500/20 text-gray-600 hover:text-cyan-400 hover:border-cyan-500 transition-all text-xl">
                <i class="fas fa-star"></i>
            </button>
            <button class="star-btn w-12 h-12 md:w-14 md:h-14 rounded-2xl glass-card border-cyan-500/20 text-gray-600 hover:text-cyan-400 hover:border-cyan-500 transition-all text-xl">
                <i class="fas fa-star"></i>
            </button>
            <button class="star-btn w-12 h-12 md:w-14 md:h-14 rounded-2xl glass-card border-cyan-500/20 text-gray-600 hover:text-cyan-400 hover:border-cyan-500 transition-all text-xl">
                <i class="fas fa-star"></i>
            </button>
            <button class="star-btn w-12 h-12 md:w-14 md:h-14 rounded-2xl glass-card border-cyan-500/20 text-gray-600 hover:text-cyan-400 hover:border-cyan-500 transition-all text-xl">
                <i class="fas fa-star"></i>
            </button>
            <button class="star-btn w-12 h-12 md:w-14 md:h-14 rounded-2xl glass-card border-cyan-500/20 text-gray-600 hover:text-cyan-400 hover:border-cyan-500 transition-all text-xl">
                <i class="fas fa-star"></i>
            </button>
        </div>

        <p class="text-[10px] text-cyan-500/50 font-mono">
            User Rating: <span id="rating-value" class="text-cyan-500">0</span>/5 | Satisfaction Index: 4.9/5.0
        </p>
    </div>
</section>

            <section class="py-16 border-t border-white/5">
                <div class="flex flex-col md:flex-row items-center justify-between gap-10">
                    <div>
                        <h4 class="text-lg font-black italic uppercase text-white tracking-tighter">Social <span class="text-cyan-500">Reconnaissance</span></h4>
                        <p class="text-gray-500 text-xs mt-1 font-mono uppercase">Sync with our live threat feeds</p>
                    </div>
                    <div class="flex flex-wrap justify-center gap-6">
                        <a href="#" class="flex items-center gap-4 glass-card px-6 py-4 rounded-2xl group border-blue-500/20 transition-all hover:bg-blue-600/10">
                            <i class="fab fa-linkedin text-blue-500 text-2xl"></i>
                            <span class="text-[10px] font-black uppercase tracking-widest">Connect</span>
                        </a>
                        <a href="#" class="flex items-center gap-4 glass-card px-6 py-4 rounded-2xl group border-indigo-500/20 transition-all hover:bg-indigo-600/10">
                            <i class="fab fa-discord text-indigo-500 text-2xl"></i>
                            <span class="text-[10px] font-black uppercase tracking-widest">Join Community</span>
                        </a>
                        <a href="#" class="flex items-center gap-4 glass-card px-6 py-4 rounded-2xl group border-white/10 transition-all hover:bg-white/5">
                            <i class="fab fa-x-twitter text-white text-2xl"></i>
                            <span class="text-[10px] font-black uppercase tracking-widest">Follow</span>
                        </a>
                    </div>
                </div>
            </section>

            <section class="py-20 bg-gradient-to-t from-cyan-500/5 to-transparent rounded-[3rem] border border-cyan-500/10 mb-10">
                <div class="max-w-2xl mx-auto text-center px-6">
                    <i class="fas fa-satellite-dish text-cyan-500 text-4xl mb-6"></i>
                    <h2 class="text-3xl font-black italic uppercase text-white tracking-tighter">Subscribe to <span class="text-cyan-500">Threat Intel</span></h2>
                    <form class="flex flex-col md:flex-row gap-4 mt-8">
                        <input type="email" placeholder="agent@protocol.com" class="input-field flex-1 px-6 py-4 rounded-2xl text-sm">
                        <button class="cyber-btn px-10 py-4 rounded-2xl text-black font-black uppercase text-xs tracking-widest">Initialize Sync</button>
                    </form>
                </div>
            </section>

        </div>
    </main>

    <div id="footer-placeholder"></div>
    <script src="script.js"></script>
</body>
</html>
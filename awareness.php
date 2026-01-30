<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberGuard | Security Awareness</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-black text-white">

    <!-- Navbar Placeholder (index se same) -->
    <div id="navbar-placeholder"></div>

    <!-- Hero Section for Introduction -->
    <section class="relative py-24 bg-[#080a0f] border-b border-white/5 overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-cyan-500/5 rounded-full filter blur-[120px]"></div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <h1 class="text-4xl md:text-6xl font-black mb-6 uppercase italic tracking-tighter text-white">
                Cyber <span class="text-cyan-500">Awareness Hub</span>
            </h1>
            <p class="text-gray-400 mb-10 text-lg leading-relaxed max-w-3xl mx-auto">
                Stay informed about the latest cyber threats and learn how to protect yourself. Every 39 seconds, a cyber attack occurs – knowledge is your best defense.
            </p>
            <a href="#threats" class="px-10 py-4 bg-cyan-500 text-black font-bold rounded-xl hover:bg-cyan-400 transition-all uppercase tracking-wider">
                Explore Threats
            </a>
        </div>
    </section>

    <!-- Section 1: Common Cyber Threats Overview -->
    <section id="threats" class="py-24 bg-black/40">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-black mb-16 text-center uppercase tracking-tighter italic">Common Cyber <span class="text-red-500">Threats</span></h2>
            <p class="text-gray-400 mb-12 text-center text-lg max-w-3xl mx-auto">
                Understanding the landscape of cyber threats is the first step to protection. Here are the most prevalent attacks today.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="glass p-6 rounded-2xl border-l-4 border-cyan-500 hover:bg-cyan-500/5 transition-all">
                    <i class="fas fa-fish text-4xl text-cyan-500 mb-4"></i>
                    <h4 class="text-xl font-bold mb-2">Phishing</h4>
                    <p class="text-sm text-gray-500 leading-relaxed">Deceptive emails or messages to trick you into revealing sensitive information.</p>
                </div>
                <div class="glass p-6 rounded-2xl border-l-4 border-red-500 hover:bg-red-500/5 transition-all">
                    <i class="fas fa-virus text-4xl text-red-500 mb-4"></i>
                    <h4 class="text-xl font-bold mb-2">Malware</h4>
                    <p class="text-sm text-gray-500 leading-relaxed">Malicious software designed to damage or disable computers.</p>
                </div>
                <div class="glass p-6 rounded-2xl border-l-4 border-yellow-500 hover:bg-yellow-500/5 transition-all">
                    <i class="fas fa-lock text-4xl text-yellow-500 mb-4"></i>
                    <h4 class="text-xl font-bold mb-2">Ransomware</h4>
                    <p class="text-sm text-gray-500 leading-relaxed">Encrypts your files and demands ransom for access.</p>
                </div>
                <div class="glass p-6 rounded-2xl border-l-4 border-green-500 hover:bg-green-500/5 transition-all">
                    <i class="fas fa-users text-4xl text-green-500 mb-4"></i>
                    <h4 class="text-xl font-bold mb-2">Social Engineering</h4>
                    <p class="text-sm text-gray-500 leading-relaxed">Manipulating people to divulge confidential information.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 2: Phishing Awareness -->
    <section class="py-24 bg-[#0a0d12] relative overflow-hidden border-y border-white/5">
        <div class="container mx-auto px-6 relative z-10">
            <h2 class="text-4xl font-black mb-12 text-center uppercase tracking-tighter italic">Phishing <span class="text-red-500">Attacks</span></h2>
            <p class="text-gray-400 mb-8 text-center max-w-2xl mx-auto">
                Phishing is the most common attack, responsible for 90% of data breaches. Learn how to spot and avoid it.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="glass p-8 rounded-2xl">
                    <h3 class="text-xl font-bold mb-4">Signs of Phishing</h3>
                    <ul class="space-y-2 text-gray-500 text-sm">
                        <li><i class="fas fa-check text-cyan-500 mr-2"></i> Unexpected emails from known senders.</li>
                        <li><i class="fas fa-check text-cyan-500 mr-2"></i> Urgency or threats in the message.</li>
                        <li><i class="fas fa-check text-cyan-500 mr-2"></i> Suspicious links or attachments.</li>
                    </ul>
                </div>
                <div class="glass p-8 rounded-2xl">
                    <h3 class="text-xl font-bold mb-4">Prevention Tips</h3>
                    <ul class="space-y-2 text-gray-500 text-sm">
                        <li><i class="fas fa-check text-cyan-500 mr-2"></i> Verify sender's email.</li>
                        <li><i class="fas fa-check text-cyan-500 mr-2"></i> Use anti-phishing tools.</li>
                        <li><i class="fas fa-check text-cyan-500 mr-2"></i> Never click suspicious links.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Malware and Ransomware -->
    <section class="py-24 bg-black/40">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-black mb-12 text-center uppercase tracking-tighter italic">Malware & <span class="text-red-500">Ransomware</span></h2>
            <p class="text-gray-400 mb-8 text-center max-w-2xl mx-auto">
                Malware infects your system, while ransomware locks your data. Both can cause massive damage.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="glass p-8 rounded-2xl">
                    <h3 class="text-xl font-bold mb-4">How Malware Spreads</h3>
                    <ul class="space-y-2 text-gray-500 text-sm">
                        <li><i class="fas fa-check text-cyan-500 mr-2"></i> Infected downloads or emails.</li>
                        <li><i class="fas fa-check text-cyan-500 mr-2"></i> Drive-by downloads from malicious sites.</li>
                        <li><i class="fas fa-check text-cyan-500 mr-2"></i> USB drives or network shares.</li>
                    </ul>
                </div>
                <div class="glass p-8 rounded-2xl">
                    <h3 class="text-xl font-bold mb-4">Protection Strategies</h3>
                    <ul class="space-y-2 text-gray-500 text-sm">
                        <li><i class="fas fa-check text-cyan-500 mr-2"></i> Install reputable antivirus.</li>
                        <li><i class="fas fa-check text-cyan-500 mr-2"></i> Keep software updated.</li>
                        <li><i class="fas fa-check text-cyan-500 mr-2"></i> Regular backups (offline).</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 4: Social Engineering -->
    <section class="py-24 bg-[#0a0d12] relative overflow-hidden border-y border-white/5">
        <div class="container mx-auto px-6 relative z-10">
            <h2 class="text-4xl font-black mb-12 text-center uppercase tracking-tighter italic">Social <span class="text-red-500">Engineering</span></h2>
            <p class="text-gray-400 mb-8 text-center max-w-2xl mx-auto">
                Attackers exploit human psychology to gain access. It's the weakest link in security.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="glass p-8 rounded-2xl">
                    <h3 class="text-xl font-bold mb-4">Common Tactics</h3>
                    <ul class="space-y-2 text-gray-500 text-sm">
                        <li><i class="fas fa-check text-cyan-500 mr-2"></i> Pretending to be trusted entities.</li>
                        <li><i class="fas fa-check text-cyan-500 mr-2"></i> Baiting with free offers.</li>
                        <li><i class="fas fa-check text-cyan-500 mr-2"></i> Tailgating into secure areas.</li>
                    </ul>
                </div>
                <div class="glass p-8 rounded-2xl">
                    <h3 class="text-xl font-bold mb-4">How to Counter</h3>
                    <ul class="space-y-2 text-gray-500 text-sm">
                        <li><i class="fas fa-check text-cyan-500 mr-2"></i> Verify identities always.</li>
                        <li><i class="fas fa-check text-cyan-500 mr-2"></i> Be skeptical of unsolicited requests.</li>
                        <li><i class="fas fa-check text-cyan-500 mr-2"></i> Train employees regularly.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 5: Prevention Tips -->
    <section class="py-24 bg-black/40">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-black mb-12 text-center uppercase tracking-tighter italic">Prevention <span class="text-cyan-500">Tips</span></h2>
            <p class="text-gray-400 mb-8 text-center max-w-2xl mx-auto">
                Simple steps can prevent most attacks. Follow these best practices.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="glass p-6 rounded-2xl">
                    <i class="fas fa-key text-4xl text-cyan-500 mb-4"></i>
                    <h4 class="text-xl font-bold mb-2">Strong Passwords</h4>
                    <p class="text-sm text-gray-500">Use unique, complex passwords and a manager.</p>
                </div>
                <div class="glass p-6 rounded-2xl">
                    <i class="fas fa-shield-alt text-4xl text-cyan-500 mb-4"></i>
                    <h4 class="text-xl font-bold mb-2">Enable 2FA</h4>
                    <p class="text-sm text-gray-500">Add an extra layer of security to accounts.</p>
                </div>
                <div class="glass p-6 rounded-2xl">
                    <i class="fas fa-sync-alt text-4xl text-cyan-500 mb-4"></i>
                    <h4 class="text-xl font-bold mb-2">Regular Updates</h4>
                    <p class="text-sm text-gray-500">Keep software and devices up to date.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 6: FAQ -->
    <section class="py-24 bg-[#0a0d12] border-t border-white/5">
        <div class="container mx-auto px-6 max-w-4xl">
            <h2 class="text-4xl font-black mb-12 text-center uppercase tracking-tighter italic">Cyber Awareness <span class="text-cyan-500">FAQ</span></h2>
            <div class="space-y-4">
                <details class="glass rounded-2xl p-6 group cursor-pointer">
                    <summary class="list-none flex justify-between items-center font-bold text-sm uppercase tracking-wider text-white">
                        What is the biggest cyber threat?
                        <i class="fas fa-chevron-down text-cyan-500 group-open:rotate-180 transition"></i>
                    </summary>
                    <p class="mt-4 text-gray-500 text-sm leading-relaxed">Human error, like falling for phishing, accounts for 95% of breaches.</p>
                </details>
                <details class="glass rounded-2xl p-6 group cursor-pointer">
                    <summary class="list-none flex justify-between items-center font-bold text-sm uppercase tracking-wider text-white">
                        How can I report a cyber attack?
                        <i class="fas fa-chevron-down text-cyan-500 group-open:rotate-180 transition"></i>
                    </summary>
                    <p class="mt-4 text-gray-500 text-sm leading-relaxed">Contact your local cyber crime unit or use tools like our report breach feature.</p>
                </details>
                <details class="glass rounded-2xl p-6 group cursor-pointer">
                    <summary class="list-none flex justify-between items-center font-bold text-sm uppercase tracking-wider text-white">
                        Is antivirus enough?
                        <i class="fas fa-chevron-down text-cyan-500 group-open:rotate-180 transition"></i>
                    </summary>
                    <p class="mt-4 text-gray-500 text-sm leading-relaxed">No, combine it with awareness, updates, and safe practices.</p>
                </details>
            </div>
        </div>
    </section>

    <!-- Footer Placeholder (index se same) -->
    <div id="footer-placeholder"></div>

    <script src="script.js"></script>
</body>

</html>
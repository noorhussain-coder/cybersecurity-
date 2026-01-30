<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberGuard | Tools</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-black text-white">

    <!-- Navbar Placeholder -->
    <div id="navbar-placeholder"></div><section class="py-24 bg-black/60 border-y border-white/5 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-cyan-500/5 rounded-full filter blur-[120px]"></div>
    
    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-black uppercase tracking-tighter italic text-white">
                Interactive <span class="text-cyan-500">Live Tools</span>
            </h2>
            <p class="text-gray-400 mt-4 max-w-2xl mx-auto">
                No fake buttons. Real-time utilities powered by JavaScript – test your security instantly.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <div class="glass p-8 rounded-3xl border-t-4 border-cyan-500 shadow-[0_0_20px_rgba(0,212,255,0.3)] transition-all duration-300 hover:scale-[1.02]">
                <i class="fas fa-key text-5xl text-cyan-500 mb-6"></i>
                <h3 class="text-2xl font-bold mb-4 text-white">Strength Checker</h3>
                <input type="password" id="live-password" oninput="checkStrength(this.value)" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:border-cyan-500 outline-none mb-4" placeholder="Type password...">
                <div id="strength-result" class="text-center font-medium text-sm h-6"></div>
            </div>

            <div class="glass p-8 rounded-3xl border-t-4 border-white shadow-[0_0_20px_rgba(255,255,255,0.1)] transition-all duration-300 hover:scale-[1.02]">
                <i class="fas fa-network-wired text-5xl text-white mb-6"></i>
                <h3 class="text-2xl font-bold mb-4 text-white">IP Scanner</h3>
                <button onclick="scanMyIP(this)" class="w-full bg-white text-black font-bold py-3 rounded-lg transition-all uppercase hover:bg-gray-200">Scan My IP</button>
                <div id="ip-result" class="mt-4 text-center text-gray-400 font-mono text-xs h-6"></div>
            </div>

            <div class="glass p-8 rounded-3xl border-t-4 border-cyan-500 shadow-[0_0_20px_rgba(0,212,255,0.3)] transition-all duration-300 hover:scale-[1.02]">
                <i class="fas fa-link text-5xl text-cyan-500 mb-6"></i>
                <h3 class="text-2xl font-bold mb-4 text-white">URL Safety</h3>
                <input type="text" id="url-check" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:border-cyan-500 outline-none mb-4" placeholder="Paste URL...">
                <button onclick="checkURL()" class="w-full bg-cyan-600 text-black font-bold py-2 rounded-lg text-xs uppercase">Analyze URL</button>
                <div id="url-result" class="mt-2 text-center text-xs h-4"></div>
            </div>

            <div class="glass p-8 rounded-3xl border-t-4 border-white shadow-[0_0_20px_rgba(255,255,255,0.1)] transition-all duration-300 hover:scale-[1.02]">
                <i class="fas fa-fingerprint text-5xl text-white mb-6"></i>
                <h3 class="text-2xl font-bold mb-4 text-white">SHA-256 Hash</h3>
                <input type="text" id="hash-input" oninput="generateHash(this.value)" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:border-white outline-none mb-4" placeholder="Enter text...">
                <div id="hash-result" class="text-[10px] break-all font-mono text-cyan-400 p-2 bg-black/40 rounded border border-white/10 min-h-[40px]">Result...</div>
            </div>

            <div class="glass p-8 rounded-3xl border-t-4 border-cyan-500 shadow-[0_0_20px_rgba(0,212,255,0.3)] transition-all duration-300 hover:scale-[1.02]">
                <i class="fas fa-shield-alt text-5xl text-cyan-500 mb-6"></i>
                <h3 class="text-2xl font-bold mb-4 text-white">PassGen Pro</h3>
                <div class="bg-gray-900 border border-gray-700 rounded-lg p-3 mb-4 text-cyan-400 font-mono text-center text-sm min-h-[44px]" id="gen-pass-display">Ready...</div>
                <button onclick="generateSecurePass()" class="w-full bg-cyan-600 hover:bg-cyan-500 text-black font-bold py-3 rounded-lg transition-all uppercase text-xs">Generate Now</button>
            </div>

            <div class="glass p-8 rounded-3xl border-t-4 border-white shadow-[0_0_20px_rgba(255,255,255,0.1)] transition-all duration-300 hover:scale-[1.02]">
                <i class="fas fa-code text-5xl text-white mb-6"></i>
                <h3 class="text-2xl font-bold mb-4 text-white">Base64 Tool</h3>
                <input type="text" id="b64-input" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white outline-none mb-4 text-sm" placeholder="Text...">
                <div class="flex gap-2">
                    <button onclick="b64Encode()" class="flex-1 bg-white text-black font-bold py-2 rounded text-[10px]">ENCODE</button>
                    <button onclick="b64Decode()" class="flex-1 border border-white text-white font-bold py-2 rounded text-[10px]">DECODE</button>
                </div>
                <div id="b64-result" class="mt-3 text-[10px] text-cyan-400 font-mono break-all"></div>
            </div>

            <div class="glass p-8 rounded-3xl border-t-4 border-cyan-500 shadow-[0_0_20px_rgba(0,212,255,0.3)] transition-all duration-300 hover:scale-[1.02]">
                <i class="fas fa-binary text-5xl text-cyan-500 mb-6"></i>
                <h3 class="text-2xl font-bold mb-4 text-white">Text to Hex</h3>
                <input type="text" oninput="toHex(this.value)" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:border-cyan-500 outline-none mb-4 text-sm" placeholder="Convert string...">
                <div id="hex-out" class="text-[10px] font-mono text-gray-400 break-all bg-black/20 p-2 rounded">Output...</div>
            </div>

            <div class="glass p-8 rounded-3xl border-t-4 border-white shadow-[0_0_20px_rgba(255,255,255,0.1)] transition-all duration-300 hover:scale-[1.02]">
                <i class="fas fa-user-shield text-5xl text-white mb-6"></i>
                <h3 class="text-2xl font-bold mb-4 text-white">Breach Check</h3>
                <input type="email" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:border-white outline-none mb-4 text-sm" placeholder="email@example.com">
                <button onclick="checkBreach(this)" class="w-full bg-white text-black font-bold py-3 rounded-lg uppercase text-xs hover:bg-gray-200">Verify Email</button>
                <div id="breach-status" class="mt-3 text-center text-[10px] text-green-400"></div>
            </div>

            <div class="glass p-8 rounded-3xl border-t-4 border-cyan-500 shadow-[0_0_20px_rgba(0,212,255,0.3)] transition-all duration-300 hover:scale-[1.02]">
                <i class="fas fa-font text-5xl text-cyan-500 mb-6"></i>
                <h3 class="text-2xl font-bold mb-4 text-white">Case Sanitizer</h3>
                <textarea id="case-txt" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-3 py-2 text-white text-xs h-16 mb-4" placeholder="Messy text..."></textarea>
                <div class="flex gap-2">
                    <button onclick="changeCase('up')" class="flex-1 bg-cyan-600 text-black font-bold py-2 rounded text-[10px]">UPPER</button>
                    <button onclick="changeCase('low')" class="flex-1 border border-cyan-500 text-cyan-500 font-bold py-2 rounded text-[10px]">lower</button>
                </div>
            </div>

        </div>
    </div>
</section>

    <!-- New Section: CYBERSECURITY TOOLS BY CATEGORY (Image ke mutabiq) -->
    <!-- Yeh section image ke style mein hai – categories with tools list, white-aqua theme -->
    <section class="py-24 bg-[#0a0d12] border-y border-white/5">
        <div class="container mx-auto px-6">
            <h2 class="text-5xl md:text-6xl font-black mb-16 text-center uppercase tracking-tighter">
                CYBERSECURITY <span class="text-cyan-500">TOOLS</span> BY CATEGORY
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                
                <!-- Category 1: Information Gathering -->
                <div class="glass p-8 rounded-3xl border-t-4 border-white/80 shadow-[0_0_20px_rgba(255,255,255,0.2)] transition-all duration-300 hover:shadow-[0_0_35px_rgba(255,255,255,0.4)] hover:scale-[1.02]">
                    <h3 class="text-2xl font-black mb-6 text-white uppercase">Information Gathering</h3>
                    <ul class="text-gray-300 space-y-3">
                        <li><a href="https://nmap.org/" target="_blank" class="hover:text-cyan-400 transition">> Nmap</a></li>
                        <li><a href="https://www.shodan.io/" target="_blank" class="hover:text-cyan-400 transition">> Shodan</a></li>
                        <li><a href="https://github.com/lanmaster53/recon-ng" target="_blank" class="hover:text-cyan-400 transition">> Recon-NG</a></li>
                        <li><a href="https://github.com/thewhiteh4t/pwnedornot" target="_blank" class="hover:text-cyan-400 transition">> Maltego</a></li>
                        <li><a href="https://github.com/thewhiteh4t/theHarvester" target="_blank" class="hover:text-cyan-400 transition">> theHarvester</a></li>
                    </ul>
                    <p class="text-gray-400 mt-4 text-sm">Network scanning aur open-source intelligence (OSINT) gather karne ke liye.</p>
                </div>

                <!-- Category 2: Wireless Hacking -->
                <div class="glass p-8 rounded-3xl border-t-4 border-cyan-400 shadow-[0_0_20px_rgba(0,212,255,0.3)] transition-all duration-300 hover:shadow-[0_0_35px_rgba(0,212,255,0.6)] hover:scale-[1.02]">
                    <h3 class="text-2xl font-black mb-6 text-white uppercase">Wireless Hacking</h3>
                    <ul class="text-gray-300 space-y-3">
                        <li><a href="https://www.aircrack-ng.org/" target="_blank" class="hover:text-cyan-400 transition">> Aircrack-ng</a></li>
                        <li><a href="https://wifite.net/" target="_blank" class="hover:text-cyan-400 transition">> Wifite</a></li>
                        <li><a href="https://kismetwireless.net/" target="_blank" class="hover:text-cyan-400 transition">> Kismet</a></li>
                        <li><a href="https://github.com/aircrack-ng/aircrack-ng" target="_blank" class="hover:text-cyan-400 transition">> Airsnort</a></li>
                    </ul>
                    <p class="text-gray-400 mt-4 text-sm">Wi-Fi networks ko crack aur exploit karne ke liye tools.</p>
                </div>

                <!-- Category 3: Password Cracking -->
                <div class="glass p-8 rounded-3xl border-t-4 border-white/80 shadow-[0_0_20px_rgba(255,255,255,0.2)] transition-all duration-300 hover:shadow-[0_0_35px_rgba(255,255,255,0.4)] hover:scale-[1.02]">
                    <h3 class="text-2xl font-black mb-6 text-white uppercase">Password Cracking</h3>
                    <ul class="text-gray-300 space-y-3">
                        <li><a href="https://github.com/openwall/john" target="_blank" class="hover:text-cyan-400 transition">> John the Ripper</a></li>
                        <li><a href="https://hashcat.net/hashcat/" target="_blank" class="hover:text-cyan-400 transition">> Hashcat</a></li>
                        <li><a href="https://github.com/vanhauser-thc/thc-hydra" target="_blank" class="hover:text-cyan-400 transition">> Hydra</a></li>
                        <li><a href="https://ophcrack.sourceforge.net/" target="_blank" class="hover:text-cyan-400 transition">> OPHCrack</a></li>
                    </ul>
                    <p class="text-gray-400 mt-4 text-sm">Passwords ko crack karne ke liye high-speed tools.</p>
                </div>

                <!-- Category 4: Vulnerability Scanning -->
                <div class="glass p-8 rounded-3xl border-t-4 border-cyan-400 shadow-[0_0_20px_rgba(0,212,255,0.3)] transition-all duration-300 hover:shadow-[0_0_35px_rgba(0,212,255,0.6)] hover:scale-[1.02]">
                    <h3 class="text-2xl font-black mb-6 text-white uppercase">Vulnerability Scanning</h3>
                    <ul class="text-gray-300 space-y-3">
                        <li><a href="https://www.openvas.org/" target="_blank" class="hover:text-cyan-400 transition">> OpenVAS</a></li>
                        <li><a href="https://www.tenable.com/products/nessus" target="_blank" class="hover:text-cyan-400 transition">> Nessus</a></li>
                        <li><a href="https://www.ibm.com/products/app-scan" target="_blank" class="hover:text-cyan-400 transition">> AppScan</a></li>
                        <li><a href="https://www.rapid7.com/products/nexpose/" target="_blank" class="hover:text-cyan-400 transition">> Nexpose</a></li>
                    </ul>
                    <p class="text-gray-400 mt-4 text-sm">Systems or apps mein weaknesses dhundne ke liye scanning tools.</p>
                </div>

                <!-- Category 5: Forensics -->
                <div class="glass p-8 rounded-3xl border-t-4 border-white/80 shadow-[0_0_20px_rgba(255,255,255,0.2)] transition-all duration-300 hover:shadow-[0_0_35px_rgba(255,255,255,0.4)] hover:scale-[1.02]">
                    <h3 class="text-2xl font-black mb-6 text-white uppercase">Forensics</h3>
                    <ul class="text-gray-300 space-y-3">
                        <li><a href="https://www.sleuthkit.org/" target="_blank" class="hover:text-cyan-400 transition">> Sleuth Kit</a></li>
                        <li><a href="https://www.autopsy.com/" target="_blank" class="hover:text-cyan-400 transition">> Autopsy</a></li>
                        <li><a href="https://www.volatilityfoundation.org/" target="_blank" class="hover:text-cyan-400 transition">> Volatility</a></li>
                    </ul>
                    <p class="text-gray-400 mt-4 text-sm">Digital evidence collect aur analyze karne ke liye tools.</p>
                </div>

                <!-- Category 6: Exploitation & Web Assessment -->
                <div class="glass p-8 rounded-3xl border-t-4 border-cyan-400 shadow-[0_0_20px_rgba(0,212,255,0.3)] transition-all duration-300 hover:shadow-[0_0_35px_rgba(0,212,255,0.6)] hover:scale-[1.02]">
                    <h3 class="text-2xl font-black mb-6 text-white uppercase">Exploitation & Web Assessment</h3>
                    <ul class="text-gray-300 space-y-3">
                        <li><a href="https://portswigger.net/burp" target="_blank" class="hover:text-cyan-400 transition">> Burp Suite</a></li>
                        <li><a href="https://www.metasploit.com/" target="_blank" class="hover:text-cyan-400 transition">> Metasploit</a></li>
                        <li><a href="https://owasp.org/www-project-zap/" target="_blank" class="hover:text-cyan-400 transition">> OWASP ZAP</a></li>
                        <li><a href="https://sqlmap.org/" target="_blank" class="hover:text-cyan-400 transition">> SQLMap</a></li>
                    </ul>
                    <p class="text-gray-400 mt-4 text-sm">Exploits aur web applications ko test karne ke liye tools.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer Placeholder -->
    <div id="footer-placeholder"></div>

    <script src="script.js"></script>
</body>
</html>
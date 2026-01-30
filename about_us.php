<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberGuard | About Us</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-black text-white">

    <!-- Navbar Placeholder -->
    <div id="navbar-placeholder"></div>

    <!-- 1. Hero Section – yahan background image add ki -->
    <section class="relative py-32 bg-gradient-to-b from-[#080a0f] to-black overflow-hidden bg-cover bg-center bg-no-repeat"
             style="background-image: url('https://thumbs.dreamstime.com/b/digital-padlock-circuit-board-conceptual-image-data-protection-futuristic-design-cybersecurity-themes-ai-glowing-blue-320844660.jpg');">
        <div class="absolute inset-0 opacity-70 bg-black/60"></div> <!-- Dark overlay taake text readable rahe -->
        <div class="absolute inset-0 opacity-10"
             style="background-image: linear-gradient(#00d4ff 1px, transparent 1px), linear-gradient(90deg, #00d4ff 1px, transparent 1px); background-size: 45px 45px;"></div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <h1 class="text-5xl md:text-7xl font-black mb-6 tracking-tighter uppercase">
                About <span class="text-cyan-500">CyberGuard</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-300 max-w-4xl mx-auto leading-relaxed">
                Defending the digital world, one awareness at a time.
            </p>
        </div>
    </section>

    <!-- Baaki code bilkul same (no changes) -->
    <!-- 2 & 3. Our Mission and Our Vision -->
    <section class="py-24 bg-[#0a0d12] border-b border-white/5">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                
                <!-- Mission Card -->
                <div class="glass p-10 rounded-3xl border-t-4 border-cyan-500 shadow-[0_0_20px_rgba(0,212,255,0.3)] transition-all duration-300 hover:shadow-[0_0_30px_rgba(0,212,255,0.5)]">
                    <h2 class="text-4xl md:text-5xl font-black mb-6 uppercase tracking-tighter text-center text-white">
                        OUR <span class="text-cyan-500">MISSION</span>
                    </h2>
                    <p class="text-gray-300 text-lg md:text-xl leading-relaxed text-center">
                        To empower every individual and organization with practical cybersecurity knowledge so they can protect themselves and others in an increasingly connected world.
                    </p>
                </div>

                <!-- Vision Card -->
                <div class="glass p-10 rounded-3xl border-t-4 border-cyan-400 shadow-[0_0_20px_rgba(0,212,255,0.3)] transition-all duration-300 hover:shadow-[0_0_30px_rgba(0,212,255,0.5)]">
                    <h2 class="text-4xl md:text-5xl font-black mb-6 uppercase tracking-tighter text-center text-white">
                        OUR <span class="text-cyan-400">VISION</span>
                    </h2>
                    <p class="text-gray-300 text-lg md:text-xl leading-relaxed text-center">
                        A cyber-secure world where awareness eliminates fear, and every digital citizen confidently defends their online life against evolving threats.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- 4. Who We Are -->
    <section class="py-24 bg-[#080a0f]">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-black mb-12 text-center uppercase tracking-tighter italic">Who <span class="text-cyan-500">We Are</span></h2>
            <div class="max-w-4xl mx-auto text-center">
                <p class="text-gray-300 text-lg leading-relaxed mb-10">
                    CyberGuard started in 2024 as a passion project by cybersecurity experts who were tired of seeing people fall victim to preventable attacks.
                </p>
                <p class="text-gray-300 text-lg leading-relaxed">
                    Today, we are a growing community of ethical hackers, trainers, researchers, and awareness advocates dedicated to making cybersecurity simple, accessible, and effective for everyone.
                </p>
            </div>
        </div>
    </section>

    <!-- 5. Why CyberGuard? -->
    <section class="py-24 bg-black/60 border-y border-white/5">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-black mb-16 text-center uppercase tracking-tighter italic">
                Why Choose <span class="text-cyan-500">CyberGuard?</span>
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- Card 1: White Theme -->
                <div class="glass p-8 rounded-3xl border-t-4 border-white/80 shadow-[0_0_20px_rgba(255,255,255,0.2)] transition-all duration-300 hover:shadow-[0_0_35px_rgba(255,255,255,0.4)] text-center">
                    <i class="fas fa-graduation-cap text-5xl text-white/90 mb-6"></i>
                    <h3 class="text-2xl font-black mb-4 text-white">
                        Real-World Training
                    </h3>
                    <p class="text-gray-300 text-base leading-relaxed">
                        Practical, up-to-date modules built by actual security professionals.
                    </p>
                </div>

                <!-- Card 2: Aqua/Cyan Theme -->
                <div class="glass p-8 rounded-3xl border-t-4 border-cyan-400 shadow-[0_0_20px_rgba(0,212,255,0.3)] transition-all duration-300 hover:shadow-[0_0_35px_rgba(0,212,255,0.6)] text-center">
                    <i class="fas fa-tools text-5xl text-cyan-400 mb-6"></i>
                    <h3 class="text-2xl font-black mb-4 text-white">
                        Free & Powerful Tools
                    </h3>
                    <p class="text-gray-300 text-base leading-relaxed">
                        Advanced scanners and analyzers — no paywalls, no catch.
                    </p>
                </div>

                <!-- Card 3: Red Theme -->
                <div class="glass p-8 rounded-3xl border-t-4 border-red-500 shadow-[0_0_20px_rgba(239,68,68,0.3)] transition-all duration-300 hover:shadow-[0_0_35px_rgba(239,68,68,0.6)] text-center">
                    <i class="fas fa-users text-5xl text-red-500 mb-6"></i>
                    <h3 class="text-2xl font-black mb-4 text-white">
                        Community-Driven
                    </h3>
                    <p class="text-gray-300 text-base leading-relaxed">
                        Built for users, improved by users — your feedback shapes us.
                    </p>
                </div>

            </div>
        </div>
    </section>  

    <!-- 6. Our Journey (Timeline) -->
    <section class="py-24 bg-[#0a0d12]">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-black mb-16 text-center uppercase tracking-tighter italic">
                Our <span class="text-cyan-500">Journey</span>
            </h2>
            <div class="max-w-5xl mx-auto space-y-16">
                
                <!-- 2024 – White Theme -->
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <div class="w-28 h-28 rounded-full bg-white/10 flex items-center justify-center flex-shrink-0 border-2 border-white/40">
                        <span class="text-4xl font-black text-white">2024</span>
                    </div>
                    <div class="glass p-8 rounded-2xl flex-1 border-t-4 border-white/60 shadow-[0_0_20px_rgba(255,255,255,0.15)] transition-all duration-300 hover:shadow-[0_0_30px_rgba(255,255,255,0.3)]">
                        <h3 class="text-2xl font-bold mb-3 text-white">The Beginning</h3>
                        <p class="text-gray-300">Started as a small awareness blog after seeing too many preventable breaches.</p>
                    </div>
                </div>

                <!-- 2025 – Aqua/Cyan Theme -->
                <div class="flex flex-col md:flex-row-reverse items-center gap-8">
                    <div class="w-28 h-28 rounded-full bg-cyan-500/20 flex items-center justify-center flex-shrink-0 border-2 border-cyan-400/60">
                        <span class="text-4xl font-black text-cyan-400">2025</span>
                    </div>
                    <div class="glass p-8 rounded-2xl flex-1 border-t-4 border-cyan-400 shadow-[0_0_20px_rgba(0,212,255,0.3)] transition-all duration-300 hover:shadow-[0_0_30px_rgba(0,212,255,0.5)]">
                        <h3 class="text-2xl font-bold mb-3 text-white">Expansion</h3>
                        <p class="text-gray-300">Launched free tools, video series, and crossed 100,000 users globally.</p>
                    </div>
                </div>

                <!-- 2026 – White Theme -->
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <div class="w-28 h-28 rounded-full bg-white/10 flex items-center justify-center flex-shrink-0 border-2 border-white/40">
                        <span class="text-4xl font-black text-white">2026</span>
                    </div>
                    <div class="glass p-8 rounded-2xl flex-1 border-t-4 border-white/60 shadow-[0_0_20px_rgba(255,255,255,0.15)] transition-all duration-300 hover:shadow-[0_0_30px_rgba(255,255,255,0.3)]">
                        <h3 class="text-2xl font-bold mb-3 text-white">Today</h3>
                        <p class="text-gray-300">Building AI-powered tools, enterprise programs, and global awareness campaigns.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 7. Core Values -->
    <section class="py-24 bg-black border-y border-white/5">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-black mb-16 text-center uppercase tracking-tighter italic">Our <span class="text-cyan-500">Core Values</span></h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="glass p-8 rounded-3xl text-center">
                    <i class="fas fa-shield-halved text-5xl text-cyan-500 mb-6"></i>
                    <h3 class="text-xl font-bold mb-3">Integrity</h3>
                    <p class="text-gray-400 text-sm">We believe in ethical practices and transparency in everything we do.</p>
                </div>
                <div class="glass p-8 rounded-3xl text-center">
                    <i class="fas fa-users-gear text-5xl text-cyan-500 mb-6"></i>
                    <h3 class="text-xl font-bold mb-3">Empowerment</h3>
                    <p class="text-gray-400 text-sm">Education is power — we make complex topics simple for everyone.</p>
                </div>
                <div class="glass p-8 rounded-3xl text-center">
                    <i class="fas fa-infinity text-5xl text-cyan-500 mb-6"></i>
                    <h3 class="text-xl font-bold mb-3">Innovation</h3>
                    <p class="text-gray-400 text-sm">Constantly evolving tools and content to stay ahead of threats.</p>
                </div>
                <div class="glass p-8 rounded-3xl text-center">
                    <i class="fas fa-handshake-angle text-5xl text-cyan-500 mb-6"></i>
                    <h3 class="text-xl font-bold mb-3">Community</h3>
                    <p class="text-gray-400 text-sm">We grow stronger together — your voice matters.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. Call to Action -->
    <section class="py-24 bg-gradient-to-b from-black to-[#05070a]">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl md:text-5xl font-black mb-8 uppercase tracking-tighter">
                Join the <span class="text-cyan-500">CyberGuard Family</span>
            </h2>
            <p class="text-gray-400 text-xl mb-12 max-w-3xl mx-auto">
                Whether you're here to learn, contribute, or collaborate — there's a place for you in our mission.
            </p>
            <div class="flex flex-col md:flex-row justify-center gap-6">
                <a href="awareness.html" class="px-10 py-5 bg-cyan-500 text-black font-bold rounded-xl hover:bg-cyan-400 transition-all uppercase tracking-wider">
                    Start Learning
                </a>
                <a href="contact_us.html" class="px-10 py-5 border-2 border-cyan-500 text-cyan-500 font-bold rounded-xl hover:bg-cyan-500 hover:text-black transition-all uppercase tracking-wider">
                    Get in Touch
                </a>
            </div>
        </div>
    </section>

    <!-- Footer Placeholder -->
    <div id="footer-placeholder"></div>

    <script src="script.js"></script>
</body>
</html>
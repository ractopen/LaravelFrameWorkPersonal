<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy My Classmate Inc</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        @php
            $announcement = \App\Models\Announcement::where('is_active', true)->latest()->first();
        @endphp
        @if($announcement)
            <div class="announcement-bar">
                <marquee behavior="scroll" direction="left">{{ $announcement->message }}</marquee>
            </div>
        @endif

        <div class="nav-container">
            <a href="{{ route('shop.index') }}" class="logo">
                Buy My Classmate <span style="position: relative; cursor: pointer;" id="easter-egg-btn" title="???">Inc</span>
            </a>
            
            <nav>
                <ul class="nav-links">
                    <li><a href="{{ route('shop.index') }}">Shop</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                    @auth
                        <li><a href="{{ route('shop.cart') }}">Cart</a></li>
                        @if(Auth::user()->is_admin)
                            <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                        @endif
                        <li>
                            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">Logout</button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @endauth
                    <li>
                        <button id="inbox-toggle" style="background:none; border:none; cursor:pointer; font-size:1.2rem;" title="Inbox">✉️</button>
                    </li>
                    <li>
                        <button id="theme-toggle" style="background:none; border:none; cursor:pointer; font-size:1.2rem;">🌙</button>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')

        <!-- Inbox Sidebar -->
        @php
            $inboxMessages = \App\Models\InboxMessage::latest()->get();
        @endphp
        <div id="inbox-sidebar" style="position: fixed; top: 0; right: -350px; width: 300px; height: 100%; background: var(--surface); border-left: 1px solid var(--border); box-shadow: -2px 0 5px rgba(0,0,0,0.1); transition: right 0.3s ease; z-index: 1000; padding: 2rem; overflow-y: auto;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <h2 style="font-size: 1.5rem; color: var(--primary);">Inbox</h2>
                <button id="inbox-close" style="background: none; border: none; cursor: pointer; font-size: 1.5rem; color: var(--text);">&times;</button>
            </div>
            
            <div id="inbox-list" style="display: flex; flex-direction: column; gap: 1rem;">
                @foreach($inboxMessages as $msg)
                    <div class="inbox-message" data-id="{{ $msg->id }}" style="background: var(--bg); border: 1px solid var(--border); padding: 1rem; border-radius: 0.5rem;">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 0.5rem;">
                            <small style="color: var(--text-light);">{{ $msg->created_at->format('M d, Y') }}</small>
                            <button onclick="dismissMessage({{ $msg->id }})" style="background: none; border: none; cursor: pointer; color: var(--text-light);">&times;</button>
                        </div>
                        <p style="font-size: 0.9rem; color: var(--text);">{{ $msg->message }}</p>
                    </div>
                @endforeach
                @if($inboxMessages->isEmpty())
                    <p style="text-align: center; color: var(--text-light);">No messages.</p>
                @endif
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Buy My Classmate Inc. All rights reserved.</p>
        <p style="font-size: 0.8rem; opacity: 0.5; margin-top: 0.5rem;">Powered by Classmate Commerce Solutions</p>
    </footer>

    <script src="{{ asset('js/effects.js') }}"></script>
    <script>
        const toggleBtn = document.getElementById('theme-toggle');
        const body = document.body;
        const easterEggBtn = document.getElementById('easter-egg-btn');
        const inboxToggle = document.getElementById('inbox-toggle');
        const inboxClose = document.getElementById('inbox-close');
        const inboxSidebar = document.getElementById('inbox-sidebar');
        
        // Theme Logic
        let currentTheme = 'light';
        
        @auth
            currentTheme = "{{ Auth::user()->theme }}";
        @else
            currentTheme = localStorage.getItem('theme') || 'light';
        @endauth

        function applyTheme(theme) {
            if (theme === 'dark') {
                body.classList.add('dark-mode');
                toggleBtn.textContent = '☀️';
            } else {
                body.classList.remove('dark-mode');
                toggleBtn.textContent = '🌙';
            }
            
            // Update Easter Egg if active
            if (localStorage.getItem('easterEggActive') === 'true') {
                updateEasterEgg(theme);
            }
        }

        applyTheme(currentTheme);

        toggleBtn.addEventListener('click', () => {
            const newTheme = body.classList.contains('dark-mode') ? 'light' : 'dark';
            applyTheme(newTheme);
            
            // Save preference
            localStorage.setItem('theme', newTheme);
            
            @auth
                fetch('{{ route("theme.update") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ theme: newTheme })
                });
            @endauth
        });

        // Easter Egg Logic
        function updateEasterEgg(theme) {
            console.log("Updating Easter Egg for theme:", theme);
            
            // Stop both first to be safe
            window.starBg.remove();
            window.sakuraBg.remove();

            if (theme === 'dark') {
                window.starBg.init();
            } else {
                window.sakuraBg.init();
            }
        }

        easterEggBtn.addEventListener('click', (e) => {
            e.preventDefault();
            // Check if it's currently on
            const isActive = localStorage.getItem('easterEggActive') === 'true';
            
            if (isActive) {
                // Turn it off
                window.starBg.remove();
                window.sakuraBg.remove();
                localStorage.setItem('easterEggActive', 'false');
            } else {
                // Turn it on
                // Check the current theme from the body class
                let theme = 'light';
                if (body.classList.contains('dark-mode')) {
                    theme = 'dark';
                }
                
                updateEasterEgg(theme);
                localStorage.setItem('easterEggActive', 'true');
            }
        });
        
        // Restore Easter Egg state on load if it was on
        if (localStorage.getItem('easterEggActive') === 'true') {
            updateEasterEgg(currentTheme);
        }

        // Inbox Logic
        inboxToggle.addEventListener('click', () => {
            inboxSidebar.style.right = '0';
        });

        inboxClose.addEventListener('click', () => {
            inboxSidebar.style.right = '-350px';
        });

        const dismissedMessages = JSON.parse(localStorage.getItem('dismissedMessages') || '[]');
        document.querySelectorAll('.inbox-message').forEach(msg => {
            const id = parseInt(msg.dataset.id);
            if (dismissedMessages.includes(id)) {
                msg.style.display = 'none';
            }
        });

        function dismissMessage(id) {
            const msg = document.querySelector(`.inbox-message[data-id="${id}"]`);
            if (msg) {
                msg.style.display = 'none';
                const dismissed = JSON.parse(localStorage.getItem('dismissedMessages') || '[]');
                if (!dismissed.includes(id)) {
                    dismissed.push(id);
                    localStorage.setItem('dismissedMessages', JSON.stringify(dismissed));
                }
            }
        }
    </script>
</body>
</html>

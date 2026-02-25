<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>alumni-system</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/tab.png') }}">

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #F3F2EF !important; color: #111827; }
        
        .navbar {
            padding: 10px 60px;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-links { display: flex; gap: 30px; align-items: center; }
        .nav-links a { text-decoration: none; color: #111827; font-weight: 500; font-size: 15px; transition: 0.3s; }
        .nav-links a:hover { color: #2563eb; }

        .hero {
            height: 90vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            text-align: center;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.3);
            z-index: 1;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
        }

        .hero-text {
            position: relative;
            z-index: 2;
            color: white;
            max-width: 800px;
            margin: 0 20px;
            text-align: center;
        }

        .hero-text h1 {
            font-size: 64px;
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 20px;
        }

        .hero-text p {
            font-size: 20px;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .login-btn {
            background: #2563eb;
            color: white;
            padding: 14px 30px;
            border-radius: 10px;
            font-weight: 600;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .login-btn:hover { background: #1d4ed8; }

        .features { padding: 80px 40px; text-align: center; background: white; }
        .features h2 { font-size: 36px; font-weight: 700; margin-bottom: 50px; }
        .cards { display: flex; gap: 30px; justify-content: center; flex-wrap: wrap; }
        .card { 
            padding: 40px 30px; 
            width: 300px; 
            border-radius: 12px; 
            box-shadow: 0 5px 20px rgba(0,0,0,0.05); 
            background: white; 
            transition: 0.3s;
            border: 1px solid #f1f5f9;
        }
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .card h3 { font-size: 20px; font-weight: 700; margin-bottom: 15px; }
        .card p { color: #64748b; line-height: 1.6; }

        footer {
            background: #111;
            color: white;
            padding: 40px 20px;
            text-align: center;
        }
        
        @media (max-width: 768px) {
            .navbar { padding: 20px 30px; }
            .hero-text { margin-left: 30px; padding-right: 30px; }
            .hero-text h1 { font-size: 40px; }
            .nav-links { display: none; }
        }
    </style>
</head>
<body class="antialiased bg-[#F3F2EF]">
    <div class="relative min-h-screen bg-[#F3F2EF]">
        
        <!-- Navbar -->
        <header class="navbar">
            <div class="logo">
                <a href="/">
                    <img src="{{ asset('images/logo.png') }}" alt="Connectwork Logo" class="h-12 w-auto">
                </a>
            </div>
            
            <nav class="nav-links">
                <a href="#">Home</a>
                <a href="#about">About</a>
                <a href="#contact">Contact</a>
                <a href="{{ route('login') }}" class="login-btn">Login</a>
            </nav>
        </header>

        <!-- Premium Hero Section -->
        <main class="hero">
            <img src="{{ asset('images/hero-bg.png') }}" alt="Background" class="hero-bg">
            
            <div class="hero-text">
                <h1>Connect.Engage.Grow</h1>
                <p>A platform where students and alumni build meaningful professional connections through opportunities and mentorship.</p>
                <a href="{{ route('login') }}" class="login-btn">Get Started</a>
            </div>
        </main>

        <!-- Why Connectwork? Section -->
        <section class="features" id="about">
            <h2>Why Connectwork?</h2>
            
            <div class="cards">
                <div class="card">
                    <h3>Alumni Network</h3>
                    <p>Connect with successful alumni and learn from their professional journey.</p>
                </div>
                
                <div class="card">
                    <h3>Job Opportunities</h3>
                    <p>Find exclusive internships and career opportunities tailored for you.</p>
                </div>
                
                <div class="card">
                    <h3>Mentorship</h3>
                    <p>Learn directly from experienced professionals in your field of interest.</p>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer id="contact">
            <p>© 2026 Connectwork. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>

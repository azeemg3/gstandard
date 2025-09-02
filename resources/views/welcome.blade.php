<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Money Transfer Landing Page</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar {
            background: #0d6efd;
        }
        .navbar a {
            color: #fff !important;
            font-weight: 500;
        }
        .hero-section {
            text-align: center;
            padding: 60px 20px;
        }
        .hero-section h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .contact-section {
            padding: 60px 20px;
            background: #f9f9f9;
        }
        .contact-section h2 {
            margin-bottom: 30px;
            font-weight: bold;
        }
        footer {
            background: #0d6efd;
            color: #fff;
            text-align: center;
            padding: 15px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand text-white fw-bold" href="#">MoneyTransfer</a>
            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Slider -->
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTcHhTMgKG0FF_SQqBDEAoFoWwvPPa1fESuVA&s" class="d-block w-100" alt="Money Transfer 1" style="height: 500px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Fast & Secure Money Transfers</h1>
                    <p>Send money instantly to your loved ones worldwide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1605902711622-cfb43c4437d1" class="d-block w-100" alt="Money Transfer 2" style="height: 500px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Trusted Global Network</h1>
                    <p>We make money transfers safe and reliable.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1623932686423-8d22d8b4e67b" class="d-block w-100" alt="Money Transfer 3" style="height: 500px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Anytime, Anywhere</h1>
                    <p>Transfer money with just a few clicks.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- About Section -->
    <section class="hero-section">
        <div class="container">
            <h1>Seamless Money Transfer</h1>
            <p class="lead">Experience fast, secure, and hassle-free money transfers. Whether it's for family support, business, or emergencies, we make sure your money reaches safely and quickly across the globe.</p>
        </div>
    </section>

    <!-- Contact Form -->
    <section id="contact" class="contact-section">
        <div class="container">
            <h2 class="text-center">Contact Us</h2>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Your Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Your Message</label>
                            <textarea name="message" rows="4" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; {{ date('Y') }} MoneyTransfer. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

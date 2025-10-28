<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Despre noi - Bijuterii din Perle Naturale</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f9f9f9;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
        header {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .top-bar {
            background-color: #f5f5f5;
            padding: 8px 0;
            font-size: 14px;
        }
        
        .top-bar-content {
            display: flex;
            justify-content: space-between;
        }
        
        nav ul {
            display: flex;
            list-style: none;
        }
        
        nav ul li {
            margin-left: 20px;
        }
        
        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        nav ul li a:hover {
            color: #8B7355;
        }
        
        .header-main {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 5px;
            padding-bottom: 5px;
        }
        
        .search-cart {
            display: flex;
            align-items: center;
        }
        
        .search-box {
            position: relative;
            margin-right: 20px;
        }
        
        .search-box input {
            padding: 8px 15px;
            border: 1px solid #ddd;
            border-radius: 20px;
            width: 200px;
        }
        
        .search-box button {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #8B7355;
            cursor: pointer;
        }
        
        .cart-icon {
            position: relative;
            font-size: 20px;
            color: #333;
            text-decoration: none;
        }
        
        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #8B7355;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .page-hero {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 80px 20px;
            margin-bottom: 40px;
        }
        
        .page-hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }
        
        .page-hero p {
            font-size: 20px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .about-section {
            padding: 60px 0;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 40px;
            font-size: 32px;
            color: #333;
        }
        
        .about-content {
            display: flex;
            align-items: center;
            gap: 40px;
            margin-bottom: 60px;
        }
        
        .about-text {
            flex: 1;
        }
        
        .about-text p {
            margin-bottom: 20px;
            font-size: 16px;
        }
        
        .about-image {
            flex: 1;
            height: 400px;
            background-size: cover;
            background-position: center;
            border-radius: 10px;
        }
        
        .btn {
            display: inline-block;
            background-color: #8B7355;
            color: white;
            padding: 12px 30px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        
        .btn:hover {
            background-color: #6d5c46;
        }
        
        .values {
            background-color: white;
            padding: 60px 0;
        }
        
        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }
        
        .value-card {
            text-align: center;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
        }
        
        .value-card:hover {
            transform: translateY(-5px);
        }
        
        .value-icon {
            font-size: 40px;
            color: #8B7355;
            margin-bottom: 20px;
        }
        
        .value-card h3 {
            margin-bottom: 15px;
            color: #333;
        }
        
        footer {
            background-color: #333;
            color: white;
            padding: 60px 0 20px;
            margin-top: 50px;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }
        
        .footer-column h3 {
            margin-bottom: 20px;
            font-size: 18px;
        }
        
        .footer-column ul {
            list-style: none;
        }
        
        .footer-column ul li {
            margin-bottom: 10px;
        }
        
        .footer-column ul li a {
            color: #ddd;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-column ul li a:hover {
            color: #8B7355;
        }
        
        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .social-icons a {
            color: white;
            font-size: 20px;
            transition: color 0.3s;
        }
        
        .social-icons a:hover {
            color: #8B7355;
        }
        
        .copyright {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #444;
            font-size: 14px;
        }
        
        @media (max-width: 768px) {
            .header-main {
                flex-direction: column;
            }
            
            nav ul {
                margin-top: 15px;
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .search-box input {
                width: 150px;
            }
            
            .page-hero h1 {
                font-size: 36px;
            }
            
            .page-hero p {
                font-size: 18px;
            }
            
            .about-content {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
<header>
    <div class="top-bar">
        <div class="container top-bar-content">
            <div class="contact-info">
                <i class="fas fa-phone"></i> 0724 747 853 | <i class="fas fa-envelope"></i> luna.pearlph@gmail.com
            </div>
            <div class="auth-links">
                <?php if(isset($_SESSION['user'])): ?>
                    <span>Bun venit, <?php echo htmlspecialchars($_SESSION['user']); ?></span> | 
                    <a href="logout.php">Deconectare</a>
                <?php else: ?>
                    <a href="login.php">Autentificare</a> | 
                    <a href="register.php">Înregistrare</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="container header-main">
        <a href="index.php" class="logo">
            <img src="alte_poze/logo_luna_pearl.jpg" alt="Luna Pearl" style="height: 150px;">
        </a>
        
        <nav style="font-size: 25px;">
            <ul>
                <li><a href="index.php">Acasă</a></li>
                <li><a href="produse.php">Produse</a></li>
                <li><a href="despre.php">Despre noi</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
        
        <div class="search-cart">
            <div class="search-box">
                <input type="text" placeholder="Caută produse...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <a href="cos.php" class="cart-icon">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-count">
                    <?php 
                    if(isset($_SESSION['user_id'])) {
                        require 'config.php';
                        require 'functions.php';
                        echo getCartCount();
                    } else {
                        echo '0';
                    }
                    ?>
                </span>
            </a>
        </div>
    </div>
</header>

    <!-- Hero Section -->
    <section class="page-hero">
        <div class="container">
            <h1>Despre noi</h1>
            <p>Află mai multe despre povestea noastră și pasiunea pentru bijuterii din perle naturale</p>
        </div>
    </section>

    <!-- Despre noi -->
    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2 class="section-title">Povestea noastră</h2>
                    <p>Luna Pearl a luat naștere din pasiunea pentru frumos și dorința de a aduce un strop de eleganță naturală în viața de zi cu zi. Înființată în 2015, mica noastră afacere de familie a crescut treptat, devenind un brand recunoscut pentru calitate și rafinament.</p>
                    <p>Fiecare piesă din colecția noastră este creată manual, cu atenție la cele mai mici detalii. Folosim exclusiv perle naturale din Filipine de cea mai bună calitate, provenite din surse sustenabile, asigurându-ne că produsele noastre nu sunt doar frumoase, dar și etice.</p>
                    <p>Design-urile noastre sunt inspirate din frumusețea naturii și tendințele contemporane, creând bijuterii care se potrivesc atât ocaziilor speciale, cât și momentelor de zi cu zi.</p>
                    <a href="produse.php" class="btn">Descoperă colecția</a>
                </div>
                <div class="about-image" style="background-image: url('https://images.unsplash.com/photo-1584302179602-e4819bb92daa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');"></div>
            </div>
            
            <div class="about-content">
                <div class="about-image" style="background-image: url('produse_poze/lant_5_cadru_2.jpg');"></div>
                <div class="about-text">
                    <h2 class="section-title">Misiunea noastră</h2>
                    <p>Misiunea noastră este să aducem bucuria și eleganța bijuteriilor din perle naturale în viețile clienților noștri. Credem că fiecare persoană merită să poarte accesorii unice care să îi evidențieze personalitatea și frumusețea interioară.</p>
                    <p>Ne străduim să oferim nu doar produse de calitate, ci și o experiență de cumpărare memorabilă, de la primul click până la deschiderea coletului. Echipa noastră este mereu disponibilă pentru a vă oferi sfaturi și asistență în alegerea bijuteriilor perfecte.</p>
                    <p>Suntem mândri că bijuteriile noastre sunt create cu pasiune și devotament, iar fiecare piesă poartă o parte din sufletul nostru. Acesta este motivul pentru care garantăm calitatea superioară a fiecărui produs pe care îl oferim.</p>
                    <a href="contact.php" class="btn">Contactează-ne</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Valori -->
    <section class="values">
        <div class="container">
            <h2 class="section-title">Valorile noastre</h2>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-gem"></i>
                    </div>
                    <h3>Calitate</h3>
                    <p>Folosim doar materiale premium și perle naturale din Filipine de cea mai înaltă calitate în toate produsele noastre.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                    <h3>Pasiune</h3>
                    <p>Fiecare piesă este creată cu multă pasiune și atenție la detalii, transformând materialele în bijuterii unice.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3>Sustenabilitate</h3>
                    <p>Ne asigurăm că toate materialele provin din surse sustenabile și că procesul de producție este ecologic.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Comunitate</h3>
                    <p>Creăm o comunitate de iubitori de bijuterii naturale și promovăm artizanatul local și tradițional.</p>
                </div>
            </div>
        </div>
    </section>

    

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>Luna Pearl</h3>
                    <p>Magazin online de bijuterii din perle naturale din Filipine. Calitate, eleganță și rafinament în fiecare piesă.</p>
                    <div class="social-icons">
                        <a href="https://www.instagram.com/luna.pearl.ph?igsh=MW9qazg2c2trbGx3dQ=="><i class="fab fa-instagram"></i></a>
                        <a href="https://www.tiktok.com/@lunapearlph?_t=ZN-90uKYNlwPva&_r=1"><i class="fab fa-tiktok"></i></a>
                        <a href="https://www.facebook.com/share/17ujfxT5tb/"><i class="fab fa-facebook"></i></a>
                    </div>
                </div>
                <div class="footer-column">
                    <h3>Link-uri utile</h3>
                    <ul>
                        <li><a href="index.php">Acasă</a></li>
                        <li><a href="despre.php">Despre noi</a></li>
                        <li><a href="produse.php">Produse</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Informații</h3>
                    <ul>
                        <li><a href="termeni_si_conditii.php">Termeni și condiții</a></li>
                        <li><a href="politica_de_confidentialitate.php">Politica de confidențialitate</a></li>
                        <li><a href="politica_retur.php">Politica de retur</a></li>
                        <li><a href="livrare.php">Livrare</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Contact</h3>
                    <ul>
                        <li><i class="fas fa-map-marker-alt"></i> Intrarea Democrației, Nr. 10, județ Vâlcea, oraș Râmnicu Vâlcea</li>
                        <li><i class="fas fa-phone"></i> 0724 747 853</li>
                        <li><i class="fas fa-envelope"></i> luna.pearlph@gmail.com</li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2025 Luna Pearl. Toate drepturile rezervate.</p>
            </div>
        </div>
    </footer>
</body>
</html>
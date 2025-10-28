<?php
session_start();
require 'config.php';
require 'functions.php';
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Bijuterii din Perle Naturale</title>
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
        
        .contact-section {
            padding: 60px 0;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 40px;
            font-size: 32px;
            color: #333;
        }
        
        .contact-content {
            display: flex;
            gap: 40px;
            margin-bottom: 60px;
        }
        
        .contact-info {
            flex: 1;
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .contact-form {
            flex: 1;
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 30px;
        }
        
        .info-icon {
            font-size: 24px;
            color: #8B7355;
            margin-right: 15px;
            width: 30px;
        }
        
        .info-text h3 {
            margin-bottom: 5px;
            color: #333;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        
        .form-group textarea {
            height: 150px;
            resize: vertical;
        }
        
        .btn {
            display: inline-block;
            background-color: #8B7355;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .btn:hover {
            background-color: #6d5c46;
        }
        
        
        .faq-section {
            padding: 60px 0;
            background-color: white;
        }
        
        .faq-item {
            margin-bottom: 20px;
            border: 1px solid #eee;
            border-radius: 5px;
            overflow: hidden;
        }
        
        .faq-question {
            padding: 20px;
            background-color: #f9f9f9;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 500;
        }
        
        .faq-answer {
            padding: 0 20px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s, padding 0.3s;
        }
        
        .faq-item.active .faq-answer {
            padding: 20px;
            max-height: 500px;
        }
        
        .faq-question i {
            transition: transform 0.3s;
        }
        
        .faq-item.active .faq-question i {
            transform: rotate(180deg);
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
            
            .contact-content {
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
                <div class="contact-info-top">
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
                    <li><a href="contact.php" style="color: #8B7355;">Contact</a></li>
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
            <h1>Contact</h1>
            <p>Suntem aici pentru a vă ajuta și a răspunde la orice întrebări aveți</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <h2 class="section-title">Luați legătura cu noi</h2>
            
            <div class="contact-content">
                <div class="contact-info">
                    <h3>Informații de contact</h3>
                    <p>Nu ezitați să ne contactați folosind informațiile de mai jos sau formularul de contact. Echipa noastră vă va răspunde în cel mai scurt timp posibil.</p>
                    
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="info-text">
                            <h3>Adresă</h3>
                            <p>Intrarea Democratiei, Nr. 10<br>județ Vâlcea, oraș Râmnicu Vâlcea<br>România</p>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="info-text">
                            <h3>Telefon</h3>
                            <p>0724 747 853<br>0774 421 072<br>Luni - Vineri: 08:00 - 20:00</p>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="info-text">
                            <h3>Email</h3>
                            <p>luna.pearlph@gmail.com</p>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="info-text">
                            <h3>Program</h3>
                            <p>Luni - Vineri: 08:00 - 20:00<br>Sâmbătă: 10:00 - 14:00<br>Duminică: Închis</p>
                        </div>
                    </div>
                </div>
                
                <div class="contact-form">
                    <h3>Trimiteți un mesaj</h3>
                    <form id="contactForm">
                        <div class="form-group">
                            <label for="name">Nume complet *</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Adresă email *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Telefon</label>
                            <input type="tel" id="phone" name="phone">
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Subiect *</label>
                            <input type="text" id="subject" name="subject" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Mesaj *</label>
                            <textarea id="message" name="message" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn">Trimite mesaj</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="faq-section">
        <div class="container">
            <h2 class="section-title">Întrebări frecvente</h2>
            
            <div class="faq-list">
                <div class="faq-item">
                    <div class="faq-question">
                        Care este termenul de livrare?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Termenul de livrare standard este de 2-3 zile lucrătoare pentru comenzile din București și 3-5 zile lucrătoare pentru restul țării. Pentru comenzile plasate în weekend, livrarea va începe de luni.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        Oferiți opțiunea de retur?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Da, oferim posibilitatea de retur în termen de 14 zile de la primirea produsului. Produsele trebuie să fie în aceeași stare în care au fost livrate, cu toate etichetele și ambalajele originale.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        Cum pot plăti comanda?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Acceptăm plăți cu cardul (Visa, Mastercard), transfer bancar și ramburs la livrare. Toate plățile online sunt procesate în siguranță prin intermediul unui sistem securizat.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        Produsele sunt din perle naturale?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Da, toate bijuteriile noastre sunt realizate din perle naturale din Filipine de cea mai bună calitate. Fiecare perlă este selecționată manual pentru a asigura frumusețea și durabilitatea produselor finale.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        Cum îngrijesc bijuteriile din perle naturale?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Pentru a vă păstra bijuteriile în stare perfectă, vă recomandăm să le țineți departe de parfumuri, lacuri de păr și produse de curățenie. Curățați-le cu un cârpă moale și uscată și depozitați-le separat pentru a evita zgârieturile.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
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

    <script>
        // Funcționalitate pentru formularul de contact
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Mesajul dvs. a fost trimis cu succes! Vă vom contacta în cel mai scurt timp posibil.');
            this.reset();
        });
        
        // Funcționalitate pentru FAQ
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', function() {
                const item = this.parentElement;
                item.classList.toggle('active');
            });
        });
    </script>
</body>
</html>
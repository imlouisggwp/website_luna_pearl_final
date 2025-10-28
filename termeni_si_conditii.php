<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termeni și Condiții - Luna Pearl</title>
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
        
        .content-section {
            background: white;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 40px;
        }
        
        .section-title {
            color: #8B7355;
            margin-bottom: 30px;
            font-size: 32px;
            text-align: center;
        }
        
        .info-section {
            margin-bottom: 40px;
        }
        
        .info-section h3 {
            color: #333;
            margin-bottom: 15px;
            font-size: 24px;
            border-bottom: 2px solid #8B7355;
            padding-bottom: 10px;
        }
        
        .info-section p {
            margin-bottom: 15px;
            text-align: justify;
        }
        
        .info-section ul {
            margin-left: 30px;
            margin-bottom: 20px;
        }
        
        .info-section li {
            margin-bottom: 10px;
        }
        
        .highlight {
            background: #f9f7f4;
            padding: 20px;
            border-left: 4px solid #8B7355;
            margin: 20px 0;
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
            
            .content-section {
                padding: 30px 20px;
            }
            
            .page-hero h1 {
                font-size: 36px;
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
            <h1>Termeni și Condiții</h1>
            <p>Regulile și condițiile de utilizare a magazinului nostru online</p>
        </div>
    </section>

    <!-- Content -->
    <div class="container">
        <div class="content-section">
            <h2 class="section-title">Termeni și Condiții de Vânzare</h2>
            
            <div class="info-section">
                <h3>1. Prezentare Generală</h3>
                <p>Acest document reprezintă Termenii și Condițiile de utilizare a site-ului www.lunapearl.ro, deținut și operat de Luna Pearl SRL. Prin accesarea și utilizarea acestui site, sunteți de acord cu termenii și condițiile descrise mai jos.</p>
            </div>

            <div class="info-section">
                <h3>2. Informații despre Companie</h3>
                <p><strong>Luna Pearl SRL</strong><br>
                Sediu social: Intrarea Democrației, Nr. 10, Râmnicu Vâlcea, Vâlcea<br>
                CUI: RO12345678<br>
                Nr. Reg. Comerț: J35/1234/2023<br>
                Cont Bancar: RO49BTRL012034567890ABCD<br>
                Telefon: 0724 747 853<br>
                Email: luna.pearlph@gmail.com</p>
            </div>

            <div class="info-section">
                <h3>3. Produse și Prețuri</h3>
                <p>Toate produsele afișate pe site sunt din stoc, iar prețurile sunt exprimate în Lei (RON) și includ TVA.</p>
                <ul>
                    <li>Prețurile pot fi modificate fără preaviz</li>
                    <li>Imaginile produselor sunt prezentative</li>
                    <li>Descrierile produselor sunt furnizate de producător</li>
                    <li>Rezervăm dreptul de a limita cantitățile comandate</li>
                </ul>
            </div>

            <div class="info-section">
                <h3>4. Plasarea Comenzilor</h3>
                <p>Pentru a plasa o comandă, este necesar să:</p>
                <ul>
                    <li>Aveți cont înregistrat pe site</li>
                    <li>Furnizați date de contact valide</li>
                    <li>Selectați o metodă de plată</li>
                    <li>Confirmați comanda</li>
                </ul>
                <div class="highlight">
                    <p><strong>Important:</strong> Comanda este considerată finalizată după primirea email-ului de confirmare.</p>
                </div>
            </div>

            <div class="info-section">
                <h3>5. Metode de Plată</h3>
                <p>Acceptăm următoarele metode de plată:</p>
                <ul>
                    <li>Card bancar (Visa, MasterCard)</li>
                    <li>Ramburs la livrare</li>
                    <li>Transfer bancar</li>
                </ul>
            </div>

            <div class="info-section">
                <h3>6. Livrare</h3>
                <p>Livrarea se face prin:</p>
                <ul>
                    <li>Curier - 15 Lei (2-3 zile lucrătoare)</li>
                    <li>Poșta Română - 10 Lei (3-5 zile lucrătoare)</li>
                    <li>Ridicare personală - Gratis</li>
                </ul>
            </div>

            <div class="info-section">
                <h3>7. Retururi și Rambursări</h3>
                <p>Conform Legii 449/2003, aveți dreptul la retur în 14 zile de la primirea produsului.</p>
                <ul>
                    <li>Produsele trebuie să fie în stare originală</li>
                    <li>Ambalajul trebuie să fie intact</li>
                    <li>Costurile de retur sunt suportate de client</li>
                    <li>Rambursarea se face în 14 zile de la primirea produsului returnat</li>
                </ul>
            </div>

            <div class="info-section">
                <h3>8. Confidențialitate</h3>
                <p>Protecția datelor dvs. personale este importantă pentru noi. Toate datele sunt procesate în conformitate cu Regulamentul GDPR.</p>
            </div>

            <div class="info-section">
                <h3>9. Drepturi de Autor</h3>
                <p>Conținutul site-ului (imagini, texte, design) este protejat de drepturile de autor și nu poate fi reprodus fără acordul nostru scris.</p>
            </div>

            <div class="info-section">
                <h3>10. Contact</h3>
                <p>Pentru orice întrebări legate de acești termeni și condiții, vă rugăm să ne contactați la luna.pearlph@gmail.com sau 0724 747 853.</p>
            </div>

            <div class="highlight">
                <p><strong>Ultima actualizare:</strong> 01 Decembrie 2024</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>Luna Pearl</h3>
                    <p>Magazin online de bijuterii din perle naturale din Filipine. Calitate, eleganță și rafinament în fiecare piesă.</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-pinterest-p"></i></a>
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
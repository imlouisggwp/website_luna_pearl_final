<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Politica de Confidențialitate - Luna Pearl</title>
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

    <section class="page-hero">
        <div class="container">
            <h1>Politica de Confidențialitate</h1>
            <p>Cum protejăm și utilizăm datele dvs. personale</p>
        </div>
    </section>

    <div class="container">
        <div class="content-section">
            <h2 class="section-title">Politica de Confidențialitate și Protecția Datelor</h2>
            
            <div class="info-section">
                <h3>1. Preambul</h3>
                <p>Această Politică de Confidențialitate descrie modul în care Luna Pearl SRL colectează, utilizează și protejează informațiile personale ale utilizatorilor site-ului nostru, în conformitate cu Regulamentul General privind Protecția Datelor (GDPR).</p>
            </div>

            <div class="info-section">
                <h3>2. Datele pe care le colectăm</h3>
                <p><strong>Date de identificare:</strong></p>
                <ul>
                    <li>Nume și prenume</li>
                    <li>Adresă de email</li>
                    <li>Număr de telefon</li>
                    <li>Adresă de livrare/facturare</li>
                </ul>
                
                <p><strong>Date de plată:</strong></p>
                <ul>
                    <li>Informații de plată (procesate securizat prin intermediul procesatorilor de plăți)</li>
                    <li>Istoric tranzacții</li>
                </ul>
                
                <p><strong>Date tehnice:</strong></p>
                <ul>
                    <li>Adresă IP</li>
                    <li>Tip browser și dispozitiv</li>
                    <li>Date de utilizare a site-ului</li>
                </ul>
            </div>

            <div class="info-section">
                <h3>3. Scopul colectării datelor</h3>
                <p>Folosim datele dvs. personale pentru:</p>
                <ul>
                    <li>Procesarea și livrarea comenzilor</li>
                    <li>Comunicarea privind comenzile</li>
                    <li>Îmbunătățirea serviciilor noastre</li>
                    <li>Marketing (doar cu acordul dvs. explicit)</li>
                    <li>Conformarea cu obligațiile legale</li>
                </ul>
            </div>

            <div class="info-section">
                <h3>4. Baza legală pentru prelucrare</h3>
                <p>Prelucrarea datelor dvs. se bazează pe:</p>
                <ul>
                    <li><strong>Executarea contractului:</strong> pentru procesarea comenzilor</li>
                    <li><strong>Consimțământul:</strong> pentru marketing și newsletter</li>
                    <li><strong>Interesul legitim:</strong> pentru îmbunătățirea serviciilor</li>
                    <li><strong>Obligația legală:</strong> pentru facturare și contabilitate</li>
                </ul>
            </div>

            <div class="info-section">
                <h3>5. Partajarea datelor</h3>
                <p>Putem partaja datele dvs. cu:</p>
                <ul>
                    <li><strong>Furnizori de servicii de livrare:</strong> pentru livrarea comenzilor</li>
                    <li><strong>Procesatori de plăți:</strong> pentru procesarea tranzacțiilor</li>
                    <li><strong>Autorități competente:</strong> atunci când este cerut prin lege</li>
                </ul>
                <p>Toți partenerii noștri sunt obligați contractual să protejeze datele dvs.</p>
            </div>

            <div class="info-section">
                <h3>6. Drepturile dvs.</h3>
                <p>Conform GDPR, aveți următoarele drepturi:</p>
                <ul>
                    <li><strong>Dreptul de acces:</strong> să știți ce date avem despre dvs.</li>
                    <li><strong>Dreptul la rectificare:</strong> să corectați datele inexacte</li>
                    <li><strong>Dreptul la ștergere:</strong> să ștergem datele dvs.</li>
                    <li><strong>Dreptul la restricționare:</strong> să limităm prelucrarea</li>
                    <li><strong>Dreptul la portabilitate:</strong> să primiți datele într-un format portabil</li>
                    <li><strong>Dreptul de opoziție:</strong> să vă opuneți anumitor prelucrări</li>
                </ul>
            </div>

            <div class="info-section">
                <h3>7. Securitatea datelor</h3>
                <p>Am implementat măsuri tehnice și organizaționale pentru a proteja datele dvs.:</p>
                <ul>
                    <li>Criptare SSL pentru toate transmisiile</li>
                    <li>Stocare securizată a datelor</li>
                    <li>Acces restricționat la date</li>
                    <li>Monitorizare continuă a securității</li>
                </ul>
            </div>

            <div class="info-section">
                <h3>8. Păstrarea datelor</h3>
                <p>Păstrăm datele dvs. doar atât timp cât este necesar:</p>
                <ul>
                    <li>Date de comandă: 10 ani (conform legii contabile)</li>
                    <li>Date de marketing: până la retragerea consimțământului</li>
                    <li>Date de contact: până la cererea de ștergere</li>
                </ul>
            </div>

            <div class="info-section">
                <h3>9. Cookie-uri</h3>
                <p>Folosim cookie-uri pentru:</p>
                <ul>
                    <li>Funcționalitatea site-ului</li>
                    <li>Analiza traficului</li>
                    <li>Personalizarea experienței</li>
                    <li>Publicitate relevantă</li>
                </ul>
                <p>Puteți controla cookie-urile din setările browser-ului.</p>
            </div>

            <div class="info-section">
                <h3>10. Contact pentru protecția datelor</h3>
                <p>Pentru exercitarea drepturilor sau pentru întrebări legate de protecția datelor, contactați:</p>
                <p><strong>Responsabil cu protecția datelor:</strong><br>
                Email: dpo@lunapearl.ro<br>
                Telefon: 0724 747 853</p>
            </div>

            <div class="highlight">
                <p><strong>Ultima actualizare:</strong> 01 Decembrie 2024</p>
                <p>Vă încurajăm să consultați periodic această politică, deoarece ea poate suferi modificări.</p>
            </div>
        </div>
    </div>

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
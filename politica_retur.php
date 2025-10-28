<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Politica de Retur - Luna Pearl</title>
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

    <!-- Hero Section -->
    <section class="page-hero">
        <div class="container">
            <h1>Politica de Retur</h1>
            <p>Condiții și proceduri pentru returnarea produselor</p>
        </div>
    </section>

    <!-- Content -->
    <div class="container">
        <div class="content-section">
            <h2 class="section-title">Politica de Retur și Rambursare</h2>
            
            <div class="info-section">
                <h3>1. Dreptul la Retur</h3>
                <p>Conform Ordonanței Guvernului nr. 34/2014 și Legii 449/2003, beneficiați de o perioadă de retur de <strong>14 zile calendaristice</strong> de la data primirii produsului.</p>
                <div class="highlight">
                    <p><strong>Important:</strong> Acest drept se aplică doar produselor achiziționate de la distanță (online).</p>
                </div>
            </div>

            <div class="info-section">
                <h3>2. Condiții pentru Retur</h3>
                <p>Pentru ca un produs să fie returnat, trebuie să îndeplinească următoarele condiții:</p>
                <ul>
                    <li>Produsul să nu fi fost folosit</li>
                    <li>Etichetele originale să fie atașate</li>
                    <li>Ambalajul original să fie intact</li>
                    <li>Toate accesoriile să fie incluse</li>
                    <li>Formularul de retur să fie completat corect</li>
                </ul>
            </div>

            <div class="info-section">
                <h3>3. Produse care nu pot fi returnate</h3>
                <p>Nu acceptăm returnarea următoarelor categorii de produse:</p>
                <ul>
                    <li>Produse personalizate</li>
                    <li>Produse desigilate din categoria bijuteriilor intime</li>
                    <li>Produse deteriorate din vina clientului</li>
                    <li>Produse care nu mai au etichetele originale</li>
                </ul>
            </div>

            <div class="info-section">
                <h3>4. Procedura de Retur</h3>
                <p><strong>Pasul 1:</strong> Notificați-ne intenția de retur</p>
                <ul>
                    <li>Trimiteți email la luna.pearlph@gmail.com</li>
                    <li>Menționați numărul comenzii și motivul returului</li>
                    <li>Așteptați confirmarea și instrucțiunile noastre</li>
                </ul>

                <p><strong>Pasul 2:</strong> Pregătiți coletul</p>
                <ul>
                    <li>Încărcați produsul în ambalajul original</li>
                    <li>Includeți toate accesoriile și documentele</li>
                    <li>Completați formularul de retur</li>
                </ul>

                <p><strong>Pasul 3:</strong> Expediați coletul</p>
                <ul>
                    <li>Utilizați un serviciu de curierat cu confirmare de primire</li>
                    <li>Păstrați dovada expedierii</li>
                    <li>Notificați-ne cu numărul AWB</li>
                </ul>
            </div>

            <div class="info-section">
                <h3>5. Costurile de retur</h3>
                <p><strong>Retur din motive legale (14 zile):</strong></p>
                <ul>
                    <li>Costurile de transport pentru retur sunt suportate de client</li>
                    <li>Rambursăm doar valoarea produselor returnate</li>
                </ul>

                <p><strong>Retur pentru produse defecte:</strong></p>
                <ul>
                    <li>Toate costurile sunt suportate de noi</li>
                    <li>Vă trimitem eticheta de retur gratuit</li>
                </ul>
            </div>

            <div class="info-section">
                <h3>6. Rambursarea</h3>
                <p>După primirea și verificarea produsului returnat, vom procesa rambursarea în <strong>14 zile lucrătoare</strong>.</p>
                <p><strong>Metode de rambursare:</strong></p>
                <ul>
                    <li>În contul bancar (pentru plăți cu cardul/transfer)</li>
                    <li>Voucher de shopping (la cerere)</li>
                    <li>Contravaloarea rambursului (pentru plăți cash la livrare)</li>
                </ul>
            </div>

            <div class="info-section">
                <h3>7. Schimbul produselor</h3>
                <p>Acceptăm schimbul produselor în următoarele condiții:</p>
                <ul>
                    <li>Produsul solicitat este disponibil în stoc</li>
                    <li>Diferența de preț se achită/se rambursează</li>
                    <li>Toate condițiile de retur sunt respectate</li>
                </ul>
            </div>

            <div class="info-section">
                <h3>8. Produse defecte</h3>
                <p>Dacă primiți un produs defect, contactați-ne imediat:</p>
                <ul>
                    <li>Trimiteți fotografii cu defectele</li>
                    <li>Menționați numărul comenzii</li>
                    <li>Vă vom trimite imediat eticheta de retur gratuită</li>
                </ul>
            </div>

            <div class="info-section">
                <h3>9. Garanția produselor</h3>
                <p>Toate bijuteriile noastre beneficiază de garanție de conformitate:</p>
                <ul>
                    <li><strong>Perioada de garanție:</strong> 12 luni</li>
                    <li><strong>Acoperire:</strong> defecte de material și execuție</li>
                    <li><strong>Exclus:</strong> uzura normală și deteriorări din vina clientului</li>
                </ul>
            </div>

            <div class="info-section">
                <h3>10. Contact pentru retururi</h3>
                <p>Pentru orice întrebări legate de retururi:</p>
                <p><strong>Email:</strong> retur@lunapearl.ro<br>
                <strong>Telefon:</strong> 0724 747 853<br>
                <strong>Program:</strong> Luni-Vineri, 9:00-18:00</p>
            </div>

            <div class="highlight">
                <p><strong>Adresa pentru retururi:</strong><br>
                Luna Pearl SRL<br>
                Intrarea Democrației, Nr. 10<br>
                Râmnicu Vâlcea, Vâlcea, 240014<br>
                Mentionați: "RETUR COMANDA [număr comandă]"</p>
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
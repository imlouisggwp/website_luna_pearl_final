<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livrare - Luna Pearl</title>
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
        
        .shipping-methods {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        
        .shipping-method {
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 25px;
            transition: all 0.3s ease;
        }
        
        .shipping-method:hover {
            border-color: #8B7355;
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .method-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .method-icon {
            font-size: 32px;
            color: #8B7355;
            margin-right: 15px;
        }
        
        .method-title {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }
        
        .method-price {
            font-size: 24px;
            font-weight: bold;
            color: #8B7355;
            margin: 10px 0;
        }
        
        .method-details {
            color: #666;
            line-height: 1.5;
        }
        
        .method-features {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }
        
        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .feature-item i {
            color: #28a745;
            margin-right: 8px;
        }
        
        .timeline {
            display: flex;
            justify-content: space-between;
            margin: 30px 0;
            position: relative;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 2px;
            background: #8B7355;
            z-index: 1;
        }
        
        .timeline-step {
            text-align: center;
            position: relative;
            z-index: 2;
            flex: 1;
        }
        
        .step-number {
            width: 40px;
            height: 40px;
            background: #8B7355;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-weight: bold;
        }
        
        .step-text {
            font-size: 14px;
            color: #666;
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
            
            .shipping-methods {
                grid-template-columns: 1fr;
            }
            
            .timeline {
                flex-direction: column;
                gap: 20px;
            }
            
            .timeline::before {
                display: none;
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
            <h1>Livrare</h1>
            <p>Opțiuni și condiții de livrare pentru comenzile dvs.</p>
        </div>
    </section>

    <!-- Content -->
    <div class="container">
        <div class="content-section">
            <h2 class="section-title">Informații despre Livrare</h2>
            
            <div class="info-section">
                <h3>1. Opțiuni de Livrare</h3>
                <p>Oferim mai multe opțiuni de livrare pentru comoditatea dvs. Alegeți metoda care vă convine cel mai bine:</p>
                
                <div class="shipping-methods">
                    <div class="shipping-method">
                        <div class="method-header">
                            <div class="method-icon">
                                <i class="fas fa-shipping-fast"></i>
                            </div>
                            <div class="method-title">Curier Rapid</div>
                        </div>
                        <div class="method-price">15 Lei</div>
                        <div class="method-details">
                            Livrare rapidă la adresa dvs. în maxim 2-3 zile lucrătoare.
                        </div>
                        <div class="method-features">
                            <div class="feature-item">
                                <i class="fas fa-check"></i>
                                <span>Livrare la adresă</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check"></i>
                                <span>Tracking online</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check"></i>
                                <span>Asigurare inclusă</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check"></i>
                                <span>Toată țara</span>
                            </div>
                        </div>
                    </div>

                    <div class="shipping-method">
                        <div class="method-header">
                            <div class="method-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="method-title">Poșta Română</div>
                        </div>
                        <div class="method-price">10 Lei</div>
                        <div class="method-details">
                            Livrare economică prin Poșta Română în 3-5 zile lucrătoare.
                        </div>
                        <div class="method-features">
                            <div class="feature-item">
                                <i class="fas fa-check"></i>
                                <span>Ridicare din oficiu poștal</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check"></i>
                                <span>Tracking disponibil</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check"></i>
                                <span>Preț accesibil</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check"></i>
                                <span>Toate localitățile</span>
                            </div>
                        </div>
                    </div>

                    <div class="shipping-method">
                        <div class="method-header">
                            <div class="method-icon">
                                <i class="fas fa-store"></i>
                            </div>
                            <div class="method-title">Ridicare Personală</div>
                        </div>
                        <div class="method-price">GRATIS</div>
                        <div class="method-details">
                            Ridicați personal comanda din magazinul nostru.
                        </div>
                        <div class="method-features">
                            <div class="feature-item">
                                <i class="fas fa-check"></i>
                                <span>Niciun cost de transport</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check"></i>
                                <span>Verificare produse la ridicare</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check"></i>
                                <span>Livrare rapidă (1-2 zile)</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check"></i>
                                <span>Consultanță gratuită</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="info-section">
                <h3>2. Procesul de Livrare</h3>
                <p>Iată cum funcționează procesul de livrare de la plasarea comenzii până la primirea coletului:</p>
                
                <div class="timeline">
                    <div class="timeline-step">
                        <div class="step-number">1</div>
                        <div class="step-text">Plasare<br>Comandă</div>
                    </div>
                    <div class="timeline-step">
                        <div class="step-number">2</div>
                        <div class="step-text">Procesare<br>(1-2 zile)</div>
                    </div>
                    <div class="timeline-step">
                        <div class="step-number">3</div>
                        <div class="step-text">Expediere</div>
                    </div>
                    <div class="timeline-step">
                        <div class="step-number">4</div>
                        <div class="step-text">Livrare</div>
                    </div>
                    <div class="timeline-step">
                        <div class="step-number">5</div>
                        <div class="step-text">Primire<br>Colet</div>
                    </div>
                </div>
            </div>

            <div class="info-section">
                <h3>3. Termene de Livrare</h3>
                <p><strong>Procesarea comenzii:</strong> 1-2 zile lucrătoare de la confirmarea plății</p>
                <p><strong>Livrare efectivă:</strong> în funcție de metoda aleasă</p>
                
                <div class="highlight">
                    <p><strong>Important:</strong> Termenele de livrare sunt estimate și pot fi afectate de factori externi (vreme, trafic, sărbători legale, weekend-uri).</p>
                </div>
                
                <p><strong>Comanda express:</strong> Momentan nu oferim serviciu de livrare express.</p>
            </div>

            <div class="info-section">
                <h3>4. Zona de Livrare</h3>
                <p>Livrăm în toată țara, inclusiv:</p>
                <ul>
                    <li>Toate județele României</li>
                    <li>Zonele rurale și urbane</li>
                    <li>Localitățile mici și satele</li>
                    <li>Insulele de pe Dunăre</li>
                </ul>
                <p><strong>Livrare internațională:</strong> Momentan nu oferim livrare în afara României.</p>
            </div>

            <div class="info-section">
                <h3>5. Costuri de Livrare</h3>
                <p><strong>Livrare gratuită:</strong> Oferim livrare gratuită pentru comenzile peste 300 Lei.</p>
                <p><strong>Costuri standard:</strong></p>
                <ul>
                    <li>Curier Rapid: 15 Lei</li>
                    <li>Poșta Română: 10 Lei</li>
                    <li>Ridicare personală: Gratis</li>
                </ul>
                <p><strong>Reduceri pentru comenzi multiple:</strong> Pentru comenzi de volum mare, vă rugăm să ne contactați pentru un preț negociat.</p>
            </div>

            <div class="info-section">
                <h3>6. Urmărirea Coletului</h3>
                <p>Pentru comenzile livrate prin curier, veți primi:</p>
                <ul>
                    <li>Email de confirmare cu numărul de tracking</li>
                    <li>Notificare SMS cu data estimată de livrare</li>
                    <li>Posibilitatea de a reprograma livrarea</li>
                </ul>
                <p><strong>Link-uri pentru tracking:</strong></p>
                <ul>
                    <li><a href="https://www.fan.ro/" target="_blank">Fan Courier</a></li>
                    <li><a href="https://www.curier.ro/" target="_blank">Cargus</a></li>
                    <li><a href="https://www.posta-romana.ro/" target="_blank">Poșta Română</a></li>
                </ul>
            </div>

            <div class="info-section">
                <h3>7. Primirea Coletului</h3>
                <p>La primirea coletului, vă rugăm să:</p>
                <ul>
                    <li>Verificați integritatea ambalajului</li>
                    <li>Deschideți coletul în prezența curierului</li>
                    <li>Verificați conținutul conform facturii</li>
                    <li>Semnaturați primirea doar dacă totul este în regulă</li>
                </ul>
                <div class="highlight">
                    <p><strong>Atenție:</strong> Dacă coletul prezintă urme de deteriorare sau deschidere, refuzați primirea și contactați-ne imediat.</p>
                </div>
            </div>

            <div class="info-section">
                <h3>8. Probleme la Livrare</h3>
                <p>Dacă întâmpinați probleme la livrare:</p>
                <ul>
                    <li><strong>Colet întârziat:</strong> Verificați tracking-ul și contactați-ne</li>
                    <li><strong>Colet deteriorat:</strong> Refuzați primirea și notificați-ne</li>
                    <li><strong>Produse lipsă:</strong> Contactați-ne în maxim 24 de ore</li>
                    <li><strong>Adresă greșită:</strong> Notificați-ne imediat pentru corectare</li>
                </ul>
            </div>

            <div class="info-section">
                <h3>9. Întrebări Frecvente</h3>
                <p><strong>Î: Pot modifica adresa de livrare după plasarea comenzii?</strong><br>
                R: Da, până la momentul expedierii. Contactați-ne la 0724 747 853.</p>

                <p><strong>Î: Ce se întâmplă dacă nu sunt acasă la livrare?</strong><br>
                R: Curierul va încerca o a doua livrare sau va lasa coletul la un punct de ridicare.</p>

                <p><strong>Î: Livrați și în weekend?</strong><br>
                R: Nu, livrările se fac doar în zile lucrătoare.</p>

                <p><strong>Î: Pot ridica comanda imediat după plasare?</strong><br>
                R: Da, după ce primiți confirmarea că comanda este pregătită.</p>
            </div>

            <div class="info-section">
                <h3>10. Contact pentru Livrări</h3>
                <p>Pentru orice întrebări legate de livrări:</p>
                <p><strong>Email:</strong> livrare@lunapearl.ro<br>
                <strong>Telefon:</strong> 0724 747 853<br>
                <strong>Program suport livrări:</strong> Luni-Vineri, 9:00-18:00<br>
                <strong>Adresă ridicare personală:</strong> Intrarea Democrației, Nr. 10, Râmnicu Vâlcea</p>
            </div>

            <div class="highlight">
                <p><strong>Ultima actualizare:</strong> 01 Decembrie 2024</p>
                <p>Ne străduim să vă oferim cea mai bună experiență de livrare și suntem mereu disponibili pentru a vă ajuta!</p>
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
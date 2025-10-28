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
    <title>Bijuterii din Perle Naturale | Magazin Online</title>
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
        
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 100px 20px;
            margin-bottom: 40px;
        }
        
        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }
        
        .hero p {
            font-size: 20px;
            margin-bottom: 30px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
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
        
        .categories {
            padding: 40px 0;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 40px;
            font-size: 32px;
            color: #333;
        }
        
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .category-card {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        
        .category-card:hover {
            transform: translateY(-5px);
        }
        
        .category-img {
            height: 200px;
            background-size: cover;
            background-position: center;
        }
        
        .category-content {
            padding: 20px;
            text-align: center;
        }
        
        .category-content h3 {
            margin-bottom: 10px;
            color: #8B7355;
        }
        
        .popular-products {
            padding: 40px 0;
            background-color: #f5f5f5;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }
        
        .product-card {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
        }
        
        .product-img {
            height: 250px;
            background-size: cover;
            background-position: center;
        }
        
        .product-content {
            padding: 20px;
        }
        
        .product-title {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }
        
        .product-price {
            font-size: 20px;
            font-weight: bold;
            color: #8B7355;
            margin-bottom: 15px;
        }
        
        .product-rating {
            color: #ffc107;
            margin-bottom: 15px;
        }
        
        .add-to-cart {
            background-color: #8B7355;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        
        .add-to-cart:hover {
            background-color: #6d5c46;
        }
        
        .about {
            padding: 60px 0;
            background-color: white;
        }
        
        .about-content {
            display: flex;
            align-items: center;
            gap: 40px;
        }
        
        .about-text {
            flex: 1;
        }
        
        .about-image {
            flex: 1;
            height: 400px;
            background-size: cover;
            background-position: center;
            border-radius: 10px;
        }
        
        .newsletter {
            background-color: #8B7355;
            color: white;
            padding: 60px 0;
            text-align: center;
        }
        
        .newsletter h2 {
            margin-bottom: 20px;
        }
        
        .newsletter p {
            max-width: 600px;
            margin: 0 auto 30px;
        }
        
        .newsletter-form {
            display: flex;
            max-width: 500px;
            margin: 0 auto;
        }
        
        .newsletter-form input {
            flex: 1;
            padding: 12px 15px;
            border: none;
            border-radius: 30px 0 0 30px;
        }
        
        .newsletter-form button {
            background-color: #333;
            color: white;
            border: none;
            padding: 0 25px;
            border-radius: 0 30px 30px 0;
            cursor: pointer;
            font-weight: bold;
        }
        
        footer {
            background-color: #333;
            color: white;
            padding: 60px 0 20px;
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
            
            .hero h1 {
                font-size: 36px;
            }
            
            .hero p {
                font-size: 18px;
            }
            
            .about-content {
                flex-direction: column;
            }
            
            .newsletter-form {
                flex-direction: column;
            }
            
            .newsletter-form input {
                border-radius: 30px;
                margin-bottom: 10px;
            }
            
            .newsletter-form button {
                border-radius: 30px;
                padding: 12px;
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

    <section class="hero">
        <div class="container">
            <h1>Bijuterii din perle naturale din Filipine</h1>
            <p>Descoperă colecția noastră exclusivă de bijuterii create manual din perle naturale din Filipine. Eleganță și rafinament în fiecare detaliu.</p>
            <a href="produse.php" class="btn">Descoperă colecția</a>
        </div>
    </section>

    <section class="categories">
        <div class="container">
            <h2 class="section-title">Categorii de produse</h2>
            <div class="categories-grid">
                <div class="category-card">
                    <div class="category-img" style="background-image: url('produse_poze_cadru1/colier_1_cadru_1.jpg');"></div>
                    <div class="category-content">
                        <h3>Coliere</h3>
                        <p>Coliere elegante din perle naturale</p>
                    </div>
                </div>
                <div class="category-card">
                    <div class="category-img" style="background-image: url('produse_poze_cadru1/cercei_1_cadru_1.jpg');"></div>
                    <div class="category-content">
                        <h3>Cercei</h3>
                        <p>Cercei rafinați pentru orice ocazie</p>
                    </div>
                </div>
                <div class="category-card">
                    <div class="category-img" style="background-image: url('produse_poze_cadru1/bratara_1_cadru_1.jpg');"></div>
                    <div class="category-content">
                        <h3>Bratări</h3>
                        <p>Bratări unice din perle naturale</p>
                    </div>
                </div>
                <div class="category-card">
                    <div class="category-img" style="background-image: url('produse_poze_cadru1/lant_1_cadru_1.jpg');"></div>
                    <div class="category-content">
                        <h3>Lanțuri</h3>
                        <p>Lanțuri de calitate</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="popular-products">
        <div class="container">
            <h2 class="section-title">Produse populare</h2>
            <div class="products-grid">
                <?php
                $produse_populare = $conn->query("
                    SELECT p.*, 
                           (SELECT imagine FROM imagini_produse WHERE produs_id = p.id ORDER BY ordine LIMIT 1) as imagine_principala
                    FROM produse p 
                    ORDER BY p.rating DESC 
                    LIMIT 4
                ");
                
                while($produs = $produse_populare->fetch_assoc()):
                    $imagine_principala = !empty($produs['imagine_principala']) ? $produs['imagine_principala'] : getImaginePrincipala($produs['id']);
                ?>
                <div class="product-card">
                    <a href="produs.php?id=<?php echo $produs['id']; ?>" class="product-link" style="text-decoration: none; color: inherit;">
                        <div class="product-img" style="background-image: url('<?php echo $imagine_principala; ?>');"></div>
                    </a>
                    <div class="product-content">
                        <a href="produs.php?id=<?php echo $produs['id']; ?>" class="product-link" style="text-decoration: none; color: inherit;">
                            <h3 class="product-title"><?php echo htmlspecialchars($produs['nume']); ?></h3>
                        </a>
                        <div class="product-rating">
                            <?php
                            $rating = $produs['rating'];
                            for($i = 1; $i <= 5; $i++):
                                if($i <= floor($rating)): ?>
                                    <i class="fas fa-star"></i>
                                <?php elseif($i == ceil($rating) && $rating != floor($rating)): ?>
                                    <i class="fas fa-star-half-alt"></i>
                                <?php else: ?>
                                    <i class="far fa-star"></i>
                                <?php endif;
                            endfor; ?>
                        </div>
                        <div class="product-price"><?php echo $produs['pret']; ?> Lei</div>
                        <button class="add-to-cart" onclick="adaugaInCos(<?php echo $produs['id']; ?>, event)">Adaugă în coș</button>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <section class="about">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2 class="section-title">Despre noi</h2>
                    <p>Suntem pasionați de crearea de bijuterii unice din perle naturale. Fiecare piesă este creată manual cu atenție la detalii, asigurând calitate și durabilitate.</p>
                    <p>Perlele noastre provin din Filipine, din surse sustenabile, iar design-urile noastre sunt inspirate din frumusețea naturii și tendințele contemporane.</p>
                    <p>Oferim o gamă variată de bijuterii pentru toate ocaziile, de la accesorii zilnice la piese speciale pentru evenimente importante.</p>
                    <a href="despre.php" class="btn">Află mai multe</a>
                </div>
                <div class="about-image" style="background-image: url('https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');"></div>
            </div>
        </div>
    </section>

    <section class="newsletter">
        <div class="container">
            <h2>Abonează-te la newsletter</h2>
            <p>Primește cele mai recente noutăți și oferte exclusive direct în inbox-ul tău.</p>
            <form class="newsletter-form">
                <input type="email" placeholder="Adresa ta de email" required>
                <button type="submit">Abonează-te</button>
            </form>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>Perle Naturale</h3>
                    <p>Magazin online de bijuterii din perle naturale. Calitate, eleganță și rafinament în fiecare piesă.</p>
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
        function adaugaInCos(idProdus, event) {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            fetch('adauga_cos.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id_produs=' + idProdus
            })
            .then(response => response.text())
            .then(data => {
                if(data === 'success') {
                    alert('Produsul a fost adăugat în coș!');
                    location.reload();
                } else if(data === 'login_required') {
                    if(confirm('Trebuie să fii autentificat pentru a adăuga produse în coș! Dorești să te autentifici?')) {
                        window.location.href = 'login.php';
                    }
                } else {
                    alert('Eroare la adăugarea în coș!');
                }
            })
            .catch(error => {
                console.error('Eroare:', error);
                alert('Eroare la adăugarea în coș!');
            });
        }
        
        document.querySelector('.newsletter-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            alert(`Vă mulțumim pentru abonare! Adresa ${email} a fost înregistrată.`);
            this.reset();
        });
    </script>
</body>
</html>
<?php $conn->close(); ?>
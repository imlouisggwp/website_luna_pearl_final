<?php
session_start();
require 'config.php';
require 'functions.php';

$idProdus = $_GET['id'] ?? 0;

if (!$idProdus) {
    header('Location: produse.php');
    exit;
}

$produs = getProdusById($idProdus);

if (!$produs) {
    header('Location: produse.php');
    exit;
}

$imagini = getImaginiProdus($idProdus);

$produseSimilare = getProduseSimilare($idProdus, $produs['categorie']);
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $produs['nume']; ?> - Luna Pearl</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f9f9f9; color: #333; line-height: 1.6; }
        .container { width: 100%; max-width: 1200px; margin: 0 auto; padding: 0 15px; }
        
        header { background-color: #fff; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); position: sticky; top: 0; z-index: 1000; }
        .top-bar { background-color: #f5f5f5; padding: 8px 0; font-size: 14px; }
        .top-bar-content { display: flex; justify-content: space-between; }
        nav ul { display: flex; list-style: none; }
        nav ul li { margin-left: 20px; }
        nav ul li a { text-decoration: none; color: #333; font-weight: 500; transition: color 0.3s; }
        nav ul li a:hover { color: #8B7355; }
        .header-main { display: flex; justify-content: space-between; align-items: center; padding-top: 5px; padding-bottom: 5px; }
        .search-cart { display: flex; align-items: center; }
        .search-box { position: relative; margin-right: 20px; }
        .search-box input { padding: 8px 15px; border: 1px solid #ddd; border-radius: 20px; width: 200px; }
        .search-box button { position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #8B7355; cursor: pointer; }
        .cart-icon { position: relative; font-size: 20px; color: #333; text-decoration: none; }
        .cart-count { position: absolute; top: -8px; right: -8px; background-color: #8B7355; color: white; border-radius: 50%; width: 18px; height: 18px; font-size: 12px; display: flex; align-items: center; justify-content: center; }
        
        .product-detail {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            margin: 50px 0;
        }
        
        .product-gallery-large {
            position: relative;
        }
        
        .main-image {
            width: 100%;
            height: 500px;
            object-fit: cover;
            border-radius: 10px;
        }
        
        .thumbnail-images {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        
        .thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
            cursor: pointer;
            opacity: 0.6;
            transition: opacity 0.3s;
        }
        
        .thumbnail.active {
            opacity: 1;
            border: 2px solid #8B7355;
        }
        
        .product-info h1 {
            font-size: 32px;
            margin-bottom: 15px;
        }
        
        .product-price {
            font-size: 28px;
            color: #8B7355;
            font-weight: bold;
            margin: 20px 0;
        }
        
        .product-description {
            margin: 20px 0;
            line-height: 1.6;
        }
        
        .quantity-selector {
            margin: 20px 0;
        }
        
        .quantity-selector input {
            width: 60px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        
        .add-to-cart-large {
            background-color: #8B7355;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        
        .add-to-cart-large:hover {
            background-color: #6d5c46;
        }

        .similar-products {
            margin-top: 80px;
        }

        .similar-products h2 {
            font-size: 28px;
            margin-bottom: 30px;
            color: #333;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
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

        .product-price-card {
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
        
        footer { background-color: #333; color: white; padding: 60px 0 20px; margin-top: 50px; }
        .footer-content { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 40px; margin-bottom: 40px; }
        .footer-column h3 { margin-bottom: 20px; font-size: 18px; }
        .footer-column ul { list-style: none; }
        .footer-column ul li { margin-bottom: 10px; }
        .footer-column ul li a { color: #ddd; text-decoration: none; transition: color 0.3s; }
        .footer-column ul li a:hover { color: #8B7355; }
        .social-icons { display: flex; gap: 15px; margin-top: 20px; }
        .social-icons a { color: white; font-size: 20px; transition: color 0.3s; }
        .social-icons a:hover { color: #8B7355; }
        .copyright { text-align: center; padding-top: 20px; border-top: 1px solid #444; font-size: 14px; }
        
        @media (max-width: 768px) {
            .header-main { flex-direction: column; }
            nav ul { margin-top: 15px; flex-wrap: wrap; justify-content: center; }
            .search-box input { width: 150px; }
            .product-detail { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <header>
        <div class="top-bar">
            <div class="container top-bar-content">
                <div class="contact-info">
                    <i class="fas fa-phone"></i> 0731 234 567 | <i class="fas fa-envelope"></i> contact@lunapearl.ro
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

    <div class="container">
        <div class="product-detail">
            <div class="product-gallery-large">
                <img id="mainImage" src="<?php echo !empty($imagini) ? $imagini[0] : 'imagini/default.jpg'; ?>" alt="<?php echo $produs['nume']; ?>" class="main-image">
                
                <?php if(!empty($imagini)): ?>
                <div class="thumbnail-images">
                    <?php foreach($imagini as $index => $imagine): ?>
                        <img src="<?php echo $imagine; ?>" 
                             alt="<?php echo $produs['nume']; ?> - Imagine <?php echo $index + 1; ?>" 
                             class="thumbnail <?php echo $index === 0 ? 'active' : ''; ?>"
                             onclick="changeMainImage('<?php echo $imagine; ?>', this)">
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="product-info">
                <h1><?php echo $produs['nume']; ?></h1>
                
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
                    <span>(<?php echo $produs['rating']; ?> recenzii)</span>
                </div>
                
                <div class="product-price"><?php echo $produs['pret']; ?> Lei</div>
                
                <div class="product-description">
                    <?php echo $produs['descriere']; ?>
                </div>
                
                <div class="quantity-selector">
                    <label for="quantity">Cantitate:</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1">
                </div>
                
                <button class="add-to-cart-large" onclick="adaugaInCos(<?php echo $produs['id']; ?>)">
                    Adaugă în coș
                </button>
            </div>
        </div>
        
        <?php if($produseSimilare->num_rows > 0): ?>
        <div class="similar-products">
            <h2>Produse similare</h2>
            <div class="products-grid">
                <?php while($produsSimilar = $produseSimilare->fetch_assoc()): ?>
                    <div class="product-card">
                        <a href="produs.php?id=<?php echo $produsSimilar['id']; ?>" class="product-link">
                            <div class="product-img" style="background-image: url('<?php echo $produsSimilar['imagine_principala']; ?>');"></div>
                        </a>
                        <div class="product-content">
                            <a href="produs.php?id=<?php echo $produsSimilar['id']; ?>" class="product-link">
                                <h3 class="product-title"><?php echo $produsSimilar['nume']; ?></h3>
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
                                <?php if(isset($produs['rating']) && $produs['rating'] > 0): ?>
                                    <span>(<?php echo $produs['rating']; ?> recenzii)</span>
                                <?php else: ?>
                                    <span>(Nicio recenzie încă)</span>
                                <?php endif; ?>
                            </div>
                            <div class="product-price-card"><?php echo $produsSimilar['pret']; ?> Lei</div>
                            <button class="add-to-cart" onclick="adaugaInCos(<?php echo $produsSimilar['id']; ?>, event)">
                                Adaugă în coș
                            </button>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
    
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>Perle Naturale</h3>
                    <p>Magazin online de bijuterii din perle naturale. Calitate, eleganță și rafinament în fiecare piesă.</p>
                    <div class="social-icons">
                        <a href="https://www.instagram.com/luna.pearl.ph?igsh=MW9qazg2c2trbGx3dQ=="><i class="fab fa-instagram"></i></a>
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
                        <li><a href="#">Termeni și condiții</a></li>
                        <li><a href="#">Politica de confidențialitate</a></li>
                        <li><a href="#">Politica de retur</a></li>
                        <li><a href="#">Livrare</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Contact</h3>
                    <ul>
                        <li><i class="fas fa-map-marker-alt"></i> Strada Exemplu, Nr. 123, București</li>
                        <li><i class="fas fa-phone"></i> 0731 234 567</li>
                        <li><i class="fas fa-envelope"></i> contact@bijuteriiperle.ro</li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2023 Bijuterii din Perle Naturale. Toate drepturile rezervate.</p>
            </div>
        </div>
    </footer>
    
    <script>
        function changeMainImage(src, element) {
            document.getElementById('mainImage').src = src;
            
            document.querySelectorAll('.thumbnail').forEach(thumb => {
                thumb.classList.remove('active');
            });
            
            element.classList.add('active');
        }
        
        function adaugaInCos(idProdus, event = null) {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            const quantity = document.getElementById('quantity') ? document.getElementById('quantity').value : 1;
            
            fetch('adauga_cos.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id_produs=' + idProdus + '&cantitate=' + quantity
            })
            .then(response => response.text())
            .then(data => {
                if(data === 'success') {
                    alert('Produsul a fost adăugat în coș!');
                    location.reload();
                } else if(data === 'login_required') {
                    alert('Trebuie să fii autentificat pentru a adăuga produse în coș!');
                    window.location.href = 'login.php';
                } else {
                    alert('Eroare la adăugarea în coș!');
                }
            });
        }
    </script>
</body>
</html>
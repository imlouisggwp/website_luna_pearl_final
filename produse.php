<?php
session_start();
require 'config.php';
require 'functions.php';

$filtruCategorie = $_GET['categorie'] ?? '';
$filtruPret = $_GET['pret'] ?? '';
$sortare = $_GET['sortare'] ?? 'Sortează după popularitate';
$pagina = $_GET['pagina'] ?? 1;

$produse = getProduse($filtruCategorie, $filtruPret, $sortare, $pagina);
$totalProduse = getTotalProduse($filtruCategorie, $filtruPret);
$totalPagini = ceil($totalProduse / 8);
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produse - Bijuterii din Perle Naturale</title>
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
        
        .filters { background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); margin-bottom: 30px; }
        .filter-group { margin-bottom: 15px; }
        .filter-group h3 { margin-bottom: 10px; color: #8B7355; }
        .filter-options { display: flex; flex-wrap: wrap; gap: 10px; }
        .filter-btn { background-color: #f5f5f5; border: 1px solid #ddd; padding: 8px 15px; border-radius: 20px; cursor: pointer; transition: all 0.3s; text-decoration: none; color: #333; }
        .filter-btn.active { background-color: #8B7355; color: white; border-color: #8B7355; }
        
        .products-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .section-title { font-size: 32px; color: #333; }
        .sort-options select { padding: 8px 15px; border: 1px solid #ddd; border-radius: 5px; }
        .products-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 30px; margin-bottom: 50px; }
        .product-card { background-color: white; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05); transition: transform 0.3s; }
        .product-card:hover { transform: translateY(-5px); }
        .product-content { padding: 20px; }
        .product-title { font-size: 18px; margin-bottom: 10px; color: #333; }
        .product-price { font-size: 20px; font-weight: bold; color: #8B7355; margin-bottom: 15px; }
        .product-rating { color: #ffc107; margin-bottom: 15px; }
        .add-to-cart { background-color: #8B7355; color: white; border: none; padding: 10px 15px; border-radius: 5px; cursor: pointer; width: 100%; font-weight: bold; transition: background-color 0.3s; }
        .add-to-cart:hover { background-color: #6d5c46; }

        .product-gallery {
            position: relative;
            height: 250px;
            overflow: hidden;
            cursor: pointer;
        }

        .product-gallery img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.3s;
        }

        .gallery-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 0 10px;
            transform: translateY(-50%);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .product-gallery:hover .gallery-nav {
            opacity: 1;
        }

        .gallery-nav button {
            background: rgba(255, 255, 255, 0.8);
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .gallery-dots {
            position: absolute;
            bottom: 10px;
            width: 100%;
            display: flex;
            justify-content: center;
            gap: 5px;
        }

        .gallery-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
        }

        .gallery-dot.active {
            background: white;
        }

        .product-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }
        
        .pagination { display: flex; justify-content: center; margin-top: 40px; }
        .pagination a { color: #333; padding: 8px 16px; text-decoration: none; border: 1px solid #ddd; margin: 0 4px; border-radius: 5px; transition: background-color 0.3s; }
        .pagination a.active { background-color: #8B7355; color: white; border-color: #8B7355; }
        .pagination a:hover:not(.active) { background-color: #ddd; }
        
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
            .products-header { flex-direction: column; align-items: flex-start; }
            .sort-options { margin-top: 15px; }
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

    <div class="container">
        <div class="filters">
            <form method="GET" id="filterForm">
                <div class="filter-group">
                    <h3>Categorii</h3>
                    <div class="filter-options">
                        <a href="?" class="filter-btn <?php echo empty($filtruCategorie) ? 'active' : ''; ?>">Toate</a>
                        <a href="?categorie=Coliere" class="filter-btn <?php echo $filtruCategorie == 'Coliere' ? 'active' : ''; ?>">Coliere</a>
                        <a href="?categorie=Cercei" class="filter-btn <?php echo $filtruCategorie == 'Cercei' ? 'active' : ''; ?>">Cercei</a>
                        <a href="?categorie=Bratări" class="filter-btn <?php echo $filtruCategorie == 'Bratări' ? 'active' : ''; ?>">Bratări</a>
                        <a href="?categorie=Lanțuri" class="filter-btn <?php echo $filtruCategorie == 'Lanțuri' ? 'active' : ''; ?>">Lanțuri</a>
                    </div>
                </div>
                <div class="filter-group">
                    <h3>Preț</h3>
                    <div class="filter-options">
                        <a href="?<?php echo http_build_query(array_merge($_GET, ['pret' => ''])); ?>" class="filter-btn <?php echo empty($filtruPret) ? 'active' : ''; ?>">Toate</a>
                        <a href="?<?php echo http_build_query(array_merge($_GET, ['pret' => 'Sub 100 Lei'])); ?>" class="filter-btn <?php echo $filtruPret == 'Sub 100 Lei' ? 'active' : ''; ?>">Sub 100 Lei</a>
                        <a href="?<?php echo http_build_query(array_merge($_GET, ['pret' => '100-200 Lei'])); ?>" class="filter-btn <?php echo $filtruPret == '100-200 Lei' ? 'active' : ''; ?>">100-200 Lei</a>
                        <a href="?<?php echo http_build_query(array_merge($_GET, ['pret' => 'Peste 200 Lei'])); ?>" class="filter-btn <?php echo $filtruPret == 'Peste 200 Lei' ? 'active' : ''; ?>">Peste 200 Lei</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="products-header">
            <h1 class="section-title">Toate produsele</h1>
            <div class="sort-options">
                <form method="GET" id="sortForm">
                    <input type="hidden" name="categorie" value="<?php echo $filtruCategorie; ?>">
                    <input type="hidden" name="pret" value="<?php echo $filtruPret; ?>">
                    <select name="sortare" onchange="this.form.submit()">
                        <option value="Sortează după popularitate" <?php echo $sortare == 'Sortează după popularitate' ? 'selected' : ''; ?>>Sortează după popularitate</option>
                        <option value="Sortează după preț: crescător" <?php echo $sortare == 'Sortează după preț: crescător' ? 'selected' : ''; ?>>Sortează după preț: crescător</option>
                        <option value="Sortează după preț: descrescător" <?php echo $sortare == 'Sortează după preț: descrescător' ? 'selected' : ''; ?>>Sortează după preț: descrescător</option>
                        <option value="Sortează după evaluare" <?php echo $sortare == 'Sortează după evaluare' ? 'selected' : ''; ?>>Sortează după evaluare</option>
                    </select>
                </form>
            </div>
        </div>
        
        <div class="products-grid">
            <?php while($produs = $produse->fetch_assoc()): 
                $imagini = getImaginiProdus($produs['id']);
                $imaginePrincipala = !empty($imagini) ? $imagini[0] : getImaginePrincipala($produs['id']);
            ?>
            <div class="product-card">
                <a href="produs.php?id=<?php echo $produs['id']; ?>" class="product-link">
                    <div class="product-gallery" id="gallery-<?php echo $produs['id']; ?>">
                        <img src="<?php echo $imaginePrincipala; ?>" alt="<?php echo $produs['nume']; ?>" 
                            data-current="0" data-images='<?php echo json_encode($imagini); ?>'>
                        
                        <?php if(count($imagini) > 1): ?>
                        <div class="gallery-nav">
                            <button type="button" onclick="changeImage(<?php echo $produs['id']; ?>, -1, event)">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button type="button" onclick="changeImage(<?php echo $produs['id']; ?>, 1, event)">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                        
                        <div class="gallery-dots">
                            <?php for($i = 0; $i < count($imagini); $i++): ?>
                                <div class="gallery-dot <?php echo $i == 0 ? 'active' : ''; ?>" 
                                    onclick="goToImage(<?php echo $produs['id']; ?>, <?php echo $i; ?>, event)"></div>
                            <?php endfor; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </a>
                
                <div class="product-content">
                    <a href="produs.php?id=<?php echo $produs['id']; ?>" class="product-link">
                        <h3 class="product-title"><?php echo $produs['nume']; ?></h3>
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
                    
                    <button class="add-to-cart" onclick="adaugaInCos(<?php echo $produs['id']; ?>, event)">
                        Adaugă în coș
                    </button>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        
        <?php if($totalPagini > 1): ?>
        <div class="pagination">
            <?php if($pagina > 1): ?>
                <a href="?<?php echo http_build_query(array_merge($_GET, ['pagina' => $pagina - 1])); ?>">&laquo;</a>
            <?php endif; ?>
            
            <?php for($i = 1; $i <= $totalPagini; $i++): ?>
                <a href="?<?php echo http_build_query(array_merge($_GET, ['pagina' => $i])); ?>" 
                   class="<?php echo $i == $pagina ? 'active' : ''; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
            
            <?php if($pagina < $totalPagini): ?>
                <a href="?<?php echo http_build_query(array_merge($_GET, ['pagina' => $pagina + 1])); ?>">&raquo;</a>
            <?php endif; ?>
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
            event.preventDefault();
            event.stopPropagation();
            
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
                    alert('Trebuie să fii autentificat pentru a adăuga produse în coș!');
                    window.location.href = 'login.php';
                } else {
                    alert('Eroare la adăugarea în coș!');
                }
            });
        }

        function changeImage(productId, direction, event) {
            event.preventDefault();
            event.stopPropagation();
            
            const gallery = document.getElementById(`gallery-${productId}`);
            const img = gallery.querySelector('img');
            const images = JSON.parse(img.getAttribute('data-images'));
            let currentIndex = parseInt(img.getAttribute('data-current'));
            
            currentIndex += direction;
            
            if (currentIndex < 0) {
                currentIndex = images.length - 1;
            } else if (currentIndex >= images.length) {
                currentIndex = 0;
            }
            
            img.src = images[currentIndex];
            img.setAttribute('data-current', currentIndex);
            
            updateDots(productId, currentIndex);
        }

        function goToImage(productId, index, event) {
            event.preventDefault();
            event.stopPropagation();
            
            const gallery = document.getElementById(`gallery-${productId}`);
            const img = gallery.querySelector('img');
            const images = JSON.parse(img.getAttribute('data-images'));
            
            img.src = images[index];
            img.setAttribute('data-current', index);
            
            updateDots(productId, index);
        }

        function updateDots(productId, activeIndex) {
            const gallery = document.getElementById(`gallery-${productId}`);
            const dots = gallery.querySelectorAll('.gallery-dot');
            
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === activeIndex);
            });
        }

        document.querySelectorAll('.gallery-nav button, .gallery-dot').forEach(element => {
            element.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
            });
        });
    </script>
</body>
</html>
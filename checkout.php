<?php
session_start();
require 'config.php';
require 'functions.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_SESSION['checkout_data'])) {
    header('Location: cos.php');
    exit;
}

$checkout_data = $_SESSION['checkout_data'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirma_comanda'])) {
    
    $cost_transport = 0;
    switch($checkout_data['metoda_expediere']) {
        case 'curier': $cost_transport = 15; break;
        case 'posta': $cost_transport = 10; break;
        case 'ridicare': $cost_transport = 0; break;
    }
    
    $stmt = $conn->prepare("
        SELECT c.id_produs, p.nume, p.pret, c.cantitate
        FROM cos_cumparaturi c 
        JOIN produse p ON c.id_produs = p.id 
        WHERE c.id_utilizator = ?
    ");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $produse_cos = $stmt->get_result();
    
    $subtotal = 0;
    $produse_comanda = [];
    while($item = $produse_cos->fetch_assoc()) {
        $subtotal_item = $item['pret'] * $item['cantitate'];
        $subtotal += $subtotal_item;
        $produse_comanda[] = $item;
    }
    $total_comanda = $subtotal + $cost_transport;
    
    $numar_comanda = 'LP' . date('Ymd') . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
    
    $stmt = $conn->prepare("
        INSERT INTO comenzi 
        (numar_comanda, id_utilizator, nume_client, email, telefon, adresa, oras, judet, cod_postal, 
         metoda_expediere, metoda_plata, observatii, subtotal, cost_transport, total, status) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'in_asteptare')
    ");
    $stmt->bind_param("sisssssssssiddd", 
        $numar_comanda,
        $_SESSION['user_id'],
        $checkout_data['nume'],
        $checkout_data['email'],
        $checkout_data['telefon'],
        $checkout_data['adresa'],
        $checkout_data['oras'],
        $checkout_data['judet'],
        $checkout_data['cod_postal'],
        $checkout_data['metoda_expediere'],
        $checkout_data['metoda_plata'],
        $checkout_data['observatii'],
        $subtotal,
        $cost_transport,
        $total_comanda
    );
    $stmt->execute();
    $id_comanda = $conn->insert_id;
    
    foreach($produse_comanda as $produs) {
        $stmt = $conn->prepare("
            INSERT INTO comenzi_produse 
            (id_comanda, id_produs, nume_produs, pret, cantitate) 
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->bind_param("iisdi", 
            $id_comanda,
            $produs['id_produs'],
            $produs['nume'],
            $produs['pret'],
            $produs['cantitate']
        );
        $stmt->execute();
    }
    
    $stmt = $conn->prepare("DELETE FROM cos_cumparaturi WHERE id_utilizator = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    
    unset($_SESSION['checkout_data']);
    
    $_SESSION['ultima_comanda'] = $numar_comanda;
    
    header('Location: confirmare_comanda.php?comanda=' . $numar_comanda);
    exit;
}

$stmt = $conn->prepare("
    SELECT c.id_produs, p.nume, p.pret, c.cantitate,
           (SELECT imagine FROM imagini_produse WHERE produs_id = p.id ORDER BY ordine LIMIT 1) as imagine_principala
    FROM cos_cumparaturi c 
    JOIN produse p ON c.id_produs = p.id 
    WHERE c.id_utilizator = ?
");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$produse_cos = $stmt->get_result();

$subtotal = 0;
$cost_transport = 0;
switch($checkout_data['metoda_expediere']) {
    case 'curier': $cost_transport = 15; break;
    case 'posta': $cost_transport = 10; break;
    case 'ridicare': $cost_transport = 0; break;
}

while($item = $produse_cos->fetch_assoc()) {
    $subtotal += $item['pret'] * $item['cantitate'];
}
$total_comanda = $subtotal + $cost_transport;
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizare comandă - Luna Pearl</title>
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

        .checkout-container {
            margin: 40px auto;
            padding: 20px;
        }
        
        .checkout-title {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        
        .checkout-grid {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 30px;
        }
        
        .checkout-section {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        .section-title {
            color: #8B7355;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .info-item {
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
        }
        
        .info-label {
            font-weight: bold;
            color: #666;
        }
        
        .produs-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        
        .produs-img {
            width: 80px;
            height: 80px;
            background-size: cover;
            background-position: center;
            border-radius: 5px;
            margin-right: 15px;
        }
        
        .produs-detalii {
            flex: 1;
        }
        
        .produs-pret {
            font-weight: bold;
            color: #8B7355;
        }
        
        .payment-section {
            background: #f9f7f4;
            padding: 25px;
            border-radius: 10px;
        }
        
        .payment-method {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 15px;
            border: 2px solid #8B7355;
        }
        
        .payment-title {
            font-weight: bold;
            margin-bottom: 10px;
            color: #8B7355;
        }
        
        .payment-instructions {
            font-size: 14px;
            color: #666;
            line-height: 1.5;
        }
        
        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 8px 0;
        }
        
        .summary-total {
            font-weight: bold;
            font-size: 1.2em;
            border-top: 2px solid #ddd;
            padding-top: 15px;
            margin-top: 15px;
        }
        
        .btn {
            background: #8B7355;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            transition: background 0.3s;
        }
        
        .btn:hover {
            background: #6d5c46;
        }
        
        .btn-success {
            background: #28a745;
            width: 100%;
            text-align: center;
            margin-top: 20px;
        }
        
        .btn-success:hover {
            background: #218838;
        }
        
        .btn-secondary {
            background: #6c757d;
        }
        
        .btn-secondary:hover {
            background: #545b62;
        }
        
        .checkout-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }
        
        .security-badge {
            text-align: center;
            margin-top: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 5px;
            border: 1px solid #dee2e6;
        }
        
        .security-badge i {
            color: #28a745;
            margin-right: 8px;
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

    <div class="container checkout-container">
        <h1 class="checkout-title">Finalizare comandă</h1>
        
        <form method="POST">
            <div class="checkout-grid">
                <div>
                    <div class="checkout-section">
                        <h2 class="section-title">Detalii livrare</h2>
                        <div class="info-item">
                            <span class="info-label">Nume:</span>
                            <span><?php echo htmlspecialchars($checkout_data['nume']); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email:</span>
                            <span><?php echo htmlspecialchars($checkout_data['email']); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Telefon:</span>
                            <span><?php echo htmlspecialchars($checkout_data['telefon']); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Adresă:</span>
                            <span><?php echo htmlspecialchars($checkout_data['adresa']); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Oraș:</span>
                            <span><?php echo htmlspecialchars($checkout_data['oras']); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Județ:</span>
                            <span><?php echo htmlspecialchars($checkout_data['judet']); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Cod poștal:</span>
                            <span><?php echo htmlspecialchars($checkout_data['cod_postal']); ?></span>
                        </div>
                    </div>

                    <div class="checkout-section">
                        <h2 class="section-title">Produse în comandă</h2>
                        <?php 
                        $produse_cos->data_seek(0); 
                        while($item = $produse_cos->fetch_assoc()): 
                            $subtotal_item = $item['pret'] * $item['cantitate'];
                        ?>
                        <div class="produs-item">
                            <div class="produs-img" style="background-image: url('<?php echo !empty($item['imagine_principala']) ? $item['imagine_principala'] : 'imagini/default.jpg'; ?>')"></div>
                            <div class="produs-detalii">
                                <h4><?php echo htmlspecialchars($item['nume']); ?></h4>
                                <p>Cantitate: <?php echo $item['cantitate']; ?></p>
                            </div>
                            <div class="produs-pret">
                                <?php echo $subtotal_item; ?> Lei
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>

                <div>
                    <div class="checkout-section payment-section">
                        <h2 class="section-title">Sumar comandă</h2>
                        
                        <div class="summary-item">
                            <span>Subtotal produse:</span>
                            <span><?php echo $subtotal; ?> Lei</span>
                        </div>
                        
                        <div class="summary-item">
                            <span>Transport:</span>
                            <span><?php echo $cost_transport; ?> Lei</span>
                        </div>
                        
                        <div class="summary-item summary-total">
                            <span>Total de plată:</span>
                            <span><?php echo $total_comanda; ?> Lei</span>
                        </div>

                        <div class="payment-method">
                            <div class="payment-title">
                                <?php 
                                $metoda_plata_text = '';
                                switch($checkout_data['metoda_plata']) {
                                    case 'card': $metoda_plata_text = 'Card bancar'; break;
                                    case 'ramburs': $metoda_plata_text = 'Ramburs la livrare'; break;
                                    case 'transfer': $metoda_plata_text = 'Transfer bancar'; break;
                                }
                                echo $metoda_plata_text;
                                ?>
                            </div>
                            
                            <?php if($checkout_data['metoda_plata'] == 'transfer'): ?>
                                <div class="payment-instructions">
                                    <p><strong>Transfer bancar în contul:</strong></p>
                                    <p>Banca: Banca Transilvania</p>
                                    <p>IBAN: RO49 BTRL 0120 3456 7890 ABCD</p>
                                    <p>Beneficiar: Luna Pearl SRL</p>
                                    <p><em>Comanda va fi procesată după confirmarea plății</em></p>
                                </div>
                            <?php elseif($checkout_data['metoda_plata'] == 'ramburs'): ?>
                                <div class="payment-instructions">
                                    <p>Veți plăti <?php echo $total_comanda; ?> Lei la primirea coletului.</p>
                                    <p><em>Asigurați-vă că aveți suma exactă disponibilă.</em></p>
                                </div>
                            <?php else: ?>
                                <div class="payment-instructions">
                                    <p>Veți fi redirecționat către o pagină securizată de plată.</p>
                                    <p><em>Plățile sunt procesate prin intermediul unui sistem securizat.</em></p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <button type="submit" name="confirma_comanda" class="btn btn-success">
                            <i class="fas fa-lock"></i> Confirmă comanda
                        </button>

                        <div class="security-badge">
                            <i class="fas fa-shield-alt"></i>
                            <span>Plăți 100% sigure și criptate</span>
                        </div>
                    </div>

                    <div class="checkout-section">
                        <h2 class="section-title">Informații importante</h2>
                        <div style="font-size: 14px; color: #666;">
                            <p>✓ Factură fiscală inclusă</p>
                            <p>✓ Retur 14 zile conform legii</p>
                            <p>✓ Livrare în 2-5 zile lucrătoare</p>
                            <p>✓ Asistență clienți: 0724 747 853</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="checkout-actions">
                <a href="cos.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Înapoi la coș
                </a>
                <button type="submit" name="confirma_comanda" class="btn btn-success">
                    <i class="fas fa-lock"></i> Confirmă comanda
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('form').addEventListener('submit', function(e) {
                if (!confirm('Sigur doriți să finalizați comanda? Această acțiune nu poate fi anulată.')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>
<?php if(isset($conn)) $conn->close(); ?>
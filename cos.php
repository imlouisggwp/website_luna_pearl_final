<?php
session_start();
require 'config.php';
require 'functions.php';

$cos = [];
$total = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }

    if (isset($_POST['sterge'])) {
        $stmt = $conn->prepare("DELETE FROM cos_cumparaturi WHERE id = ? AND id_utilizator = ?");
        $stmt->bind_param("ii", $_POST['sterge'], $_SESSION['user_id']);
        $stmt->execute();
    } elseif (isset($_POST['actualizeaza'])) {
        foreach ($_POST['cantitate'] as $id_cos => $cantitate) {
            if ($cantitate <= 0) {
                $stmt = $conn->prepare("DELETE FROM cos_cumparaturi WHERE id = ? AND id_utilizator = ?");
                $stmt->bind_param("ii", $id_cos, $_SESSION['user_id']);
            } else {
                $stmt = $conn->prepare("UPDATE cos_cumparaturi SET cantitate = ? WHERE id = ? AND id_utilizator = ?");
                $stmt->bind_param("iii", $cantitate, $id_cos, $_SESSION['user_id']);
            }
            $stmt->execute();
        }
    } elseif (isset($_POST['finalizeaza_comanda'])) {
        $_SESSION['checkout_data'] = [
            'nume' => $_POST['nume'],
            'email' => $_POST['email'],
            'telefon' => $_POST['telefon'],
            'adresa' => $_POST['adresa'],
            'oras' => $_POST['oras'],
            'judet' => $_POST['judet'],
            'cod_postal' => $_POST['cod_postal'],
            'metoda_expediere' => $_POST['metoda_expediere'],
            'metoda_plata' => $_POST['metoda_plata'],
            'observatii' => $_POST['observatii']
        ];
        header('Location: checkout.php');
        exit;
    }
    header('Location: cos.php');
    exit;
}

if (isset($_SESSION['user_id'])) {
    $stmt = $conn->prepare("
        SELECT c.id, p.nume, p.pret, c.cantitate,
               (SELECT imagine FROM imagini_produse WHERE produs_id = p.id ORDER BY ordine LIMIT 1) as imagine_principala
        FROM cos_cumparaturi c 
        JOIN produse p ON c.id_produs = p.id 
        WHERE c.id_utilizator = ?
    ");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $cos = $stmt->get_result();

    $total = 0;
    while($item = $cos->fetch_assoc()) {
        $subtotal = $item['pret'] * $item['cantitate'];
        $total += $subtotal;
    }
    
    $cos->data_seek(0);
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coș de cumpărături - Luna Pearl</title>
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

        .cos-container {
            margin: 40px auto;
            padding: 20px;
        }
        
        .cos-title {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        
        .cos-item {
            display: flex;
            align-items: center;
            background: white;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .cos-item-img {
            width: 100px;
            height: 100px;
            background-size: cover;
            background-position: center;
            border-radius: 5px;
            margin-right: 20px;
        }
        
        .cos-item-details {
            flex: 1;
        }
        
        .cos-item-cantitate {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-right: 20px;
        }
        
        .cos-item-cantitate input {
            width: 60px;
            padding: 5px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        
        .cos-total {
            background: white;
            padding: 30px;
            border-radius: 10px;
            text-align: right;
            font-size: 1.2em;
            font-weight: bold;
            margin-top: 20px;
        }
        
        .btn {
            background: #8B7355;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-left: 10px;
        }
        
        .btn:hover {
            background: #6d5c46;
        }
        
        .btn-danger {
            background: #dc3545;
        }
        
        .btn-danger:hover {
            background: #c82333;
        }
        
        .empty-cart {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 10px;
        }
        
        .login-prompt {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 10px;
            margin: 20px 0;
        }
        
        .cos-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            flex-wrap: wrap;
            margin-top: 15px;
        }
        
        .cos-actions .btn {
            margin-left: 0;
        }
        
        .btn-success {
            background-color: #28a745;
        }
        
        .btn-success:hover {
            background-color: #218838;
        }

        .checkout-form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-top: 20px;
            display: none;
        }

        .checkout-form.active {
            display: block;
        }

        .form-section {
            margin-bottom: 30px;
        }

        .form-section h3 {
            color: #8B7355;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-group textarea {
            height: 80px;
            resize: vertical;
        }

        .form-row {
            display: flex;
            gap: 15px;
        }

        .form-row .form-group {
            flex: 1;
        }

        .payment-methods,
        .shipping-methods {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .payment-method,
        .shipping-method {
            display: flex;
            align-items: center;
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            transition: border-color 0.3s;
        }

        .payment-method:hover,
        .shipping-method:hover {
            border-color: #8B7355;
        }

        .payment-method input,
        .shipping-method input {
            margin-right: 10px;
        }

        .payment-method.active,
        .shipping-method.active {
            border-color: #8B7355;
            background-color: #f9f7f4;
        }

        .method-info {
            flex: 1;
        }

        .method-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .method-description {
            color: #666;
            font-size: 14px;
        }

        .checkout-summary {
            background: #f9f7f4;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .summary-total {
            font-weight: bold;
            font-size: 1.2em;
            border-top: 2px solid #ddd;
            padding-top: 10px;
            margin-top: 10px;
        }

        .toggle-checkout {
            background: #8B7355;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        .toggle-checkout:hover {
            background: #6d5c46;
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

    <div class="container cos-container">
        <h1 class="cos-title">Coșul tău de cumpărături</h1>
        
        <?php if(!isset($_SESSION['user_id'])): ?>
            <div class="login-prompt">
                <h2>Trebuie să fii autentificat pentru a vedea coșul</h2>
                <p>Autentifică-te sau înregistrează-te pentru a adăuga produse în coș.</p>
                <a href="login.php" class="btn">Autentificare</a>
                <a href="register.php" class="btn">Înregistrare</a>
            </div>
        <?php else: ?>
            <form method="POST" id="cosForm">
                <?php if($total > 0): ?>
                    <?php 
                    $total = 0;
                    while($item = $cos->fetch_assoc()): 
                        $subtotal = $item['pret'] * $item['cantitate'];
                        $total += $subtotal;
                    ?>
                    <div class="cos-item">
                        <div class="cos-item-img" style="background-image: url('<?php echo !empty($item['imagine_principala']) ? $item['imagine_principala'] : 'imagini/default.jpg'; ?>')"></div>
                        <div class="cos-item-details">
                            <h3><?php echo htmlspecialchars($item['nume']); ?></h3>
                            <p>Preț: <?php echo $item['pret']; ?> Lei</p>
                            <p>Subtotal: <?php echo $subtotal; ?> Lei</p>
                        </div>
                        <div class="cos-item-cantitate">
                            <label>Cantitate:</label>
                            <input type="number" name="cantitate[<?php echo $item['id']; ?>]" value="<?php echo $item['cantitate']; ?>" min="0">
                        </div>
                        <div class="cos-item-actions">
                            <button type="submit" name="sterge" value="<?php echo $item['id']; ?>" class="btn btn-danger">Șterge</button>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    
                    <div class="cos-total">
                        <p>Total: <?php echo $total; ?> Lei</p>
                        <div class="cos-actions">
                            <button type="submit" name="actualizeaza" class="btn">Actualizează coșul</button>
                            <button type="button" class="btn" onclick="window.location.href='produse.php'">Continuă cumpărăturile</button>
                            <button type="button" class="btn btn-success" id="toggleCheckoutBtn">Finalizează comanda</button>
                        </div>
                    </div>

                    <div class="checkout-form" id="checkoutForm">
                        <h2>Finalizare comandă</h2>
                        
                        <div class="form-section">
                            <h3>Detalii de contact</h3>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="nume">Nume complet *</label>
                                    <input type="text" id="nume" name="nume" required value="<?php echo isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']) : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="telefon">Telefon *</label>
                                <input type="tel" id="telefon" name="telefon" required>
                            </div>
                        </div>

                        <div class="form-section">
                            <h3>Adresă de livrare</h3>
                            <div class="form-group">
                                <label for="adresa">Adresă completă *</label>
                                <input type="text" id="adresa" name="adresa" required placeholder="Stradă, număr, bloc, scară, etaj, apartament">
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="oras">Oraș *</label>
                                    <input type="text" id="oras" name="oras" required>
                                </div>
                                <div class="form-group">
                                    <label for="judet">Județ *</label>
                                    <input type="text" id="judet" name="judet" required>
                                </div>
                                <div class="form-group">
                                    <label for="cod_postal">Cod poștal *</label>
                                    <input type="text" id="cod_postal" name="cod_postal" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <h3>Metoda de expediere</h3>
                            <div class="shipping-methods">
                                <label class="shipping-method">
                                    <input type="radio" name="metoda_expediere" value="curier" required>
                                    <div class="method-info">
                                        <div class="method-title">Curier - 15 Lei</div>
                                        <div class="method-description">Livrare în 2-3 zile lucrătoare</div>
                                    </div>
                                </label>
                                <label class="shipping-method">
                                    <input type="radio" name="metoda_expediere" value="posta" required>
                                    <div class="method-info">
                                        <div class="method-title">Poșta Română - 10 Lei</div>
                                        <div class="method-description">Livrare în 3-5 zile lucrătoare</div>
                                    </div>
                                </label>
                                <label class="shipping-method">
                                    <input type="radio" name="metoda_expediere" value="ridicare" required>
                                    <div class="method-info">
                                        <div class="method-title">Ridicare personală - Gratis</div>
                                        <div class="method-description">Ridicați comanda din magazin</div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="form-section">
                            <h3>Metoda de plată</h3>
                            <div class="payment-methods">
                                <label class="payment-method">
                                    <input type="radio" name="metoda_plata" value="card" required>
                                    <div class="method-info">
                                        <div class="method-title">Card bancar</div>
                                        <div class="method-description">Plăți securizate online</div>
                                    </div>
                                </label>
                                <label class="payment-method">
                                    <input type="radio" name="metoda_plata" value="ramburs" required>
                                    <div class="method-info">
                                        <div class="method-title">Ramburs</div>
                                        <div class="method-description">Plătești la primirea coletului</div>
                                    </div>
                                </label>
                                <label class="payment-method">
                                    <input type="radio" name="metoda_plata" value="transfer" required>
                                    <div class="method-info">
                                        <div class="method-title">Transfer bancar</div>
                                        <div class="method-description">Transfer în contul nostru bancar</div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="form-section">
                            <h3>Observații</h3>
                            <div class="form-group">
                                <label for="observatii">Observații comandă (opțional)</label>
                                <textarea id="observatii" name="observatii" placeholder="Dacă aveți cerințe speciale pentru livrare..."></textarea>
                            </div>
                        </div>

                        <div class="checkout-summary">
                            <h3>Sumar comandă</h3>
                            <div class="summary-item">
                                <span>Subtotal produse:</span>
                                <span><?php echo $total; ?> Lei</span>
                            </div>
                            <div class="summary-item">
                                <span>Transport:</span>
                                <span id="transportCost">0 Lei</span>
                            </div>
                            <div class="summary-item summary-total">
                                <span>Total:</span>
                                <span id="totalFinal"><?php echo $total; ?> Lei</span>
                            </div>
                        </div>

                        <div class="cos-actions">
                            <button type="button" class="btn" id="cancelCheckoutBtn">Înapoi la coș</button>
                            <button type="submit" name="finalizeaza_comanda" class="btn btn-success">Plasează comanda</button>
                        </div>
                    </div>

                <?php else: ?>
                    <div class="empty-cart">
                        <h2>Coșul tău este gol</h2>
                        <p>Începe să adaugi produse din magazinul nostru!</p>
                        <a href="produse.php" class="btn">Vezi produse</a>
                    </div>
                <?php endif; ?>
            </form>
        <?php endif; ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleCheckoutBtn = document.getElementById('toggleCheckoutBtn');
            const cancelCheckoutBtn = document.getElementById('cancelCheckoutBtn');
            const checkoutForm = document.getElementById('checkoutForm');
            const transportCost = document.getElementById('transportCost');
            const totalFinal = document.getElementById('totalFinal');
            const shippingMethods = document.querySelectorAll('input[name="metoda_expediere"]');
            const subtotal = <?php echo $total; ?>;

            toggleCheckoutBtn.addEventListener('click', function() {
                checkoutForm.classList.add('active');
                window.scrollTo({ top: checkoutForm.offsetTop, behavior: 'smooth' });
            });

            cancelCheckoutBtn.addEventListener('click', function() {
                checkoutForm.classList.remove('active');
            });

            shippingMethods.forEach(method => {
                method.addEventListener('change', function() {
                    let cost = 0;
                    switch(this.value) {
                        case 'curier':
                            cost = 15;
                            break;
                        case 'posta':
                            cost = 10;
                            break;
                        case 'ridicare':
                            cost = 0;
                            break;
                    }
                    
                    transportCost.textContent = cost + ' Lei';
                    const total = subtotal + cost;
                    totalFinal.textContent = total + ' Lei';
                });
            });

            document.querySelectorAll('.payment-method, .shipping-method').forEach(method => {
                method.addEventListener('click', function() {
                    const input = this.querySelector('input');
                    input.checked = true;
                    
                    this.parentElement.querySelectorAll('.payment-method, .shipping-method').forEach(sibling => {
                        sibling.classList.remove('active');
                    });
                    
                    this.classList.add('active');
                });
            });
        });
    </script>
</body>
</html>
<?php if(isset($conn)) $conn->close(); ?>
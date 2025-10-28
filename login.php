<?php
session_start();
if(isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

require 'config.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $parola = $_POST['parola'];

    if (empty($email) || empty($parola)) {
        $error = "Toate câmpurile sunt obligatorii!";
    } else {
        $stmt = $conn->prepare("SELECT id, nume, parola FROM utilizatori WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $nume, $parolaHash);
            $stmt->fetch();

            if (password_verify($parola, $parolaHash)) {
                $_SESSION['user'] = $nume;
                $_SESSION['user_id'] = $id;
                $_SESSION['email'] = $email;
                header('Location: index.php');
                exit;
            } else {
                $error = "Parolă incorectă!";
            }
        } else {
            $error = "Nu există cont cu acest email!";
        }
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autentificare - Luna Pearl</title>
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

        .auth-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 40px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .auth-title {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        
        .btn {
            width: 100%;
            background: #8B7355;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        
        .btn:hover {
            background: #6d5c46;
        }
        
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        .auth-links {
            text-align: center;
            margin-top: 20px;
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
                    <a href="login.php">Autentificare</a> | 
                    <a href="register.php">Înregistrare</a>
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
        <div class="auth-container">
            <h2 class="auth-title">Autentificare</h2>
            
            <?php if($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="parola">Parola:</label>
                    <input type="password" id="parola" name="parola" required>
                </div>
                
                <button type="submit" class="btn">Autentificare</button>
            </form>
            
            <div class="auth-links">
                <p>Nu ai cont? <a href="register.php">Înregistrează-te aici</a></p>
            </div>
        </div>
    </div>
</body>
</html>
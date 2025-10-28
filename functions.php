<?php
if (!function_exists('getProduse')) {

function getProduse($filtruCategorie = '', $filtruPret = '', $sortare = '', $pagina = 1, $produsePerPagina = 8) {
    global $conn;
    
    $start = ($pagina - 1) * $produsePerPagina;
    $where = [];
    $params = [];
    $types = '';
    
    if (!empty($filtruCategorie) && $filtruCategorie != 'Toate') {
        $where[] = "categorie = ?";
        $params[] = $filtruCategorie;
        $types .= "s";
    }
    
    if (!empty($filtruPret)) {
        switch($filtruPret) {
            case 'Sub 100 Lei':
                $where[] = "pret < 100";
                break;
            case '100-200 Lei':
                $where[] = "pret BETWEEN 100 AND 200";
                break;
            case 'Peste 200 Lei':
                $where[] = "pret > 200";
                break;
        }
    }
    
    $whereClause = '';
    if (!empty($where)) {
        $whereClause = "WHERE " . implode(" AND ", $where);
    }
    
    switch($sortare) {
        case 'Sortează după preț: crescător':
            $orderBy = "ORDER BY pret ASC";
            break;
        case 'Sortează după preț: descrescător':
            $orderBy = "ORDER BY pret DESC";
            break;
        case 'Sortează după evaluare':
            $orderBy = "ORDER BY rating DESC";
            break;
        default:
            $orderBy = "ORDER BY data_adaugare DESC";
    }
    
    $sql = "SELECT p.*, 
                   (SELECT imagine FROM imagini_produse WHERE produs_id = p.id ORDER BY ordine LIMIT 1) as imagine_principala
            FROM produse p 
            $whereClause 
            $orderBy 
            LIMIT ?, ?";
    
    $params[] = $start;
    $params[] = $produsePerPagina;
    $types .= "ii";
    
    $stmt = $conn->prepare($sql);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    return $stmt->get_result();
}

function getTotalProduse($filtruCategorie = '', $filtruPret = '') {
    global $conn;
    
    $where = [];
    
    if (!empty($filtruCategorie) && $filtruCategorie != 'Toate') {
        $where[] = "categorie = '$filtruCategorie'";
    }
    
    if (!empty($filtruPret)) {
        switch($filtruPret) {
            case 'Sub 100 Lei':
                $where[] = "pret < 100";
                break;
            case '100-200 Lei':
                $where[] = "pret BETWEEN 100 AND 200";
                break;
            case 'Peste 200 Lei':
                $where[] = "pret > 200";
                break;
        }
    }
    
    $whereClause = '';
    if (!empty($where)) {
        $whereClause = "WHERE " . implode(" AND ", $where);
    }
    
    $result = $conn->query("SELECT COUNT(*) as total FROM produse $whereClause");
    return $result->fetch_assoc()['total'];
}

function getCartCount() {
    if (isset($_SESSION['user_id'])) {
        global $conn;
        $stmt = $conn->prepare("SELECT SUM(cantitate) as total FROM cos_cumparaturi WHERE id_utilizator = ?");
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total'] ?? 0;
    }
    return 0;
}

function getImaginiProdus($idProdus) {
    global $conn;
    
    $sql = "SELECT imagine FROM imagini_produse WHERE produs_id = ? ORDER BY ordine";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idProdus);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $imagini = [];
    while($row = $result->fetch_assoc()) {
        $imagini[] = $row['imagine'];
    }
    
    return $imagini;
}

function getProdusById($id) {
    global $conn;
    
    $sql = "SELECT p.*, 
                   (SELECT imagine FROM imagini_produse WHERE produs_id = p.id ORDER BY ordine LIMIT 1) as imagine_principala
            FROM produse p 
            WHERE p.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->fetch_assoc();
}

function getProduseSimilare($idProdus, $categorie, $limit = 4) {
    global $conn;
    
    $sql = "SELECT p.*, 
                   (SELECT imagine FROM imagini_produse WHERE produs_id = p.id ORDER BY ordine LIMIT 1) as imagine_principala
            FROM produse p 
            WHERE p.categorie = ? AND p.id != ? 
            LIMIT ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $categorie, $idProdus, $limit);
    $stmt->execute();
    
    return $stmt->get_result();
}

function getImaginePrincipala($idProdus) {
    global $conn;
    
    $sql = "SELECT imagine FROM imagini_produse WHERE produs_id = ? ORDER BY ordine LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idProdus);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc()['imagine'];
    }
    
    return 'imagini/default.jpg';
}

} 
?>
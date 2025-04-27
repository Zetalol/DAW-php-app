<?php
require_once('Connexio.php');
require_once('Header.php');

// Crear connexió
$connexioObj = new Connexio();
$connexio = $connexioObj->obtenirConnexio();

$error = '';
$missatge = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $descripcio = $_POST['descripcio'];
    $preu = $_POST['preu'];
    $categoria_id = $_POST['categoria_id'];

    if (!empty($nom) && !empty($preu) && !empty($categoria_id)) {
        $stmt = $connexio->prepare("INSERT INTO productes (nom, descripció, preu, categoria_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssdi", $nom, $descripcio, $preu, $categoria_id);

        if ($stmt->execute()) {
            $missatge = "Producte creat correctament.";
        } else {
            $error = "Error en inserir el producte: " . $connexio->error;
        }
        $stmt->close();
    } else {
        $error = "Omple tots els camps obligatoris.";
    }
}

// Consulta per obtenir les categories
$categories = $connexio->query("SELECT id, nom FROM categories");
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Nou Producte</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5" style="margin-bottom: 100px;">
    <h2>Afegir Nou Producte</h2>
    <br>
    <?php if($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php if($missatge): ?>
        <div class="alert alert-success"><?php echo $missatge; ?></div>
    <?php endif; ?>
    <div class="container bg-secondary bg-opacity-10 p-1 rounded mb-4">
        <form class="p-2" method="post" action="Nou.php">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="mb-3">
                <label for="descripcio" class="form-label">Descripció</label>
                <input class="form-control" id="descripcio" name="descripcio" required>
            </div>
            <div class="mb-3">
                <label for="categoria_id" class="form-label">Categoria</label>
                <select class="form-select" id="categoria_id" name="categoria_id" required>
                    <option value="">Selecciona una categoria</option>
                    <?php while($fila = $categories->fetch_assoc()): ?>
                        <option value="<?php echo $fila['id']; ?>"><?php echo htmlspecialchars($fila['nom']); ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="preu" class="form-label">Preu</label>
                <input type="number" step="0.01" class="form-control" id="preu" name="preu" required>
            </div>
        </div>
            <div class="btn-group d-flex">
                <button type="submit" class="btn btn-success">Crear producte</button>
                <a href="Principal.php" class="btn btn-secondary">Tornar enrere</a>
        </form>
    </div>
</div>

<?php require_once('Footer.php'); ?>
</body>
</html>

<?php
$connexio->close();
?>

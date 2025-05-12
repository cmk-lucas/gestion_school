<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=gestion_paiements', 'root', '');  

// Ajouter un paiement
if (isset($_POST['ajouter_paiement'])) {
    $nom = $_POST['nom'];
    $montant = $_POST['montant'];
    $date_paiement = $_POST['date_paiement'];

    $stmt = $pdo->prepare("SELECT id FROM eleves WHERE nom = ?");
    $stmt->execute([$nom]);
    $eleve = $stmt->fetch();

    if (!$eleve) {
        $stmt = $pdo->prepare("INSERT INTO eleves (nom) VALUES (?)");
        $stmt->execute([$nom]);
        $eleve_id = $pdo->lastInsertId();
    } else {
        $eleve_id = $eleve['id'];
    }

    $stmt = $pdo->prepare("INSERT INTO paiements (eleve_id, montant, date_paiement) VALUES (?, ?, ?)");
    $stmt->execute([$eleve_id, $montant, $date_paiement]);
}


function getEleves($pdo) {
    $stmt = $pdo->query("SELECT * FROM eleves");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getPaiements($pdo, $eleve_id) {
    $stmt = $pdo->prepare("SELECT * FROM paiements WHERE eleve_id = ?");
    $stmt->execute([$eleve_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$eleves = getEleves($pdo);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion Paiements Élèves</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
       /* Déclaration des couleurs et variables de thème */
:root {
    --bg-color: #f5f5f5;
    --text-color: #333;
    --card-bg: #fff;
    --accent: #4caf50;
    --dark-bg: #1e1e1e;
    --dark-text: #f0f0f0;
    --primary-color: #4caf50;
    --secondary-color: #2196f3;
    --border-color: #ddd;
    --button-hover: #388e3c;
    --transition-duration: 0.3s;
}

/* Corps de la page */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: var(--bg-color);
    color: var(--text-color);
    margin: 30px;
    transition: background-color var(--transition-duration), color var(--transition-duration);
}

/* Mode sombre */
body.dark-mode {
    background-color: var(--dark-bg);
    color: var(--dark-text);
}

/* Titre principal */
h1, h2 {
    color: var(--text-color);
    text-align: center;
    margin-bottom: 20px;
    font-weight: 600;
    font-size: 2rem;
}

/* Card (boîtes de contenu) */
.card {
    background-color: var(--card-bg);
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    margin-bottom: 25px;
    transition: box-shadow var(--transition-duration);
}

.card:hover {
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
}

/* Buttons */
button {
    background-color: var(--primary-color);
    color: white;
    padding: 12px 20px;
    font-size: 1rem;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color var(--transition-duration);
}

button:hover {
    background-color: var(--button-hover);
}

/* Input et éléments de formulaire */
input, select {
    padding: 12px;
    font-size: 1rem;
    border-radius: 8px;
    border: 1px solid var(--border-color);
    margin-bottom: 15px;
    width: 100%;
    max-width: 300px;
    transition: border-color var(--transition-duration);
}

input:focus, select:focus {
    border-color: var(--secondary-color);
}

/* Mise en page flexible pour les éléments en ligne */
.flex {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    justify-content: center;
    margin-bottom: 30px;
}

/* Section graphique */
.bg-white {
    background-color: var(--card-bg);
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

canvas {
    width: 100%;
    height: 300px;
}

/* Section préformatée pour les factures */
pre {
    white-space: pre-wrap;
    font-family: 'Courier New', Courier, monospace;
    font-size: 1rem;
    color: var(--text-color);
}

/* Mise en forme des petites informations */
.paiement-ligne {
    font-size: 1rem;
    margin-left: 20px;
}

/* Conteneur de filtres par date */
.paiement-actions {
    margin-top: 10px;
}

.paiement-actions button {
    font-size: 14px;
    padding: 8px 15px;
    background-color: var(--secondary-color);
    color: white;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color var(--transition-duration);
}

.paiement-actions button:hover {
    background-color: #1565c0;
}

/* Card spécifique aux filtres et aux informations principales */
.card h2 {
    font-size: 1.5rem;
    margin-bottom: 20px;
    font-weight: 500;
}

.card input {
    max-width: 250px;
}

/* Mode sombre */
body.dark-mode .card {
    background-color: #2c2c2c;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
}

/* Transition pour les boutons de recherche, export et autres actions */
button:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.4);
}

/* Pour la section de recherche d'élève */
#searchInput {
    border-radius: 6px;
    width: 250px;
    margin-top: 10px;
    padding: 10px;
    font-size: 1rem;
    border: 1px solid var(--border-color);
    transition: all 0.3s;
}

#searchInput:focus {
    border-color: var(--secondary-color);
}

/* Tableaux de données ou visualisation (ex : graphiques, factures) */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid var(--border-color);
}

th {
    background-color: var(--primary-color);
    color: white;
}

/* Style mobile */
@media (max-width: 600px) {
    body {
        margin: 15px;
    }

    .flex {
        flex-direction: column;
        align-items: center;
    }

    .paiement-actions {
        text-align: center;
    }

    .card {
        padding: 15px;
    }

    button {
        width: 100%;
        padding: 12px;
        font-size: 1.2rem;
    }

    input, select {
        width: 100%;
    }
}

    </style>
</head>

<body>

    <h1>📋 Gestion des Paiements des Élèves</h1>

    <!-- Formulaire pour ajouter un paiement -->
    <div class="card">
        <h2>💸 Ajouter un Paiement</h2>
        <form method="POST">
            <input list="noms" name="nom" id="nomInput" placeholder="Nom de l'élève" required>
            <datalist id="noms">
                <?php foreach ($eleves as $eleve): ?>
                    <option value="<?= $eleve['nom'] ?>"></option>
                <?php endforeach; ?>
            </datalist>
            <input type="number" name="montant" id="montantInput" placeholder="Montant" required>
            <input type="date" name="date_paiement" id="datePaiement" placeholder="Date du Paiement" required>
            <button type="submit" name="ajouter_paiement">Ajouter</button>
        </form>
    </div>

    <div class="card">
        <h2>📁 Factures et Historique</h2>
        <pre id="facturesText">
            <?php
            foreach ($eleves as $eleve) {
                $paiements = getPaiements($pdo, $eleve['id']);
                $total = array_sum(array_map(function ($p) { return $p['montant']; }, $paiements));
                $reste = 100 - $total;  // Exemple de calcul du reste
                echo "📄 {$eleve['nom']}\n- Total payé : {$total}$\n- Reste : {$reste <= 0 ? 0 : $reste}$\n- Paiements :\n";
                foreach ($paiements as $paiement) {
                    echo "  • {$paiement['montant']}$ ({$paiement['date_paiement']})\n";
                }
                echo "\n";
            }
            ?>
        </pre>
    </div>

    <script>
       
    </script>

</body>

</html>

<?php

// Liste des élèves avec ce qu'ils ont payé
$eleves = [
    ["nom" => "Amina", "paiement" => 100],
    ["nom" => "Kevin", "paiement" => 75],
    ["nom" => "Sarah", "paiement" => 100],
    ["nom" => "Junior", "paiement" => 50],
    ["nom" => "Rachel", "paiement" => 100]
];

// Frais fixes à payer
$fraisScolaires = 100;

// Initialisation des totaux
$totalEncaisse = 0;
$totalManquant = 0;
$enRegle = 0;
$enRetard = 0;

// Affichage d'intro
echo "📋 BILAN COMPLET DES PAIEMENTS 📋\n\n";

// Boucle sur chaque élève
foreach ($eleves as $eleve) {
    $nom = $eleve["nom"];
    $paiement = $eleve["paiement"];
    $reste = $fraisScolaires - $paiement;

    echo "👨‍🎓 Élève : $nom\n";

    if ($reste == 0) {
        echo "✅ Paiement COMPLET. Merci !\n";
        $enRegle++;
    } else {
        echo "❌ Paiement INCOMPLET. Il manque $reste$\n";
        $enRetard++;
        $totalManquant += $reste;
    }

    $totalEncaisse += $paiement;
    echo "-----------------------------\n";
}

// Résumé global
echo "\n📊 RÉCAPITULATIF 📊\n";
echo "💰 Total encaissé : $totalEncaisse$\n";
echo "🚨 Total manquant : $totalManquant$\n";
echo "✅ Élèves à jour : $enRegle\n";
echo "⏳ Élèves en retard : $enRetard\n";

?>

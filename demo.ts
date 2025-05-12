// Définition du type pour un élève
type Eleve = {
    nom: string;
    paiement: number;
};

// Liste des élèves avec leurs paiements
const eleves: Eleve[] = [
    { nom: "Amina", paiement: 100 },
    { nom: "Kevin", paiement: 75 },
    { nom: "Sarah", paiement: 100 },
    { nom: "Junior", paiement: 50 },
    { nom: "Rachel", paiement: 100 }
];

// Frais fixes à payer
const fraisScolaires: number = 100;

// Initialisation des totaux
let totalEncaisse: number = 0;
let totalManquant: number = 0;
let enRegle: number = 0;
let enRetard: number = 0;

// Fonction pour afficher les informations de chaque élève
const afficherBilanEleve = (eleve: Eleve) => {
    const reste = fraisScolaires - eleve.paiement;

    console.log(`👨‍🎓 Élève : ${eleve.nom}`);
    if (reste === 0) {
        console.log("✅ Paiement COMPLET. Merci !");
        enRegle++;
    } else {
        console.log(`❌ Paiement INCOMPLET. Il manque ${reste}$`);
        enRetard++;
        totalManquant += reste;
    }

    totalEncaisse += eleve.paiement;
    console.log("-----------------------------");
};

// Fonction pour afficher le récapitulatif global
const afficherRecapitulatif = () => {
    console.log("\n📊 RÉCAPITULATIF 📊");
    console.log(`💰 Total encaissé : ${totalEncaisse}$`);
    console.log(`🚨 Total manquant : ${totalManquant}$`);
    console.log(`✅ Élèves à jour : ${enRegle}`);
    console.log(`⏳ Élèves en retard : ${enRetard}`);
};

// Affichage d'introduction
console.log("📋 BILAN COMPLET DES PAIEMENTS 📋\n");

eleves.forEach(afficherBilanEleve);

afficherRecapitulatif();


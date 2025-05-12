// 🧾 Données locales : liste des élèves et leurs paiements
const eleves = [
    { nom: "Amina", paiement: 100 },
    { nom: "Kevin", paiement: 75 },
    { nom: "Sarah", paiement: 100 },
    { nom: "Junior", paiement: 50 },
    { nom: "Rachel", paiement: 100 }
  ];
  
  // 🎯 Frais fixes à payer
  const fraisScolaires = 100;
  
  // 📊 Variables pour les totaux
  let totalEncaissé = 0;
  let totalManquant = 0;
  let enRegle = 0;
  let enRetard = 0;
  
  // 📌 Fonction pour afficher la facture d’un élève
  function genererFacture(eleve: { nom: string; paiement: number }) {
    const reste = fraisScolaires - eleve.paiement;
    console.log(`\n📄 FACTURE POUR : ${eleve.nom}`);
    console.log(`- Montant dû : ${fraisScolaires}$`);
    console.log(`- Montant payé : ${eleve.paiement}$`);
    console.log(`- Reste à payer : ${reste <= 0 ? 0 : reste}$`);
    console.log("-----------------------------");
  }
  
  // 💳 Fonction pour ajouter un paiement à un élève
  function ajouterPaiement(nom: string, montant: number) {
    const eleve = eleves.find(e => e.nom === nom);
    if (eleve) {
      eleve.paiement += montant;
      console.log(`\n💸 Paiement de ${montant}$ ajouté pour ${nom}. Nouveau total : ${eleve.paiement}$`);
    } else {
      console.log(`⚠️ Élève ${nom} non trouvé.`);
    }
  }
  
  // 📋 Affichage du rapport initial
  function afficherBilan() {
    // Réinitialisation
    totalEncaissé = 0;
    totalManquant = 0;
    enRegle = 0;
    enRetard = 0;
  
    console.log("\n📋 BILAN COMPLET DES PAIEMENTS 📋\n");
  
    // Vérification de chaque élève
    for (let i = 0; i < eleves.length; i++) {
      const eleve = eleves[i];
      const reste = fraisScolaires - eleve.paiement;
  
      console.log(`👨‍🎓 Élève : ${eleve.nom}`);
      if (reste <= 0) {
        console.log("✅ Paiement COMPLET. Merci !");
        enRegle++;
      } else {
        console.log(`❌ Paiement INCOMPLET. Il manque ${reste}$`);
        enRetard++;
        totalManquant += reste;
      }
  
      totalEncaissé += eleve.paiement;
      console.log("-----------------------------");
    }
  
    // Résumé final
    console.log("\n📊 RÉCAPITULATIF 📊");
    console.log(`💰 Total encaissé : ${totalEncaissé}$`);
    console.log(`🚨 Total manquant : ${totalManquant}$`);
    console.log(`✅ Élèves à jour : ${enRegle}`);
    console.log(`⏳ Élèves en retard : ${enRetard}`);
  }
  
  // 📦 Démonstration complète
  afficherBilan(); // Bilan initial
  
  // ➕ Ajout de paiements
  ajouterPaiement("Kevin", 25);  // Paiement complémentaire pour Kevin
  ajouterPaiement("Junior", 50); // Paiement complémentaire pour Junior
  
  // 🧾 Générer des factures pour tous les élèves
  console.log("\n📁 FACTURES INDIVIDUELLES 📁");
  eleves.forEach(genererFacture);
  
  // 🔁 Bilan final après les nouveaux paiements
  afficherBilan();
  
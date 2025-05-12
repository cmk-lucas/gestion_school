// On a ici notre petite base de données locale avec les paiements des élèves
const eleves = [
    { nom: "Amina", paiement: 100 },
    { nom: "Kevin", paiement: 75 },
    { nom: "Sarah", paiement: 100 },
    { nom: "Junior", paiement: 50 },
    { nom: "Rachel", paiement: 100 }
  ];
  
  // Montant fixe à payer pour chaque élève (frais de scolarité)
  const fraisScolaires = 100;
  
  // On prépare les totaux
  let totalEncaissé = 0;
  let totalManquant = 0;
  let enRegle = 0;
  let enRetard = 0;
  
  // Intro du rapport
  console.log("📋 BILAN COMPLET DES PAIEMENTS 📋\n");
  
  // On boucle sur tous les élèves pour vérifier leurs paiements
  for (let i = 0; i < eleves.length; i++) {
    let eleve = eleves[i];
    let reste = fraisScolaires - eleve.paiement;
  
    console.log(`👨‍🎓 Élève : ${eleve.nom}`);
  
    if (reste === 0) {
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
  
  // Résumé général à la fin du rapport
  console.log("\n📊 RÉCAPITULATIF 📊");
  console.log(`💰 Total encaissé : ${totalEncaissé}$`);
  console.log(`🚨 Total manquant : ${totalManquant}$`);
  console.log(`✅ Élèves à jour : ${enRegle}`);
  console.log(`⏳ Élèves en retard : ${enRetard}`);
  
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
  
  // Affichage d'introduction
  console.log("📋 BILAN COMPLET DES PAIEMENTS 📋\n");
  
  // Boucle pour passer chaque élève
  for (let i = 0; i < eleves.length; i++) {
    const eleve = eleves[i];
    
    // Assurer que 'eleve.paiement' est un nombre valide
    const reste: number = fraisScolaires - eleve.paiement;
  
    console.log(`👨‍🎓 Élève : ${eleve.nom}`);
  
    // Si le paiement est complet
    if (reste === 0) {
      console.log("✅ Paiement COMPLET. Merci !");
      enRegle++;
    } else {
      // Sinon, affichage de ce qui manque
      console.log(`❌ Paiement INCOMPLET. Il manque ${reste}$`);
      enRetard++;
      totalManquant += reste;
    }
  
    // Total encaissé
    totalEncaisse += eleve.paiement;
    console.log("-----------------------------");
  }
  
  // Résumé global
  console.log("\n📊 RÉCAPITULATIF 📊");
  console.log(`💰 Total encaissé : ${totalEncaisse}$`);
  console.log(`🚨 Total manquant : ${totalManquant}$`);
  console.log(`✅ Élèves à jour : ${enRegle}`);
  console.log(`⏳ Élèves en retard : ${enRetard}`);
  
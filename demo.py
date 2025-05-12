# Liste des élèves avec ce qu'ils ont payé
eleves = [
    { "nom": "Amina", "paiement": 100 },
    { "nom": "Kevin", "paiement": 75 },
    { "nom": "Sarah", "paiement": 100 },
    { "nom": "Junior", "paiement": 50 },
    { "nom": "Rachel", "paiement": 100 }
]

# Frais fixes à payer par élève
frais_scolaires = 100

# Variables pour le total
total_encaisse = 0
total_manquant = 0
en_regle = 0
en_retard = 0

# Intro
print("📋 BILAN COMPLET DES PAIEMENTS 📋\n")

# On passe chaque élève un à un
for eleve in eleves:
    nom = eleve["nom"]
    paiement = eleve["paiement"]
    reste = frais_scolaires - paiement

    print(f"👨‍🎓 Élève : {nom}")

    if reste == 0:
        print("✅ Paiement COMPLET. Merci !")
        en_regle += 1
    else:
        print(f"❌ Paiement INCOMPLET. Il manque {reste}$")
        en_retard += 1
        total_manquant += reste

    total_encaisse += paiement
    print("-----------------------------")

# Résumé à la fin
print("\n📊 RÉCAPITULATIF 📊")
print(f"💰 Total encaissé : {total_encaisse}$")
print(f"🚨 Total manquant : {total_manquant}$")
print(f"✅ Élèves à jour : {en_regle}")
print(f"⏳ Élèves en retard : {en_retard}")

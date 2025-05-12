import java.util.ArrayList;
import java.util.List;

public class GestionPaiements {

    // Classe Eleve pour représenter un élève
    static class Eleve {
        private String nom;
        private double paiement;

        // Constructeur de la classe Eleve
        public Eleve(String nom, double paiement) {
            this.nom = nom;
            this.paiement = paiement;
        }

        // Méthodes pour récupérer le nom et le paiement
        public String getNom() {
            return nom;
        }

        public double getPaiement() {
            return paiement;
        }
    }

    public static void main(String[] args) {
        // Liste des élèves avec leurs paiements
        List<Eleve> eleves = new ArrayList<>();
        eleves.add(new Eleve("Amina", 100));
        eleves.add(new Eleve("Kevin", 75));
        eleves.add(new Eleve("Sarah", 100));
        eleves.add(new Eleve("Junior", 50));
        eleves.add(new Eleve("Rachel", 100));

        // Frais fixes à payer
        double fraisScolaires = 100;

        // Initialisation des totaux
        double totalEncaisse = 0;
        double totalManquant = 0;
        int enRegle = 0;
        int enRetard = 0;

        // Affichage d'introduction
        System.out.println("📋 BILAN COMPLET DES PAIEMENTS 📋\n");

        // Boucle pour passer chaque élève
        for (Eleve eleve : eleves) {
            double reste = fraisScolaires - eleve.getPaiement();

            System.out.println("👨‍🎓 Élève : " + eleve.getNom());

            if (reste == 0) {
                System.out.println("✅ Paiement COMPLET. Merci !");
                enRegle++;
            } else {
                System.out.println("❌ Paiement INCOMPLET. Il manque " + reste + "$");
                enRetard++;
                totalManquant += reste;
            }

            totalEncaisse += eleve.getPaiement();
            System.out.println("-----------------------------");
        }

        // Résumé global
        System.out.println("\n📊 RÉCAPITULATIF 📊");
        System.out.println("💰 Total encaissé : " + totalEncaisse + "$");
        System.out.println("🚨 Total manquant : " + totalManquant + "$");
        System.out.println("✅ Élèves à jour : " + enRegle);
        System.out.println("⏳ Élèves en retard : " + enRetard);
    }
}

import sys
from PyQt5.QtWidgets import QApplication, QWidget, QVBoxLayout, QLabel, QPushButton, QTableWidget, QTableWidgetItem

# Liste des élèves avec ce qu'ils ont payé
eleves = [
    {"nom": "Amina", "paiement": 100},
    {"nom": "Kevin", "paiement": 75},
    {"nom": "Sarah", "paiement": 100},
    {"nom": "Junior", "paiement": 50},
    {"nom": "Rachel", "paiement": 100}
]

# Frais fixes à payer par élève
frais_scolaires = 100

# Variables pour le total
total_encaisse = 0
total_manquant = 0
en_regle = 0
en_retard = 0

class BilanPaiement(QWidget):
    def __init__(self):
        super().__init__()

        self.setWindowTitle("📋 Bilan des Paiements")
        self.setGeometry(100, 100, 600, 400)

        self.initUI()

    def initUI(self):
        layout = QVBoxLayout()

        # Titre
        title = QLabel("📋 BILAN COMPLET DES PAIEMENTS 📋", self)
        title.setStyleSheet("font-size: 20px; font-weight: bold; color: #4CAF50; text-align: center;")
        layout.addWidget(title)

        # Table pour afficher les paiements des élèves
        self.tableWidget = QTableWidget(self)
        self.tableWidget.setRowCount(len(eleves))
        self.tableWidget.setColumnCount(3)
        self.tableWidget.setHorizontalHeaderLabels(["Élève", "Paiement ($)", "Statut"])

        # Remplir la table avec les informations
        for i, eleve in enumerate(eleves):
            nom = eleve["nom"]
            paiement = eleve["paiement"]
            reste = frais_scolaires - paiement
            statut = "✅ Paiement COMPLET" if reste == 0 else f"❌ Paiement INCOMPLET ({reste}$ manquants)"

            self.tableWidget.setItem(i, 0, QTableWidgetItem(nom))
            self.tableWidget.setItem(i, 1, QTableWidgetItem(str(paiement)))
            self.tableWidget.setItem(i, 2, QTableWidgetItem(statut))

            # Mise à jour des variables
            global total_encaisse, total_manquant, en_regle, en_retard
            total_encaisse += paiement
            if reste == 0:
                en_regle += 1
            else:
                en_retard += 1
                total_manquant += reste

        layout.addWidget(self.tableWidget)

        # Récapitulatif des paiements
        recap = QLabel(f"""
        📊 RÉCAPITULATIF 📊
        💰 Total encaissé : {total_encaisse}$
        🚨 Total manquant : {total_manquant}$
        ✅ Élèves à jour : {en_regle}
        ⏳ Élèves en retard : {en_retard}
        """, self)
        recap.setStyleSheet("font-size: 14px; color: #333; padding-top: 20px;")
        layout.addWidget(recap)

        # Bouton pour rafraîchir
        refresh_button = QPushButton("Rafraîchir", self)
        refresh_button.setStyleSheet("""
        background-color: #4CAF50; color: white; border-radius: 8px;
        padding: 10px 20px; font-size: 16px; font-weight: bold;
        """)
        refresh_button.clicked.connect(self.refresh)
        layout.addWidget(refresh_button)

        self.setLayout(layout)

    def refresh(self):
        global total_encaisse, total_manquant, en_regle, en_retard
        total_encaisse = total_manquant = en_regle = en_retard = 0
        for i, eleve in enumerate(eleves):
            paiement = eleve["paiement"]
            reste = frais_scolaires - paiement
            if reste == 0:
                en_regle += 1
            else:
                en_retard += 1
                total_manquant += reste
            total_encaisse += paiement

        # Mettre à jour le récapitulatif
        recap = f"""
        📊 RÉCAPITULATIF 📊
        💰 Total encaissé : {total_encaisse}$
        🚨 Total manquant : {total_manquant}$
        ✅ Élèves à jour : {en_regle}
        ⏳ Élèves en retard : {en_retard}
        """
        self.findChild(QLabel).setText(recap)

# Lancer l'application
app = QApplication(sys.argv)
window = BilanPaiement()
window.show()
sys.exit(app.exec_())

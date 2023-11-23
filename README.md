# Projet-GSB---Gestion-des-visites

Présentation du contexte
L'activité à gérer
L'activité commerciale d'un laboratoire pharmaceutique est principalement réalisée par les visiteurs médicaux. En effet, un médicament remboursé par la sécurité sociale n’est jamais vendu directement au consommateur mais prescrit au patient par son médecin.
Toute communication publicitaire sur les médicaments remboursés est d'ailleurs interdite par la loi. Il est donc important, pour l’industrie pharmaceutique, de promouvoir ses produits directement auprès des praticiens.

Les Visiteurs Médicaux
L'activité des visiteurs médicaux consiste à visiter régulièrement les médecins généralistes, spécialistes, les services hospitaliers ainsi que les infirmiers et pharmaciens pour les tenir au courant de l’intérêt de leurs produits et des nouveautés du laboratoire.
Chaque visiteur dispose d’un portefeuille de praticiens, de sorte que le même médecin ne reçoit jamais deux visites différentes du même laboratoire.
Comme tous les commerciaux, ils travaillent par objectifs définis par la hiérarchie et reçoivent en conséquence diverses primes et avantages.
Pour affiner la définition des objectifs et l’attribution des budgets, il sera nécessaire d’informatiser les comptes rendus de visite.

L’activité des visiteurs
L'activité est composée principalement de visites réalisées auprès d’un praticien (médecin dans son cabinet, à l’hôpital, pharmacien, chef de clinique...). On souhaite en connaître la date, le motif (6 motifs sont fixés au préalable) et savoir, pour chaque visite, les médicaments présentés et le nombre d’échantillons offerts. Le bilan fourni par le visiteur (le médecin a paru convaincu ou pas, une autre visite a été planifiée...) devra aussi être enregistré.

Les produits
Les produits distribués par le laboratoire sont des médicaments : ils sont identifiés par un numéro de produit (dépôt légal) qui correspond à un nom commercial (ce nom étant utilisé par les visiteurs et les médecins).
Comme tout médicament, un produit a des effets thérapeutiques et des contre-indications.
On connait sa composition (liste des composants et quantité) et les interactions qu'il peut avoir avec d'autres médicaments (éléments nécessaires à la présentation aux médecins).
La posologie (quantité périodique par type d’individu : adulte, jeune adulte, enfant, jeune enfant ou nourrisson) dépend de la présentation et du dosage.
Un produit relève d’une famille (antihistaminique, antidépresseur, antibiotique, ...).
Lors d'une visite auprès d'un médecin, un visiteur présente un ou plusieurs produits pour lesquels il pourra laisser des échantillons.

Les médecins
Les médecins sont le cœur de cible des laboratoires. Aussi font-ils l’objet d’une attention toute particulière.
Pour tenir à jour leurs informations, les laboratoires achètent des fichiers à des organismes spécialisés qui donnent les diverses informations d’état civil et la spécialité complémentaire.

L’application à réaliser
L’entreprise envisage de permettre aux visiteurs de gérer ses visites par l’intermédiaire de son smartphone ou de sa tablette. L’application devrait permettre de réaliser les cas d’utilisation suivants :


Cas : gérer les rapports de visite
Scénario classique
        1) Le visiteur demande à créer un nouveau rapport de visite
        2) Le système retourne un formulaire avec la liste des médecins et des champs de saisie
        3) Le visiteur sélectionne un médecin à partir de son début de nom, sélectionne la date et remplit
        les différents champs, sélectionne les médicaments et les quantités offertes et valide
        4) Le système enregistre le rapport
        Scénario étendu : modification d’un rapport
        5) Le visiteur demande à modifier un rapport
        6) Le système retourne un formulaire avec une date à sélectionner
        7) Le visiteur sélectionne la date
        8) Le système retourne les rapports que le visiteur a effectués à cette date
        9) Le visiteur sélectionne un rapport de visite
        10) Le système retourne les informations déjà saisies concernant le motif et le bilan
        11) Le visiteur modifie les informations
        12) Le système enregistre les modifications
        Scénario alternatif
        4.1) Des champs ne sont pas remplis, le système en informe le visiteur, retour à 3

Cas : gérer les médecins
Scénario classique
    1) Le visiteur demande à voir les informations concernant un médecin
    2) Le système retourne un formulaire avec un champ de recherche du médecin
    3) Le visiteur sélectionne un médecin à partir de son début de nom et valide
    4) Le système retourne les informations personnelles concernant ce médecin
Scénario étendu :
    5) Le visiteur clique sur l’adresse de messagerie du médecin
    6) Le système permet la rédaction et l’envoi d’un courriel
    7) Le visiteur demande à voir tous les anciens rapports de visite concernant ce médecin
    8) Le système retourne tous ses rapports
    9) Le visiteur demande à modifier certains champs concernant des informations du médecin
    10) Le système enregistre ces modifications


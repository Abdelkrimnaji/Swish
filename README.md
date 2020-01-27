# transfer-system
Création d' un service similaire à https://wetransfer.com/ en insistant sur le design et l'expérience utilisateur.

Description : créer un service similaire à https://wetransfer.com/ en insistant sur le design et l'expérience utilisateur
Organisation : par équipe de 3 ou 4

 

Créer une identité propre au service
Rester sur le principe "keep it simple"
Logo + couleur 3 maxi (nuances autorisées) (facultatif)
Insister sur une UX minimaliste et efficace
Rédaction du mail avec un texte "marketing" et convivial

 

        - une page avec un formulaire :
            - "choisissez le fichier" (upload en HTML5)
            - email du destinataire
            - email copie
            - bouton envoyer


        - une page intermédiaire :
            - enregistre les informations dans une base de données
            - enregistre le fichier dans un répertoire
            - envoi par mail en HTML le lien vers la page de téléchargement du fichier 
   
        - une page de résultat :
            - message de réussite
            - lien vers la page à copier/coller

        - une page permettant depuis l'ID enregistré dans la base de données, d’accéder au
         téléchargement du fichier. c'est le lien vers cette page qui est envoyé par mail

 

 

Un backOffice : 

      - Une page de login qui après un login réussi redirige l'utilisateur vers la page Dashboard

      - Une page dashboard permettant de visualiser :                

                 - Un graphique Histogramme permettant de comparer le nombre de fichiers envoyés par jour d'après le numéro de semaine choisie dans une liste déroulante de l'année un cours.   ex : Semaine 12 en 2018 - Lundi 12 fichiers, Mardi 14 fichier, Mercredi 52 fichiers...jusqu'au Dimanche.

                 - Un graphique secteur permettant représenter en % le nombre de fichier téléchargé par type. ex : Semaine 12 en 2018 -  .jpg 23%, .xlsx 3%, png, 14%...

                -  Un graphique en courbe montrant le nombre de fichiers téléchargés. Semaine 12 en 2018 - Lundi 12 fichiers, Mardi 25 fichiers, Mercredi 36 fichiers...

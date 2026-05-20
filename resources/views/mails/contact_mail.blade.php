<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Confirmation de l'adresse e-mail</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        h2 {
            color: #3498db;
        }
        a {
            color: #3498db;
        }
        p {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div style="max-width: 600px; margin: 0 auto;">
        <h2>Message d'un utilisateur</h2>
        <p>Vous avez reçu le message de {{ $request->name }}({{ $request->email }})</p>
        <p>En voici le contenu : </p>
        <p>{{ $request->message }}</p>
        <p>Cordialement,<br>chèr administrateur</p>
    </div>
</body>
</html>

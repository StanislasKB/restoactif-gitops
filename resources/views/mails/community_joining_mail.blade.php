<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Bienvenue dans la communauté</title>
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
        <p>Bonjour, {{ $user->first_name }}</p>
        <p>Votre adhésion à la communauté Restoactif a été approuvée. Reste à l'afflux des nouveautés !</p>
        <p>Cordialement,<br>L'équipe {{  config('app.name') }}</p>
    </div>
</body>
</html>

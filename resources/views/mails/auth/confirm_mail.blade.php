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
        <h2>Confirmation de l'adresse e-mail</h2>
        <p>Bonjour {{ $user->last_name }},</p>
        <p>Merci pour votre inscription à notre application. Pour activer votre compte, veuillez cliquer sur le lien ci-dessous :</p>
        <p><a href="{{ $url }}" style="display: inline-block; padding: 10px 20px; background-color: #3498db; color: #fff; text-decoration: none; border-radius: 5px;">Confirmer l'adresse e-mail</a></p>
        <p>Si vous n'avez pas créé de compte, ignorez simplement cet e-mail.</p>
        <p>Cordialement,<br>Votre équipe {{ config('app.name') }}</p>
    </div>
</body>
</html>

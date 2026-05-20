<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Erreur 404</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="/dashboard/assets/css/app.min.css" rel="stylesheet" type="text/css">

    <!-- Icons css -->
    <link href="/dashboard/assets/css/icons.min.css" rel="stylesheet" type="text/css">

    <!-- Theme Config Js -->
    <script src="/dashboard/assets/js/config.js"></script>
</head>

<body>

    <div class="bg-gradient-to-r from-green-100 to-teal-100 dark:from-gray-700 dark:via-gray-900 dark:to-black">
        <div class="h-screen w-screen flex justify-center items-center">
            <div class="flex flex-col justify-center text-center gap-6">
                <a href="index.html" class="flex justify-center mx-auto">
                    <img class="h-10 block dark:hidden " src="/dashboard/assets/images/logo-dark.png" alt="">
                    <img class="h-10 hidden dark:block" src="/dashboard/assets/images/logo-light.png" alt="">
                </a>
                <p class="text-3xl font-semibold text-gray-600 dark:text-gray-100">404</p>
                <h1 class="text-4xl font-bold tracking-tight dark:text-gray-100">Page introuvable</h1>
                <p class="text-base text-gray-600 dark:text-gray-300">Désolé, nous n’avons pas trouvé la page que vous recherchez.</p>
                <a href="{{ route('landing.accueil.accueil') }}" class="text-base font-medium" style="color: #589442">Retour à la page d'accueil </a>
            </div>
        </div>
    </div>

</body>
</html>

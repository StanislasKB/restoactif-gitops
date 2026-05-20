// document
//     .getElementById("community_form")
//     .querySelector('button[type="submit"]').disabled = true;
document
    .getElementById("requestPermission")
    .addEventListener("change", function (event) {
        if (this.checked) {
            Notification.requestPermission().then(function (permission) {
                if (permission === "granted") {
                    navigator.serviceWorker.ready.then(function (registration) {
                        registration.pushManager
                            .subscribe({
                                userVisibleOnly: true,
                                applicationServerKey:
                                    document.getElementById("vapid_public_key")
                                        .value, //server_key
                            })
                            .then(function (subscription) {
                                // Sauvegarder l'abonnement push dans une variable ou un champ caché du formulaire
                                const endpoint = subscription.endpoint;
                                const key = btoa(
                                    String.fromCharCode.apply(
                                        null,
                                        new Uint8Array(
                                            subscription.getKey("p256dh")
                                        )
                                    )
                                );
                                const authSecret = btoa(
                                    String.fromCharCode.apply(
                                        null,
                                        new Uint8Array(
                                            subscription.getKey("auth")
                                        )
                                    )
                                );

                                // Ajouter ces informations à des champs cachés du formulaire
                                // Ajouter ou mettre à jour ces informations à des champs cachés du formulaire
                                const form =
                                    document.getElementById("community_form");
                                let endpointInput = form.querySelector(
                                    'input[name="endpoint"]'
                                );
                                if (!endpointInput) {
                                    endpointInput =
                                        document.createElement("input");
                                    endpointInput.type = "hidden";
                                    endpointInput.name = "endpoint";
                                    form.appendChild(endpointInput);
                                }
                                endpointInput.value = endpoint;

                                let keyInput =
                                    form.querySelector('input[name="key"]');
                                if (!keyInput) {
                                    keyInput = document.createElement("input");
                                    keyInput.type = "hidden";
                                    keyInput.name = "key";
                                    form.appendChild(keyInput);
                                }
                                keyInput.value = key;

                                let authSecretInput = form.querySelector(
                                    'input[name="authSecret"]'
                                );
                                if (!authSecretInput) {
                                    authSecretInput =
                                        document.createElement("input");
                                    authSecretInput.type = "hidden";
                                    authSecretInput.name = "authSecret";
                                    form.appendChild(authSecretInput);
                                }
                                authSecretInput.value = authSecret;

                                // Activer le bouton de soumission du formulaire
                                form.querySelector(
                                    'button[type="submit"]'
                                ).disabled = false;

                                // Masquer le message d'avertissement
                                document.getElementById(
                                    "permissionMessage"
                                ).style.display = "none";
                            })
                            .catch(function (error) {
                                console.error(
                                    "Error during subscription:",
                                    error
                                );
                            });
                    });
                } else {
                    alert(
                        "Vous devez activer les notifications pour soumettre le formulaire."
                    );
                    event.target.checked = false;
                }
            });
        } else {
            // Désactiver le bouton de soumission du formulaire
            document
                .getElementById("community_form")
                .querySelector('button[type="submit"]').disabled = true;
        }
    });

document
    .getElementById("community_form")
    .addEventListener("submit", function (event) {
        const endpointInput = document.querySelector('input[name="endpoint"]');
        if (!endpointInput) {
            // event.preventDefault();
            document.getElementById("permissionMessage").style.display =
                "block";
        }
    });

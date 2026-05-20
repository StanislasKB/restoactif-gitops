document.addEventListener("DOMContentLoaded", function () {
    const communityForm = document.getElementById("community_form");
    const submitButton = communityForm.querySelector('button[type="submit"]');
    const requestPermissionCheckbox = document.getElementById("requestPermission");
    const vapidPublicKeyElement = document.getElementById("vapid_public_key");
    const permissionMessage = document.getElementById("permissionMessage");

    submitButton.disabled = true;

    requestPermissionCheckbox.addEventListener("change", function (event) {
        if (this.checked) {
            Notification.requestPermission().then(function (permission) {
                if (permission === "granted") {
                    navigator.serviceWorker.ready.then(function (registration) {
                        registration.pushManager
                            .subscribe({
                                userVisibleOnly: true,
                                applicationServerKey: vapidPublicKeyElement.value,
                            })
                            .then(function (subscription) {
                                const endpoint = subscription.endpoint;
                                const key = btoa(String.fromCharCode.apply(
                                    null,
                                    new Uint8Array(subscription.getKey("p256dh"))
                                ));
                                const authSecret = btoa(String.fromCharCode.apply(
                                    null,
                                    new Uint8Array(subscription.getKey("auth"))
                                ));

                                addOrUpdateHiddenInput(communityForm, "endpoint", endpoint);
                                addOrUpdateHiddenInput(communityForm, "key", key);
                                addOrUpdateHiddenInput(communityForm, "authSecret", authSecret);

                                submitButton.disabled = false;
                                permissionMessage.style.display = "none";
                            })
                            .catch(function (error) {
                                console.error("Error during subscription:", error);
                            });
                    });
                } else {
                    alert("Vous devez activer les notifications pour soumettre le formulaire.");
                    event.target.checked = false;
                }
            });
        } else {
            submitButton.disabled = true;
        }
    });

    communityForm.addEventListener("submit", function (event) {
        const endpointInput = communityForm.querySelector('input[name="endpoint"]');
        if (!endpointInput) {
            event.preventDefault();
            permissionMessage.style.display = "block";
        }
    });

    function addOrUpdateHiddenInput(form, name, value) {
        let input = form.querySelector(`input[name="${name}"]`);
        if (!input) {
            input = document.createElement("input");
            input.type = "hidden";
            input.name = name;
            form.appendChild(input);
        }
        input.value = value;
    }
});

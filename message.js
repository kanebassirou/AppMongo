$(document).ready(function() {
    // ... (Votre code existant)

    // Afficher le message de succès temporaire
     var successMessage = '<?php if (isset($_SESSION["success"])) { echo $_SESSION["success"]; unset($_SESSION["success"]); } ?>';
    if (successMessage) {
        var temporaryMessageContainer = $('#temporary-message-container');
        temporaryMessageContainer.html('<div class="alert alert-success">' + successMessage + '</div>');
        temporaryMessageContainer.show();

        // Masquer le message après un certain délai
        setTimeout(function() {
            temporaryMessageContainer.fadeOut('slow');
        }, 5000); // 5000ms = 5s
    }

    // ... (Autres actions de pagination)
});

function calculateTotal() {
    // Récupérer les valeurs des champs de date
    const checkin = new Date(document.getElementById('booking_check_in_at').value);
    const checkout = new Date(document.getElementById('booking_check_out_at').value);

    // Récupérer le prix de la chambre (remplacer par {{ room.price }} si nécessaire)
    const roomPrice = parseFloat(document.getElementById('roomPrice').innerText);

    // Calculer la différence en jours
    const timeDiff = checkout - checkin;
    const daysDiff = timeDiff / (1000 * 3600 * 24) +1; // Convertir la différence en jours

    // Vérifier que la date de sortie est après la date d'entrée
    if (daysDiff > 0) {
        const total = daysDiff * roomPrice;
        // Afficher le total dans l'élément avec l'ID "totalPrice"
        document.getElementById('totalPrice').innerText = total.toFixed(2) + " €";
    } else {
        document.getElementById('totalPrice').innerText = "Veuillez choisir des dates valides.";
    }
}
window.addEventListener('change', function() {
    // Récupérer les champs de date
    const checkinField = document.getElementById('booking_check_in_at');
    const checkoutField = document.getElementById('booking_check_out_at');

    // Ajouter l'écouteur d'événement pour recalculer lorsque l'utilisateur modifie les dates
    checkinField.addEventListener('change', calculateTotal);
    checkoutField.addEventListener('change', calculateTotal);
});
document.getElementById("reservationForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Evitar que el formulario se envíe por defecto

    // Obtener los valores de los campos
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let roomType = document.getElementById("roomType").value;
    let checkIn = document.getElementById("checkIn").value;
    let checkOut = document.getElementById("checkOut").value;

    // Validación básica
    if (new Date(checkIn) >= new Date(checkOut)) {
        displayMessage("La fecha de Check-Out debe ser posterior a la de Check-In.", "error");
    } else {
        // Enviar datos al servidor
        fetch('reservar.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                nombre: name,
                correo: email,
                tipo_habitacion: roomType,
                fecha_checkin: checkIn,
                fecha_checkout: checkOut
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayMessage("¡Reservación exitosa! Te esperamos en The Imperial New Delhi.", "success");
                clearForm();
            } else {
                displayMessage("Error al realizar la reservación. Inténtalo de nuevo.", "error");
            }
        })
        .catch(error => {
            console.error('Error:', error);
            displayMessage("Error al realizar la reservación. Inténtalo de nuevo.", "error");
        });
    }
});

// Función para mostrar mensajes de éxito o error
function displayMessage(message, type) {
    let messageDiv = document.getElementById("confirmationMessage");
    messageDiv.textContent = message;
    messageDiv.className = type;
}

// Función para limpiar el formulario
function clearForm() {
    document.getElementById("reservationForm").reset();
}

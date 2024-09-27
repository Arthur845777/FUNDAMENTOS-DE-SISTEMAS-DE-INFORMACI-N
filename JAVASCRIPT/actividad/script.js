// Mostrar en pantalla
function insert(value) {
    document.getElementById("display").value += value;
}

// Limpiar pantalla
function clearDisplay() {
    document.getElementById("display").value = "";
}

// Borrar último carácter
function backspace() {
    let display = document.getElementById("display").value;
    document.getElementById("display").value = display.substring(0, display.length - 1);
}

// Función para seno (trabaja directamente en grados)
function sine() {
    let value = parseFloat(document.getElementById("display").value);
    document.getElementById("display").value = Math.sin(value * Math.PI / 180);
}

// Función para coseno (trabaja directamente en grados)
function cosine() {
    let value = parseFloat(document.getElementById("display").value);
    document.getElementById("display").value = Math.cos(value * Math.PI / 180);
}

// Función para tangente (trabaja directamente en grados)
function tangent() {
    let value = parseFloat(document.getElementById("display").value);
    document.getElementById("display").value = Math.tan(value * Math.PI / 180);
}

// Función para raíz cuadrada
function sqrt() {
    let value = parseFloat(document.getElementById("display").value);
    document.getElementById("display").value = Math.sqrt(value);
}

// Función para potencia (eleva al cuadrado)
function power() {
    let value = parseFloat(document.getElementById("display").value);
    document.getElementById("display").value = Math.pow(value, 2);
}

// Calcular el resultado de la operación básica
function calculate() {
    try {
        let result = eval(document.getElementById("display").value);
        document.getElementById("display").value = result;
    } catch (e) {
        document.getElementById("display").value = "Error";
    }
}

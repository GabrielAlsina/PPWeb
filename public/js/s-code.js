document.addEventListener("DOMContentLoaded", () => {
    const searchForm = document.getElementById("searchForm");
    const searchBtn = document.getElementById("searchBtn");
    const resultsModal = document.getElementById("resultsModal");
    const resultsTable = document.getElementById("resultsTable");
    const closeModal = document.querySelector(".close");
    const selectedTable = document.getElementById("selectedTable").querySelector("tbody");

    const searchBtnp = document.getElementById("searchBtnp");
    const patientInfo = document.getElementById("patientInfo");
    const patientName = document.getElementById("patientName");
    const patientLastName = document.getElementById("patientLastName");
    const patientDNI = document.getElementById("patientDNI");

    // Función para guardar el carrito en localStorage
    const saveCartToLocalStorage = () => {
        const cart = [];
        const rows = selectedTable.querySelectorAll("tr");
        rows.forEach(row => {
            const codigo = row.querySelector("td").textContent;
            const descripcion = row.querySelector("td:nth-child(2)").textContent;
            cart.push({ codigo, descripcion });
        });
        localStorage.setItem("cart", JSON.stringify(cart));
    };

    // Cargar carrito desde localStorage al cargar la página
    const loadCartFromLocalStorage = () => {
        const savedCart = JSON.parse(localStorage.getItem("cart"));
        if (savedCart) {
            savedCart.forEach(item => {
                const row = document.createElement("tr");
                row.innerHTML = ` 
                    <td>${item.codigo}</td>
                    <td>${item.descripcion}</td>
                    <td><button class="removeBtn" data-codigo="${item.codigo}">Eliminar</button></td>
                `;
                selectedTable.appendChild(row);
            });
        }
    };

    // Abrir y cerrar el modal
    closeModal.addEventListener("click", () => resultsModal.style.display = "none");

    // Función para realizar la búsqueda de prácticas
    const performSearch = () => {
        const codigo = document.getElementById("codigo").value.trim();

        if (!codigo) {
            alert("Por favor ingresa un código o descripción.");
            return;
        }

        fetch("s-code.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: new URLSearchParams({
                action: "search",
                keyword: codigo
            })
        })
        .then(response => response.json())
        .then(data => {
            resultsTable.innerHTML = ""; // Limpiar resultados
            if (data.length > 0) {
                data.forEach(item => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${item.CODIGO}</td>
                        <td>${item.DESCRIPCION}</td>
                        <td><button class="selectBtn" data-codigo="${item.CODIGO}" data-descripcion="${item.DESCRIPCION}">Agregar</button></td>
                    `;
                    resultsTable.appendChild(row);
                });
                resultsModal.style.display = "block"; // Mostrar modal
            } else {
                alert("No se encontraron resultados.");
            }
        })
        .catch(error => console.error("Error:", error));
    };

    // Búsqueda AJAX al hacer clic en el botón
    searchBtn.addEventListener("click", performSearch);

    // Búsqueda AJAX al presionar Enter en el formulario
    searchForm.addEventListener("submit", (event) => {
        event.preventDefault(); // Prevenir envío estándar
        performSearch();
    });

    // Seleccionar producto y agregarlo al carrito
    resultsTable.addEventListener("click", (event) => {
        if (event.target.classList.contains("selectBtn")) {
            const codigo = event.target.getAttribute("data-codigo");
            const descripcion = event.target.getAttribute("data-descripcion");

            // Agregar a la tabla de seleccionados
            const row = document.createElement("tr");
            row.innerHTML = `<td>${codigo}</td><td>${descripcion}</td><td><button class="removeBtn" data-codigo="${codigo}">Eliminar</button></td>`;
            selectedTable.appendChild(row);

            saveCartToLocalStorage(); // Guardamos el carrito actualizado
            resultsModal.style.display = "none"; // Cerrar modal
        }
    });

    // Eliminar producto específico del carrito
    selectedTable.addEventListener("click", (event) => {
        if (event.target.classList.contains("removeBtn")) {
            // Eliminar solo la fila que contiene el botón clickeado
            const rowToRemove = event.target.closest("tr");
            rowToRemove.remove();

            saveCartToLocalStorage(); // Guardamos el carrito actualizado después de la eliminación
        }
    });

    // Cargar el carrito desde localStorage al iniciar la página
    loadCartFromLocalStorage();

    // Función para realizar la búsqueda de paciente
    const performPatientSearch = () => {
        const dni = document.getElementById("paciente").value.trim();

        if (!dni) {
            alert("Por favor ingresa el DNI del paciente.");
            return;
        }

        fetch("s-code.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: new URLSearchParams({
                action: "searchPatient",
                dni: dni
            })
        })
        .then(response => response.json())
        .then(data => {
            const patientResultsModal = document.getElementById("patientResultsModal");
            const patientResultsTable = document.getElementById("patientResultsTable");

            patientResultsTable.innerHTML = ""; // Limpiar resultados anteriores

            if (data.length > 0) {
                data.forEach(item => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${item.dni}</td>
                        <td>${item.nombre}</td>
                        <td>${item.apellido}</td>
                        <td><button class="addPatientBtn" data-dni="${item.dni}" data-nombre="${item.nombre}" data-apellido="${item.apellido}">Agregar</button></td>
                    `;
                    patientResultsTable.appendChild(row);
                });
                patientResultsModal.style.display = "block"; // Mostrar modal de resultados
            } else {
                alert("No se encontraron pacientes.");
            }
        })
        .catch(error => console.error("Error:", error));
    };

    // Búsqueda de paciente al hacer clic en el botón
    searchBtnp.addEventListener("click", performPatientSearch);

    // Agregar paciente seleccionado
    document.addEventListener("click", (event) => {
        if (event.target.classList.contains("addPatientBtn")) {
            const dni = event.target.getAttribute("data-dni");
            const nombre = event.target.getAttribute("data-nombre");
            const apellido = event.target.getAttribute("data-apellido");

            // Mostrar nombre, apellido y DNI del paciente seleccionado
            patientName.textContent = nombre;
            patientLastName.textContent = apellido;
            patientDNI.textContent = dni;
            patientInfo.style.display = "flex"; // Mostrar el contenedor de información

            // Cerrar el modal de resultados
            const patientResultsModal = document.getElementById("patientResultsModal");
            patientResultsModal.style.display = "none";
        }
    });

    // Cerrar el modal de resultados de búsqueda de pacientes
    const closePatientModal = document.querySelector("#patientResultsModal .close");
    closePatientModal.addEventListener("click", () => {
        const patientResultsModal = document.getElementById("patientResultsModal");
        patientResultsModal.style.display = "none";
    });
});
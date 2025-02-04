document.addEventListener("DOMContentLoaded", () => {
    const searchForm = document.getElementById("searchForm");
    const searchBtn = document.getElementById("searchBtn");
    const resultsModal = document.getElementById("resultsModal");
    const resultsTable = document.getElementById("resultsTable");
    const closeModal = document.querySelector(".close");
    const selectedTable = document.getElementById("selectedTable").querySelector("tbody");

    const searchBtnp = document.getElementById("searchBtnp");
    const patientSearchContainer = document.getElementById("patientSearchContainer");
    const selectedPatientContainer = document.getElementById("selectedPatientContainer");
    const patientInfo = document.getElementById("patientInfo");
    const patientDNI = document.getElementById("patientDNI");
    const patientName = document.getElementById("patientName");
    const patientLastName = document.getElementById("patientLastName");
    const removePatientBtn = document.getElementById("removePatientBtn");

    const patientResultsTable = document.getElementById("patientResultsTable");

    // Función para mostrar la información del paciente seleccionado
    const showSelectedPatient = (dni, nombre, apellido) => {
        patientDNI.textContent = dni;
        patientName.textContent = nombre;
        patientLastName.textContent = apellido;
        patientSearchContainer.style.display = "none";
        selectedPatientContainer.style.display = "block";
    };

    // Función para restaurar el campo de búsqueda
    const restoreSearchField = () => {
        patientSearchContainer.style.display = "flex";
        selectedPatientContainer.style.display = "none";
        document.getElementById("paciente").value = "";
    };

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

    // Función para cargar el carrito desde localStorage
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

    // Búsqueda de prácticas
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
            resultsTable.innerHTML = "";
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
                resultsModal.style.display = "block";
            } else {
                alert("No se encontraron resultados.");
            }
        })
        .catch(error => console.error("Error:", error));
    };

    // Búsqueda de paciente
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
            patientResultsTable.innerHTML = "";

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
                patientResultsModal.style.display = "block";
            } else {
                alert("No se encontraron pacientes.");
            }
        })
        .catch(error => console.error("Error:", error));
    };

    // Eventos para búsqueda de prácticas
    searchBtn.addEventListener("click", performSearch);
    searchForm.addEventListener("submit", (event) => {
        event.preventDefault();
        performSearch();
    });

    // Evento para búsqueda de prácticas al presionar Enter
    const codigoInput = document.getElementById("codigo");
    codigoInput.addEventListener("keydown", (event) => {
        if (event.key === "Enter") {
            event.preventDefault();
            performSearch();
        }
    });

    // Eventos para búsqueda de pacientes
    searchBtnp.addEventListener("click", performPatientSearch);

    // Evento para búsqueda de pacientes al presionar Enter
    const pacienteInput = document.getElementById("paciente");
    pacienteInput.addEventListener("keydown", (event) => {
        if (event.key === "Enter") {
            event.preventDefault();
            performPatientSearch();
        }
    });

    // Evento para el botón "Agregar" en los resultados de búsqueda de prácticas
    resultsTable.addEventListener("click", (event) => {
        if (event.target.classList.contains("selectBtn")) {
            const codigo = event.target.getAttribute("data-codigo");
            const descripcion = event.target.getAttribute("data-descripcion");

            // Agregar a la tabla de seleccionados
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${codigo}</td>
                <td>${descripcion}</td>
                <td><button class="removeBtn" data-codigo="${codigo}">Eliminar</button></td>
            `;
            selectedTable.appendChild(row);

            // Guardar en localStorage
            saveCartToLocalStorage();

            // Cerrar el modal
            resultsModal.style.display = "none";
        }
    });

    // Evento para el botón "Agregar" en los resultados de búsqueda de pacientes
    patientResultsTable.addEventListener("click", (event) => {
        if (event.target.classList.contains("addPatientBtn")) {
            const dni = event.target.getAttribute("data-dni");
            const nombre = event.target.getAttribute("data-nombre");
            const apellido = event.target.getAttribute("data-apellido");

            showSelectedPatient(dni, nombre, apellido);

            // Cerrar el modal de resultados
            const patientResultsModal = document.getElementById("patientResultsModal");
            patientResultsModal.style.display = "none";
        }
    });

    // Evento para el botón "Eliminar" en la tabla de seleccionados
    selectedTable.addEventListener("click", (event) => {
        if (event.target.classList.contains("removeBtn")) {
            const rowToRemove = event.target.closest("tr");
            rowToRemove.remove();

            // Guardar en localStorage
            saveCartToLocalStorage();
        }
    });

    // Evento para el botón "Quitar" paciente
    removePatientBtn.addEventListener("click", () => {
        restoreSearchField();
    });

    // Cerrar modales
    closeModal.addEventListener("click", () => resultsModal.style.display = "none");
    document.querySelector("#patientResultsModal .close").addEventListener("click", () => {
        document.getElementById("patientResultsModal").style.display = "none";
    });

    // Cargar el carrito desde localStorage al iniciar la página
    loadCartFromLocalStorage();

    // Nueva funcionalidad para el botón "Cancelar" (removepracticasBtn)
    const removePracticasBtn = document.getElementById("removepracticasBtn");
    removePracticasBtn.addEventListener("click", () => {
        // Limpiar la tabla de seleccionados
        selectedTable.innerHTML = "";
        // Eliminar el carrito del localStorage
        localStorage.removeItem("cart");
    });

    // Nueva funcionalidad para el botón "Confirmar" (sendBtn)
    const sendBtn = document.getElementById("sendBtn");
    sendBtn.addEventListener("click", () => {
        const patientDni = patientDNI.textContent.trim();
        const patientNombre = patientName.textContent.trim();  // Obtener nombre del paciente
        const patientApellido = patientLastName.textContent.trim();  // Obtener apellido del paciente
        const obrasocial = document.getElementById("osocial").value.trim();

        if (!patientDni || !patientNombre || !patientApellido || !obrasocial) {
            alert("Por favor, selecciona un paciente y una obra social.");
            return;
        }

        const cart = JSON.parse(localStorage.getItem("cart"));
        if (!cart || cart.length === 0) {
            alert("Por favor, agrega al menos una práctica.");
            return;
        }

        let requestsCompleted = 0;
        const totalRequests = cart.length;

        cart.forEach(item => {
            fetch("s-code.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: new URLSearchParams({
                    action: "insertNoFacturado",
                    dni: patientDni,
                    nombre: patientNombre,  // Enviar nombre
                    apellido: patientApellido,  // Enviar apellido
                    obra_social: obrasocial,
                    codigo: item.codigo
                })
            })
            .then(response => response.json())
            .then(data => {
                requestsCompleted++;
                if (requestsCompleted === totalRequests) {
                    alert("Datos guardados correctamente.");
                    localStorage.removeItem("cart");
                    selectedTable.innerHTML = "";
                    restoreSearchField();
                }
            })
            .catch(error => console.error("Error:", error));
        });
    });
});

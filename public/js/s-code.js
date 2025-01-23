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
        patientSearchContainer.style.display = "flex"; // Asegura que el contenedor de búsqueda se muestre correctamente
        selectedPatientContainer.style.display = "none";
        document.getElementById("paciente").value = ""; // Limpiar el campo de búsqueda
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

    // Eventos
    searchBtn.addEventListener("click", performSearch);
    searchForm.addEventListener("submit", (event) => {
        event.preventDefault();
        performSearch();
    });
    searchBtnp.addEventListener("click", performPatientSearch);

    // Agregar práctica al carrito
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

    // Eliminar práctica del carrito
    selectedTable.addEventListener("click", (event) => {
        if (event.target.classList.contains("removeBtn")) {
            const rowToRemove = event.target.closest("tr");
            rowToRemove.remove();

            // Guardar en localStorage
            saveCartToLocalStorage();
        }
    });

    // Agregar paciente seleccionado
    document.addEventListener("click", (event) => {
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

    // Quitar paciente seleccionado
    removePatientBtn.addEventListener("click", restoreSearchField);

    // Cerrar modales
    closeModal.addEventListener("click", () => resultsModal.style.display = "none");
    document.querySelector("#patientResultsModal .close").addEventListener("click", () => {
        document.getElementById("patientResultsModal").style.display = "none";
    });

    // Cargar el carrito desde localStorage al iniciar la página
    loadCartFromLocalStorage();
});
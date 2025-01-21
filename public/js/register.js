document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("registerForm");
  
    form.addEventListener("submit", async (event) => {
      event.preventDefault(); // Evita el envío tradicional del formulario
  
      const formData = new FormData(form);
  
      try {
        const response = await fetch(form.action, {
          method: form.method,
          body: formData,
        });
  
        if (response.ok) {
          const result = await response.json(); // Asegúrate de que el servidor devuelva un JSON
          if (result.success) {
            alert(result.message || "¡Registro exitoso!");
            window.location.href = "./login.html"; // Redirigir al login
          } else {
            alert(result.message || "Hubo un problema con el registro.");
          }
        } else {
          alert("Error en la comunicación con el servidor.");
        }
      } catch (error) {
        alert("Ocurrió un error: " + error.message);
      }
    });
  });
  
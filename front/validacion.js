(function () {
  'use strict'

  // Seleccionar elementos
  const formulario = document.getElementById('formularioEvento');
  const password = document.getElementById('password');
  const passwordConfirm = document.getElementById('password_confirm');
  const mensajeResultado = document.getElementById('mensajeResultado');

  // Evento de envío del formulario
  formulario.addEventListener('submit', function (event) {
    event.preventDefault();
    event.stopPropagation();

    // Validar formulario HTML5
    if (!formulario.checkValidity()) {
      formulario.classList.add('was-validated');
      return; // Detener si hay errores
    }

    // Validar que las contraseñas coinciden
    if (password.value !== passwordConfirm.value) {
      passwordConfirm.classList.add('is-invalid');
      formulario.classList.add('was-validated');
      return; // Detener si no coinciden
    } else {
      passwordConfirm.classList.remove('is-invalid');
    }

    // Si llegamos aquí, el formulario es válido
    formulario.classList.add('was-validated');
    
    // Enviar datos con fetch
    enviarFormulario();
  });

  //Función que envía el formulario con fetch
  function enviarFormulario() {

    // Mostrar mensaje de carga
    mostrarMensaje('info', 'Enviando datos...', true);

    // Preparar los datos del formulario
    const formData = new FormData(formulario);

    // Enviar con fetch
    fetch('../back/procesar_evento.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json()) // Convertir respuesta a JSON
    .then(data => {
      // Procesar respuesta
      if (data.exito) {
        mostrarMensajeExito(data);
      } else {
        mostrarMensajeError(data);
      }
    })
    .catch(error => {
      // Error de red o del servidor
      mostrarMensaje('danger', 'Error de conexión: ' + error.message);
      console.error('Error:', error);
    });
  }

  //Función que muestra mensaje de éxito con los datos
  function mostrarMensajeExito(data) {
    let html = `
      <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <h4 class="alert-heading"> ${data.mensaje}</h4>
        <p>Los datos se han procesado correctamente:</p>
        <ul>
          <li><strong>Nombre:</strong> ${data.datos.nombre}</li>
          <li><strong>Email:</strong> ${data.datos.email}</li>
          <li><strong>Usuario:</strong> ${data.datos.username}</li>
        </ul>
      </div>
    `;
    
    mensajeResultado.innerHTML = html;

  }

   //Mostrar mensaje de error

  function mostrarMensajeError(data) {
    let html = `
      <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <h4 class="alert-heading">${data.mensaje}</h4>
    `;
    
    if (data.errores && data.errores.length > 0) {
      html += '<ul>';
      data.errores.forEach(error => {
        html += `<li>${error}</li>`;
      });
      html += '</ul>';
    }
    
    html += '</div>';
    mensajeResultado.innerHTML = html;
  }

  
    //Mostrar mensaje genérico
  
  function mostrarMensaje(tipo, mensaje, soloTexto = false) {
    if (soloTexto) {
      mensajeResultado.innerHTML = `<div class="alert alert-${tipo}">${mensaje}</div>`;
    } else {
      mensajeResultado.innerHTML = `
        <div class="alert alert-${tipo} alert-dismissible fade show">
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          ${mensaje}
        </div>
      `;
    }
  }

})();

// Slider de valoración (igual que antes)
const slider = document.getElementById('valoracion');
const output = document.getElementById('valorValoracion');

if (slider && output) {
  output.textContent = slider.value;
  slider.addEventListener('input', function () {
    output.textContent = slider.value;
  });
}
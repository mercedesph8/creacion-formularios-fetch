# Formulario de Registro de Eventos - Versión Moderna (Fetch)

## Descripción
Este proyecto es un formulario completo de registro para eventos que utiliza tecnología moderna (fetch API). A diferencia de la versión tradicional, cuando el usuario envía el formulario, la página NO se recarga y se muestra un mensaje de confirmación dinámico en la misma página.

## Cómo usar

### Requisitos previos:
- XAMPP (o cualquier servidor con Apache y PHP)
- Navegador web moderno

### Instalación:
1. Copia la carpeta `creacion-formularios-fetch` en `C:\xampp\htdocs\`
2. Inicia Apache desde el panel de control de XAMPP
3. Abre tu navegador y ve a: `http://localhost/creacion-formularios-fetch/front/formulario.html`

### Flujo de datos:
Usuario rellena formulario → Click "Enviar" 
Validación JavaScript → event.preventDefault() 
fetch() envía datos → PHP procesa 
Devuelve JSON → JavaScript muestra mensaje 
La página no se recarga

### Estructura de respuesta JSON:
```json
{
  "exito": true,
  "mensaje": "¡Registro exitoso!",
  "datos": {
    "nombre": "Mercedes Peña",
    "email": "mercedesph8@gmail.com",
    "username": "mercedes123",
    ...
  }
}
```
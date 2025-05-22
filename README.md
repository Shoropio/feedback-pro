# 📝 Feedback Pro
### Sistema de Feedback con Captura de Pantalla

---

## 📌 Descripción

**Feedback Pro** es un sistema interactivo que permite a los usuarios compartir su experiencia de forma rápida y visual. Incluye calificación con estrellas, comentarios detallados y la posibilidad de adjuntar capturas de pantalla (completa o por área).

Ideal para recolectar retroalimentación en sitios web, mejorar la experiencia del usuario y facilitar la detección de problemas visuales.

---

## ✨ Características Principales

- 🖱️ **Botón flotante** accesible desde cualquier parte de la página
- ⭐ **Sistema de calificación** con estrellas interactivas (1 a 5)
- 📸 **Herramienta de captura** de pantalla:
  - Captura completa
  - Selección de área personalizada
- 👁️ **Previsualización en tiempo real** de la imagen capturada
- 🧩 **Diseño responsive**, compatible con móviles y escritorio
- 🎨 **Estilos personalizables** mediante variables CSS

---

## 🛠️ Tecnologías Utilizadas

- HTML / CSS / JavaScript
- [Bootstrap 5](https://getbootstrap.com/)
- [Font Awesome](https://fontawesome.com/)
- [html2canvas](https://html2canvas.hertzen.com/)

---

## 🚀 Cómo Implementarlo

1. **Incluye las siguientes dependencias en tu HTML:**

```html
<!-- CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- JS -->
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
```

2. **Copia el HTML/CSS del componente de feedback**

3. **Agrega el JavaScript necesario (ver sección de implementación)**

---

## 🎨 Personalización

Puedes modificar fácilmente el estilo del sistema editando las siguientes variables CSS:

```css
:root {
  --primary-color: #4361ee;
  --primary-hover: #3a56d4;
  --secondary-color: #3f37c9;
  --accent-color: #4895ef;
  --light-bg: #f8f9ff;
  --dark-text: #2b2d42;
  --light-text: #8d99ae;
  --border-radius: 8px;
  --box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
}
```

---

## 📸 Funcionamiento de la Captura

- **Captura completa**: Toma una screenshot de toda la página actual.
- **Captura de área**:
  - Activa un overlay oscuro sobre la página.
  - Permite seleccionar un área rectangular.
  - Muestra una previsualización inmediata.
  - Incluye opción para eliminar y volver a capturar.

---

## 📝 Datos Recolectados

El formulario de feedback recopila:

- Calificación (1 a 5 estrellas)
- Comentario escrito del usuario
- Captura de pantalla (formato base64)

---

## 🌍 Compatibilidad

Probado y funcional en los principales navegadores y dispositivos:

- ✅ Chrome (última versión)
- ✅ Firefox
- ✅ Edge
- ✅ Safari
- ✅ iOS y Android

---

## ☕ Invítame un Café

Si este proyecto te ha sido útil, ¡puedes invitarme un café!
Tu apoyo ayuda a seguir creando herramientas como esta. 🙌

[☕ Invitar un café](https://buymeacoffee.com/shoropio)

---

## 📜 Licencia

Este proyecto es **software libre y de uso abierto para todos**.
Puedes usarlo, modificarlo y distribuirlo libremente en proyectos personales o comerciales.

Licencia: **MIT**

---

¿Tienes dudas o quieres extender alguna funcionalidad?
**¡No dudes en preguntar! Estoy para ayudarte.**
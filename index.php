<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Feedback Pro | Shoropio Corp.</title>

        <!-- Open Graph Meta Tags -->
        <meta property="og:title" content="Feedback con Captura de Pantalla" />
        <meta property="og:description" content="Interfaz de feedback visual con captura completa o por área y calificación por estrellas. Ideal para mejorar UX en tus proyectos." />
        <meta property="og:image" content="https://tusitio.com/preview.jpg" />
        <meta property="og:url" content="https://tusitio.com/feedback-demo" />
        <meta property="og:type" content="website" />
        <meta property="og:locale" content="es_ES" />
        <meta name="author" content="Tu Nombre o Equipo" />

        <!-- Twitter Card Meta Tags -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="Feedback con Captura de Pantalla" />
        <meta name="twitter:description" content="Interfaz de feedback visual con captura de pantalla. Útil para aplicaciones web modernas." />
        <meta name="twitter:image" content="https://tusitio.com/preview.jpg" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
        <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
        <style>
            :root {
                --primary-color: #4361ee;
                --primary-hover: #3a56d4;
                --secondary-color: #3f37c9;
                --accent-color: #4895ef;
                --light-bg: #f8f9ff;
                --dark-text: #2b2d42;
                --light-text: #8d99ae;
                --border-radius: 0px;
                --box-shadow: 0 8px 24px rgba(0,0,0,0.08);
                --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            }

            body {
                font-family: 'Inter', sans-serif;
                min-height: 150vh;
                background-color: #f8f9fa;
            }

            .star-rating {
                display: inline-block;
                font-size: 2em;
                cursor: pointer;
                vertical-align: middle;
                line-height: 1;
            }
            .star {
                color: #ccc;
                transition: color 0.2s;
            }

            .star.active {
                color: gold;
            }

            #screenshotOverlay {
                display: none;
                position: fixed;
                top: 0; left: 0;
                width: 100%; height: 100%;
                background: rgba(0,0,0,0.5);
                z-index: 9999;
                cursor: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><line x1="12" y1="0" x2="12" y2="24" stroke="black" stroke-width="4"/><line x1="0" y1="12" x2="24" y2="12" stroke="black" stroke-width="4"/><line x1="12" y1="0" x2="12" y2="24" stroke="white" stroke-width="2"/><line x1="0" y1="12" x2="24" y2="12" stroke="white" stroke-width="2"/></svg>') 12 12, crosshair;
            }

            #selectionBox {
                position: absolute;
                border: 2px dashed #fff;
                background: rgba(0,255,255,0.2);
                box-sizing: border-box;
            }

            #screenshotSpinner {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                height: 100px;
            }

            .floating-feedback-button, .btn-feedback {
                position: fixed;
                bottom: 30px;
                right: 30px;
                z-index: 1060;
                padding: 12px 24px;
                font-size: 1.1em;
                font-weight: 600;
                border-radius: 50px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.2);
                transition: all 0.3s ease;
                border: none;
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                color: #fff;
            }

            .floating-feedback-button:hover, .btn-feedback:hover {
                transform: translateY(-3px);
                box-shadow: 0 6px 20px rgba(67, 97, 238, 0.4);
            }

            .example-content {
                height: 800px;
                background-color: #e9ecef;
                padding: 50px;
                margin-top: 50px;
                border-radius: 0px;
                text-align: center;
                color: #495057;
            }

            #screenshotPreviewContainer {
                background-color: var(--light-bg);
                border: 1px dashed #d0d0d0;
                border-radius: var(--border-radius);
                transition: var(--transition);
                padding: 1rem;
            }

            #screenshotPreview {
                max-width: 100%;
                object-fit: contain;
                border-radius: var(--border-radius);
            }

            .modal-content {
                background-color: #f8f9fa;
                border: none;
                box-shadow: 0 10px 30px rgba(0,0,0,0.15);
                border-radius: 12px;
                overflow: hidden;
            }

            .modal-header {
                background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
                color: white;
                border-bottom: none;
                padding: 20px 25px;
            }

            .modal-title {
                font-weight: 600;
                font-size: 1.5rem;
            }

            .modal-header .btn-close {
                display: none;
            }

            .modal-body {
                padding: 25px;
            }

            .form-control {
                border: 1px solid #e0e0e0;
                border-radius: 8px;
                padding: 12px 15px;
                transition: all 0.3s ease;
                background-color: #fff;
            }

            .form-control:focus {
                border-color: #2575fc;
                box-shadow: 0 0 0 0.25rem rgba(37,117,252,0.25);
            }

            .form-label {
                font-weight: 500;
                color: #495057;
                margin-bottom: 8px;
            }

            .modal-footer {
                border-top: none;
                padding: 15px 25px;
                background-color: #f1f3f5;
                font-size: 0.85rem;
                color: #6c757d;
                text-align: center;
            }

            .btn {
                border-radius: 0;
                font-weight: 600;
                padding: 10px 20px;
                transition: all 0.3s;
            }

            @media (max-width: 768px) {
                .btn-feedback {
                    bottom: 20px;
                    right: 20px;
                    padding: 10px 20px;
                }
            }
        </style>
    </head>
    <body>
        <!-- Botón flotante para feedback -->
        <button type="button" class="btn btn-feedback text-white" data-bs-toggle="modal" data-bs-target="#feedbackModal" id="mainFeedbackButton">
            <i class="fas fa-comment-alt me-2"></i>Enviar Feedback
        </button>

        <div class="container my-5">
            <h1 class="text-center mb-4">Demo de Feedback con Captura</h1>
            <p class="text-center">Haz clic en el botón flotante para enviar tu feedback, incluyendo una captura de pantalla.</p>

            <div class="example-content">
                <h2>Contenido de Ejemplo</h2>
                <p>Desplázate hacia abajo para ver el botón flotante en acción.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <p>Curabitur pretium tincidunt lacus. Nulla gravida orci a odio. Nullam varius, turpis et commodo pharetra, est eros bibendum elit, nec luctus magna felis sollicitudin mauris. Integer in mauris eu nibh euismod gravida. Duis ac tellus et risus auctor iaculis. Mauris vel nisl quis ipsum rutrum pharetra. Nulla facilisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui.</p>
                <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed id erat quis nisl rutrum interdum. Ut a est eget urna mollis tincidunt. Nulla facilisi. Sed non risus. Suspendisse lectus. Proin a velit. Maecenas tristique orci ac sem. Duis ultricies pharetra magna. Donec accumsan interdum orci. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris accumsan ligula fermentum sem. Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos.</p>
            </div>

            <div class="modal fade" id="feedbackModal" tabindex="-1" data-bs-backdrop="false" aria-labelledby="feedbackModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable feedback-modal rounded-0">
                    <div class="modal-content rounded-0 shadow-lg">
                        <div class="modal-header border-bottom-0 rounded-0">
                            <h5 class="modal-title">Envíanos tu Feedback</h5>
                        </div>
                        <div class="modal-body pt-3">
                            <form id="feedbackForm">
                                <div class="mb-3">
                                    <label for="rating" class="form-label fw-bold">Califica tu experiencia:</label>
                                    <div class="star-rating" id="starRating" role="radiogroup" aria-label="Calificación con estrellas">
                                        <span class="star" data-value="1" tabindex="0" role="radio" aria-checked="false" aria-label="1 estrella">★</span>
                                        <span class="star" data-value="2" tabindex="0" role="radio" aria-checked="false" aria-label="2 estrellas">★</span>
                                        <span class="star" data-value="3" tabindex="0" role="radio" aria-checked="false" aria-label="3 estrellas">★</span>
                                        <span class="star" data-value="4" tabindex="0" role="radio" aria-checked="false" aria-label="4 estrellas">★</span>
                                        <span class="star" data-value="5" tabindex="0" role="radio" aria-checked="false" aria-label="5 estrellas">★</span>
                                    </div>
                                    <input type="hidden" id="selectedRating" name="rating" value="0">
                                </div>
                                <div class="mb-3">
                                    <label for="comments" class="form-label fw-bold">Tus comentarios:</label>
                                    <textarea class="form-control rounded-0" id="comments" name="comments" rows="4" placeholder="Escribe tus comentarios aquí..."></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Incluir captura de pantalla:</label>
                                    <div class="d-flex flex-wrap gap-2">
                                        <button type="button" class="btn btn-outline-secondary btn-sm rounded-0" id="captureFullPage">
                                            <i class="fas fa-desktop me-1"></i> Captura completa
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm rounded-0" id="captureArea">
                                            <i class="fas fa-crop-alt me-1"></i> Captura de área
                                        </button>
                                    </div>
                                    <div id="screenshotPreviewContainer" class="mt-3 p-3 border bg-light" style="display: none;">
                                        <!-- <h6 class="mb-2 text-primary">Vista previa de la captura:</h6> -->
                                        <img id="screenshotPreview" class="img-fluid border rounded-3 shadow-sm" alt="Vista previa de la captura de pantalla">
                                        <input type="hidden" id="screenshotBase64" name="screenshotBase64" value="">
                                        <button type="button" class="btn btn-sm btn-danger rounded-0 mt-3" id="removeScreenshot">
                                            <i class="fas fa-trash-alt me-1"></i> Eliminar captura
                                        </button>
                                    </div>
                                    <div id="screenshotSpinner" class="text-center mt-3" style="display: none;">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Cargando...</span>
                                        </div>
                                        <p class="mt-2 text-muted">Generando captura...</p>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer border-top-0">
                            <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary rounded-0" id="submitFeedback">
                                <i class="fas fa-paper-plane me-1"></i> Enviar Feedback
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="screenshotOverlay">
                <div id="selectionBox"></div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const feedbackModal = document.getElementById('feedbackModal');
                const starRatingContainer = document.getElementById('starRating');
                const stars = starRatingContainer.querySelectorAll('.star');
                const selectedRatingInput = document.getElementById('selectedRating');
                const captureFullPageBtn = document.getElementById('captureFullPage');
                const captureAreaBtn = document.getElementById('captureArea');
                const screenshotPreviewContainer = document.getElementById('screenshotPreviewContainer');
                const screenshotPreview = document.getElementById('screenshotPreview');
                const screenshotBase64Input = document.getElementById('screenshotBase64');
                const removeScreenshotBtn = document.getElementById('removeScreenshot');
                const screenshotSpinner = document.getElementById('screenshotSpinner');
                const submitFeedbackBtn = document.getElementById('submitFeedback');
                const commentsTextArea = document.getElementById('comments');
                const mainFeedbackButton = document.getElementById('mainFeedbackButton');

                const screenshotOverlay = document.getElementById('screenshotOverlay');
                const selectionBox = document.getElementById('selectionBox');

                let isSelectingArea = false;
                let startX, startY;
                let currentRating = 0;

                function updateStars(rating) {
                    stars.forEach((star, index) => {
                        if (index < rating) {
                            star.classList.add('active');
                            star.setAttribute('aria-checked', 'true');
                        } else {
                            star.classList.remove('active');
                            star.setAttribute('aria-checked', 'false');
                        }
                    });
                    selectedRatingInput.value = rating;
                    currentRating = rating;
                }

                function showSpinner() {
                    screenshotPreviewContainer.style.display = 'none';
                    screenshotSpinner.style.display = 'flex';
                }

                function hideSpinner() {
                    screenshotSpinner.style.display = 'none';
                }

                function resetSelectionOverlay() {
                    isSelectingArea = false;
                    screenshotOverlay.style.display = 'none';
                    selectionBox.style.display = 'none';
                    selectionBox.style.width = '0px';
                    selectionBox.style.height = '0px';
                    document.body.style.overflow = '';
                    startX = undefined;
                    startY = undefined;
                }

                starRatingContainer.addEventListener('click', (event) => {
                    const target = event.target;
                    if (target.classList.contains('star')) {
                        const value = parseInt(target.dataset.value);
                        updateStars(value);
                    }
                });

                starRatingContainer.addEventListener('keydown', (event) => {
                    const focusedStar = document.activeElement;
                    if (focusedStar && focusedStar.classList.contains('star')) {
                        let value = parseInt(focusedStar.dataset.value);

                        if (event.key === 'ArrowRight' || event.key === 'ArrowUp') {
                            event.preventDefault();
                            value = Math.min(5, value + 1);
                            updateStars(value);
                            if (focusedStar.nextElementSibling && focusedStar.nextElementSibling.classList.contains('star')) {
                                focusedStar.nextElementSibling.focus();
                            }
                        } else if (event.key === 'ArrowLeft' || event.key === 'ArrowDown') {
                            event.preventDefault();
                            value = Math.max(1, value - 1);
                            updateStars(value);
                            if (focusedStar.previousElementSibling && focusedStar.previousElementSibling.classList.contains('star')) {
                                focusedStar.previousElementSibling.focus();
                            }
                        } else if (event.key === 'Enter' || event.key === ' ') {
                            event.preventDefault();
                            updateStars(value);
                        }
                    }
                });

                // Ocultar el botón principal al abrir el modal
                feedbackModal.addEventListener('show.bs.modal', () => {
                    updateStars(0);
                    commentsTextArea.value = '';

                    if (screenshotBase64Input.value === '') {
                        screenshotPreviewContainer.style.display = 'none';
                        screenshotPreview.src = '';
                    }
                    if (mainFeedbackButton) {
                        mainFeedbackButton.style.display = 'none';
                    }
                });

                // Mostrar el botón principal al cerrar el modal
                feedbackModal.addEventListener('hidden.bs.modal', () => {
                    if (mainFeedbackButton) {
                        mainFeedbackButton.style.display = 'block';
                    }
                });

                captureFullPageBtn.addEventListener('click', async () => {
                    const modalInstance = bootstrap.Modal.getInstance(feedbackModal);
                    if (modalInstance) {
                        modalInstance.hide();
                    }

                    showSpinner();

                    feedbackModal.addEventListener('hidden.bs.modal', async function captureAfterModalHidden() {
                        feedbackModal.removeEventListener('hidden.bs.modal', captureAfterModalHidden);

                        try {
                            const canvas = await html2canvas(document.body, {
                                logging: true,
                                useCORS: true
                            });
                            const imageData = canvas.toDataURL('image/png');
                            screenshotPreview.src = imageData;
                            screenshotBase64Input.value = imageData;
                            screenshotPreviewContainer.style.display = 'block';
                        } catch (error) {
                            console.error('Error al capturar la página completa:', error);
                            alert('No se pudo tomar la captura de pantalla completa.');
                        } finally {
                            hideSpinner();
                            modalInstance.show();
                        }
                    });
                });

                captureAreaBtn.addEventListener('click', () => {
                    const modalInstance = bootstrap.Modal.getInstance(feedbackModal);
                    if (modalInstance) {
                        modalInstance.hide();
                    }

                    feedbackModal.addEventListener('hidden.bs.modal', function showOverlayAfterModalHidden() {
                        feedbackModal.removeEventListener('hidden.bs.modal', showOverlayAfterModalHidden);

                        document.body.style.overflow = 'hidden';
                        screenshotOverlay.style.display = 'block';
                        isSelectingArea = true;

                        selectionBox.style.width = '0px';
                        selectionBox.style.height = '0px';
                        selectionBox.style.left = '0px';
                        selectionBox.style.top = '0px';
                        selectionBox.style.display = 'none';
                    });
                });

                screenshotOverlay.addEventListener('mousedown', (e) => {
                    if (!isSelectingArea) return;
                    e.preventDefault();

                    startX = e.clientX;
                    startY = e.clientY;

                    selectionBox.style.left = `${startX}px`;
                    selectionBox.style.top = `${startY}px`;
                    selectionBox.style.width = '0px';
                    selectionBox.style.height = '0px';
                    selectionBox.style.display = 'block';
                });

                screenshotOverlay.addEventListener('mousemove', (e) => {
                    if (!isSelectingArea || startX === undefined || startY === undefined) return;

                    const currentX = e.clientX;
                    const currentY = e.clientY;

                    const width = Math.abs(currentX - startX);
                    const height = Math.abs(currentY - startY);
                    const left = Math.min(startX, currentX);
                    const top = Math.min(startY, currentY);

                    selectionBox.style.left = `${left}px`;
                    selectionBox.style.top = `${top}px`;
                    selectionBox.style.width = `${width}px`;
                    selectionBox.style.height = `${height}px`;
                });

                screenshotOverlay.addEventListener('mouseup', async () => {
                    if (!isSelectingArea || startX === undefined || startY === undefined) return;

                    const currentRect = selectionBox.getBoundingClientRect();
                    console.log('getBoundingClientRect() en mouseup (valor real del viewport):', currentRect);

                    resetSelectionOverlay();

                    if (currentRect.width < 10 || currentRect.height < 10) {
                        console.warn('Área de selección demasiado pequeña. No se tomará captura.');
                        const modalInstance = new bootstrap.Modal(feedbackModal);
                        modalInstance.show();
                        return;
                    }

                    const scrollX = window.scrollX || window.pageXOffset;
                    const scrollY = window.scrollY || window.pageYOffset;

                    const captureX = currentRect.left + scrollX;
                    const captureY = currentRect.top + scrollY;
                    const captureWidth = currentRect.width;
                    const captureHeight = currentRect.height;

                    console.log('DEBUG: Coordenadas de captura finales para html2canvas (documento):', {
                        x: captureX,
                        y: captureY,
                        width: captureWidth,
                        height: captureHeight
                    });

                    showSpinner();
                    try {
                        const canvas = await html2canvas(document.body, {
                            x: captureX,
                            y: captureY,
                            width: captureWidth,
                            height: captureHeight,
                            logging: true,
                            useCORS: true
                        });

                        const imageData = canvas.toDataURL('image/png');
                        console.log('DEBUG: Longitud de imageData generada:', imageData.length);

                        if (imageData.length > 100) {
                            screenshotPreview.src = imageData;
                            screenshotBase64Input.value = imageData;
                            screenshotPreviewContainer.style.display = 'block';
                        } else {
                            console.warn('html2canvas devolvió una imagen muy pequeña o vacía.');
                            alert('No se pudo capturar el área seleccionada correctamente. El contenido podría estar vacío o haber un problema de renderizado.');
                            screenshotPreviewContainer.style.display = 'none';
                            screenshotPreview.src = '';
                            screenshotBase64Input.value = '';
                        }

                    } catch (error) {
                        console.error('Error al capturar el área seleccionada con html2canvas:', error);
                        alert('Hubo un error al tomar la captura de pantalla. Revisa la consola para más detalles.');
                        screenshotPreviewContainer.style.display = 'none';
                        screenshotPreview.src = '';
                        screenshotBase64Input.value = '';
                    } finally {
                        hideSpinner();
                        const modalInstance = new bootstrap.Modal(feedbackModal);
                        modalInstance.show();
                    }
                });

                removeScreenshotBtn.addEventListener('click', () => {
                    screenshotPreview.src = '';
                    screenshotBase64Input.value = '';
                    screenshotPreviewContainer.style.display = 'none';
                });

                submitFeedbackBtn.addEventListener('click', () => {
                    const rating = parseInt(selectedRatingInput.value);
                    const comments = commentsTextArea.value.trim();
                    const screenshot = screenshotBase64Input.value;

                    if (rating === 0) {
                        alert('Por favor, califica tu experiencia con al menos una estrella.');
                        return;
                    }

                    const feedbackData = {
                        rating: rating,
                        comments: comments,
                        screenshot: screenshot
                    };

                    // Ejemplo de envío con Fetch API (descomentar para usar)
                    /* fetch('/api/feedback', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(feedbackData)
                    })
                    .then(response => {
                        if (response.ok) {
                            alert('¡Gracias por tu feedback!');
                            const modalInstance = bootstrap.Modal.getInstance(feedbackModal);
                            if (modalInstance) {
                                modalInstance.hide();
                            }
                        } else {
                            alert('Hubo un error al enviar tu feedback. Por favor, inténtalo de nuevo.');
                        }
                    })
                    .catch(error => {
                        console.error('Error al enviar feedback:', error);
                        alert('Hubo un error de red. Por favor, inténtalo de nuevo.');
                    }); */

                    console.log('Feedback a enviar:', feedbackData);
                    alert('¡Gracias por tu feedback! (Simulado)');

                    const modalInstance = bootstrap.Modal.getInstance(feedbackModal);
                    if (modalInstance) {
                        modalInstance.hide();
                    }
                });
            });
        </script>
    </body>
</html>
ツ
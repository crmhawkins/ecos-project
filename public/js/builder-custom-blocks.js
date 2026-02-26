/**
 * Bloques personalizados preestilizados para GrapesJS
 * Con estilos de la marca (fuchsia/púrpura)
 */

(function() {
    'use strict';

    const customBlocks = {
        // Hero Section con gradiente (Encabezado)
        heroSection: {
            label: 'Encabezado',
            category: 'Preestilizados',
            content: {
                type: 'section',
                tagName: 'section',
                classes: ['hero-section'],
                components: [
                    {
                        type: 'text',
                        tagName: 'div',
                        classes: ['container'],
                        components: [
                            {
                                type: 'text',
                                tagName: 'div',
                                classes: ['row', 'justify-content-center'],
                                components: [
                                    {
                                        type: 'text',
                                        tagName: 'div',
                                        classes: ['col-lg-8', 'text-center'],
                                        components: [
                                            {
                                                type: 'text',
                                                tagName: 'h1',
                                                classes: ['hero-title'],
                                                components: [
                                                    {
                                                        type: 'textnode',
                                                        content: 'Bienvenido a Nuestra Academia'
                                                    }
                                                ]
                                            },
                                            {
                                                type: 'text',
                                                tagName: 'p',
                                                classes: ['hero-subtitle'],
                                                components: [
                                                    {
                                                        type: 'textnode',
                                                        content: 'Descripción del encabezado con texto destacado'
                                                    }
                                                ]
                                            },
                                            {
                                                type: 'link',
                                                classes: ['hero-btn'],
                                                components: [
                                                    {
                                                        type: 'textnode',
                                                        content: 'Comenzar'
                                                    }
                                                ],
                                                attributes: {
                                                    href: '#'
                                                }
                                            }
                                        ]
                                    }
                                ]
                            }
                        ]
                    }
                ]
            },
            style: `
                .hero-section {
                    background: linear-gradient(135deg, #D93690 0%, #667eea 100%);
                    padding: 120px 0 80px 0;
                    color: white;
                    position: relative;
                    overflow: hidden;
                    min-height: 100vh;
                    display: flex;
                    align-items: center;
                    text-align: center;
                }
                .hero-section::before {
                    content: '';
                    position: absolute;
                    top: 0; left: 0; right: 0; bottom: 0;
                    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
                    opacity: 0.3;
                }
                .hero-title {
                    font-size: 4rem;
                    font-weight: 800;
                    margin-bottom: 20px;
                    text-shadow: 0 2px 10px rgba(0,0,0,0.2);
                    color: white !important;
                    line-height: 1.2;
                }
                .hero-subtitle {
                    font-size: 1.3rem;
                    margin-bottom: 30px;
                    opacity: 0.9;
                    line-height: 1.6;
                }
                .hero-btn {
                    background: rgba(255, 255, 255, 0.2);
                    color: white;
                    border: 2px solid rgba(255, 255, 255, 0.3);
                    padding: 15px 40px;
                    border-radius: 50px;
                    font-weight: 600;
                    font-size: 16px;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                    transition: all 0.3s ease;
                    text-decoration: none;
                    display: inline-flex;
                    align-items: center;
                    gap: 10px;
                    backdrop-filter: blur(10px);
                }
                .hero-btn:hover {
                    background: rgba(255, 255, 255, 0.3);
                    color: white;
                    text-decoration: none;
                    transform: translateY(-2px);
                    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
                }
            `
        },

        // Card moderna
        modernCard: {
            label: 'Card Moderna',
            category: 'Preestilizados',
            content: {
                type: 'card-modern',
                classes: ['modern-card'],
                components: [
                    {
                        type: 'text',
                        tagName: 'h3',
                        classes: ['card-title'],
                        components: [
                            {
                                type: 'textnode',
                                content: 'Título de la Card'
                            }
                        ]
                    },
                    {
                        type: 'text',
                        tagName: 'p',
                        classes: ['card-text'],
                        components: [
                            {
                                type: 'textnode',
                                content: 'Contenido de la card con estilo moderno y gradiente.'
                            }
                        ]
                    },
                    {
                        type: 'link',
                        classes: ['card-btn'],
                        components: [
                            {
                                type: 'textnode',
                                content: 'Leer más'
                            }
                        ],
                        attributes: {
                            href: '#'
                        }
                    }
                ]
            },
            style: `
                .modern-card {
                    background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
                    border-radius: 25px;
                    padding: 50px;
                    box-shadow: 0 20px 60px rgba(0,0,0,0.1);
                    border: 1px solid #e2e8f0;
                    position: relative;
                    overflow: hidden;
                }
                .modern-card::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    height: 6px;
                    background: linear-gradient(135deg, #D93690 0%, #ff6b9d 50%, #667eea 100%);
                }
                .card-title {
                    color: #2d3748;
                    font-weight: 800;
                    font-size: 28px;
                    margin-bottom: 20px;
                }
                .card-text {
                    color: #4a5568;
                    font-size: 16px;
                    line-height: 1.6;
                    margin-bottom: 25px;
                }
                .card-btn {
                    background: linear-gradient(135deg, #D93690 0%, #ff6b9d 100%);
                    color: white;
                    padding: 12px 30px;
                    border-radius: 50px;
                    text-decoration: none;
                    font-weight: 600;
                    display: inline-block;
                    transition: all 0.3s ease;
                }
                .card-btn:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 10px 20px rgba(217, 54, 144, 0.3);
                    color: white;
                    text-decoration: none;
                }
            `
        },

        // Botón primario
        primaryButton: {
            label: 'Botón Primario',
            category: 'Preestilizados',
            content: {
                type: 'link',
                classes: ['btn-primary-custom'],
                components: [
                    {
                        type: 'textnode',
                        content: 'Botón Primario'
                    }
                ],
                attributes: {
                    href: '#'
                }
            },
            style: `
                .btn-primary-custom {
                    background: linear-gradient(135deg, #D93690 0%, #ff6b9d 100%);
                    color: white;
                    border: 2px solid transparent;
                    padding: 15px 40px;
                    border-radius: 50px;
                    font-weight: 600;
                    font-size: 16px;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                    transition: all 0.3s ease;
                    text-decoration: none;
                    display: inline-block;
                    box-shadow: 0 4px 12px rgba(217, 54, 144, 0.3);
                }
                .btn-primary-custom:hover {
                    background: linear-gradient(135deg, #ff6b9d 0%, #D93690 100%);
                    transform: translateY(-2px);
                    box-shadow: 0 6px 16px rgba(217, 54, 144, 0.4);
                    color: white;
                    text-decoration: none;
                }
            `
        },

        // Botón secundario
        secondaryButton: {
            label: 'Botón Secundario',
            category: 'Preestilizados',
            content: {
                type: 'link',
                classes: ['btn-secondary-custom'],
                components: [
                    {
                        type: 'textnode',
                        content: 'Botón Secundario'
                    }
                ],
                attributes: {
                    href: '#'
                }
            },
            style: `
                .btn-secondary-custom {
                    background: transparent;
                    color: #D93690;
                    border: 2px solid #D93690;
                    padding: 15px 40px;
                    border-radius: 50px;
                    font-weight: 600;
                    font-size: 16px;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                    transition: all 0.3s ease;
                    text-decoration: none;
                    display: inline-block;
                }
                .btn-secondary-custom:hover {
                    background: #D93690;
                    color: white;
                    transform: translateY(-2px);
                    text-decoration: none;
                }
            `
        },

        // Sección con fondo degradado
        gradientSection: {
            label: 'Sección con Fondo',
            category: 'Preestilizados',
            content: {
                type: 'section',
                classes: ['gradient-section'],
                components: [
                    {
                        type: 'text',
                        tagName: 'h2',
                        classes: ['section-title'],
                        components: [
                            {
                                type: 'textnode',
                                content: 'Título de Sección'
                            }
                        ]
                    },
                    {
                        type: 'text',
                        tagName: 'p',
                        classes: ['section-text'],
                        components: [
                            {
                                type: 'textnode',
                                content: 'Contenido de la sección con fondo degradado moderno.'
                            }
                        ]
                    }
                ]
            },
            style: `
                .gradient-section {
                    padding: 80px 0;
                    background: linear-gradient(135deg, #f8fafc 0%, #e9ecef 100%);
                    position: relative;
                }
                .gradient-section::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    height: 4px;
                    background: linear-gradient(135deg, #D93690 0%, #ff6b9d 50%, #667eea 100%);
                }
                .section-title {
                    color: #2d3748;
                    font-weight: 800;
                    font-size: 2.5rem;
                    margin-bottom: 20px;
                    text-align: center;
                }
                .section-text {
                    color: #4a5568;
                    font-size: 1.1rem;
                    line-height: 1.8;
                    text-align: center;
                    max-width: 800px;
                    margin: 0 auto;
                }
            `
        },

        // Breadcrumb estilizado
        breadcrumb: {
            label: 'Breadcrumb',
            category: 'Preestilizados',
            content: {
                type: 'nav',
                classes: ['breadcrumb-custom'],
                components: [
                    {
                        type: 'link',
                        components: [
                            {
                                type: 'textnode',
                                content: 'Inicio'
                            }
                        ],
                        attributes: {
                            href: '/'
                        }
                    },
                    {
                        type: 'textnode',
                        content: ' / '
                    },
                    {
                        type: 'textnode',
                        content: 'Página Actual'
                    }
                ]
            },
            style: `
                .breadcrumb-custom {
                    background: rgba(255,255,255,0.1);
                    border-radius: 25px;
                    padding: 10px 20px;
                    backdrop-filter: blur(10px);
                    border: 1px solid rgba(255,255,255,0.2);
                    display: inline-flex;
                    align-items: center;
                    gap: 8px;
                    margin: 15px 0;
                }
                .breadcrumb-custom a {
                    color: white;
                    text-decoration: none;
                    font-weight: 500;
                    transition: all 0.3s ease;
                }
                .breadcrumb-custom a:hover {
                    color: #ff6b9d;
                }
            `
        },

        // Bloque HTML personalizado
        customHtml: {
            label: 'HTML Personalizado',
            category: 'Preestilizados',
            content: {
                type: 'custom-html',
                classes: ['custom-html-block'],
                editable: false,
                droppable: false
            },
            style: `
                .custom-html-block {
                    min-height: 50px;
                    padding: 15px;
                    border: 2px dashed #D93690;
                    background: #f8f9fa;
                    border-radius: 8px;
                    position: relative;
                }
                .custom-html-block::before {
                    content: 'HTML Personalizado';
                    position: absolute;
                    top: 5px;
                    left: 10px;
                    font-size: 10px;
                    color: #D93690;
                    font-weight: 600;
                    text-transform: uppercase;
                }
            `
        },

        // Formulario de contacto básico
        contactForm: {
            label: 'Formulario de Contacto',
            category: 'Preestilizados',
            content: `
                <section class="contact-form-section">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <h2 class="contact-form-title">Envíanos un mensaje</h2>
                                <p class="contact-form-subtitle">Rellena el siguiente formulario y nos pondremos en contacto contigo lo antes posible.</p>
                                <form class="contact-form" method="POST" action="/contact/form-submit">
                                    <div class="contact-form-row">
                                        <div class="contact-form-group">
                                            <label for="cf-name">Nombre completo</label>
                                            <input type="text" id="cf-name" name="name" placeholder="Tu nombre" required>
                                        </div>
                                        <div class="contact-form-group">
                                            <label for="cf-email">Email</label>
                                            <input type="email" id="cf-email" name="email" placeholder="tu@email.com" required>
                                        </div>
                                    </div>
                                    <div class="contact-form-group">
                                        <label for="cf-subject">Asunto</label>
                                        <input type="text" id="cf-subject" name="subject" placeholder="¿Sobre qué quieres hablar?">
                                    </div>
                                    <div class="contact-form-group">
                                        <label for="cf-message">Mensaje</label>
                                        <textarea id="cf-message" name="message" rows="4" placeholder="Cuéntanos en qué podemos ayudarte" required></textarea>
                                    </div>
                                    <button type="submit" class="contact-form-btn">Enviar mensaje</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            `,
            style: `
                .contact-form-section {
                    padding: 80px 0;
                    background: linear-gradient(135deg, #f8fafc 0%, #e5e7eb 100%);
                }
                .contact-form-title {
                    text-align: center;
                    font-weight: 800;
                    font-size: 2.2rem;
                    margin-bottom: 10px;
                    color: #1f2937;
                }
                .contact-form-subtitle {
                    text-align: center;
                    color: #6b7280;
                    margin-bottom: 30px;
                }
                .contact-form {
                    background: #ffffff;
                    border-radius: 16px;
                    padding: 30px;
                    box-shadow: 0 10px 30px rgba(15,23,42,0.12);
                    border: 1px solid #e5e7eb;
                }
                .contact-form-row {
                    display: grid;
                    grid-template-columns: repeat(auto-fit,minmax(220px,1fr));
                    gap: 20px;
                }
                .contact-form-group {
                    margin-bottom: 20px;
                }
                .contact-form-group label {
                    display: block;
                    margin-bottom: 6px;
                    font-weight: 600;
                    color: #374151;
                    font-size: 0.95rem;
                }
                .contact-form-group input,
                .contact-form-group textarea {
                    width: 100%;
                    border-radius: 10px;
                    border: 2px solid #e5e7eb;
                    padding: 10px 14px;
                    font-size: 0.95rem;
                    transition: border-color 0.2s ease, box-shadow 0.2s ease;
                    font-family: inherit;
                }
                .contact-form-group input:focus,
                .contact-form-group textarea:focus {
                    outline: none;
                    border-color: #D93690;
                    box-shadow: 0 0 0 3px rgba(217,54,144,0.15);
                }
                .contact-form-btn {
                    background: linear-gradient(135deg, #D93690 0%, #8B5CF6 100%);
                    color: #ffffff;
                    border: none;
                    border-radius: 999px;
                    padding: 12px 28px;
                    font-weight: 600;
                    font-size: 0.95rem;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    gap: 8px;
                    cursor: pointer;
                    transition: transform 0.15s ease, box-shadow 0.15s ease;
                }
                .contact-form-btn:hover {
                    transform: translateY(-1px);
                    box-shadow: 0 8px 18px rgba(217,54,144,0.35);
                }
            `
        },

        // Fila de columnas configurable
        columnsRow: {
            label: 'Columnas',
            category: 'Diseño',
            content: `
                <div class="ecos-columns-row" data-columns="3" data-equal="1">
                    <div class="ecos-column"><p>Columna 1</p></div>
                    <div class="ecos-column"><p>Columna 2</p></div>
                    <div class="ecos-column"><p>Columna 3</p></div>
                </div>
            `,
            style: `
                .ecos-columns-row {
                    display: flex;
                    gap: 24px;
                    margin-bottom: 30px;
                }
                .ecos-column {
                    background: #ffffff;
                    border-radius: 16px;
                    padding: 24px 20px;
                    box-shadow: 0 10px 25px rgba(15,23,42,0.08);
                    border: 1px solid #e5e7eb;
                    min-height: 80px;
                    flex: 1 1 0;
                    position: relative;
                }
                .ecos-column-resizer {
                    position: absolute;
                    top: 0;
                    right: -12px;
                    width: 16px;
                    height: 100%;
                    cursor: col-resize;
                    z-index: 5;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                .ecos-column-resizer::before {
                    content: '';
                    width: 3px;
                    height: 40px;
                    border-radius: 999px;
                    background: rgba(15,23,42,0.3);
                }
                .ecos-columns-row.dragging {
                    user-select: none;
                }
            `
        },

        // Visor PDF
        pdfViewer: {
            label: 'Visor PDF',
            category: 'Preestilizados',
            content: {
                type: 'pdf-viewer-container',
                classes: ['pdf-viewer-container'],
                components: [
                    {
                        type: 'default',
                        tagName: 'iframe',
                        classes: ['pdf-viewer'],
                        attributes: {
                            frameborder: '0',
                            allowfullscreen: 'true'
                        }
                    },
                    {
                        type: 'default',
                        tagName: 'div',
                        classes: ['pdf-viewer-placeholder'],
                        components: [
                            {
                                type: 'default',
                                tagName: 'i',
                                classes: ['fas', 'fa-file-pdf']
                            },
                            {
                                type: 'textnode',
                                content: 'Configura la URL del PDF en las propiedades del componente'
                            }
                        ]
                    }
                ]
            },
            style: `
                .pdf-viewer-container {
                    position: relative;
                    width: 100%;
                    min-height: 600px;
                    border: 2px dashed #e5e7eb;
                    border-radius: 12px;
                    background: #f8fafc;
                    overflow: hidden;
                }
                .pdf-viewer {
                    width: 100%;
                    height: 600px;
                    border: none;
                    display: block;
                }
                .pdf-viewer-placeholder {
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    text-align: center;
                    color: #9ca3af;
                    pointer-events: none;
                }
                .pdf-viewer-placeholder i {
                    font-size: 48px;
                    margin-bottom: 16px;
                    display: block;
                }
                .pdf-viewer-placeholder p {
                    margin: 0;
                    font-size: 14px;
                }
            `,
            attributes: {
                'data-pdf-url': ''
            }
        },

        // Banner de Cookies
        cookieBanner: {
            label: 'Banner de Cookies',
            category: 'Preestilizados',
            content: `
                <div class="cookie-banner" id="cookieBanner">
                    <div class="cookie-banner-content">
                        <div class="cookie-banner-text">
                            <h4>Política de Cookies</h4>
                            <p>Utilizamos cookies para mejorar tu experiencia en nuestro sitio web. Al continuar navegando, aceptas nuestro uso de cookies.</p>
                        </div>
                        <div class="cookie-banner-actions">
                            <button class="cookie-btn-accept">Aceptar</button>
                            <button class="cookie-btn-reject">Rechazar</button>
                            <a href="/politica-cookies" class="cookie-link">Más información</a>
                        </div>
                    </div>
                </div>
            `,
            style: `
                .cookie-banner {
                    position: fixed;
                    bottom: 0;
                    left: 0;
                    right: 0;
                    background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
                    color: #ffffff;
                    padding: 20px;
                    box-shadow: 0 -4px 20px rgba(0,0,0,0.3);
                    z-index: 10000;
                    display: none;
                }
                .cookie-banner.show {
                    display: block;
                }
                .cookie-banner-content {
                    max-width: 1200px;
                    margin: 0 auto;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    gap: 20px;
                    flex-wrap: wrap;
                }
                .cookie-banner-text {
                    flex: 1;
                    min-width: 300px;
                }
                .cookie-banner-text h4 {
                    margin: 0 0 8px 0;
                    font-size: 18px;
                    font-weight: 700;
                }
                .cookie-banner-text p {
                    margin: 0;
                    font-size: 14px;
                    opacity: 0.9;
                }
                .cookie-banner-actions {
                    display: flex;
                    gap: 12px;
                    align-items: center;
                    flex-wrap: wrap;
                }
                .cookie-btn-accept,
                .cookie-btn-reject {
                    padding: 10px 24px;
                    border: none;
                    border-radius: 8px;
                    font-weight: 600;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    font-size: 14px;
                }
                .cookie-btn-accept {
                    background: linear-gradient(135deg, #D93690 0%, #8B5CF6 100%);
                    color: #ffffff;
                }
                .cookie-btn-accept:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 4px 12px rgba(217,54,144,0.4);
                }
                .cookie-btn-reject {
                    background: transparent;
                    color: #ffffff;
                    border: 2px solid #ffffff;
                }
                .cookie-btn-reject:hover {
                    background: rgba(255,255,255,0.1);
                }
                .cookie-link {
                    color: #ffffff;
                    text-decoration: underline;
                    font-size: 14px;
                    opacity: 0.8;
                }
                .cookie-link:hover {
                    opacity: 1;
                }
                @media (max-width: 768px) {
                    .cookie-banner-content {
                        flex-direction: column;
                        text-align: center;
                    }
                    .cookie-banner-actions {
                        width: 100%;
                        justify-content: center;
                    }
                }
            `
        },

        // Componentes de formulario reutilizables
        formFieldText: {
            label: 'Campo Texto',
            category: 'Formularios',
            content: `
                <div class="form-field" data-field-type="text" data-required="false">
                    <label>Campo de texto <span class="required">*</span></label>
                    <input type="text" name="field_text" placeholder="Escribe aquí...">
                </div>
            `,
            style: `
                .form-field {
                    margin-bottom: 20px;
                }
                .form-field label {
                    display: block;
                    margin-bottom: 8px;
                    font-weight: 600;
                    color: #374151;
                    font-size: 0.95rem;
                }
                .form-field .required {
                    color: #e53e3e;
                }
                .form-field input {
                    width: 100%;
                    border-radius: 10px;
                    border: 2px solid #e5e7eb;
                    padding: 12px 16px;
                    font-size: 0.95rem;
                    transition: border-color 0.2s ease, box-shadow 0.2s ease;
                }
                .form-field input:focus {
                    outline: none;
                    border-color: #D93690;
                    box-shadow: 0 0 0 3px rgba(217,54,144,0.15);
                }
            `
        },
        
        formFieldEmail: {
            label: 'Campo Email',
            category: 'Formularios',
            content: `
                <div class="form-field" data-field-type="email" data-required="false">
                    <label>Email <span class="required">*</span></label>
                    <input type="email" name="field_email" placeholder="tu@email.com">
                </div>
            `,
            style: `
                .form-field {
                    margin-bottom: 20px;
                }
                .form-field label {
                    display: block;
                    margin-bottom: 8px;
                    font-weight: 600;
                    color: #374151;
                    font-size: 0.95rem;
                }
                .form-field .required {
                    color: #e53e3e;
                }
                .form-field input {
                    width: 100%;
                    border-radius: 10px;
                    border: 2px solid #e5e7eb;
                    padding: 12px 16px;
                    font-size: 0.95rem;
                    transition: border-color 0.2s ease, box-shadow 0.2s ease;
                }
                .form-field input:focus {
                    outline: none;
                    border-color: #D93690;
                    box-shadow: 0 0 0 3px rgba(217,54,144,0.15);
                }
            `
        },
        
        formFieldTextarea: {
            label: 'Campo Textarea',
            category: 'Formularios',
            content: `
                <div class="form-field" data-field-type="textarea" data-required="false">
                    <label>Mensaje <span class="required">*</span></label>
                    <textarea name="field_message" rows="4" placeholder="Escribe tu mensaje..."></textarea>
                </div>
            `,
            style: `
                .form-field {
                    margin-bottom: 20px;
                }
                .form-field label {
                    display: block;
                    margin-bottom: 8px;
                    font-weight: 600;
                    color: #374151;
                    font-size: 0.95rem;
                }
                .form-field .required {
                    color: #e53e3e;
                }
                .form-field textarea {
                    width: 100%;
                    border-radius: 10px;
                    border: 2px solid #e5e7eb;
                    padding: 12px 16px;
                    font-size: 0.95rem;
                    transition: border-color 0.2s ease, box-shadow 0.2s ease;
                    resize: vertical;
                }
                .form-field textarea:focus {
                    outline: none;
                    border-color: #D93690;
                    box-shadow: 0 0 0 3px rgba(217,54,144,0.15);
                }
            `
        },
        
        formFieldSelect: {
            label: 'Campo Select',
            category: 'Formularios',
            content: `
                <div class="form-field" data-field-type="select" data-required="false">
                    <label>Selecciona una opción <span class="required">*</span></label>
                    <select name="field_select">
                        <option value="">Selecciona...</option>
                        <option value="opcion1">Opción 1</option>
                        <option value="opcion2">Opción 2</option>
                        <option value="opcion3">Opción 3</option>
                    </select>
                </div>
            `,
            style: `
                .form-field {
                    margin-bottom: 20px;
                }
                .form-field label {
                    display: block;
                    margin-bottom: 8px;
                    font-weight: 600;
                    color: #374151;
                    font-size: 0.95rem;
                }
                .form-field .required {
                    color: #e53e3e;
                }
                .form-field select {
                    width: 100%;
                    border-radius: 10px;
                    border: 2px solid #e5e7eb;
                    padding: 12px 16px;
                    font-size: 0.95rem;
                    transition: border-color 0.2s ease, box-shadow 0.2s ease;
                    background: white;
                }
                .form-field select:focus {
                    outline: none;
                    border-color: #D93690;
                    box-shadow: 0 0 0 3px rgba(217,54,144,0.15);
                }
            `
        },
        
        formFieldCheckbox: {
            label: 'Campo Checkbox',
            category: 'Formularios',
            content: `
                <div class="form-field" data-field-type="checkbox" data-required="false">
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                        <input type="checkbox" name="field_checkbox" value="1">
                        <span>Acepto los términos y condiciones</span>
                    </label>
                </div>
            `,
            style: `
                .form-field {
                    margin-bottom: 20px;
                }
                .form-field input[type="checkbox"] {
                    width: 18px;
                    height: 18px;
                    cursor: pointer;
                }
                .form-field label {
                    font-size: 14px;
                    color: #4a5568;
                }
            `
        },
        
        formFieldFile: {
            label: 'Campo Archivo',
            category: 'Formularios',
            content: `
                <div class="form-field" data-field-type="file" data-required="false">
                    <label>Subir archivo <span class="required">*</span></label>
                    <input type="file" name="field_file" accept=".pdf,.doc,.docx,.jpg,.png">
                    <small style="display: block; margin-top: 5px; color: #6b7280; font-size: 12px;">
                        Formatos permitidos: PDF, DOC, DOCX, JPG, PNG
                    </small>
                </div>
            `,
            style: `
                .form-field {
                    margin-bottom: 20px;
                }
                .form-field label {
                    display: block;
                    margin-bottom: 8px;
                    font-weight: 600;
                    color: #374151;
                    font-size: 0.95rem;
                }
                .form-field .required {
                    color: #e53e3e;
                }
                .form-field input[type="file"] {
                    width: 100%;
                    padding: 10px;
                    border: 2px solid #e5e7eb;
                    border-radius: 10px;
                    font-size: 0.95rem;
                }
                .form-field input[type="file"]:focus {
                    outline: none;
                    border-color: #D93690;
                    box-shadow: 0 0 0 3px rgba(217,54,144,0.15);
                }
            `
        },

        // Formulario Avanzado (configurable)
        advancedForm: {
            label: 'Formulario Avanzado',
            category: 'Preestilizados',
            content: `
                <section class="advanced-form-section">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <form class="advanced-form" method="POST" action="/builder/form-submit" data-form-email="">
                                    <div class="form-fields-container">
                                        <!-- Los campos se añadirán aquí dinámicamente -->
                                        <div class="form-field" data-field-type="text" data-required="true">
                                            <label>Nombre <span class="required">*</span></label>
                                            <input type="text" name="name" required>
                                        </div>
                                        <div class="form-field" data-field-type="email" data-required="true">
                                            <label>Email <span class="required">*</span></label>
                                            <input type="email" name="email" required>
                                        </div>
                                    </div>
                                    <div class="form-privacy-checkbox" data-required="true">
                                        <input type="checkbox" name="privacy_policy" id="form-privacy" required>
                                        <label for="form-privacy">Acepto la política de privacidad <span class="required">*</span></label>
                                    </div>
                                    <button type="submit" class="advanced-form-btn">Enviar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            `,
            style: `
                .advanced-form-section {
                    padding: 80px 0;
                    background: linear-gradient(135deg, #f8fafc 0%, #e5e7eb 100%);
                }
                .advanced-form {
                    background: #ffffff;
                    border-radius: 16px;
                    padding: 40px;
                    box-shadow: 0 10px 30px rgba(15,23,42,0.12);
                    border: 1px solid #e5e7eb;
                }
                .form-fields-container {
                    margin-bottom: 25px;
                }
                .form-field {
                    margin-bottom: 20px;
                }
                .form-field label {
                    display: block;
                    margin-bottom: 8px;
                    font-weight: 600;
                    color: #374151;
                    font-size: 0.95rem;
                }
                .form-field .required {
                    color: #e53e3e;
                }
                .form-field input,
                .form-field textarea,
                .form-field select {
                    width: 100%;
                    border-radius: 10px;
                    border: 2px solid #e5e7eb;
                    padding: 12px 16px;
                    font-size: 0.95rem;
                    transition: border-color 0.2s ease, box-shadow 0.2s ease;
                    font-family: inherit;
                }
                .form-field input:focus,
                .form-field textarea:focus,
                .form-field select:focus {
                    outline: none;
                    border-color: #D93690;
                    box-shadow: 0 0 0 3px rgba(217,54,144,0.15);
                }
                .form-privacy-checkbox {
                    margin-bottom: 25px;
                    display: flex;
                    align-items: flex-start;
                    gap: 10px;
                }
                .form-privacy-checkbox input[type="checkbox"] {
                    margin-top: 4px;
                    width: 18px;
                    height: 18px;
                    cursor: pointer;
                }
                .form-privacy-checkbox label {
                    font-size: 14px;
                    color: #4a5568;
                    cursor: pointer;
                }
                .advanced-form-btn {
                    background: linear-gradient(135deg, #D93690 0%, #8B5CF6 100%);
                    color: #ffffff;
                    border: none;
                    border-radius: 999px;
                    padding: 14px 32px;
                    font-weight: 600;
                    font-size: 1rem;
                    cursor: pointer;
                    transition: transform 0.15s ease, box-shadow 0.15s ease;
                    width: 100%;
                }
                .advanced-form-btn:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 8px 18px rgba(217,54,144,0.35);
                }
            `,
            attributes: {
                'data-form-email': '',
                'data-form-id': ''
            }
        }
    };

    // Plugin para GrapesJS
    const customBlocksPlugin = (editor) => {
        const blockManager = editor.BlockManager;
        const domc = editor.DomComponents;
        
        // Función para inyectar todos los estilos de bloques personalizados en el canvas
        const injectAllBlockStyles = () => {
            try {
                const canvas = editor.Canvas;
                const canvasDoc = canvas.getDocument();
                if (!canvasDoc || !canvasDoc.head) return;
                
                const canvasHead = canvasDoc.head;
                let styleTag = canvasHead.querySelector('style[data-custom-blocks-css]');
                if (!styleTag) {
                    styleTag = canvasDoc.createElement('style');
                    styleTag.setAttribute('data-custom-blocks-css', 'true');
                    canvasHead.appendChild(styleTag);
                }
                
                // Recopilar todos los estilos de los bloques personalizados
                let allStyles = '';
                Object.keys(customBlocks).forEach(key => {
                    const block = customBlocks[key];
                    if (block.style) {
                        allStyles += '\n' + block.style;
                    }
                });
                
                // Añadir todos los estilos de una vez
                styleTag.textContent = allStyles.trim();
                console.log('Estilos de bloques personalizados inyectados en canvas');
            } catch (e) {
                console.warn('Error al inyectar estilos de bloques en canvas:', e);
            }
        };

        // Registrar componente personalizado para hero-section
        domc.addType('hero-section', {
            model: {
                defaults: {
                    tagName: 'section',
                    classes: ['hero-section'],
                    traits: []
                }
            }
        });

        // Registrar componente personalizado para Card moderna
        domc.addType('card-modern', {
            model: {
                defaults: {
                    tagName: 'div',
                    classes: ['modern-card'],
                    selectable: true,
                    draggable: true,
                    droppable: true,
                    traits: []
                }
            }
        });

        // Configurar visor PDF con trait para URL
        domc.addType('pdf-viewer-container', {
            model: {
                defaults: {
                    tagName: 'div',
                    classes: ['pdf-viewer-container'],
                    traits: [
                        {
                            type: 'text',
                            name: 'data-pdf-url',
                            label: 'URL del PDF',
                            placeholder: 'https://ejemplo.com/documento.pdf',
                            changeProp: 1
                        },
                        {
                            type: 'number',
                            name: 'height',
                            label: 'Altura (px)',
                            default: 600,
                            changeProp: 1
                        }
                    ]
                },
                init() {
                    this.on('change:attributes:data-pdf-url', () => {
                        const url = this.get('attributes')['data-pdf-url'];
                        const view = this.view;
                        if (view && view.el) {
                            const iframe = view.el.querySelector('.pdf-viewer');
                            const placeholder = view.el.querySelector('.pdf-viewer-placeholder');
                            if (iframe && url) {
                                iframe.src = url;
                                if (placeholder) {
                                    placeholder.style.display = 'none';
                                }
                            } else if (placeholder) {
                                placeholder.style.display = 'block';
                            }
                        }
                    });
                    this.on('change:attributes:height', () => {
                        const height = this.get('attributes').height || 600;
                        const view = this.view;
                        if (view && view.el) {
                            const iframe = view.el.querySelector('.pdf-viewer');
                            if (iframe) {
                                iframe.style.height = height + 'px';
                            }
                        }
                    });
                }
            }
        });
        
        // Configurar formulario avanzado con trait para email
        domc.addType('advanced-form', {
            model: {
                defaults: {
                    tagName: 'form',
                    classes: ['advanced-form'],
                    traits: [
                        {
                            type: 'text',
                            name: 'data-form-email',
                            label: 'Email de destino',
                            placeholder: 'contacto@ejemplo.com',
                            changeProp: 1
                        }
                    ]
                },
                init() {
                    this.on('change:attributes:data-form-email', () => {
                        const email = this.get('attributes')['data-form-email'];
                        const view = this.view;
                        if (view && view.el && email) {
                            view.el.setAttribute('data-form-email', email);
                        }
                    });
                }
            }
        });

        // Registrar componentes de campos de formulario con traits editables
        const registerFormFieldComponent = (type, fieldType) => {
            domc.addType(`form-field-${type}`, {
                model: {
                    defaults: {
                        tagName: 'div',
                        classes: ['form-field'],
                        attributes: (function() {
                            // Calcular valores por defecto según el tipo
                            let defaultLabel, defaultPlaceholder;
                            
                            if (type === 'text') {
                                defaultLabel = 'Campo de texto';
                                defaultPlaceholder = 'Escribe aquí...';
                            } else if (type === 'email') {
                                defaultLabel = 'Email';
                                defaultPlaceholder = 'tu@email.com';
                            } else if (type === 'textarea') {
                                defaultLabel = 'Mensaje';
                                defaultPlaceholder = 'Escribe tu mensaje...';
                            } else if (type === 'select') {
                                defaultLabel = 'Selecciona una opción';
                                defaultPlaceholder = '';
                            } else if (type === 'checkbox') {
                                defaultLabel = 'Acepto los términos';
                                defaultPlaceholder = '';
                            } else {
                                defaultLabel = 'Subir archivo';
                                defaultPlaceholder = '';
                            }
                            
                            return {
                                'data-field-type': fieldType,
                                'data-required': 'false',
                                'field-label': defaultLabel,
                                'field-placeholder': defaultPlaceholder,
                                'field-name': 'field_' + type,
                                'field-required': 'true'
                            };
                        })(),
                        traits: [
                            {
                                type: 'text',
                                name: 'field-label',
                                label: 'Etiqueta (Label)',
                                placeholder: 'Campo de texto',
                                changeProp: 1
                            },
                            {
                                type: 'text',
                                name: 'field-placeholder',
                                label: 'Placeholder',
                                placeholder: 'Escribe aquí...',
                                changeProp: 1
                            },
                            {
                                type: 'text',
                                name: 'field-name',
                                label: 'Nombre del campo (name)',
                                placeholder: 'field_text',
                                changeProp: 1
                            },
                            {
                                type: 'checkbox',
                                name: 'field-required',
                                label: 'Campo obligatorio',
                                valueTrue: 'true',
                                valueFalse: 'false',
                                changeProp: 1
                            }
                        ],
                        selectable: true,
                        hoverable: true,
                        editable: false,
                        droppable: false
                    },
                    init() {
                        // Inicializar valores por defecto si no existen
                        const attrs = this.getAttributes() || {};
                        let needsUpdate = false;
                        
                        if (!attrs['field-label']) {
                            attrs['field-label'] = type === 'text' ? 'Campo de texto' : 
                                                  type === 'email' ? 'Email' : 
                                                  type === 'textarea' ? 'Mensaje' : 
                                                  type === 'select' ? 'Selecciona una opción' : 
                                                  type === 'checkbox' ? 'Acepto los términos' : 
                                                  'Subir archivo';
                            needsUpdate = true;
                        }
                        
                        if (!attrs['field-placeholder']) {
                            attrs['field-placeholder'] = type === 'text' ? 'Escribe aquí...' : 
                                                         type === 'email' ? 'tu@email.com' : 
                                                         type === 'textarea' ? 'Escribe tu mensaje...' : '';
                            needsUpdate = true;
                        }
                        
                        if (!attrs['field-name']) {
                            attrs['field-name'] = `field_${type}`;
                            needsUpdate = true;
                        }
                        
                        if (!attrs['field-required']) {
                            attrs['field-required'] = 'true';
                            needsUpdate = true;
                        }
                        
                        if (needsUpdate) {
                            this.setAttributes(attrs);
                        }
                        
                        // Extraer valores iniciales del HTML si existen (después de que se renderice)
                        setTimeout(() => {
                            const view = this.view;
                            if (view && view.el) {
                                const currentAttrs = this.getAttributes() || {};
                                let updated = false;
                                
                                const labelEl = view.el.querySelector('label');
                                const input = view.el.querySelector('input, textarea, select');
                                
                                if (labelEl) {
                                    const labelText = labelEl.textContent.replace(/\s*\*\s*$/, '').trim();
                                    if (labelText && (!currentAttrs['field-label'] || currentAttrs['field-label'] === '')) {
                                        currentAttrs['field-label'] = labelText;
                                        updated = true;
                                    }
                                }
                                
                                if (input) {
                                    const placeholder = input.getAttribute('placeholder');
                                    if (placeholder && (!currentAttrs['field-placeholder'] || currentAttrs['field-placeholder'] === '')) {
                                        currentAttrs['field-placeholder'] = placeholder;
                                        updated = true;
                                    }
                                    
                                    const name = input.getAttribute('name');
                                    if (name && (!currentAttrs['field-name'] || currentAttrs['field-name'] === '')) {
                                        currentAttrs['field-name'] = name;
                                        updated = true;
                                    }
                                    
                                    const isRequired = input.hasAttribute('required') || 
                                                      view.el.getAttribute('data-required') === 'true' ||
                                                      (labelEl && labelEl.querySelector('.required') !== null);
                                    const requiredValue = isRequired ? 'true' : 'false';
                                    if (!currentAttrs['field-required'] || currentAttrs['field-required'] === '') {
                                        currentAttrs['field-required'] = requiredValue;
                                        updated = true;
                                    }
                                }
                                
                                if (updated) {
                                    this.setAttributes(currentAttrs);
                                    // Forzar actualización de la vista
                                    if (view && view.onRender) {
                                        view.onRender();
                                    }
                                }
                            }
                        }, 300);
                        
                        // Listeners individuales para actualizar cuando cambian los traits
                        this.on('change:attributes:field-label', () => {
                            const attrs = this.getAttributes() || {};
                            const label = attrs['field-label'] || '';
                            const view = this.view;
                            if (view && view.el) {
                                const labelEl = view.el.querySelector('label');
                                if (labelEl) {
                                    const required = attrs['field-required'] === 'true';
                                    labelEl.innerHTML = label + (required ? ' <span class="required">*</span>' : '');
                                }
                            }
                        });
                        
                        this.on('change:attributes:field-placeholder', () => {
                            const attrs = this.getAttributes() || {};
                            const placeholder = attrs['field-placeholder'] || '';
                            const view = this.view;
                            if (view && view.el) {
                                const input = view.el.querySelector('input, textarea, select');
                                if (input) {
                                    input.setAttribute('placeholder', placeholder);
                                }
                            }
                        });
                        
                        this.on('change:attributes:field-name', () => {
                            const attrs = this.getAttributes() || {};
                            const name = attrs['field-name'] || '';
                            const view = this.view;
                            if (view && view.el) {
                                const input = view.el.querySelector('input, textarea, select');
                                if (input) {
                                    input.setAttribute('name', name);
                                }
                            }
                        });
                        
                        this.on('change:attributes:field-required', () => {
                            const attrs = this.getAttributes() || {};
                            const required = attrs['field-required'] === 'true';
                            const view = this.view;
                            if (view && view.el) {
                                view.el.setAttribute('data-required', required ? 'true' : 'false');
                                const labelEl = view.el.querySelector('label');
                                if (labelEl) {
                                    const label = attrs['field-label'] || labelEl.textContent.replace(/\s*\*\s*$/, '').trim();
                                    labelEl.innerHTML = label + (required ? ' <span class="required">*</span>' : '');
                                }
                                const input = view.el.querySelector('input, textarea, select');
                                if (input) {
                                    if (required) {
                                        input.setAttribute('required', 'required');
                                    } else {
                                        input.removeAttribute('required');
                                    }
                                }
                            }
                        });
                    }
                }
            },
            view: {
                onRender() {
                    const model = this.model;
                    const attrs = model.getAttributes() || {};
                    const fieldType = attrs['data-field-type'] || type;
                    
                    // Generar HTML del campo
                    let defaultLabel = 'Campo de texto';
                    if (type === 'email') defaultLabel = 'Email';
                    else if (type === 'textarea') defaultLabel = 'Mensaje';
                    else if (type === 'select') defaultLabel = 'Selecciona una opción';
                    else if (type === 'checkbox') defaultLabel = 'Acepto los términos';
                    else if (type === 'file') defaultLabel = 'Subir archivo';
                    
                    const label = attrs['field-label'] || defaultLabel;
                    const placeholder = attrs['field-placeholder'] || '';
                    const name = attrs['field-name'] || `field_${type}`;
                    const required = attrs['field-required'] === 'true';
                    const requiredSpan = required ? ' <span class="required">*</span>' : '';
                    
                    let inputHTML = '';
                    if (fieldType === 'textarea') {
                        inputHTML = `<textarea name="${name}" rows="4" placeholder="${placeholder}"${required ? ' required' : ''}></textarea>`;
                    } else if (fieldType === 'select') {
                        inputHTML = `<select name="${name}"${required ? ' required' : ''}>
                            <option value="">Selecciona...</option>
                            <option value="opcion1">Opción 1</option>
                            <option value="opcion2">Opción 2</option>
                        </select>`;
                    } else if (fieldType === 'checkbox') {
                        inputHTML = `<input type="checkbox" name="${name}"${required ? ' required' : ''}>`;
                    } else if (fieldType === 'file') {
                        inputHTML = `<input type="file" name="${name}"${required ? ' required' : ''}>`;
                    } else {
                        const inputType = fieldType === 'email' ? 'email' : 'text';
                        inputHTML = `<input type="${inputType}" name="${name}" placeholder="${placeholder}"${required ? ' required' : ''}>`;
                    }
                    
                    // Actualizar el contenido del elemento
                    if (this.el) {
                        this.el.setAttribute('data-field-type', fieldType);
                        this.el.setAttribute('data-required', required ? 'true' : 'false');
                        this.el.className = 'form-field';
                        this.el.innerHTML = `<label>${label}${requiredSpan}</label>${inputHTML}`;
                    }
                }
            }
            });
        };

        // Registrar todos los tipos de campos de formulario
        registerFormFieldComponent('text', 'text');
        registerFormFieldComponent('email', 'email');
        registerFormFieldComponent('textarea', 'textarea');
        registerFormFieldComponent('select', 'select');
        registerFormFieldComponent('checkbox', 'checkbox');
        registerFormFieldComponent('file', 'file');


        // Componente para fila de columnas configurable
        domc.addType('ecos-columns-row', {
            model: {
                defaults: {
                    tagName: 'div',
                    classes: ['ecos-columns-row'],
                    attributes: {
                        'data-columns': 3,
                        'data-equal': 1,
                    },
                    traits: [
                        {
                            type: 'number',
                            name: 'data-columns',
                            label: 'Nº columnas',
                            min: 1,
                            max: 4,
                            step: 1,
                            changeProp: 1,
                        },
                        {
                            type: 'checkbox',
                            name: 'data-equal',
                            label: 'Columnas iguales',
                            valueTrue: 1,
                            valueFalse: 0,
                            changeProp: 1,
                        },
                    ],
                },
                init() {
                    this.on('change:attributes', this.updateColumnsFromAttrs);
                    this.updateColumnsFromAttrs();
                },
                updateColumnsFromAttrs() {
                    const attrs = this.getAttributes() || {};
                    const columns = Math.min(4, Math.max(1, parseInt(attrs['data-columns'] || 3, 10)));
                    const equal = String(attrs['data-equal'] || '1') === '1';

                    // Asegurar número de hijos ecos-column
                    const currentChildren = this.components().filter(c => c.get('tagName') === 'div');
                    const diff = columns - currentChildren.length;

                    if (diff > 0) {
                        for (let i = 0; i < diff; i++) {
                            this.append({
                                type: 'default',
                                tagName: 'div',
                                classes: ['ecos-column'],
                                content: `<p>Columna ${currentChildren.length + i + 1}</p>`,
                            });
                        }
                    } else if (diff < 0) {
                        for (let i = 0; i < Math.abs(diff); i++) {
                            const child = currentChildren.at(currentChildren.length - 1 - i);
                            if (child) child.remove();
                        }
                    }

                    if (equal) {
                        // Todas las columnas al mismo ancho usando flex
                        currentChildren.forEach(child => {
                            child.addStyle({ flex: `1 1 ${100 / columns}%` });
                        });
                    }
                },
            },
            view: {
                events: {
                    mousedown: 'onMouseDown',
                },
                onRender() {
                    // Añadir resizers entre columnas solo en el builder
                    const el = this.el;
                    const columns = Array.from(el.querySelectorAll('.ecos-column'));
                    // Limpiar resizers previos
                    el.querySelectorAll('.ecos-column-resizer').forEach(r => r.remove());

                    columns.forEach((col, index) => {
                        if (index === columns.length - 1) return; // último sin resizer
                        const resizer = document.createElement('div');
                        resizer.className = 'ecos-column-resizer';
                        resizer.dataset.colIndex = index;
                        col.appendChild(resizer);
                    });
                },
                onMouseDown(ev) {
                    const target = ev.target.closest('.ecos-column-resizer');
                    if (!target) return;

                    ev.preventDefault();
                    const rowEl = this.el;
                    const colIndex = parseInt(target.dataset.colIndex, 10);
                    const columns = Array.from(rowEl.querySelectorAll('.ecos-column'));
                    const leftCol = columns[colIndex];
                    const rightCol = columns[colIndex + 1];
                    if (!leftCol || !rightCol) return;

                    const startX = ev.clientX;
                    const rowRect = rowEl.getBoundingClientRect();
                    const totalWidth = rowRect.width;

                    const getPercent = (el) => {
                        const rect = el.getBoundingClientRect();
                        return (rect.width / totalWidth) * 100;
                    };

                    let leftWidth = getPercent(leftCol);
                    let rightWidth = getPercent(rightCol);

                    const minPercent = 15;

                    const onMouseMove = (e) => {
                        const deltaX = e.clientX - startX;
                        const deltaPercent = (deltaX / totalWidth) * 100;
                        let newLeft = leftWidth + deltaPercent;
                        let newRight = rightWidth - deltaPercent;

                        if (newLeft < minPercent || newRight < minPercent) return;

                        leftCol.style.flex = `0 0 ${newLeft}%`;
                        rightCol.style.flex = `0 0 ${newRight}%`;
                        rowEl.classList.add('dragging');
                    };

                    const onMouseUp = () => {
                        document.removeEventListener('mousemove', onMouseMove);
                        document.removeEventListener('mouseup', onMouseUp);
                        rowEl.classList.remove('dragging');
                    };

                    document.addEventListener('mousemove', onMouseMove);
                    document.addEventListener('mouseup', onMouseUp);
                },
            },
        });

        // Registrar componente personalizado para HTML
        domc.addType('custom-html', {
            model: {
                defaults: {
                    tagName: 'div',
                    classes: ['custom-html-block'],
                    // El contenido HTML se guarda en este atributo
                    attributes: {
                        'data-html-content': '<!-- Inserta tu código HTML aquí -->'
                    },
                    traits: [
                        {
                            type: 'textarea',
                            name: 'data-html-content',
                            label: 'Código HTML',
                            placeholder: 'Inserta tu código HTML personalizado aquí...',
                            changeProp: 1
                        }
                    ]
                },
                init() {
                    this.on('change:attributes', this.updateHtmlFromAttr);
                    // Render inicial desde el atributo
                    this.updateHtmlFromAttr();
                },
                updateHtmlFromAttr() {
                    const attrs = this.getAttributes() || {};
                    const html = attrs['data-html-content'] || '<!-- Inserta tu código HTML aquí -->';
                    this.components(html);
                }
            },
            view: {
                onRender() {
                    const model = this.model;
                    const attrs = model.getAttributes() || {};
                    const html = attrs['data-html-content'] || '<!-- Inserta tu código HTML aquí -->';
                    this.el.innerHTML = html;
                }
            }
        });

        // Añadir cada bloque personalizado
        Object.keys(customBlocks).forEach(key => {
            const block = customBlocks[key];
            
            const blockConfig = {
                label: block.label,
                category: block.category,
                content: block.content,
                media: '<i class="fas fa-cube"></i>',
                activate: true,
            };
            
            // Añadir atributos si existen
            if (block.attributes) {
                blockConfig.attributes = block.attributes;
            }
            
            blockManager.add(key, blockConfig);

            // Añadir los estilos CSS al editor cuando se carga
            if (block.style) {
                editor.on('load', () => {
                    // Añadir al CSS de GrapesJS
                    editor.Css.add(block.style);
                });
            }
        });
        
        // Inyectar todos los estilos de bloques personalizados en el canvas
        editor.on('load', () => {
            // Inyectar inmediatamente
            setTimeout(injectAllBlockStyles, 100);
        });
        
        // También inyectar cuando el canvas se carga
        editor.on('canvas:frame:load', () => {
            setTimeout(injectAllBlockStyles, 100);
        });
        
        // Inyectar cuando se añade un componente (por si el canvas ya estaba cargado)
        editor.on('component:add', (component) => {
            setTimeout(injectAllBlockStyles, 100);
            
            // Convertir componentes de formulario al tipo registrado
            if (component) {
                // Función para verificar y convertir
                const checkAndConvert = () => {
                    const el = component.getEl();
                    if (el && el.classList && el.classList.contains('form-field')) {
                        const fieldType = el.getAttribute('data-field-type');
                        if (fieldType) {
                            const newType = `form-field-${fieldType}`;
                            if (domc.getType(newType) && component.get('type') !== newType) {
                                // Cambiar el tipo del componente
                                component.set('type', newType);
                                
                                // Asegurar que sea seleccionable después de cambiar el tipo
                                setTimeout(() => {
                                    if (component && component.set) {
                                        component.set('selectable', true);
                                        component.set('hoverable', true);
                                    }
                                }, 50);
                                
                                return true;
                            }
                        }
                    }
                    return false;
                };
                
                // Intentar inmediatamente
                if (!checkAndConvert()) {
                    // Si no funciona, intentar después de un delay (cuando el elemento esté renderizado)
                    setTimeout(() => {
                        if (checkAndConvert()) {
                            // Si se convirtió, asegurar que sea seleccionable
                            setTimeout(() => {
                                if (component && component.set) {
                                    component.set('selectable', true);
                                    component.set('hoverable', true);
                                }
                            }, 50);
                        }
                    }, 200);
                } else {
                    // Si ya se convirtió, asegurar que sea seleccionable
                    setTimeout(() => {
                        if (component && component.set) {
                            component.set('selectable', true);
                            component.set('hoverable', true);
                        }
                    }, 50);
                }
            }
        });

        // Listener adicional para asegurar que los componentes form-field sean seleccionables
        editor.on('component:selected', (component) => {
            if (component) {
                const el = component.getEl();
                if (el && el.classList && el.classList.contains('form-field')) {
                    // Asegurar que el componente sea seleccionable
                    if (component.set) {
                        component.set('selectable', true);
                        component.set('hoverable', true);
                    }
                }
            }
        });

        // No es necesario un listener extra: el cambio se maneja en el propio modelo
    };

    // Exportar para uso global
    if (typeof window !== 'undefined') {
        window.customBlocksPlugin = customBlocksPlugin;
    }

    // Registrar el plugin si GrapesJS está disponible
    if (typeof grapesjs !== 'undefined') {
        grapesjs.plugins.add('custom-blocks', customBlocksPlugin);
    }

})();


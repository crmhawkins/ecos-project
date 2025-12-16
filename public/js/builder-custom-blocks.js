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
            
            blockManager.add(key, {
                label: block.label,
                category: block.category,
                content: block.content,
                media: '<i class="fas fa-cube"></i>',
                activate: true,
            });

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
        editor.on('component:add', () => {
            setTimeout(injectAllBlockStyles, 100);
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


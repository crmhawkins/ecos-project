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
                components: [
                    {
                        type: 'textnode',
                        content: '<!-- Inserta tu código HTML aquí -->'
                    }
                ],
                editable: true,
                droppable: false,
                traits: [
                    {
                        type: 'textarea',
                        name: 'html',
                        label: 'Código HTML',
                        placeholder: 'Inserta tu código HTML personalizado aquí...'
                    }
                ]
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
        }
    };

    // Plugin para GrapesJS
    const customBlocksPlugin = (editor) => {
        const blockManager = editor.BlockManager;
        const domc = editor.DomComponents;

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

        // Registrar componente personalizado para HTML
        domc.addType('custom-html', {
            model: {
                defaults: {
                    tagName: 'div',
                    classes: ['custom-html-block'],
                    traits: [
                        {
                            type: 'textarea',
                            name: 'html',
                            label: 'Código HTML',
                            placeholder: 'Inserta tu código HTML personalizado aquí...',
                            changeProp: 1
                        }
                    ]
                },
                init() {
                    this.on('change:html', this.updateHtml);
                },
                updateHtml() {
                    const html = this.get('html') || '';
                    if (html) {
                        this.set('content', html);
                    }
                }
            },
            view: {
                onRender() {
                    const html = this.model.get('html') || '';
                    if (html) {
                        this.el.innerHTML = html;
                    }
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
                    editor.Css.add(block.style);
                });
            }
        });

        // Manejar el trait de HTML personalizado
        editor.on('component:selected', (component) => {
            if (component && component.get('type') === 'custom-html') {
                const traits = component.get('traits');
                const htmlTrait = traits.find(t => t.get('name') === 'html');
                if (htmlTrait) {
                    htmlTrait.on('change', () => {
                        const html = htmlTrait.getValue();
                        if (html) {
                            component.set('content', html);
                            component.view.render();
                        }
                    });
                }
            }
        });
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


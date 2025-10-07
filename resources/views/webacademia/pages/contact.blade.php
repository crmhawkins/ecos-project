<style>
/* Hero de Contact con estilo del Blog */
.contact-hero {
    background: linear-gradient(135deg, #D93690 0%, #667eea 100%);
    padding: 80px 0 40px 0;
    color: white;
    position: relative;
    overflow: hidden;
}

.contact-hero::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.contact-hero h1 {
    font-size: 48px;
    font-weight: 800;
    margin-bottom: 15px;
    text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    color: white !important;
}

.contact-hero .breadcrumb {
    background: rgba(255,255,255,0.1);
    border-radius: 25px;
    padding: 10px 20px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-top: 15px;
}

.contact-hero .breadcrumb a { color: white; text-decoration: none; font-weight: 500; transition: all 0.3s ease; }
.contact-hero .breadcrumb a:hover { color: #ff6b9d; }
.contact-hero .breadcrumb span { color: rgba(255,255,255,0.8); }

/* Sección de contacto moderna */
.contact-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #f8fafc 0%, #e9ecef 100%);
    position: relative;
}

.contact-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #D93690 0%, #ff6b9d 50%, #667eea 100%);
}

/* Tarjetas de contacto modernas */
.contact-card {
    background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    margin-bottom: 30px;
    border: 1px solid #e2e8f0;
    height: 100%;
    display: flex;
    flex-direction: column;
    text-align: center;
    padding: 40px 30px;
}

.contact-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.contact-card-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #D93690 0%, #667eea 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    color: white;
    font-size: 30px;
}

.contact-card h4 {
    color: #D93690;
    font-weight: 700;
    margin-bottom: 20px;
    font-size: 1.5rem;
}

.contact-card p {
    color: #666;
    line-height: 1.7;
    margin-bottom: 15px;
}

.contact-card a {
    color: #D93690;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.contact-card a:hover {
    color: #ff6b9d;
    text-decoration: none;
}

/* Formulario de contacto moderno */
.contact-form-section {
    background: white;
    padding: 80px 0;
}

.contact-form-card {
    background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    border-radius: 20px;
    padding: 50px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    border: 1px solid #e2e8f0;
}

.contact-form-card h2 {
    color: #D93690;
    font-weight: 700;
    margin-bottom: 30px;
    text-align: center;
    font-size: 2rem;
}

.form-group {
    margin-bottom: 25px;
}

.form-group label {
    color: #333;
    font-weight: 600;
    margin-bottom: 8px;
    display: block;
}

.form-control {
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    padding: 15px 20px;
    font-size: 16px;
    transition: all 0.3s ease;
    background: white;
}

.form-control:focus {
    border-color: #D93690;
    box-shadow: 0 0 0 3px rgba(217, 54, 144, 0.1);
    outline: none;
}

.btn-contact {
    background: linear-gradient(135deg, #D93690 0%, #667eea 100%);
    color: white;
    border: none;
    padding: 15px 40px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 16px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    cursor: pointer;
    display: inline-block;
    text-decoration: none;
}

.btn-contact:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(217, 54, 144, 0.3);
    color: white;
    text-decoration: none;
}

/* Responsive */
@media (max-width: 768px) {
    .contact-hero { padding: 60px 0 30px 0; }
    .contact-hero h1 { font-size: 32px; }
    .contact-section { padding: 60px 0; }
    .contact-form-section { padding: 60px 0; }
    .contact-form-card { padding: 30px; }
    .contact-card { padding: 30px 20px; }
}

/* Animaciones */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.contact-card {
    animation: fadeInUp 0.6s ease-out;
    animation-fill-mode: both;
}

.contact-card:nth-child(1) { animation-delay: 0.1s; }
.contact-card:nth-child(2) { animation-delay: 0.2s; }
.contact-card:nth-child(3) { animation-delay: 0.3s; }
</style>

<!-- HERO SECTION (estilo blog) -->
<section class="contact-hero">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1>Contacta Con Nosotros</h1>
                <p>Estamos aquí para ayudarte. Ponte en contacto con nosotros</p>
                <div class="breadcrumb">
                    <a href="/"><i class="fas fa-home"></i> Inicio</a>
                    <span>/</span>
                    <span>Contacto</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECCIÓN DE CONTACTO -->
<section class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="contact-card">
                    <div class="contact-card-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h4>Ceuta</h4>
                    <p>Poblado Marinero, locales 25, 44, 45 y 46</p>
                    <p><strong>Tel.:</strong> 956 52 50 68</p>
                    <p><strong>Email:</strong></p>
                    <p><a href="mailto:academia@grupoecos.net">academia@grupoecos.net</a></p>
                    <p><a href="mailto:comercial@grupoecos.net">comercial@grupoecos.net</a></p>
                    <p><a href="mailto:informacion@grupoecos.net">informacion@grupoecos.net</a></p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="contact-card">
                    <div class="contact-card-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h4>Estepona</h4>
                    <p>Calle Las Camelias, 2B<br>(junto a la Policía Local)</p>
                    <p><strong>Tel.:</strong> 952 80 51 64</p>
                    <p><strong>Email:</strong></p>
                    <p><a href="mailto:estepona@grupoecos.net">estepona@grupoecos.net</a></p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="contact-card">
                    <div class="contact-card-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h4>Melilla</h4>
                    <p>Calle Comandante García Morato, 17</p>
                    <p><strong>Tel.:</strong> 951 53 23 10</p>
                    <p><strong>Email:</strong></p>
                    <p><a href="mailto:melilla@grupoecos.net">melilla@grupoecos.net</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FORMULARIO DE CONTACTO -->
<section class="contact-form-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-form-card">
                    <h2>Envíanos tu mensaje</h2>
                    <form class="form" name="enq" method="post" action="contact.php" onsubmit="return validation();">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" id="name" class="form-control" required="required">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Tu correo electrónico</label>
                                <input type="email" name="email" id="email" class="form-control" required="required">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="subject">Asunto</label>
                                <input type="text" name="subject" id="subject" class="form-control" required="required">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="message">Mensaje</label>
                                <textarea rows="6" name="message" id="message" class="form-control" required="required"></textarea>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" value="Enviar mensaje" name="submit" id="submitButton" class="btn-contact" title="¡Enviar tu mensaje!">Enviar mensaje</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

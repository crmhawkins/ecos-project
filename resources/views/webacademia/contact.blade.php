@extends('webacademia.layouts.web_layout')

@section('title', 'Contact')

@section('css')
@endsection

@section('content')

<!-- HERO SECTION (estilo blog) -->
<section style="background: linear-gradient(135deg, #D93690 0%, #667eea 100%); padding: 100px 0; position: relative; overflow: hidden;">
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\"><defs><pattern id=\"grain\" width=\"100\" height=\"100\" patternUnits=\"userSpaceOnUse\"><circle cx=\"50\" cy=\"50\" r=\"1\" fill=\"white\" opacity=\"0.1\"/></pattern></defs><rect width=\"100\" height=\"100\" fill=\"url(%23grain)\"/></svg>'); opacity: 0.3;"></div>
    <div class="container" style="position: relative; z-index: 1;">
        <div class="col-lg-10 offset-lg-1 text-center">
            <div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
                <h1 style="color: white; font-size: 3.5rem; font-weight: 800; margin-bottom: 20px; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">Contacta Con Nosotros</h1>
                <p style="color: rgba(255, 255, 255, 0.9); font-size: 1.2rem; margin-bottom: 30px;">Estamos aquí para ayudarte. Ponte en contacto con nosotros</p>
                <div style="background: rgba(255,255,255,0.1); border-radius: 25px; padding: 10px 20px; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); display: inline-flex; align-items: center; gap: 8px; margin-top: 15px;">
                    <a href="/" style="color: white; text-decoration: none; font-weight: 500; transition: all 0.3s ease;" onmouseover="this.style.color='#ff6b9d'" onmouseout="this.style.color='white'">
                        <i class="fas fa-home"></i> Inicio
                    </a>
                    <span style="color: rgba(255,255,255,0.8);">/</span>
                    <span style="color: rgba(255,255,255,0.8);">Contacto</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECCIÓN DE CONTACTO -->
<section style="padding: 80px 0; background: linear-gradient(135deg, #f8fafc 0%, #e9ecef 100%); position: relative;">
    <div style="position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(135deg, #D93690 0%, #ff6b9d 50%, #667eea 100%);"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div style="background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%); border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); margin-bottom: 30px; border: 1px solid #e2e8f0; height: 100%; display: flex; flex-direction: column; text-align: center; padding: 40px 30px;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.1)'">
                    <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #D93690 0%, #667eea 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; color: white; font-size: 30px;">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h4 style="color: #D93690; font-weight: 700; margin-bottom: 20px; font-size: 1.5rem;">Ceuta</h4>
                    <p style="color: #666; line-height: 1.7; margin-bottom: 15px;">Poblado Marinero, locales 25, 44, 45 y 46</p>
                    <p style="color: #666; line-height: 1.7; margin-bottom: 15px;"><strong>Tel.:</strong> 956 52 50 68</p>
                    <p style="color: #666; line-height: 1.7; margin-bottom: 15px;"><strong>Email:</strong></p>
                    <p style="color: #666; line-height: 1.7; margin-bottom: 15px;"><a href="mailto:academia@grupoecos.net" style="color: #D93690; text-decoration: none; font-weight: 600;">academia@grupoecos.net</a></p>
                    <p style="color: #666; line-height: 1.7; margin-bottom: 15px;"><a href="mailto:comercial@grupoecos.net" style="color: #D93690; text-decoration: none; font-weight: 600;">comercial@grupoecos.net</a></p>
                    <p style="color: #666; line-height: 1.7; margin-bottom: 15px;"><a href="mailto:informacion@grupoecos.net" style="color: #D93690; text-decoration: none; font-weight: 600;">informacion@grupoecos.net</a></p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div style="background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%); border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); margin-bottom: 30px; border: 1px solid #e2e8f0; height: 100%; display: flex; flex-direction: column; text-align: center; padding: 40px 30px;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.1)'">
                    <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #D93690 0%, #667eea 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; color: white; font-size: 30px;">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h4 style="color: #D93690; font-weight: 700; margin-bottom: 20px; font-size: 1.5rem;">Estepona</h4>
                    <p style="color: #666; line-height: 1.7; margin-bottom: 15px;">Calle Las Camelias, 2B<br>(junto a la Policía Local)</p>
                    <p style="color: #666; line-height: 1.7; margin-bottom: 15px;"><strong>Tel.:</strong> 952 80 51 64</p>
                    <p style="color: #666; line-height: 1.7; margin-bottom: 15px;"><strong>Email:</strong></p>
                    <p style="color: #666; line-height: 1.7; margin-bottom: 15px;"><a href="mailto:estepona@grupoecos.net" style="color: #D93690; text-decoration: none; font-weight: 600;">estepona@grupoecos.net</a></p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div style="background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%); border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); margin-bottom: 30px; border: 1px solid #e2e8f0; height: 100%; display: flex; flex-direction: column; text-align: center; padding: 40px 30px;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.1)'">
                    <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #D93690 0%, #667eea 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; color: white; font-size: 30px;">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h4 style="color: #D93690; font-weight: 700; margin-bottom: 20px; font-size: 1.5rem;">Melilla</h4>
                    <p style="color: #666; line-height: 1.7; margin-bottom: 15px;">Calle Comandante García Morato, 17</p>
                    <p style="color: #666; line-height: 1.7; margin-bottom: 15px;"><strong>Tel.:</strong> 951 53 23 10</p>
                    <p style="color: #666; line-height: 1.7; margin-bottom: 15px;"><strong>Email:</strong></p>
                    <p style="color: #666; line-height: 1.7; margin-bottom: 15px;"><a href="mailto:melilla@grupoecos.net" style="color: #D93690; text-decoration: none; font-weight: 600;">melilla@grupoecos.net</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FORMULARIO DE CONTACTO -->
<section style="background: white; padding: 80px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div style="background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%); border-radius: 20px; padding: 50px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); border: 1px solid #e2e8f0;">
                    <h2 style="color: #D93690; font-weight: 700; margin-bottom: 30px; text-align: center; font-size: 2rem;">Envíanos tu mensaje</h2>
                    <form class="form" name="enq" method="post" action="contact.php" onsubmit="return validation();">
                        <div class="row">
                            <div style="margin-bottom: 25px;" class="col-md-6">
                                <label for="name" style="color: #333; font-weight: 600; margin-bottom: 8px; display: block;">Nombre</label>
                                <input type="text" name="name" id="name" style="border: 2px solid #e2e8f0; border-radius: 10px; padding: 15px 20px; font-size: 16px; transition: all 0.3s ease; background: white; width: 100%;" required="required">
                            </div>
                            <div style="margin-bottom: 25px;" class="col-md-6">
                                <label for="email" style="color: #333; font-weight: 600; margin-bottom: 8px; display: block;">Tu correo electrónico</label>
                                <input type="email" name="email" id="email" style="border: 2px solid #e2e8f0; border-radius: 10px; padding: 15px 20px; font-size: 16px; transition: all 0.3s ease; background: white; width: 100%;" required="required">
                            </div>
                            <div style="margin-bottom: 25px;" class="col-md-12">
                                <label for="subject" style="color: #333; font-weight: 600; margin-bottom: 8px; display: block;">Asunto</label>
                                <input type="text" name="subject" id="subject" style="border: 2px solid #e2e8f0; border-radius: 10px; padding: 15px 20px; font-size: 16px; transition: all 0.3s ease; background: white; width: 100%;" required="required">
                            </div>
                            <div style="margin-bottom: 25px;" class="col-md-12">
                                <label for="message" style="color: #333; font-weight: 600; margin-bottom: 8px; display: block;">Mensaje</label>
                                <textarea rows="6" name="message" id="message" style="border: 2px solid #e2e8f0; border-radius: 10px; padding: 15px 20px; font-size: 16px; transition: all 0.3s ease; background: white; width: 100%; resize: vertical;" required="required"></textarea>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" value="Enviar mensaje" name="submit" id="submitButton" style="background: linear-gradient(135deg, #D93690 0%, #667eea 100%); color: white; border: none; padding: 15px 40px; border-radius: 25px; font-weight: 600; font-size: 16px; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.3s ease; cursor: pointer; display: inline-block; text-decoration: none;" title="¡Enviar tu mensaje!">Enviar mensaje</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('scripts')
@endsection

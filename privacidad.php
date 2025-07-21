<?php

  session_start();
  require_once 'vendor/autoload.php';
  if(isset($_SESSION['admin']) || isset($_SESSION['estandar'])){
      header("Location: https://cocinas-aurora.herokuapp.com/control_panel/");
  }else{

?>


<!DOCTYPE html>
<html lang="es" class="wide wow-animation smoothscroll scrollTo">
<head>
  <!-- Estilos -->
  <?php include 'views/estilos.php' ?>
  <title> ❤️ Política de privacidad | Cocina Aurora ❤️ </title>

  <style>
    a{
      color: #ff8400;
    }
    a:hover{
      color: #cf7413 !important;
    }

    a.botonContac:hover{
      color: #fff !important;
    }
  </style>
</head>
  <body>
    <!-- Page-->
    <div id="privacidad" class="page text-center">
      <header class="page-head header-panel-absolute">
        <?php
          if(isset($_SESSION['usuario'])){
            include 'views/navBarS.php';
          }else if(isset($_SESSION['usuarioSocial'])){
            include 'views/navBarFG.php';
          }else if (!isset($_SESSION['usuario'])){
            include 'views/navBar.php';
          }
        ?>
      </header>
      <!-- Page Content-->
      <main class="page-content section-70 section-md-114">
        <div class="shell text-left">
          <div class="range range range-xs-center">
            <div class="cell-xs-10 cell-sm-8">
              <h1 style="font-family: helvetica neue,Helvetica,Arial,sans-serif; font-size: 60px; margin-top: 60px" class="text-center offset-top-40">Política de privacidad</h1>
              <p>Última actualización: 20 de julio de 2021</p>
            </div>

            <div class="cell-xs-10 cell-sm-8 offset-top-50">
              <h2 style="font-family: helvetica neue,Helvetica,Arial,sans-serif; font-size: 35px;" class="text-bold">Información general</h2>              
              <p>Esta Política de privacidad describe Nuestras políticas y procedimientos sobre la recopilación, uso y divulgación de Su información cuando usa el Servicio y le informa sobre Sus derechos de privacidad y cómo la ley lo protege.</p>
              <p>Usamos sus datos personales para proporcionar y mejorar el Servicio. Al utilizar el Servicio, acepta la recopilación y el uso de información de acuerdo con esta Política de privacidad. Esta Política de privacidad se ha creado con la ayuda del Generador de políticas de privacidad.</p>

              <div class="offset-top-50">
                <h2 class="text-bold"  style="font-family: helvetica neue,Helvetica,Arial,sans-serif; font-size: 35px;">Interpretación y definiciones</h2>
                <h3 style="font-family: helvetica neue,Helvetica,Arial,sans-serif; font-size: 25px;" class="text-bold">Interpretación</h3>
                <p>Las palabras cuya letra inicial está en mayúscula tienen significados definidos en las siguientes condiciones. Las siguientes definiciones tendrán el mismo significado independientemente de que aparezcan en singular o en plural.</p>

                <h3 style="font-family: helvetica neue,Helvetica,Arial,sans-serif; font-size: 25px;" class="text-bold">Definiciones</h3>
                <p>A los efectos de esta Política de privacidad:</p>
                <ul>        
                  <li><b>Cuenta</b> significa una cuenta única creada para que usted acceda a nuestro Servicio o partes de nuestro Servicio.</li>
                  <li><b>Compañía</b> (denominada "la Compañía", "Nosotros", "Nos" o "Nuestro" en este Acuerdo) se refiere a Cocinas Aurora.</li>
                  <li><b>Las cookies</b> son pequeños archivos que un sitio web coloca en su computadora, dispositivo móvil o cualquier otro dispositivo, que contienen los detalles de su historial de navegación en ese sitio web, entre sus muchos usos.</li>
                  <li><b>País se</b> refiere a: México</li>
                  <li><b>Dispositivo</b> significa cualquier dispositivo que pueda acceder al Servicio, como una computadora, un teléfono celular o una tableta digital.</li>
                  <li><b>Los datos personales</b> son cualquier información que se relacione con una persona identificada o identificable.</li>
                  <li><b>El servicio se</b> refiere al sitio web.</li>
                  <li><b>Proveedor de servicios</b> significa cualquier persona física o jurídica que procesa los datos en nombre de la Compañía. Se refiere a empresas de terceros o personas empleadas por la Compañía para facilitar el Servicio, para proporcionar el Servicio en nombre de la Compañía, para realizar servicios relacionados con el Servicio o para ayudar a la Compañía a analizar cómo se utiliza el Servicio.</li>
                  <li><b>El Servicio de</b> redes sociales de terceros se refiere a cualquier sitio web o cualquier sitio web de red social a través del cual un Usuario puede iniciar sesión o crear una cuenta para usar el Servicio.</li>
                  <li><b>Los Datos de uso se</b> refieren a los datos recopilados automáticamente, ya sea generados por el uso del Servicio o por la propia infraestructura del Servicio (por ejemplo, la duración de una visita a la página).</li>
                  <li><b>El sitio web se</b> refiere a Cocinas Aurora, accesible desde <a href="https://cocinas-aurora.herokuapp.com/" target="_blank">https://cocinas-aurora.herokuapp.com/</a></li>
                  <li><b>Usted se</b> refiere a la persona que accede o utiliza el Servicio, o la empresa u otra entidad legal en nombre de la cual dicha persona accede o utiliza el Servicio, según corresponda.</li>
                </ul>
              </div>

              <div class="offset-top-50">
                <h2 class="text-bold"  style="font-family: helvetica neue,Helvetica,Arial,sans-serif; font-size: 35px;">Recopilación y uso de sus datos personales</h2>
                <h3 style="font-family: helvetica neue,Helvetica,Arial,sans-serif; font-size: 30px;" class="text-bold">Tipos de datos recopilados</h3>

                <h4 style="font-family: helvetica neue,Helvetica,Arial,sans-serif; font-size: 25px;" class="text-bold">Información personal</h4>
                <p>Al usar Nuestro Servicio, podemos pedirle que nos proporcione cierta información de identificación personal que pueda usarse para contactarlo o identificarlo. La información de identificación personal puede incluir, pero no se limita a:</p>
                <ul>
                  <li>Dirección de correo electrónico</li>
                  <li>Nombre y apellido</li>
                  <li>Datos de uso</li>
                </ul>

                <h4 style="font-family: helvetica neue,Helvetica,Arial,sans-serif; font-size: 25px;" class="text-bold">Datos de uso</h4>
                <p>Los datos de uso se recopilan automáticamente cuando se utiliza el servicio.</p>
                <p>Los datos de uso pueden incluir información como la dirección de Protocolo de Internet de su dispositivo (por ejemplo, la dirección IP), el tipo de navegador, la versión del navegador, las páginas de nuestro Servicio que visita, la hora y fecha de su visita, el tiempo que pasó en esas páginas, el dispositivo único identificadores y otros datos de diagnóstico.</p>
                <p>Cuando accede al Servicio a través de un dispositivo móvil, podemos recopilar cierta información automáticamente, que incluye, entre otros, el tipo de dispositivo móvil que utiliza, la ID única de su dispositivo móvil, la dirección IP de sistema operativo, el tipo de navegador de Internet móvil que utiliza, identificadores de dispositivo únicos y otros datos de diagnóstico.</p>
                <p>También podemos recopilar información que su navegador envía cada vez que visita nuestro Servicio o cuando accede al Servicio a través de un dispositivo móvil.</p>

                <h4 style="font-family: helvetica neue,Helvetica,Arial,sans-serif; font-size: 25px;" class="text-bold">Información de servicios de redes sociales de terceros</h4>
                <p>La Compañía le permite crear una cuenta e iniciar sesión para usar el Servicio a través de los siguientes Servicios de redes sociales de terceros:</p>
                <ul>
                  <li>Google</li>
                  <li>Facebook</li>
                </ul>
                <p>Si decide registrarse a través de un Servicio de redes sociales de terceros o de otro modo concedernos acceso a él, es posible que recopilemos datos personales que ya estén asociados con la cuenta del Servicio de redes sociales de terceros, como Su nombre, Su dirección de correo electrónico, Sus actividades. o Su lista de contactos asociada con esa cuenta.</p>
                <p>También puede tener la opción de compartir información adicional con la Compañía a través de la cuenta de su Servicio de redes sociales de terceros. Si elige proporcionar dicha información y Datos personales, durante el registro o de otro modo, está otorgando permiso a la Compañía para usarlos, compartirlos y almacenarlos de manera consistente con esta Política de privacidad.</p>

                <h4 style="font-family: helvetica neue,Helvetica,Arial,sans-serif; font-size: 25px;" class="text-bold">Tecnologías de seguimiento y cookies</h4>
                <p>Usamos cookies y tecnologías de seguimiento similares para rastrear la actividad en nuestro servicio y almacenar cierta información. Las tecnologías de seguimiento utilizadas son balizas, etiquetas y scripts para recopilar y rastrear información y para mejorar y analizar Nuestro Servicio. Las tecnologías que utilizamos pueden incluir:</p>
                <ul>
                  <li><b>Cookies o cookies del navegador.</b> Una cookie es un pequeño archivo que se coloca en su dispositivo. Puede indicar a su navegador que rechace todas las cookies o que indique cuándo se envía una cookie. Sin embargo, si no acepta las cookies, es posible que no pueda utilizar algunas partes de nuestro Servicio. A menos que haya ajustado la configuración de su navegador para que rechace las cookies, nuestro servicio puede utilizar cookies.</li>
                  <li><b>Cookies Flash.</b> Ciertas funciones de nuestro Servicio pueden utilizar objetos almacenados localmente (o cookies Flash) para recopilar y almacenar información sobre sus preferencias o su actividad en nuestro servicio. Las cookies de Flash no se administran con la misma configuración del navegador que las utilizadas para las cookies del navegador. Para obtener más información sobre cómo puede eliminar las cookies de Flash, lea "¿Dónde puedo cambiar la configuración para deshabilitar o eliminar objetos compartidos locales?" disponible en <a href="https://helpx.adobe.com/flash-player/kb/disable-local-shared-objects-flash.html#main_Where_can_I_change_the_settings_for_disabling__or_deleting_local_shared_objects_" target="_blank">https://helpx.adobe.com/flash-player/kb/disable-local-shared-objects-flash.html#main_Where_can_I_change_the_settings_for_disabling__or_deleting_local_shared_objects_</a></li>
                  <li><b>Balizas web.</b> Ciertas secciones de nuestro Servicio y nuestros correos electrónicos pueden contener pequeños archivos electrónicos conocidos como balizas web (también denominados gifs transparentes, etiquetas de píxeles y gifs de un solo píxel) que permiten a la Compañía, por ejemplo, contar los usuarios que han visitado esas páginas. o abrió un correo electrónico y para otras estadísticas relacionadas del sitio web (por ejemplo, registrar la popularidad de una determinada sección y verificar la integridad del sistema y del servidor).</li>
                </ul>
                <p>Las cookies pueden ser cookies "persistentes" o de "sesión". Las cookies persistentes permanecen en su computadora personal o dispositivo móvil cuando se desconecta, mientras que las cookies de sesión se eliminan tan pronto como cierra su navegador web. Puede obtener más información sobre las cookies aquí: Todo sobre las cookies por <a href="https://www.termsfeed.com/blog/cookies/" target="_blank">TermsFeed.</a></p>
                <p>Usamos cookies de sesión y persistentes para los fines que se establecen a continuación:</p>
                  <ul>                    
                    <li><b>Cookies necesarias/esenciales</b></li>
                      <p>Tipo: Cookies de sesión</p>
                      <p>Administrado por: Nosotros</p>
                      <p>Propósito: Estas cookies son esenciales para brindarle los servicios disponibles a través del sitio web y para permitirle utilizar algunas de sus funciones. Ayudan a autenticar a los usuarios y a prevenir el uso fraudulento de las cuentas de usuario. Sin estas cookies, los servicios que ha solicitado no se pueden proporcionar, y solo usamos estas cookies para brindarle esos servicios.</p>                    
                    <li><b>Cookies necesarias/esenciales</b></li>
                      <p>Tipo: Cookies persistentes</p>
                      <p>Administrado por: Nosotros</p>
                      <p>Finalidad: Estas cookies identifican si los usuarios han aceptado el uso de cookies en el sitio web.</p>

                    <li><b>Cookies de funcionalidad</b></li>
                      <p>Tipo: Cookies persistentes</p>
                      <p>Administrado por: Nosotros</p>
                      <p>Propósito: estas cookies nos permiten recordar las elecciones que realiza cuando utiliza el sitio web, como recordar sus datos de inicio de sesión o su preferencia de idioma. El propósito de estas cookies es brindarle una experiencia más personal y evitar que tenga que volver a ingresar sus preferencias cada vez que utiliza el sitio web.</p>

                  </ul>
                <p>Para obtener más información sobre las cookies que utilizamos y sus opciones con respecto a las cookies, visite nuestra Política de cookies o la sección de Cookies de nuestra Política de privacidad.</p>
              </div>

              <div class="offset-top-50">
                <h3 class="text-bold"  style="font-family: helvetica neue,Helvetica,Arial,sans-serif; font-size: 30px;">Uso de sus datos personales</h3>
                <p>La Compañía puede utilizar los Datos Personales para los siguientes propósitos:</p>
                <ul>
                  <li><b>Para proporcionar y mantener nuestro Servicio</b>, incluso para supervisar el uso de nuestro Servicio.</li>
                  <li><b>Para administrar Su Cuenta:</b> para administrar Su registro como usuario del Servicio. Los Datos Personales que proporcione pueden darle acceso a diferentes funcionalidades del Servicio que están disponibles para Usted como usuario registrado.</li>
                  <li><b>Para la ejecución de un contrato:</b> el desarrollo, cumplimiento y ejecución del contrato de compra de los productos, artículos o servicios que haya comprado o de cualquier otro contrato con Nosotros a través del Servicio.</li>
                  <li><b>Para contactarlo:</b> Para contactarlo por correo electrónico, llamadas telefónicas, SMS u otras formas equivalentes de comunicación electrónica, como las notificaciones push de una aplicación móvil sobre actualizaciones o comunicaciones informativas relacionadas con las funcionalidades, productos o servicios contratados, incluidas las actualizaciones de seguridad, cuando sea necesario o razonable para su implementación.</li>
                  <li><b>Para proporcionarle</b> noticias, ofertas especiales e información general sobre otros bienes, servicios y eventos que ofrecemos y que son similares a los que ya ha comprado o sobre los que ha consultado, a menos que haya optado por no recibir dicha información.</li>
                  <li><b>Para gestionar sus solicitudes:</b> Para atender y gestionar sus solicitudes para nosotros.</li>
                  <li><b>Para transferencias comerciales:</b> podemos utilizar su información para evaluar o llevar a cabo una fusión, desinversión, reestructuración, reorganización, disolución u otra venta o transferencia de algunos o todos nuestros activos, ya sea como empresa en funcionamiento o como parte de una quiebra, liquidación, o procedimiento similar, en el que los Datos personales que tenemos sobre los usuarios de nuestro Servicio se encuentran entre los activos transferidos.</li>
                  <li><b>Para otros fines:</b> podemos utilizar su información para otros fines, como análisis de datos, identificación de tendencias de uso, determinación de la eficacia de nuestras campañas promocionales y para evaluar y mejorar nuestro Servicio, productos, servicios, marketing y su experiencia.</li>
                </ul>
                <p>Podemos compartir su información personal en las siguientes situaciones:</p>
                <ul>
                  <li><b>Con proveedores de servicios:</b> podemos compartir su información personal con proveedores de servicios para monitorear y analizar el uso de nuestro servicio, para comunicarnos con usted.</li>
                  <li><b>Para transferencias comerciales:</b> Podemos compartir o transferir Su información personal en relación con, o durante las negociaciones de, cualquier fusión, venta de activos de la Compañía, financiamiento o adquisición de la totalidad o una parte de Nuestro negocio a otra compañía.</li>
                  <li><b>Con afiliados:</b> podemos compartir su información con nuestros afiliados, en cuyo caso les exigiremos a esos afiliados que respeten esta Política de privacidad. Los afiliados incluyen nuestra empresa matriz y cualquier otra subsidiaria, socios de empresas conjuntas u otras empresas que controlemos o que estén bajo control común con nosotros.</li>
                  <li><b>Con socios comerciales:</b> podemos compartir su información con nuestros socios comerciales para ofrecerle ciertos productos, servicios o promociones.</li>
                  <li><b>Con otros usuarios:</b> cuando comparte información personal o interactúa de otro modo en las áreas públicas con otros usuarios, dicha información puede ser vista por todos los usuarios y puede distribuirse públicamente al exterior. Si interactúa con otros usuarios o se registra a través de un servicio de redes sociales de terceros, sus contactos en el servicio de redes sociales de terceros pueden ver su nombre, perfil, imágenes y descripción de su actividad. Del mismo modo, otros usuarios podrán ver descripciones de su actividad, comunicarse con usted y ver su perfil.</li>
                  <li><b>Con su consentimiento</b> podemos divulgar su información personal para cualquier otro propósito con su consentimiento.</li>
                </ul>
              </div>

              <div class="offset-top-50">
                <h3 class="text-bold"  style="font-family: helvetica neue,Helvetica,Arial,sans-serif; font-size: 30px;">Conservación de sus datos personales</h3>
                <p>La Compañía retendrá sus datos personales solo durante el tiempo que sea necesario para los fines establecidos en esta Política de privacidad. Retendremos y usaremos sus datos personales en la medida necesaria para cumplir con nuestras obligaciones legales (por ejemplo, si estamos obligados a retener sus datos para cumplir con las leyes aplicables), resolver disputas y hacer cumplir nuestros acuerdos y políticas legales.</p>
                <p>La Compañía también retendrá los Datos de uso con fines de análisis interno. Los datos de uso generalmente se conservan por un período de tiempo más corto, excepto cuando estos datos se usan para fortalecer la seguridad o mejorar la funcionalidad de nuestro servicio, o estamos legalmente obligados a retener estos datos por períodos de tiempo más largos.</p>
              </div>

              <div class="offset-top-50">
                <h3 class="text-bold"  style="font-family: helvetica neue,Helvetica,Arial,sans-serif; font-size: 30px;">Transferencia de sus datos personales</h3>
                <p>Su información, incluidos los Datos personales, se procesa en las oficinas operativas de la Compañía y en cualquier otro lugar donde se encuentren las partes involucradas en el procesamiento. Significa que esta información puede transferirse y mantenerse en computadoras ubicadas fuera de su estado, provincia, país u otra jurisdicción gubernamental donde las leyes de protección de datos pueden diferir de las de su jurisdicción.</p>
                <p>Su consentimiento a esta Política de privacidad seguido de Su envío de dicha información representa Su acuerdo con esa transferencia.</p>
                <p>La Compañía tomará todas las medidas razonablemente necesarias para garantizar que Sus datos sean tratados de forma segura y de acuerdo con esta Política de Privacidad y no se realizará ninguna transferencia de Sus Datos Personales a una organización o país a menos que existan controles adecuados establecidos, incluida la seguridad de Tus datos y otra información personal.</p>
              </div>

              <div class="offset-top-50">
                <h3 class="text-bold"  style="font-family: helvetica neue,Helvetica,Arial,sans-serif; font-size: 30px;">Divulgación de sus datos personales</h3>
                <h4 style="font-family: helvetica neue,Helvetica,Arial,sans-serif; font-size: 25px;" class="text-bold">Transacciones de negocios</h4>
                <p>Si la Compañía está involucrada en una fusión, adquisición o venta de activos, sus datos personales pueden ser transferidos. Le enviaremos un aviso antes de que sus datos personales se transfieran y estén sujetos a una política de privacidad diferente.</p>

                <h4 style="font-family: helvetica neue,Helvetica,Arial,sans-serif; font-size: 25px;" class="text-bold">Cumplimiento de la ley</h4>
                <p>En determinadas circunstancias, es posible que se le solicite a la Compañía que revele sus datos personales si así lo exige la ley o en respuesta a solicitudes válidas de las autoridades públicas (por ejemplo, un tribunal o una agencia gubernamental).</p>

                <h4 style="font-family: helvetica neue,Helvetica,Arial,sans-serif; font-size: 25px;" class="text-bold">Otros requisitos legales</h4>
                <p>La Compañía puede divulgar sus datos personales con la creencia de buena fe de que dicha acción es necesaria para:</p>
                <ul>
                  <li>Cumplir con una obligación legal</li>
                  <li>Proteger y defender los derechos o propiedad de la Empresa.</li>
                  <li>Prevenir o investigar posibles irregularidades en relación con el Servicio.</li>
                  <li>Proteger la seguridad personal de los Usuarios del Servicio o del público.</li>
                  <li>Protéjase contra la responsabilidad legal</li>
                </ul>
              </div>

              <div class="offset-top-50">
                <h3 class="text-bold"  style="font-family: helvetica neue,Helvetica,Arial,sans-serif; font-size: 30px;">Seguridad de sus datos personales</h3>
                <p>La seguridad de sus datos personales es importante para nosotros, pero recuerde que ningún método de transmisión a través de Internet o método de almacenamiento electrónico es 100% seguro. Si bien nos esforzamos por utilizar medios comercialmente aceptables para proteger sus datos personales, no podemos garantizar su seguridad absoluta.</p>
              </div>

              <div class="offset-top-50">
                <h2 style="font-family: helvetica neue,Helvetica,Arial,sans-serif; font-size: 35px;" class="text-bold">Privacidad de los niños</h2>
                <p>Nuestro Servicio no se dirige a ninguna persona menor de 13 años. No recopilamos a sabiendas información de identificación personal de ninguna persona menor de 13 años. Si usted es un padre o tutor y sabe que su hijo nos ha proporcionado datos personales, por favor Contáctenos. Si nos damos cuenta de que hemos recopilado datos personales de cualquier persona menor de 13 años sin verificación del consentimiento de los padres, tomamos medidas para eliminar esa información de nuestros servidores.</p>
                <p>Si necesitamos depender del consentimiento como base legal para procesar su información y su país requiere el consentimiento de uno de los padres, es posible que necesitemos el consentimiento de sus padres antes de recopilar y utilizar esa información.</p>
              </div>

              <div class="offset-top-50">
                <h2 style="font-family: helvetica neue,Helvetica,Arial,sans-serif; font-size: 35px;" class="text-bold">Enlaces a otros sitios web</h2>
                <p>Nuestro Servicio puede contener enlaces a otros sitios web que no son operados por Nosotros. Si hace clic en el enlace de un tercero, será dirigido al sitio de ese tercero. Le recomendamos encarecidamente que revise la Política de privacidad de cada sitio que visite.</p>
                <p>No tenemos control ni asumimos ninguna responsabilidad por el contenido, las políticas de privacidad o las prácticas de sitios o servicios de terceros.</p>
              </div>

              <div class="offset-top-50">
                <h2 style="font-family: helvetica neue,Helvetica,Arial,sans-serif; font-size: 35px;" class="text-bold">Cambios a esta política de privacidad</h2>
                <p>Podemos actualizar nuestra Política de privacidad de vez en cuando. Le notificaremos de cualquier cambio publicando la nueva Política de privacidad en esta página.</p>
                <p>Le informaremos por correo electrónico y / o un aviso destacado en Nuestro Servicio, antes de que el cambio entre en vigencia y actualizaremos la fecha de "Última actualización" en la parte superior de esta Política de privacidad.</p>
                <p>Se le recomienda que revise esta Política de privacidad periódicamente para ver si hay cambios. Los cambios a esta Política de privacidad entran en vigencia cuando se publican en esta página.</p>
              </div>

              <div class="offset-top-50">
                <h2 style="font-family: helvetica neue,Helvetica,Arial,sans-serif; font-size: 35px;" class="text-bold">Contáctenos</h2>
                <p>Si tiene alguna pregunta sobre esta Política de privacidad, puede contactarnos:</p>
                <ul>
                  <li>Por correo electrónico: <a href="mailto:cocinaaurora@gmail.com">cocinaaurora@gmail.com</a> ó <a href="mailto:cocinasaurora@gmail.com">cocinasaurora@gmail.com</a></li>
                  <li>Visitando esta página en nuestro sitio web: <a href="https://cocinas-aurora.herokuapp.com/" target="_blank">https://cocinas-aurora.herokuapp.com//</a></li>
                  <li>Por número de teléfono: <a href="tel:6188127776">618-812-77-76</a></li>
                </ul>
              </div>

              <div class="offset-top-30"><a href="https://cocinas-aurora.herokuapp.com/#contactanos" class="botonContac btn btn-primary">Contáctenos</a></div>
            </div>
          </div>
        </div>
      </main>

      <!-- Footer-->
      <footer class="indexZ page-footer">
        <?php include 'views/footer.php' ?>
      </footer>
    </div>

    <!-- Java script-->
    <script src="https://cocinas-aurora.herokuapp.com/js/core.min.js"></script>
    <script src="https://cocinas-aurora.herokuapp.com/js/script.js" async></script>
    <script>
        document.oncontextmenu = function(){
            return false
        }
        document.onkeydown = function(){
            return false
        }
    </script>
    <script src="https://cocinas-aurora.herokuapp.com/js/darkmode.js" async></script>
  </body>
</html>

<?php
  }
?>
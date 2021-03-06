@extends('layouts.app')

@section('content')

<div class="main_container_infoZaabra">
    <section class="section_banner_infoZaabra">
        <img class="img_banner_infoZaabra" src="{{URL::asset('/img/banners/bannerquienessomos/banner-politicas-de-uso.jpeg')}}">
        <h1 class="title_banner_infoZaabra">POLÍTICAS DE USO</h1>
    </section>

    <div class="content_subTitle">
        <h2 class="text_info_infoZaabra">Conozca todo sobre las políticas de uso y los términos y condiciones de Zaabra Salud y el sitio web.</h2>
    </div>

    <section class="section_acordion">
        <div id="accordion" class="content_accordion accordion">  <!-- Clase accordion para función del desplegable con cambio de color se encuentra ubicado en el archivo footer.js -->
            <div class="card card_acordion"> <!-- Políticas de cookies -->
                <div id="headingOne">
                    <button class="button_acordion" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Políticas de cookies
                    </button>
                </div>

                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body toggle_info">
                        <h5 class="title_toggle_info">¿Qué son las cookies?</h5>
                        <p class="txt_toggle_info">
                            Una cookie es un fichero que se descarga en su ordenador al acceder a determinadas páginas web. Las cookies permiten a una página web, entre otras 
                            cosas, almacenar y recuperar información sobre hábitos de navegación de un usuario o de su equipo y, dependiendo de la información que contengan y 
                            de la forma que utilice su equipo, pueden utilizarse para reconocer al usuario. <br>

                            Las cookies se crean en el dispositivo del usuario automáticamente cuando éste accede a la plataforma 
                            <a href="{{url('/')}}" target="blank"> www.zaabrasalud.co</a> y se registra o inicia sesión. Las cookies se obtienen del usuario y la información 
                            que éstas contienen pueden ser consultadas por ZAABRA SALUD y los terceros que se contraten para un servicio en específico. Es importante aclarar 
                            que las cookies solo son leídas por la plataforma digital que las creó; la información que guardan las cookies en nuestras plataformas digitales 
                            están incluidas en la sesión de usuario, dejando cada valor guardado en una cookie de manera encriptada, las cuales se eliminan al cerrar sesión.
                        </p>

                        <p class="txt_toggle_info">
                            Las clases de cookies que se utilizan en nuestra plataforma digital son las siguientes:
                        </p>
                        <ul class="text_li_toggle_info">
                            <li> <b>Cookies de sesión:</b> permanecen activas durante el tiempo que se tenga la sesión activa del usuario y se elimina una vez se cierre la 
                                sesión.
                            </li>
                            <li> <b>Cookies de terceros:</b> Son instaladas por terceros quienes prestan un servicio específico en la plataforma como encargado, la cual trata 
                                los datos a través de cookies. 
                            </li>
                            <li> <b>Cookies de Análisis:</b> Permiten realizar seguimiento al comportamiento de los usuarios en la plataforma digital y estudiar la navegación 
                                de los usuarios. 
                            </li>
                        </ul>

                        <p class="txt_toggle_info">
                            Los usuarios podrán deshabilitar, bloquear y/o eliminar las cookies en cualquier momento, el proceso varía según el navegador que esté en uso. 
                            De igual manera puede variar la configuración dependiendo la versión del navegador:
                        </p>
                        <ul class="text_li_toggle_info">
                            <li> <b>Chrome:</b> En el Navegador – 1. Configuración, 2. Configuración avanzada, 3. Privacidad y Seguridad, 4. Configuración del sitio web, 
                                5. Cookies y datos del sitio. Para mayor información, consulte el soporte o ayuda del Navegador. 
                            </li>
                            <li> <b>Safari:</b> En el Navegador – 1. Preferencias, 2. Privacidad. Para mayor información, consulte el soporte o ayuda del Navegador. </li>
                            <li> <b>Internet Explorer:</b> En el Navegador – 1. Herramientas, 2. Opciones de Internet, 3. Privacidad, 4. Configuración avanzada. Para mayor 
                                información, consulte el soporte o ayuda del Navegador. 
                            </li> 
                            <li> <b>Microsoft Edge:</b> En el Navegador – 1. Configuración, 2. Privacidad y seguridad. Para mayor información, consulte el soporte o ayuda 
                                del Navegador. 
                            </li> 
                            <li> <b>Firefox:</b> En el Navegador – 1. Opciones, 2. Privacidad & Seguridad, 3. Cookies y datos del sitio. Para mayor información, consulte 
                                el soporte o ayuda del Navegador. 
                            </li>
                            <li> <b>Navegador para dispositivos Android:</b> En el Navegador – 1. Menú, 2. Configuración, 3. Privacidad. Para mayor información, consulte 
                                el soporte o ayuda del Navegador. 
                            </li> 
                            <li> <b>Navegador para dispositivos IOS:</b> En el dispositivo – 1. Configuración, 2. Safari, 3. Privacidad y seguridad. Para mayor información, 
                                consulte el soporte o ayuda del Navegador 
                            </li> 
                        </ul>
                        <p class="txt_toggle_info">
                            ZAABRA COLOMBIA SAS, propietaria de la plataforma tendrá la plena libertad y autoridad para modificar, adaptar o cambiar el contenido de esta 
                            Política de cookies en cualquier momento. Usted acepta y reconoce las actualizaciones de este documento, por medio de la fecha de elaboración 
                            que está visible en la plataforma. <br>
                    
                            Si usted tiene inquietudes adicionales sobre el uso de cookies o cualquier aspecto de esta política puede escribirnos a 
                            <a href="{{url('/contacto')}}" target="blank">servicioalcliente@zaabrasalud.co</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="card card_acordion"> <!-- Políticas de privacidad -->
                <div id="headingTwo">
                    <button class="button_acordion" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Políticas de privacidad
                    </button>
                </div>

                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body toggle_info">
                        <p class="txt_toggle_info">
                            Gracias por acceder a la página web <a href="{{url('/')}}" target="blank">www.zaabrasalud.co</a> operada por ZAABRA COLOMBIA S.A.S. en adelante 
                            “ZAABRA SALUD”, sociedad Responsable del Tratamiento de sus Datos Personales, identificada con NIT 901.294.385-1, con domicilio principal en la 
                            ciudad de Bogotá D. C. y cuyas oficinas se encuentran ubicadas en la carrera 64 No. 67b-89 interior dos. <br>

                            ZAABRA SALUD trabaja día por día para junto con su personal humano prestarle un servicio de calidad cuando usted, que es el cliente y nuestra razón 
                            de ser, adquiere uno de nuestros servicios, cuidar sus datos personales es parte fundamental de nuestros principios y responsabilidades, por eso, 
                            para su seguridad y comodidad estos están resguardados y protegidos por nosotros en ZAABRA SALUD. <br>

                            Nuestra política de privacidad le explica de manera fácil y dinámica el tratamiento que hacemos de sus datos personales, a quienes bajo ciertas 
                            condiciones, transferimos y/o los transmitimos por razones estrictas de comercio, así como también las medidas de seguridad que ZAABRA SALUD ha 
                            tomado para protegerlos, los derechos que usted tiene como cliente y titular de sus datos personales y como puede ejercerlos en caso de no estar 
                            de acuerdo en cómo los hemos tratado. <br>

                            Lo invitamos a leer detalladamente esta Política de Privacidad y si tiene alguna duda, le pedimos que por favor nos contacte al correo electrónico 
                            <a href="{{url('/contacto')}}" target="blank">servicioalcliente@zaabrasalud.co</a> o al teléfono celular 3212449869, o envíe una comunicación a 
                            la carrera 64 No. 67b-89 interior dos, en la ciudad de Bogotá D.C. <br>

                            Del mismo modo, en caso de que el tratamiento de datos personales se haya de efectuar por empresas proveedoras de servicios para ZAABRA SALUD, dichas 
                            empresas proveedoras deberán asumir compromisos de confidencialidad y adoptar medidas que aseguren el debido cumplimiento de la normativa de 
                            protección de Datos Personales, en especial las establecidas en la 1581 de 2012 y su Decreto Reglamentario 1074 de 2015.
                        </p>

                        <h5 class="title_toggle_info">¿QUE DATOS PERSONALES RECOLECTAMOS?</h5>
                        <p class="txt_toggle_info">
                            Cuando usted crea un usuario en ZAABRA SALUD, descarga una actualización para un programa o participa en una encuesta online, podemos recopilar 
                            diferente información incluidos su nombre, dirección, número de teléfono, dirección de correo electrónico, preferencias de contacto. Una vez 
                            enviada esta información usted acepta, autoriza y otorga su consentimiento a ZAABRA SALUD para utilizar esta información de conformidad con lo 
                            establecido en la ley 1581 de 2012 y demás normas que en Colombia regulan el tratamiento de datos personales.
                        </p>

                        <p class="txt_toggle_info">
                            Los datos personales a los que podríamos dar tratamiento, son los siguientes:
                        </p>
                        <ul class="text_li_toggle_info">
                            <li>Nombre completo.</li>
                            <li>C.C. o NIT</li>
                            <li>Dirección completa para facturación.</li>
                            <li>Número de teléfono celular, teléfono fijo del consultorio.</li>
                            <li>Correo electrónico.</li>
                            <li>Número de tarjeta profesional, especialidad médica.</li>
                            <li>Datos de cuentas de redes sociales.</li>
                            <li>Datos de cuenta bancaria para procesa pagos número de la cuenta bancaria, (sucursal, plaza, cuenta clave ABA o SWIFT, copia de estado de cuenta 
                                bancaria mostrando cuenta clave a 18 dígitos y sin mostrar cantidades) 
                                y/o de tarjeta de débito o crédito.
                            </li>
                            <li>Referencias comerciales incluyendo nombre y datos de contacto.</li>
                            <li>Comprobante de domicilio con antigüedad menor a tres meses.</li>
                            <li>Carta autorización para la realización de transferencias bancarias.</li>
                        </ul>

                        <p class="txt_toggle_info">
                            ZABRA SALUD no recopila datos médicos ni otros datos personales sensibles, aunque puede actuar como encargado de los doctores afiliados a nuestros 
                            sistemas, con las obligaciones establecidas en la Ley.
                        </p>

                        <h5 class="title_toggle_info">¿COMO UTILIZAMOS SUS DATOS PERSONALES?</h5>
                        <p class="txt_toggle_info">
                            Finalidades del tratamiento: sus datos personales, serán mantenidos en la más estricta confidencialidad y serán resguardados de manera adecuada y 
                            solamente podrán ser tratados para las siguientes finalidades: <br>

                            * Fines necesarios para la existencia, mantenimiento y cumplimiento de nuestra Relación Jurídica y para el cumplimiento y ejecución de obligaciones 
                            legales como usuario de nuestros servicios; para enviar notificaciones importantes, tales como las notificaciones acerca de cambios en nuestros 
                            términos, condiciones, y políticas. <br>

                            Los datos personales que recolectamos nos permite mantenerlo informado acerca de los últimos anuncios de productos, actualizaciones de programas, 
                            próximos eventos y servicios de ZAABRA SALUD. También ayuda a mejorar nuestros servicios, contenidos y publicidades. También podemos utilizar su 
                            información para ayudarnos a desarrollar, entregar, y mejorar nuestros productos, servicios, contenidos y publicidad. Oportunamente, podemos 
                            utilizar su información personal para enviar notificaciones importantes, tales como las notificaciones acerca de cambios en nuestros términos, 
                            condiciones, y políticas. También podemos utilizar información para fines internos tales como auditorías, análisis de datos, e investigación para 
                            mejorar los productos, servicios y comunicaciones a los clientes de ZAABRA SALUD. En caso de un sorteo, concurso, o promoción similar podremos 
                            usar la información que proporcione para administrar dichos programas. <br>

                            Debido a que esta información no es indispensable para su relación con ZAABRA SALUD, puede optar por no recibir dichas comunicaciones, mediante 
                            aviso por escrito dirigido al correo electrónico indicado al inicio de este aviso.
                        </p>

                        <h5 class="title_toggle_info">¿RECOLECCIÓN Y USO DE INFORMACIÓN GENERAL NO DATOS PERSONALES?</h5>
                        <p class="txt_toggle_info">
                            También recolectamos información general no personal, la cual se compone por datos que no permiten asociación directa con ninguna persona. Podemos 
                            recolectar, utilizar, transferir, y revelar información general para cualquier fin. A continuación, presentamos algunos ejemplos de información 
                            general que hemos recolectado y cómo podemos utilizarla: Podemos recolectar información tal como profesión, idioma, código postal, código de área, 
                            ubicación, y la zona horaria en la que el software ZAABRA SALUD se utiliza, para poder entender mejor el comportamiento de los usuarios y mejorar 
                            nuestros productos, servicios y publicidades. Podemos recolectar información relativa a la actividad de los clientes en nuestras páginas web y 
                            servicios. Esta información se compila y nos ayuda a proporcionar información de mayor utilidad a nuestros clientes y a entender qué partes de 
                            nuestra página web, productos y servicios son de mayor interés. La información compilada se considera información general para los fines de la 
                            presente Política de Privacidad. En caso de que combinemos información general no personal con datos personales, la información combinada será 
                            considerada información personal mientras se mantenga combinada.
                        </p>

                        <h5 class="title_toggle_info">¿CÓMO USAMOS LAS POLÍTICAS DIGITALES?</h5>
                        <p class="txt_toggle_info">
                            El IO del servicio de Consulta Digital que haga uso de cualquiera de los teléfonos de los doctores que aparecen en dicha plataforma, consiente 
                            expresamente el tratamiento del número del teléfono desde el cual realice la llamada e información que facilite a través de la misma, de acuerdo 
                            con la política de protección de datos de ZAABRA SALUD y conforme se le informa en la correspondiente locución telefónica.
                        </p>

                        <h5 class="title_toggle_info">¿INTEGRIDAD Y CONSERVACIÓN DE DATOS PERSONALES?</h5>
                        <p class="txt_toggle_info">
                            ZAABRA SALUD facilita la conservación de los datos personales de una forma precisa, completa y actualizada. La información personal se conservará 
                            por el período que sea necesario para cumplir con los fines establecidos en la presente Política de Privacidad, excepto que por Ley se requiera o 
                            autorice un período de conservación superior.
                        </p>

                        <h5 class="title_toggle_info">¿ACCESO A LOS DATOS PERSONALES?</h5>
                        <p class="txt_toggle_info">
                            Usted puede ayudarnos a garantizar que su información de contacto y sus preferencias son precisas, completas y están adecuadas comprobando sus datos 
                            en la sección de configuración de su espacio de usuario. Para cualquier duda, aclaración o petición acerca de los datos personales ligada a su 
                            usuario le pedimos que se comunique a través del correo electrónico  
                            <a href="{{url('/contacto')}}" target="blank">servicioalcliente@zaabrasalud.co</a>
                        </p>

                        <h5 class="title_toggle_info">¿MENORES DE EDAD?</h5>
                        <p class="txt_toggle_info">
                            Sólo pueden llenar y declarar bajo exigencia de decir la verdad las personas mayores de edad, en el entendido de que los datos por ellos manifestados 
                            son veraces y fidedignos. Si eres menor de edad, debe salir inmediatamente de la aplicación o programa ZAABRA SALUD. No se hará uso de los datos 
                            personales de menores de edad existentes en las bases de datos de los usuarios. En caso de que un menor de edad envíe información personal a 
                            ZAABRA SALUD y tengamos conocimiento de ello, suprimiremos esa información lo antes posible.
                        </p>

                        <h5 class="title_toggle_info">¿SITIOS Y SERVICIOS DE TERCEROS?</h5>
                        <p class="txt_toggle_info">
                            Las páginas web, así como la aplicación y servicios de ZAABRA SALUD pueden contener enlaces hacia páginas, productos y servicios de terceros. 
                            Nuestros productos y servicios pueden además utilizar u ofrecer productos o servicios de terceros, por ejemplo, una aplicación de terceros para 
                            usted. La información recopilada por terceros, entre la que se incluye datos de localización o de contacto, está regulada por sus respectivas 
                            políticas de privacidad. Le recomendamos que obtenga mayor información acerca de dichas políticas de privacidad.
                        </p>

                        <h5 class="title_toggle_info">¿EL COMPROMISO DE NUESTRA EMPRESA CONN SUS DATOS?</h5>
                        <p class="txt_toggle_info">
                            Para asegurarnos de que sus datos personales están bien resguardados, damos a conocer estas directrices a todos los empleados y contratistas de 
                            ZAABRA SALUD sin importar su función o línea de negocio e imponemos estrictas medidas de seguridad dentro de la propia empresa. <br>

                            Transferencia de Datos Personales: Sus datos personales podrán ser remitidos a prestadores de servicios que nos auxilien al cumplimiento de las 
                            finalidades mencionadas en este Aviso de Privacidad, quienes tendrán el carácter de encargados y no deberán usar sus datos personales para fines no 
                            señalados en este Aviso de Privacidad. <br>

                            Sus datos personales no podrán ser transferidos sin su consentimiento. En caso de otorgarlo, usted podrá revocarlo en cualquier momento, mediante 
                            comunicación por escrito entregada en nuestro domicilio o enviada por correo electrónico a la dirección que aparece en este mismo aviso.
                        </p>

                        <h5 class="title_toggle_info">¿JURISDICCIÓN?</h5>
                        <p class="txt_toggle_info">
                            Cualquier controversia relacionada con la interpretación y aplicación de las presentes Políticas de Privacidad, se regirán por las Leyes Colombianas 
                            y se ventilarán en los Tribunales y autoridades administrativas de Colombia.
                        </p>

                        <h5 class="title_toggle_info">¿DESCARGO DE RESPONSABILIDAD?</h5>
                        <p class="txt_toggle_info">
                            La información presentada en este sitio web no tiene ninguna voluntad de sustituir a un consejo médico propiamente dicho, ni ZAABRA SALUD ser un 
                            servicio médico de referencia. Nos esforzamos continuamente por mantener un alto grado de precisión y fiabilidad en la información médica 
                            proporcionada, pero no aseguramos la total exactitud, integridad o exhaustividad de la información contenida o vinculada a 
                            <a href="{{url('/')}}" target="blank"> www.zaabrasalud.co</a> o sus sitios web. La selección de un médico es una decisión importante que no debe 
                            basarse únicamente en la publicidad o anuncios en este sitio web. ZAABRA SALUD no tiene ninguna responsabilidad vinculada a la calidad de los 
                            servicios médicos prestados por los médicos que figuran en este sitio web ni asegura un mayor servicio que el de otros médicos con licencia. 
                            ZAABRA SALUD es una empresa independiente que ha desarrollado una metodología de selección de doctores de alto nivel propia y exclusiva. 
                            ZAABRA SALUD no acepta y aloja ninguna publicidad. El uso de este sitio está sujeto a estos términos y condiciones. <br>

                            En ZAABRA SALUD tratamos la información que nos facilitan las personas interesadas con el fin de prestarle los servicios de intermediación online 
                            entre usuario y los profesionales incluidos en el directorio de la plataforma. <br>

                            En el caso del directorio, los servicios consisten en el acceso a información sobre los profesionales, servicio de agendamiento de cita online o 
                            presencial, pago de la consulta con el profesional dentro de la misma plataforma, por medio de la pasarela de pago OPENPAY, el valor de la consulta 
                            solo dependerá de lo definido por el profesional. <br>

                            En el caso del software de gestión de consulta, los profesionales introducen información de sus propios pacientes. En este caso ZAABRA SALUD es un 
                            proveedor de servicios para los profesionales y encargado del tratamiento de datos. El profesional es el responsable del tratamiento de datos. 
                            ZAABRA SALUD, en cumplimiento de lo estipulado por la normativa de protección de datos, tiene firmado un contrato con el responsable del tratamiento. 
                            El responsable del tratamiento es el responsable de solicitar a los usuarios el consentimiento para el tratamiento de sus datos personales y de 
                            garantizar el correcto cumplimiento de las normativas de privacidad. En ningún caso ZAABRA SALUD será responsable de la omisión por parte de un 
                            profesional o centro de su obligación de cumplimiento de la reglamentación vigente.<br>

                            Los servicios de ZAABRA SALUD incluyen el envío de recordatorios de citas a través de SMS o correo electrónico, esto puede realizarse en nombre de 
                            ZAABRA SALUD o del profesional; también se realizan envíos de otras comunicaciones, como campañas promocionales del propio profesional. <br>

                            ZAABRA SALUD también puede enviarle noticias para solicitarle que deje sus comentarios después de la cita con el profesional, ya sea esta cita 
                            reservada por el usuario mediante la plataforma web de ZAABRA SALUD o introducida por el profesional en el software de gestión de ZAABRA SALUD 
                            con el que el profesional gestiona su servicio. Estas comunicaciones se harán en nombre de ZAABRA SALUD y enviarán al usuario al portal de 
                            ZAABRA SALUD donde podrá opinar en el perfil público del profesional con el que realizó la cita. <br>

                            Los datos personales proporcionados se conservarán mientras el usuario permanezca activo en la plataforma y durante los plazos necesarios para dar 
                            cumplimiento a las obligaciones legales; la base legal para el tratamiento de sus datos es el consentimiento del interesado. <br>

                            Los datos se comunicarán a los profesionales encargados de Tratamiento que dan distinto soporte a ZAABRA SALUD como Legal, alojamiento de datos, 
                            gestión de bases de datos y de comunicaciones, así como a los terceros necesarios para dar cumplimiento a las obligaciones legales; cualquier 
                            persona tiene derecho a obtener información sobre si en ZAABRA SALUD estamos tratando datos personales que les conciernen, o no. <br>

                            Las personas interesadas tienen derecho a acceder a sus datos personales, así como a solicitar la rectificación de los datos inexactos o, en su caso, 
                            solicitar su supresión cuando, entre otros motivos, los datos ya no sean necesarios para los fines que fueron recogidos. <br>

                            En determinadas circunstancias, los interesados podrán solicitar la limitación del tratamiento de sus datos, en cuyo caso únicamente los 
                            conservaremos para el ejercicio o la defensa de reclamaciones. <br>

                            En determinadas circunstancias y por motivos relacionados con su situación particular, los interesados podrán oponerse al tratamiento de sus datos. 
                            En este caso, ZAABRA SALUD dejará de tratar los datos, salvo por motivos legítimos imperiosos, o el ejercicio o la defensa de posibles 
                            reclamaciones. <br>

                            Podrá ejercer sus derechos de la siguiente forma: dirigiéndose a ZAABRA COLOMBIA SAS, con dirección en la ciudad de Bogotá en la 
                            carrera 64 # 67b-89 interior dos, o a través del correo electrónico 
                            <a href="{{url('/contacto')}}" target="blank">servicioalcliente@zaabrasalud.co</a> identificándose debidamente e indicando de forma expresa el 
                            concreto derecho que se quiere ejercer. <br>

                            Si ha otorgado su consentimiento para alguna finalidad concreta, tiene derecho a retirar el consentimiento otorgado en cualquier momento, sin que 
                            ello afecte a la licitud del tratamiento basado en el consentimiento previo a su retirada. <br>

                            Cuando precisemos obtener información por su parte, siempre le solicitaremos que nos la proporcione voluntariamente prestando su consentimiento de 
                            forma expresa a través de los medios habilitados para ello. <br>

                            El tratamiento de los datos recabados a través de los formularios de recogida de datos del sitio web u otras vías, quedará incorporado al Registro 
                            de Actividades de Tratamiento del cual es responsable ZAABRA SALUD. <br>

                            ZAABRA SALUD trata los datos de forma confidencial y adopta las medidas técnicas y organizativas apropiadas para garantizar el nivel de seguridad 
                            adecuado al tratamiento, en cumplimiento de lo requerido por la ley 1581 de 2012, de tratamiento de datos o habeas data. <br>

                            No obstante, no puede garantizar la absoluta invulnerabilidad de los sistemas, por tanto, no asume ninguna responsabilidad por los daños y 
                            perjuicios derivados de alteraciones que terceros puedan causar en los sistemas informáticos, documentos electrónicos o ficheros del usuario. <br>

                            Si opta por abandonar nuestro sitio web a través de enlaces a sitios web no pertenecientes a nuestra entidad, ZAABRA SALUD no se hará responsable 
                            de las políticas de privacidad de dichos sitios web ni de las cookies que éstos puedan almacenar en el ordenador del usuario. <br>

                            Nuestra política con respecto al envío de nuestros propios correos electrónicos se centra en remitir únicamente comunicaciones que usted haya 
                            solicitado recibir. Si prefiere no recibir estos mensajes por correo electrónico le ofreceremos a través de los mismos la posibilidad de ejercer 
                            su derecho de supresión y renuncia a la recepción de estos de conformidad con lo dispuesto en la ley 1581 de 2012, que fue reglamentada por el 
                            decreto 1377 de 2013. <br>

                            En ZAABRA SALUD tratamos la información que nos facilitan las personas interesadas con el fin de prestarle los servicios de intermediación on 
                            line entre los profesionales y los usuarios, a través del directorio de la plataforma. <br>

                            ZAABRA SALUD recopila información tanto de los profesionales como de los usuarios, cuando se realiza el registro en la plataforma al diligenciar 
                            un formulario de contacto, enviar mensajes o solicitar consultas por medio de formularios. <br>

                            Al solicitar o registrarse en nuestro sitio, se le puede pedir que introduzca su nombre, dirección de correo electrónico, número de teléfono, ciudad 
                            de consulta, profesión, especialidad, entre otros. <br>

                            Para información de facturación se pide incluir la información del pago y los datos de su tarjeta de crédito por medio de la pasarela de pagos 
                            estipulada en la página; al solicitar asistencia o servicio al cliente, se le puede pedir que introduzca nombre, teléfono de contacto y correo 
                            electrónico y al diligenciar cualquiera de nuestros formularios en ZAABRA SALUD, nosotros guardamos su dirección IP; Usted puede, sin embargo, 
                            visitar nuestro sitio de forma incógnita. <br>

                            Toda la información que usted nos provee puede ser usada en una o más de las siguientes formas: Para personalizar su perfil, para una mejor 
                            experiencia en servicio al cliente, crear y gestionar su cuenta (botón mi cuenta), Procesar las transacciones de compra, verificar identidad y 
                            derechos a servicios; la información sea pública o privada, no será vendida, intercambiada, transferida o dada a otra empresa por ningún motivo 
                            sin su consentimiento, excepto con el expreso propósito de entregar el servicio solicitado. <br>

                            La dirección de correo electrónico que usted proporciona será utilizada para: Enviarle información y actualizaciones correspondientes a las 
                            solicitudes o pagos realizados en la plataforma de ZAABRA SALUD, también correos informativos o de su interés. <br>

                            Se entregarán métricas del movimiento de cada perfil una vez al mes solo en caso de solicitud del profesional, esta solicitud la puede realizar 
                            escribiendo al correo <a href="{{url('/contacto')}}" target="blank">servicioalcliente@zaabrasalud.co</a> en los siguientes tres días hábiles 
                            recibirá la respuesta al correo registrado en el perfil. <br>

                            De igual manera por correo electrónico podremos evaluar y mejorar la calidad del servicio y del sitio web ZAABRA SALUD; en el momento que usted 
                            desee puede solicitar no recibir más correos; si no desea que utilicemos su información de esta manera, se puede comunicar al teléfono fijo 7123945 
                            celular 3212449869 o por medio del correo electrónico <a href="{{url('/contacto')}}" target="blank">servicioalcliente@zaabrasalud.co</a> <br>

                            La información que recopilamos sobre usted, está almacenada en servidores de la compañía. <br>

                            Al utilizar nuestro sitio web ZAABRA SALUD, usted acepta y da su consentimiento a nuestra política de privacidad.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card card_acordion"> <!-- Términos y condiciones de Zaabra Salud -->
                <div id="headingFour">
                    <button class="button_acordion" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Términos y condiciones de Zaabra Salud
                    </button>
                </div>

                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                    <div class="card-body toggle_info">
                        <h5 class="title_toggle_info mt-0">TÉRMINOS Y CONDICIONES</h5>
                        <p class="txt_toggle_info">
                            Este documento describe los términos y condiciones generales (los "términos y condiciones generales"), aplicables al acceso y uso de los servicios 
                            ofrecidos por ZAABRA COLOMBIA S.A.S. ("Zaabra") dentro del sitio <a href="{{url('/')}}" target="blank">www.zaabrasalud.co</a> y/u otros dominios 
                            (urls) relacionados (en adelante "ZAABRA SALUD" o el "Sitio"), en donde estos términos y condiciones se encuentren. Cualquier persona que desee 
                            acceder y/o suscribirse y/o usar el sitio o los servicios podrá hacerlo sujetándose a los términos y condiciones generales, junto con todas las demás 
                            políticas y principios que rigen <a href="{{url('/')}}" target="blank">www.zaabrasalud.co</a> y que son incorporados al presente documento 
                            directamente o por referencia o que son explicados y/o detallados en otras secciones del sitio. En consecuencia, todas las visitas y todos los 
                            contratos y transacciones que se realicen en este sitio, así como sus efectos jurídicos, quedarán regidos por estas reglas y sometidos a la 
                            legislación aplicable en Colombia. <br>
                            
                            Al utilizar https://zaabrasalud.co ustes está de acuerdo en cumplir con los términos y condiciones establecidos en este documento. Por favor, léalo 
                            cuidadosamente antes de usar. Si usted no está de acuerdo con ellos, por favor absténgase de ingresar y utilizar el sitio. <br>

                            Cualquier utilización distinta a la autorizada está expresamente prohibida, pudiendo ZAABRA SALUD denegar o reterirar el acceso y su uso en 
                            cualquier momento.
                        </p>

                        <h5 class="title_toggle_info">AVISO LEGAL</h5>
                        <p class="txt_toggle_info">
                            El presente aviso legal regula el uso y utilización de la plataforma que es titular ZAABRA COLOMBIA SAS (en adelante ZAABRA SALUD). La navegación 
                            por el sitio web de ZAABRA SALUD le atribuye la condición de usuario del mismo y conlleva su aceptación plena y sin reservas de todas y cada una de 
                            las condiciones publicadas en este aviso legal, advirtiendo de que dichas condiciones podrán ser modificadas sin notificación previa por parte de 
                            ZAABRA SALUD, en cuyo caso se procederá a su publicación y aviso con la máxima antelación posible; por ello es recomendable leer atentamente su 
                            contenido en caso de desear acceder y hacer uso de la información y de los 
                            servicios ofrecidos desde este sitio web.<br>

                            El usuario, además, se obliga a hacer un uso correcto del sitio web de conformidad con las leyes, la buena fe, el orden público, los usos del 
                            tráfico y el presente Aviso Legal, y responderá frente a ZAABRA SALUD o frente a terceros, de cualquier daño y perjuicio que pudieran causarse como 
                            conssecuencia del incumplimientode dicha obligación; cualquier utilización distinta a la autorizada está expresamente prohibida, pudiendo 
                            ZAABRA SALUD denegar o retirar el acceso y su uso en cualquier momento.
                        </p>

                        <h5 class="title_toggle_info">1. IDENTIFICACIÓN</h5>
                        <p class="txt_toggle_info">
                            ZAABRA SALUD, en cumplimiento de la Ley 1581 de 2012 <br>
                            Razón social: Zaabra Colombia sas <br>
                            Nombre Comercial: Zaabra Colombia <br>
                            Identificación (Nit): 901294385-1 <br>
                            Dirección: Carrera 64 # 67 B – 89 Interior dos
                        </p>

                        <h5 class="title_toggle_info">2. CONTACTO</h5>
                        <p class="txt_toggle_info">
                            Para comunicarse con nosotros, contamos con diferentes medios de comunicación tanto escrita como telefónica y que detallamos a continuación<br>
                            Teléfono: 3212449869 – 7123946 <br>
                            Correo electrónico: <a href="{{url('/contacto')}}" target="blank">servicioalcliente@zaabrasalud.co</a> <br>
                            Dirección: Carrera 64 # 67 B – 89 Interior dos <br>
                            Todas las notificaciones y comunicaciones entre los usuarios y ZAABRA SALUD se considerarán eficaces, a todos los efectos, cuando se realicen 
                            a través de cualquier medio de los detallados anteriormente.
                        </p>

                        <h5 class="title_toggle_info">3. CONDICIONES DE ACCESO Y USO</h5>
                        <p class="txt_toggle_info">
                            El sitio web y sus servicios son de acceso libre y gratuito. No obstante, ZAABRA SALUD puede condicionar la utilización de algunos de los servicios 
                            ofrecidos en su plataforma a la previa redacción del correspondiente formulario con todos los datos y documentos solicitados, toda esta información 
                            está sujeta a verificación; de igual manera el usuario garantiza la autenticidad y actualidad de todos aquellos datos que comunique a ZAABRA SALUD 
                            y será el único responsable de las manifestaciones falsas o inexactas que realice. <br>

                            El usuario, profesional o institución se compromete expresamente a hacer un uso adecuado de los contenidos y servicios de ZAABRA SALUD y a no 
                            emplearlos con fines destructivos como:
                        </p>

                        <ul class="text_li_toggle_info">
                            <li>El uso del sitio web <a href="{{url('/')}}" target="blank">www.zaabrasalud.co</a> por parte de los usuarios es TOTALMENTE GRATUITO. Los usuarios 
                                no contratan ni compran ningún servicio a través del sitio web. Se entiende por usuarios (en adelante usuarios y/o clientes, indistintamente) las 
                                personas físicas particulares que accedan a los servicios.
                            </li>
                            <li>Difundir contenidos delictivos, violentos, pornográficos, racistas, xenófobos, ofensivos, de apología del terrorismo o, en general, contrarios a 
                                la ley o al orden público.
                            </li>
                            <li>Introducir en la red virus informáticos o realizar actuaciones susceptibles de alterar, estropear, interrumpir o generar errores o daños en los 
                                documentos electrónicos, datos o sistemas físicos y lógicos de ZAABRA SALUD o de terceras personas; así como obstaculizar el acceso de otros 
                                usuarios al sitio web y a sus servicios mediante el consumo masivo de los recursos informáticos a través de los cuales ZAABRA SALUD 
                                presta sus servicios.
                            </li>
                            <li>Intentar acceder a las cuentas de correo electrónico de otros usuarios o áreas restringidas de los sistemas informáticos de ZAABRA SALUD o de 
                                terceros y, en su caso, extraer información.
                            </li>
                            <li>Vulnerar los derechos de propiedad intelectual o industrial, así como violar la confidencialidad de la información de ZAABRA SALUD o de 
                                terceros.
                            </li>
                            <li>Suplantar la identidad de cualquier otro usuario.</li>
                            <li>Reproducir, copiar, distribuir, poner a disposición de, o cualquier otra forma de comunicación pública, transformar o modificar los contenidos, 
                                a menos que se cuente con la autorización del titular de los correspondientes derechos o ello resulte legalmente permitido.
                            </li>
                            <li>Conseguir datos con finalidad publicitaria y de remitir publicidad de cualquier clase y comunicaciones con fines de venta u otras de naturaleza 
                                comercial sin que medie su previa solicitud o consentimiento.
                            </li>
                            <li>En caso de estar en desacuerdo con la totalidad o parte de las presentes condiciones, el cliente debe de abstenerse de continuar utilizando el 
                                sitio web y/o sus servicios.
                            </li>
                            <li>Estas condiciones generales podrán ser modificadas sin notificación previa, por tanto, es recomendable leer atentamente su contenido entes de 
                                proceder al acceso de cualquiera de los servicios ofertados.
                            </li>
                            <li>El uso de cualquiera de los servicios conlleva la aceptación plena y sin reservas de todas y cada una de las condiciones generales que se 
                                indican, así como del aviso legal, sin perjuicio de la aceptación de las condiciones particulares que pudieran ser de aplicación.
                            </li>
                        </ul>

                        <p class="txt_toggle_info">
                            Todos los contenidos del sitio web, como textos, fotografías, gráficos, imágenes, iconos, tecnología, software, así como su diseño gráfico y códigos 
                            fuente, constituyen una obra cuya propiedad pertenece a ZAABRA SALUD, sin que puedan entenderse cedidos al usuario ninguno de los derechos de 
                            explotación sobre los mismos más allá de lo estrictamente necesario para el correcto uso de la web. <br>
                            
                            En definitiva, los usuarios que accedan a este sitio web pueden visualizar los contenidos y efectuar, en su caso, copias privadas autorizadas 
                            siempre que los elementos reproducidos no sean cedidos posteriormente a terceros, ni se instalen a servidores conectados a redes, ni sean objeto de 
                            ningún tipo de explotación. <br>

                            Así mismo, todas las marcas, nombres comerciales o signos distintivos de cualquier clase que aparecen en el sitio web son propiedad de ZAABRA SALUD, 
                            sin que pueda entenderse que el uso o acceso al mismo atribuya al usuario derecho alguno sobre los mismos. <br>

                            El profesional o institución, al escribir en el sitio web respuestas a preguntas y consultas realizadas por particulares y, por tanto, publicar 
                            contenido en ZAABRA SALUD, estará otorgando a favor de ZAABRA SALUD una licencia mundial, no exclusiva y transferible (con derecho de sub-licencia) 
                            para utilizar, reproducir, distribuir, realizar obras derivadas de, mostrar y ejecutar ese contenido en relación con la prestación de los servicios y 
                            con el funcionamiento del servicio y de la actividad de ZAABRA SALUD, incluyendo sin limitación alguna, a efectos de promoción y redistribución de la 
                            totalidad o de una parte del servicio (y de sus obras derivadas) en cualquier formato y a través de cualquier canal de comunicación. <br>

                            La distribución, modificación, cesión o comunicación pública de los contenidos y cualquier otro acto que no haya sido expresamente autorizado por el 
                            titular de los derechos de explotación quedan prohibidos. <br>

                            El establecimiento de un hiperenlace no implica en ningún caso la existencia de relaciones entre hiperenlace y el propietario del sitio web en la que 
                            se establezca, ni la aceptación y aprobación por parte de hiperenlace de sus contenidos o servicios. <br>

                            ZAABRA SALUD no se responsabiliza del uso que cada usuario les dé a los materiales puestos a disposición en este sitio web ni de las actuaciones que 
                            realice en base a los mismos.
                        </p>

                        <h5 class="title_toggle_info">3.1 EXCLUSIÓN DE GARANTÍAS Y DE RESPONSABILIDAD EN EL ACCESO Y USO</h5>
                        <p class="txt_toggle_info">
                            El contenido del presente sitio web es de carácter general y tiene una finalidad simplemente informativa, sin que se garantice plenamente el acceso a 
                            todos los contenidos, ni su exhaustividad, corrección, vigencia o actualidad, ni su idoneidad o utilidad para un objetivo específico. <br> 

                            ZAABRA SALUD excluye, hasta donde permite el ordenamiento juridico, cualquier responsabilidad por los daños y perjucios de toda naturaleza derivados 
                            de: <br>

                            La imposibilidad de acceso al sitio web o la falta de veracidad, exactitud, exhaustividad y/o actualidad de los contenidos, así como la existencia de 
                            vicios y defectos de toda clase de los contenidos transmitidos, difundidos, almacenados, puestos a disposición, a los que se haya accedido a través 
                            del sitio web o de los servicios que se ofrecen. <br>

                            La presencia de virus o de otros elementos en los contenidos que puedan producir alteraciones en los sistemas informáticos, documetos electrónicos o 
                            datos de los usuarios. <br>

                            El incumplimiento de las leyes, la buena fe, el orden público, los usos del tráfico y el presente aviso legal como consecuencia del uso incorrecto 
                            del sitio web. En particular, y a modo ejemplificativo, ZAABRA SALUD no se hace responsable de las actuaciones de terceros que vulneren derechos de 
                            propiedad intelectual e industrial, secretos empresariales, derechos al honor, a la intimidad personal y familiar y a la propia imagen, así como la 
                            normativa en materia de competencia desleal y publicidad ilicita. <br>

                            Así mismo, ZAABRA SALUD declina cualquier responsabilidad respecto a la información que se halle fuera de esta web y no sea gestionada directamente 
                            por nuestro web master. La función de los links que aparecen en esta web es exclusivamente la de informar al usuario sobre la existencia de otras 
                            fuentes susceptibles de ampliar los contenidos que ofrece este sitio web. ZAABRA SALUD no garantiza ni se responsabiliza del funcionamiento o 
                            accesibilidad de los sitios enlazados; ni sugiere, invita o recomienda la visita a los mismos, por lo que tampoco será responsable del resultado 
                            obtenido. ZAABRA SALUD no se responsabiliza del establecimiento de hipervinculos por parte de terceros.
                        </p>

                        <h5 class="title_toggle_info">3.2 PROCEDIMIENTO EN CASO DE REALIZACIÓN DE ACTIVIDADES DE CARÁCTER ILÍCITO</h5>
                        <p class="txt_toggle_info">
                            En el caso de que cualquier usuario o un tercero considere que existen hechos o circunstancias que revelen el carácter ilicito de la utilización de 
                            cualquier contenido y/o de la realización de cualquier actividad en las páginas web incluidas o accesibles a través del sitio web, deberá enviar una 
                            notificación a ZAABRA SALUD identificandose debidamente y especificando las supuestas infracciones.
                        </p>

                        <h5 class="title_toggle_info">3.3 PUBLICACIONES</h5>
                        <p class="txt_toggle_info">
                            La información administrativa facilitada a través del sitio web no sustituye la publicidad legal de las leyes, normativas, planes, disposiciones 
                            generales y actos que tengan qie ser publicados formalmente a los diarios oficiales de las administraciones públicas, que constituyen el único 
                            instrumento que da fe de su autenticidad y contenido. La información disponible en este sitio web debe entenderse como una guia sun propósito de 
                            validez legal.
                        </p>

                        <h5 class="title_toggle_info">4. PROCESO DE ACCESO A LOS SERVICIOS</h5>
                        <p class="txt_toggle_info">
                            Para la utilización de los servicios de <a href="{{url('/')}}" target="blank">www.zaabrasalud.co</a> es necesario que el cliente sea 
                            mayor de edad.<br>

                            Registro de Usuario: Para acceder a algunos de los servicios será necesaria la suscripción o registro del usuario, el cual creará su propia cuenta 
                            por medio de un correo electrónico y una contraseña, los cuales se verifican automáticamente, con estos habilitará personalmente para poder tener 
                            acceso a los servicios. <br>

                            Las contraseñas son personales e intransferibles, el usuario se hace plenamente responsable de tratar de forma confidencial y custodiar adecuadamente 
                            sus contraseñas, evitando el acceso a las mismas de terceras personas no autorizadas expresamente por ZAABRA SALUD. El usuario acepta hacerse 
                            plenamente responsable de las consecuencias económicas y de cualquier otra naturaleza derivadas de cualquier utilización irresponsable de las 
                            contraseñas en el sitio web y/o de su utilización por terceros no autorizados.<br>

                            Tratamiento de Datos Personales: Para acceder a alguno de los servicios será preciso que el cliente se registre en 
                            <a href="{{url('/')}}" target="blank">www.zaabrasalud.co</a> a través de un formulario de recogida de datos en el que se proporcione a ZAABRA SALUD 
                            la información necesaria para la prestación del servicio; datos que en cualquier caso serán veraces, exactos y completos sobre su identidad y que el 
                            cliente deberá consentir expresamente mediante la aceptación de la Política de Privacidad de ZAABRA SALUD. <br>

                            Comunicación de Datos Personales: Para los servicios online agendamiento y pago de citas, el profesional obtiene los datos del usuario para que 
                            genere el contacto necesario para el buen uso y prestación del servicio. En este caso, el profesional, al activar el servicio de agendamiento de 
                            cita, está autorizando a ZAABRA SALUD a actuar como intermediario de las reservas que los usuarios de la web realicen en su agenda, y, por tanto, 
                            autoriza a recoger y conservar la información necesaria para el correcto desempeño del servicio. El usuario del servicio, que reserva con un 
                            profesional a través del sitio web ZAABRA SALUD, autoriza así mismo a esta a que sus datos puedan ser comunicados al profesional a ZAABRA SALUD 
                            para esa gestión. Por tanto, el usuario autoriza, como titular de los datos, a que estos puedan ser comunicados a terceros, siempre que esta 
                            comunicación responda a una necesidad para el desarrollo, cumplimiento, mantenimiento y ejecución de las obligaciones surgidas de esta relación 
                            negociar, ley 1581 de 2012.<br>
                            
                            ZAABRA SALUD podrá suspender, retirar o cancelar parcial o totalmente los servicios en cualquier momento y sin necesidad de aviso previo, La 
                            previsión anterior no afectará a aquellos servicios que están reservados para usuarios registrados o que son objeto de contratación previa y 
                            que se regirán por sus condiciones especificas.
                        </p>

                        <h5 class="title_toggle_info">4.1 REGISTRO DE USUARIOS</h5>
                        <p class="txt_toggle_info">
                           Para acceder a algunos de los servicios será necesaria la suscripción o registro del USUARIO, el cual creará su propio nombre de usuario y una 
                           contraseña, los cuales le identificarán y habilitarán personalmente para poder tener acceso a los servicios. <br>

                           Las contraseñas son personales e intransferibles. El usuario se hace plenamente responsable de tratar de forma confidencial y custodiar adecuadamente 
                           sus contraseñas, evitando el acceso a las mismas de terceras personas no autorizadas expresamente por ZAABRA SALUD. El usuario acepta hacerse 
                           plenamente 
                           responsable de las consecuencias económicas y de cualquier otra naturaleza derivadas de cualquier utilización irresponsable de las contraseñas en el 
                           sitio web y/o de su utilización por terceros no autorizados. <br>
                        </p>

                        <h5 class="title_toggle_info">4.2 TRATAMIENTO DE DATOS PERSONALES</h5>
                        <p class="txt_toggle_info">
                           Para acceder a alguno de los servicios será preciso que el cliente se registre en <a href="{{url('/')}}" target="blank">www.zaabrasalud.co</a> 
                           a través de un formulario de recogida de datos en el que se proporcione a ZAABRA SALUD la información necesaria para la prestación del servicio; 
                           datos que en cualquier caso serán veraces, exactos y completos sobre se identidad y que el cliente deberá consentir expresamente mediante la 
                           aceptación de la Política de Privacidad de ZAABRA SALUD.
                        </p>

                        <h5 class="title_toggle_info">4.3 COMUNICACIÓN DE DATOS PERSONALES</h5>
                        <p class="txt_toggle_info">
                           Para los servicios online de reserva de citas, el profesional o centro en el que el usuario ha reservado una cita obtiene los datos de identificación 
                           y contacto necesarios para prestar el servicio. En este caso, el profesional o centro médico, al activar el servicio de reserva de cita online, 
                           está autorizando a ZAABRA SALUD a actuar como intermediario de las reservas que los usuarios de la web realicen en su agenda, por tanto, autoriza a 
                           recoger y conservar la información necesaria para el correcto desempeño del servicio. El usuario del servicio, que reserva con un profesional y/o 
                           centro médico a través del sitio web ZAABRA SALUD, autoriza asimismo a esta a que sus datos puedan ser comunicados al profesional o centro que ha 
                           dado permiso a ZAABRA SALUD para esa gestión. Por tanto, el usuario autoriza, como titular de los datos, a que estos puedan ser comunicados a 
                           terceros, siempre que esta comunicación responda a una necesidad para el desarrollo, cumplimiento, mantenimiento y ejecución de las obligaciones 
                           surgidas de esta relación de negocio. ZAABRA SALUD podrá suspender, retirar o cancelar parcial o totalmente los servicios en cualquier momento y 
                           sin necesidad de aviso previo. La previsión anterior no afectará a aquellos servicios que están reservados para usuarios registrados o que son 
                           objeto de contratación previa y que se regirán por sus condiciones específicas.
                        </p>

                        <h5 class="title_toggle_info">5. RESPONSABILIDAD Y EXONERACIÓN DE RESPONSABILIDAD</h5>
                        <p class="txt_toggle_info">
                            ZAABRA SALUD no se responsabilizará de las consecuencias de cualquier indole que puedan derivarse de la falta de veracidad, exactitud y completitud 
                            de los datos facilitados por los usuarios a través del sitio web o sobre la identidad de los mismos. <br> 

                            ZAABRA SALUD no se responsabiliza de los contenidos e información aportada, a través del sitio web, por los profesionales relacionados con la 
                            prestación de sus propios servicios ni de las condiciones específicas de estos. Del mismo modo, ZAABRA SALUD no es responsable de ninguna de las 
                            respuestas y/u opiniones vertidas por los profesionales, ni de las consultas, comentarios u opiniones realizadas por el usuario a través del sitio 
                            web. <br>

                            Cualquier prestación de servicios que se lleve a cabo por el profesional a los usuarios del sitio web, se realiza al margen de ZAABRA SALUD, por 
                            lo que esta no se responsabilizará de las consecuencias de cualquier índole que se deriven de la relación profesional/usuario que se hubiera 
                            establecido entre ambos. <br>

                            ZAABRA SALUD no será responsable de las actuaciones llevadas a cabo directamente por los proveedores de servicios ofertados a través de la web; 
                            todo usuario se compromete a mantener intacto a ZAABRA SALUD de cualquier reclamación derivada de incidencias surgidas por alguna de las causas 
                            descritas anteriormente. <br>

                            En caso de que con arreglo a lo establecido en las presentes condiciones generales y en la ley, ZAABRA SALUD deba indemnizar a un usuario, la 
                            indemnización a recibir por este no podrá sobrepasar en ningún caso el valor del servicio cuya contratación por el usuario haya originado el 
                            nacimiento del derecho indemnizatorio a favor de éste. <br>

                            ZAABRA SALUD indemnizará al usuario de que se trate únicamente en el caso de que los daños y perjuicios causados se deban a actuación negligente 
                            o dolosa de ZAABRA SALUD debidamente acreditada por el usuario reclamante. <br>

                            En ningún caso ZAABRA SALUD será responsable por daños morales, lucro cesante y/o de cualquier daño indirecto que pueda sufrir el usuario.
                        </p>

                        <h5 class="title_toggle_info">6. ATENCIÓN AL USUARIO</h5>
                        <p class="txt_toggle_info">
                            Para realizae cualquier consulta a ZAABRA SALUD relacionado con el funcionamiento del sitio web, información o disponibilidad de servicios, el 
                            cliente deberá dirigirse al Centro de Atención al Cliente, llamando al teléfono 3212449869 - 7123946 o enviando un correo electrónico a 
                            <a href="{{url('/contacto')}}" target="blank">servicioalcliente@zaabrasalud.co</a>
                        </p>

                        <h5 class="title_toggle_info">7. LEGISLACIÓN APLICABLE</h5>
                        <p class="txt_toggle_info">
                            Las condiciones presentes se regirán por la legislación colombiana vigente; en materia de comercio electrónico y ventas en línea, el idioma utilizado 
                            será el español.
                        </p>

                        <h5 class="title_toggle_info">8. HISTORIAS CLÍNICAS</h5>
                        <p class="txt_toggle_info">
                            Las Historias Clinicas dentro de nuestra plataforma, se regirá por la Resolución número 1995 de 1999, resolución 839 de 2017, ley 2015 del 31 de 
                            enero de 2021 emitidas por el Ministerio de Salud y Protección Social y reformas subsiguientes. 
                        </p>

                        <h5 class="title_toggle_info">8.1 PROCEDIMIENTO Y PARÁMETROS PARA LA IMPORTACIÓN DE HISTORIAS CLÍNICAS</h5>
                        <p class="txt_toggle_info">
                            Para importar los datos historia clínica donde se abarcarán los conceptos importantes y el paso a paso para establecer el proceso de migración a 
                            la plataforma de Clinik-app, a continuación, se establecerá que información es aceptada por la plataforma. <br>
                        </p>

                        <h5 class="title_toggle_info pl-3"> 8.1.1. Tipos de datos aceptados:</h5>
                        <ul class="text_li_toggle_info ml-3">
                            <li>Numérico <br> Este dato acepta números enteros y decimales, dentro de la importación los números enteros se escriben normalmente y los decimales 
                                con el símbolo (.).
                            </li>
                            <li>Texto <br> Este dato permite almacenar una cadena de caracteres, donde el máximo de caracteres es de 500 Mb, dentro de la importación debe estar 
                                encerrado entre comillas dobles ("").
                            </li>
                            <li>Lista <br> Este dato permite almacenar valores predefinidos, (valor1, valor2, ...) donde cada valor tiene un significado para le profesional, 
                                dentro de la importación debe estar separado por comas (,).
                            </li>
                            <li>Booleano <br> Este campo permite guardar un si o no (verdadero o falso), dentro de la importación debe tener valores cero o uno (0, 1).</li>
                            <li>Rango <br> Este dato se comporta igual que un número, la diferencia es que tiene un rango de valor para seleccionar, dentro de la importación 
                                es igual al número.
                            </li>
                        </ul>

                        <h5 class="title_toggle_info pl-3">8.1.2 Formato de archivos para la importación.</h5>

                        <h5 class="txt_toggle_info pl-5">8.1.2.1. Características de archivos</h5>
                        <ul class="text_li_toggle_info ml-5">
                            <li>Peso: 2mb (por archivo).</li>
                            <li>Formato csv.</li>
                            <li>Separación de los datos (;)</li>
                            <li>Si debe tener la cabecera de los datos (nombres de los campos).</li>
                            <li>El nombre debe ser igual al código de la categoria de una Historia Clínica.</li>
                        </ul>

                        <h5 class="txt_toggle_info pl-5">8.1.2.2. Arquitectura del archivo</h5>
                        <ul class="text_li_toggle_info ml-5">
                            <li>Cabecera: id_card (Número de identificativo del paciente); nombre campo 1; nombre campo 2; …</li>
                            <li>Cuerpo: Número de identificativo del paciente; valor 1; valor 2; …</li>
                        </ul>

                        <h5 class="title_toggle_info pl-3">8.1.3 Procedimiento de importación.</h5>
                        <h5 class="txt_toggle_info pl-5">8.1.3.1. Crear los pacientes en la plataforma</h5>
                        <p class="txt_toggle_info ml-5 pl-4">
                            Antes de poder migrar la información es necesario tener a los pacientes en el sistema para poder realizar la acción.
                        </p>

                        <h5 class="txt_toggle_info pl-5">8.1.3.2. Crear los Modelos de Historia Clínica</h5>
                        <p class="txt_toggle_info ml-5 pl-4">
                            Un modelo de historia clínica es el conjunto de toda la información sobre una especialidad, este también es personalizable según la necesidad del 
                            profesional.
                        </p>

                        <h5 class="txt_toggle_info pl-5">8.1.3.3. Crear las categorías de Historia Clínica</h5>
                        <p class="txt_toggle_info ml-5 pl-4">
                            Una Historia clínica por lo general tiene un conjunto de información muy amplio, la idea es agrupar esta información en subgrupos donde se denominan 
                            categorías, Nota: cada categoría es un archivo de importación.
                        </p>

                        <h5 class="txt_toggle_info pl-5">8.1.3.4. Crear el concepto de la información (variables) de una historia clínica</h5>
                        <p class="txt_toggle_info ml-5 pl-4">
                            Una historia clínica tiene toda clase de información la idea es crear el contenedor de esta información respetando los tipos de datos hablados 
                            anteriormente, esto se considera una variable de una historia clínica, el objetivo es establecer que información va a recolectar en una historia 
                            clínica personalizable.
                        </p>

                        <h5 class="txt_toggle_info pl-5">8.1.3.5. Descargar archivo de paso a paso de migración</h5>
                        <p class="txt_toggle_info ml-5 pl-4">
                            En la vista de importar información podrá descargar un manual donde le indica cómo crear cada archivo y su estructura para poder importarla en 
                            nuestro sistema.
                        </p>

                        <h5 class="txt_toggle_info pl-5">8.1.3.6. Subir archivos de importación</h5>
                        <p class="txt_toggle_info ml-5 pl-4">
                            Se debe subir cada archivo donde se debe seleccionar la categoría de la historia clínica y luego subir el archivo, automáticamente el sistema 
                            aplicará la configuración e importará todos los datos, en caso de algún error el sistema no subirá la información del archivo.
                        </p>

                        <h5 class="title_toggle_info">9. DOCUMENTOS REQUERIDOS PARA PRESENTAR SU PERFIL DE LA ASOCIACIÓN, INSTITUCIONAL Y/O PROFESIONAL EN NUESTRA PLATAFORMA</h5>
                        <p class="txt_toggle_info">
                            A continuación, relacionamos los documentos necesarios para la suscripción de su perfil y mostrarlo en la plataforma.
                        </p>

                        <h5 class="title_toggle_info">9.1 Persona Natural</h5>
                        <ul class="text_li_toggle_info">
                            <li>Documento de identidad por ambos lados.</li>
                            <li>Título o títulos de las universidades que lo acredita como profesional y/o especialistas en la salud.</li>
                            <li>Certificación de las instituciones donde ha estudiado (acta de grado y diplomas de especializaciones).</li>
                            <li>Tarjeta profesional por ambos lados.</li>
                            <li>Certificación del Concejo Nacional de Acreditación de su profesión.</li>
                            <li>Certificación ReTHUS</li>
                            <li>Certificación de las diferentes asociaciones a las que se acredita.</li>
                            <li>Dirección del consultorio donde presta sus servicios profesionales, número de teléfono fijo y celular.
                                <li class="ml-4">Si es propio, certificar propiedad.</li>
                                <li class="ml-4">Si es arrendatrio, anexar contrato.</li>
                            </li>
                            <li>Acreditación de habilitación emitida por Secretaria de Salud para el funcionamiento del sitio donde presta sus servicios profesionales 
                                (si aplica).
                            </li>          
                            <li>Registro secretaria de salud antes de la ley 1090 de 2006 (si aplica).</li>
                            <li>Si el título de pregrado es de una Universidad extranjera, deberá cargar la Resolución de convalidación de tu título ante el Ministerio de 
                                Educación Nacional.
                            </li>
                        </ul>

                        <h5 class="title_toggle_info">9.1 Persona Jurídica</h5>
                        <ul class="text_li_toggle_info">
                            <li>Certificado de camara y comercio.</li>
                            <li>Cédula de ciudadania del representante legal por ambas caras.</li>
                            <li>Rut actualizado expedido por la DIAN.</li>
                            <li>Título o títulos de las universidades que acreditan como profesionales y/o especialistas en la salud de los integrantes de la Asociación o 
                                institución.
                            </li>
                            <li>Certificación de las instituciones donde ha estudiado (acta de grado y diplomas de especializaciones), de cada uno de los profesionales.</li>
                            <li>Tarjeta profesional de cada uno de sus profesionales.</li>
                            <li>Certificación del Consejo Nacional de Acreditación de su profesión de los profesionales de su Asociación e institución.</li>
                            <li>Certificación ReTHUS.</li>
                            <li>Certificación de las diferentes asociciones a las que pertenecen sus asociados o integrantes de la Asociación o institución.</li>
                            <li>Dirección del consultorio donde presta sus servicios profesionales, número de teléfono fijo y celular.
                                <li class="ml-4">Si es propio, certificar propiedad.</li>
                                <li class="ml-4">Si es arrendatrio, anexar contrato.</li>
                            </li>
                            <li>Acreditación de habilitación emitida por Secretaria de Salud para el funcionamiento del sitio donde presta sus servicios profesionales 
                                (si aplica).
                            </li>
                            <li>Registro de secretaria de salud antes de la ley 1090 de 2006 (si aplica).</li>
                            <li>Si el título de pregrado es de una Universidad extranjera, deberá cargar la Resolución de convalidación de tu título ante el Ministerio de 
                                Educación Nacional.
                            </li>
                        </ul>

                        <p class="txt_toggle_info">
                            Todos los documentos anteriormente relacionados los debe enviar escaneados en formato pdf al correl electrónico 
                            <a href="{{url('/contacto')}}" target="blank">servicioalcliente@zaabrasalud.co</a>
                        </p>

                        <h5 class="title_toggle_info">10 PROCEDIMIENTOS Y PROCESO DE AGENDA- PROCEDIMIENTO</h5>
                        <h5 class="title_toggle_info">10.1 Paciente</h5>
                        <ul class="text_li_toggle_info">
                            <li>El paciente podrá identificar el botón "Agendar Cita". La ubicación del mismo puede variar según la página y punto del flujo de navegación. 
                                Algunas veces estará ubicado en el costado derecho de la foto del profesional, otras veces estará ubicado en la parte inferior.
                            </li>
                            <li>Para poder hacer agendamiento de citas es necesario que el paciente esté inscrito en nuestra plataforma.</li>
                            <li>Al hacer click en el botón "Agendar Cita", se abren tres posibilidades:
                                <li class="ml-4">La pantalla de "Inicio de Sesión" se abrira y el usuario podrá acceder a su perfil con su correo electrónico y contraseña, 
                                    si lo prefiere también puede ingresar con sus datos de Facebook o correo de Gmail.
                                </li>
                                <li class="ml-4">Si el paciente ingresa por primera vez, deberá registrarse por crear cuenta, seleccionar soy paciente, diligenciará los datos 
                                    solicitados, creará su contraseña, aceptará políticas de privacidad y terminos y condiciones. Posteriormente, hará clic en "Ingresar".
                                </li>
                                <li class="ml-4">Si el usuario ya se encuentra registrado, ingresará con su correo electrónico y su contraseña. En caso de olvido de la 
                                    contraseña, el usuario podrá recuperarla, haciendo clic en "Olvide mi contraseña". Allí recibirá un mensaje al correo registrado, en donde 
                                    encontrará los pasos para recuperarla.
                                </li>
                            </li>
                            <li>El usuario ingresará a su perfil donde podrá visualizar el calendario con los días y horas disponibles para el agendamiento de su cita. Al hacer 
                                clic en un día del calendario, se abrirá un cuadro de diálogo, en donde podrá elegir la especialidad, si desea cambiar de especialista o seguir 
                                con el especialista que había elegido, posteriormente elegirá el día y la hora deseada. <br>

                                Adicionalmente, en su perfil podrá encontrar otras funciones para gestionar sus exámenes, prescripciones, pagos y favoritos. También podrá 
                                calificar al profesional e instituciones y más. 
                            </li>
                            <li>Posteriormente, tendrá la posibilidad de realizar el pago para confirmar la cita o cancelar la misma. Si desea realizar el pago de su cita, el 
                                usuario hará clic en el botón “Hacer Pago” y será dirigido a la pasarela de pagos. Si por el contrario quiere hacer la cancelación, el usuario 
                                hará clic en el botón “Cancelar” o en la “x” ubicada al lado superior derecho de la ventana.  
                            </li>
                            <li>Tan pronto el sistema reciba el pago, entregará la confirmación de la cita y esta aparecerá en el módulo “Mis Citas”.</li>
                            <li>El día de la cita, el usuario deberá estar con 15 minutos de antelación, verificará con la persona encargada su agendamiento para posteriormente 
                                ser atendida.
                            </li>
                            <li>El usuario podrá postergar su cita con una antelación no mayor a 24 horas antes de la hora programada.</li>
                            <li>Si agendada y pagada la cita y por temas de fuerza mayor (Según el artículo 64 del Código Civil Colombiano, se denomina fuerza mayor o caso 
                                fortuito “el imprevisto o que no es posible resistir”. Esto, debe entenderse como la imposibilidad sobrevenida para cumplir una obligación por 
                                un hecho imprevisible, irresistible y externo con constancia por escrito) el usuario no puede asistir a la cita e informa, el profesional de 
                                la salud o institución deberá agendar nuevamente, si es reagendada nuevamente la cita por segunda vez y el paciente no asiste, será multado con 
                                un 20% del valor de la cita pagada y se reagendará por tercera vez; si no asiste esta tercera vez el profesional de la salud o institución no 
                                estará obligado a atenderlo y no se devolverá el valor inicialmente cancelado por el servicio solicitado. 
                            </li>
                            <li>Si el usuario, una vez agendada y pagada su cita, decide no tomarla y solicita la devolución de su dinero, se abren dos posibilidades:
                                <li class="ml-4">Si es por negligencia (no asistió por cualquier motivo sin justa causa) del usuario, el contrato se dará por terminado sin 
                                    devolución del dinero.
                                </li>
                                <li class="ml-4">Si es por cualquier otro motivo este será revisado conforme lo estipula la ley colombiana en el artículo 47 de la Ley 1480 de 
                                    2011 (plazo de ejercicio del derecho de retracto).
                                </li>
                            </li>
                            <li>Después de recibido el servicio, el usuario ingresará a nuestra página buscará el profesional de la salud que lo atendió y calificará su 
                                servicio, podrá dejar comentarios de acuerdo con la experiencia vivida.
                            </li>
                        </ul>

                        <h5 class="title_toggle_info">10.2. Especialista o profesional de la salud</h5>
                        <p class="txt_toggle_info">
                            El profesional de la salud ingresará con sus credenciales a su landing page, creadas inicialmente a la hora de regidtrarse dentro de nuestra 
                            plataforma.
                        </p>
                        <ul class="text_li_toggle_info">
                            <li>En su perfil encontrará al lado izquierdo un menú con sus Citas, Calendario, Pagos efectuados por sus pacientes, Historia clínica de sus 
                                pacientes, Diagnósticos de sus pacientes, procedimientos realizados, etc. Al lado derecho de la pantalla encontrará los accesos rápidos a 
                                las funciones más importantes con íconos.
                            </li>
                            <li>Haciendo clic en cualquiera de las tarjetas podrá consultar la información que desea.</li>
                            <li>En “Mi calendario” podrá configurar los días y horas que estará disponible para que los pacientes agenden, viendo las citas que tiene 
                                programadas con su respectivo día y hora, las cuales podrá verificar datos del paciente, tipo de cita. En este campo podrá reprogramar o 
                                cancelar la cita si fuera necesario, si la desea cancelar el sistema solicita si está seguro que la desea cancelar, le debe dar “Confirmar” 
                                y la cita quedará cancelada.
                            </li>     
                            <li>El profesional de la salud indicará en dicha agenda qué mes, día y hora está ocupado y se activarán los meses, días y horas disponibles para 
                                que sus pacientes agenden sus respectivas citas en dichos espacios.
                            </li>
                            <li>El profesional de la salud podrá cancelar hasta el 10% de las citas agendadas por los pacientes en ZAABRA SALUD, por casos fortuitos presentados. 
                                Si supera este porcentaje deberá pagar una sanción monetaria del 25% sobre los ingresos totales obtenidos en el mes, a través de nuestra 
                                plataforma.
                            </li>
                            <li>En el caso de que el profesional de la salud cancela una cita, lo deberá realizar con 24 horas de anterioridad y estará obligado a reprogramar 
                                y enviará un comunicado por escrito informando al usuario y a ZAABRA SALUD del cambio de la cita aclarando los motivos. 
                            </li>
                            <li>Si el profesional de la salud no le presta el servicio a un usuario con cita previamente programada y pagada, se le generará una sanción 
                                monetaria del 25% sobre el valor total obtenido de las consultas en el mes generadas por ZAABRA SALUD y tendrá comentarios negativos de la 
                                prestación del servicio en su landing page.
                            </li>
                            <li>El profesional de la salud estará en la obligación de reagendar hasta tres veces la cita con su paciente; una primera vez con justa causa, una 
                                segunda vez con sanción y si no asiste una tercera vez, ya no estará en la obligación de atenderlo.
                            </li>
                            <li>El dinero recaudado por medio de las citas de paciente al profesional de la salud, ZAABRA SALUD le reembolsará ese dinero al profesional de la 
                                salud de acuerdo a:
                                <li class="ml-4">El paciente haya confirmado su atención por el servicio pagado y la calificación del servicio.</li>
                                <li class="ml-4">Si los pagos de las citas con los especialistas de la salud ocurren dentro de los primeros ocho (8) días del mes, 
                                    ZAABRA SALUD les reembolsarán el pago a los profesionales el siguiente día viernes hábil del mes y así sucesivamente. 
                                </li>
                            </li>
                        </ul>

                        <h5 class="title_toggle_info">10.3. Instituciones</h5>
                        <ul class="text_li_toggle_info">
                            <li>Para el ingreso y el uso de nuestro aplicativo es necesario la creación de su perfil donde creara un usuario y una contraseña.</li>
                            <li>La institución podrá ingresar a su perfil en ZAABRA SALUD, donde podrá contar con el servicio de agenda, además de otros servicios que 
                                puede consultar, cambiar y anexar.
                            </li>
                            <li>En “Mi calendario”, el usuario podrá ver las citas que tienen sus médicos en sus distintos meses, días y horas. Se podrá identificar a cada 
                                profesional de acuerdo a los colores seleccionados por cada uno de ellos.
                            </li>
                            <li>Las instituciones podrán ver las consultas que sus médicos tienen asignadas, con tipo de cita, día, mes, hora y tipo de especialista. 
                                Donde podrán editar la cita o cancelarla.
                            </li>
                            <li>La institución tendrá la posibilidad de agendar una nueva cita, cambiar una cita y cancelarla si lo desea.</li>
                            <li>La institución podrá cancelar hasta el 10% de las citas agendadas por los pacientes en ZAABRA SALUD, por casos fortuitos presentados. 
                                Si supera este porcentaje deberá pagar una sanción monetaria del 25% sobre los ingresos totales obtenidos en el mes, a través de la plataforma. 
                            </li>
                            <li>En el caso de que la institución cancele una cita programada y pagada, lo deberá hacer con 24 horas de anterioridad y estará obligado a 
                                reprogramar y enviar un comunicado por escrito informando al usuario y a ZAABRA SALUD del cambio de la cita aclarando los motivos. 
                            </li>
                            <li>Si la institución no le presta el servicio a su usuario con cita previamente programada y pagada, se le generará una sanción monetaria del 
                                25% sobre el valor total obtenido de las consultas en el mes generadas a través de ZAABRA SALUD y tendrá comentarios negativos de la prestación 
                                del servicio en su perfil. 
                            </li>
                            <li>El dinero recaudado por medio de las citas de paciente, ZAABRA SALUD le reembolsará ese dinero al profesional de la salud de acuerdo a:
                                <li class="ml-4">El paciente haya confirmado su atención por el servicio pagado y la calificación del servicio.</li>
                                <li class="ml-4">Si los pagos de las citas con los especialistas de la salud ocurren dentro de los primeros ocho (8) días del mes, ZAABRA SALUD 
                                    les reembolsarán el pago a los profesionales el siguiente día viernes hábil del mes y así sucesivamente.  
                                </li>
                            </li>
                            <li>Adicionalmente en su perfil de agenda, podrá consultar las citas de su institución, donde podrá ver, editar y cancelarla.</li>
                            <li>Consultar pagos realizados a sus médicos con las especificaciones de sus citas y descargarlos. </li>
                            <li>Consultar las historias clínicas, modificarlas y crearlas.  </li>
                            <li>La institución podrá agregar prescripciones y fórmulas médicas, agregar medicamentos.</li>
                            <li>En “Favoritos”, la institución podrá colocar en especialidades, servicios, especialistas e instituciones y reciba información relacionada con 
                                sus intereses.
                            </li>
                        </ul>

                        <p class="txt_toggle_info">
                            El dinero recaudó por el pago de una consulta médica particular de un paciente atreves de nuestra plataforma ZAABRA SALUD será transferido a la 
                            cuenta que el médico asocie. El tiempo para el traslado será el siguiente: <br>

                            El día de la semana abono. Después de que el paciente nos confirme la tensión en la consulta La ley 503 del 2020
                        </p>

                        <h5 class="title_toggle_info">11. PROCESOS DE AGENDAMIENTO</h5>
                        <h5 class="title_toggle_info">11.1. Paciente</h5>
                        <p class="txt_toggle_info">
                            El paciente al ingresar en ZAABRA SALUD, en la parte del profesional de su preferencia, puede hacer clic en “Agende su cita”. Allí se abrirá una 
                            nueva ventana para cada particular, así:
                        </p>

                        <ul class="text_li_toggle_info">
                            <li>Si es por primera vez, deberá crear su perfil haciendo clic en la opción “Soy paciente”. Se desplegará una tarjeta donde debe diligenciar la 
                                información solicitada, crear su contraseña, aceptar políticas de privacidad, términos y condiciones y elegir “Deseo recibir comunicaciones 
                                promocionales”. Al correo inscrito previamente le llegará la confirmación de su inscripción, donde deberá confirmar su inscripción. 
                                Posteriormente podrá ingresar. 
                            </li>
                            <li>Si el paciente ya está inscrito, ingresará con su correo y su contraseña. Si olvidó su contraseña podrá recuperarla haciendo clic en
                                “Olvidé mi contraseña”, donde colocará el correo previamente escrito y hará clic en “Enviar”. Verificará en su correo y podrá crear una nueva 
                                contraseña para ingresar. También podrá ingresar con el correo de Facebook o Gmail.
                            </li>
                        </ul>

                        <p class="txt_toggle_info">
                            Habiendo realizado el proceso correctamente, se abrirá su perfil como paciente, donde puede administrar su calendario y visualizará las fechas 
                            disponibles para agendar citas con la especialidad y especialista seleccionado anteriormente. Haciendo clic sobre el día seleccionado se desplegará 
                            una ventana, le solicitará diligenciar nuevamente la especialidad, el especialista, fecha y hora de la cita. Seguido hará clic en “Agendar” y 
                            posteriormente deberá pagar en el momento en el que sea redirigido a la pasarela de pago. Si desea cancelar la cita, debe hacer clic en la “x” y 
                            la cita no quedará agendada. <br>

                            Adicionalmente estando en su perfil puede consultar sus examenes, prescripciones o fórmulas emitidas, sus pagos realizados y en "Mis favoritos" 
                            puede seleccionar las especialidades, servicios, especialistas e instituciones de su preferencia.
                        </p>

                        <h5 class="title_toggle_info">11.2. Especialistas o profesional de la salud</h5>
                        <p class="txt_toggle_info">
                            El especialista o profesional de la salud deberá ingresar a su perfil a través del botón “Soy doctor” con su usuario y contraseña de ZAABRA SALUD. 
                            Si es por primera vez deberá inscribirse haciendo clic en “Crear cuenta” y seleccionando “doctor y/o doctora”. Cuando haga clic en él, se desplegará 
                            la ventana donde diligenciará la información requerida junto con un correo electrónico y creará su contraseña. Aceptará políticas de privacidad, 
                            términos y condiciones, hará clic en “Me gustaría recibir comunicaciones promocionales”, posteriormente clicará en “Ingresar”. El sistema le 
                            enviará un mensaje a su correo donde deberá confirmar para posteriormente poder ingresar a su perfil. <br>
                            
                            Si el especialista o profesional de la salud ya está inscrito, colocará su correo electrónico y su contraseña para poder ingresar. Si olvidó su 
                            contraseña, podrá recuperarla haciendo clic en “Olvide mi contraseña”. Allí deberá escribir su correo electrónico ya inscrito. A su correo se 
                            enviarán las instrucciones de cómo recuperar la contraseña. <br>
                            
                            Ya habiendo realizado el proceso correctamente, el sistema le abrirá su administrador de perfil. Allí podrá ver “Mi calendario”, “Mis citas”, 
                            “Mis pagos”, “Historia clínica”, “Prescripciones médicas o fórmulas” y sus “Favoritos”. <br>

                            Haciendo clic en “Mi calendario”, se desplegará una ventana con la información de agendamiento, donde se visualizará los días y horas que se 
                            encuentran programados. Haciendo clic sobre cada cita fijada, se podrá confirmar qué tipo de cita es, la fecha, nombre del paciente y la 
                            especialidad. El especialista o profesional de la salud podrá editar la cita para reprogramarla, dado que el paciente la postergue por no asistir 
                            en la fecha solicitada inicialmente o cancelarla si así lo requiere. Si se va a cancelar la cita, debe hacer clic en “Cancelar”, se desplegará una 
                            ventana donde le informa si está seguro de cancelarla. Al hacer clic en “Sí, cancelar cita”, la cita quedará cancelada. 
                            Si por error se ha hecho clic en “Cancelar” pues se escoge la opción “No cancelar”. El sistema confirmará la decisión tomada y se cerrarán las 
                            ventanas, dejando al usuario nuevamente en la página del calendario. <br>
                            
                            En la página principal de su perfil, el especialista o profesional de la salud puede hacer clic en “Mis pagos” y se abrirá la información de todos 
                            los pagos que ha recibido por concepto de citas generadas por ZAABRA SALUD, y podrá descargar cada soporte de pago. <br>

                            El especialista o profesional de la salud podrá subir el historial clínico, prescripciones médicas y/o fórmulas, diagnósticos, procedimientos 
                            realizados y demás documentos que considere pertinente para que sean consultados por el paciente. <br>

                            En “Mis favoritos” podrá subir información relacionada con sus intereses de especialidades, servicios, especialistas e instituciones. 
                        </p>

                        <h5 class="title_toggle_info">11.3. Instituciones</h5>
                        <p class="txt_toggle_info">
                            Estando situados en la página de ZAABRA SALUD, en el costado derecho se encuentra el botón “Agendar cita” Al hacer clic, se desplegará una ventana 
                            donde le indicará que acceda a nuestro portal de ZAABRA SALUD o registrarse, según cada caso. <br>

                            Si la institución ya está inscrita, iniciará sesión con su correo electrónico y la contraseña. Si no recuerda la contraseña, la podrá recuperar 
                            haciendo clic en “Olvidé mi contraseña”; le solicitará que escriba el correo previamente inscrito, en donde recibirá un mensaje de recuperación 
                            de contraseña. <br>

                            Si la institución no está registrada, deberá ingresar por “Crear cuenta” y seguido seleccionará “Institución”. Se desplegará una ventana donde le 
                            solicitará sus datos personales con correo electrónico y creará su contraseña para el ingreso.  Confirmará políticas de privacidad, términos y 
                            condiciones, seleccionará “Me gustaría recibir comunicaciones promocionales”, y le hará clic en “Ingresar”. El sistema enviará al correo inscrito 
                            la confirmación de la solicitud donde le confirmará la inscripción y así ingresar a ZAABRA SALUD. <br>

                            Si el proceso quedó bien realizado ya podrá ingresar a su perfil de Institución donde podrá evidenciar su plataforma. El modulo "Mi calendario" 
                            le permitira administrar las citas programadas que tienen sus especialistas, agendar nuevas citas, consultar las citas existentes, modificarlas 
                            y/o cancelarlas según su necesidad. Si desea crear una nueva cita, lo puede hacer, haciendo clic sobre los días disponibles; se desplegará una 
                            ventana donde le solicitará que le confirme que tipo de cita es, especialidad, especialista, día y hora. Diligenciando dicha información la cita 
                            quedará inscrita. <br>

                            También podrá consultar en "Mis citas", "Mis pagos", "Historia clínica" de sus pacientes, las fórmulas o prescripciones médicas generadas por sus 
                            especialistas, las cuales las pueden consultar, modificar, cancelar, descargar y crear según la necesidad de la institución.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card card_acordion"> <!-- Términos y condiciones del Servicio -->
                <div id="headingThree">
                    <button class="button_acordion" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Términos y condiciones del Servicio
                    </button>
                </div>

                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body toggle_info">
                        <h5 class="title_toggle_info mt-0">TÉRMINOS Y CONDICIONES GENERALES DEL SERVICIO</h5>

                        <h5 class="title_toggle_info">1. CONCEPTOS GENERALES</h5>
                        <p class="txt_toggle_info">
                            En el presente contrato serán de aplicación las definiciones que se detallan más abajo. Así mismo, las palabras en singular incluirán el plural y 
                            viceversa.
                        </p>

                        <ul class="text_li_toggle_info">
                            <li>“Partes”: La Compañía y el Usuario de forma conjunta.</li>
                            <li>“Contrato”: El presente contrato de servicios incluyendo, las condiciones generales, las condiciones particulares y todas sus cláusulas y/o 
                                anexos.
                            </li>
                            <li>“Profesional o instituciones”: Persona física o jurídica, según el caso, que suscribe este contrato con ZAABRA SALUD para beneficiarse del 
                                servicio de membresía.
                            </li>
                            <li>“ZAABRA SALUD” o “compañía”: Zaabra Colombia sas, carrera 64 #67B – 89 interior dos, Bogotá DC, con NIT 901294385-1.</li>
                            <li>“Usuario”: Persona física que tiene una cuenta o accede al sitio web <a href="{{url('/')}}" target="blank">https://www.zaabrasalud.co</a></li>
                            <li>“Sitio Web”: Herramienta en línea disponible en la siguiente dirección <a href="{{url('/')}}" target="blank">https://www.zaabrasalud.co</a> 
                                y operada por ZAABRA COLOMBIA SAS que permite, entre otros, que los profesionales puedan ofrecer sus servicios.
                            </li>
                            <li>“Profesional”: Profesional cuya actividad consiste en la prestación de servicios específicos en el área de la salud, en el supuesto en el que 
                                el usuario sea una persona física, el profesional y el usuario serán la misma persona y, por consiguiente, las actividades anteriores serán 
                                prestadas directamente por el usuario.
                            </li>
                            <li>“Cuenta”: Entrada en la base de datos del sitio web que confiere la condición de usuario con acceso a los servicios premium, una vez introducido 
                                el usuario y la contraseña correspondiente.
                            </li>
                            <li>“Perfil”: Información del profesional publicado en una landing page del Sitio web identificada con una dirección URL perteneciente a la 
                                compañía.
                            </li>
                            <li>“Membresía”: Servicio ofrecido por ZAABRA SALUD al usuario a través de un sistema, que permite, entre otros, agregar contenido a cada uno de 
                                los perfiles y utilizar el calendario.
                            </li>
                            <li>“Calendario”: Programa informático titularidad de la compañía, que permite al usuario entre otras funcionalidades, gestionar su cita o 
                                asesoramiento con el profesional y revisar la disponibilidad.
                            </li>
                            <li>“Período de Facturación”: Cada año se renovará el servicio, en función del periodo inicial y tipo de suscripción, que se iniciarán a partir de 
                                que se genera el pago total, es responsabilidad del profesional el tiempo que se demore ingresando la información que se va a cargar en la 
                                página.
                            </li>
                        </ul>

                        <h5 class="title_toggle_info">2. MEMBRESÍA</h5>
                        <p class="txt_toggle_info">
                            2.1 Servicios ofrecidos por parte de ZAABRA SALUD al usuario, otorgando acceso a las siguientes funcionalidades y/o herramientas a través de su 
                                cuenta, las cuales se adaptarán a las características de los perfiles asignados:<br>
                            a. Beneficiarse de los servicios ofrecidos por ZAABRA SALUD a través del calendario de la plataforma.<br>
                            b. Incluir los perfiles entre los resultados de búsqueda de profesionales registrados en el sitio web o plataforma. <br>
                            c. Recibir estadísticas asociadas a cada uno de los perfiles.<br>

                            Las herramientas y/o servicios anteriores únicamente estarán disponibles para los perfiles que hayan sido previamente revisados y aprobados.<br>

                            2.2 Tipos de perfiles disponibles dentro del servicio Premium:<br>
                            a. Perfil Premium: contamos con tres perfiles premium dependiendo de su perfil, sea un perfil profesional, perfil docente, perfil tecnólogo o 
                                perfil estudiante. El sitio web le da la posibilidad de mejorar su posicionamiento a través de la suscripción o pago de membresía en este 
                                servicio que le ofrece configurar su ficha de una forma más completa, sin publicidad de terceros y mostrarse de forma más destacada en los 
                                listados y en fichas de otros profesionales. Con esta opción, el profesional puede ofrecer su horario para que los usuarios puedan reservar su 
                                servicio a través de la plataforma en el calendario.<br>
                            b. Perfil inicial: Este perfil es un perfil promocional que incluye solo información básica incluida foto del profesional. Siempre estará disponible 
                                la membresía en el momento que el profesional desee modificar el plan, siempre y cuando cumpla con los requisitos mínimos, estos serán 
                                contratados sin necesidad de modificar el presente acuerdo, mediante notificación escrita, por email o cualquier otra vía telemática.<br>

                            2.3 La membresía es proporcionada por ZAABRA SALUD teniendo en cuenta los Perfiles que han sido verificados en la forma y condiciones que determine 
                                ZAABRA SALUD a su entera discreción. La prestación del Servicio por parte de ZAABRA SALUD al usuario se iniciará en el momento del pago total 
                                de esta.<br>

                            2.4 A los efectos de poder prestar de forma adecuada el servicio y dar cumplimiento al presente contrato y a la legislación aplicable, el usuario 
                                deberá proporcionar a la compañía toda aquella información que ésta última requiera.<br>

                            2.5 ZAABRA SALUD se reserva el derecho de decidir, en cada momento, los productos y/o servicios que se ofrecen. De este modo, ZAABRA SALUD podrá, 
                                en cualquier momento, añadir nuevos productos y/o servicios a los ofertados actualmente. Así mismo ZAABRA SALUD se reserva el derecho a retirar 
                                o dejar de ofrecer, en cualquier momento, y sin previo aviso, cualquiera de los servicios ofrecidos.
                        </p>

                        <h5 class="title_toggle_info">3. ASIGNACIÓN DE PERFIL</h5>
                        <p class="txt_toggle_info">
                            3.1 Una vez suscrito el presente contrato, el profesional recibirá vía correo electrónico la confirmación del pago y procederá a responder el 
                                formulario con todos los datos que ZAABRA SALUD solicita, estos serán verificados por el equipo profesional en los siguientes 5 días para su 
                                respectiva publicación. Cada profesional tendrá su perfil individual.<br>

                            3.2 Sin perjuicio de lo dispuesto en el apartado anterior, mediante la aceptación y la firma del presente contrato, el profesional acepta, consiente 
                                y autoriza de forma expresa a ZAABRA SALUD a la publicación de dicha información.<br>

                            3.3 El profesional autoriza y permite a ZAABRA SALUD modificar el contenido, materiales y documentos facilitados por parte del profesional a los 
                                efectos de preparar el perfil o landing page, en este sentido, cualquier modificación realizada se limitará a actuaciones encaminadas a mejorar 
                                la calidad de la publicación y validar la veracidad de la misma (eliminar errores, mejorar la calidad de las imágenes, confirmar la veracidad 
                                de la especialidad del profesional, entre otros).
                        </p>

                        <h5 class="title_toggle_info">4. CONTRAPRESTACIÓN</h5>
                        <p class="txt_toggle_info">
                            4.1. ZAABRA SALUD tendrá derecho a percibir la retribución acordado en las condiciones particulares al inicio de cada uno de los periodos de 
                                facturación en función de la membresía que se adquiera, sin perjuicio de lo anterior, las partes podrán acordar posteriormente a la firma del 
                                presente acuerdo la modificación de la retribución que se detalla en las condiciones particulares, el profesional pagará su membresía a través 
                                de la plataforma, y dentro de esta misma plataforma el usuario agendará y de inmediato podrá dirigirse al pago de la consulta con el profesional; 
                                de acuerdo con el decreto 410 de 1971 (código de comercio),  cuando el usuario esté completamente satisfecho con el servicio ZAABRA SALUD 
                                procede a hacer la entrega del dinero al profesional, descontando los gastos operativos ocasionados con la pasarela de pagos openpay 
                                (cargo fijo por transacción, porcentaje openpay por transacción, transacciones y transferencia, 4 x 1000 y demás impuestos).
                        </p>

                        <h5 class="title_toggle_info">5. DEVENGO, FACTURACIÓN Y FORMA DE PAGO</h5>
                        <p class="txt_toggle_info">
                            5.1 La contraprestación devengada a favor de ZAABRA SALUD deberá ser abonada en su totalidad por el profesional, o institución al inicio de cada 
                            periodo de la membresía. Dicho pago se podrá realizar por medio de la plataforma (pasarela de pagos openpay), tarjeta débito o crédito, pagos pse 
                            y transferencias bancarias, este pago debe estar cancelado en su totalidad para poder disfrutar de los beneficios ofrecidos.<br>

                            5.2 Las facturas correspondientes serán emitidas por pago total de membresía por parte de ZAABRA SALUD en los siguientes 3 días hábiles o hasta 
                                la verificación del dinero en nuestra cuenta bancaria; el profesional o institución autoriza expresamente a ZAABRA SALUD a emitir la factura 
                                y remitirla al correspondiente correo autorizado.<br>

                            5.3 Para emitir dichas facturas será necesario que nos suministren rut y cámara de comercio con una vigencia no mayor a 30 días de la entidad a la 
                                cual se va a facturar al correo proporcionado <a href="mailto:servicioalcliente@zaabrasalud.co" target="blank">finanzas@zaabra.com.co</a> <br>

                            5.4 Facturas emitidas por agendamiento y pago de consulta al profesional; estás facturas serán emitidas por cada uno de los profesionales que 
                                ofrecen el servicio a través de la plataforma de ZAABRA SALUD.<br>

                            5.5 El cliente podrá solicitar la devolución (reembolso) de los montos pagados a ZAABRA SALUD en caso de presentarse errores de cobro, por ejemplo, 
                                pagos dobles o montos diferentes a los pactados.
                        </p>

                        <h5 class="title_toggle_info">6. AGENDAMIENTO DE CITAS</h5>
                        <p class="txt_toggle_info">
                            6.1 Tras la activación de La membresía, ZAABRA SALUD confiere únicamente al profesional, excluyendo expresamente a cualquiera de las empresas y 
                                entidades que puedan formar parte su mismo grupo de sociedades, el uso de una landing page dentro de la plataforma de servicios profesionales 
                                por un tiempo específico y determinado. <br>

                            6.2 El permiso entregado a cada profesional le da el derecho al profesional para ingresar a su perfil y definir qué días y horas específicas podrá 
                                ofrecer su servicio a través de nuestra plataforma de ZAABRA SALUD, de esta manera el usuario pueda agendar un espacio con el profesional 
                                requerido, inmediatamente el usuario genere el agendamiento de la cita, deberá hacer el pago para así asegurar su servicio.<br>

                            6.3 El permiso y usuario otorgado a cada profesional por parte de ZAABRA SALUD se confiere por el plazo del pago de membresía que genere.<br>

                            6.4 Este calendario permite al usuario y al profesional realizar las siguientes tareas:
                        </p>

                        <ul class="text_li_toggle_info">
                            <li>Entregar a ZAABRA SALUD la disponibilidad de tiempo para consultas o servicio, tiempo en días y horas, para que le usuario pueda acceder y 
                                realizar el respectivo agendamiento de cita.
                            </li>
                            <li>Confirmar los espacios que sean pagados por el usuario y de esta menara generar las notificaciones correspondientes antes de la consulta.</li>
                            <li>Podrá acceder a este desde cualquier dispositivo, sea computador, celular o tablet.</li>
                            <li>El profesional que realiza el pago de la membresía es responsable por el cumplimiento de las citas agendadas y pagadas a través de la plataforma 
                                ZAABRA SALUD.
                            </li>
                        </ul>

                        <p class="txt_toggle_info">
                            6.5 ZAABRA SALUD se reserva el derecho a bloquear el acceso al calendario de agendamiento de citas, en el supuesto en el que se realice un uso 
                                indebido o inadecuado del mismo, o no se cumpla con el usuario final lo pactado, de conformidad con las previsiones del presente contrato, a 
                                estos efectos se entenderá como “uso inadecuado” a los siguiente: que este sea manejado por otras personas no autorizadas o no registradas 
                                anteriormente, no podrá enviar correos no deseados o spam, reproducir o intentar reproducir el software sin autorización, perjudicar los 
                                intereses de ZAABRA SALUD, no dar cumplimiento a las obligaciones previstas en el presente contrato (incluyendo las condiciones generales) o 
                                las condiciones legales previstas en la plataforma ZAABRA SALUD, cancelar de forma reiterada las solicitudes de los usuarios finales, utilizar 
                                la plataforma para fines distintos a los previstos en el presente contrato o en el presente documento de términos y condiciones del servicio.<br>

                            6.6 Para estos efectos, en el supuesto en el que ZAABRA SALUD entienda que se ha incumplido alguna de las obligaciones anteriores, notificará al 
                                profesional, paciente o institución a la dirección de correo electrónico indicando que se ha procedido a la cancelación de los servicios que 
                                se encuentran expuestos dentro de la plataforma, en ningún caso la cancelación de este servicio afectará la remuneración que ZAABRA SALUD 
                                percibe.<br>

                            6.7 Las partes acuerdan que queda excluida de forma expresa del presente servicio cualquier derecho sobre el software o código fuente del mismo.<br>
                            6.8 Así mismo, el profesional, paciente o institución mantendrá a ZAABRA SALUD plenamente a salvo respecto de la totalidad de daños, 
                                responsabilidades, demandas, obligaciones, juicios, sentencias y gastos de todo tipo en los cuales pueda incurrir como consecuencia de 
                                reclamaciones de terceros en relación al uso por parte del cliente, o de su personal.
                        </p>

                        <h5 class="title_toggle_info">7. DURACIÓN Y TERMINACIÓN</h5>
                        <p class="txt_toggle_info">
                            7.1 El contrato entrará en vigor en el momento del pago total de la membresía o suscripción, salvo acuerdo explícito en contra en las condiciones 
                                particulares del presente acuerdo, el período inicial del contrato será por el plazo de 12 meses; estos días comienzan a contar desde la fecha 
                                de pago total de la membresía, esta deberá ser renovada con el pago total de cada periodo según el escogido 8 días hábiles antes de la fecha 
                                de vencimiento, de no recibir el pago 8 días hábiles antes de terminar el periodo, el sistema inmediatamente cumplido el tiempo ocultará el 
                                perfil del profesional o institución. La persona o entidad que se rija bajo el contrato no podrá resolver o terminar este contrato, excepto por 
                                causas previstas en la ley o lo dispuesto en las condiciones expuestas en este documento, en el caso de que el cliente decida dar de baja y/o 
                                dejar de utilizar los servicios prestados a través de ZAABRA SALUD antes del tiempo de finalización de la membresía, ZAABRA SALUD no hace 
                                devolución parcial ni total del dinero por el servicio. El pago de la membresía será por adelantado en un 100%. <br>

                            7.2 Sin perjuicio de lo anterior y sujeto a la cláusula 7.4, el presente contrato podrá ser resuelto como consecuencia de cualquiera de las 
                                siguientes causas: 
                                a. Por mutuo acuerdo entre las partes; 
                                b. Tras la finalización del período de la membresía pagada, a solicitud de cualquiera de las partes con un plazo mínimo de preaviso de treinta 
                                    (30) días a la fecha del inicio del siguiente período de facturación; y/o 
                                c. Por parte de la ZAABRA SALUD en caso de incumplimiento del profesional o institución. 
                                    ZAABRA SALUD podrá cancelar el servicio y lo pactada con el profesional o institución en los siguientes casos: 
                                a) Si el profesional no presta un servicio adecuado de acuerdo a la calificación otorgada por el usuario. 
                                b) Por generar un mal procedimiento en el usuario final. 
                                c) No entregar información a ZAABRA SALUD o que ZAABRA SALUD no pueda verificar que la información suministrada sea real.<br>

                            7.3 Sin perjuicio de lo anterior, cada perfil acordado en las condiciones generales tendrá una permanencia de 12 meses según la membresía adquirida, 
                                a efectos aclaratorios, en caso de cancelación por parte del profesional o institución de conformidad con los dispuesto en el numeral 7.2, el 
                                acuerdo permanecerá en todo caso en vigencia con el perfil adquirido y este genera una renovación automática finalizado el periodo pactado en 
                                el primer pago.<br>

                            7.4 La anulación o terminación del acuerdo, conllevará la automática cancelación del perfil en la plataforma ZAABRA SALUD, así mismo, dejarán de 
                                ser exigibles por parte de la compañía las obligaciones de pago de los servicios objeto del presente acuerdo, salvo aquellas que ya se hubiera 
                                devengado a favor de la compañía, no obstante lo anterior, las obligaciones de las partes continuarán siendo exigibles en lo que respecta a 
                                aquellos perfiles sujetos a periodos de permanencia; sin perjuicio de lo anterior, en caso de cancelación del acuerdo por parte de ZAABRA SALUD 
                                por incumplimiento del profesional o institución, no serán de aplicación los periodos de permanencia adquiridos y ZAABRA SALUD tendrá derecho a 
                                percibir la indemnización que se prevé en la cláusula 9.3 siguiente o cualquier otra del presente acuerdo, así como las cantidades devengadas y 
                                no pagadas por el cliente.<br>

                            7.5 Las partes acuerdan que el profesional, o institución no ostentará ningún derecho como consecuencia de la licencia y/o de cualquier herramienta 
                                asociada al software o prestación de los servicios aquí descritos, así como tampoco ningún derecho de compensación como consecuencia de la 
                                cancelación o terminación anticipada de este acuerdo.<br>

                            7.6 La cancelación del presente contrato no perjudicará en modo alguno el derecho de la parte afectada por tal incumplimiento a reclamar la 
                                correspondiente indemnización por los daños y perjuicios causados, respetando en todo caso, los términos previstos en el presente acuerdo. 
                        </p>

                        <h5 class="title_toggle_info">8. DERECHOS Y OBLIGACIONES DE ZAABRA SALUD</h5>
                        <p class="txt_toggle_info">
                            8.1 En el marco de la prestación del servicio adquirido como membresía, ZAABRASALUD se compromete a: 
                            a) Ofrecer servicios de membresía en los términos previstos en las condiciones generales y, en su caso en las condiciones generales del servicio. 
                            b) Proporcionar al profesional o institución las herramientas necesarias para asignar el perfil e información para publicar en el sitio. 
                            c) Proporcionar las herramientas y características necesarias para que el profesional, o institución pueda gestionar y administrar la información 
                                dentro de su perfil, incluyendo disponibilidad en agendamientos de citas, agendamiento de citas como tal. 
                            d) Proporcionar asistencia en la edición del perfil o landing page durante toda la duración de la membresía, asistencia que se dará en los horarios 
                                estipulados, lunes a viernes de 8 am a 5 pm por medio de nuestros canales virtuales, teléfono 3212449869 o al correo electrónico 
                                <a href="{{url('/contacto')}}" target="blank">servicioalcliente@zaabrasalud.co</a>
                        </p>

                        <h5 class="title_toggle_info">9. OBLIGACIONES DEL PROFESIONAL O INSTITUCIÓN</h5>
                        <p class="txt_toggle_info">
                            9.1 El profesional o institución declara, garantiza y se obliga frente a ZAABRA SALUD a dar cumplimiento a toda y cada una de las previsiones del 
                                presente acuerdo, incluyendo términos y condiciones generales y términos y condiciones generales del servicio, con la debida diligencia y en 
                                atención a la naturaleza de su actividad profesional y en especial se compromete a: 
                            a) Mantener en todo momento actualizada la información de cada perfil. 
                            b) Abonar en tiempo y forma los pagos que estén a favor de ZAABRA SALUD. 
                            c) Estar en contacto permanente con ZAABRA SALUD para que esta última pueda realizar la adecuada prestación del servicio y en particular aceptar 
                                los términos y condiciones requeridos por ZAABRA SALUD. 
                            d) ZAABRA SALUD proporciona a cada perfil o landing page el software de agendamiento de consulta, este software es propiedad de ZAABRA SALUD, será 
                                administrado por este mismo. 
                            e) Abstenerse de utilizar de forma ilícita la plataforma de ZAABRA SALUD y herramientas que componen la misma, incluyendo, pero no limitándose a 
                                ello, el envío de notificaciones o mensajes a usuarios a través de la plataforma sin respetar la normativa de protección de datos de carácter 
                                personal o cualquier otra que sea de aplicación. 
                            f) Incluir en cada formulario del perfil información clara, completa y veraz, así como de la información de cada una de las citas y lugares en las 
                                que se admitirán los usuarios, el profesional o institución se compromete a añadir de forma puntual la disponibilidad de tiempo real y lo 
                                deberá mantener actualizado. g) No sugerir o inducir al usuario de abstenerse de utilizar la plataforma de ZAABRA SALUD para acceder al servicio. 
                            h) Entregar todos aquellos materiales o contenidos que sean necesarios a la entera discreción de ZAABRA SALUD a los efectos de crear y compartir 
                                información en el perfil o landing page, esta información deberá ser facilitada por parte del usuario a través de un formulario creado en 
                                ZAABRA SALUD.<br>

                            9.2 ZAABRA SALUD se reserva el derecho de realizar todas aquellas averiguaciones o actuaciones que sean necesarias a los efectos de determinar si 
                                están cumpliendo todas y cada una de las obligaciones anteriores, incluyendo la realización de encuestas a los usuarios.<br>

                            9.3 En el supuesto en el que el profesional o institución incumpla cualquiera de las obligaciones previstas en la cláusula 9.1, ZAABRA SALUD se 
                                reserva el derecho de cancelar el presente contrato de forma unilateral mediante notificación a la otra parte, así como solicitar al cliente 
                                el abono por los daños causados y perjuicio derivados de dicho incumplimiento. Dichos daños y perjuicios incluirán en todo caso el importe de 
                                la contraprestación que se hubiese devengado a favor de ZAABRA SALUD durante el periodo de la membresía, así como cualquier otro daño generado 
                                a ZAABRA SALUD por dicho incumplimiento.
                        </p>

                        <h5 class="title_toggle_info">10 MANIFESTACIONES Y GARANTÍAS AL USUARIO</h5>
                        <p class="txt_toggle_info">
                            10.1 El usuario manifiesta y garantiza a ZAABRA SALUD que: 
                            a) Tanto el usuario como representante legal del mismo tienen capacidad legal suficiente a los efectos de suscribir o aceptar el acuerdo y dar 
                                cumplimiento a la totalidad de las disposiciones del contrato, incluyendo las condiciones generales y condiciones del servicio y cualquier otra 
                                prevista en el mismo. 
                            b) Realizar actividades relacionadas con la asistencia a centro médico o consultorio particular, el profesional deberá asegurar que tiene todas las 
                                autorizaciones, licencias y/o permisos, registros exigidos por la legislación aplicable para realizar estas actividades. 
                            c) Toda la información, materiales, documentos, contenidos, así como cualquier otro incluido en cualquiera de los perfiles o landing page será veraz 
                                y legal y no incumplirá ninguna disposición legal o derechos de terceros. 
                            d) Ha obtenido el consentimiento previo y por escrito o vía email necesario sobre todos los materiales, documentos, trabajos o contenidos facilitados 
                                a ZAABRA SALUD en el marco de la presente relación contractual, incluyendo la facultad de publicación, distribución y difusión, entre otros, y, 
                                por consiguiente, que no infringe ningún derecho de propiedad intelectual y/o industrial de terceros. En particular, manifiesta que a través de 
                                dicha divulgación y publicación en el sitio web de ZAABRA SALUD no se infringe ningún derecho frente a terceros, en particular derechos de 
                                propiedad intelectual o industrial. En este mismo sentido, el usuario autoriza expresamente a ZAABRA SALUD para usar, compilar, adaptar, alterar, 
                                incorporar contenido sobre los trabajos y materiales proporcionados; ha obtenido todas aquellos permisos y autorizaciones necesarias sobre todas 
                                las imágenes y datos del profesional que sean publicadas en el sitio web de ZAABRA SALUD por parte del usuario, incluyendo el derecho a 
                                distribuir y difundir las mismas a través de Internet, así como que cuenta con todas las autorizaciones necesarias en materia de protección de 
                                datos de carácter personal sobre las imágenes y datos del profesional, así como del resto imágenes incluidas en la galería de cada landing page, 
                                La autorización concedida a ZAABRA SALUD para la utilización de la imagen y los datos del profesional seguirá en vigencia tras la terminación o 
                                cancelación de la relación contractual. 
                            e) Ha obtenido todas aquellos permisos y autorizaciones necesarias sobre todas las marcas, logotipos, emblemas o cualquier otro sujeto a derechos de 
                                propiedad intelectual y/o industrial que sean facilitados a ZAABRA SALUD o publicadas en el sitio web de ZAABRA SALUD por parte del usuario o 
                                a petición de este, incluyendo el derecho a distribuir, difundir y utilizar por parte de ZAABRA SALUD o cualquiera de las entidades de su grupo 
                                de sociedades, para utilizar las mismas en todo el territorio mundial. La autorización concedida a ZAABRA SALUD para la utilización de la imagen 
                                y los datos del profesional seguirá en vigencia tras la terminación o resolución del presente contrato. 
                            f) Dará cumplimiento a las disposiciones previstas en las cláusulas de las presentes condiciones generales, sobre todos los documentos, textos, 
                                materiales, logotipos, marcas registradas, datos personales o cualquier otro facilitado a ZAABRA SALUD o subido a el sitio web de ZAABRA SALUD 
                                o incluido en el perfil o landing page.<br>

                            10.2 En este sentido, el usuario se obliga a responder frente a ZAABRA SALUD y a indemnizar por los daños y perjuicios que se puedan generar a 
                                ZAABRA SALUD, por la falta de veracidad o inexactitud de las manifestaciones y garantías previstas en la presente cláusula, incluyendo, pero 
                                sin limitarse a ello, la posible responsabilidad civil, administrativa o de cualquier otro tipo, así como abonar a ZAABRA SALUD los gastos 
                                legales, administrativos, judiciales, de abogados y procuradores.
                        </p>
                        
                        <h5 class="title_toggle_info">11. CAMBIOS DE LOS PROCEDIMIENTOS</h5>
                        <p class="txt_toggle_info">
                            11.1 Las Partes acuerdan que cualquier modificación implementada por ZAABRA SALUD en relación a los procesos de verificación, modificaciones en el 
                                sitio web de ZAABRA SALUD o en el ámbito de actividad u otras modificaciones a los efectos de adaptarse a la legislación aplicable no implicará 
                                una modificación del presente contrato y no dará lugar a la cancelación del mismo en los términos previstos en las condiciones generales. 
                                Se entenderá que el usuario acepta dicha modificación o actualización en el supuesto en el que el usuario siga haciendo uso del sitio web de 
                                ZAABRA SALUD, tras la entrada en vigencia de la actualización o modificación del sitio web de ZAABRA SALUD, en ningún caso, se requerirá la 
                                autorización expresa o la formalización de un acuerdo por separado entre las partes.
                        </p>

                        <h5 class="title_toggle_info">12. SITIO WEB</h5>
                        <p class="txt_toggle_info">
                            12.1 El sitio web ZAABRA SALUD se ofrecen tal como han sido desarrollados y en la forma en la que estén disponibles en cada momento, a tal efecto, 
                                ZAABRA SALUD no garantiza al usuario o a cualquier otra persona o entidad, de forma expresa o implícita, que los mismos se adaptarán a cualquier 
                                finalidad o uso concreto, ni será completo, útil ni adecuado para la actividad del cliente o de cualquiera de los usuarios, incluyendo, de forma
                                enunciativa pero no limitativa, garantía de comerciabilidad, patentabilidad y/o adecuación a un determinado propósito, ni de existencia de 
                                defectos o errores, ni en relación a su capacidad de integrarse en un sistema determinado, o de no infracción de ninguna patente u otros derechos 
                                de propiedad intelectual y/o industrial de terceros.<br>

                            12.2 Así mismo, ZAABRA SALUD se reserva el derecho a llevar a cabo todas aquellas actuaciones que sean necesaria para mantener en funcionamiento los 
                                sistemas, los cuales pueden provocar impedimentos o imposibilidad temporal de utilizar los servicios de membresía por parte del profesional, 
                                institución y los usuarios. A tal efecto, ZAABRA SALUD realizará sus mayores esfuerzos para que dichas actuaciones de mantenimiento por la noche 
                                o en días no laborables.
                        </p>

                        <h5 class="title_toggle_info">13. EXENCIÓN DE RESPONSABILIDAD</h5>
                        <p class="txt_toggle_info">
                            13.1 ZAABRA SALUD no será responsable por las pérdidas, daños directos, indirectos, emergentes, por el lucro cesante sufrido por el profesional, 
                                institución  o los usuarios, o cualquier otro daño o coste incidental, especial o que sea consecuencia de una reclamación –incluidos los costes 
                                judiciales y de abogado o procurador, la responsabilidad civil o por producto o negligencia- fundada en una conducta o actividad desarrollada por 
                                ZAABRA SALUD o cualquier otro con motivo del uso del sitio web, o cualquier otro software o aplicación facilitada por ZAABRA SALUD en el marco 
                                de los servicios prestados, por cualquier motivo  (incluyendo, pero no limitado a las pérdidas derivadas del fallo o defectuoso funcionamiento de 
                                aplicaciones web, aplicaciones móviles, software, la pérdida total o parcial o el daño producido a los contenidos o a otra información, la 
                                detención o suspensión total o parcial de la de la plataforma web, plataforma móvil, software, la detención de las citas concertadas con 
                                profesionales, la pérdida de tiempo de funcionamiento o de ingresos, beneficios, operaciones con usuarios o cualquier otro motivo), salvo que se 
                                derive de una actuación dolosa por parte de ZAABRA SALUD y, en todo caso y en cualquier supuesto, limitada a la responsabilidad prevista en la 
                                cláusula 13.8 de las condiciones generales.<br>

                            13.2 Así mismo, el profesional o institución acepta y reconoce que ZAABRA SALUD no garantiza la identidad de los usuarios ni será responsable bajo 
                                ningún concepto frente al cliente o a terceros por cualquier fraude relacionado con la identidad de los usuarios o los profesionales.<br>

                            13.3 ZAABRA SAULD no se responsabiliza de los contenidos e información facilitada por el profesional, instituciones o usuarios a través del sitio 
                                web de ZAABRA SALUD, por los profesionales y/o centros médicos relacionados con la prestación de sus propios servicios ni de las condiciones de 
                                los mismos. En este sentido, ZAABRA SALUD no se hace responsable de las respuestas, consultas, comentarios y/u opiniones emitidas por los 
                                profesionales, instituciones o realizadas por usuario y otros a través del sitio web de ZAABRA SALUD, puesto que en ningún caso la actividad 
                                de ZAABRA SALUD podrá ser considerada como teleconsulta, consulta o similar y las opiniones o diferentes consultas no son realizadas por 
                                ZAABRA SALUD.<br>

                            13.4 La compañía no supervisa, monitoriza ni confirma las licencias, más allá de que pueda validar a su libre discreción y sin obligación al 
                                respecto los números de tarjeta profesional, la especialidad del profesional, o calificaciones de los profesionales y, en ningún caso, será 
                                responsable de la actividad realizada por parte de los profesionales o instituciones. En caso de que ZAABRA SALUD adquiera información 
                                suficiente que conduzca a suponer que el profesional carece de título acreditativo suficiente para entenderse como tal, ZAABRA SALUD podrá 
                                cancelar y/o bloquear su cuenta, perfil o landing page inmediatamente.<br>

                            13.5 La compañía no supervisa, monitoriza ni controla los mensajes o notificaciones enviadas por los profesionales, instituciones a sus clientes o 
                                usuarios a través de la plataforma, vía sms, email u otros medios. A tal efecto, el profesional, o institución se obliga a responder frente a 
                                ZAABRA SALUD y a indemnizar por los daños y perjuicios que se puedan generar a ZAABRA SALUD como consecuencia de las notificaciones o 
                                comunicaciones remitidas, incluyendo, pero no limitándose a ello, la posible responsabilidad civil, administrativa o de cualquier otro tipo, 
                                así como a abonar a ZAABRA SALUD por los gastos legales, administrativos, judiciales, de abogados y procuradores.<br>

                            13.6 Sin perjuicio de lo anterior y dejando constancia expresa de que ZAABRA SALUD no será responsable de la cualificación o licencias de los 
                                profesionales e instituciones, en el supuesto en el que ZAABRA SALUD adquiera información que pueda llegar a asumirse que el profesional no 
                                cuenta con la licencia o acreditación necesaria para la prestación de servicios, se pondrá en contacto con el profesional a los efectos de 
                                intentar recabar más información al respecto.<br>

                            13.7 ZAABRA SALUD no será responsable de los daños y perjuicios derivados del mal funcionamiento de la cuenta, de los fallos y errores en el servidor 
                                como consecuencia de cualquier fallo relacionado con el software o por cualquier incompatibilidad con el sitio web de ZAABRA SALUD. 
                                ZAABRA SALUD tampoco será responsable por ningún daño relacionado con la falta de conexión a Internet o el mal funcionamiento del sitio web, 
                                así como de aquellos excluidos de forma expresa en el presente contrato.<br>

                            13.8 En el supuesto en el que ZAABRA SALUD fuera responsable de cualquier daño sufrido al usuario, los profesionales como consecuencia de un 
                                incumplimiento del presente contrato, el importe máximo de la responsabilidad asumida por ZAABRA SALUD no podrá ser superior al importe 
                                percibido en el marco de la prestación de los servicios de membresía.<br>

                            13.9 Las previsiones dispuestas en la presente cláusula seguirán en vigencia tras la finalización de la relación contractual entre el cliente y 
                                ZAABRA SALUD.<br>

                            13.10 En relación con los servicios de salud que son prestados por terceros. Usted reconoce que ZAABRA SALUD solo facilita un espacio de acercamiento 
                                para que un profesional o institución se contacte con el usuario final y puedan establecer un acuerdo comercial mutuo para la prestación de 
                                servicios, por lo que las negociaciones que surjan entre estos usuarios solo tendrán efecto entre los mismos, y no afectarán ni derivarán en 
                                responsabilidad alguna por parte de ZAABRA SALUD. Cualquier prestación de servicios que se lleve a cabo por el profesional o institución a 
                                usuarios, se realiza al margen del sitio web, por lo que ZAABRA SALUD no es responsable de ninguna de las respuestas y/u opiniones entregadas; 
                                ZAABRA SALUD intervendrá en el agendamiento de la consulta (determinación de lugar, fecha y hora del servicio), de acuerdo con las condiciones 
                                previstas por el en él sitio web.<br>

                                Los usuarios y profesional inscritos en el sitio web ZAABRA SALUD entienden y aceptan que ZAABRA SALUD no hace parte de algún acuerdo que se 
                                llegase a negociar o firmar entre ellos; usted reconoce y acepta que ZAABRA SALUD no tiene algún control, ni la obligación de controlar la 
                                conducta o acciones de los usuarios dentro o fuera del sitio web, ya sea por opiniones, anuncios o publicaciones, por lo que en la medida máxima 
                                permitida por la ley, no asume alguna responsabilidad por la conducta, acciones, opiniones, anuncios o publicaciones de los usuarios;  no 
                                obstante, ZAABRA SALUD se reserva la facultad de investigar las conductas que sean contrarias a los términos y condiciones generales y términos 
                                y condiciones generales del servicio, y a tomar las acciones necesarias, incluyendo pero sin limitar, la restricción de acceso o la suspensión 
                                o eliminación de la cuenta del usuario.  <br>

                                Cada usuario es el único responsable de todas sus comunicaciones, publicaciones, anuncios e interacciones con el portal y con otros usuarios de 
                                la misma.<br>

                                ZAABRA SALUD no garantiza la veracidad, exactitud, exhaustividad y/o actualidad de la información de los usuarios que publiquen o comuniquen en 
                                el sitio web, ni el cumplimiento de cualquier acuerdo entre los usuarios. En relación con este tipo de publicaciones, ZAABRA SALUD actuará como 
                                un medio de comunicación. ZAABRA SALUD no asume la obligación de vigilar y/o verificar la información publicada por los usuarios o contenida en 
                                la publicidad, sin perjuicio de los criterios y condiciones establecidas en los términos y condiciones del servicio, y en especial, la facultad 
                                de ZAABRA SALUD de cancelar los registros de aquellos profesionales o instituciones que incumplan los términos y condiciones generales y 
                                términos y condiciones del servicio.<br>

                                En consecuencia, usted declara mantener indemne y exonerar de toda responsabilidad a ZAABRA SALUD de cualquier incumplimiento, engaño, estafa, 
                                infracción o perjuicio causado por otro usuario o por un tercero que tenga publicidad en el portal.<br>

                                En la medida máxima permitida por la ley, usted declara exonerar de toda responsabilidad y mantener indemne a ZAABRA SALUD por los daños y 
                                perjuicios, pasados, presentes y futuros, que llegaren a ocasionarse como consecuencia del uso de la información publicada por los usuarios y 
                                terceros en el portal.
                        </p>

                        <h5 class="title_toggle_info">14. DERECHOS DE PROPIEDAD INTELECTUAL Y/O INDUSTRIAL DE LA COMPAÑÍA Y DE LA INFORMACIÓN PUBLICADA POR EL PROFESIONAL, 
                            INSTITUCIÓN Y/O USUARIO
                        </h5>
                        <p class="txt_toggle_info">
                            14.1 Todos los derechos de propiedad industrial y/o intelectual sobre el sitio web ZAABRA SALUD, la aplicación móvil, el software de agendamiento de 
                                cita, las marcas de ZAABRA SALUD, las aplicaciones facilitadas por parte de ZAABRA SALUD en el marco de la prestación de los servicios de 
                                membresía, los software de todo ello, así como de cualquier ampliación, mejora o modificación de todo ello y de los trabajos, materiales o 
                                elementos creados por parte de ZAABRA SALUD en el marco de la prestación de los servicios previstos en el presente contrato o el cumplimiento 
                                de las obligaciones que se derivan del mismo, son de propiedad exclusiva de la compañía, por lo que el usuario o profesional o institución 
                                deberá abstenerse de utilizar o registrar a su nombre cualquier patente, marca u otros signos distintivos de la que ZAABRA SALUD sea titular y 
                                no podrá modificar, reproducir, distribuir ni comunicar públicamente o poner a disposición de terceros cualquiera de ellos, salvo en los 
                                supuestos expresamente previstos en el presente contrato y lo autorice de forma expresa la compañía.<br>

                            14.2 Asimismo, el cliente se obliga a informar a ZAABRA SALUD, de manera rápida y eficaz, de cualquier infracción o fundado temor de infracción por 
                                parte de clientes, usuarios o de terceros de los derechos de propiedad intelectual y/o industrial anteriores o de desarrollos del mismo que 
                                pudiera afectar a los legítimos intereses de la compañía, según corresponda.<br>

                            14.3 En ningún caso, la creación de la cuenta, perfil, publicación de materiales, documentación y/o imágenes de cualquier tipo por parte del cliente 
                                le confieren derechos sobre las publicaciones en el sitio web de ZAABRA SALUD, propiedad de la compañía.<br>

                            14.4 De igual manera, al publicar en el sitio web de ZAABRA SALUD o facilitar a ZAABRA SALUD por cualquier medio, facilite a ZAABRA SALUD materiales, 
                                documentos, trabajos, imágenes, datos de profesionales o contenidos, así como marcas comercial, logotipos, emblemas o cualquier otro sujeto a 
                                derechos de propiedad intelectual y/o industrial, se entenderá que el cliente confiere a ZAABRA SALUD una licencia de uso sobre todo ello con el 
                                carácter de no exclusiva, intransmisible, para todo el territorio mundial y por el tiempo máximo que permite la ley, pudiendo ZAABRA SALUD 
                                utilizar, publicar realizar, entre otros, copias analógicas y digitales, almacenamiento, marketing, alquiler, arrendamiento, difusión, 
                                publicación, visualización, transmisión, reemisión, reproducción, inclusión en bases de datos, uso de contenido y materiales a los efectos de 
                                promover las actividades o cualquier otro aspecto de la compañía.<br>

                            14.5 Las disposiciones previstas en el apartado anterior se confieren a ZAABRA SALUD por el tiempo máximo que permite la ley, por lo que 
                                permanecerán en vigencia tras la finalización del presente contrato.
                        </p>

                        <h5 class="title_toggle_info">15. CONFIDENCIALIDAD</h5>
                        <p class="txt_toggle_info">
                            15.1 Las partes reconocen que durante la relación profesional entre ellas tendrán acceso a información relativa al presente contrato, acuerdos 
                                previos, documentación, correos electrónicos otro tipo de mensajes intercambiados entre las partes, que tendrán la consideración de 
                                confidenciales y que deberán ser tratados con secreto para garantizar el buen fin de las relaciones entre las partes. A tal efecto, las partes 
                                se comprometen a mantener estricta confidencialidad sobre la información de este tipo, no pudiendo reproducirla, utilizarla, venderla, 
                                licenciarla, exponerla, publicarla o revelarla de cualquier forma a cualquier otra persona, sin autorización expresa de la otra parte, así como 
                                abstenerse de utilizar dicha información para cualquier finalidad distinta a las previstas en el presente contrato.<br>

                            15.2 Las obligaciones de confidencialidad establecidas en la presente cláusula no serán de aplicación a la información que: 
                                a) Se difunda a empleados, colaboradores, asesores o cualquier otro profesional a los efectos de dar cumplimiento a la relación contractual, 
                                    siempre y cuando sean informados del carácter confidencial de esta información y asuman el compromiso de tratar la información como 
                                    confidencial. 
                                b) Sea de dominio público o devenga de dominio público por un medio distinto a la violación de las obligaciones previstas en el contrato. 
                                c) Haya llegado al conocimiento de cualquiera de las partes con anterioridad a la firma o aceptación del contrato o las condiciones generales 
                                    o condiciones particulares y no haya sido adquirida, directa o indirectamente, a través de cualquiera de las partes o a través de un tercero 
                                    que se encuentre a su vez bajo la obligación de mantener la confidencialidad de la información confidencial. 
                                d) Aquella otra que deba revelarse en cumplimiento de una orden de naturaleza legal, judicial o administrativa. En este caso, la parte que la 
                                    deba divulgar lo notificará a la otra parte con la mayor antelación posible a fin de que esta pueda tomar las acciones que estime 
                                    oportunas.<br>

                            15.3 El incumplimiento de las obligaciones de confidencialidad previstas en la presente cláusula dará lugar a la parte perjudicada a reclamar los 
                                daños y perjuicios que se le hubiera generado. Asimismo, la transmisión o comunicación a cualquier competidor directo o indirecto de 
                                ZAABRA SALUD de cualquier tipo de información de la que disponga el cliente en relación a ZAABRA SALUD como consecuencia de las relaciones 
                                comerciales existentes entre las partes, dará lugar a las penalizaciones incluidas en el presente contrato.<br>

                            15.4 Sin perjuicio de las condiciones establecidas en la presente cláusula, ZAABRA SALUD podrá intercambiar o compartir cualquier información 
                                relativa al profesional o institución a los efectos de operar o gestionar el sitio web y los servicios prestados en virtud del presente 
                                contrato, con cualquier entidad perteneciente a su grupo de sociedades, así como con otras compañías que lleven a cabo negocios o actividades 
                                vinculadas a ZAABRA SALUD. El cliente acepta expresamente este intercambio o cesión de información por parte de ZAABRA SALUD.<br>

                            15.5 Las obligaciones de confidencialidad entrarán en vigencia desde la fecha de suscripción o aceptación de las condiciones generales, o desde la 
                                fecha de entrega de información de carácter confidencial, lo que suceda antes, y seguirán siendo de aplicación mientras la información conserve 
                                su naturaleza secreta y confidencial.<br>

                            15.6 Asimismo, ZAABRA SALUD manifiesta al cliente que, habida cuenta de su valor y aplicación industrial y/o comercial, parte de la información que 
                                se le pueda facilitar como consecuencia de la ejecución de la relación profesional y la prestación de los servicios de membresía estará protegida 
                                bajo la modalidad de secreto industrial y/o empresarial y, en consecuencia, su divulgación podría perjudicar notablemente a ZAABRA SALUD, por lo 
                                que resulta esencial salvaguardar dicho conocimiento. Por consiguiente, la utilización de la misma para y las condiciones generales del servicio 
                                puede generar una gran daño y perjuicio a ZAABRA SALUD, incluso, ser considerada competencia desleal.
                        </p>

                        <h5 class="title_toggle_info">16. PROTECCIÓN DE LOS DATOS DE CARÁCTER PERSONAL</h5>
                        <p class="txt_toggle_info">
                            16.1 Las partes se obligan a tratar los datos de carácter personal a los que tengan acceso o que sean objeto de tratamiento durante la prestación de 
                                los servicios derivados de la ejecución del presente contrato en cumplimiento de la normativa aplicable en materia de privacidad y protección 
                                de datos personales incluyendo, entre otras, la ley 1581 de 2012 de protección de datos personales.<br>

                            16.2 La ejecución de este contrato requerirá el acceso y el tratamiento de datos personales de usuarios y profesionales por parte de ZAABRA SALUD, 
                                en nombre y por cuenta de este. El cliente garantiza que, como responsable de los datos, cumplirá con las obligaciones de información de los 
                                interesados y que dispone de las bases jurídicas y/o consentimientos necesarios para que ZAABRA SALUD preste los servicios que se deriven del 
                                presente contrato. A estos efectos, ZAABRA SALUD tendrá la consideración de encargado del tratamiento y el profesional, tecnólogo, docente o 
                                estudiante será el responsable del tratamiento de datos. Consecuentemente, las partes reconocen la ejecución en la fecha del presente contrato 
                                de un contrato separado para el nombramiento de ZAABRA SALUD como encargado del tratamiento de datos personales.<br>

                            16.3 A los efectos de lo indicado anteriormente, el profesional o institución autoriza a ZAABRA SALUD al acceso, tratamiento y recolección de dichos 
                                datos personales en su nombre, con el fin de dar acceso a los usuarios a leer dicha información.<br>

                            16.4 Adicionalmente, a lo anterior, el profesional o institución se obliga a recabar los consentimientos necesarios para la cesión de los datos 
                                personales de los profesionales a ZAABRA SLUD con el fin de que pueda tratar sus datos en calidad de responsable del tratamiento. Está cesión 
                                se realizará con la finalidad de mantener, tratar y actualizar los datos de los profesionales en la plataforma de ZAABRA SALUD.<br>

                                Por tanto, en dicho caso una vez termine la relación contractual con el profesional o institución, ZAABRA SALUD podrá continuar tratando los 
                                datos personales de los profesionales en calidad de responsable del tratamiento en cumplimiento a la ley 1581 de 2012.<br>

                            16.5 Sin perjuicio de lo anterior, profesional o institución cumplirá con todas las obligaciones de información previstas en relación con los 
                                profesionales o institución que presenten sus servicios al usuario final, en el momento de obtener su consentimiento para la cesión de sus 
                                datos a ZAABRA SALUD. Para tales fines, ZAABRA SALUD facilitará toda la información necesaria al usuario.<br>

                            16.6 El cliente exime de responsabilidad a ZAABRA SALUD sobre el tratamiento de datos personales realizado por usuarios y profesionales en el 
                                contexto del cumplimiento de este contrato por parte de ZAABRA SALUD.<br>

                            16.7 En cumplimiento de la ley 1581 del 2012 las partes informan que los datos personales de las partes, que constan en el encabezamiento de este 
                                contrato, serán tratados sobre la base jurídica de la ejecución de este contrato, el cumplimiento de las obligaciones legales aplicables a las 
                                partes, así como los intereses legítimos de las partes en esta relación comercial. En consecuencia, las partes aportan la siguiente información:

                                a) Los datos personales de las partes firmantes del contrato serán tratados por las mismas, en calidad de responsables del tratamiento para la 
                                    ejecución de este contrato, con la identificación e información de contacto establecida en el encabezamiento. 
                                b) La recolección y tratamiento de datos personales se basará en la ejecución del contrato, para los fines de la prestación de los servicios 
                                    descritos en el mismo, el cumplimiento de las obligaciones legales de las partes, y los intereses legítimos derivados de la continuidad de 
                                    la relación comercial. 
                                c) Los datos personales de las partes serán conservados durante el tiempo necesario para cumplir con las finalidades indicadas en el apartado 
                                    anterior, aplicando las medidas de seguridad técnicas y organizativas necesarias para garantizar un nivel de seguridad adecuado al riesgo. 
                                d) Los datos personales de las partes no serán cedidos a terceros excepto, en caso de contar con el consentimiento expreso de las partes o para 
                                    el cumplimiento de las obligaciones legales exigibles. 
                                e) Las partes tienen derecho a ejercer sus derechos de acceso, rectificación o supresión o limitación, o a oponerse al tratamiento, así como el 
                                    derecho a la portabilidad de los datos, dirigiéndose a la dirección indicada en el encabezamiento del contrato. También tienen derecho a 
                                    dirigirse o presentar una reclamación ante la autoridad de control.<br>

                            16.8 El cliente se compromete a suscribir los contratos de encargo de tratamiento y/o cualquier otro documento o consentimientos que sean necesarios 
                                o requeridos por la normativa aplicable en materia de protección de datos personales, con los usuarios o los profesionales que participen en los 
                                servicios derivados de este contrato.<br>

                            16.9 Como parte de los servicios ofrecidos, y a menos que el cliente haya denegado expresamente su consentimiento, ZAABRA SALUD tratará los datos 
                                personales del cliente y de los profesionales para incluirlos en la plataforma de posicionamiento empresarial google my business, con la 
                                finalidad de impulsar la presencia y el perfil o landing page en google. 
                        </p>

                        <h5 class="title_toggle_info">17. RESOLUCIÓN DE SOLICITUDES Y RECLAMACIONES</h5>
                        <p class="txt_toggle_info">
                            17.1 Para cualquier solicitud o reclamación que pueda surgir en el marco de la prestación de los servicios, el profesional, la institución o el 
                                mismo usuario se deberá dirigir a la cuenta de correo electrónico del asesor que ZAABRA SALUD asigne a su cuenta, o en su defecto, a 
                                <a href="{{url('/contacto')}}" target="blank">servicioalcliente@zaabrasalud.co</a> o al teléfono 3212449869.<br>

                            17.2 Las reclamaciones se deberán remitir dentro del plazo máximo de catorce (14) días a contar desde la fecha del evento que dio lugar a la 
                                reclamación. La comunicación de la reclamación deberá contener el motivo de la reclamación y los motivos que la fundamentan. En el supuesto en 
                                el que la reclamación o la queja tenga contenido ofensivo o inapropiado a criterio de ZAABRA SALUD o no se realice con la diligencia debida, 
                                esta no será atendida por ZAABRA SALUD.
                        </p>

                        <h5 class="title_toggle_info">18. GESTIÓN DIARIA DEL CONTRATO</h5>
                        <p class="txt_toggle_info">
                            18.1 El profesional o institución deberá notificar a ZAABRA SALUD a la mayor brevedad posible de cualquier cambio de los datos de contacto del 
                                responsable, mediante comunicación por escrito dirigida a la dirección de correo electrónico prevista en el encabezamiento del presente contrato.
                        </p>

                        <h5 class="title_toggle_info">19. MISCELÁNEA</h5>
                        <p class="txt_toggle_info">
                            <b>19.1 Cesión:</b> El cliente no podrá ceder los derechos y obligaciones en el marco de la relación contractual con ZAABRA SALUD o subrogar su 
                                posición contractual, sin el consentimiento previo y por escrito de ZAABRA SALUD. Sin perjuicio de lo anterior, el cliente acuerda y autoriza de 
                                forma expresa que ZAABRA SALUD podrá ceder todos los derechos y obligaciones que se deriven de la relación profesional con ZAABRA SALUD, 
                                incluyendo, el contrato y las condiciones particulares y condiciones generales, entre otros, sin necesidad de obtener el consentimiento del 
                                cliente. Dicha cesión, exigirá por parte de la adquirente la aceptación previa de los pactos aquí contenidos de forma expresa.<br>

                            <b>19.2 Modificación:</b> No podrá ser modificado ninguno de los extremos de las condiciones particulares o las condiciones generales, o el resto de 
                                términos del contrato, salvo que dicha modificación se realice por escrito y sea firmada por ambas partes. A pesar de lo anterior, en el caso de 
                                que una modificación sea necesaria para adecuarse a cualquiera legislación, regulación o práctica comúnmente aceptada de la jurisdicción 
                                aplicable, o para alinear este contrato con el tipo de servicios proporcionados al cliente durante la vigencia de este contrato y / o con las 
                                modalidades en que se brindan estos servicios, ZAABRA SALUD se reserva el derecho de modificar los términos contractuales, unilateralmente, 
                                mediante notificación escrita (por cualquier medio, incluido, entre otros, por correo electrónico a la cuenta de correo electrónico que se 
                                detalla las condiciones particulares o cualquier otra facilitada a la compañía a tal efecto), con una antelación de al menos treinta (30) días. 
                                Queda entendido que: 
                                    (a) si el cliente decide dejar de recibir los servicios después de dicha modificación, tendrá que resolver este contrato mediante 
                                    notificación por escrito a ZAABRA SALUD, que tendrá que ser recibida por parte de ZAABRA SALUD antes del vencimiento del período de treinta 
                                    (30) días, y (b) ZAABRA SALUD  no podrá modificar de forma unilateral ninguno de los términos relativos a la contraprestación o a las tarifas 
                                    o al periodo de permanencia, o que perjudiquen el derecho del cliente de acceder al servicio de membresía. Renuncia: Si alguna de las partes 
                                    no ejecutara cualquiera de las disposiciones del presente contrato, dicho incumplimiento no será considerado como una renuncia a dichas 
                                    disposiciones, ni a ninguna otra prevista en el contrato, ni una renuncia al derecho de dicha parte a ejecutar tales disposiciones 
                                    posteriormente.<br>

                            <b>19.3 Separabilidad:</b> En el caso de que cualquier parte, artículo, párrafo, oración o cláusula de este contrato se considerase vaga, inválida 
                                o inaplicable, dicha parte será eliminada y el resto del contrato continuará siendo válido y estando en vigor.<br>

                            <b>19.4 Independencia de las Partes:</b> Las partes reconocen que el presente contrato no crea ningún tipo de relación laboral, societaria, de 
                                agencia o franquicia, de hecho o de derecho, entre las partes, no pudiendo ninguna de ellas actuar o presentarse ante terceros como si tal 
                                fuera el caso.<br>

                            <b>19.5 Acuerdo íntegro:</b> El contrato, con las condiciones generales, las condiciones particulares del servicio y todas sus partes y anexos, 
                                forman un único objeto, sin que quepa su cumplimiento parcial.<br>

                            <b>19.6 Discrepancia entre textos legales:</b> En el supuesto en el que hubieses discrepancias entre el contrato (incluyendo sus anexos) y las 
                                condiciones legales o cualquier otro texto legal suscrito entre ZAABRA SALUD y el cliente en el marco de la utilización del sitio web, 
                                prevalecerá el presente contrato en relación todos los aspectos que conciernen al servicio de membresía.<br>
                                Asimismo, en el supuesto en el que hubiese discrepancias entre las condiciones generales y las condiciones particulares, prevalecerán estas 
                                últimas.
                        </p>

                        <h5 class="title_toggle_info">20. RÉGIMEN JURÍDICO Y LEY APLICABLE</h5>
                        <p class="txt_toggle_info">
                            20.1 Este contrato tiene carácter mercantil y se regirá por sus propias cláusulas, y en lo no previsto en ellas, las partes se atendrán a las 
                                previsiones dispuestas en la legislación colombiana.<br>

                            20.2 Renunciando las partes a cualquier privilegio que pudiera corresponder, cualquier disputa o controversia en relación con, en conexión con, 
                                o resultante del contrato será resuelto exclusivamente por los jueces y tribunales de Colombia.
                        </p>

                        <h5 class="title_toggle_info">21. PARÁMETROS DE FOTOGRAFÍA</h5>
                        <p class="txt_toggle_info">
                            21.1 Fotografía del perfil profesional, fotografía de aspecto cuadrado (altura igual al ancho) con dimensiones de 1.080 por 1.080 pixeles; 
                                La imagen con características de 24 bits por pixel, en espacio de color sRGB, en fondo blanco, en formato jpg o png. foto de perfil de cuerpo 
                                medio plano; las fotos escogidas para el perfil, deben ser recientes y reflejar su actual apariencia.<br>

                            21.2 Fotografías para galería, estás imágenes deben complementar contenido y aportar material visual.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card card_acordion"> <!-- Términos y condiciones de documentación requerida para diligenciamiento de perfiles -->
                <div id="headingFive">
                    <button class="button_acordion" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        Términos y condiciones de documentación requerida para diligenciamiento de perfiles
                    </button>
                </div>

                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                    <div class="card-body toggle_info">
                        <h5 class="title_toggle_info mt-0">DOCUMENTOS REQUERIDOS PARA PRESENTAR SU PERFIL DE LS ASOCICIÓN, INSTITUCIONAL Y/O PROFESIONAL EN NUESTRA 
                            PLATAFORMA
                        </h5>
                        <p class="txt_toggle_info">
                            A continuación,, relacionamos los documentos necesarios para la inscripción de su perfil y mostrarlo en nuestra plataforma:
                        </p>

                        <h5 class="title_toggle_info">Persona natural</h5>
                        <p class="txt_toggle_info">
                            1. Documento de identidad por ambos lados. <br>
                            2. Título o títulos de las universidades que lo acredita como profesional y/o especialista en la salud. <br>
                            3. Certificación de las instituciones donde ha estudiado (acta de grado y diplomas de especializaciónes). <br>
                            4. Trjeta profesional por ambos lados. <br>
                            5. Certificación del Consejo Nacional de Acreditación de su profesión. <br>
                            6. Certificado ReTHUS <br>
                            7. Certificado de las diferentes asociaciones a las que se acredita. <br>
                            8. Dirección del consultorio donde presta sus servicios profesionales, número de télefono fijo y celular. <br>
                                &nbsp; &nbsp; &nbsp; &nbsp; 8.1 Si es propio, certificar propiedad. <br>
                                &nbsp; &nbsp; &nbsp; &nbsp; 8.2 Si es arrendatario, anexar contrato. <br>
                            9. Acreditación de habilitación emitida por Secretaria de Salud para el funcionamiento del sitio donde presta sus servicios profesionales (si aplica). <br>
                            10. Registro de secretaria de salud antes de la ley 1090 de 2006 (si aplica). <br>
                            11. Si el título de pregrado es de una universidad extranjera, deberá cargar la Resolución de convalidación del título ante el Ministerio de 
                                Educación Nacional. <br>
                        </p>

                        <h5 class="title_toggle_info">Persona Jurídica</h5>
                        <p class="txt_toggle_info">
                            1. Certificado de cámara y comercio. <br>
                            2. Cedula de ciudadania del representante legal por ambas caras. <br>
                            3. Rut actualizado espedido por la DIAN. <br>
                            4. Título o títulos de las universidades que acreditan como profesional y/o especialista en la salud de los integrantes de la Asocición o institución. <br>
                            5. Certificado de las instituciones donde ha estudiado (acta de grado y diplomas de especializaciones), de cada uno de sus profesionales. <br>
                            6. Tarjeta profesional de cada uno de sus profesionales. <br>
                            7. Certificación del Consejo Nacional de Acreditación de su profesión y de los profesionales de su Asociación e institución. <br>
                            8. Certificación de ReTHUS. <br>
                            9. Certificación de las diferentes asociaciones a las que pertenece sus asociados o integrantes de la asociación o institución. <br>
                            10. Dirección del consultorio donde presta sus servicios profesionales, número de télefono fijo y celular. <br>
                                &nbsp; &nbsp; &nbsp; &nbsp; 10.1 Si es propio, certificado de la propiedad. <br>
                                &nbsp; &nbsp; &nbsp; &nbsp; 10.2 Si es arrendatario, anexar contrato. <br>
                            11. Acreditación de habilitación emitida por la Secretaria de Salud para el funcionamiento del sitio donde presta sus servicios profesionales 
                                (si aplica). <br>
                            12. Registro de la Secretaria de Salud antes de la ley 1090 de 2006 (si aplica). <br>
                            13. Si el título de pregrado es de una universidad extranjera, deberá cargar la resolución de convalidación del título ante el Ministerio de 
                                Educación Nacional. <br>
                        </p>

                        <p class="txt_toggle_info">
                            Todos los documentos anteriormente relacionaos los debera enviar escaneados en formato pdf al correo aléctronico 
                            <a href="{{url('/contacto')}}" target="blank">servicioalcliente@zaabrasalud.co</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
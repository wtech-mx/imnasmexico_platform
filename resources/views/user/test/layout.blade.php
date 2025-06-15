<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TEST COSMICA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <!-- Sweetalert2 -->
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/sweetalert2.css') }}">

    <style>
        body {
            background-color: #ffffff;
            font-family: 'Segoe UI', sans-serif;
        }

        .test-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            background-color: #f8f9fa;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .test-container h2 {
            margin-bottom: 30px;
            font-weight: bold;
            color: #343a40;
            text-align: center;
        }

        .test-question {
            margin-bottom: 25px;
            padding: 15px 20px;
            background: #ffffff;
            border-radius: 10px;
            border: 1px solid #dee2e6;
        }

        .test-question p {
            margin-bottom: 10px;
            font-weight: 500;
            color: #495057;
        }

        .form-check-label {
            display: block;
            margin-left: 5px;
            color: #212529;
            cursor: pointer;
        }

        .btn-primary {
            display: block;
            width: 100%;
            margin-top: 30px;
            font-weight: bold;
            font-size: 1.1rem;
        }
    </style>
 </head>

  <body>

    <div class="container">
          @yield('content')

    </div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Sweetalert2 -->
<script type="text/javascript" src="{{ asset('assets/ecommerce/js/sweetalert2.all.min.js') }}"></script>
@yield('js')
<script>
    document.getElementById('form-cuestionario').addEventListener('submit', function (e) {
        e.preventDefault();

        const nivelActual = document.getElementById('form-cuestionario').dataset.nivel;

        console.log(nivelActual);

        const respuestasCorrectas = {
            basico: {
                pregunta_1: 'b', pregunta_2: 'c', pregunta_3: 'b', pregunta_4: 'a', pregunta_5: 'b',
                pregunta_6: 'a', pregunta_7: 'b', pregunta_8: 'a', pregunta_9: 'a', pregunta_10: 'c'
            },
            medio: {
                pregunta_1: 'd', pregunta_2: 'b', pregunta_3: 'b', pregunta_4: 'b', pregunta_5: 'b',
                pregunta_6: 'b', pregunta_7: 'a', pregunta_8: 'b', pregunta_9: 'a', pregunta_10: 'c'
            },
            avanzado: {
                pregunta_1: 'a', pregunta_2: 'b', pregunta_3: 'b', pregunta_4: 'a', pregunta_5: 'b',
                pregunta_6: 'a', pregunta_7: 'a', pregunta_8: 'a', pregunta_9: 'b', pregunta_10: 'a'
            }
        };


        const linksWhats = {
            basico: 'https://chat.whatsapp.com/LdCM6u5RROh6U1WjLeEtED',
            medio: 'https://chat.whatsapp.com/Gfcrm1zlCQICKgM3NlHjHG',
            avanzado: 'https://chat.whatsapp.com/HWakcPxXad34nmwRWsLtXU'
        };

        const rutasInternas = {
            basico: '/test/cosmica/medio',
            medio: '/test/cosmica/avanzado',
            avanzado: '/test/cosmica/especializado' // o deja vacío si aún no existe
        };

        const respuestasNivel = respuestasCorrectas[nivelActual];
        console.log(respuestasNivel);

        if (!respuestasNivel) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: `No se encontraron respuestas para el nivel "${nivelActual}"`,
            });
            return;
        }

        let correctas = 0;

        for (const [pregunta, respuestaCorrecta] of Object.entries(respuestasNivel)) {
            const seleccionada = document.querySelector(`input[name="${pregunta}"]:checked`);
            if (seleccionada && seleccionada.value === respuestaCorrecta) {
                correctas++;
            }
        }

        let mensaje = '';
        let icono = '';
        let textoBoton = 'Ir al grupo';
        let linkGrupo = linksWhats[nivelActual];
        let botonExtra = null;

        if (nivelActual === 'basico') {
            if (correctas >= 8) {
                icono = 'success';
                mensaje = `¡Excelente! Obtuviste ${correctas}/10. Puedes avanzar al Nivel Medio.`;
                botonExtra = {
                    texto: 'Ir al Test Nivel Medio',
                    link: rutasInternas.basico
                };
            } else if (correctas >= 5) {
                icono = 'warning';
                mensaje = `Obtuviste ${correctas}/10. Mantente reforzando el Nivel Básico.`;
            } else {
                icono = 'error';
                mensaje = `Obtuviste solo ${correctas}/10. Es necesario repasar contenidos básicos.`;
            }
        }

        if (nivelActual === 'medio') {
            console.log(nivelActual);
            if (correctas >= 7) {
                icono = 'success';
                mensaje = `¡Muy bien! Obtuviste ${correctas}/10. Puedes avanzar al Nivel Avanzado.`;
                botonExtra = {
                    texto: 'Ir al Test Nivel Avanzado',
                    link: rutasInternas.medio
                };
            } else if (correctas >= 5) {
                icono = 'warning';
                mensaje = `Obtuviste ${correctas}/10. Recomendamos seguir profundizando en este nivel.`;
            } else {
                icono = 'error';
                mensaje = `Obtuviste ${correctas}/10. Sería útil volver al Nivel Básico.`;
            }
        }

        if (nivelActual === 'avanzado') {
            if (correctas >= 4 ) {
                icono = 'success';
                mensaje = `¡Gran nivel! Obtuviste ${correctas}/10. Puedes optar por un caso real o test especializado.`;
            } else if (correctas >= 5) {
                icono = 'warning';
                mensaje = `Obtuviste ${correctas}/10. Mantente en el Nivel Avanzado para afianzar conocimientos.`;
            } else {
                icono = 'error';
                mensaje = `Obtuviste ${correctas}/10. Te recomendamos volver al Nivel Medio.`;
                botonExtra = {
                    texto: 'Volver al Nivel Medio',
                    link: '/test/cosmica/medio'
                };
            }
        }

        let html = `<p>${mensaje}</p><a href="${linkGrupo}" class="swal2-confirm swal2-styled" style="background-color:#3085d6" target="_blank">Unirme al grupo de WhatsApp</a>`;

        if (botonExtra) {
            html += `<br><br><a href="${botonExtra.link}" class="swal2-confirm swal2-styled" style="background-color:#5cb85c"> ${botonExtra.texto}</a>`;
        }

        Swal.fire({
            icon: icono,
            title: 'Resultado del Test',
            html: html,
            showConfirmButton: false
        });
    });


   document.getElementById('form-cuestionario-espezializado').addEventListener('submit', function (e) {
        e.preventDefault();

        const nivelActual = document.getElementById('form-cuestionario-espezializado').dataset.nivel;

        console.log(nivelActual);

        const respuestasCorrectas = {
            basico: {
                pregunta_1: 'b', pregunta_2: 'c', pregunta_3: 'b', pregunta_4: 'a', pregunta_5: 'b',
                pregunta_6: 'a', pregunta_7: 'b', pregunta_8: 'a', pregunta_9: 'a', pregunta_10: 'c'
            },
            medio: {
                pregunta_1: 'd', pregunta_2: 'b', pregunta_3: 'b', pregunta_4: 'b', pregunta_5: 'b',
                pregunta_6: 'b', pregunta_7: 'a', pregunta_8: 'b', pregunta_9: 'a', pregunta_10: 'c'
            },
            avanzado: {
                pregunta_1: 'a', pregunta_2: 'b', pregunta_3: 'b', pregunta_4: 'a', pregunta_5: 'b',
                pregunta_6: 'a', pregunta_7: 'a', pregunta_8: 'a', pregunta_9: 'b', pregunta_10: 'a'
            }
        };

        const rutasInternas = {
            basico: '/test/cosmica/medio',
            medio: '/test/cosmica/avanzado',
            avanzado: '/test/cosmica/especializado' // o deja vacío si aún no existe
        };

        const respuestasNivel = respuestasCorrectas[nivelActual];
        console.log(respuestasNivel);

        if (!respuestasNivel) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: `No se encontraron respuestas para el nivel "${nivelActual}"`,
            });
            return;
        }

        let correctas = 0;

        for (const [pregunta, respuestaCorrecta] of Object.entries(respuestasNivel)) {
            const seleccionada = document.querySelector(`input[name="${pregunta}"]:checked`);
            if (seleccionada && seleccionada.value === respuestaCorrecta) {
                correctas++;
            }
        }

        let mensaje = '';
        let icono = '';
        let textoBoton = 'Ir al grupo';
        let linkGrupo = linksWhats[nivelActual];
        let botonExtra = null;

        if (nivelActual === 'basico') {
            if (correctas >= 8) {
                icono = 'success';
                mensaje = `¡Excelente! Obtuviste ${correctas}/10. Puedes avanzar al Nivel Medio.`;
                botonExtra = {
                    texto: 'Ir al Test Nivel Medio',
                    link: rutasInternas.basico
                };
            } else if (correctas >= 5) {
                icono = 'warning';
                mensaje = `Obtuviste ${correctas}/10. Mantente reforzando el Nivel Básico.`;
            } else {
                icono = 'error';
                mensaje = `Obtuviste solo ${correctas}/10. Es necesario repasar contenidos básicos.`;
            }
        }

        if (nivelActual === 'medio') {
            console.log(nivelActual);
            if (correctas >= 7) {
                icono = 'success';
                mensaje = `¡Muy bien! Obtuviste ${correctas}/10. Puedes avanzar al Nivel Avanzado.`;
                botonExtra = {
                    texto: 'Ir al Test Nivel Avanzado',
                    link: rutasInternas.medio
                };
            } else if (correctas >= 5) {
                icono = 'warning';
                mensaje = `Obtuviste ${correctas}/10. Recomendamos seguir profundizando en este nivel.`;
            } else {
                icono = 'error';
                mensaje = `Obtuviste ${correctas}/10. Sería útil volver al Nivel Básico.`;
            }
        }

        if (nivelActual === 'avanzado') {
            if (correctas >= 4 ) {
                icono = 'success';
                mensaje = `¡Gran nivel! Obtuviste ${correctas}/10. Puedes optar por un caso real o test especializado.`;
            } else if (correctas >= 5) {
                icono = 'warning';
                mensaje = `Obtuviste ${correctas}/10. Mantente en el Nivel Avanzado para afianzar conocimientos.`;
            } else {
                icono = 'error';
                mensaje = `Obtuviste ${correctas}/10. Te recomendamos volver al Nivel Medio.`;
                botonExtra = {
                    texto: 'Volver al Nivel Medio',
                    link: '/test/cosmica/medio'
                };
            }
        }

        let html = `<p>${mensaje}</p><a href="${linkGrupo}" class="swal2-confirm swal2-styled" style="background-color:#3085d6" target="_blank">Unirme al grupo de WhatsApp</a>`;

        if (botonExtra) {
            html += `<br><br><a href="${botonExtra.link}" class="swal2-confirm swal2-styled" style="background-color:#5cb85c"> ${botonExtra.texto}</a>`;
        }

        Swal.fire({
            icon: icono,
            title: 'Resultado del Test',
            html: html,
            showConfirmButton: false
        });
    });

    </script>

  </body>

</html>



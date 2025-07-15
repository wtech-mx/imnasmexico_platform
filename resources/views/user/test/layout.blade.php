<!doctype html>
<html lang="en">
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        @include('user.test.modal_inicio')
          @yield('content')

    </div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Sweetalert2 -->
<script type="text/javascript" src="{{ asset('assets/ecommerce/js/sweetalert2.all.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @guest
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            const loginModalEl = document.getElementById('loginModal');
            if (!loginModalEl) {
            console.error('No existe #loginModal en el DOM');
            return;
            }
            const loginModal = new bootstrap.Modal(loginModalEl, {
            backdrop: 'static',
            keyboard: false
            });
            loginModal.show();

            @if ($errors->any())
            loginModal.show();
            @endif
        });
        </script>
    @endguest
    @yield('js')
    <script>
        document.getElementById('form-cuestionario').addEventListener('submit', function (e) {
            e.preventDefault();
                const form         = this;
                const nivelActual  = form.dataset.nivel;  // ← sólo una vez
                let correctas      = 0;

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
                },
                esp_basico: {
                    pregunta_1: ['c', 'd'],
                    pregunta_2: ['c', 'd'],
                    pregunta_3: ['c', 'd'],
                    pregunta_4: ['c', 'd'],
                    pregunta_5: ['b', 'c', 'd'],
                    pregunta_6: ['b', 'c', 'd'],
                    pregunta_7: ['c', 'd'],
                    pregunta_8: ['a', 'b'],
                    pregunta_9: ['b', 'c', 'd'],
                    pregunta_10: ['a', 'b', 'd'],
                    pregunta_11: ['c', 'd'],
                    pregunta_12: ['a', 'b'],
                    pregunta_13: ['a', 'b'],
                    pregunta_14: ['a', 'b', 'c'],
                    pregunta_15: ['b', 'c', 'd']
                },
                esp_medio: {
                    pregunta_1: ['b', 'c'],
                    pregunta_2: ['a'],
                    pregunta_3: ['a', 'b'],
                    pregunta_4: ['a'],
                    pregunta_5: ['a', 'c'],
                    pregunta_6: ['b', 'c'],
                    pregunta_7: ['b'],
                    pregunta_8: ['b'],
                    pregunta_9: ['a'],
                    pregunta_10: ['a', 'b', 'c'],
                    pregunta_11: ['a'],
                    pregunta_12: ['b', 'c'],
                    pregunta_13: ['a'],
                    pregunta_14: ['b', 'c'],
                    pregunta_15: ['a', 'b', 'c']
                },
                esp_avanzado: {
                    pregunta_1: ['a'],
                    pregunta_2: ['a'],
                    pregunta_3: ['a', 'c'],
                    pregunta_4: ['a'],
                    pregunta_5: ['a'],
                    pregunta_6: ['c', 'd'],
                    pregunta_7: ['a'],
                    pregunta_8: ['a', 'b'],
                    pregunta_9: ['a', 'c'],
                    pregunta_10: ['a', 'c'],
                    pregunta_11: ['a', 'b'],
                    pregunta_12: ['a', 'b'],
                    pregunta_13: ['a', 'b'],
                    pregunta_14: ['a', 'b', 'c'],
                    pregunta_15: ['a', 'b', 'c']
                }
            };

            const linksWhats = {
                basico: 'https://chat.whatsapp.com/LdCM6u5RROh6U1WjLeEtED',
                medio: 'https://chat.whatsapp.com/Gfcrm1zlCQICKgM3NlHjHG',
                avanzado: 'https://chat.whatsapp.com/HWakcPxXad34nmwRWsLtXU'
            };

            const rutasInternas = {
                basico: '/test/cosmica/teorico/medio',
                medio: '/test/cosmica/teorico/avanzado',
                avanzado: '', // fin

                esp_basico: '/test/cosmica/especializado/basico',
                esp_medio: '/test/cosmica/especializado/medio',
                esp_avanzado: '/test/cosmica/especializado/avanzado' // fin
            };

            const respuestasNivel = respuestasCorrectas[nivelActual];
            if (!respuestasNivel) {
                return Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: `No se encontraron respuestas para el nivel "${nivelActual}"`,
                });
            }

            for (const [pregunta, respuestaCorrecta] of Object.entries(respuestasNivel)) {
                const sel = document.querySelector(`input[name="${pregunta}"]:checked`);
                if (!sel) continue;
                if (Array.isArray(respuestaCorrecta)) {
                    if (respuestaCorrecta.includes(sel.value)) correctas++;
                } else {
                    if (sel.value === respuestaCorrecta) correctas++;
                }
            }

            let passed = false;
            switch (nivelActual) {
                case 'basico':      passed = correctas >= 8;  break;
                case 'medio':       passed = correctas >= 7;  break;
                case 'avanzado':    passed = correctas >= 8;  break;
                case 'esp_basico':  passed = correctas >= 10; break;
                case 'esp_medio':   passed = correctas >= 10; break;
                case 'esp_avanzado':passed = correctas >= 10; break;
            }

            const payload = { nivel: nivelActual, score: correctas, passed };
            fetch('{{ route("test.resultados.store") }}', {
                method: 'POST',
                credentials: 'same-origin',  // <--- para que envíe la cookie de sesión
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',                   // opcional, pero ayuda a recibir JSON
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(payload)
            })
            .catch(err => console.error('Fetch error:', err))
            .finally(() => {
                // Construye el SweetAlert
                let mensaje   = '';
                let icono     = '';
                let linkGrupo = linksWhats[nivelActual];
                let botonExtra = null;

                // tus condicionales para mensaje/icono/botones (idénticas a las tuyas)
                if (nivelActual === 'basico') {
                    if (correctas >= 8) {
                        icono = 'success';
                        mensaje = `¡Excelente! Obtuviste ${correctas}/10. Puedes avanzar al Nivel Medio.`;
                        botonExtra = { texto: 'Ir al Test Nivel Medio', link: rutasInternas.basico };
                        linkGrupo = null;
                    } else if (correctas >= 5) {
                        icono = 'warning';
                        mensaje = `Obtuviste ${correctas}/10. Te sugerimos intentar el Test Especializado Básico.`;
                        botonExtra = { texto: 'Ir al Test Especializado Básico', link: rutasInternas.esp_basico };
                        linkGrupo = null;
                    } else {
                        icono = 'error';
                        mensaje = `Obtuviste solo ${correctas}/10. Te recomendamos reforzar antes de unirte al grupo.`;
                        botonExtra = { texto: 'Ir al Test Especializado Básico', link: rutasInternas.esp_basico };
                        linkGrupo = null;
                    }
                }

                if (nivelActual === 'esp_basico') {
                    if (correctas >= 10) {
                        icono = 'success';
                        mensaje = `¡Muy bien! Obtuviste ${correctas}/15. Puedes avanzar al Test Especializado Medio.`;
                        botonExtra = { texto: 'Ir al Test Especializado Medio', link: rutasInternas.esp_medio };
                    } else {
                        icono = 'warning';
                        mensaje = `Obtuviste ${correctas}/15. Únete al grupo para continuar tu aprendizaje.`;
                        linkGrupo = linksWhats.basico;
                    }
                }

                if (nivelActual === 'medio') {
                    if (correctas >= 7) {
                        icono = 'success';
                        mensaje = `¡Muy bien! Obtuviste ${correctas}/10. Puedes avanzar al Nivel Avanzado.`;
                        botonExtra = { texto: 'Ir al Test Nivel Avanzado', link: rutasInternas.medio };
                    } else if (correctas >= 5) {
                        icono = 'warning';
                        mensaje = `Obtuviste ${correctas}/10. Intenta con el Test Especializado Medio.`;
                        botonExtra = { texto: 'Ir al Test Especializado Medio', link: rutasInternas.esp_medio };
                        linkGrupo = null;
                    } else {
                        icono = 'error';
                        mensaje = `Obtuviste ${correctas}/10. Te recomendamos reforzar antes de unirte al grupo.`;
                        botonExtra = { texto: 'Ir al Test Especializado Medio', link: rutasInternas.esp_medio };
                        linkGrupo = null;
                    }
                }

                if (nivelActual === 'esp_medio') {
                    if (correctas >= 10) {
                        icono = 'success';
                        mensaje = `¡Excelente! Obtuviste ${correctas}/15. Puedes avanzar al Test Especializado Avanzado.`;
                        botonExtra = { texto: 'Ir al Test Especializado Avanzado', link: rutasInternas.esp_avanzado };
                    } else {
                        icono = 'warning';
                        mensaje = `Obtuviste ${correctas}/15. Únete al grupo para seguir aprendiendo.`;
                        linkGrupo = linksWhats.medio;
                    }
                }

                if (nivelActual === 'avanzado') {
                    if (correctas >= 8) {
                        icono = 'success';
                        mensaje = `¡Felicidades! Obtuviste ${correctas}/10. Has alcanzado el nivel más alto.`;
                        linkGrupo = linksWhats.avanzado;
                    } else if (correctas >= 5) {
                        icono = 'warning';
                        mensaje = `Obtuviste ${correctas}/10. Puedes reforzar más este nivel.`;
                        linkGrupo = linksWhats.avanzado;
                    } else {
                        icono = 'error';
                        mensaje = `Obtuviste ${correctas}/10. Te recomendamos unirte al grupo del Nivel Medio.`;
                        linkGrupo = linksWhats.medio;
                    }
                }

                if (nivelActual === 'esp_avanzado') {
                    if (correctas >= 10) {
                        icono = 'success';
                        mensaje = `¡Increíble! Obtuviste ${correctas}/15. Has completado todo el camino.`;
                        linkGrupo = linksWhats.avanzado;
                    } else {
                        icono = 'warning';
                        mensaje = `Obtuviste ${correctas}/15. Puedes unirte al grupo del Nivel Medio.`;
                        linkGrupo = linksWhats.medio;
                    }
                }

                // Construye el HTML del modal
                let html = `<p>${mensaje}</p>`;
                if (linkGrupo) {
                    html += `<a href="${linkGrupo}" class="swal2-confirm swal2-styled" style="background-color:#3085d6" target="_blank">Unirme al grupo de WhatsApp</a>`;
                }
                if (botonExtra) {
                    html += `<br><br><a href="${botonExtra.link}" class="swal2-confirm swal2-styled" style="background-color:#5cb85c">${botonExtra.texto}</a>`;
                }

                Swal.fire({
                    icon: icono,
                    title: 'Resultado del Test',
                    html: html,
                    showConfirmButton: false
                });
            });
        });
    </script>

  </body>

</html>



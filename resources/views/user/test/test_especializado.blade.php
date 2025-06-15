<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TEST COSMICA AVANZADO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
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
        <form id="test-nivel-basico" class="test-container">
            <h2>Experiencia en rutina y servicios</h2>

            <div class="test-question">
            <p>1. ¿Con qué frecuencia llevas a cabo tu rutina de cuidado facial?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1a" value="a"><label class="form-check-label" for="p1a">a) Mañana y noche a diario</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1b" value="b"><label class="form-check-label" for="p1b">b) Solo por la mañana</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1c" value="c"><label class="form-check-label" for="p1c">c) 3–4 veces por semana</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1d" value="d"><label class="form-check-label" for="p1d">d) Menos de una vez por semana</label></div>
            </div>

            <div class="test-question">
            <p>2. ¿Con qué frecuencia asistes a sesiones de tratamiento facial presencial con un profesional?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2a" value="a"><label class="form-check-label" for="p2a">a) Mensualmente</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2b" value="b"><label class="form-check-label" for="p2b">b) Trimestralmente</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2c" value="c"><label class="form-check-label" for="p2c">c) Solo en ocasiones especiales</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2d" value="d"><label class="form-check-label" for="p2d">d) Nunca he asistido</label></div>
            </div>

            <div class="test-question">
            <p>3. Cuando un producto te irrita, ¿qué haces?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3a" value="a"><label class="form-check-label" for="p3a">a) Lo suspendes inmediatamente y buscas una alternativa suave</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3b" value="b"><label class="form-check-label" for="p3b">b) Reduzco su frecuencia de uso</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3c" value="c"><label class="form-check-label" for="p3c">c) Combino con un tónico para “neutralizarlo”</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3d" value="d"><label class="form-check-label" for="p3d">d) Sigo usándolo hasta terminarlo</label></div>
            </div>

            <div class="test-question">
            <p>4. ¿Has seguido alguna rutina especializada (antiacné, anti-manchas) guiada por un profesional?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4a" value="a"><label class="form-check-label" for="p4a">a) Sí, antiacné con ácido salicílico</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4b" value="b"><label class="form-check-label" for="p4b">b) Sí, antimanchas con vitamina C</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4c" value="c"><label class="form-check-label" for="p4c">c) No, mantengo solo limpieza e hidratación</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4d" value="d"><label class="form-check-label" for="p4d">d) No sabría cómo empezar</label></div>
            </div>

            <div class="test-question">
            <p>5. ¿Qué aspecto valoras más en una sesión de servicio facial?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5a" value="a"><label class="form-check-label" for="p5a">a) Atención personalizada</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5b" value="b"><label class="form-check-label" for="p5b">b) Ambiente relajante</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5c" value="c"><label class="form-check-label" for="p5c">c) Duración del tratamiento</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5d" value="d"><label class="form-check-label" for="p5d">d) Uso de tecnología avanzada</label></div>
            </div>

            <h2>Familiaridad y autoconfianza</h2>

            <div class="test-question">
            <p>1. ¿Cuáles de estos ingredientes conoces y su función?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1a" value="a"><label class="form-check-label" for="p1a">a) Ácido hialurónico (hidratación) / Vitamina C (antioxidante)</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1b" value="b"><label class="form-check-label" for="p1b">b) Retinol (protectivo) / AHA (calmante)</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1c" value="c"><label class="form-check-label" for="p1c">c) Pantenol (exfoliante) / BHA (iluminador)</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1d" value="d"><label class="form-check-label" for="p1d">d) Niacinamida (abrasiva) / Péptidos (espuma)</label></div>
            </div>

            <div class="test-question">
            <p>2. Al comprar un servicio o producto, ¿cómo evalúas la propuesta?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2a" value="a"><label class="form-check-label" for="p2a">a) Reviso siempre el respaldo científico/técnico</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2b" value="b"><label class="form-check-label" for="p2b">b) Confío en la recomendación del profesional</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2c" value="c"><label class="form-check-label" for="p2c">c) Me guío por opiniones de otros clientes</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2d" value="d"><label class="form-check-label" for="p2d">d) Lo elijo por precio</label></div>
            </div>

            <div class="test-question">
            <p>3. En una escala del 1 al 5, ¿qué tan seguro/a te sientes explicando la diferencia entre AHA y BHA?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3a" value="a"><label class="form-check-label" for="p3a">a) 1–2 (muy inseguro/a)</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3b" value="b"><label class="form-check-label" for="p3b">b) 3 (algo inseguro/a)</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3c" value="c"><label class="form-check-label" for="p3c">c) 4 (bastante seguro/a)</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3d" value="d"><label class="form-check-label" for="p3d">d) 5 (muy seguro/a)</label></div>
            </div>

            <div class="test-question">
            <p>4. ¿Cómo sueles comparar dos protocolos o servicios similares?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4a" value="a"><label class="form-check-label" for="p4a">a) Revisando objetivos y técnicas incluidas</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4b" value="b"><label class="form-check-label" for="p4b">b) Solo miro precios</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4c" value="c"><label class="form-check-label" for="p4c">c) Con comentarios en redes sociales</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4d" value="d"><label class="form-check-label" for="p4d">d) No comparo, elijo siempre el mismo</label></div>
            </div>

            <div class="test-question">
            <p>5. ¿Qué término técnico te genera más dudas?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5a" value="a"><label class="form-check-label" for="p5a">a) “Cosmecéutico”</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5b" value="b"><label class="form-check-label" for="p5b">b) “Comedogénico”</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5c" value="c"><label class="form-check-label" for="p5c">c) “Fitoactivo”</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5d" value="d"><label class="form-check-label" for="p5d">d) “Biotecnología dérmica”</label></div>
            </div>

            <h2>Formación y primeros pasos</h2>

            <div class="test-question">
            <p>1. ¿Has tomado algún curso o taller de introducción a la cosmetología?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1a" value="a"><label class="form-check-label" for="p1a">a) Sí, presencial de 1–2 días</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1b" value="b"><label class="form-check-label" for="p1b">b) Sí, online de 2–4 semanas</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1c" value="c"><label class="form-check-label" for="p1c">c) No, sólo autoaprendizaje</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1d" value="d"><label class="form-check-label" for="p1d">d) No, ninguna formación</label></div>
            </div>

            <div class="test-question">
            <p>2. ¿Cuántas horas prácticas estimas haber hecho en cabina (o simulación con terceros)?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2a" value="a"><label class="form-check-label" for="p2a">a) 0 horas</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2b" value="b"><label class="form-check-label" for="p2b">b) 1–10 horas</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2c" value="c"><label class="form-check-label" for="p2c">c) 10–50 horas</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2d" value="d"><label class="form-check-label" for="p2d">d) Más de 50 horas</label></div>
            </div>

            <div class="test-question">
            <p>3. ¿Has diagnosticado la piel de otra persona alguna vez?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3a" value="a"><label class="form-check-label" for="p3a">a) Sí, varias veces</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3b" value="b"><label class="form-check-label" for="p3b">b) Una o dos veces</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3c" value="c"><label class="form-check-label" for="p3c">c) Nunca, pero me gustaría</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3d" value="d"><label class="form-check-label" for="p3d">d) No me interesa aún</label></div>
            </div>

            <div class="test-question">
            <p>4. ¿Qué recurso usas para profundizar lo que aprendes?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4a" value="a"><label class="form-check-label" for="p4a">a) Manuales y PDF técnicos</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4b" value="b"><label class="form-check-label" for="p4b">b) Webinars o videos formativos</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4c" value="c"><label class="form-check-label" for="p4c">c) Libros o artículos científicos</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4d" value="d"><label class="form-check-label" for="p4d">d) Redes sociales/influencers</label></div>
            </div>

            <div class="test-question">
            <p>5. ¿Qué tema básico te gustaría dominar mejor antes de avanzar?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5a" value="a"><label class="form-check-label" for="p5a">a) Tipos de piel y diagnóstico</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5b" value="b"><label class="form-check-label" for="p5b">b) Ingredientes hidratantes</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5c" value="c"><label class="form-check-label" for="p5c">c) Estructura de protocolos de limpieza</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5d" value="d"><label class="form-check-label" for="p5d">d) Interpretación de informes de cliente</label></div>
            </div>

            <h2>Casos y protocolos prácticos</h2>

            <div class="test-question">
            <p>1. ¿Cuántos clientes has atendido en cabina los últimos 6 meses?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1a" value="a"><label class="form-check-label" for="p1a">a) Ninguno</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1b" value="b"><label class="form-check-label" for="p1b">b) 1–5</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1c" value="c"><label class="form-check-label" for="p1c">c) 6–15</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1d" value="d"><label class="form-check-label" for="p1d">d) Más de 15</label></div>
            </div>

            <div class="test-question">
            <p>2. ¿Cómo describirías el último protocolo que diseñaste para piel grasa con acné?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2a" value="a"><label class="form-check-label" for="p2a">a) Limpieza → BHA → Hidratación ligera</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2b" value="b"><label class="form-check-label" for="p2b">b) Gel limpiador fuerte + exfoliante físico</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2c" value="c"><label class="form-check-label" for="p2c">c) Hidratación y SPF solamente</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2d" value="d"><label class="form-check-label" for="p2d">d) Mezcla de retinol + peróxido de benzoilo</label></div>
            </div>

            <div class="test-question">
            <p>3. ¿Cómo registras los avances de tu cliente?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3a" value="a"><label class="form-check-label" for="p3a">a) Fotos antes/después</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3b" value="b"><label class="form-check-label" for="p3b">b) Notas escritas en ficha</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3c" value="c"><label class="form-check-label" for="p3c">c) Medición de sebo (si dispones de equipo)</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3d" value="d"><label class="form-check-label" for="p3d">d) No registro formalmente</label></div>
            </div>

            <div class="test-question">
            <p>4. Cuando un protocolo provoca irritación, ¿qué haces?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4a" value="a"><label class="form-check-label" for="p4a">a) Reduzco frecuencia y aplico calmantes</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4b" value="b"><label class="form-check-label" for="p4b">b) Suspendo todo el protocolo</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4c" value="c"><label class="form-check-label" for="p4c">c) Cambio a un método físico suave</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4d" value="d"><label class="form-check-label" for="p4d">d) Continúo igual para “acostumbrar” la piel</label></div>
            </div>

            <div class="test-question">
            <p>5. Si un cliente no mejora tras varias sesiones, ¿cuál es tu siguiente paso?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5a" value="a"><label class="form-check-label" for="p5a">a) Revisar ingredientes y ajustar dosis</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5b" value="b"><label class="form-check-label" for="p5b">b) Aumentar concentración de activos</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5c" value="c"><label class="form-check-label" for="p5c">c) Cambiar completamente de abordaje</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5d" value="d"><label class="form-check-label" for="p5d">d) Referir a un dermatólogo</label></div>
            </div>


            <h2>Autopercepción de competencias</h2>

            <div class="test-question">
            <p>1. ¿Cómo valoras tu confianza mezclando activos (ej. Vitamina C + Niacinamida)?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1a" value="a"><label class="form-check-label" for="p1a">a) 1–2 (baja)</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1b" value="b"><label class="form-check-label" for="p1b">b) 3 (media)</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1c" value="c"><label class="form-check-label" for="p1c">c) 4 (alta)</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1d" value="d"><label class="form-check-label" for="p1d">d) 5 (muy alta)</label></div>
            </div>

            <div class="test-question">
            <p>2. ¿Con qué frecuencia actualizas tus conocimientos sobre ingredientes o técnicas?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2a" value="a"><label class="form-check-label" for="p2a">a) Mensual</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2b" value="b"><label class="form-check-label" for="p2b">b) Trimestral</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2c" value="c"><label class="form-check-label" for="p2c">c) Anual</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2d" value="d"><label class="form-check-label" for="p2d">d) Nunca</label></div>
            </div>

            <div class="test-question">
            <p>3. ¿Has personalizado un protocolo para una condición particular (rosácea, hiperpigmentación…)?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3a" value="a"><label class="form-check-label" for="p3a">a) Sí, varias veces</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3b" value="b"><label class="form-check-label" for="p3b">b) Una vez</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3c" value="c"><label class="form-check-label" for="p3c">c) Nunca</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3d" value="d"><label class="form-check-label" for="p3d">d) No lo considero necesario</label></div>
            </div>

            <div class="test-question">
            <p>4. ¿Qué criterio principal usas para evaluar la compatibilidad de dos productos en un mismo protocolo?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4a" value="a"><label class="form-check-label" for="p4a">a) pH similar</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4b" value="b"><label class="form-check-label" for="p4b">b) Misma marca</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4c" value="c"><label class="form-check-label" for="p4c">c) Opinión de colegas</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4d" value="d"><label class="form-check-label" for="p4d">d) No evalúo compatibilidad técnica</label></div>
            </div>

            <div class="test-question">
            <p>5. ¿En qué área te gustaría recibir más formación práctica?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5a" value="a"><label class="form-check-label" for="p5a">a) Formulación de sueros</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5b" value="b"><label class="form-check-label" for="p5b">b) Aparatología intermedia (RF, ultrasonido…)</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5c" value="c"><label class="form-check-label" for="p5c">c) Diagnóstico de manchas y pigmentación</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5d" value="d"><label class="form-check-label" for="p5d">d) Gestión y marketing de servicios</label></div>
            </div>


            <h2>Planificación y seguimiento</h2>

            <div class="test-question">
            <p>1. Al planificar una mesoterapia virtual, ¿por dónde comienzas?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1a" value="a"><label class="form-check-label" for="p1a">a) Evaluación de tipo de piel y objetivos</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1b" value="b"><label class="form-check-label" for="p1b">b) Selección de aparatología adecuada</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1c" value="c"><label class="form-check-label" for="p1c">c) Definición de presupuesto del cliente</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1d" value="d"><label class="form-check-label" for="p1d">d) Preparación del espacio de trabajo</label></div>
            </div>

            <div class="test-question">
            <p>2. ¿Qué herramienta usas para medir la satisfacción del cliente tras el servicio?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2a" value="a"><label class="form-check-label" for="p2a">a) Encuesta en papel</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2b" value="b"><label class="form-check-label" for="p2b">b) Formulario online</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2c" value="c"><label class="form-check-label" for="p2c">c) Feedback verbal directo</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2d" value="d"><label class="form-check-label" for="p2d">d) No suelo medir satisfacción</label></div>
            </div>

            <div class="test-question">
            <p>3. ¿Cómo ajustas dosis y frecuencia de un activo a lo largo de varias sesiones?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3a" value="a"><label class="form-check-label" for="p3a">a) Según tolerancia del cliente</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3b" value="b"><label class="form-check-label" for="p3b">b) Siempre al máximo nivel recomendado</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3c" value="c"><label class="form-check-label" for="p3c">c) Nunca lo ajusto</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3d" value="d"><label class="form-check-label" for="p3d">d) Basado en mi intuición</label></div>
            </div>

            <div class="test-question">
            <p>4. ¿Has impartido demostraciones o mini-clases internas sobre protocolos?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4a" value="a"><label class="form-check-label" for="p4a">a) Sí, con contenidos estructurados</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4b" value="b"><label class="form-check-label" for="p4b">b) Sí, de forma informal</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4c" value="c"><label class="form-check-label" for="p4c">c) No, pero me gustaría</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4d" value="d"><label class="form-check-label" for="p4d">d) No me interesa</label></div>
            </div>

            <div class="test-question">
            <p>5. ¿Cómo enseñas a los clientes a mantener resultados en casa?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5a" value="a"><label class="form-check-label" for="p5a">a) Manual escrito con pasos claros</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5b" value="b"><label class="form-check-label" for="p5b">b) Video tutorial personalizado</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5c" value="c"><label class="form-check-label" for="p5c">c) Explicación verbal detallada</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5d" value="d"><label class="form-check-label" for="p5d">d) No ofrezco guía para el hogar</label></div>
            </div>

            <h2> Resolución de casos complejos de servicio</h2>

            <div class="test-question">
            <p>1. Al tratar fotoenvejecimiento severo, ¿con qué inicias tu protocolo de servicio?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1a" value="a"><label class="form-check-label" for="p1a">a) Peeling medio + SPF ≥ 50</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1b" value="b"><label class="form-check-label" for="p1b">b) Hidratación intensiva profunda</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1c" value="c"><label class="form-check-label" for="p1c">c) Láser no ablativo de inmediato</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1d" value="d"><label class="form-check-label" for="p1d">d) Exfoliación física diaria</label></div>
            </div>

            <div class="test-question">
            <p>2. ¿Cómo combinas aparatología y formulaciones en una misma sesión?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2a" value="a"><label class="form-check-label" for="p2a">a) LED → Suero antioxidante</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2b" value="b"><label class="form-check-label" for="p2b">b) RF → Solo hidratante</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2c" value="c"><label class="form-check-label" for="p2c">c) Ultrasonido → Limpieza profunda</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2d" value="d"><label class="form-check-label" for="p2d">d) Nunca combino aparato y serum</label></div>
            </div>

            <div class="test-question">
            <p>3. ¿Cuál es el paso prioritario en la consulta inicial para evaluar el estado de la piel?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3a" value="a"><label class="form-check-label" for="p3a">a) Entrevista de expectativas y antecedentes</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3b" value="b"><label class="form-check-label" for="p3b">b) Limpieza facial previa</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3c" value="c"><label class="form-check-label" for="p3c">c) Registro fotográfico estandarizado</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3d" value="d"><label class="form-check-label" for="p3d">d) Prueba de tolerancia a un activo</label></div>
            </div>

            <div class="test-question">
            <p>4. ¿Cómo adaptas la intensidad de una microdermoabrasión a piel hipersensible?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4a" value="a"><label class="form-check-label" for="p4a">a) Reduzco presión y tiempo de exposición</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4b" value="b"><label class="form-check-label" for="p4b">b) Aumento la presión para compensar</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4c" value="c"><label class="form-check-label" for="p4c">c) Mantengo parámetros estándar</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4d" value="d"><label class="form-check-label" for="p4d">d) Sustituyo por peeling físico fuerte</label></div>
            </div>

            <div class="test-question">
            <p>5. ¿Qué indicación das tras un peeling químico profesional?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5a" value="a"><label class="form-check-label" for="p5a">a) Evitar sol directo y usar SPF ≥ 50</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5b" value="b"><label class="form-check-label" for="p5b">b) Aumentar exfoliación suave</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5c" value="c"><label class="form-check-label" for="p5c">c) Maquillaje cubriente inmediato</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5d" value="d"><label class="form-check-label" for="p5d">d) Sauna para acelerar descamación</label></div>
            </div>


            <h2>Liderazgo y formación continua de servicios</h2>

            <div class="test-question">
            <p>1. ¿Con qué frecuencia organizas talleres internos de protocolos?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1a" value="a"><label class="form-check-label" for="p1a">a) Ninguna vez al mes</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1b" value="b"><label class="form-check-label" for="p1b">b) 1 vez al mes</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1c" value="c"><label class="form-check-label" for="p1c">c) 2–3 veces al mes</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1d" value="d"><label class="form-check-label" for="p1d">d) Más de 4 veces al mes</label></div>
            </div>

            <div class="test-question">
            <p>2. ¿Has impartido ponencias o webinars sobre protocolos de servicio?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2a" value="a"><label class="form-check-label" for="p2a">a) Sí, formales y documentados</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2b" value="b"><label class="form-check-label" for="p2b">b) Sí, de forma informal</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2c" value="c"><label class="form-check-label" for="p2c">c) No, pero lo planeo</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2d" value="d"><label class="form-check-label" for="p2d">d) No me interesa</label></div>
            </div>

            <div class="test-question">
            <p>3. ¿Participaste en alguna publicación o caso clínico de servicios estéticos?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3a" value="a"><label class="form-check-label" for="p3a">a) Sí, como autor principal</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3b" value="b"><label class="form-check-label" for="p3b">b) Sí, como coautor</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3c" value="c"><label class="form-check-label" for="p3c">c) No, pero me gustaría</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3d" value="d"><label class="form-check-label" for="p3d">d) No me interesa</label></div>
            </div>

            <div class="test-question">
            <p>4. ¿Cómo recoges feedback de tus clientes tras el servicio?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4a" value="a"><label class="form-check-label" for="p4a">a) Encuesta personalizada online</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4b" value="b"><label class="form-check-label" for="p4b">b) Comentarios verbales en cabina</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4c" value="c"><label class="form-check-label" for="p4c">c) Mensaje de seguimiento (WhatsApp/email)</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4d" value="d"><label class="form-check-label" for="p4d">d) No recopilo feedback</label></div>
            </div>

            <div class="test-question">
            <p>5. ¿Qué modelo de servicio innovador aplicas o te interesa?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5a" value="a"><label class="form-check-label" for="p5a">a) Teleconsulta de diagnóstico facial</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5b" value="b"><label class="form-check-label" for="p5b">b) Sesiones grupales de bienestar estético</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5c" value="c"><label class="form-check-label" for="p5c">c) Protocolos de home-care con seguimiento digital</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5d" value="d"><label class="form-check-label" for="p5d">d) Servicios móviles a domicilio</label></div>
            </div>

            <h2>Innovación y desarrollo profesional</h2>

            <div class="test-question">
            <p>1. ¿Has colaborado en formular o mejorar un protocolo propio?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1a" value="a"><label class="form-check-label" for="p1a">a) Sí, con datos clínicos y mediciones</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1b" value="b"><label class="form-check-label" for="p1b">b) Sí, empíricamente</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1c" value="c"><label class="form-check-label" for="p1c">c) No, pero lo tengo en mente</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1d" value="d"><label class="form-check-label" for="p1d">d) No me interesa</label></div>
            </div>

            <div class="test-question">
            <p>2. ¿Qué KPI usas para evaluar la eficacia de un nuevo tratamiento?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2a" value="a"><label class="form-check-label" for="p2a">a) Fotos estandarizadas</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2b" value="b"><label class="form-check-label" for="p2b">b) Medición de TEWL/hidratación</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2c" value="c"><label class="form-check-label" for="p2c">c) Encuesta de satisfacción</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2d" value="d"><label class="form-check-label" for="p2d">d) No utilizo KPI</label></div>
            </div>

            <div class="test-question">
            <p>3. ¿Has liderado proyectos con laboratorios o proveedores?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3a" value="a"><label class="form-check-label" for="p3a">a) Sí, I+D de protocolos</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3b" value="b"><label class="form-check-label" for="p3b">b) Sí, tests de estabilidad y eficacia</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3c" value="c"><label class="form-check-label" for="p3c">c) No, pero quisiera</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3d" value="d"><label class="form-check-label" for="p3d">d) No me interesa</label></div>
            </div>

            <div class="test-question">
            <p>4. ¿Cómo mides el retorno de inversión de un nuevo servicio?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4a" value="a"><label class="form-check-label" for="p4a">a) Número de clientes nuevos</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4b" value="b"><label class="form-check-label" for="p4b">b) Ingresos por cliente</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4c" value="c"><label class="form-check-label" for="p4c">c) Repetición de citas</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4d" value="d"><label class="form-check-label" for="p4d">d) No mido ROI</label></div>
            </div>

            <div class="test-question">
            <p>5. ¿En qué asociaciones o grupos colaboras profesionalmente?</p>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5a" value="a"><label class="form-check-label" for="p5a">a) Sociedades científicas de estética</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5b" value="b"><label class="form-check-label" for="p5b">b) Colegios o gremios profesionales</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5c" value="c"><label class="form-check-label" for="p5c">c) Comunidades online especializadas</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5d" value="d"><label class="form-check-label" for="p5d">d) Ninguna</label></div>
            </div>



            <button type="submit" class="btn btn-primary">Enviar respuestas</button>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>

</html>



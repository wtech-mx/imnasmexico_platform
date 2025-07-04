@extends('user.test.layout')

@section('content')
         <form id="form-cuestionario" class="test-container" data-nivel="esp_basico">

            <h2>Test Basico Experiencia en rutina y servicios</h2>

                <!-- Pega esto dentro de tu <form id="form-cuestionario"> -->
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

                <!-- ... las preguntas 3 a 15 siguen igual que este formato ... -->

            <h2>Test Basico Familiaridad y autoconfianza</h2>

            <div class="test-question">
                <p>1. ¿Cuáles de estos ingredientes conoces y su función?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_6" id="p6a" value="a"><label class="form-check-label" for="p6a">a) Ácido hialurónico (hidratación) / Vitamina C (antioxidante)</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_6" id="p6b" value="b"><label class="form-check-label" for="p6b">b) Retinol (protectivo) / AHA (calmante)</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_6" id="p6c" value="c"><label class="form-check-label" for="p6c">c) Pantenol (exfoliante) / BHA (iluminador)</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_6" id="p6d" value="d"><label class="form-check-label" for="p6d">d) Niacinamida (abrasiva) / Péptidos (espuma)</label></div>
            </div>

            <div class="test-question">
                <p>2. Al comprar un servicio o producto, ¿cómo evalúas la propuesta?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_7" id="p7a" value="a"><label class="form-check-label" for="p7a">a) Reviso siempre el respaldo científico/técnico</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_7" id="p7b" value="b"><label class="form-check-label" for="p7b">b) Confío en la recomendación del profesional</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_7" id="p7c" value="c"><label class="form-check-label" for="p7c">c) Me guío por opiniones de otros clientes</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_7" id="p7d" value="d"><label class="form-check-label" for="p7d">d) Lo elijo por precio</label></div>
            </div>

            <div class="test-question">
                <p>3. En una escala del 1 al 5, ¿qué tan seguro/a te sientes explicando la diferencia entre AHA y BHA?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_8" id="p8a" value="a"><label class="form-check-label" for="p8a">a) 1–2 (muy inseguro/a)</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_8" id="p8b" value="b"><label class="form-check-label" for="p8b">b) 3 (algo inseguro/a)</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_8" id="p8c" value="c"><label class="form-check-label" for="p8c">c) 4 (bastante seguro/a)</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_8" id="p8d" value="d"><label class="form-check-label" for="p8d">d) 5 (muy seguro/a)</label></div>
            </div>

            <div class="test-question">
                <p>4. ¿Cómo sueles comparar dos protocolos o servicios similares?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_9" id="p9a" value="a"><label class="form-check-label" for="p9a">a) Revisando objetivos y técnicas incluidas</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_9" id="p9b" value="b"><label class="form-check-label" for="p9b">b) Solo miro precios</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_9" id="p9c" value="c"><label class="form-check-label" for="p9c">c) Con comentarios en redes sociales</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_9" id="p9d" value="d"><label class="form-check-label" for="p9d">d) No comparo, elijo siempre el mismo</label></div>
            </div>

            <div class="test-question">
                <p>5. ¿Qué término técnico te genera más dudas?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_10" id="p10a" value="a"><label class="form-check-label" for="p10a">a) “Cosmecéutico”</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_10" id="p10b" value="b"><label class="form-check-label" for="p10b">b) “Comedogénico”</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_10" id="p10c" value="c"><label class="form-check-label" for="p10c">c) “Fitoactivo”</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_10" id="p10d" value="d"><label class="form-check-label" for="p10d">d) “Biotecnología dérmica”</label></div>
            </div>

            <h2>Test Basico Formación y primeros pasos</h2>

            <div class="test-question">
                <p>1. ¿Has tomado algún curso o taller de introducción a la cosmetología?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_11" id="p11a" value="a"><label class="form-check-label" for="p11a">a) Sí, presencial de 1–2 días</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_11" id="p11b" value="b"><label class="form-check-label" for="p11b">b) Sí, online de 2–4 semanas</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_11" id="p11c" value="c"><label class="form-check-label" for="p11c">c) No, sólo autoaprendizaje</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_11" id="p11d" value="d"><label class="form-check-label" for="p11d">d) No, ninguna formación</label></div>
            </div>

            <div class="test-question">
                <p>2. ¿Cuántas horas prácticas estimas haber hecho en cabina (o simulación con terceros)?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_12" id="p12a" value="a"><label class="form-check-label" for="p12a">a) 0 horas</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_12" id="p12b" value="b"><label class="form-check-label" for="p12b">b) 1–10 horas</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_12" id="p12c" value="c"><label class="form-check-label" for="p12c">c) 10–50 horas</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_12" id="p12d" value="d"><label class="form-check-label" for="p12d">d) Más de 50 horas</label></div>
            </div>

            <div class="test-question">
                <p>3. ¿Has diagnosticado la piel de otra persona alguna vez?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_13" id="p13a" value="a"><label class="form-check-label" for="p13a">a) Sí, varias veces</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_13" id="p13b" value="b"><label class="form-check-label" for="p13b">b) Una o dos veces</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_13" id="p13c" value="c"><label class="form-check-label" for="p13c">c) Nunca, pero me gustaría</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_13" id="p13d" value="d"><label class="form-check-label" for="p13d">d) No me interesa aún</label></div>
            </div>

            <div class="test-question">
                <p>4. ¿Qué recurso usas para profundizar lo que aprendes?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_14" id="p14a" value="a"><label class="form-check-label" for="p14a">a) Manuales y PDF técnicos</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_14" id="p14b" value="b"><label class="form-check-label" for="p14b">b) Webinars o videos formativos</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_14" id="p14c" value="c"><label class="form-check-label" for="p14c">c) Libros o artículos científicos</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_14" id="p14d" value="d"><label class="form-check-label" for="p14d">d) Redes sociales/influencers</label></div>
            </div>

            <div class="test-question">
                <p>5. ¿Qué tema básico te gustaría dominar mejor antes de avanzar?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_15" id="p15a" value="a"><label class="form-check-label" for="p15a">a) Tipos de piel y diagnóstico</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_15" id="p15b" value="b"><label class="form-check-label" for="p15b">b) Ingredientes hidratantes</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_15" id="p15c" value="c"><label class="form-check-label" for="p15c">c) Estructura de protocolos de limpieza</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_15" id="p15d" value="d"><label class="form-check-label" for="p15d">d) Interpretación de informes de cliente</label></div>
            </div>

            <button type="submit" class="btn btn-primary">Enviar respuestas</button>
         </form>

@endsection

@section('js')



@endsection

@extends('user.test.layout')

@section('content')
         <form id="form-cuestionario" class="test-container" data-nivel="esp_avanzado">

            <h2>Test Avanzado Resolución de casos complejos de servicio </h2>

            <div class="test-question">
                <p>1. Al tratar fotoenvejecimiento severo, ¿con qué inicias tu protocolo de servicio?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_31" id="p31a" value="a"><label class="form-check-label" for="p31a">a) Peeling medio + SPF ≥ 50</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_31" id="p31b" value="b"><label class="form-check-label" for="p31b">b) Hidratación intensiva profunda</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_31" id="p31c" value="c"><label class="form-check-label" for="p31c">c) Láser no ablativo de inmediato</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_31" id="p31d" value="d"><label class="form-check-label" for="p31d">d) Exfoliación física diaria</label></div>
            </div>

            <div class="test-question">
                <p>2. ¿Cómo combinas aparatología y formulaciones en una misma sesión?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_32" id="p32a" value="a"><label class="form-check-label" for="p32a">a) LED → Suero antioxidante</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_32" id="p32b" value="b"><label class="form-check-label" for="p32b">b) RF → Solo hidratante</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_32" id="p32c" value="c"><label class="form-check-label" for="p32c">c) Ultrasonido → Limpieza profunda</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_32" id="p32d" value="d"><label class="form-check-label" for="p32d">d) Nunca combino aparato y serum</label></div>
            </div>

            <div class="test-question">
                <p>3. ¿Cuál es el paso prioritario en la consulta inicial para evaluar el estado de la piel?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_33" id="p33a" value="a"><label class="form-check-label" for="p33a">a) Entrevista de expectativas y antecedentes</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_33" id="p33b" value="b"><label class="form-check-label" for="p33b">b) Limpieza facial previa</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_33" id="p33c" value="c"><label class="form-check-label" for="p33c">c) Registro fotográfico estandarizado</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_33" id="p33d" value="d"><label class="form-check-label" for="p33d">d) Prueba de tolerancia a un activo</label></div>
            </div>

            <div class="test-question">
                <p>4. ¿Cómo adaptas la intensidad de una microdermoabrasión a piel hipersensible?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_34" id="p34a" value="a"><label class="form-check-label" for="p34a">a) Reduzco presión y tiempo de exposición</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_34" id="p34b" value="b"><label class="form-check-label" for="p34b">b) Aumento la presión para compensar</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_34" id="p34c" value="c"><label class="form-check-label" for="p34c">c) Mantengo parámetros estándar</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_34" id="p34d" value="d"><label class="form-check-label" for="p34d">d) Sustituyo por peeling físico fuerte</label></div>
            </div>

            <div class="test-question">
                <p>5. ¿Qué indicación das tras un peeling químico profesional?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_35" id="p35a" value="a"><label class="form-check-label" for="p35a">a) Evitar sol directo y usar SPF ≥ 50</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_35" id="p35b" value="b"><label class="form-check-label" for="p35b">b) Aumentar exfoliación suave</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_35" id="p35c" value="c"><label class="form-check-label" for="p35c">c) Maquillaje cubriente inmediato</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_35" id="p35d" value="d"><label class="form-check-label" for="p35d">d) Sauna para acelerar descamación</label></div>
            </div>

            <h2>Test Avanzado Liderazgo y formación continua de servicios</h2>

            <div class="test-question">
                <p>1. ¿Con qué frecuencia organizas talleres internos de protocolos?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_36" id="p36a" value="a"><label class="form-check-label" for="p36a">a) Ninguna vez al mes</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_36" id="p36b" value="b"><label class="form-check-label" for="p36b">b) 1 vez al mes</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_36" id="p36c" value="c"><label class="form-check-label" for="p36c">c) 2–3 veces al mes</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_36" id="p36d" value="d"><label class="form-check-label" for="p36d">d) Más de 4 veces al mes</label></div>
            </div>

            <div class="test-question">
                <p>2. ¿Has impartido ponencias o webinars sobre protocolos de servicio?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_37" id="p37a" value="a"><label class="form-check-label" for="p37a">a) Sí, formales y documentados</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_37" id="p37b" value="b"><label class="form-check-label" for="p37b">b) Sí, de forma informal</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_37" id="p37c" value="c"><label class="form-check-label" for="p37c">c) No, pero lo planeo</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_37" id="p37d" value="d"><label class="form-check-label" for="p37d">d) No me interesa</label></div>
            </div>

            <div class="test-question">
                <p>3. ¿Participaste en alguna publicación o caso clínico de servicios estéticos?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_38" id="p38a" value="a"><label class="form-check-label" for="p38a">a) Sí, como autor principal</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_38" id="p38b" value="b"><label class="form-check-label" for="p38b">b) Sí, como coautor</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_38" id="p38c" value="c"><label class="form-check-label" for="p38c">c) No, pero me gustaría</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_38" id="p38d" value="d"><label class="form-check-label" for="p38d">d) No me interesa</label></div>
            </div>

            <div class="test-question">
                <p>4. ¿Cómo recoges feedback de tus clientes tras el servicio?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_39" id="p39a" value="a"><label class="form-check-label" for="p39a">a) Encuesta personalizada online</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_39" id="p39b" value="b"><label class="form-check-label" for="p39b">b) Comentarios verbales en cabina</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_39" id="p39c" value="c"><label class="form-check-label" for="p39c">c) Mensaje de seguimiento (WhatsApp/email)</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_39" id="p39d" value="d"><label class="form-check-label" for="p39d">d) No recopilo feedback</label></div>
            </div>

            <div class="test-question">
                <p>5. ¿Qué modelo de servicio innovador aplicas o te interesa?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_40" id="p40a" value="a"><label class="form-check-label" for="p40a">a) Teleconsulta de diagnóstico facial</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_40" id="p40b" value="b"><label class="form-check-label" for="p40b">b) Sesiones grupales de bienestar estético</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_40" id="p40c" value="c"><label class="form-check-label" for="p40c">c) Protocolos de home-care con seguimiento digital</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_40" id="p40d" value="d"><label class="form-check-label" for="p40d">d) Servicios móviles a domicilio</label></div>
            </div>

            <h2>Test Avanzado Innovación y desarrollo profesional</h2>

            <div class="test-question">
                <p>1. ¿Has colaborado en formular o mejorar un protocolo propio?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_41" id="p41a" value="a"><label class="form-check-label" for="p41a">a) Sí, con datos clínicos y mediciones</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_41" id="p41b" value="b"><label class="form-check-label" for="p41b">b) Sí, empíricamente</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_41" id="p41c" value="c"><label class="form-check-label" for="p41c">c) No, pero lo tengo en mente</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_41" id="p41d" value="d"><label class="form-check-label" for="p41d">d) No me interesa</label></div>
            </div>

            <div class="test-question">
                <p>2. ¿Qué KPI usas para evaluar la eficacia de un nuevo tratamiento?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_42" id="p42a" value="a"><label class="form-check-label" for="p42a">a) Fotos estandarizadas</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_42" id="p42b" value="b"><label class="form-check-label" for="p42b">b) Medición de TEWL/hidratación</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_42" id="p42c" value="c"><label class="form-check-label" for="p42c">c) Encuesta de satisfacción</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_42" id="p42d" value="d"><label class="form-check-label" for="p42d">d) No utilizo KPI</label></div>
            </div>

            <div class="test-question">
                <p>3. ¿Has liderado proyectos con laboratorios o proveedores?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_43" id="p43a" value="a"><label class="form-check-label" for="p43a">a) Sí, I+D de protocolos</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_43" id="p43b" value="b"><label class="form-check-label" for="p43b">b) Sí, tests de estabilidad y eficacia</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_43" id="p43c" value="c"><label class="form-check-label" for="p43c">c) No, pero quisiera</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_43" id="p43d" value="d"><label class="form-check-label" for="p43d">d) No me interesa</label></div>
            </div>

            <div class="test-question">
                <p>4. ¿Cómo mides el retorno de inversión de un nuevo servicio?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_44" id="p44a" value="a"><label class="form-check-label" for="p44a">a) Número de clientes nuevos</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_44" id="p44b" value="b"><label class="form-check-label" for="p44b">b) Ingresos por cliente</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_44" id="p44c" value="c"><label class="form-check-label" for="p44c">c) Repetición de citas</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_44" id="p44d" value="d"><label class="form-check-label" for="p44d">d) No mido ROI</label></div>
            </div>

            <div class="test-question">
                <p>5. ¿En qué asociaciones o grupos colaboras profesionalmente?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_45" id="p45a" value="a"><label class="form-check-label" for="p45a">a) Sociedades científicas de estética</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_45" id="p45b" value="b"><label class="form-check-label" for="p45b">b) Colegios o gremios profesionales</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_45" id="p45c" value="c"><label class="form-check-label" for="p45c">c) Comunidades online especializadas</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_45" id="p45d" value="d"><label class="form-check-label" for="p45d">d) Ninguna</label></div>
            </div>

            <button type="submit" class="btn btn-primary">Enviar respuestas</button>

         </form>

@endsection

@section('js')



@endsection

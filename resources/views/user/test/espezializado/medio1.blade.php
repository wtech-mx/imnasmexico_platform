@extends('user.test.layout')

@section('content')
         <form id="form-cuestionario" class="test-container" data-nivel="esp_medio">

            <h2>Test Medio Casos y protocolos prácticos</h2>

            <div class="test-question">
                <p>1. ¿Cuántos clientes has atendido en cabina los últimos 6 meses?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_16" id="p16a" value="a"><label class="form-check-label" for="p16a">a) Ninguno</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_16" id="p16b" value="b"><label class="form-check-label" for="p16b">b) 1–5</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_16" id="p16c" value="c"><label class="form-check-label" for="p16c">c) 6–15</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_16" id="p16d" value="d"><label class="form-check-label" for="p16d">d) Más de 15</label></div>
            </div>

            <div class="test-question">
                <p>2. ¿Cómo describirías el último protocolo que diseñaste para piel grasa con acné?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_17" id="p17a" value="a"><label class="form-check-label" for="p17a">a) Limpieza → BHA → Hidratación ligera</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_17" id="p17b" value="b"><label class="form-check-label" for="p17b">b) Gel limpiador fuerte + exfoliante físico</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_17" id="p17c" value="c"><label class="form-check-label" for="p17c">c) Hidratación y SPF solamente</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_17" id="p17d" value="d"><label class="form-check-label" for="p17d">d) Mezcla de retinol + peróxido de benzoilo</label></div>
            </div>

            <div class="test-question">
                <p>3. ¿Cómo registras los avances de tu cliente?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_18" id="p18a" value="a"><label class="form-check-label" for="p18a">a) Fotos antes/después</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_18" id="p18b" value="b"><label class="form-check-label" for="p18b">b) Notas escritas en ficha</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_18" id="p18c" value="c"><label class="form-check-label" for="p18c">c) Medición de sebo (si dispones de equipo)</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_18" id="p18d" value="d"><label class="form-check-label" for="p18d">d) No registro formalmente</label></div>
            </div>

            <div class="test-question">
                <p>4. Cuando un protocolo provoca irritación, ¿qué haces?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_19" id="p19a" value="a"><label class="form-check-label" for="p19a">a) Reduzco frecuencia y aplico calmantes</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_19" id="p19b" value="b"><label class="form-check-label" for="p19b">b) Suspendo todo el protocolo</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_19" id="p19c" value="c"><label class="form-check-label" for="p19c">c) Cambio a un método físico suave</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_19" id="p19d" value="d"><label class="form-check-label" for="p19d">d) Continúo igual para “acostumbrar” la piel</label></div>
            </div>

            <div class="test-question">
                <p>5. Si un cliente no mejora tras varias sesiones, ¿cuál es tu siguiente paso?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_20" id="p20a" value="a"><label class="form-check-label" for="p20a">a) Revisar ingredientes y ajustar dosis</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_20" id="p20b" value="b"><label class="form-check-label" for="p20b">b) Aumentar concentración de activos</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_20" id="p20c" value="c"><label class="form-check-label" for="p20c">c) Cambiar completamente de abordaje</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_20" id="p20d" value="d"><label class="form-check-label" for="p20d">d) Referir a un dermatólogo</label></div>
            </div>

            <h2>Test Medio Autopercepción de competencias</h2>

            <div class="test-question">
                <p>1. ¿Cómo valoras tu confianza mezclando activos (ej. Vitamina C + Niacinamida)?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_21" id="p21a" value="a"><label class="form-check-label" for="p21a">a) 1–2 (baja)</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_21" id="p21b" value="b"><label class="form-check-label" for="p21b">b) 3 (media)</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_21" id="p21c" value="c"><label class="form-check-label" for="p21c">c) 4 (alta)</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_21" id="p21d" value="d"><label class="form-check-label" for="p21d">d) 5 (muy alta)</label></div>
            </div>

            <div class="test-question">
                <p>2. ¿Con qué frecuencia actualizas tus conocimientos sobre ingredientes o técnicas?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_22" id="p22a" value="a"><label class="form-check-label" for="p22a">a) Mensual</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_22" id="p22b" value="b"><label class="form-check-label" for="p22b">b) Trimestral</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_22" id="p22c" value="c"><label class="form-check-label" for="p22c">c) Anual</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_22" id="p22d" value="d"><label class="form-check-label" for="p22d">d) Nunca</label></div>
            </div>

            <div class="test-question">
                <p>3. ¿Has personalizado un protocolo para una condición particular (rosácea, hiperpigmentación…)?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_23" id="p23a" value="a"><label class="form-check-label" for="p23a">a) Sí, varias veces</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_23" id="p23b" value="b"><label class="form-check-label" for="p23b">b) Una vez</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_23" id="p23c" value="c"><label class="form-check-label" for="p23c">c) Nunca</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_23" id="p23d" value="d"><label class="form-check-label" for="p23d">d) No lo considero necesario</label></div>
            </div>

            <div class="test-question">
                <p>4. ¿Qué criterio principal usas para evaluar la compatibilidad de dos productos en un mismo protocolo?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_24" id="p24a" value="a"><label class="form-check-label" for="p24a">a) pH similar</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_24" id="p24b" value="b"><label class="form-check-label" for="p24b">b) Misma marca</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_24" id="p24c" value="c"><label class="form-check-label" for="p24c">c) Opinión de colegas</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_24" id="p24d" value="d"><label class="form-check-label" for="p24d">d) No evalúo compatibilidad técnica</label></div>
            </div>

            <div class="test-question">
                <p>5. ¿En qué área te gustaría recibir más formación práctica?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_25" id="p25a" value="a"><label class="form-check-label" for="p25a">a) Formulación de sueros</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_25" id="p25b" value="b"><label class="form-check-label" for="p25b">b) Aparatología intermedia (RF, ultrasonido…)</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_25" id="p25c" value="c"><label class="form-check-label" for="p25c">c) Diagnóstico de manchas y pigmentación</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_25" id="p25d" value="d"><label class="form-check-label" for="p25d">d) Gestión y marketing de servicios</label></div>
            </div>


            <h2>Test Medio Planificación y seguimiento</h2>

            <div class="test-question">
                <p>1. Al planificar una mesoterapia virtual, ¿por dónde comienzas?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_26" id="p26a" value="a"><label class="form-check-label" for="p26a">a) Evaluación de tipo de piel y objetivos</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_26" id="p26b" value="b"><label class="form-check-label" for="p26b">b) Selección de aparatología adecuada</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_26" id="p26c" value="c"><label class="form-check-label" for="p26c">c) Definición de presupuesto del cliente</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_26" id="p26d" value="d"><label class="form-check-label" for="p26d">d) Preparación del espacio de trabajo</label></div>
            </div>

            <div class="test-question">
                <p>2. ¿Qué herramienta usas para medir la satisfacción del cliente tras el servicio?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_27" id="p27a" value="a"><label class="form-check-label" for="p27a">a) Encuesta en papel</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_27" id="p27b" value="b"><label class="form-check-label" for="p27b">b) Formulario online</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_27" id="p27c" value="c"><label class="form-check-label" for="p27c">c) Feedback verbal directo</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_27" id="p27d" value="d"><label class="form-check-label" for="p27d">d) No suelo medir satisfacción</label></div>
            </div>

            <div class="test-question">
                <p>3. ¿Cómo ajustas dosis y frecuencia de un activo a lo largo de varias sesiones?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_28" id="p28a" value="a"><label class="form-check-label" for="p28a">a) Según tolerancia del cliente</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_28" id="p28b" value="b"><label class="form-check-label" for="p28b">b) Siempre al máximo nivel recomendado</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_28" id="p28c" value="c"><label class="form-check-label" for="p28c">c) Nunca lo ajusto</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_28" id="p28d" value="d"><label class="form-check-label" for="p28d">d) Basado en mi intuición</label></div>
            </div>

            <div class="test-question">
                <p>5. ¿Has impartido demostraciones o mini-clases internas sobre protocolos?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_29" id="p29a" value="a"><label class="form-check-label" for="p29a">a) Sí, con contenidos estructurados</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_29" id="p29b" value="b"><label class="form-check-label" for="p29b">b) Sí, de forma informal</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_29" id="p29c" value="c"><label class="form-check-label" for="p29c">c) No, pero me gustaría</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_29" id="p29d" value="d"><label class="form-check-label" for="p29d">d) No me interesa</label></div>
            </div>

            <div class="test-question">
                <p>5. ¿Cómo enseñas a los clientes a mantener resultados en casa?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_30" id="p30a" value="a"><label class="form-check-label" for="p30a">a) Manual escrito con pasos claros</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_30" id="p30b" value="b"><label class="form-check-label" for="p30b">b) Video tutorial personalizado</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_30" id="p30c" value="c"><label class="form-check-label" for="p30c">c) Explicación verbal detallada</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_30" id="p30d" value="d"><label class="form-check-label" for="p30d">d) No ofrezco guía para el hogar</label></div>
            </div>


            <button type="submit" class="btn btn-primary">Enviar respuestas</button>
         </form>

@endsection

@section('js')



@endsection

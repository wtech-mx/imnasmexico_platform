@extends('user.test.layout')

@section('content')

         <form id="form-cuestionario" class="test-container" data-nivel="medio">

            <h2>Test Nivel Medio</h2>

            <div class="test-question">
                <p>1. ¿Cuál es el mecanismo principal de acción de los AHA como el ácido glicólico?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1a" value="a"><label class="form-check-label" for="p1a">a) Inhibición de la tirosinasa</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1b" value="b"><label class="form-check-label" for="p1b">b) Estimulación de la síntesis de colágeno</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1c" value="c"><label class="form-check-label" for="p1c">c) Disolución de lípidos intercelulares</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1d" value="d"><label class="form-check-label" for="p1d">d) Exfoliación de la capa córnea</label></div>
            </div>

            <div class="test-question">
                <p>2. Para diseñar un protocolo en piel grasa con acné activo, ¿qué ingrediente es más adecuado?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2s" id="p2a" value="a"><label class="form-check-label" for="p2a">a) Ácido linoleico</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2s" id="p2b" value="b"><label class="form-check-label" for="p2b">b) Ácido salicílico</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2s" id="p2c" value="c"><label class="form-check-label" for="p2c">c) Ácido hialurónico</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2s" id="p2d" value="d"><label class="form-check-label" for="p2d">d) Factor de crecimiento epidérmico</label></div>
            </div>

            <div class="test-question">
                <p>3. La combinación más segura para evitar irritación es:</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3a" value="a"><label class="form-check-label" for="p3a">a) Retinol + AHA concentrado</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3b" value="b"><label class="form-check-label" for="p3b">b) Niacinamida + Vitamina C estable</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3c" value="c"><label class="form-check-label" for="p3c">c) BHA + Peróxido de benzoilo</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3d" value="d"><label class="form-check-label" for="p3d">d) Alfa hidroxiácidos + BHA a pH muy bajo</label></div>
            </div>

            <div class="test-question">
                <p>4. ¿Qué factor debes evaluar primero al planear un tratamiento para piel grasa?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4a" value="a"><label class="form-check-label" for="p4a">a) Color de la piel</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4b" value="b"><label class="form-check-label" for="p4b">b) Cantidad de grasa (sebo) que produce la piel</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4c" value="c"><label class="form-check-label" for="p4c">c) Textura del cabello</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4d" value="d"><label class="form-check-label" for="p4d">d) Tono de labial favorito</label></div>
            </div>

            <div class="test-question">
                <p>5. El péptido Matrixyl se emplea principalmente para:</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5a" value="a"><label class="form-check-label" for="p5a">a) Limpieza profunda</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5b" value="b"><label class="form-check-label" for="p5b">b) Mejorar la firmeza y reducir arrugas</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5c" value="c"><label class="form-check-label" for="p5c">c) Controlar la grasa</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5d" value="d"><label class="form-check-label" for="p5d">d) Aclarar manchas</label></div>
            </div>

            <div class="test-question">
                <p>6. Para piel mixta con zonas grasas y secas, ¿qué tipo de hidratante es más indicado?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_6" id="p6a" value="a"><label class="form-check-label" for="p6a">a) Crema muy rica en aceites</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_6" id="p6b" value="b"><label class="form-check-label" for="p6b">b) Gel ligero y no comedogénico</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_6" id="p6c" value="c"><label class="form-check-label" for="p6c">c) Aceite facial puro</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_6" id="p6d" value="d"><label class="form-check-label" for="p6d">d) Manteca corporal</label></div>
            </div>

            <div class="test-question">
                <p>7. ¿Cuándo es mejor aplicar un suero de vitamina C en tu rutina diaria?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_7" id="p7a" value="a"><label class="form-check-label" for="p7a">a) Después de la limpieza y antes del protector solar</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_7" id="p7b" value="b"><label class="form-check-label" for="p7b">b) Antes de la limpieza</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_7" id="p7c" value="c"><label class="form-check-label" for="p7c">c) Después de un peeling fuerte</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_7" id="p7d" value="d"><label class="form-check-label" for="p7d">d) Al mismo tiempo que el retinol</label></div>
            </div>

            <div class="test-question">
                <p>8. ¿Qué es un sistema buffer en cosmética y cuál es su función principal?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_8" id="p8a" value="a"><label class="form-check-label" for="p8a">a) Exfoliantes que renuevan la capa córnea</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_8" id="p8b" value="b"><label class="form-check-label" for="p8b">b) Ácidos y bases débiles que mantienen estable el pH</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_8" id="p8c" value="c"><label class="form-check-label" for="p8c">c) Emoliente que aumenta la hidratación</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_8" id="p8d" value="d"><label class="form-check-label" for="p8d">d) Sustancia que aumenta la viscosidad</label></div>
            </div>

            <div class="test-question">
                <p>9. En un protocolo mixto, ¿cuál sería la mejor secuencia de aplicación?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_9" id="p9a" value="a"><label class="form-check-label" for="p9a">a) Limpiador → Exfoliante químico → Suero → Hidratación → SPF</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_9" id="p9b" value="b"><label class="form-check-label" for="p9b">b) Limpiador → Suero → Peeling físico → Crema</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_9" id="p9c" value="c"><label class="form-check-label" for="p9c">c) Peeling químico → Limpiador → Hidratación → SPF</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_9" id="p9d" value="d"><label class="form-check-label" for="p9d">d) Hidratante → Suero → Tónico → SPF</label></div>
            </div>

            <div class="test-question">
                <p>10. Para pieles sensibles con rojeces, se recomienda evitar:</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_10" id="p10a" value="a"><label class="form-check-label" for="p10a">a) Niacinamida</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_10" id="p10b" value="b"><label class="form-check-label" for="p10b">b) Extracto de centella asiática</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_10" id="p10c" value="c"><label class="form-check-label" for="p10c">c) AHA/BHA concentrados</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_10" id="p10d" value="d"><label class="form-check-label" for="p10d">d) Péptidos calmantes</label></div>
            </div>

            <button type="submit" class="btn btn-primary">Enviar respuestas</button>
         </form>

@endsection
@section('js')


@endsection

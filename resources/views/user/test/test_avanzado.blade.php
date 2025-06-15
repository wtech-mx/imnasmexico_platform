@extends('user.test.layout')

@section('content')
         <form id="form-cuestionario" class="test-container" data-nivel="avanzado">

            <h2>Test Nivel Avanzado</h2>

            <div class="test-question">
                <p>1. ¿Qué ventaja ofrece la tecnología liposomal en la administración tópica de activos en cosmiatría?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1a" value="a"><label class="form-check-label" for="p1a">a) Mejora la penetración profunda y la liberación controlada</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1b" value="b"><label class="form-check-label" for="p1b">b) Aumenta el pH del producto</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1c" value="c"><label class="form-check-label" for="p1c">c) Incrementa el tamaño de partícula para mayor retención en superficie</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_1" id="p1d" value="d"><label class="form-check-label" for="p1d">d) Actúa como tensioactivo para espumar</label></div>
            </div>

            <div class="test-question">
                <p>2. ¿Qué interacción es potencialmente conflictiva si se aplica retinoides y BHA a la vez?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2a" value="a"><label class="form-check-label" for="p2a">a) Reducción de actividad exfoliante</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2b" value="b"><label class="form-check-label" for="p2b">b) Aumento de irritación y descamación</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2c" value="c"><label class="form-check-label" for="p2c">c) Neutralización del pH de la piel</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2d" value="d"><label class="form-check-label" for="p2d">d) Mejora de la penetración</label></div>
            </div>

            <div class="test-question">
                <p>3. ¿Qué son las telangiectasias en el contexto de la piel?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3a" value="a"><label class="form-check-label" for="p3a">a) Depósitos de grasa subcutánea</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3b" value="b"><label class="form-check-label" for="p3b">b) Dilataciones permanentes de pequeños vasos sanguíneos superficiales</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3c" value="c"><label class="form-check-label" for="p3c">c) Áreas de queratinización excesiva</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_3" id="p3d" value="d"><label class="form-check-label" for="p3d">d) Depósitos de melanina en la dermis</label></div>
            </div>

            <div class="test-question">
                <p>4. ¿Cuál de las siguientes combinaciones de luz LED y su efecto es CORRECTA en tratamientos faciales?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4a" value="a"><label class="form-check-label" for="p4a">a) Rojo (630 nm): estimula síntesis de colágeno / Azul (415 nm): acción antibacteriana</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4b" value="b"><label class="form-check-label" for="p4b">b) Rojo: reduce inflamación bacteriana / Azul: mejora microcirculación</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4c" value="c"><label class="form-check-label" for="p4c">c) Verde: estimula colágeno / Amarillo: acción antibacteriana</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_4" id="p4d" value="d"><label class="form-check-label" for="p4d">d) Naranja: exfoliación / Violeta: hidratación</label></div>
            </div>

            <div class="test-question">
                <p>5. Para minimizar la fotosensibilidad al usar AHA, es imprescindible:</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5a" value="a"><label class="form-check-label" for="p5a">a) Combinar con peróxido de benzoilo</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5b" value="b"><label class="form-check-label" for="p5b">b) Usar siempre SPF 50+ después del protocolo</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5c" value="c"><label class="form-check-label" for="p5c">c) Aplicar durante el día sin protector</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_5" id="p5d" value="d"><label class="form-check-label" for="p5d">d) Emplear BHA simultáneo</label></div>
            </div>

            <div class="test-question">
                <p>6. ¿Cuál es el efecto principal de la radiofrecuencia en la dermis?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_6" id="p6a" value="a"><label class="form-check-label" for="p6a">a) Estimula la neocolagénesis y remodelación del colágeno</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_6" id="p6b" value="b"><label class="form-check-label" for="p6b">b) Exfolia la capa córnea</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_6" id="p6c" value="c"><label class="form-check-label" for="p6c">c) Bloquea receptores ultravioleta</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_6" id="p6d" value="d"><label class="form-check-label" for="p6d">d) Inhibe la melanogénesis</label></div>
            </div>

            <div class="test-question">
                <p>7. ¿Cuál es la función principal del extracto de caviar en cosmética?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_7" id="p7a" value="a"><label class="form-check-label" for="p7a">a) Estimula la regeneración celular y mejora la firmeza</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_7" id="p7b" value="b"><label class="form-check-label" for="p7b">b) Protege frente a los rayos UV</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_7" id="p7c" value="c"><label class="form-check-label" for="p7c">c) Controla la producción de sebo</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_7" id="p7d" value="d"><label class="form-check-label" for="p7d">d) Exfolia químicamente la piel</label></div>
            </div>

            <div class="test-question">
                <p>8. ¿Cuál es la principal ventaja de los ésteres lipofílicos de vitamina C (por ejemplo, palmitato de ascorbilo) en tratamientos cosmiátricos?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_8" id="p8a" value="a"><label class="form-check-label" for="p8a">a) Mayor estabilidad frente a la oxidación y mejor penetración</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_8" id="p8b" value="b"><label class="form-check-label" for="p8b">b) Elevado pH que reduce irritación</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_8" id="p8c" value="c"><label class="form-check-label" for="p8c">c) Menor tolerancia en pieles sensibles</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_8" id="p8d" value="d"><label class="form-check-label" for="p8d">d) Efecto exfoliante adicional</label></div>
            </div>

            <div class="test-question">
                <p>9. ¿Cuál es la causa más frecuente de hiperpigmentación postinflamatoria tras un peeling químico?</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_9" id="p9a" value="a"><label class="form-check-label" for="p9a">a) Exposición solar sin protección</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_9" id="p9b" value="b"><label class="form-check-label" for="p9b">b) Activación excesiva de melanocitos por la inflamación</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_9" id="p9c" value="c"><label class="form-check-label" for="p9c">c) Acumulación de lípidos en la epidermis</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_9" id="p9d" value="d"><label class="form-check-label" for="p9d">d) Deshidratación profunda</label></div>
            </div>

            <div class="test-question">
                <p>10. Un ejemplo de contraindicación absoluta sería:</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_10" id="p10a" value="a"><label class="form-check-label" for="p10a">a) Usar retinoides en embarazo</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_10" id="p10b" value="b"><label class="form-check-label" for="p10b">b) Aplicar ácido hialurónico en piel seca</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_10" id="p10c" value="c"><label class="form-check-label" for="p10c">c) Combinar SPF con antioxidantes</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_10" id="p10d" value="d"><label class="form-check-label" for="p10d">d) Emplear AHA en piel con melasma leve</label></div>
            </div>

            <button type="submit" class="btn btn-primary">Enviar respuestas</button>
         </form>

@endsection

@section('js')



@endsection

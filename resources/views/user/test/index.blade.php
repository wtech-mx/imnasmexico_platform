@extends('user.test.layout')

@section('content')
         <form id="form-cuestionario" class="test-container" data-nivel="basico">

            <h2>Test Nivel Básico Teorico</h2>

            <div class="test-question">
                <p>1. ¿Cuál es la función principal del ácido hialurónico en el cuidado de la piel?</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_1" value="a" id="p1a">
                    <label class="form-check-label" for="p1a">a) Exfoliar químicamente las células muertas</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_1" value="b" id="p1b">
                    <label class="form-check-label" for="p1b">b) Aportar hidratación y relleno de arrugas</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_1" value="c" id="p1c">
                    <label class="form-check-label" for="p1c">c) Actuar como agente antiséptico</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_1" value="d" id="p1d">
                    <label class="form-check-label" for="p1d">d) Proteger frente a los rayos UV</label>
                </div>
            </div>

            <div class="test-question">
                <p>2. ¿Cuál de estos productos correspondería a la fase de “protección” en una rutina facial?</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_2" value="a" id="p2a">
                    <label class="form-check-label" for="p2a">a) Tónico equilibrante</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_2" value="b" id="p2b">
                    <label class="form-check-label" for="p2b">b) Crema hidratante con péptidos</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_2" value="c" id="p2c">
                    <label class="form-check-label" for="p2c">c) Protector solar SPF 30</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_2" value="d" id="p2d">
                    <label class="form-check-label" for="p2d">d) Exfoliante enzimático</label>
                </div>
            </div>

            <div class="test-question">
                <p>3. La barrera cutánea está compuesta principalmente por:</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_3" value="a" id="p3a">
                    <label class="form-check-label" for="p3a">a) Colágeno y elastina</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_3" value="b" id="p3b">
                    <label class="form-check-label" for="p3b">b) Queratinocitos y lípidos intercelulares</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_3" value="c" id="p3c">
                    <label class="form-check-label" for="p3c">c) Ácido salicílico y glicólico</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_3" value="d" id="p3d">
                    <label class="form-check-label" for="p3d">d) Melanina y hemoglobina</label>
                </div>
            </div>

            <div class="test-question">
                <p>4. ¿Qué producto se emplea para eliminar impurezas y suciedad del rostro?</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_4" id="p4a" value="a">
                    <label class="form-check-label" for="p4a">a) Limpiador facial</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_4" id="p4b" value="b">
                    <label class="form-check-label" for="p4b">b) Crema antiarrugas</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_4" id="p4c" value="c">
                    <label class="form-check-label" for="p4c">c) Protector solar</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_4" id="p4d" value="d">
                    <label class="form-check-label" for="p4d">d) Suero antioxidante</label>
                </div>
            </div>

            <div class="test-question">
                <p>5. ¿Cuál es el paso que sigue inmediatamente después de limpiar la piel?</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_5" id="p5a" value="a">
                    <label class="form-check-label" for="p5a">a) Exfoliación mecánica</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_5" id="p5b" value="b">
                    <label class="form-check-label" for="p5b">b) Hidratación con crema o gel</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_5" id="p5c" value="c">
                    <label class="form-check-label" for="p5c">c) Peeling químico</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_5" id="p5d" value="d">
                    <label class="form-check-label" for="p5d">d) Uso de mascarilla</label>
                </div>
            </div>

            <div class="test-question">
                <p>6. ¿Con qué frecuencia se recomienda aplicar protector solar?</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_6" id="p6a" value="a">
                    <label class="form-check-label" for="p6a">a) Cada mañana</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_6" id="p6b" value="b">
                    <label class="form-check-label" for="p6b">b) Una vez al mes</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_6" id="p6c" value="c">
                    <label class="form-check-label" for="p6c">c) Cada noche</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_6" id="p6d" value="d">
                    <label class="form-check-label" for="p6d">d) Cada año</label>
                </div>
            </div>

            <div class="test-question">
                <p>7. La función primaria de un tónico facial es:</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_7" id="p7a" value="a">
                    <label class="form-check-label" for="p7a">a) Desinfectar profundamente</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_7" id="p7b" value="b">
                    <label class="form-check-label" for="p7b">b) Restablecer el pH tras la limpieza</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_7" id="p7c" value="c">
                    <label class="form-check-label" for="p7c">c) Exfoliar mecánicamente</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_7" id="p7d" value="d">
                    <label class="form-check-label" for="p7d">d) Aportar factor de crecimiento</label>
                </div>
            </div>

            <div class="test-question">
                <p>8. ¿Cuál es el primer paso de una rutina de cuidado facial?</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_8" id="p8a" value="a">
                    <label class="form-check-label" for="p8a">a) Limpiar</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_8" id="p8b" value="b">
                    <label class="form-check-label" for="p8b">b) Hidratar</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_8" id="p8c" value="c">
                    <label class="form-check-label" for="p8c">c) Exfoliar</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_8" id="p8d" value="d">
                    <label class="form-check-label" for="p8d">d) Proteger</label>
                </div>
            </div>

            <div class="test-question">
                <p>9. ¿Qué indica que una piel está deshidratada?</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_9" id="p9a" value="a">
                    <label class="form-check-label" for="p9a">a) Falta de agua</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_9" id="p9b" value="b">
                    <label class="form-check-label" for="p9b">b) Exceso de grasa</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_9" id="p9c" value="c">
                    <label class="form-check-label" for="p9c">c) Manchas oscuras</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_9" id="p9d" value="d">
                    <label class="form-check-label" for="p9d">d) Aumento de elastina</label>
                </div>
            </div>

            <div class="test-question">
                <p>10. ¿Qué acción se recomienda realizar una vez a la semana?</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_10" id="p10a" value="a">
                    <label class="form-check-label" for="p10a">a) Aplicar protector solar</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_10" id="p10b" value="b">
                    <label class="form-check-label" for="p10b">b) Hidratar</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_10" id="p10c" value="c">
                    <label class="form-check-label" for="p10c">c) Exfoliar suavemente</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_10" id="p10d" value="d">
                    <label class="form-check-label" for="p10d">d) Usar suero anti-edad</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Enviar respuestas</button>

    </form>

@endsection

@section('js')


@endsection


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TEST COSMICA</title>
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
            <h2>Test Nivel Básico</h2>

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
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2a" value="a"><label class="form-check-label" for="p2a">a) Ácido linoleico</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2b" value="b"><label class="form-check-label" for="p2b">b) Ácido salicílico</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2c" value="c"><label class="form-check-label" for="p2c">c) Ácido hialurónico</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="pregunta_2" id="p2d" value="d"><label class="form-check-label" for="p2d">d) Factor de crecimiento epidérmico</label></div>
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
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>

</html>



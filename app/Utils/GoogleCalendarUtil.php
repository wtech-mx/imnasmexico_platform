<?php

use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;

function GoogleCalendarUtil($nombreCurso, $fechaInicio, $fechaFin, $idProfesor, $idCurso) {
    $client = new Google_Client();
    // Configura las credenciales obtenidas desde la consola de desarrolladores de Google
    $client->setAccessToken('AIzaSyA-8zwrW2RCdYbKcYuZ_62JEYbtgoaD_OY');

    $calendarService = new Google_Service_Calendar($client);

    $evento = new Google_Service_Calendar_Event([
        'summary' => $nombreCurso,
        'start' => [
            'dateTime' => $fechaInicio,
            'timeZone' => 'America/Mexico_City',
        ],
        'end' => [
            'dateTime' => $fechaFin,
            'timeZone' => 'America/Mexico_City',
        ],
    ]);

    // Crea el evento en Google Calendar
    $calendarService->events->insert('primary', $evento);
}

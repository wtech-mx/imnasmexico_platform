@extends('layouts.app_profesor')

@section('template_title')
    Inicio
@endsection

@section('main')
    bg-main
@endsection

@section('css_custom')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
@endsection

@section('content')

<div class="row bg-main">
    <div class="col-12 mb-sm-0 col-md-12 col-md-3 col-lg-6 mb-lg-5">
        <h3 class="tittle_dash mt-5 mb-5 mt-lg-3 mb-lg-3">Hola buen dia: {{Auth::user()->name}}</h3>
        <div class="content_fullcalendar">
            <div id='calendar'></div>
        </div>
    </div>

    <div class="col-12 mt-3 col-md-12 mt-md-5 mb-5 col-md-3 col-lg-6 d-flex">
        <div class="d-flex align-items-center">
            <div class="container_card_class">
                <div class="d-flex justify-content-evenly">
                    <a href="{{ route('clase.index') }}" style="display: contents;">
                        <img src="{{asset('assets/user/icons/meeting.webp')}}" alt="" style="width: 10%;">
                    </a>
                    <a href="{{ route('clase.index') }}" style="text-decoration: none;color:#000;">
                        <h2>Mis clases</h2>
                    </a>
                    @if ($cursos == NULL)
                        <h2>0</h2>
                    @else
                        <h2><strong>{{ $cursos }}</strong></h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    $(document).ready(function () {

    var SITEURL = "{{ url('/') }}";

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var calendar = $('#calendar').fullCalendar({
                        editable: false,
                        events: SITEURL + "/fullcalender",
                        displayEventTime: false,
                        editable: true,
                        eventRender: function (event, element, view) {
                            if (event.allDay === 'true') {
                                    event.allDay = true;
                            } else {
                                    event.allDay = false;
                            }
                        },
                        selectable: true,
                        selectHelper: true,
                        select: function (start, end, allDay) {
                            var title = prompt('Event Title:');
                            if (title) {
                                var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                                var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                                $.ajax({
                                    url: SITEURL + "/fullcalenderAjax",
                                    data: {
                                        title: title,
                                        start: start,
                                        end: end,
                                        type: 'add'
                                    },
                                    type: "POST",
                                    success: function (data) {
                                        displayMessage("Event Created Successfully");

                                        calendar.fullCalendar('renderEvent',
                                            {
                                                id: data.id,
                                                title: title,
                                                start: start,
                                                end: end,
                                                allDay: allDay
                                            },true);

                                        calendar.fullCalendar('unselect');
                                    }
                                });
                            }
                        },
                        eventDrop: function (event, delta) {
                            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

                            $.ajax({
                                url: SITEURL + '/fullcalenderAjax',
                                data: {
                                    title: event.title,
                                    start: start,
                                    end: end,
                                    id: event.id,
                                    type: 'update'
                                },
                                type: "POST",
                                success: function (response) {
                                    displayMessage("Event Updated Successfully");
                                }
                            });
                        },
                        eventClick: function (event) {
                            var deleteMsg = confirm("Do you really want to delete?");
                            if (deleteMsg) {
                                $.ajax({
                                    type: "POST",
                                    url: SITEURL + '/fullcalenderAjax',
                                    data: {
                                            id: event.id,
                                            type: 'delete'
                                    },
                                    success: function (response) {
                                        calendar.fullCalendar('removeEvents', event.id);
                                        displayMessage("Event Deleted Successfully");
                                    }
                                });
                            }
                        }

                    });

    });

    function displayMessage(message) {
        toastr.success(message, 'Event');
    }

    </script>
@endsection



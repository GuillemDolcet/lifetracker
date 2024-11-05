// -- controllers/event_controller.js

import { Controller } from "@hotwired/stimulus"
import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import axios from "axios";

export default class extends Controller {

    static targets = [ "calendar" ];

    calendarTargetConnected(){
        const calendar = new Calendar(this.calendarTarget, {
            plugins: [ dayGridPlugin, timeGridPlugin, listPlugin ],
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            },
            events: this.fetchEvents,
            locale: document.documentElement.lang || 'en',
            firstDay: 1
        })
        calendar.render()
    }

    fetchEvents(info, successCallback, failureCallback) {
        axios.get('/events', {
            params: {
                start: info.startStr, // Fecha de inicio
                end: info.endStr      // Fecha de fin
            }
        })
            .then(function(response) {
                // Procesar la respuesta y pasar los eventos al calendario
                successCallback(response.data);
            })
            .catch(function(error) {
                console.error('Error al cargar eventos:', error);
                failureCallback(error);
            });
    }

    allDay() {

    }
}

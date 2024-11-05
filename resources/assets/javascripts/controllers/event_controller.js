// -- controllers/event_controller.js

import { Controller } from "@hotwired/stimulus"
import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';

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
            events: 'https://fullcalendar.io/demo-events.json?single-day&for-resource-timeline',
            locale: document.documentElement.lang || 'en',
            firstDay: 1
        })
        calendar.render()
    }
}

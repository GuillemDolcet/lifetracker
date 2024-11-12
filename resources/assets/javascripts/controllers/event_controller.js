// -- controllers/event_controller.js

import { Controller } from "@hotwired/stimulus"
import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import interactionPlugin from '@fullcalendar/interaction';
import SimpleToast from "../simple_toast";
import RemoteModal from "./remote_modal_controller.js";
import {xr} from "../xr.js";
import {renderStreamMessage} from "@hotwired/turbo";

export default class extends Controller {

    static targets = [ "calendar", "form" ];

    calendarTargetConnected(){
        let that = this;
        window.calendar = new Calendar(this.calendarTarget, {
            plugins: [ dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin ],
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            },
            editable: true,
            dayMaxEvents: true,
            selectable: true,
            events: this.fetchEvents,
            locale: document.documentElement.lang || 'en',
            timeZone: 'Europe/Madrid',
            contentHeight: 'auto',
            firstDay: 1,
            eventDrop: this.handleEventDropAndResize,
            eventResize: this.handleEventDropAndResize,
            select: function(info) {
                console.log(info)
                that.openModal(null, info.startStr, info.endStr);
            },
            eventClick: function(info) {
                info.jsEvent.preventDefault();

                if (info.event.id) {
                    that.openModal(info.event.id);
                }
            }
        })
        window.calendar.render()
    }

    fetchEvents(info, successCallback, failureCallback) {
        let params = new URLSearchParams({
            start: info.startStr,
            end: info.endStr
        })

        try {
            xr.get('/events?' + params)
                .then(async function (rsp) {
                    let response = await rsp.json()
                    successCallback(response);
                })
        } catch (error) {
            failureCallback(error)
        }
    }

    handleEventDropAndResize(info) {
        let updatedEvent = {
            start_date: info.event.start.toISOString(),
            end_date: info.event.end ? info.event.end.toISOString() : null
        };

        try {
            xr.json().put(`/events/${info.event.id}/dates`, {body: JSON.stringify(updatedEvent)})
                .then(async rsp => {
                    let response = await rsp.json()
                    if (response.status === 'error') {
                        SimpleToast.show(response.status, response.message)
                        info.revert();
                    }
                });
        } catch {
            SimpleToast.show('error')
            info.revert();
        }
    }

    openModal(id, start, end) {
        let modal = new RemoteModal();
        modal.targetValue = '#event-form-modal';
        let params = new URLSearchParams({
            start: start,
            end: end
        })
        modal.urlValue = '/events/create?' + params;
        if (id) {
            modal.urlValue = `/events/${id}/edit`;
        }
        modal.toggle();
    }

    async submitForm(){
        const url = this.element.getAttribute("action"), data = new FormData(this.element)

        try {
            const response = await xr.turbo().post(url, {body: data})

            if (!response.ok) {
                let translation = await xr.get('/translations/general.errors.request')
                throw new Error(await translation.text())
            }

            if (!response.redirected) {
                $('.btn-close').click();
            } else {
                const html = await response.text()
                renderStreamMessage(html)
                return
            }

            let json = await response.json()

            let eventData = json.data

            let existingEvent = window.calendar.getEventById(eventData.id)

            if (existingEvent) {
                existingEvent.setProp('title', eventData.title);
                existingEvent.setDates(eventData.start, eventData.end);
                existingEvent.setProp('color', eventData.color);
            } else {
                window.calendar.addEvent({
                    id: eventData.id,
                    title: eventData.title,
                    start: eventData.start,
                    end: eventData.end,
                    description: eventData.description,
                });
            }

            SimpleToast.show(json.status, json.message)
        } catch (err) {
            SimpleToast.show('error', err.message)
        }
    }
}

// -- controllers/form_controller.js

import { Controller } from "@hotwired/stimulus"
import { renderStreamMessage, visit } from "@hotwired/turbo";
import SimpleToast from "../simple_toast";
import { xr } from "../xr";
import Litepicker from 'litepicker';

export default class extends Controller {

    static targets = [ "select2", "datepicker" ];

    submit(e) {
        e.preventDefault();

        if (this.iamForm() && this.confirmed()) {
            this.element.submit()
        }

        return false;
    }

    select2TargetConnected(){
        this.select2Targets.forEach( function(select) {
            $(select).select2({
                dropdownParent: $('.modal'),
                width: '100%',
            });
            $(select).on('select2:select', function () {
                let event = new Event('change', { bubbles: true })
                this.dispatchEvent(event);
            });
        });
    }

    async datepickerTargetConnected() {
        let translation = await xr.get('/translations/general.clear')

        let text = await translation.text();

        let lang = $('html').attr('lang');

        this.datepickerTargets.forEach(function (datepicker) {
            datepicker = new Litepicker({
                element: datepicker,
                lang: lang,
                singleMode: $(datepicker).data('single-mode'),
                dropdowns: {
                    minYear: new Date().getFullYear() - 50,
                    maxYear: new Date().getFullYear() + 50,
                    months: true,
                    years: true
                },
                parentEl: $(datepicker).closest('.modal').get(0),
                format: "DD-MM-YYYY",
                resetButton: () => {
                    let btn = document.createElement('button');
                    btn.innerText = text;
                    btn.addEventListener('click', (evt) => {
                        $(datepicker).val('');
                    });
                    return btn;
                },
                buttonText: {
                    previousMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                    nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
                }
            });
            datepicker.on('selected', (date) => {
                $('.litepicker').hide();
            });
        });
    }

    async submitRemote(e) {
        e.preventDefault()

        if (this.iamForm() && this.confirmed()) {
            const url = this.element.action, data = new FormData(this.element)

            try {
                const response = await xr.turbo().post(url, {body: data})

                if (!response.ok) {
                    let translation = await xr.get('/translations/general.errors.request')
                    throw new Error(await translation.text())
                }

                if (response.redirected) {
                    return visit(response.url, {action: 'replace'})
                }

                const html = await response.text()
                renderStreamMessage(html)
            } catch (err) {
                SimpleToast.show('error', err.message)
            }
        }

        return false
    }

    iamForm() {
        return this.element && this.element.tagName === 'FORM'
    }

    confirmed() {
        const message = this.element.dataset.confirm

        if (message) {
            return confirm(message)
        }

        return true
    }

    async fileInputChange(e) {
        if (!this.checkFileSize()) {
            let translation = await xr.get('/translations/general.errors.filesize')

            SimpleToast.show('error', await translation.text())

            e.target.value = "";
        }
    }

    checkFileSize(){
        const maxSize = 49 * 1024 * 1024; // 49 MB (Current MAX of php server is 50MB)
        let totalSize = 0;

        const fileInputs = document.querySelectorAll('input[type="file"]');

        fileInputs.forEach(input => {
            Array.from(input.files).forEach(file => {
                totalSize += file.size;
            });
        });

        return totalSize <= maxSize;
    }

    async selectAction(e) {
        e.preventDefault()
        try {
            let target = $(e.target).closest('div').find('select');

            if (target.val() == null || target.val() === '') {
                return false;
            }

            let url = target.data('url').replace('value', target.val());

            const response = await xr.turbo().get(url);

            if (!response.ok) {
                let translation = await xr.get('/translations/general.errors.request')
                throw new Error(await translation.text())
            }

            if (response.redirected) {
                return visit(response.url, {action: 'replace'})
            }

            target.find(`option[value="${target.val()}"]`).attr('disabled','disabled');

            target.val('').change();

            const html = await response.text()

            renderStreamMessage(html)
        } catch (err) {
            SimpleToast.show('error', err.message)
        }
    }

    remove({ params: { id, select, option } }) {
        let selectTarget = $('#' + select);

        selectTarget.find(`option[value="${option}"]`).removeAttr('disabled');

        $('#' + id).remove()
    }
}

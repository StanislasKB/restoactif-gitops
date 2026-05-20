$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function updateEvent(id, startDate, endDate) {
    console.log('id',id)
    return $.ajax({
        url: `/compte/dashboard/evenements/${id}`, // Remplacez par l'URL de votre API pour les événements
        method: 'PUT',
        contentType: 'application/json',
        data: JSON.stringify({
            start_date: startDate,
            end_date: endDate
        }),
    });
}

function updateMenu(id, startDate, endDate) {
    return $.ajax({
        url: `/compte/dashboard/menus/${id}`, // Remplacez par l'URL de votre API pour les menus
        method: 'PUT',
        contentType: 'application/json',
        data: JSON.stringify({
            start_date: startDate,
            end_date: endDate
        }),
    });
}

function updateOffer(id, startDate, endDate) {
    return $.ajax({
        url: `/compte/dashboard/offres/${id}`, // Remplacez par l'URL de votre API pour les offres
        method: 'PUT',
        contentType: 'application/json',
        data: JSON.stringify({
            start_date: startDate,
            end_date: endDate
        }),
    });
}




class Calendar {
    constructor() {
        this.body = document.body;
        this.calendar = document.getElementById("calendar");
        this.formEvent = document.getElementById("forms-event");
        this.btnNewEvent = document.getElementById("btn-new-event");
        this.btnDeleteEvent = document.getElementById("btn-delete-event");
        this.btnSaveEvent = document.getElementById("btn-save-event");
        this.calendarObj = null;
        this.selectedEvent = null;
        this.newEventData = null;
    }

    onEventClick(e) {
        this.formEvent?.reset();
        this.formEvent.classList.remove("was-validated");
        this.newEventData = null;
        this.btnDeleteEvent.style.display = "block";
        this.selectedEvent = e.event;
        document.getElementById("event-title").value = this.selectedEvent.title;
        document.getElementById("event-category").value = this.selectedEvent.classNames[0];
    }

    fetchEvents() {
        return $.ajax({
            url: '/compte/dashboard/evenements/me', // Remplacez par l'URL de votre API pour les événements
            method: 'GET',
            dataType: 'json',
        }).then(data => {
            console.log('dss',data)
            // Transformation des données pour FullCalendar
            return data.events.map(event => ({
                id: event.id,
                title: event.title,
                start: event.start_date,
                end: event.end_date,
                classNames: 'bg-primary event' // Utilisation de 'type' comme classe
            }));
        });
    }

    fetchMenus() {
        return $.ajax({
            url: '/compte/dashboard/menus/me', // Remplacez par l'URL de votre API pour les menus
            method: 'GET',
            dataType: 'json',
        }).then(data => {
            // Transformation des données pour FullCalendar
            return data.menus.map(menu => ({
                id: menu.id,
                title: menu.name,
                start: menu.start_date,
                end: menu.end_date,
                classNames: 'bg-success menu' // Vous pouvez définir une classe spécifique pour les menus
            }));
        });
    }

    fetchOffers() {
        return $.ajax({
            url: '/compte/dashboard/offres/me', // Remplacez par l'URL de votre API pour les offres
            method: 'GET',
            dataType: 'json',
        }).then(data => {
            // Transformation des données pour FullCalendar
            return data.offers.map(offer => ({
                id: offer.id,
                title: offer.title,
                start: offer.start_date,
                end: offer.end_date,
                classNames: 'bg-warning offer' // Vous pouvez définir une classe spécifique pour les offres
            }));
        });
    }
    formatDate(date) {
        const d = new Date(date);
        const pad = (n) => n < 10 ? '0' + n : n;
        return `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(d.getDate())} ${pad(d.getHours())}:${pad(d.getMinutes())}:${pad(d.getSeconds())}`;
    }

    handleEventDrop(info) {
        const event = info.event;
        const id = event.id;
        const startDate = event.start ? this.formatDate(event.start) : null;
        const endDate = event.end ? this.formatDate(event.end) : null;
        let updateFunc;

        if (event.classNames.includes('event')) {
            updateFunc = updateEvent;
        } else if (event.classNames.includes('menu')) {
            updateFunc = updateMenu;
        } else if (event.classNames.includes('offer')) {
            updateFunc = updateOffer;
        }

        if (updateFunc) {
            updateFunc(id, startDate, endDate).then(() => {
            }).catch(error => {
                console.error('Error updating event:', error);
            });
        }
    }

    init() {
        const t = this;

        Promise.all([this.fetchEvents(), this.fetchMenus(), this.fetchOffers()])
            .then(results => {
                const allEvents = [].concat(...results);
                t.calendarObj = new FullCalendar.Calendar(t.calendar, {
                    plugins: [],
                    slotDuration: "00:30:00",
                    slotMinTime: "07:00:00",
                    slotMaxTime: "19:00:00",
                    themeSystem: "default",
                    buttonText: {
                        today: "Aujourd'hui",
                        month: "Mois",
                        week: "Semaine",
                        day: "Jour",
                        list: "Liste",
                        prev: "Préc",
                        next: "Suiv",
                    },
                    initialView: "dayGridMonth",
                    handleWindowResize: true,
                    height: window.innerHeight - 300,
                    headerToolbar: {
                        left: "prev,next today",
                        center: "title",
                        right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth",
                    },
                    initialEvents: allEvents,
                    editable: true,
                    droppable: true,
                    selectable: true,
                    eventClick: function (e) {
                        t.onEventClick(e);
                    },
                    eventDrop: function (info) {

                        t.handleEventDrop(info);
                    }
                });
                t.calendarObj.render();
            })
            .catch(error => {
                console.error('Error fetching events:', error);
            });
    }
}

document.addEventListener("DOMContentLoaded", function () {
    new Calendar().init();
});

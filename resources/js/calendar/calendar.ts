import {Calendar, CalendarOptions, EventInput, EventSourceInput} from 'fullcalendar';
import frLocale from '@fullcalendar/core/locales/fr';
import '../../sass/calendar/calendar.scss';

const createCalendar = (selector: string, options: CalendarOptions) => {
    const element: HTMLElement = document.querySelector(selector);
    options.events = setInvertedBackground(options);
    const defaultOptions: CalendarOptions = {
        locales: [frLocale],
        locale: 'fr',
        navLinks: true,
        eventBackgroundColor: 'red',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        eventTimeFormat: { // like '14:30:00'
            hour: '2-digit',
            minute: '2-digit',
            meridiem: false
        },
        droppable: true,
        displayEventEnd: true,
        height: '100%',
        eventClick: function(info) {
            info.jsEvent.preventDefault();
            if (info.event.url) {
                openModal(info.event.url, info.event.id);
            }
        },
        ...options,
    };
    return new Calendar(element, defaultOptions);
};

const getCalendarEventData = (options: CalendarOptions) => {
    return options;
}

const invertColor = (hex: string) =>  {
    if (hex.indexOf('#') === 0) {
        hex = hex.slice(1);
    }
    if (hex.length === 3) {
        hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
    }
    if (hex.length !== 6) {
        throw new Error('Invalid HEX color.');
    }
    let r = parseInt(hex.slice(0, 2), 16),
        g = parseInt(hex.slice(2, 4), 16),
        b = parseInt(hex.slice(4, 6), 16);

    return (r * 0.299 + g * 0.587 + b * 0.114) > 186
        ? '#000000'
        : '#FFFFFF';
}

const setInvertedBackground = (options: CalendarOptions): EventSourceInput => {
    let inverted = [];
    for(const event of options.events as EventInput[]){
        event.textColor = invertColor(event.backgroundColor);
        inverted = [...inverted, event];
    }
    return inverted;
}

const openModal = (modalClass: string, eventId: string) => {
    Livewire.emit('show-calendar-edit-modal',modalClass,eventId);
}

(<any>window).createCalendar = createCalendar;
(<any>window).getCalendarEventData = getCalendarEventData;
(<any>window).getCalendarEventData = getCalendarEventData;



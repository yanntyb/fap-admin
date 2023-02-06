import {Calendar, CalendarOptions} from 'fullcalendar';
import frLocale from '@fullcalendar/core/locales/fr';
import '../../sass/calendar/calendar.scss';


const createCalendar = (selector: string, options: CalendarOptions) => {
    const element: HTMLElement = document.querySelector(selector);
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
        displayEventEnd: true,
        height: '100%',
        ...options,
    };
    return new Calendar(element, defaultOptions);
};

(<any>window).createCalendar = createCalendar;



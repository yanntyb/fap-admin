import {Calendar, CalendarOptions} from 'fullcalendar'
import '../../sass/calendar/calendar.scss';


const createCalendar = (selector: string, options: CalendarOptions) => {
    const element: HTMLElement = document.querySelector(selector);
    const defaultOptions: CalendarOptions = {
        ...options,
        navLinks: true,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
    };
    return new Calendar(element, defaultOptions);
};

(<any>window).createCalendar = createCalendar;



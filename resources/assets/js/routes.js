import VueRouter from "vue-router";
import MeetingsIndex from './components/Meetings/MeetingsIndex'
import VenuesIndex from './components/Meetings/VenuesIndex'
import UsersIndex from './components/Meetings/UsersIndex'
import MeetingAdd from './components/Meetings/partials/MeetingAdd'
import MeetingEdit  from './components/Meetings/partials/MeetingEdit'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/meetings',
            name: 'meetings',
            component: MeetingsIndex,
        },
        {
            path: '/venues',
            name: 'venues',
            component: VenuesIndex,
        },
        {
            path: '/users',
            name: 'users',
            component: UsersIndex,
        },
        {
            path: '/add-meeting',
            name: 'addMeeting',
            component: MeetingAdd,
        },
        {
            path:'/edit_meeting',
            name: 'editMeeting',
            component: MeetingEdit,
            props: true
        }
    ],
});

export default router;
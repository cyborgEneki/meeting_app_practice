import VueRouter from "vue-router";
import MeetingsIndex from './components/Meetings/MeetingsIndex'
import VenuesIndex from './components/Meetings/VenuesIndex'
import UsersIndex from './components/Meetings/UsersIndex'
import MeetingAdd from './components/Meetings/partials/MeetingAdd'
import MeetingEdit  from './components/Meetings/partials/MeetingEdit'
import UserEdit  from './components/Meetings/partials/users/UserEdit'
import UserAdd  from './components/Meetings/partials/users/UserAdd'
import VenueAdd from './components/Meetings/partials/venues/VenueAdd'
import VenueEdit from './components/Meetings/partials/venues/VenueEdit'
import MeetingSeriesIndex from './components/Meetings/MeetingSeriesIndex'
import MeetingSeriesAdd from './components/Meetings/partials/meetingSeries/MeetingSeriesAdd'
import MeetingSeriesEdit from './components/Meetings/partials/meetingSeries/MeetingSeriesEdit'

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
            path: '/meeting_series',
            name: 'meetingSeries',
            component: MeetingSeriesIndex,
        },
        {
            path: '/add-meeting',
            name: 'addMeeting',
            component: MeetingAdd,
        },
        {
            path: '/add-user',
            name: 'addUser',
            component: UserAdd,
        },
        {
            path: '/add-venue',
            name: 'addVenue',
            component: VenueAdd,
        },
        {
            path: '/add-meeting-series',
            name: 'addMeetingSeries',
            component: MeetingSeriesAdd,
        },
        {
            path:'/edit_meeting',
            name: 'editMeeting',
            component: MeetingEdit,
            props: true
        },
        {
            path:'/edit_user',
            name: 'editUser',
            component: UserEdit,
            props: true
        },
        {
            path:'/edit_venue',
            name: 'editVenue',
            component: VenueEdit,
            props: true
        },
        {
            path:'/edit_meeting_series',
            name: 'editMeetingSeries',
            component: MeetingSeriesEdit,
            props: true
        },
    ],
});

export default router;
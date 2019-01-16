import VueRouter from "vue-router";
import MeetingsIndex from './components/Meetings/MeetingsIndex'
import VenuesIndex from './components/Meetings/VenuesIndex'
import UsersIndex from './components/Meetings/UsersIndex'
import MediaIndex from './components/Meetings/MediaIndex'
import MeetingTypeIndex from './components/Meetings/MeetingTypeIndex'
import MeetingSeriesIndex from './components/Meetings/MeetingSeriesIndex'
import MeetingSeriesDetails from './components/Meetings/MeetingSeriesDetails'
import MeetingAdd from './components/Meetings/partials/MeetingAdd'
import UserAdd  from './components/Meetings/partials/users/UserAdd'
import VenueAdd from './components/Meetings/partials/venues/VenueAdd'
import MeetingSeriesAdd from './components/Meetings/partials/meetingSeries/MeetingSeriesAdd'
import MeetingTypeAdd from './components/Meetings/partials/meetingTypes/MeetingTypeAdd'
import MediaAdd from './components/Meetings/partials/media/MediaAdd'
import MeetingEdit  from './components/Meetings/partials/MeetingEdit'
import UserEdit  from './components/Meetings/partials/users/UserEdit'
import VenueEdit from './components/Meetings/partials/venues/VenueEdit'
import MeetingSeriesEdit from './components/Meetings/partials/meetingSeries/MeetingSeriesEdit'
import MediaEdit from './components/Meetings/partials/media/MediaEdit'
import MeetingTypeEdit from './components/Meetings/partials/meetingTypes/MeetingTypeEdit'
import SearchResults from './components/Meetings/partials/SearchResults'

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
            children: [
                {
                    path: '/meeting-series-details/:id',
                    name: 'meetingSeriesDetails',
                    component: MeetingSeriesDetails,
                }
            ]
        },
        {
            path: '/medias',
            name: 'medias',
            component: MediaIndex,
        },
        {
            path: '/meeting_type',
            name: 'meetingTypes',
            component: MeetingTypeIndex,
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
            path: '/add-media',
            name: 'addMedia',
            component: MediaAdd,
        },
        {
            path: '/add-meeting_type',
            name: 'addMeetingType',
            component: MeetingTypeAdd,
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
        {
            path:'/edit_media',
            name: 'editMedia',
            component: MediaEdit,
            props: true
        },
        {
            path:'/edit_meeting_type',
            name: 'editMeetingType',
            component: MeetingTypeEdit,
            props: true
        },
        {
            path:'/meetings/searchresults',
            name: 'searchResults',
            component: SearchResults,
            props: true
        }
    ],
});

export default router;
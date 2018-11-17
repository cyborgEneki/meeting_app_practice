import vue from 'vue';
import vuex from 'vuex';
import axios from 'axios';

vue.use(vuex);

const state = {
    showMeetingListView: false,
    meeting: {}
};

const mutations = {
    GET_MEETING_DETAILS(state, meeting) {
        state.showMeetingListView = true;
        state.meeting = meeting;
    },

    EDIT_MEETING(state, meeting) {
        let currentmeeting = Object.assign({}, meeting);

        currentmeeting.media = meeting.media.id;
        currentmeeting.facilitator = meeting.facilitator.id;
        currentmeeting.time_keeper = meeting.time_keeper.id;
        currentmeeting.venue = meeting.venue.id;
        currentmeeting.meetingseries = meeting.meetingseries.id;
        currentmeeting.meetingtype = meeting.meetingtype.id;
        axios.put('/api/meetings/' + meeting.id, currentmeeting)
            .then(response => {
                    this.meeting = response.data;
                }
            );
    }
};

const getters = {
    showMeetingListView: state => state.showMeetingListView,
    meeting: state => state.meeting
};

const store = new vuex.Store({
    mutations,
    getters,
    state
})

export default store;
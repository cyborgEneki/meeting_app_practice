import vue from 'vue';
import vuex from 'vuex';
import axios from 'axios';

vue.use(vuex);

const state = {
    showMeetingListView: false,
    showAddListView: false,
    meeting: {}
};

const mutations = {
    GET_MEETING_DETAILS(state, meeting) {
        state.showMeetingListView = true;
        state.meeting = meeting;
    },
    ADD_NEW_MEETING(state) {
        state.showAddListView = true;
    },

    EDIT_MEETING(state, meeting) {
        meeting.media = meeting.media.id;
        meeting.facilitator = meeting.facilitator.id;
        meeting.time_keeper = meeting.time_keeper.id;
        meeting.venue = meeting.venue.id;
        meeting.meetingseries = meeting.meetingseries.id;
        meeting.meetingtype = meeting.meetingtype.id;
        axios.put('/api/meetings/' + meeting.id, meeting)
            .then(response => {
                    this.meeting = response.data;
                }
            );
    }
};

const getters = {
    showMeetingListView: state => state.showMeetingListView,
    showAddListView: state => state.showAddListView,
    meeting: state => state.meeting
};

const store = new vuex.Store({
    mutations,
    getters,
    state
})

export default store;
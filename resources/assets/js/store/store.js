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
        axios.put('/api/meetings/' + meeting.id)
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
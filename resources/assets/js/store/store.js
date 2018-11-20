import vue from 'vue';
import vuex from 'vuex';

vue.use(vuex);

const state = {
    showMeetingDetails: false,
    meeting: {}
};

const mutations = {
    GET_MEETING_DETAILS(state, meeting) {
        state.showMeetingDetails = true;
        state.meeting = meeting;
    }
};

const getters = {
    showMeetingDetails: state => state.showMeetingDetails,
    meeting: state => state.meeting
};

const store = new vuex.Store({
    mutations,
    getters,
    state
});

export default store;
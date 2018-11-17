import vue from 'vue';
import vuex from 'vuex';

vue.use(vuex);

const state = {
    showMeetingListView: false,
    meeting: {}
};

const mutations = {
    GET_MEETING_DETAILS(state, meeting) {
        state.showMeetingListView = true;
        state.meeting = meeting;
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
});

export default store;
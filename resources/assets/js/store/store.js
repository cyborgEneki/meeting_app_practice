import vue from 'vue';
import vuex from 'vuex';

vue.use(vuex);

const state = {
    showMeetingListView: false,
    showAddListView: false,
    meeting:{}
};

const mutations ={
    GET_MEETING_DETAILS(state, meeting){
        state.showMeetingListView = true;
        state.meeting = meeting;
    },
    ADD_NEW_MEETING(state){
        state.showAddListView = true;
    }
};

const getters = {
    showMeetingListView: state=>state.showMeetingListView,
    showAddListView: state=>state.showAddListView,
    meeting: state=>state.meeting
};

const store = new vuex.Store({
    mutations,
    getters,
    state
})

export default store;
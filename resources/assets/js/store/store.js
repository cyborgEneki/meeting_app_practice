import vue from 'vue';
import vuex from 'vuex';

vue.use(vuex);

const state = {
    showView: false,
    meeting:{}
};

const mutations ={
    GET_MEETING_DETAILS(state, meeting){
        state.showView = true;
        state.meeting = meeting;
    }
};

const getters = {
    showView: state=>state.showView,
    meeting: state=>state.meeting
};

const store = new vuex.Store({
    mutations,
    getters,
    state
})

export default store;
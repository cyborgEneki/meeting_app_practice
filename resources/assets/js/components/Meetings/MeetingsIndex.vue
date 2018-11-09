<template>
    <div>

        <div>
            <meeting-add></meeting-add>
        </div>
        <div>
            <h2>Meetings</h2>
            <meeting_list></meeting_list>
        </div>

        <div v-if="showView">
            <show_view></show_view>
        </div>
    </div>
</template>

<script>
    import show_view from './partials/MeetingShow';
    import meeting_list from './partials/MeetingList'
    import {mapGetters} from 'vuex'
    import MeetingAdd from "./partials/MeetingAdd";

    export default {
        data() {
            return {
            }
        },
        computed:{
            ...mapGetters({
                showView: 'showView',
            })
        },
        methods:{
        },
        components:{MeetingAdd, show_view, meeting_list},
    }
</script>
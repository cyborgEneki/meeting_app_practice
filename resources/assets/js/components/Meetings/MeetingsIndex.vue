<template>
    <div>

        <div v-if="showAddListView">
            <meeting_add></meeting_add>
        </div>
        <div>
            <h2>Meetings</h2>
            <meeting_list></meeting_list>
        </div>

        <div v-if="showMeetingListView">
            <show_view></show_view>
        </div>
    </div>
</template>

<script>
    import show_view from './partials/MeetingShow';
    import meeting_list from './partials/MeetingList'
    import {mapGetters} from 'vuex'
    import meeting_add from "./partials/MeetingAdd";

    export default {
        data() {
            return {
            }
        },
        computed:{
            ...mapGetters({
                showMeetingListView: 'showMeetingListView',
                showAddListView: 'showAddListView',
            })
        },
        components:{meeting_add, show_view, meeting_list},
    }
</script>
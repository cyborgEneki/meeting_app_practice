<template>
    <div>
        <div>
            <h2>Meetings</h2>
            <meeting_list></meeting_list>
        </div>

        <div v-if="showView">
            <h4>Meeting</h4>
            <show_view></show_view>
        </div>
    </div>
</template>

<script>
    import show_view from './partials/MeetingShow';
    import meeting_list from './partials/MeetingList'
    import {mapGetters} from 'vuex'

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
        components:{show_view, meeting_list},
    }
</script>
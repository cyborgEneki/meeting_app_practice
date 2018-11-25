<template>
    <div>
        <div>
            <h2>Meetings</h2>

            <meeting-list></meeting-list>
        </div>

        <div v-if="showMeetingDetails">
            <meeting-details :choices.sync="choices"></meeting-details>
        </div>
    </div>
</template>

<script>
    import MeetingDetails from './partials/MeetingDetails';
    import MeetingList from './partials/MeetingList'
    import {mapGetters} from 'vuex'

    export default {
        computed: {
            ...mapGetters({
                showMeetingDetails: 'showMeetingDetails',
            })
        },
        props: ['choices'],
        components: {
            'meeting-details': MeetingDetails,
            'meeting-list': MeetingList
        },
    }
</script>
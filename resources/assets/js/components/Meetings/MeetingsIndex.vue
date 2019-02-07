<template>
    <div class="grid-x">
        <div class="cell small-3">
            <meeting-list :choices.sync="choices"></meeting-list>
        </div>

        <div class="cell small-9" v-if="showMeetingDetails">
            <meeting-details :choices.sync="choices"></meeting-details>
        </div>

    </div>
</template>

<script>
    import MeetingDetails from './partials/MeetingDetails';
    import MeetingList from './partials/MeetingList'
    import {mapGetters} from 'vuex'

    export default {
        props: ['choices'],
        computed: {
            ...mapGetters({
                showMeetingDetails: 'showMeetingDetails',
            })
        },
        components: {
            'meeting-details': MeetingDetails,
            'meeting-list': MeetingList
        }
    }
</script>
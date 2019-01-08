<template>
    <div class="row">
        <div div class="col-md-3">
            <meeting-list></meeting-list>
        </div>

        <div class="col-md-9" v-if="showMeetingDetails">
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
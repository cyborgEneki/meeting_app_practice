<template>
    <div>
        <MeetingsIndex></MeetingsIndex>
        <h2>Meeting Details</h2>
        <div v-for="meeting in meetings">
            <div v-if="meetingId === meeting.id">
                <p>The name of this meeting is {{ meeting.name }}</p>
            </div>

        </div>
        <p v-if="seen">Message Can Be Seen!</p>
        <p><button class="btn btn-lg btn-primary" v-on:click="seen = !seen">Toggle</button></p>
    </div>
</template>

<script>
    import MeetingsIndex from "./MeetingsIndex";

    export default {
        name: 'showMeeting',
        components: {MeetingsIndex},
        data() {
            return {
                meetingId: this.$route.params.meetingId,
                meetings: [],
                seen: true
            }
        },
        mounted() {
            this.showMeetingDetails();
        },
        methods: {
            showMeetingDetails() {
                let uri = '/api/meetings/' + this.$route.params.meetingId;
                axios.get(uri)
                    .then(response => {
                            this.meetings = response.data;
                        }
                    )
            }
        }
    }
</script>

<style scoped>

</style>
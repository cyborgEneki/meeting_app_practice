<template>
    <div>
        <h3>Edit Meeting</h3>

        <div>
            Meeting Name<input type="text" v-model="meeting.name"/>
        </div>
        <div>
            Date<input name="date" v-model="meeting.date" type="date"/>
        </div>
        <div>
            Start Time<input name="start_time" v-model="meeting.start_time" type="time"/>
        </div>
        <div>
            End Time<input name="end_time" v-model="meeting.end_time" type="time"/>
        </div>
        <div>
            Facilitator<input name="facilitator" v-model="meeting.facilitator.id"/>
        </div>
        <div>
            Time Keeper<input name="time_keeper" v-model="meeting.time_keeper.id"/>
        </div>
        <div>
            Venue<input name="venue_id" v-model="meeting.venue.id"/>
        </div>
        <div>
            Media<input name="media_id" v-model="meeting.media.id"/>
        </div>
        <div>
            Meeting Type<input name="meetingtype_id" v-model="meeting.meetingtype.id"/>
        </div>
        <div>
            Meeting Series<input name="meetingseries_id" v-model="meeting.meetingseries.id"/>
        </div>

    <button @click="editAgenda">Edit Agenda</button>
    <button @click="editMeeting">Edit Meeting</button>
    </div>
</template>

<script>
    export default {
        props: ['meeting'],

        methods: {
            editMeeting: function () {
                this.$store.commit('EDIT_MEETING', this.meeting);
            }
        },
    }
</script>

<style scoped>

</style>
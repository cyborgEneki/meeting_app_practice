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
            Creator<input name="creator" v-model="meeting.creator"/>
        </div>
        <div>
            Facilitator<input name="facilitator" v-model="meeting.facilitator"/>
        </div>
        <div>
            Time Keeper<input name="time_keeper" v-model="meeting.time_keeper"/>
        </div>
        <div>
            Venue<input name="venue_id" v-model="meeting.venue_id"/>
        </div>
        <div>
            Media<input name="media_id" v-model="meeting.media_id"/>
        </div>
        <div>
            Meeting Type<input name="meetingtype_id" v-model="meeting.meetingtype_id"/>
        </div>
        <div>
            Meeting Series<input name="meetingseries_id" v-model="meeting.meetingseries_id"/>
        </div>
        <div v-for="(agenda,index) in meeting.agendas">
            <div>
                Agenda Topic<input type="text" v-model="meeting.agendas[index].topic">
            </div>
            <div>
                Agenda Description<input type="text" v-model="meeting.agendas[index].description">
            </div>
            <div>
                Time Allocated<input type="text" v-model="meeting.agendas[index].time_allocated">
            </div>
            <div>
                User Assigned to Agenda<input type="text" v-model="meeting.agendas[index].user_id">
            </div>
            <div>
                Agenda Status<input type="text" v-model="meeting.agendas[index].agenda_status">
            </div>
            <div>
                Agenda Conclusion<input type="text" v-model="meeting.agendas[index].conclusion">
            </div>
        </div>

        <button @click="editAgenda">Edit Agenda</button>
        <button @click="editMeeting">Edit Meeting</button>
    </div>
</template>

<script>
    export default {
        name: "MeetingEdit"
    }
</script>

<style scoped>

</style>
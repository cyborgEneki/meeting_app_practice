<template>
    <div>
        <h3>Add New Meeting</h3>
        <form action="#" @submit.prevent="addNewMeeting()" method="POST">
            <label for="name">Meeting Name</label>
            <input v-model="meeting.name" type="text" id="name" name="name"/>

            <label for="date">Meeting Date</label>
            <input v-model="meeting.date" name="date" id="date" type="date"/>

            <label for="start_time">Start Time</label>
            <input v-model="meeting.start_time" name="start_time" id="start_time" type="time"/>

            <label for="end_time">End Time</label>
            <input v-model="meeting.end_time" name="end_time" id="end_time" type="time"/>

            <label for="creator">Creator</label>
            <input v-model="meeting.creator" name="creator" id="creator"/>

            <label for="facilitator">Facilitator</label>
            <input v-model="meeting.facilitator" name="facilitator" id="facilitator"/>

            <label for="time_keeper">Time Keeper</label>
            <input v-model="meeting.time_keeper" name="time_keeper" id="time_keeper"/>

            <label for="agenda_topic">Agenda Topic</label>
            <input v-model="meeting.agendas[0].topic" name="agenda_topic" id="agenda_topic" type="text"/>

            <label for="agenda_description">Agenda Description</label>
            <input v-model="meeting.agendas[0].description" name="agenda_description" id="agenda_description" type="text"/>

            <label for="agenda_time_allocated">Time Allocated for Agenda</label>
            <input v-model="meeting.agendas[0].time_allocated" name="agenda_time_allocated" id="agenda_time_allocated" type="text"/>

            <label for="user_id">User Assigned to Agenda</label>
            <input v-model="meeting.agendas[0].user_id" name="user_id" id="user_id"/>

            <label for="agenda_status">Agenda Status</label>
            <input v-model="meeting.agendas[0].agenda_status" name="agenda_status" id="agenda_status"/>

            <label for="agenda_conclusion">Agenda Conclusion</label>
            <input v-model="meeting.agendas[0].conclusion" name="agenda_conclusion" id="agenda_conclusion"/>

            <label for="venue_id">Venue</label>
            <input v-model="meeting.venue_id" name="venue_id" id="venue_id"/>

            <label for="media_id">Media</label>
            <input v-model="meeting.media_id" name="media_id" id="media_id"/>

            <label for="meetingtype_id">Meeting Type</label>
            <input v-model="meeting.meetingtype_id" name="meetingtype_id" id="meetingtype_id"/>

            <label for="meetingseries_id">Meeting Series</label>
            <input v-model="meeting.meetingseries_id" name="meetingseries_id" id="meetingseries_id"/>

            <button class="button" type="submit">Add New Meeting</button>

        </form>
    </div>
</template>

<script>
    export default {
        name: "MeetingAdd",
        data() {
            return {
                meeting: {
                    name: '',
                    date: '',
                    start_time: '',
                    end_time: '',
                    creator: '',
                    facilitator: '',
                    time_keeper: '',
                    venue_id: '',
                    media_id: '',
                    meetingtype_id: '',
                    meetingseries_id: '',
                    agendas: [
                        {
                            topic: '',
                            description: '',
                            time_allocated: '',
                            user_id: '',
                            agenda_status: '',
                            conclusion: ''
                        }
                    ]
                }
            }
        },
        methods: {
            addNewMeeting() {
                axios.post('/api/meetings', this.meeting)
                    .then((response) => {
                    console.log('response');
                });
            }
        }
    }

</script>

<style scoped>

</style>
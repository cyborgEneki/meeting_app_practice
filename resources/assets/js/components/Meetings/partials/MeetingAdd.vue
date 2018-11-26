<template>
    <div>
        <h3>Add New Meeting</h3>

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
            Creator<input name="creator" v-model="meeting.creator_id"/>
        </div>
        <div>
            Facilitator<input name="facilitator" v-model="meeting.facilitator_id"/>
        </div>
        <div>
            Time Keeper<input name="time_keeper" v-model="meeting.time_keeper_id"/>
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

        <button @click="addAgenda">Add Agenda</button>
        <button @click="addNewMeeting">Add Meeting</button>
    </div>

</template>

<script>
    export default {
        name: "MeetingAdd",
        data() {
            return {
                meeting: {
                    id: '',
                    name: '',
                    date: '',
                    start_time: '',
                    end_time: '',
                    creator_id: '',
                    facilitator_id: '',
                    time_keeper_id: '',
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
                        this.$router.push('/meetings')
                    });
            },
            addAgenda() {
                let items = this.meeting.agendas.length;
                if (
                    this.meeting.agendas[items - 1].topic !== '' &&
                    this.meeting.agendas[items - 1].description !== '' &&
                    this.meeting.agendas[items - 1].time_allocated !== '' &&
                    this.meeting.agendas[items - 1].user_id !== '' &&
                    this.meeting.agendas[items - 1].agenda_status !== '' &&
                    this.meeting.agendas[items - 1].conclusion !== ''

                ) {
                    this.meeting.agendas.push({
                        topic: '',
                        description: '',
                        time_allocated: '',
                        user_id: '',
                        agenda_status: '',
                        conclusion: '',
                    })
                }
            }
        }
    }

</script>

<style scoped>

</style>
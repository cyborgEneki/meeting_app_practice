<template>
    <div>
        <h3>Add New Meeting</h3>
        <form action="#" @submit.prevent="addNewMeeting()" method="POST">
            <div>
                Meeting Name<input type="text" v-model="meeting.name"/>
            </div>
            <div>
                Start Time<input name="date" v-model="meeting.date"/>
            </div>
            <div>
                End Time<input name="end_time" v-model="meeting.end_time"/>
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

            <button class="button" type="submit">Add</button>

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
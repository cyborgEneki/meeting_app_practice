<template>
    <div>
        <button @click="loadAddMeetingView">Create New Meeting</button>

        <table class="table striped table-bordered">
            <thead>
            <th>Name</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            </thead>
            <tr v-for="meeting in meetings" :key="meeting.id">
                <td @click="loadView(meeting)">{{meeting.name}}</td>
                <td>{{ meeting.date }}</td>
                <td>{{ meeting.start_time }}</td>
                <td>{{ meeting.end_time }}</td>
                <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                            :data-target="'#exampleModal' + meeting.id">
                        Edit Meeting
                    </button>
                    <div class="modal fade" :id="'exampleModal' + meeting.id" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div>
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

                                        <button @click="addAgenda">Add Agenda</button>
                                        <button @click="addNewMeeting">Add Meeting</button>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                meetings: [],
            }
        },
        methods: {
            getMeetings() {
                axios.get('/api/meetings')
                    .then(response => {
                            this.meetings = response.data;
                        }
                    )
            },
            loadView: function (meeting) {
                this.$store.commit('GET_MEETING_DETAILS', meeting)
            },
            loadAddMeetingView() {
                this.$store.commit('ADD_NEW_MEETING')
            }
        },
        mounted() {
            this.getMeetings();
        },

    }
</script>

<style scoped>

</style>
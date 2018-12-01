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
            <label>Time Keeper</label>
            <select v-model="meeting.time_keeper_id">
                <option value="">Select user</option>
                <option v-for="user in orderedUsers" v-bind:value="user.id">{{ user.full_name }}</option>
            </select>
        </div>
        <div>
            <label>Facilitator</label>
            <select v-model="meeting.facilitator_id">
                <option value="">Select user</option>
                <option v-for="user in orderedUsers" v-bind:value="user.id">{{ user.full_name }}</option>
            </select>
        </div>
        <div>
            <label>Venue</label>
            <select v-model="meeting.venue_id">
                <option value="">Select venue</option>
                <option v-for="venue in orderedVenues" :value="venue.id">{{ venue.name }}</option>
            </select>
        </div>
        <div>
            <label>Media</label>
            <select v-model="meeting.media_id">
                <option value="">Select media</option>
                <option v-for="eachmedia in orderedMedia" :value="eachmedia.id">{{ eachmedia.name }}</option>
            </select>
        </div>
        <div>
            <label>Meeting Type</label>
            <select v-model="meeting.meetingtype_id">
                <option value="">Select meeting type</option>
                <option v-for="meetingtype in orderedMeetingTypes" :value="meetingtype.id">{{ meetingtype.name }}
                </option>
            </select>
        </div>
        <div>
            <label>Meeting Series</label>
            <select v-model="meeting.meetingseries_id">
                <option value="">Select meeting series</option>
                <option v-for="eachmeetingseries in orderedMeetingSeries" :value="eachmeetingseries.id">{{
                    eachmeetingseries.name }}
                </option>
            </select>
        </div>
        <div v-for="(agenda,index) in meeting.agendas">
            <div>
                Agenda Topic<input type="text" v-model="meeting.agendas[index].topic">
            </div>
            <div>
                Agenda Description<textarea type="text" v-model="meeting.agendas[index].description"></textarea>
            </div>
            <div>
                Time Allocated
                <select type="text" v-model="meeting.agendas[index].time_allocated">
                    <option value="">Select time</option>
                    <option v-for="time in timing">{{ time }}</option>
                </select>
            </div>
            <div>
                <label>User Assigned to Agenda</label>
                <select v-model="meeting.agendas[index].user_id">
                    <option value="">Select user</option>
                    <option v-for="user in orderedUsers" v-bind:value="user.id">{{ user.full_name }}</option>
                </select>
            </div>
            <div>
                Agenda Status
                <select type="text" v-model="meeting.agendas[index].agenda_status">
                    <option value="">Select status</option>
                    <option v-for="status in statuses">{{ status }}</option>
                </select>
            </div>
        </div>

        <button @click="addAgenda">Save Agenda</button>
        <button @click="addNewMeeting">Save Meeting</button>

        <button @click="$router.go(-1)">Go Back to Previous Page</button>
    </div>

</template>

<script>
    export default {
        name: "MeetingAdd",
        props: ['choices'],
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
                            conclusion: '',
                        }
                    ]
                },
                timing: [5, 10, 15, 20, 25, 30, 45, 60, 75, 90],
                statuses: ['Pending', 'Accepted', 'Rejected']
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
        },
        computed: {
            orderedUsers() {
                return _.orderBy(this.choices.users, 'first_name');
            },
            orderedVenues() {
                return _.orderBy(this.choices.venues, 'name');
            },
            orderedMedia() {
                return _.orderBy(this.choices.media, 'media');
            },
            orderedMeetingTypes() {
                return _.orderBy(this.choices.meetingtypes, 'name');
            },
            orderedMeetingSeries() {
                return _.orderBy(this.choices.meetingseries, 'name');
            }
        }
    }

</script>

<style scoped>

</style>
<template>
    <div>
        <h3>Edit Meeting</h3>

        <div>
            Meeting Name<input type="text" v-model="meeting.name"/>
        </div>
        <div>
            Date<input v-validate="'after:'+refDate+'|date_format:YYYY-MM-DD'" name="after_field" v-model="meeting.date"
                       type="date"/>
            <span>{{ errors.first('after_field') }}</span>
            <input v-show='false' ref="refDate" type="text" v-model="refDate">
        </div>
        <div>
            Start Time<input v-model="meeting.start_time" type="time"/>
        </div>
        <div>
            End Time<input v-validate="'after:'+meeting.start_time+'|required'" name="end_time"
                           v-model="meeting.end_time" type="time"/>
            <span>{{ errors.first('end_time') }}</span>
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
                    <option v-for="status in statuses" v-bind:value="status.id">{{ status.name }}</option>
                </select>
            </div>
        </div>

        <button @click="addAgenda">Add Agenda</button>
        <button @click="editMeeting(meeting)">Edit Meeting</button>
        <button @click="$router.go(-1)">Go Back to Previous Page</button>

    </div>
</template>

<script>
    export default {
        props: ['choices', 'meeting'],
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
            },
            refDate() {
                let today = new Date()
                let dd = today.getDate();
                let mm = today.getMonth() + 1;
                let yyyy = today.getFullYear();
                if (dd < 10) {
                    dd = '0' + dd;
                }
                if (mm < 10) {
                    mm = '0' + mm;
                }
                return yyyy + '-' + mm + '-' + dd;
            }
        },
        methods: {
            editMeeting: function (meeting) {
                let currentMeeting = {};

                currentMeeting.name = meeting.name;
                currentMeeting.start_time = meeting.start_time;
                currentMeeting.end_time = meeting.end_time;
                currentMeeting.date = meeting.date;
                currentMeeting.media_id = meeting.media_id;
                currentMeeting.facilitator_id = meeting.facilitator_id;
                currentMeeting.time_keeper_id = meeting.time_keeper_id;
                currentMeeting.venue_id = meeting.venue_id;
                currentMeeting.meetingseries_id = meeting.meetingseries_id;
                currentMeeting.meetingtype_id = meeting.meetingtype_id;
                currentMeeting.agendas = meeting.agendas;
                currentMeeting.agendas[index].topic = meeting.agendas[index].topic;
                currentMeeting.agendas[index].description = meeting.agendas[index].description;
                currentMeeting.agendas[index].time_allocated = meeting.agendas[index].time_allocated;
                currentMeeting.agendas[index].user_id = meeting.agendas[index].user_id;
                currentMeeting.agendas[index].agenda_status = meeting.agendas[index].agenda_status;
                currentMeeting.agendas[index].conclusion = meeting.agendas[index].conclusion;

                axios.put('/api/meetings/' + meeting.id, currentMeeting)
                    .then(response => {
                    });
                this.$router.push('/meetings');
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
            },
        },
    }
</script>

<style scoped>

</style>
<template>
    <div>
        <h3>Add New Meeting</h3>

        <div>
            Meeting Name<input type="text" v-model="meeting.name"/>
        </div>
        <div>
            Date
            <input v-validate="'after:'+refDate+'|date_format:YYYY-MM-DD'" name="after_field" type="text"
                   placeholder="yyyy-mm-dd" v-model="meeting.date">
            <span>{{ errors.first('after_field') }}</span>
            <input v-show='false' ref="refDate" type="text" v-model="refDate">
        </div>
        <div>
            Start Time<input name="start_time" v-model="meeting.start_time" type="time"/>
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

        <button :disabled="errors.any() || !isMeetingComplete" @click="addNewMeeting">Save Meeting</button>

        <button @click="$router.go(-1)">Go Back to Previous Page</button>
    </div>

</template>

<script>
    import 'vuejs-noty/dist/vuejs-noty.css';

    export default {
        name: "MeetingAdd",
        props: ['choices'],
        data: function () {
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
                },
                timing: [5, 10, 15, 20, 25, 30, 45, 60, 75, 90],
                statuses:
                    [
                        {id: 0, name: 'Pending'},
                        {id: 1, name: 'Accepted'},
                        {id: 2, name: 'Rejected'}
                    ],
                today: new Date()
            }
        },
        methods: {
            addNewMeeting() {
                axios.post('/api/meetings', this.meeting)
                    .then((response) => {
                        this.$router.push('/meetings');
                        this.$noty.success("Your meeting has been saved!");
                    });
            },
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
            },
            isMeetingComplete() {
                return this.meeting.name && this.meeting.date && this.meeting.start_time && this.meeting.end_time && this.meeting.time_keeper_id && this.meeting.facilitator_id && this.meeting.venue_id && this.meeting.media_id && this.meeting.meetingtype_id && this.meeting.meetingseries_id;
            }
        }
    }

</script>

<style scoped>

</style>
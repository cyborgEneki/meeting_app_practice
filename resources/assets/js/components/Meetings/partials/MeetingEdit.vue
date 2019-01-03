<template>
    <div>
        <h3>Edit Meeting</h3>

        <div>
            Meeting Name *<input type="text" v-model="meeting.name"/>
        </div>
        <div>
            Date *<input name='after_field' v-validate="'after:'+refDate+'|date_format:YYYY-MM-DD'" v-model="meeting.date"
                       type="text"/>
            <span>{{ errors.first('after_field') }}</span>
            <input v-show='false' ref="refDate" type="text" v-model="refDate">
        </div>
        <div>
            Start Time *<input v-model="meeting.start_time" type="time"/>
        </div>
        <div>
            End Time *<input name='end_time' v-validate="'after:'+meeting.start_time+'|required'"
                           v-model="meeting.end_time" type="time"/>
            <span>{{ errors.first('end_time') }}</span>
        </div>
        <div>
            <label>Secretary *</label>
            <select v-model="meeting.secretary_id">
                <option value="">Select user</option>
                <option v-for="user in orderedUsers" v-bind:value="user.id">{{ user.full_name }}</option>
            </select>
        </div>
        <div>
            <label>Chair *</label>
            <select v-model="meeting.chair_id">
                <option value="">Select user</option>
                <option v-for="user in orderedUsers" v-bind:value="user.id">{{ user.full_name }}</option>
            </select>
        </div>
        <div>
            <label>Venue *</label>
            <select v-model="meeting.venue_id">
                <option value="">Select venue</option>
                <option v-for="venue in orderedVenues" :value="venue.id">{{ venue.name }}</option>
            </select>
        </div>
        <div>
            <label>Media *</label>
            <select v-model="meeting.media_id">
                <option value="">Select media</option>
                <option v-for="eachmedia in orderedMedia" :value="eachmedia.id">{{ eachmedia.name }}</option>
            </select>
        </div>
        <div>
            <label>Meeting Type *</label>
            <select v-model="meeting.meetingtype_id">
                <option value="">Select meeting type</option>
                <option v-for="meetingtype in orderedMeetingTypes" :value="meetingtype.id">{{ meetingtype.name }}
                </option>
            </select>
        </div>
        <div>
            <label>Meeting Series *</label>
            <select v-model="meeting.meetingseries_id">
                <option value="">Select meeting series</option>
                <option v-for="eachmeetingseries in orderedMeetingSeries" :value="eachmeetingseries.id">{{
                    eachmeetingseries.name }}
                </option>
            </select>
        </div>

        <el-button type="primary" icon="el-icon-edit" @click="editMeeting(meeting)"></el-button>
        <el-button icon="el-icon-back" @click="$router.go(-1)"></el-button>

    </div>
</template>

<script>
    import 'vuejs-noty/dist/vuejs-noty.css';

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
                let today = new Date();
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
            editMeeting(meeting) {
                let currentMeeting = {};

                currentMeeting.name = meeting.name;
                currentMeeting.start_time = meeting.start_time;
                currentMeeting.end_time = meeting.end_time;
                currentMeeting.date = meeting.date;
                currentMeeting.media_id = meeting.media_id;
                currentMeeting.chair_id = meeting.chair_id;
                currentMeeting.secretary_id = meeting.secretary_id;
                currentMeeting.venue_id = meeting.venue_id;
                currentMeeting.meetingseries_id = meeting.meetingseries_id;
                currentMeeting.meetingtype_id = meeting.meetingtype_id;

                axios.put('/api/meetings/' + meeting.id, currentMeeting)
                    .then(response => {
                        this.$router.push('/meetings');
                        this.$noty.success("This meeting has been edited!");
                        this.currentMeeting = {};
                    });

            }
        }
    }
</script>

<style scoped>

</style>
<template>
    <div>
        <h3>Edit Meeting</h3>

        <div>
            Meeting Name<input type="text" v-model="meeting.name"/>
        </div>
        <div>
            Date<input v-model="meeting.date" type="date"/>
        </div>
        <div>
            Start Time<input v-model="meeting.start_time" type="time"/>
        </div>
        <div>
            End Time<input v-model="meeting.end_time" type="time"/>
        </div>
        <div>
            <label>Time Keeper</label>
            <select v-model="meeting.time_keeper_id" >
                <option value="">Select user</option>
                <option v-for="user in choices.users" v-bind:value="user.id">{{ user.first_name }} {{ user.last_name }}</option>
            </select>
        </div>
        <div>
            <label>Facilitator</label>
            <select v-model="meeting.facilitator_id" >
                <option value="">Select user</option>
                <option v-for="user in choices.users" v-bind:value="user.id">{{ user.first_name }} {{ user.last_name }}</option>
            </select>
        </div>
        <div>
            <label>Venue</label>
            <select v-model="meeting.venue_id" >
                <option value="">Select venue</option>
                <option v-for="venue in choices.venues" :value="venue.id">{{ venue.name }}</option>
            </select>
        </div>
        <div>
            <label>Media</label>
            <select v-model="meeting.media_id" >
                <option value="">Select media</option>
                <option v-for="eachmedia in choices.media" :value="eachmedia.id">{{ eachmedia.name }}</option>
            </select>
        </div>
        <div>
            <label>Meeting Type</label>
            <select v-model="meeting.meetingtype_id">
                <option value="">Select meeting type</option>
                <option v-for="meetingtype in choices.meetingtypes" :value="meetingtype.id">{{ meetingtype.name }}</option>
            </select>
        </div>
        <div>
            <label>Meeting Series</label>
            <select v-model="meeting.meetingseries_id">
                <option value="">Select meeting series</option>
                <option v-for="eachmeetingseries in choices.meetingseries" :value="eachmeetingseries.id">{{ eachmeetingseries.name }}</option>
            </select>
        </div>

        <button @click="editMeeting(meeting)">Edit Meeting</button>
    </div>
</template>

<script>
    export default {
        props: ['choices', 'meeting'],

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

                axios.put('/api/meetings/' + meeting.id, currentMeeting)
                    .then(response => {
                    });
                this.$router.push('/meetings');

            }
        },
    }
</script>

<style scoped>

</style>
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
            Venue
            <select v-model="meeting.venue_id" >
                <option></option>
                <option v-for="venue in choices.venues" v-bind:value="venue.id">{{ venue.name }}</option>
            </select>             
        </div>
        <div>
            Media
            <select v-model="meeting.media_id" >
                <option></option>
                <option v-for="media in choices.media" v-bind:value="media.id">{{ media.name }}</option>
            </select>    
        </div>
        <div>
            Meeting Type
            <select v-model="meeting.meetingtype_id" >
                <option value=""></option>
                <option v-for="meetingtype in choices.meetingtype" v-bind:value="meetingtype.id">{{ meetingtype.name }}</option>
            </select> 
        </div>
        <div>
            Meeting Series
            <select v-model="meeting.meetingseries_id" >
                <option></option>
                <option v-for="meetingseries in choices.meetingseries" v-bind:value="meetingseries.id">{{ meetingseries.name }}</option>
            </select>  
        </div>

        <button @click="editMeeting(meeting)">Edit Meeting</button>
    </div>
</template>

<script>
    export default {
        props: ['meeting','choices'],

        methods: {
            editMeeting: function(meeting) {
                console.log(meeting);
                let currentMeeting = {};

                currentMeeting.name = meeting.name;
                currentMeeting.start_time = meeting.start_time;
                currentMeeting.end_time = meeting.end_time;
                currentMeeting.date = meeting.date;
                currentMeeting.media_id = meeting.media_id;
                currentMeeting.facilitator = meeting.facilitator_id;
                currentMeeting.time_keeper = meeting.time_keeper_id;
                currentMeeting.venue_id = meeting.venue_id;
                currentMeeting.meetingseries_id = meeting.meetingseries_id;
                currentMeeting.meetingtype_id = meeting.meetingtype_id;

                axios.put('/api/meetings/' + meeting.id, currentMeeting)
                    .then(response => {
                        this.$router.push('/meetings')
                    });
            }
        },
    }
</script>

<style scoped>

</style>
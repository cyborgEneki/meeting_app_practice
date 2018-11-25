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
            Creator
        <select v-model="meeting.creator_id" >
            <option>Select user</option>
            <option v-for="user in choices.users" v-bind:value="user.id">{{ user.first_name }} {{ user.last_name }}</option>
        </select>
        </div>
        <!--<div>-->
            <!--Facilitator<input name="facilitator" v-model="meeting.facilitator.id"/>-->
        <!--</div>-->
        <!--<div>-->
            <!--Time Keeper<input name="time_keeper" v-model="meeting.time_keeper.id"/>-->
        <!--</div>-->
        <div>
            Venue<input type="text" v-model="meeting.venue_id"/>
        </div>
        <div>
            Media<input type="text" v-model="meeting.media_id"/>
        </div>
        <div>
            Meeting Type<input type="text" v-model="meeting.meetingtype_id"/>
        </div>
        <div>
            Meeting Series<input type="text" v-model="meeting.meetingseries_id"/>
        </div>

        <button @click="editMeeting(meeting)">Edit Meeting</button>
    </div>
</template>

<script>
    export default {
        props: ['meeting','choices'],

        methods: {
            editMeeting: function(meeting) {
                let currentMeeting = {};

                currentMeeting.name = meeting.name;
                currentMeeting.start_time = meeting.start_time;
                currentMeeting.end_time = meeting.end_time;
                currentMeeting.date = meeting.date;
                currentMeeting.media_id = meeting.media_id;
                currentMeeting.facilitator = meeting.facilitator.id;
                currentMeeting.time_keeper = meeting.time_keeper.id;
                currentMeeting.venue_id = meeting.venue_id;
                currentMeeting.meetingseries_id = meeting.meetingseries_id;
                currentMeeting.meetingtype_id = meeting.meetingtype_id;

                axios.put('/api/meetings/' + meeting.id, currentMeeting)
                    .then(response => {});
            }
        },
    }
</script>

<style scoped>

</style>
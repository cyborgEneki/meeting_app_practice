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
            <label>Creator</label>
            <select v-model="meeting.creator_id" >
                <option>Select user</option>
                <option v-for="user in choices.users" v-bind:value="user.id">{{ user.first_name }} {{ user.last_name }}</option>
            </select>
        </div>
        <div>
            Facilitator
            <select v-model="meeting.facilitator_id" >
                <option>Select user</option>
                <option v-for="user in choices.users" v-bind:value="user.id">{{ user.first_name }} {{ user.last_name }}</option>
            </select>
        </div>
        <div>
            Time Keeper
            <select v-model="meeting.time_keeper_id" >
                <option>Select user</option>
                <option v-for="user in choices.users" v-bind:value="user.id">{{ user.first_name }} {{ user.last_name }}</option>
            </select>            
        </div>
        <div>
            Venue
            <select v-model="meeting.venue_id" >
                <option>Select user</option>
                <option v-for="venue in choices.venues" v-bind:value="venue.id">{{ venue.name }}</option>
            </select>             
        </div>
        <div>
            Media
            <select v-model="meeting.media_id" >
                <option>Select user</option>
                <option v-for="media in choices.media" v-bind:value="media.id">{{ media.name }}</option>
            </select>    
        </div>
        <div>
            Meeting Type
            <select v-model="meeting.meetingtype_id" >
                <option value="">Select user</option>
                <option v-for="meetingtype in choices.meetingtype" v-bind:value="meetingtype.id">{{ meetingtype.name }}</option>
            </select> 
        </div>
        <div>
            Meeting Series
            <select v-model="meeting.meetingseries_id" >
                <option>Select user</option>
                <option v-for="meetingseries in choices.meetingseries" v-bind:value="meetingseries.id">{{ meetingseries.name }}</option>
            </select>  
        </div>
        <div v-for="(agenda,index) in meeting.agendas">
            <div>
                Agenda Topic<input type="text" v-model="meeting.agendas[index].topic">
            </div>
            <div>
                Agenda Description<input type="text" v-model="meeting.agendas[index].description">
            </div>
            <div>
                Time Allocated (Min) 
                <select v-model="meeting.agendas[index].time_allocated">
                    <option>Select time</option>
                    <option v-for="time in timing">{{ time }}</option>    
                </select>
            </div>
            <div>
                User Assigned to Agenda
                <select v-model="meeting.agendas[index].user_id" >
                    <option>Select user</option>
                    <option v-for="user in choices.users" v-bind:value="user.id">{{ user.first_name }} {{ user.last_name }}</option>
                </select> 
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
                            conclusion: ''
                        }
                    ]
                },
                timing: [5,10,15,20,25,30,45,60,75,90]
            }
        },
        methods: {
            addNewMeeting() {
                axios.post('/api/meetings', this.meeting)
                    .then((response) => {
                        this.$router.push('/')
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
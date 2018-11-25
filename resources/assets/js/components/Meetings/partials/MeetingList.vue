<template>
    <div>

        <router-link :to="{ name: 'addMeeting' }">Create New Meeting</router-link>
        <table class="table striped table-bordered">
            <thead>
            <th>Name</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Actions</th>
            </thead>
            <tr v-for="meeting in meetings" :key="meeting.id">
                <td @click="loadView(meeting)" style="cursor: pointer;">{{meeting.name}}</td>
                <td>{{ meeting.date }}</td>
                <td>{{ meeting.start_time }}</td>
                <td>{{ meeting.end_time }}</td>
                <td>
                    <router-link :to="{ name: 'editMeeting' , params: { meeting }}">Edit</router-link>
                    <button @click="deleteMeeting(meeting.id)">Delete</button>
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
        props: ['choices'],
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
            deleteMeeting(id) {
                axios.delete('/api/meetings/'+id)
                    .then(() => {
                        let index = this.meetings.map(function(item){
                            return item.id
                        }).indexOf(id);
                        this.meetings.splice(index, 1);
                    });
            }
        },
        created() {
            this.getMeetings();
        },

    }
</script>

<style scoped>

</style>
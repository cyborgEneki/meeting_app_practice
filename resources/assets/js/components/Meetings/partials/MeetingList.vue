<template>
    <div>
        <table class="table striped table-bordered">
            <thead>
            <th>Name</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            </thead>
            <tr v-for="meeting in meetings" :key="meeting.id" @click="loadView(meeting)">
                <td>{{meeting.name}}</td>
                <td>{{ meeting.date }}</td>
                <td>{{ meeting.start_time }}</td>
                <td>{{ meeting.end_time }}</td>
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
        methods:{
            getMeetings() {
                axios.get('/api/meetings')
                    .then(response => {
                            this.meetings = response.data;
                        }
                    )
            },
            loadView: function (meeting) {
               this.$store.commit('GET_MEETING_DETAILS', meeting)
            }
        },
        mounted() {
            this.getMeetings();
        },

    }
</script>

<style scoped>

</style>
<template>
    <div>

        <h2>All Meetings</h2>
        <table class="table striped table-bordered">
            <tr v-for="meeting in meetings">
                <td @click="goToDetail(meeting.id)">{{ meeting.name }}</td>
                <td>{{ meeting.start_time }}</td>
                <td>{{ meeting.end_time }}</td>
                <td>{{ meeting.id }}</td>
            </tr>
        </table>
    </div>
</template>

<script>

    export default {
        name: "MeetingsIndex",
        data() {
            return {
                msg: 'Hi',
                meetings: [],
                meeting: {},
                /*This is necessary because when the make a PUT and CREATE request to the API
                the field will have to be sent with it for it to know which id to output. They both go
                to the store method and we don't pass the id with the url*/
                meeting_id: '',
                /*This is necessary because I will use the same form to add and edit.*/
                edit: false
            }
        },

        mounted() {
            this.getMeetings();
        },

        methods: {
            getMeetings() {
                axios.get('/api/simplemeetings')
                    .then(response => {
                            this.meetings = response.data;
                        }
                    )
            },
            goToDetail(id) {
                this.$router.push({name: 'showMeeting', params: { meetingId: id }})
            }
        }

    }
</script>

<style scoped>

</style>
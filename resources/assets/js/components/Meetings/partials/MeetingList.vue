<template>
    <div>
        <button @click="loadAddMeetingView">Create New Meeting</button>

        <table class="table striped table-bordered">
            <thead>
            <th>Name</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            </thead>
            <tr v-for="meeting in meetings" :key="meeting.id">
                <td @click="loadView(meeting)">{{meeting.name}}</td>
                <td>{{ meeting.date }}</td>
                <td>{{ meeting.start_time }}</td>
                <td>{{ meeting.end_time }}</td>
                <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                            :data-target="'#exampleModal' + meeting.id">
                        Launch demo modal
                    </button>
                    <div class="modal fade" :id="'exampleModal' + meeting.id" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    ...
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
            loadAddMeetingView() {
                this.$store.commit('ADD_NEW_MEETING')
            }
        },
        mounted() {
            this.getMeetings();
        },

    }
</script>

<style scoped>

</style>
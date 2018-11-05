<template>
    <div>
        <div>
            <h2>Meetings</h2>
            <table class="table striped table-bordered">
                <tr v-for="meeting in meetings" :key="meeting.id">
                    <td>{{meeting.name}}</td>
                    <td>{{ meeting.start_time }}</td>
                    <td>{{ meeting.end_time }}</td>
                    <td>{{ meeting.id }}</td>
                    <td>
                        <button class="btn btn-info" type="button" @click="loadView(meeting)">View</button>
                    </td>
                </tr>
            </table>
        </div>

        <div v-if="showView">
            <h4>Meeting</h4>
            <show_view :meeting="meeting"></show_view>
        </div>
    </div>
</template>

<script>
    import show_view from './partials/MeetingShow';

    export default {
        data() {
            return {
                meetings: [],
                showView: false,
                meeting:{}
            }
        },
        methods:{
            getMeetings() {
                axios.get('/api/simplemeetings')
                    .then(response => {
                            this.meetings = response.data;
                        }
                    )
            },
            loadView: function (meeting) {
                this.showView = true;
                this.meeting = meeting;
            }
        },
        components:{show_view},
        mounted() {
            this.getMeetings();
        },
    }
</script>
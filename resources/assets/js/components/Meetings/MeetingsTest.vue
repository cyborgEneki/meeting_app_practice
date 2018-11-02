<template>
    <div>
        <div>
            <h2>Meetings</h2>
            <table class="table striped table-bordered">
                <tr v-for="meeting in meetings" :key="meeting.id">
                    <td>
                        <button class="btn btn-info" type="button" @click="loadView(meeting.id)">{{ meeting.name }}
                        </button>
                    </td>
                    <td>{{ meeting.start_time }}</td>
                    <td>{{ meeting.end_time }}</td>
                    <td>{{ meeting.id }}</td>
                </tr>
            </table>
        </div>

        <div v-if="showView">
            <div>
                <p>{{ meeting.name }}</p>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                meetings: [],
                meeting: {},
                showView: false,
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
            loadView: function (id) {
                this.showView = true;
                axios.get('/api/meetings' + id)
                    .then(response => {
                            this.meeting = response.data;
                        }
                    )
            }
        }
    }
</script>
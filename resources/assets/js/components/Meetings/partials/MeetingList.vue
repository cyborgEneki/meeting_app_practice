<template>
    <div>
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
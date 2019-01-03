<template>
    <div>
        <table class="table striped table-bordered">
            <tr v-for="meeting in meetings" :key="meeting.id">
                <td>
                    <router-link :to="'/meetings/'+meeting.id+'/details'" >
                        {{ meeting.name }}
                    </router-link>
                </td>
                <td>{{ meeting.start_time }}</td>
                <td>{{ meeting.end_time }}</td>
                <td>{{ meeting.id }}</td>
            </tr>
        </table>

        <router-view/>

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
            }
        }
    }
</script>

<style scoped>
    .same-line {
        display: inline-block;
    }
</style>
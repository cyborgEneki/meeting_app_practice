<template>
    <div>
        <label>Name</label>
        <input type="text" v-model="meetingseries.name">
        <label>Frequency</label>
        <input type="text" v-model="meetingseries.frequency">
        <button @click="addMeetingSeries">Save Meeting Series</button>
        <button @click="$router.go(-1)">Go Back to Previous Page</button>
    </div>
</template>

<script>
    export default {
        name: "MeetingSeriesAdd",
        data() {
            return {
                meetingseries: {
                    name: '',
                    frequency: ''
                }
            }
        },
        methods: {
            addMeetingSeries() {
                axios.post('api/meetingseries', this.meetingseries)
                    .then(response => {});
                this.$router.push('/meeting_series');

            }
        }
    }
</script>

<style scoped>

</style>
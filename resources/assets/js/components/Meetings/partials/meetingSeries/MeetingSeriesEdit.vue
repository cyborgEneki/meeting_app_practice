<template>
    <div>
        <label>Name</label>
        <input type="text" v-model="eachmeetingseries.name">
        <label>Frequency</label>
        <input type="text" v-model="eachmeetingseries.frequency">
        <button @click="editMeetingSeries(eachmeetingseries)">Edit this Meeting Type</button>
        <button @click="$router.go(-1)">Go Back to Previous Page</button>
    </div>
</template>

<script>
    import 'vuejs-noty/dist/vuejs-noty.css';

    export default {
        name: "MeetingSeriesEdit",
        props: ['eachmeetingseries'],
        methods: {
            editMeetingSeries(eachmeetingseries) {
                let currentMeetingSeries = {};

                currentMeetingSeries.name = eachmeetingseries.name;
                currentMeetingSeries.frequency = eachmeetingseries.frequency;

                axios.put('/api/meetingseries/' + eachmeetingseries.id, currentMeetingSeries)
                    .then(response => {
                    });
                this.$router.push('/meeting_series');
                this.$noty.success("This meeting series has been edited!");
            }
        }
    }
</script>

<style scoped>

</style>
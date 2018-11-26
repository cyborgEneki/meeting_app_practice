<template>
    <div>
        <label>Name</label>
        <input type="text" v-model="eachmeetingseries.name">
        <label>Frequency</label>
        <input type="text" v-model="eachmeetingseries.frequency">
        <button @click="editMeetingSeries(eachmeetingseries)">Edit this Meeting Type</button>
    </div>
</template>

<script>
    export default {
        name: "MeetingSeriesEdit",
        props: ['eachmeetingseries'],
        methods: {
            editMeetingSeries(eachmeetingseries) {
                console.log (eachmeetingseries);
                let currentMeetingSeries = {};

                currentMeetingSeries.name = eachmeetingseries.name;
                currentMeetingSeries.frequency = eachmeetingseries.frequency;

                axios.put('/api/meetingseries/' + eachmeetingseries.id, currentMeetingSeries)
                    .then(response => {});
            }
        }
    }
</script>

<style scoped>

</style>
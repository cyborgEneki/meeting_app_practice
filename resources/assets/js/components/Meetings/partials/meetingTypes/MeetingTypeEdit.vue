<template>
    <div>
        <label>Name</label>
        <input type="text" v-model="meetingtype.name">
        <button @click="editMeetingType(meetingtype)">Edit this meeting type</button>
    </div>
</template>

<script>
    export default {
        name: "editMeetingType",
        props: ['meetingtype'],
        methods: {
            editMeetingType(meetingtype) {
                let currentMeetingType = {};

                currentMeetingType.name = meetingtype.name;

                axios.put('/api/meetingtypes/' + meetingtype.id, this.currentMeetingType)
                    .then(response => {});
            }
        }
    }
</script>

<style scoped>

</style>
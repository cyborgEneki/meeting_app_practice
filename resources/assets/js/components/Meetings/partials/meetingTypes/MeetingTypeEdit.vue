<template>
    <div>
        <label>Name</label>
        <input type="text" v-model="meetingtype.name">
        <button @click="editMeetingType(meetingtype)">Edit this meeting type</button>
        <button @click="$router.go(-1)">Go Back to Previous Page</button>
    </div>
</template>

<script>
    import 'vuejs-noty/dist/vuejs-noty.css';

    export default {
        name: "editMeetingType",
        props: ['meetingtype'],
        methods: {
            editMeetingType(meetingtype) {
                axios.put('/api/meetingtypes/' + meetingtype.id, meetingtype)
                    .then(response => {
                    });
                this.$router.push('/meeting_type');
                this.$noty.success("This meeting type has been edited!");
            }
        }
    }
</script>

<style scoped>

</style>
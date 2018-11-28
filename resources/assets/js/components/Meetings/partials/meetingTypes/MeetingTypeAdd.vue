<template>
    <div>
        <label>Name</label>
        <input type="text" v-model="meetingtype.name">
        <button @click="addMeetingType">Add Meeting Type</button>
    </div>
</template>
rout
<script>
    export default {
        name: "MeetingTypeAdd",
        data() {
            return {
                meetingtype: {
                    name: ''
                }
            }
        },
        methods: {
            addMeetingType() {
                axios.post('/api/meetingtypes', this.meetingtype)
                    .then(response => {});
                this.$router.push('/meeting_type');
            }
        }
    }
</script>

<style scoped>

</style>
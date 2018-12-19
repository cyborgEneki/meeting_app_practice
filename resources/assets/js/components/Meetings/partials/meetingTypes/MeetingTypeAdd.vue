<template>
    <div>
        <label>Name</label>
        <input type="text" v-model="meetingtype.name">
        <button @click="addMeetingType">Save Meeting Type</button>
        <button @click="$router.go(-1)">Go Back to Previous Page</button>

    </div>
</template>
rout
<script>
    import 'vuejs-noty/dist/vuejs-noty.css';

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
                this.$noty.success("Your meeting type has been saved!");
            }
        }
    }
</script>

<style scoped>

</style>
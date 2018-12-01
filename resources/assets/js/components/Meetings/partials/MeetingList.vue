<template>
    <div>

        <router-link :to="{ name: 'addMeeting' }">Create New Meeting</router-link>

        <table class="table striped table-bordered">
            <thead>
            <th>Name</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Actions</th>
            </thead>
            <tr v-for="meeting in meetings" :key="meeting.id">
                <td @click="loadView(meeting)">{{meeting.name}}</td>
                <td>{{ meeting.date }}</td>
                <td>{{ meeting.start_time }}</td>
                <td>{{ meeting.end_time }}</td>
                <td>
                    <router-link :to="{ name: 'editMeeting' , params: { meeting }}">Edit</router-link>
                    <div class="confirmation__button">
                        <vue-confirmation-button
                                :messages="customMessages"
                                v-on:confirmation-success="deleteUser(meeting.id)">
                        </vue-confirmation-button>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
    import vueConfirmationButton from 'vue-confirmation-button';

    export default {
        components: {
            'vue-confirmation-button': vueConfirmationButton,
        },
        data() {
            return {
                meetings: [],
                customMessages:
                    [
                        'Delete',
                        'Are you sure?',
                        'Ok!'
                    ]
            }
        },
        methods: {
            getMeetings() {
                axios.get('/api/meetings')
                    .then(response => {
                            this.meetings = response.data;
                        }
                    )
            },
            loadView: function (meeting) {
                this.$store.commit('GET_MEETING_DETAILS', meeting);
            },
            deleteMeeting(id) {
                this.$dialog.confirm('Please confirm to continue')
                    .then(function (dialog) {
                        console.log('Clicked on proceed')
                    })
                    .catch(function () {
                        console.log('Clicked on cancel')
                    });
                
                axios.delete('/api/meetings/'+id)
                    .then(() => {
                        let index = this.meetings.map(function(item){
                            return item.id
                        }).indexOf(id);
                        this.meetings.splice(index, 1);
                    });
            }
        },
        created() {
            this.getMeetings();
        },

    }
</script>

<style scoped>

</style>
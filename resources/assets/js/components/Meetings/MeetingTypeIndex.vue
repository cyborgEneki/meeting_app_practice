<template>
    <div>
        <router-link :to="{ name: 'addMeetingType' }">Create a new meeting type</router-link>
        <table class="table striped table-bordered">
            <thead>
            <th>Name</th>
            <th>Actions</th>
            </thead>
            <tr v-for="meetingtype in orderedMeetingTypes" :key="meetingtype.id">
                <td>{{ meetingtype.name }}</td>
                <td>
                    <router-link :to="{ name: 'editMeetingType', params: { meetingtype } }">Edit</router-link>
                    <button @click="deleteMeetingType(meetingtype.id)">Delete</button>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        name: "MeetingType",
        props: ['choices'],
        data() {
            return {
                meetingtypes: []
            }
        },
        computed: {
            orderedMeetingTypes() {
                return _.orderBy(this.choices.meetingtypes, 'name');
            }
        },
        created() {
            axios.get('/api/meetingtypes')
                .then(response => {
                    this.meetingtypes = response.data;
                })
        },
        methods: {
            deleteMeetingType(id) {
                axios.delete('/api/meetingtypes/' + id, this.meetingtypes)
                    .then(() => {
                        let index = this.meetingtypes.map(item => {
                            return item.id;
                        }).indexOf(id);
                        this.meetingtypes.splice(index, 1);
                    })
            }
        }
    }
</script>

<style scoped>

</style>
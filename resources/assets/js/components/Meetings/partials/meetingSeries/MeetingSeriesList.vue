<template>
    <div>
        <router-link :to="{ name: 'addMeetingSeries' }">Add a Type of Meeting Series</router-link>
        <h3>Meeting Series</h3>
        <table>
            <thead>
            <th>Name</th>
            <th>Frequency</th>
            <th>Actions</th>
            </thead>
            <tr v-for="eachmeetingseries in orderedMeetingSeries">
                <td>{{eachmeetingseries.name}}</td>
                <td>{{eachmeetingseries.frequency}}</td>
                <td>
                    <router-link :to="{ name: 'editMeetingSeries', params: { eachmeetingseries } }">Edit</router-link>
                    <button @click="deleteMeetingSeries(eachmeetingseries.id)">Delete</button>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        name: "MeetingSeriesList",
        props: ['choices'],
        data() {
            return {
                meetingseries: []
            }
        },
        computed: {
            orderedMeetingSeries: function () {
                return _.orderBy(this.choices.meetingseries, 'name')
            }
        },
        methods: {
            deleteMeetingSeries(id) {
                axios.delete('/api/meetings/' + id)
                    .then(() => {
                        let index = this.meetingseries.map((item) => {
                                return item.id
                        }).indexOf(id);
                        this.meetingseries.splice(index, 1);
                    })
            }
        }
    }
</script>

<style scoped>

</style>
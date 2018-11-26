<template>
    <div>
        <h4>Meeting Name: </h4>
        <p>{{ meeting.name }}</p>
        <h4>Creator:</h4>
        <p>{{ meeting.creator_id.first_name }}</p>
        <h4>Facilitator:</h4>
        <p>{{ meeting.facilitator_id.first_name }}</p>
        <h4>Time Keeper:</h4>
        <p>{{ meeting.time_keeper_id.first_name }}</p>
        <h4> Attendees</h4>
        <div v-for="user in meeting.users">
            <p>{{ user.first_name }}</p>
            <p @click="removeUsers(user.id)">Remove</p>
        </div>
        <h4>Agendas:</h4>
        <table class="table striped table-bordered">
            <thead>
            <th>Topic</th>
            <th>Description</th>
            <th>Time Allocated (minutes)</th>
            <th>Status</th>
            <th>Conclusion</th>
            <th>Follow Up Action</th>
            <th>Discussions</th>
            </thead>
            <tr v-for="agendas in meeting.agendas">
                <td>{{ agendas.topic }}</td>
                <td>{{ agendas.description }}</td>
                <td>{{ agendas.time_allocated }}</td>
                <td>{{ agendas.agenda_status }}</td>
                <td>{{ agendas.conclusion }}</td>
                <td v-for="description in agendas.followups"> {{description.action}}</td>
                <td><h6 v-for="description in agendas.discussion"> {{description.description}}</h6></td>
            </tr>
        </table>
        <label>Add Attendee</label>

        <button @click="addUser(users.id)">cf</button>

        <h4>Venue:</h4>
        <p>{{ meeting.venue.name }}</p>
        <h4>Media:</h4>
        <p>{{ meeting.media.name }}</p>
        <h4>Meeting Type:</h4>
        <p>{{ meeting.meetingtype.name }}</p>
        <h4>Meeting Series:</h4>
        <p>{{ meeting.meetingseries.name }}</p>
        <hr/>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        computed: {
            ...mapGetters({
                meeting: 'meeting',
            })
        },
        data() {
            return {
                users: []
            }
        },
        created() {
            axios.get('/api/users')
                .then(response => {
                        this.users = response.data;
                    }
                );
        },
        methods: {
            removeUsers(id) {
                axios.delete('/api/meetings/' + this.meeting.id + '/users/' + id)
                    .then((response) => {
                        let index = this.meeting.users.map(function (item) {
                            return item.id
                        }).indexOf(id);
                        this.meeting.users.splice(index, 1);
                    });
            },
            addUser: function (id) {
                let checkMtg = this.meeting.users.filter(function (user) {
                    return user.id === id;
                });
                //only add user if that user isn't already in the meeting
                if (!checkMtg.length) {
                    axios.get('/api/meetings/' + this.meeting.id + '/users/' + id)
                        .then((response) => {
                            this.meeting.users.push(response.data.user);
                        });
                } else {
                    console.log('User already exists');
                }
            }
        },
    }
</script>

<template>
    <div>
        <h4>Meeting Name: </h4>
        <p>{{ meeting.name }}</p>
        <h4>Creator:</h4>
        <p>{{ choices.users[meeting.creator_id].full_name }}</p>
        <h4>Facilitator:</h4>
        <p>{{ choices.users[meeting.facilitator_id].full_name }}</p>
        <h4>Time Keeper:</h4>
        <p>{{ choices.users[meeting.time_keeper_id].full_name }}</p>
        <h4> Attendees</h4>
        <div v-for="user in orderedUsers">
            <p>{{ user.full_name }}</p>
            <p @click="removeUsers(user.id)">Remove</p>
        </div>
        <h4>Agendas:</h4>
        <div>
            <ul v-for="agendas in meeting.agendas">
                <li>Agenda</li>
                <ul>
                    <li>Assignee {{ choices.users[agendas.user_id].full_name }}</li>
                    <li>Topic {{ agendas.topic }}</li>
                    <li>Description {{ agendas.description }}</li>
                    <li>Time Allocated (minutes){{ agendas.time_allocated }}</li>
                    <li>Status {{ agendas.agenda_status }}</li>
                    <li>Conclusion {{ agendas.conclusion }}</li>
                    <li v-for="description in meeting.agendas.followups">Follow Up Action {{description.action}}</li>
                    <li><h6 v-for="description in agendas.discussion">Discussions {{description.description}}</h6></li>
                </ul>
            </ul>
        </div>

        <label>Add Attendee</label>

        <button @click="addUser(users.id)">cf</button>

        <h4>Venue:</h4>
        <p>{{ choices.venues[meeting.venue_id].name }}</p>
        <h4>Media:</h4>
        <p> {{ choices.media[meeting.media_id].name }}</p>
        <h4>Meeting Type:</h4>
        <p> {{ choices.meetingtypes[meeting.meetingtype_id].name }}</p>
        <h4>Meeting Series:</h4>
        <p>{{ choices.meetingseries[meeting.meetingseries_id].name }}</p>
        <hr/>
        <button @click="test">Test</button>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        props: ['choices'],
        computed: {
            ...mapGetters({
                meeting: 'meeting',
            }),
            orderedUsers() {
                return _.orderBy(this.meeting.users, 'first_name');
            }
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
            test() {
                console.log(this.meeting)
            },
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

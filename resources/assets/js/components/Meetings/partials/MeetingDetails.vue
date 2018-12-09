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
            <ul v-for="(agendas, index) in meeting.agendas">
                <li>Agenda</li>
                <ul>
                    <li>Assignee {{ choices.users[agendas.user_id].full_name }}</li>
                    <li>Agenda {{index+1}}: {{ agendas.topic }}</li>
                    <li>Description {{ agendas.description }}</li>
                    <li>Time Allocated (minutes) {{ agendas.time_allocated }}</li>
                    <li>Status {{ agendas.agenda_status }}</li>
                    <li>Conclusion {{ agendas.conclusion }}</li>
                    <li>Follow ups</li>
                    <ul v-for="followup in agendas.followups">
                        <li>Action {{followup.action}}</li>
                        <li>Timeline {{followup.timeline}}</li>
                        <li>Status {{followup.status}}</li>
                        <li></li>
                    </ul>
                    <li><h6 v-for="description in agendas.discussion">Discussions {{description.description}}</h6></li>
                </ul>
                <li @click="success = !success">Add Agenda</li>
                <div v-if="success">
                    <div v-for="(agenda,index) in meeting.agendas">
                        <div>
                            Agenda Topic<input type="text" v-model="meeting.agendas[index].topic">
                        </div>
                        <div>
                            Agenda Description<textarea type="text" v-model="meeting.agendas[index].description"></textarea>
                        </div>
                        <div>
                            Time Allocated
                            <select type="text" v-model="meeting.agendas[index].time_allocated">
                                <option value="">Select time</option>
                                <option v-for="time in timing">{{ time }}</option>
                            </select>
                        </div>
                        <div>
                            <label>User Assigned to Agenda</label>
                            <select v-model="meeting.agendas[index].user_id">
                                <option value="">Select user</option>
                                <option v-for="user in orderedUsers" v-bind:value="user.id">{{ user.full_name }}
                                </option>
                            </select>
                        </div>
                        <div>
                            Agenda Status
                            <select type="text" v-model="meeting.agendas[index].agenda_status">
                                <option value="">Select status</option>
                                <option v-for="status in statuses" v-bind:value="status.id">{{ status.name }}</option>
                            </select>
                        </div>
                    </div>

                    <button @click="addAgenda">Save Agenda</button>
                    <li @click="success = !success">Hide Agenda Form</li>

                </div>
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
                users: [],
                success: false,
                statuses:
                    [
                        {id: 0, name: 'Pending'},
                        {id: 1, name: 'Accepted'},
                        {id: 2, name: 'Rejected'}
                    ],
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

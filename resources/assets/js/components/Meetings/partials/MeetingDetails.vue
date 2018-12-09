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
        <div v-for="user in orderedAttendees">
            <p>{{ user.full_name }}</p>
            <p @click="removeUsers(user.id)">Remove</p>
        </div>
        <h4>Agendas:</h4>
        <div>
            <div v-for="(agendas, index) in meeting.agendas">
                <fieldset>
                    <h2>Agenda {{ index + 1 }}: {{ agendas.topic }}</h2>
                    <div>
                        <div v-show="editAgenda.id != agendas.id">
                            <div>Assignee {{ choices.users[agendas.user_id].full_name }}</div>
                            <div>Description {{ agendas.description }}</div>
                            <div>Time Allocated (minutes) {{ agendas.time_allocated }}</div>
                            <div>Status {{ agendas.agenda_status }}</div>
                            <div>Conclusion {{ agendas.conclusion }}</div>
                            <div v-for="followup in agendas.followups">Follow Up
                                <div v-show="editFollowup.id != followup.id">
                                    <div>
                                        <li>Action {{followup.action}}</li>
                                        <li>Timeline {{followup.timeline}}</li>
                                        <li>Status {{followup.status}}</li>
                                        <div>
                                            <button @click="toggleFollowupEdit(followup.id)">Edit Followup</button>
                                        </div>
                                    </div>
                                </div>
                                <div v-show="editFollowup.id == followup.id">
                                    <div>Action<input type="text" v-model="editFollowup.action"></div>
                                    <div>Timeline <input type="text" v-model="editFollowup.timeline"></div>
                                    <div>Status
                                        <select v-model="editFollowup.status">
                                            <option value="">Select status</option>
                                            <option v-for="status in statuses" v-bind:value="status.id">{{status.name}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button @click="toggleAgendaEdit(agendas.id)">Edit Agenda</button>
                            </div>
                            <!--<li><h6 v-for="description in agendas.discussion">Discussions {{description.description}}</h6></li>-->
                        </div>
                        <div v-show="editAgenda.id==agendas.id">
                            <div>Topic<input type="text" v-model="editAgenda.topic"></div>
                            <div>Description<input type="text" v-model="editAgenda.description"></div>
                            <div>
                                Time Allocated (minutes)
                                <select type="text" v-model="editAgenda.time_allocated">
                                    <option value="">Select time</option>
                                    <option v-for="time in timing">{{ time }}</option>
                                </select>
                            </div>
                            <div>
                                <label>User Assigned</label>
                                <select v-model="editAgenda.user_id">
                                    <option value="">Select user</option>
                                    <option v-for="user in orderedUsers" v-bind:value="user.id">{{ user.full_name }}
                                    </option>
                                </select>
                            </div>
                            <div>
                                Status
                                <select type="text" v-model="editAgenda.agenda_status">
                                    <option value="">Select status</option>
                                    <option v-for="status in statuses" v-bind:value="status.id">{{ status.name }}
                                    </option>
                                </select>
                            </div>
                            <div>Conclusion<input type="text" v-model="editAgenda.conclusion"></div>
                            <div>
                                <button @click="saveAgendaEdit()">Save Edit</button>
                            </div>
                            <div>
                                <a  href="#" @click="editAgenda = {}" >Cancel</a>
                            </div>
                        </div>

                    </div>
                </fieldset>
            </div>
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
                return _.orderBy(this.choices.users, 'first_name');
            },
            orderedAttendees() {
                return _.orderBy(this.meeting.users, 'first_name');
            }
        },
        data() {
            return {
                timing: [5, 10, 15, 20, 25, 30, 45, 60, 75, 90],
                users: [],
                editAgenda: {
                    id: '',
                    topic: '',
                    description: '',
                    time_allocated: '',
                    user_id: '',
                    agenda_status: 0,
                },
                editFollowup: {
                    action: '',
                    timeline: '',
                    status: ''
                },
                success: false,
                statuses:
                    [
                        {id: 0, name: 'Pending'},
                        {id: 1, name: 'Accepted'},
                        {id: 2, name: 'Rejected'}
                    ],
            }
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
                    alert('User already exists');
                }
            },
            toggleAgendaEdit(id) {
                let index = this.meeting.agendas.map(function (item) {
                    return item.id
                }).indexOf(id);
                this.editAgenda = this.meeting.agendas[index];
            },
            toggleFollowupEdit(id) {
                let index = this.meeting.agendas.followups.map(function (item) {
                    return item.id
                }).indexOf(id);
                this.editFollowup= this.meeting.agendas.followups[index];
            },
            saveAgendaEdit() {
                axios.put('/api/agendas/' + this.editAgenda.id, this.editAgenda)
                    .then((response) => {
                        this.editAgenda = {};
                    });
            }
        },
    }
</script>

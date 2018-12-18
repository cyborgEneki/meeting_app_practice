<template>
    <div>

        <!--First part of the form-->

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
        <label>Add Attendee</label>
        <button @click="addUser(users.id)">Add</button>

        <!--Read agendas-->

        <h4>Agendas:</h4>
        <div>
            <div v-for="(agenda, index) in meeting.agendas">
                <fieldset>

                    <div>
                        <h2>Agenda {{ index + 1 }}: {{ agenda.topic }}</h2>

                        <!--Create agenda-->

                        <a href="#" @click.prevent="editAgenda=true">Add Agenda</a>
                        <div v-show="editAgenda">
                            <div>
                                Topic<input type="text" v-model="editAgenda.topic">
                            </div>
                            <div>
                                Description<input type="text" v-model="editAgenda.description">
                            </div>
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
                            <button @click="saveAgendaCreate(meeting.id)">Save Agenda</button>
                        </div>

                        <!--Start edit agenda-->

                        <div>
                            <div v-show="editAgenda.id != agenda.id">
                                <div @click="startAgendaEdit(agenda.id)">
                                    <div>Assignee {{ choices.users[agenda.user_id].full_name }}</div>
                                    <div>Description {{ agenda.description }}</div>
                                    <div>Time Allocated (minutes) {{ agenda.time_allocated }}</div>
                                    <div>Status {{ agenda.agenda_status }}</div>
                                    <div>Conclusion {{ agenda.conclusion }}</div>
                                </div>

                                <!--Create followup form-->

                                <div>
                                    <a href="#" @click.prevent="showFollowupCreate(agenda.id)">Add Followup</a>
                                    <div v-show="editItem == 'followup'+agenda.id">
                                        Action<input type="text" v-model="editFollowup.action">
                                        Timeline<input type="text" v-model="editFollowup.timeline">
                                        Followup Status
                                        <select type="text" v-model="editFollowup.status">
                                            <option value="">Select status</option>
                                            <option v-for="status in statuses" v-bind:value="status.id">{{ status.name
                                                }}
                                            </option>
                                        </select>
                                        <a href="#" @click="cancelFollowup">Cancel</a>
                                        <a href="#" @click="addFollowup">Save</a>

                                    </div>
                                </div>

                                <!--Read followup-->

                                <div v-for="followup in agenda.followups">Follow Up
                                    <div v-show="editFollowup.id != followup.id">
                                        <div>
                                            <div @click="startFollowupEdit(followup.id, agenda.id)">
                                                <li>Action {{followup.action}}</li>
                                                <li>Timeline {{followup.timeline}}</li>
                                                <li>Status {{followup.status}}</li>
                                            </div>
                                            <div>
                                                <button @click="startFollowupEdit(followup.id, agenda.id)">Edit
                                                    Followup
                                                </button>
                                                <a href="#" @click="deleteFollowup(followup.id, agenda.id)">Delete</a>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Edit followup form-->

                                    <div v-show="editFollowup.id == followup.id">
                                        <form @click.prevent>
                                            <div>Action<input type="text" v-model="editFollowup.action"></div>
                                            <div>Timeline <input type="text" v-model="editFollowup.timeline"></div>
                                            <div>Status
                                                <select v-model="editFollowup.status">
                                                    <option value="">Select status</option>
                                                    <option v-for="status in statuses" v-bind:value="status.id">
                                                        {{status.name}}
                                                    </option>
                                                </select>
                                            </div>
                                            <button @click="saveFollowupEdit">Edit</button>
                                            <div>
                                                <a href="#" @click="cancelFollowup">Cancel</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <button @click='addFollowup'>Save</button>

                                <!--Edit Agenda Button-->

                                <div>
                                    <button @click="startAgendaEdit(agenda.id)">Edit Agenda</button>
                                </div>
                            </div>
                        </div>

                        <!--Edit agenda form-->

                        <form @click.prevent>
                            <div v-show="editAgenda.id==agenda.id">
                                <div>Topic<input type="text" v-model="editAgenda.topic">
                                </div>
                                <div>Description<input type="text" v-model="editAgenda.description">
                                </div>
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
                                <div>Conclusion<input type="text"
                                                      v-model="editAgenda.conclusion"></div>
                                <div>
                                    <button @click="saveAgendaEdit">Save Edit</button>
                                </div>
                                <div>
                                    <a href="#" @click="editAgenda = {}">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </fieldset>
            </div>
        </div>

        <!--Second part of the form-->

        <h4>Venue:</h4>
        <p>{{ choices.venues[meeting.venue_id].name }}</p>
        <h4>Media:</h4>
        <p> {{ choices.media[meeting.media_id].name }}</p>
        <h4>Meeting Type:</h4>
        <p> {{ choices.meetingtypes[meeting.meetingtype_id].name }}</p>
        <h4>Meeting Series:</h4>
        <p>{{ choices.meetingseries[meeting.meetingseries_id].name }}</p>
        <hr/>
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
                addItem: {},
                editItem: {},
                timing: [5, 10, 15, 20, 25, 30, 45, 60, 75, 90],
                users: [],
                editAgenda: {
                    id: '',
                    topic: '',
                    description: '',
                    time_allocated: '',
                    user_id: '',
                    agenda_status: 0,
                    meeting_id: ''
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
        mounted() {
            console.log(this.meeting.agendas);
        },
        methods: {
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
            removeUsers(id) {
                axios.delete('/api/meetings/' + this.meeting.id + '/users/' + id)
                    .then((response) => {
                        let index = this.meeting.users.map(function (item) {
                            return item.id
                        }).indexOf(id);
                        this.meeting.users.splice(index, 1);
                    });
            },

            startAgendaEdit(id) {
                let index = this.meeting.agendas.map(function (item) {
                    return item.id
                }).indexOf(id);
                this.editAgenda = Object.assign({}, this.meeting.agendas[index]);
            },
            saveAgendaEdit() {
                axios.put('/api/agendas/' + this.editAgenda.id, this.editAgenda)
                    .then((response) => {
                        this.editAgenda = {};
                    });
            },
            saveAgendaCreate(meetingId) {
                this.editAgenda.meeting_id = meetingId;
                axios.post('/api/agendas', this.editAgenda)
                    .then(() => {
                        this.editAgenda = {};

                    })
            },

            showFollowupCreate(agendaId) {
                this.editItem = 'followup' + agendaId;
                this.editFollowup.agenda_id = agendaId;
            },
            startFollowupEdit(followupId, agendaId) {
                //get the index of the agenda you are editing in
                let agendaindex = this.meeting.agendas.map(function (item) {
                    return item.id
                }).indexOf(agendaId);

                //get the index of the followup to be edited
                let followupindex = this.meeting.agendas[agendaindex].followups.map(function (item) {
                    return item.id
                }).indexOf(followupId);

                //load the values of the followup from meeting into the editFollowup variable in data
                this.editFollowup = Object.assign({}, this.meeting.agendas[agendaindex].followups[followupindex]);
            },

            saveFollowupEdit() {
                axios.put('/api/followups/' + this.editFollowup.id, this.editFollowup)
                    .then((response) => {
                        this.editFollowup = {};
                    });
            },
            cancelFollowup() {
                this.editFollowup = {};
            },
            deleteFollowup(followupId, agendaId) {
                axios.delete('/api/followups/' + followupId)
                    .then((response) => {
                        let agendaindex = this.meeting.agendas.map(function (item) {
                            return item.id
                        }).indexOf(agendaId);
                        let followupindex = this.meeting.agendas[agendaindex].followups.map(function (item) {
                            return item.id
                        }).indexOf(followupId);
                        this.meeting.agendas[agendaindex].followups.splice(followupindex, 1);
                    });
            },
            addFollowup() {
                axios.post('/api/followups', this.editFollowup)
                    .then(() => {
                        this.editFollowup = {};
                    })
            }
        }
    }
</script>
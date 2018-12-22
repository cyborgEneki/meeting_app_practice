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
            <p @click.prevent="removeUsers(user.id)">Remove</p>
        </div>
        <label>Add Attendee</label>
        <button @click.prevent="addUser(users.id)">Add</button>

        <!--Create agenda-->
        <br>

        <div v-show="dataItem === 'agenda'">
            <div>
                Topic<input type="text" v-model="dataHolder.topic">
            </div>
            <div>
                Description<input type="text" v-model="dataHolder.description">
            </div>
            <div>
                Time Allocated (minutes)
                <select type="text" v-model="dataHolder.time_allocated">
                    <option value="">Select time</option>
                    <option v-for="time in timing">{{ time }}</option>
                </select>
            </div>
            <div>
                <label>User Assigned</label>
                <select v-model="dataHolder.user_id">
                    <option value="">Select user</option>
                    <option v-for="user in orderedUsers" v-bind:value="user.id">{{ user.full_name }}
                    </option>
                </select>
            </div>
            <button @click="saveAgendaCreate(meeting.id)">Save Agenda</button>
            <div>
                <a href="#" @click="cancelAgenda">Cancel</a>
            </div>
        </div>

        <!--Read agendas-->

        <h4>Agendas:</h4>
        <div>
            <div v-for="(agenda, index) in meeting.agendas">
                <fieldset>

                    <a href="#" @click.prevent="deleteAgenda(agenda.id)">Delete</a>

                    <div>
                        <h2>Agenda {{ index + 1 }}: {{ agenda.topic }}</h2>

                        <!--Start edit agenda-->

                        <div>
                            <div v-show="dataHolder.id != agenda.id">
                                <div @click.prevent="startAgendaEdit(agenda.id)">
                                    <div>Assignee {{ choices.users[agenda.user_id].full_name }}</div>
                                    <div>Description {{ agenda.description }}</div>
                                    <div>Time Allocated (minutes) {{ agenda.time_allocated }}</div>
                                    <div>Status {{ agenda.agenda_status }}</div>
                                    <div>Conclusion {{ agenda.conclusion }}</div>
                                </div>

                                <!--Create followup form-->

                                <div>
                                    <a href="#" @click.prevent="showFollowupCreate(agenda.id)">Add Followup</a>
                                    <div v-show="dataItem === 'followup'+agenda.id">
                                        Action<input type="text" v-model="dataHolder.action">
                                        Timeline<input type="text" v-model="dataHolder.timeline">
                                        Followup Status
                                        <select type="text" v-model="dataHolder.status">
                                            <option value="">Select status</option>
                                            <option v-for="status in statuses" v-bind:value="status.id">{{ status.name
                                                }}
                                            </option>
                                        </select>
                                        <a href="#" @click.prevent="cancelFollowup">Cancel</a>
                                        <a href="#" @click.prevent="saveFollowup">Save</a>

                                    </div>
                                </div>

                                <!--Read followup-->

                                <div v-for="followup in agenda.followups">Follow Up
                                    <div v-show="dataHolder.id !== followup.id">
                                        <div>
                                            <div @click.prevent="startFollowupEdit(followup.id, agenda.id)">
                                                <li>Action {{followup.action}}</li>
                                                <li>Timeline {{followup.timeline}}</li>
                                                <li>Status {{followup.status}}</li>
                                            </div>
                                            <div>
                                                <button @click.prevent="startFollowupEdit(followup.id, agenda.id)">Edit
                                                    Followup
                                                </button>
                                                <a href="#" @click.prevent="deleteFollowup(followup.id, agenda.id)">Delete</a>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Edit followup form-->

                                    <div v-show="dataHolder.id === followup.id">
                                        <form @click.prevent>
                                            <div>Action<input type="text" v-model="dataHolder.action"></div>
                                            <div>Timeline <input type="text" v-model="dataHolder.timeline"></div>
                                            <div>Status
                                                <select v-model="dataHolder.status">
                                                    <option value="">Select status</option>
                                                    <option v-for="status in statuses" v-bind:value="status.id">
                                                        {{status.name}}
                                                    </option>
                                                </select>
                                            </div>
                                            <button @click.prevent="saveFollowupEdit">Edit</button>
                                            <div>
                                                <a href="#" @click.prevent="cancelFollowup">Cancel</a>
                                                <button @click.prevent='saveFollowup'>Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                                <hr>

                                <!--Create discussion form-->

                                <div>
                                    <a href="#" @click.prevent="showDiscussionCreate(agenda.id) ">Add Discussion</a>
                                    <div v-show="dataItem === 'discussion'">
                                        Description<input type="text" v-model="dataHolder.description">
                                        <a href="#" @click.prevent="cancelDiscussion">Cancel</a>
                                        <a href="#" @click.prevent="saveDiscussion(agenda.id)">Save</a>
                                    </div>
                                </div>

                                <!--Read discussions-->

                                <div v-for="discussion in agenda.discussions"> Discussion
                                    <div v-show="dataItem !== 'discussion'+ discussion.id">

                                    <div>
                                            <div @click.prevent="startDiscussionEdit(discussion.id, agenda.id)">
                                                <li>Description {{discussion.description}}</li>
                                            </div>
                                            <div>
                                                <button @click.prevent="startDiscussionEdit(discussion.id, agenda.id)">Edit
                                                    Discussion
                                                </button>
                                                <a href="#"
                                                   @click.prevent="deleteDiscussion(discussion.id, agenda.id)">Delete</a>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Edit Discussion-->

                                    <div v-show="dataItem === 'discussion'+discussion.id">
                                        <form @click.prevent>
                                            Description <input type="text" v-model="dataHolder.description">
                                            <button @click.prevent="saveDiscussionEdit(agenda.id, discussion.id)">Save Discussion</button>
                                            <a href="#" @click.prevent="cancelDiscussion">Cancel</a>
                                        </form>
                                    </div>
                                </div>

                                <hr>

                                <!--Edit Agenda Button-->

                                <div>
                                    <button @click.prevent="startAgendaEdit(agenda.id)">Edit Agenda</button>
                                </div>
                            </div>
                        </div>

                        <!--Edit agenda form-->

                        <form @click.prevent>
                            <div v-show="dataHolder.id === agenda.id">
                                <div>Topic<input type="text" v-model="dataHolder.topic">
                                </div>
                                <div>Description<input type="text" v-model="dataHolder.description">
                                </div>
                                <div>
                                    Time Allocated (minutes)
                                    <select type="text" v-model="dataHolder.time_allocated">
                                        <option value="">Select time</option>
                                        <option v-for="time in timing">{{ time }}</option>
                                    </select>
                                </div>
                                <div>
                                    <label>User Assigned</label>
                                    <select v-model="dataHolder.user_id">
                                        <option value="">Select user</option>
                                        <option v-for="user in orderedUsers" v-bind:value="user.id">{{ user.full_name }}
                                        </option>
                                    </select>
                                </div>
                                <div>
                                    Status
                                    <select type="text" v-model="dataHolder.agenda_status">
                                        <option value="">Select status</option>
                                        <option v-for="status in statuses" v-bind:value="status.id">{{ status.name }}
                                        </option>
                                    </select>
                                </div>
                                <div>Conclusion<input type="text"
                                                      v-model="dataHolder.conclusion"></div>
                                <div>
                                    <button @click.prevent="saveAgendaEdit">Save Edit</button>
                                </div>
                                <div>
                                    <a href="#" @click.prevent="dataHolder = {}">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </fieldset>
            </div>
        </div>

        <a href="#" @click.prevent="dataItem='agenda'">Add Agenda</a>

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
                dataItem: '',
                timing: [5, 10, 15, 20, 25, 30, 45, 60, 75, 90],
                users: [],
                dataHolder: {},
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
                this.dataHolder = Object.assign({}, this.meeting.agendas[index]);
            },
            saveAgendaEdit() {
                axios.put('/api/agendas/' + this.dataHolder.id, this.dataHolder)
                    .then((response) => {
                        this.dataHolder = {};
                        this.meeting.agendas.push(response.data);
                    });
                this.dataItem = '';
            },
            saveAgendaCreate(meetingId) {
                this.dataHolder.meeting_id = meetingId;
                axios.post('/api/agendas', this.dataHolder)
                    .then((response) => {
                        this.dataHolder = {};
                        this.meeting.agendas.push(response.data);
                    });
                this.dataItem = '';
            },
            cancelAgenda() {
                this.dataHolder = {};
                this.dataHolder = '';
            },
            deleteAgenda(agendaId) {
                axios.delete('/api/agendas/' + agendaId)
                    .then(() => {
                        let agendaindex = this.meeting.agendas.map(function (item) {
                            return item.id
                        }).indexOf(agendaId);
                        this.meeting.agendas.splice(agendaindex, 1);
                    });
            },
            showFollowupCreate(agendaId) {
                this.dataItem = 'followup' + agendaId;
                this.dataHolder.agenda_id = agendaId;
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

                //load the values of the followup from meeting into the dataHolder variable in data
                this.dataHolder = Object.assign({}, this.meeting.agendas[agendaindex].followups[followupindex]);
            },
            saveFollowupEdit() {
                axios.put('/api/followups/' + this.dataHolder.id, this.dataHolder)
                    .then((response) => {
                        this.dataHolder = {};
                    });
            },
            cancelFollowup() {
                this.dataHolder = {};
                this.dataItem = '';

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
            saveFollowup() {
                let agendaIndex = this.meeting.agendas.map(function (item) {
                    return item.id;
                }).indexOf(agendaId);
                axios.post('/api/followups', this.dataHolder)
                    .then(() => {
                        this.dataHolder = {};
                        this.meeting.agendas[agendaIndex].followups.push(response.data);
                    });
                this.dataItem = '';
            },
            showDiscussionCreate(agendaId) {
                this.dataItem = 'discussion';
                this.dataHolder.agenda_id = agendaId;
            },
            cancelDiscussion() {
                this.dataHolder = {};
                this.dataItem = '';

            },
            saveDiscussion(agendaId) {
                let agendaIndex = this.meeting.agendas.map(function (item) {
                    return item.id;
                }).indexOf(agendaId);
                axios.post('/api/discussions', this.dataHolder)
                    .then((response) => {
                        this.dataHolder = {};
                        this.meeting.agendas[agendaIndex].discussions.push(response.data);
                        this.dataItem = '';
                    });
            },
            startDiscussionEdit(discussionId, agendaId) {
                let agendaIndex = this.meeting.agendas.map(function (item) {
                    return item.id
                }).indexOf(agendaId);

                let discussionIndex = this.meeting.agendas[agendaIndex].discussions.map(function (item) {
                    return item.id
                }).indexOf(discussionId);

                this.dataItem = 'discussion' + discussionId;
                this.dataHolder = Object.assign({}, this.meeting.agendas[agendaIndex].discussions[discussionIndex]);
            },

            saveDiscussionEdit(agendaId, discussionId) {

                let agendaIndex = this.meeting.agendas.map(function (item) {
                    return item.id;
                }).indexOf(agendaId);

                let discussionIndex = this.meeting.agendas[agendaIndex].discussions.map(function (item) {
                    return item.id;
                }).indexOf(discussionId);

                axios.put('/api/discussions/' + this.dataHolder.id, this.dataHolder)
                    .then((response) => {
                        this.meeting.agendas[agendaIndex].discussions[discussionIndex] = Object.assign({}, this.dataHolder);
                        this.dataItem = '';
                    });
            },

            deleteDiscussion(discussionId, agendaId) {
                axios.delete('api/discussions/' + discussionId)
                    .then((response) => {
                        let agendaIndex = this.meeting.agendas.map(function (item) {
                            return item.id
                        }).indexOf(agendaId);

                        let discussionIndex = this.meeting.agendas[agendaIndex].discussions.map(function (item) {
                            return item.id;
                        }).indexOf(discussionId);

                        this.meeting.agendas[agendaIndex].discussions.splice(discussionIndex, 1);
                    });
            }
        }
    }
</script>
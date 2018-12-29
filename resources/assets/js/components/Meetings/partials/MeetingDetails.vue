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
        <a href="#" @click.prevent="showAgendaCreate(meeting.id)" v-show="dataItem !=='agendaCreate'">Add Agenda</a>
        <div v-show="dataItem === 'agendaCreate'">
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
                Agenda Status
                <select type="text" v-model="dataHolder.agenda_status">
                    <option value="">Select status</option>
                    <option v-for="agendaStatus in agendaStatuses" v-bind:value="agendaStatus.id">{{ agendaStatus.name
                        }}
                    </option>
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
            <button v-show="isAgendaComplete" @click.prevent="saveAgendaCreate">Save Agenda</button>
            <div>
                <a href="#" @click.prevent="cancelAgenda">Cancel</a>
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

                        <!--Start read agenda-->

                        <div>
                            <div v-show="dataItem !== 'agendaEdit'+ agenda.id">
                                <div @click.prevent="startAgendaEdit(agenda.id)">
                                    <div>Assignee {{ choices.users[agenda.user_id].full_name }}</div>
                                    <div>Description {{ agenda.description }}</div>
                                    <div>Time Allocated (minutes) {{ agenda.time_allocated }}</div>
                                    <div v-if="agenda.agenda_status">Agenda Status {{ agendaStatuses[agenda.agenda_status].name }}</div>
                                    <div>Conclusion {{ agenda.conclusion }}</div>
                                </div>

                                <!--Create followup form-->

                                <div>
                                    <a href="#" @click.prevent="showFollowupCreate(agenda.id)"
                                       v-show="dataItem !== 'followupCreate'+agenda.id">Add Followup</a>
                                    <div v-show="dataItem === 'followupCreate'+agenda.id">
                                        Action<input type="text" v-model="dataHolder.action">
                                        Timeline<input type="text" v-model="dataHolder.timeline">
                                        Followup Status
                                        <select type="text" v-model="dataHolder.status=0">
                                            <option v-for="status in statuses" v-bind:value="status.id">{{ status.name
                                                }}
                                            </option>
                                        </select>
                                        <a href="#" @click.prevent="cancelFollowup">Cancel</a>
                                        <a href="#" v-show="isFollowupComplete"
                                           @click.prevent="saveFollowup(agenda.id)">Save</a>

                                    </div>
                                </div>

                                <!--Read followup-->

                                <div v-for="followup in agenda.followups">Follow Up
                                    <div v-show="dataItem !== 'followupEdit'+followup.id">
                                        <div>
                                            <div @click.prevent="startFollowupEdit(followup.id, agenda.id)">
                                                <li>Action {{ followup.action }}</li>
                                                <li>Timeline {{ followup.timeline }}</li>
                                                <!--<li>Status {{ followup.status }}</li>-->
                                                <li v-if="followup.status">Status {{ statuses[followup.status].name }}</li>
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

                                    <div v-show="dataItem === 'followupEdit'+followup.id">
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
                                            <div>
                                                <a href="#" @click.prevent="cancelFollowup">Cancel</a>
                                                <button @click.prevent="saveFollowupEdit(agenda.id, followup.id)">Edit
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                                <hr>

                                <!--Create discussion form-->

                                <div>
                                    <a href="#" @click.prevent="showDiscussionCreate(agenda.id) "
                                       v-show="dataItem !== 'discussionCreate'+agenda.id">Add Discussion</a>
                                    <div v-show="dataItem === 'discussionCreate'+agenda.id">
                                        Description<input type="text" v-model="dataHolder.description">
                                        <a href="#" @click.prevent="cancelDiscussion">Cancel</a>
                                        <a href="#" v-show="isDiscussionComplete"
                                           @click.prevent="saveDiscussion(agenda.id)">Save</a>
                                    </div>
                                </div>

                                <!--Read discussions-->

                                <div v-for="discussion in agenda.discussions"> Discussion
                                    <div v-show="dataItem !== 'discussionEdit'+ discussion.id">

                                        <div>
                                            <div @click.prevent="startDiscussionEdit(discussion.id, agenda.id)">
                                                <li>Description {{discussion.description}}</li>
                                            </div>
                                            <div>
                                                <button @click.prevent="startDiscussionEdit(discussion.id, agenda.id)">
                                                    Edit
                                                    Discussion
                                                </button>
                                                <a href="#"
                                                   @click.prevent="deleteDiscussion(discussion.id, agenda.id)">Delete</a>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Edit Discussion-->

                                    <div v-show="dataItem === 'discussionEdit'+discussion.id">
                                        <form @click.prevent>
                                            Description <input type="text" v-model="dataHolder.description">
                                            <button @click.prevent="saveDiscussionEdit(agenda.id, discussion.id)">Save
                                                Discussion
                                            </button>
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
                            <div v-on:keyup.esc="cancelFollowup" v-show="dataItem === 'agendaEdit'+agenda.id">
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
                                        <option v-for="agendaStatus in agendaStatuses" v-bind:value="agendaStatus.id">{{ agendaStatus.name }}
                                        </option>
                                    </select>
                                </div>
                                <div>Conclusion<input type="text"
                                                      v-model="dataHolder.conclusion"></div>
                                <div>
                                    <button @click.prevent="saveAgendaEdit(agenda.id)">Save Edit</button>
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
            },
            isAgendaComplete() {
                return this.dataHolder.topic && this.dataHolder.description && this.dataHolder.user_id;
            },
            isFollowupComplete() {
                return this.dataHolder.action && this.dataHolder.timeline;
            },
            isDiscussionComplete() {
                return this.dataHolder.description;
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
                agendaStatuses:
                    [
                        {id: 0, name: 'Proposed'},
                        {id: 1, name: 'Accepted'},
                        {id: 2, name: 'Rejected'},
                        {id: 3, name: 'Complete: discussed and finalized'},
                        {id: 4, name: 'Deferred: not yet discussed'},
                        {id: 5, name: 'Dropped: will not be discussed'},
                    ]
            }
        },
        mounted() {
            document.body.addEventListener('keyup', e => {
                if (e.keyCode === 27) {
                    this.dataItem = '';
                }
            })
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
                this.dataItem = 'agendaEdit' + id;
                let index = this.meeting.agendas.map(function (item) {
                    return item.id
                }).indexOf(id);
                this.dataHolder = Object.assign({}, this.meeting.agendas[index]);
            },
            saveAgendaEdit(agendaId) {
                let agendaIndex = this.meeting.agendas.map(function (item) {
                    return item.id;
                }).indexOf(agendaId);

                axios.put('/api/agendas/' + this.dataHolder.id, this.dataHolder)
                    .then((response) => {
                        this.meeting.agendas[agendaIndex] = Object.assign({}, this.dataHolder);
                        this.dataHolder = {};
                        this.dataItem = '';
                    });
                this.dataItem !== 'agendaEdit' + agendaId;

            },
            saveAgendaCreate() {
                axios.post('/api/agendas', this.dataHolder)
                    .then((response) => {
                        this.dataHolder = {};
                        this.meeting.agendas.push(response.data);
                        this.dataItem = '';
                    });
            },
            cancelAgenda() {
                this.dataHolder = {};
                this.dataItem = '';
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
            showAgendaCreate(meetingId) {
                this.dataItem = 'agendaCreate';
                this.dataHolder.meeting_id = meetingId;
                this.dataHolder.agenda_status = 0;
            },
            showFollowupCreate(agendaId) {
                this.dataItem = 'followupCreate' + agendaId;
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

                this.dataItem = 'followupEdit' + followupId;

                //load the values of the followup from meeting into the dataHolder variable in data
                this.dataHolder = Object.assign({}, this.meeting.agendas[agendaindex].followups[followupindex]);
            },
            saveFollowupEdit(agendaId, followupId) {
                let agendaIndex = this.meeting.agendas.map(function (item) {
                    return item.id;
                }).indexOf(agendaId);

                let followupIndex = this.meeting.agendas[agendaIndex].followups.map(function (item) {
                    return item.id;
                }).indexOf(followupId);

                axios.put('/api/followups/' + this.dataHolder.id, this.dataHolder)
                    .then((response) => {
                        this.meeting.agendas[agendaIndex].followups[followupIndex] = Object.assign({}, this.dataHolder);
                        this.dataHolder = {};
                        this.dataItem = '';
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
            saveFollowup(agendaId) {
                let agendaIndex = this.meeting.agendas.map(function (item) {
                    return item.id;
                }).indexOf(agendaId);
                axios.post('/api/followups', this.dataHolder)
                    .then((response) => {
                        this.dataHolder = {};
                        this.meeting.agendas[agendaIndex].followups.push(response.data);
                        this.dataItem = '';
                    });
            },
            showDiscussionCreate(agendaId) {
                this.dataItem = 'discussionCreate' + agendaId;
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

                this.dataItem = 'discussionEdit' + discussionId;
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
                        this.dataHolder = {};
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
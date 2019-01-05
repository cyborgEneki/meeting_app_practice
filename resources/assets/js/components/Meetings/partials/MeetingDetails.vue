<template>
    <div>

        <!--First part of the form-->

        <h4>Meeting Name: </h4>
        <p>{{ meeting.name }}</p>
        <h4>Creator:</h4>
        <p>{{ choices.users[meeting.creator_id].full_name }}</p>
        <h4>Chair:</h4>
        <p>{{ choices.users[meeting.chair_id].full_name }}</p>
        <h4>Secretary:</h4>
        <p>{{ choices.users[meeting.secretary_id].full_name }}</p>
        <h4 class="same-line"> Attendees</h4>
        <el-button icon="el-icon-circle-plus-outline" class="same-line" @click.prevent="addUser(users.id)"></el-button>
        <br>
        <br>
        <div v-for="user in orderedAttendees">
            <p class="same-line">{{ user.full_name }}</p>
            <i class="el-icon-delete same-line" @click.prevent="removeUsers(user.id)"></i>
        </div>
        <hr>

        <!--Create agenda-->
        <div v-show="dataItem === 'agendaCreate'">
            <div>
                Topic *<input type="text" v-model="dataHolder.topic">
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
                <label>User Assigned *</label>
                <select v-model="dataHolder.user_id">
                    <option value="">Select user</option>
                    <option v-for="user in orderedUsers" v-bind:value="user.id">{{ user.full_name }}
                    </option>
                </select>
            </div>
            <el-button class="same-line" type="success" icon="el-icon-check" circle :disabled="!isAgendaComplete"
                       @click.prevent="saveAgendaCreate">Save
            </el-button>
            <div class="same-line">
                <a href="#" @click.prevent="cancelAgenda">Cancel</a>
            </div>
        </div>

        <!--Read agendas-->

        <h2 class="same-line">Agendas</h2>
        <el-button icon="el-icon-circle-plus-outline" class="same-line" @click.prevent="showAgendaCreate(meeting.id)"
                   v-show="dataItem !=='agendaCreate'"></el-button>
        <br>
        <br>
        <div>
            <div v-for="(agenda, index) in meeting.agendas">
                <fieldset>
                    <div>
                        <h4 class="same-line">Agenda {{ index + 1 }}: {{ agenda.topic }}</h4>
                        <el-button icon="el-icon-edit same-line"
                                   @click.prevent="startAgendaEdit(agenda.id)"></el-button>
                        <el-button icon="el-icon-delete same-line" @click.prevent="deleteAgenda(agenda.id)"></el-button>

                        <!--Start read agenda-->

                        <div>
                            <div v-show="dataItem !== 'agendaEdit'+ agenda.id">
                                <div @click.prevent="startAgendaEdit(agenda.id)">
                                    <div>Assignee {{ choices.users[agenda.user_id].full_name }}</div>
                                    <div>Topic {{ agenda.topic }}</div>
                                    <div v-if="agenda.description">Description {{ agenda.description }}</div>
                                    <div v-if="agenda.time_allocated">Time Allocated (minutes) {{ agenda.time_allocated
                                        }}
                                    </div>
                                    <div>Agenda Status {{ agendaStatuses[agenda.agenda_status].name }}</div>
                                    <div v-if="agenda.conclusion">Conclusion {{ agenda.conclusion }}</div>
                                </div>

                                <!--Create followup form-->

                                <div>
                                    <el-button icon="el-icon-circle-plus-outline"
                                               @click.prevent="showFollowupCreate(agenda.id)"
                                               v-show="dataItem !== 'followupCreate'+agenda.id">Add Followup
                                    </el-button>
                                    <br>
                                    <br>
                                    <div v-show="dataItem === 'followupCreate'+agenda.id">
                                        Action *<input type="text" v-model="dataHolder.action">
                                        Timeline *<input type="text" v-model="dataHolder.timeline">
                                        Status *
                                        <select type="text" v-model="dataHolder.status">
                                            <option v-for="status in statuses" v-bind:value="status.id">{{ status.name
                                                }}
                                            </option>
                                        </select>
                                        <a href="#" @click.prevent="cancelFollowup">Cancel</a>
                                        <button :disabled="!isFollowupComplete"
                                                @click.prevent="saveFollowup(agenda.id)">Save
                                        </button>

                                    </div>
                                </div>

                                <!--Read followup-->

                                <div v-for="followup in agenda.followups">Follow Up
                                    <div v-show="dataItem !== 'followupEdit'+followup.id">
                                        <div>
                                            <div @click.prevent="startFollowupEdit(followup.id, agenda.id)">
                                                <li>Action {{ followup.action }}</li>
                                                <li>Timeline {{ followup.timeline }}</li>
                                                <li>Status {{ statuses[followup.status].name }}</li>
                                            </div>
                                            <div>
                                                <el-button icon="el-icon-edit same-line"
                                                           @click.prevent="startFollowupEdit(followup.id, agenda.id)">
                                                </el-button>
                                                <el-button icon="el-icon-delete same-line"
                                                           @click.prevent="deleteFollowup(followup.id, agenda.id)"></el-button>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Edit followup form-->

                                    <div v-show="dataItem === 'followupEdit'+followup.id">
                                        <form @click.prevent>
                                            <div>Action *<input type="text" v-model="dataHolder.action"></div>
                                            <div>Timeline *<input type="text" v-model="dataHolder.timeline"></div>
                                            <div>Status *
                                                <select v-model="dataHolder.status">
                                                    <option value="">Select status</option>
                                                    <option v-for="status in statuses" v-bind:value="status.id">
                                                        {{status.name}}
                                                    </option>
                                                </select>
                                            </div>
                                            <div>
                                                <el-button class="same-line" type="success" icon="el-icon-check" circle
                                                           @click.prevent="saveFollowupEdit(agenda.id, followup.id)">
                                                    Save Edit
                                                </el-button>
                                                <div class="same-line">
                                                    <a href="#" @click.prevent="cancelFollowup">Cancel</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                                <hr>

                                <!--Create discussion form-->

                                <div>
                                    <el-button icon="el-icon-circle-plus-outline"
                                               @click.prevent="showDiscussionCreate(agenda.id) "
                                               v-show="dataItem !== 'discussionCreate'+agenda.id">Add Discussion
                                    </el-button>
                                    <br>
                                    <br>
                                    <div v-show="dataItem === 'discussionCreate'+agenda.id">
                                        Description *<input type="text" v-model="dataHolder.description">
                                        <a href="#" @click.prevent="cancelDiscussion">Cancel</a>
                                        <button :disabled="!isDiscussionComplete"
                                                @click.prevent="saveDiscussion(agenda.id)">Save
                                        </button>
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
                                                <el-button icon="el-icon-edit same-line"
                                                           @click.prevent="startDiscussionEdit(discussion.id, agenda.id)">
                                                </el-button>
                                                <el-button icon="el-icon-delete same-line"
                                                           @click.prevent="deleteDiscussion(discussion.id, agenda.id)"></el-button>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Edit Discussion-->

                                    <div v-show="dataItem === 'discussionEdit'+discussion.id">
                                        <form @click.prevent>
                                            Description *<input type="text" v-model="dataHolder.description">
                                            <el-button class="same-line" type="success" icon="el-icon-check" circle
                                                       @click.prevent="saveDiscussionEdit(agenda.id, discussion.id)">
                                                Save
                                                Discussion
                                            </el-button>
                                            <div class="same-line">
                                                <a href="#" @click.prevent="cancelDiscussion">Cancel</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <hr>

                            </div>
                        </div>

                        <!--Edit agenda form-->

                        <form @click.prevent>
                            <div v-on:keyup.esc="cancelFollowup" v-show="dataItem === 'agendaEdit'+agenda.id">
                                <div>Topic *<input type="text" v-model="dataHolder.topic">
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
                                    <label>User Assigned *</label>
                                    <select v-model="dataHolder.user_id">
                                        <option value="">Select user</option>not
                                        <option v-for="user in orderedUsers" v-bind:value="user.id">{{ user.full_name }}
                                        </option>
                                    </select>
                                </div>
                                <div>
                                    Status
                                    <select type="text" v-model="dataHolder.agenda_status">
                                        <option value="">Select status</option>
                                        <option v-for="agendaStatus in agendaStatuses" v-bind:value="agendaStatus.id">{{
                                            agendaStatus.name }}
                                        </option>
                                    </select>
                                </div>
                                <div>Conclusion<input type="text"
                                                      v-model="dataHolder.conclusion"></div>
                                <div>
                                    <el-button class="same-line" type="success" icon="el-icon-check" circle
                                               @click.prevent="saveAgendaEdit(agenda.id)">Save Edit
                                    </el-button>
                                </div>
                                <div class="same-line">
                                    <a href="#" @click.prevent="cancelAgenda">Cancel</a>
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

        <!--Read notes-->

        <h4>Notes</h4>
        <div v-show="dataItem !== 'noteEdit'">{{ meeting.notes.description }} </div>

        <!--Edit notes-->
        <form @click.prevent>
            <div v-show="dataItem === 'noteEdit'">
                <div>
                    <textarea v-model="dataHolder.description"></textarea>
                </div>
            </div>
        </form>
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
                return this.dataHolder.topic && this.dataHolder.user_id;
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
                    this.dataHolder = {};
                    this.dataItem = '';
                }
            }),
                console.log(this.meeting);
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
                this.dataHolder.status = 0;
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
            },
            startNoteEdit() {
                this.dataItem = 'noteEdit';
            },
            cancelNote() {
                this.dataHolder = {};
                this.dataItem = '';
            },
        }
    }
</script>

<style scoped>
    .same-line {
        display: inline-block;
    }
</style>
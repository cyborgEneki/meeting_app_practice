<template>
    <div>

        <!--First part of the form-->

        <h4>Meeting Name: </h4>
        <p v-show="dataItem !== 'name' || editmode=='r'" @click="startMeetingFieldEdit('name')">{{ meeting.name }}</p>
        <div v-show="dataItem === 'name' && editmode">
            <input v-model="dataHolder.name">
            <button @click="saveMeetingFieldEdit('name')">Save</button>
            <button @click="dataItem=''">Cancel</button>
        </div>
        
        <h4>Creator:</h4>
        <p>{{ choices.users[meeting.creator_id].full_name }}</p>

        <h4>Chair:</h4>
        <p v-show="dataItem !== 'chair_id' || editmode=='r'" @click="startMeetingFieldEdit('chair_id')">{{ choices.users[meeting.chair_id].full_name }}</p>
        <div v-show="dataItem === 'chair_id' && editmode">
            <select v-model="dataHolder.chair_id">
              <option value="">Select User</option>
              <option v-for="user in choices.users" v-bind:value="user.id">{{ user.full_name }}</option>
            </select>
            <button @click="saveMeetingFieldEdit('chair_id')">Save</button>
            <button @click="dataItem=''">Cancel</button>
        </div>

        <!--Secretary -->
        <h4>Secretary:</h4>
        <p v-show="dataItem !== 'secretary_id' || editmode=='r'" @click="startMeetingFieldEdit('secretary_id')">{{ choices.users[meeting.secretary_id].full_name }}</p>
        <div v-show="dataItem === 'secretary_id' && editmode">
            <select v-model="dataHolder.secretary_id">
              <option value="">Select User</option>
              <option v-for="user in choices.users" v-bind:value="user.id">{{ user.full_name }}</option>
            </select>
            <button @click="saveMeetingFieldEdit('secretary_id')">Save</button>
            <button @click="dataItem=''">Cancel</button>
        </div>

        <!--Attendees-->
        <h4 class="same-line"> Attendees</h4>
        <el-button v-if="editmode" icon="el-icon-circle-plus-outline" class="same-line" @click.prevent="dataItem = 'user'"></el-button>
        <br>
        <br>
        <div v-for="user in orderedAttendees">
            <p class="same-line">
                {{ user.full_name }} 
                <!--if this attendee is the chair, add (Chair) next to their name-->
                <span v-if="user.id==meeting.chair_id"> (Chair)</span>
                <!--if this attendee is the secretary, add (Secretary) next to their name-->
                <span v-if="user.id==meeting.secretary_id"> (Secretary)</span>
            </p>

            <!--v-if here ensures you cant remove meeting official-->
            <i v-if="user.id!==meeting.chair_id && user.id!==meeting.secretary_id && editmode"  class="el-icon-delete same-line" @click.prevent="removeUsers(user.id)"></i>
        </div>

        <div v-show="dataItem === 'user'">
            <select v-model="dataHolder.id">
              <option value="">Select Participant</option>
              <option v-for="participant in choices.users" v-bind:value="participant.id">{{ participant.full_name }}</option>
            </select>
            <button @click="addUser">Save</button>
            <button @click="dataItem=''">Cancel</button>
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
            <el-button class="same-line" type="success" icon="el-icon-check" circle :disabled="!isAgendaComplete" @click.prevent="saveAgendaCreate">Save</el-button>
            <div class="same-line">
                <a href="#" @click.prevent="cancelAgenda">Cancel</a>
            </div>
        </div>

        <!--Read agendas-->

        <h2  class="same-line">Agendas</h2>
        <el-button icon="el-icon-circle-plus-outline" class="same-line" @click.prevent="showAgendaCreate(meeting.id)" v-show="dataItem !=='agendaCreate' && editmode"></el-button>
        <br>
        <br>
        <div>
            <div v-for="(agenda, index) in meeting.agendas">
                <fieldset>
                    <div>
                        <h4 class="same-line">Agenda {{ index + 1 }}: {{ agenda.topic }}</h4>
                        <el-button v-show="editmode" icon="el-icon-edit same-line" @click.prevent="startAgendaEdit(agenda.id)"></el-button>
                        <el-button v-show="editmode" icon="el-icon-delete same-line" @click.prevent="deleteAgenda(agenda.id)"></el-button>

                        <!--Start read agenda-->

                        <div>
                            <div v-show="dataItem !== 'agendaEdit'+ agenda.id">
                                <div @click.prevent="startAgendaEdit(agenda.id)">
                                    <div>Assignee {{ choices.users[agenda.user_id].full_name }}</div>
                                    <div>Topic {{ agenda.topic }}</div>
                                    <div v-if="agenda.description">Description {{ agenda.description }}</div>
                                    <div v-if="agenda.time_allocated">Time Allocated (minutes) {{ agenda.time_allocated }}</div>
                                    <div>Agenda Status {{ agendaStatuses[agenda.agenda_status].name }}</div>
                                    <div v-if="agenda.conclusion">Conclusion {{ agenda.conclusion }}</div>
                                </div>

                                <!--Create followup form-->

                                <div>
                                    <el-button icon="el-icon-circle-plus-outline"  @click.prevent="showFollowupCreate(agenda.id)"
                                               v-show="dataItem !== 'followupCreate'+agenda.id && editmode">Add Followup</el-button>
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
                                           @click.prevent="saveFollowup(agenda.id)">Save</button>

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
                                            <div v-show="editmode" >
                                                <el-button icon="el-icon-edit same-line" @click.prevent="startFollowupEdit(followup.id, agenda.id)">
                                                </el-button>
                                                <el-button icon="el-icon-delete same-line" @click.prevent="deleteFollowup(followup.id, agenda.id)"></el-button>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Edit followup form-->

                                    <div v-show="dataItem === 'followupEdit'+followup.id && editmode">
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
                                                <el-button class="same-line" type="success" icon="el-icon-check" circle  @click.prevent="saveFollowupEdit(agenda.id, followup.id)">Save Edit
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

                                <div v-show="editmode">
                                    <el-button icon="el-icon-circle-plus-outline"  @click.prevent="showDiscussionCreate(agenda.id) "
                                               v-show="dataItem !== 'discussionCreate'+agenda.id">Add Discussion</el-button>
                                    <br>
                                    <br>
                                    <div v-show="dataItem === 'discussionCreate'+agenda.id">
                                        Description *<input type="text" v-model="dataHolder.description">
                                        <a href="#" @click.prevent="cancelDiscussion">Cancel</a>
                                        <button :disabled="!isDiscussionComplete"
                                           @click.prevent="saveDiscussion(agenda.id)">Save</button>
                                    </div>
                                </div>

                                <!--Read discussions-->

                                <div v-for="discussion in agenda.discussions"> Discussion
                                    <div v-show="dataItem !== 'discussionEdit'+ discussion.id">

                                        <div>
                                            <div @click.prevent="startDiscussionEdit(discussion.id, agenda.id)">
                                                <li>Description {{discussion.description}}</li>
                                            </div>
                                            <div v-show="editmode">
                                                <el-button icon="el-icon-edit same-line"  @click.prevent="startDiscussionEdit(discussion.id, agenda.id)">
                                                </el-button>
                                                <el-button icon="el-icon-delete same-line"
                                                           @click.prevent="deleteDiscussion(discussion.id, agenda.id)"></el-button>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Edit Discussion-->

                                    <div v-show="dataItem === 'discussionEdit'+discussion.id && editmode">
                                        <form @click.prevent>
                                            Description *<input type="text" v-model="dataHolder.description">
                                            <el-button class="same-line" type="success" icon="el-icon-check" circle  @click.prevent="saveDiscussionEdit(agenda.id, discussion.id)">Save
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

                        <form @click.prevent v-show="editmode">
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
                                    <el-button class="same-line" type="success" icon="el-icon-check" circle @click.prevent="saveAgendaEdit(agenda.id)">Save Edit</el-button>
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
        <p v-show="dataItem !== 'venue_id' || editmode=='r'" @click="startMeetingFieldEdit('venue_id')">{{ choices.venues[meeting.venue_id].name }}</p>
        <div v-show="dataItem === 'venue_id' && editmode">
            <select v-model="dataHolder.venue_id">
              <option value="">Select Venue</option>
              <option v-for="venue in choices.venues" v-bind:value="venue.id">{{venue.name }}</option>
            </select>
            <button @click="saveMeetingFieldEdit('venue_id')">Save</button>
            <button @click="dataItem=''">Cancel</button>
        </div>



        <h4>Media:</h4>
         <p v-show="dataItem !== 'media_id' || editmode=='r'" @click="startMeetingFieldEdit('media_id')">{{ choices.media[meeting.media_id].name }}</p>
        <div v-show="dataItem === 'media_id' && editmode">
            <select v-model="dataHolder.media_id">
              <option value="">Select Mdeia</option>
              <option v-for="medium in choices.media" v-bind:value="medium.id">{{medium.name }}</option>
            </select>
            <button @click="saveMeetingFieldEdit('media_id')">Save</button>
            <button @click="dataItem=''">Cancel</button>
        </div>
        <h4>Meeting Type:</h4>
         <p v-show="dataItem !== 'meetingtype_id' || editmode=='r'" @click="startMeetingFieldEdit('meetingtype_id')">{{ choices.meetingtypes[meeting.meetingtype_id].name }}</p>
        <div v-show="dataItem === 'meetingtype_id' && editmode">
            <select v-model="dataHolder.meetingtype_id">
              <option value="">Select Mdeia</option>
              <option v-for="meetingtype in choices.meetingtypes" v-bind:value="meetingtype.id">{{meetingtype.name }}</option>
            </select>
            <button @click="saveMeetingFieldEdit('meetingtype_id')">Save</button>
            <button @click="dataItem=''">Cancel</button>
        </div>

        <h4>Meeting Series:</h4>
         <p v-show="dataItem !== 'meetingseries_id' || editmode=='r'" @click="startMeetingFieldEdit('meetingseries_id')">{{ choices.meetingseries[meeting.meetingseries_id].name }}</p>
        <div v-show="dataItem === 'meetingseries_id' && editmode">
            <select v-model="dataHolder.meetingseries_id">
              <option value="">Select Mdeia</option>
              <option v-for="meetingserie in choices.meetingseries" v-bind:value="meetingserie.id">{{meetingserie.name }}</option>
            </select>
            <button @click="saveMeetingFieldEdit('meetingseries_id')">Save</button>
            <button @click="dataItem=''">Cancel</button>
        </div>
        <hr/>
        <h4>Notes</h4>
        <div v-show="dataItem !== 'noteEdit'" v-if="meeting.notes">{{ meeting.notes.description }}</div>
        <el-button icon="el-icon-circle-plus-outline"  @click.prevent="showNoteCreate(meeting.id)"
                                               v-show="dataItem !== 'noteCreate' && !meeting.notes">Add Note</el-button>
        <div v-show="dataItem === 'noteCreate'">
            <div>
                <textarea v-model="dataHolder.description"></textarea>
            </div>
            <a href="#" @click.prevent="cancelNote">Cancel</a>
            <button :disabled="!isNoteComplete" @click.prevent="saveNote(meeting.id)">Save</button>
        </div>
        <div v-show="dataItem === 'noteEdit'">
            <div>
                <textarea v-model="dataHolder.description"></textarea>
            </div>
            
            <button :disabled="!isNoteComplete" @click.prevent="saveNoteEdit(meeting.id)">Save</button>
            <a href="#" @click.prevent="cancelNote">Cancel</a>
        </div>
        <div v-show="dataItem !== 'noteEdit' && editmode" v-if="meeting.notes">
            <el-button icon="el-icon-edit same-line"  @click.prevent="startNoteEdit(meeting.notes.id)"></el-button>
            <el-button  icon="el-icon-delete same-line" @click.prevent="deleteNote(meeting.notes.id)"></el-button>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        props: ['choices', 'editmode'],
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
                return this.dataHolder.topic  && this.dataHolder.user_id;
            },
            isFollowupComplete() {
                return this.dataHolder.action && this.dataHolder.timeline;
            },
            isDiscussionComplete() {
                return this.dataHolder.description;
            },
            isNoteComplete() {
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
                    ],
                    
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
            addUser: function () {
                var id = this.dataHolder.id;
                //let checkMtg = this.meeting.users.filter(function (user) {
                  //  return user.id === id;
                //});
                //only add user if that user isn't already in the meeting
                //if (true) {
                    axios.get('/api/meetings/' + this.meeting.id + '/users/' + this.dataHolder.id)
                        .then((response) => {
                            this.meeting.users.push(this.choices.users[this.dataHolder.id]);
                       });
                // } else {
                //     alert('User already exists');
                // }
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
            
            showNoteCreate(meetingId) {
                this.dataItem = 'noteCreate';
                this.dataHolder.meeting_id = meetingId;
            },
            cancelDiscussion() {
                this.dataHolder = {};
                this.dataItem = '';
            },
            cancelNote() {
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
            saveNote() {
                axios.post('/api/notes', this.dataHolder)
                    .then((response) => {
                        this.dataHolder = {};
                        this.meeting.notes = response.data;
                        this.dataItem = '';
                    });
            },
            saveNoteEdit() {
                axios.put('/api/notes/' + this.dataHolder.id, this.dataHolder)
                    .then((response) => {
                        this.meeting.notes = this.dataHolder;
                        this.dataHolder = {};
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
            startNoteEdit(noteId) {
                this.dataItem = 'noteEdit';
                this.dataHolder = Object.assign({}, this.meeting.notes);
            },

            startMeetingFieldEdit(theField) {
                if (!this.editmode) return;
                this.dataItem = theField;
                this.dataHolder[theField] = this.meeting[theField];
            },
            saveSecretaryEdit() {
                axios.put('/api/meetings/' + this.meeting.id, this.dataHolder)
                    .then((response) => {
                        //add secretary to meeting object so that UI refreshes

                        this.meeting['secretary_id'] = this.dataHolder.secretary_id;
                        // check if secretary is in users list else add them
                        let userIndex = this.meeting.users.map(function (user) {
                            return user.id;
                        }).indexOf(this.dataHolder.secretary_id);

                        if (userIndex === -1) {
                            //Add secretary to attendees list
                            this.meeting.users.push(this.choices.users[this.dataHolder.secretary_id])    
                        }

                        this.dataHolder = {};
                        this.dataItem = '';
                    });
            },

            saveMeetingFieldEdit(thefield) {
                axios.put('/api/meetings/' + this.meeting.id, this.dataHolder)
                    .then((response) => {
                        
                        this.meeting[thefield] = this.dataHolder[thefield];

                        if (thefield === 'secretary_id') {
                            // check if secretary is in users list else add them
                            let userIndex = this.meeting.users.map(function (user) {
                                return user.id;
                            }).indexOf(this.dataHolder.secretary_id);

                            if (userIndex === -1) {
                                //Add secretary to attendees list
                                this.meeting.users.push(this.choices.users[this.dataHolder.secretary_id])    
                            }
                        }

                        if (thefield === 'chair_id') {
                            // check if secretary is in users list else add them
                            let userIndex = this.meeting.users.map(function (user) {
                                return user.id;
                            }).indexOf(this.dataHolder.chair_id);

                            if (userIndex === -1) {
                                //Add chair to attendees list
                                this.meeting.users.push(this.choices.users[this.dataHolder.chair_id])    
                            }
                        }

                        this.dataHolder = {};
                        this.dataItem = '';
                    });
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

            deleteNote(noteId) {
                axios.delete('api/notes/' + noteId)
                    .then((response) => {
                        

                        this.meeting.notes = null;
                    });
            }
        }
    }
</script>

<style scoped>
    .same-line {
        display: inline-block;
    }
</style>
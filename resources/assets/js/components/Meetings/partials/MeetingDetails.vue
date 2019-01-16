<template>
    <div>

        <!--First part of the form-->

        <h4>Meeting Name</h4>
        <p v-show="dataItem !== 'name'" @click.prevent="startMeetingFieldEdit('name')" class="link">
            {{ meeting.name }}
        </p>
        <div v-show="dataItem === 'name'">
            <input v-model="dataHolder.name">
            <el-button class="same-line" icon="el-icon-check" type="success" circle
                       @click.prevent="saveMeetingFieldEdit('name')">Save
            </el-button>
            <a href="#" class="same-line" @click.prevent="dataItem=''">Cancel</a>
        </div>

        <h4>Date</h4>
        <p v-show="dataItem !== 'date'" @click.prevent="startMeetingFieldEdit('date')" class="link">
            {{ meeting.date }}
        </p>
        <div v-show="dataItem === 'date'">
            <input v-validate="'after:'+refDate+'|date_format:YYYY-MM-DD'" name="after_field" type="text"
                   placeholder="yyyy-mm-dd" v-model="dataHolder.date">
            <span>{{ errors.first('after_field') }}</span>
            <input v-show='false' ref="refDate" type="text" v-model="refDate">
            <el-button :disabled="errors.any()" class="same-line" icon="el-icon-check" type="success" circle
                       @click.prevent="saveMeetingFieldEdit('date')">Save
            </el-button>
            <a href="#" class="same-line" @click.prevent="dataItem=''">Cancel</a>
        </div>

        <h4> Start Time</h4>
        <p v-show="dataItem !== 'start_time'" @click.prevent="startMeetingFieldEdit('start_time')" class="link">
            {{ meeting.start_time }}
        </p>
        <div v-show="dataItem === 'start_time'">
            <input name="start_time" v-model="dataHolder.start_time" type="time"/>
            <el-button class="same-line" icon="el-icon-check" type="success" circle
                       @click.prevent="saveMeetingFieldEdit('start_time')">Save
            </el-button>
            <a href="#" class="same-line" @click.prevent="dataItem=''">Cancel</a>
        </div>

        <h4>End Time</h4>
        <p v-show="dataItem !== 'end_time'" @click.prevent="startMeetingFieldEdit('end_time')" class="link">
            {{ meeting.end_time }}
        </p>
        <div v-show="dataItem === 'end_time'">
            <input v-validate="'after:'+meeting.start_time+'|required'" name="end_time"
                   v-model="dataHolder.end_time" type="time"/>
            <span>{{ errors.first('end_time') }}</span>
            <el-button class="same-line" icon="el-icon-check" type="success" circle
                       @click.prevent="saveMeetingFieldEdit('end_time')">Save
            </el-button>
            <a href="#" class="same-line" @click.prevent="dataItem=''">Cancel</a>
        </div>

        <h4>Creator:</h4>
        <p v-show="dataItem !=='creator_id'" @click.prevent="startMeetingFieldEdit('creator_id')" class="link">
            {{ choices.users[meeting.creator_id].full_name }}
        </p>
        <div v-show="dataItem === 'creator_id'">
            <select v-model="dataHolder.creator_id">
                <option value="">Select User</option>
                <option v-for="user in orderedUsers" v-bind:value="user.id">{{ user.full_name }}</option>
            </select>
            <el-button class="same-line" icon="el-icon-check" type="success" circle
                       @click.prevent="saveMeetingFieldEdit('creator_id')">Save
            </el-button>
            <a href="#" class="same-line" @click.prevent="dataItem=''">Cancel</a>
        </div>

        <h4>Chair:</h4>
        <p v-show="dataItem !=='chair_id'" @click.prevent="startMeetingFieldEdit('chair_id')" class="link">
            {{ choices.users[meeting.chair_id].full_name }}
        </p>
        <div v-show="dataItem === 'chair_id'">
            <select v-model="dataHolder.chair_id">
                <option value="">Select User</option>
                <option v-for="user in orderedUsers" v-bind:value="user.id">{{ user.full_name }}</option>
            </select>
            <el-button class="same-line" icon="el-icon-check" type="success" circle
                       @click.prevent="saveMeetingFieldEdit('chair_id')">Save
            </el-button>
            <a href="#" class="same-line" @click.prevent="dataItem=''">Cancel</a>
        </div>

        <h4>Secretary:</h4>
        <p v-show="dataItem !== 'secretary_id'" @click.prevent="startMeetingFieldEdit('secretary_id')" class="link">
            {{choices.users[meeting.secretary_id].full_name }}
        </p>
        <div v-show="dataItem === 'secretary_id'">
            <select v-model="dataHolder.secretary_id">
                <option value="">Select User</option>
                <option v-for="user in orderedUsers" v-bind:value="user.id">{{ user.full_name }}</option>
            </select>
            <el-button class="same-line" icon="el-icon-check" type="success" circle
                       @click.prevent="saveMeetingFieldEdit('secretary_id')">Save
            </el-button>
            <a href="#" class="same-line" @click.prevent="dataItem=''">Cancel</a>
        </div>

        <h4 class="same-line"> Attendees</h4>
        <div v-show="dataItem === 'user'">
            <select v-model="dataHolder.user_id">
                <option value="">Select Attendee</option>
                <option v-for="attendee in orderedUsers" v-bind:value="attendee.id">{{ attendee.full_name }}</option>
            </select>
            <el-button class="same-line" type="success" icon="el-icon-check" circle
                       @click.prevent="addUser(dataHolder.user_id)">Save
            </el-button>
            <a href="#" class="same-line" @click.prevent="dataItem=''">Cancel</a>
        </div>
        <el-button icon="el-icon-circle-plus-outline" class="same-line" v-show="dataItem !== 'user'"
                   @click.prevent="startUserEdit"></el-button>
        <br>
        <br>
        <div v-for="user in orderedAttendees" v-bind:key="user.id">
            <p class="same-line">
                {{ user.full_name }}
                <span v-if="user.id == meeting.chair_id">(Chair)</span>
                <span v-if="user.id == meeting.secretary_id">(Secretary)</span>
            </p>
            <i v-if="user.id !== meeting.chair_id && user.id !== meeting.secretary_id" class="el-icon-delete same-line"
               @click.prevent="removeUsers(user.id)">
            </i>
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

                                <div>
                                    <!--<a href="#" v-show="!agenda.vote || !agenda.vote.vote"-->
                                    <!--@click.prevent="voteAgenda(1, agenda.id)">Up</a>-->
                                    <!--<span v-show="agenda.vote && agenda.vote.vote">Up</span>-->

                                    <!--<a href="#" v-show="!agenda.vote || agenda.vote.vote"-->
                                    <!--@click.prevent="voteAgenda(0, agenda.id)">Down</a>-->
                                    <!--<span v-show="agenda.vote && !agenda.vote.vote">Down</span>-->

                                    <a href="#" :class="{disabled: agenda.vote && agenda.vote.vote}"
                                       @click.prevent="(!agenda.vote || !agenda.vote.vote) && voteAgenda(1, agenda.id)">Up</a>

                                    <a href="#" :class="{disabled: agenda.vote && !agenda.vote.vote}"
                                       @click.prevent="(!agenda.vote || agenda.vote.vote) && voteAgenda(0, agenda.id)">Down</a>

                                    <a href="#" v-show="agenda.vote" @click.prevent="voteAgenda(null, agenda.id, true)">Abstain</a>

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
                                        <option value="">Select user</option>
                                        not
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
        <p v-show="dataItem !== 'venue_id'" @click.prevent="startMeetingFieldEdit('venue_id')" class="link">
            {{ choices.venues[meeting.venue_id].name }}
        </p>
        <div v-show="dataItem === 'venue_id'">
            <select v-model="dataHolder.venue_id">
                <option value="">Select venue</option>
                <option v-for="venue in orderedVenues" :value="venue.id">{{ venue.name }}</option>
            </select>
            <el-button class="same-line" icon="el-icon-check" type="success" circle
                       @click.prevent="saveMeetingFieldEdit('venue_id')">Save
            </el-button>
            <a href="#" class="same-line" @click.prevent="dataItem=''">Cancel</a>
        </div>

        <h4>Media:</h4>
        <p v-show="dataItem !== 'media_id'" @click.prevent="startMeetingFieldEdit('media_id')" class="link">
            {{ choices.media[meeting.media_id].name }}
        </p>
        <div v-show="dataItem === 'media_id'">
            <select v-model="dataHolder.media_id">
                <option value="">Select media</option>
                <option v-for="eachmedia in orderedMedia" :value="eachmedia.id">{{ eachmedia.name }}</option>
            </select>
            <el-button class="same-line" icon="el-icon-check" type="success" circle
                       @click.prevent="saveMeetingFieldEdit('media_id')">Save
            </el-button>
            <a href="#" class="same-line" @click.prevent="dataItem=''">Cancel</a>
        </div>

        <h4>Meeting Type:</h4>
        <p v-show="dataItem !== 'meetingtype_id'" @click.prevent="startMeetingFieldEdit('meetingtype_id')" class="link">
            {{ choices.meetingtypes[meeting.meetingtype_id].name }}
        </p>
        <div v-show="dataItem === 'meetingtype_id'">
            <select v-model="dataHolder.meetingtype_id">
                <option value="">Select meeting type</option>
                <option v-for="meetingtype in orderedMeetingTypes" :value="meetingtype.id">{{ meetingtype.name }}
                </option>
            </select>
            <el-button class="same-line" icon="el-icon-check" type="success" circle
                       @click.prevent="saveMeetingFieldEdit('meetingtype_id')">Save
            </el-button>
            <a href="#" class="same-line" @click.prevent="dataItem=''">Cancel</a>
        </div>

        <h4>Meeting Series:</h4>
        <p v-show="dataItem !== 'meetingseries_id'" @click.prevent="startMeetingFieldEdit('meetingseries_id')"
           class="link">
            {{ choices.meetingseries[meeting.meetingseries_id].name }}
        </p>
        <div v-show="dataItem === 'meetingseries_id'">
            <select v-model="dataHolder.meetingseries_id">
                <option value="">Select meeting series</option>
                <option v-for="eachmeetingseries in orderedMeetingSeries" :value="eachmeetingseries.id">{{
                    eachmeetingseries.name }}
                </option>
            </select>
            <el-button class="same-line" icon="el-icon-check" type="success" circle
                       @click.prevent="saveMeetingFieldEdit('meetingseries_id')">Save
            </el-button>
            <a href="#" class="same-line" @click.prevent="dataItem=''">Cancel</a>
        </div>

        <hr/>

        <!--Read notes-->

        <h4>Notes</h4>
        <div v-show="dataItem !== 'noteEdit'" v-if="meeting.notes">
            <div>{{ meeting.notes.description }}</div>
            <div v-show="noteIcons">
                <el-button icon="el-icon-edit same-line"
                           @click.prevent="startNoteEdit(meeting.notes.id)">
                </el-button>
                <el-button icon="el-icon-delete same-line"
                           @click.prevent="deleteNote(meeting.notes.id)"></el-button>
            </div>
        </div>

        <!--Create note-->

        <el-button icon="el-icon-circle-plus-outline"
                   @click.prevent="showNoteCreate(meeting.id) " v-show="dataItem !== 'noteCreate' && !meeting.notes">
        </el-button>
        <div v-show="dataItem === 'noteCreate'">
            <textarea v-model="dataHolder.description"></textarea>
            <a href="#" class="same-line" @click.prevent="cancelNote">Cancel</a>
            <el-button class="same-line" type="success" icon="el-icon-check" circle
                       @click.prevent="saveNoteCreate(meeting.id)">Save
            </el-button>
        </div>

        <!--Edit notes-->
        <form @click.prevent>
            <div v-show="dataItem === 'noteEdit'">
                <div>
                    <textarea v-model="dataHolder.description"></textarea>
                </div>
                <div>
                    <el-button class="same-line" type="success" icon="el-icon-check" circle
                               @click.prevent="saveNoteEdit()">Save Edit
                    </el-button>
                    <a href="#" class="same-line" @click.prevent="cancelNote">Cancel</a>
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
            orderedVenues() {
                return _.orderBy(this.choices.venues, 'name');
            },
            orderedAttendees() {
                return _.orderBy(this.meeting.users, 'first_name');
            },
            orderedMedia() {
                return _.orderBy(this.choices.media, 'media');
            },
            orderedMeetingTypes() {
                return _.orderBy(this.choices.meetingtypes, 'name');
            },
            orderedMeetingSeries() {
                return _.orderBy(this.choices.meetingseries, 'name');
            },
            isAgendaComplete() {
                return this.dataHolder.topic && this.dataHolder.user_id;
            },
            isFollowupComplete() {
                return this.dataHolder.action && this.dataHolder.timeline;
            },
            isDiscussionComplete() {
                return this.dataHolder.description;
            },
            refDate() {
                let today = new Date()
                let dd = today.getDate();
                let mm = today.getMonth() + 1;
                let yyyy = today.getFullYear();
                if (dd < 10) {
                    dd = '0' + dd;
                }
                if (mm < 10) {
                    mm = '0' + mm;
                }
                return yyyy + '-' + mm + '-' + dd;
            },
        },
        data() {
            return {
                upvoted: false,
                downvoted: false,
                dataItem: '',
                timing: [5, 10, 15, 20, 25, 30, 45, 60, 75, 90],
                users: [],
                dataHolder: {},
                success: false,
                noteIcons: true,
                voteOptions: false,
                voteYes: false,
                voteNo: false,
                voteStatus: null,
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
            this.voteStatus = (this.meeting.agendas.flat());

            document.body.addEventListener('keyup', e => {
                if (e.keyCode === 27) {
                    this.dataHolder = {};
                    this.dataItem = '';
                }
            }),

            console.log(this.meeting);
        },
        methods: {
            voteAgenda(thevote, agendaId, abstain = false) {
                axios.post('api/agendas/vote', {agenda_id: agendaId, vote: thevote, abstain: abstain})
                    .then((response) => {
                        let agendaIndex = this.meeting.agendas.map(function (item) {
                            return item.id
                        }).indexOf(agendaId);
                        if (abstain) {
                            this.meeting.agendas[agendaIndex].vote = null;
                        } else {
                            this.meeting.agendas[agendaIndex].vote =
                                {
                                    agenda_id: agendaId,
                                    vote: thevote
                                };
                        }
                    })
            },
            startVoting() {
                this.voteOptions = true;
                this.showYes();
                this.showNo();
            },

            showYes() {
                if (this.voteStatus[0].vote.vote == 1) {
                    this.voteYes = true;
                } else if (this.voteStatus[0].vote.vote == ' ') {
                    this.voteYes = true;
                } else {
                    this.voteYes = false;
                }
            },

            showNo() {
                if (this.voteStatus[0].vote.vote == 0) {
                    this.voteNo = true;
                } else if (this.voteStatus[0].vote.vote == ' ') {
                    this.voteNo = true;
                } else {
                    this.voteNo = false;
                }
            },

            setVoteStatus(status, id) {
                let data = {
                    'vote': status,
                    'agenda_id': id,
                };
                axios.post('api/agendas/vote', data).then((response) => {
                    this.voteOptions = true;
                });
            },

            startMeetingFieldEdit(theField) {
                this.dataItem = theField;
                this.dataHolder[theField] = this.meeting[theField];
            },
            saveMeetingFieldEdit(theField) {
                axios.put('api/meetings/' + this.meeting.id, this.dataHolder)
                    .then((response) => {
                        this.meeting[theField] = this.dataHolder[theField];
                        if (theField === 'secretary_id') {
                            /*
                              loops and gets back array of only users id &
                              checks if the secretary id exists in that array
                              */
                            let userIndex = this.meeting.users.map(function (user) {
                                return user.id;
                            }).indexOf(this.dataHolder.secretary_id);

                            /*
                                if it ísn't there userIndex will have -1 value else
                                 will have the index where the secretary id is located within array
                              */
                            if (userIndex === -1) {
                                axios.post('api/meetings/attachuser', {
                                    meeting_id: this.meeting.id,
                                    user_id: this.dataHolder.secretary_id
                                })
                                    .then(
                                        this.meeting.users.push(this.choices.users[this.dataHolder.secretary_id]))
                            }
                        }

                        if (theField === 'chair_id') {
                            let userIndex = this.meeting.users.map(function (user) {
                                return user.id;
                            }).indexOf(this.dataHolder.chair_id);

                            if (userIndex === -1) {
                                axios.post('api/meetings/attachuser', {
                                    meeting_id: this.meeting.id,
                                    user_id: this.dataHolder.chair_id
                                })
                                    .then(
                                        this.meeting.users.push(this.choices.users[this.dataHolder.chair_id]))
                            }
                        }

                        this.dataHolder = {};
                        this.dataItem = '';
                    })
            },
            addUser (id) {

                let checkMtg = this.meeting.users.filter(function (user) {
                    return user.id === id;
                });

                //only add user if that user isn't already in the meeting
                if (!checkMtg.length) {
                    this.dataHolder.user_id = id;
                    axios.post('/api/meetings/attachuser', this.dataHolder)
                        .then((response) => {
                            this.meeting.users.push(this.choices.users[id]);
                            this.dataItem = '';
                        });
                } else {
                    alert('User already exists');
                }
            },
            startUserEdit() {
                this.dataItem = 'user';
                this.dataHolder.meeting_id = this.meeting.id;
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
            showNoteCreate(meetingId) {
                this.dataItem = 'noteCreate';
                this.dataHolder.meeting_id = meetingId;
            },
            saveNoteCreate(meetingId) {
                axios.post('api/notes', this.dataHolder)
                    .then((response) => {
                        this.dataHolder = {};
                        this.meeting.notes = response.data;
                        this.dataItem = '';
                    })
            },
            startNoteEdit(noteId) {
                this.dataItem = 'noteEdit';
                this.dataHolder = Object.assign({}, this.meeting.notes);
            },
            saveNoteEdit() {
                axios.put('api/notes/' + this.dataHolder.id, this.dataHolder)
                    .then((response) => {
                        this.meeting.notes = Object.assign({}, this.dataHolder);
                        this.dataHolder = {};
                        this.dataItem = '';
                    })
            },
            cancelNote() {
                this.dataHolder = {};
                this.dataItem = '';
            },
            deleteNote(noteId) {
                axios.delete('api/notes/' + noteId)
                    .then((response) => {
                        this.meeting.notes = {};
                        this.noteIcons = false;
                    });
            }
        }
    }
</script>

<style scoped>
    .same-line {
        display: inline-block;
    }

    .link {
        cursor: pointer;
    }

    .disabled {
        color: #CCCCCC;
        text-decoration: none;
    }
</style>
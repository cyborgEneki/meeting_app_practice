<template>
    <div>
        <h2 class="same-line">Meetings</h2>
        <router-link :to="{ name: 'addMeeting' }" class="same-line">
            <el-button icon="el-icon-circle-plus-outline"></el-button>
        </router-link>

        <div v-for="meeting in meetings" :key="meeting.id" class="meetingdiv">
            <span @click="loadView(meeting)" class="link" style="margin-top: 20px;">{{meeting.name}}</span><br>
            {{ meeting.date }}<br>
            {{ meeting.start_time }}<br>
            {{ meeting.end_time }}<br>
            <router-link :to="{ name: 'editMeeting' , params: { meeting }}">
                <el-button icon="el-icon-edit"></el-button>
            </router-link>
            <el-button icon="el-icon-delete same-line" @click.prevent="deleteUser(meeting.id)"></el-button>

        </div>
    </div>
</template>

<script>
    import vueConfirmationButton from 'vue-confirmation-button';

    export default {
        components: {
            'vue-confirmation-button': vueConfirmationButton,
        },
        data() {
            return {
                meetings: [],
                customMessages:
                    [
                        'Delete',
                        'Are you sure?',
                        'Ok!'
                    ]
            }
        },
        methods: {
            getMeetings() {
                axios.get('/api/meetings')
                    .then(response => {
                            this.meetings = response.data;
                        }
                    )
            },
            loadView: function (meeting) {
                this.$store.commit('GET_MEETING_DETAILS', meeting);
            },
            deleteMeeting(id) {
                this.$dialog.confirm('Please confirm to continue')
                    .then(function (dialog) {
                        console.log('Clicked on proceed')
                    })
                    .catch(function () {
                        console.log('Clicked on cancel')
                    });

                axios.delete('/api/meetings/' + id)
                    .then(() => {
                        let index = this.meetings.map(function (item) {
                            return item.id
                        }).indexOf(id);
                        this.meetings.splice(index, 1);
                    });
            },
        },
        created() {
            this.getMeetings();
        },

    }
</script>

<style scoped>
    .same-line {
        display: inline-block;
    }

    .link {
        cursor: pointer;
    }

    .meetingdiv {

        border-radius: 5px;
        margin-bottom: 10px;
        padding: 10px;
        background: #FFFFFF;
        position: relative;
    }
</style>
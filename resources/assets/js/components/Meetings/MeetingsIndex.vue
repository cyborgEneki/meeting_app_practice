<template>
    <div>
        <h2>All Meetings</h2>
        <ul>
            <li v-for="meeting in meetings">
                <strong>Name: </strong> {{ meeting.name }}
                <strong>Date: </strong> {{ meeting.date }}
            </li>
        </ul>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "MeetingsIndex",
        data() {
            return {
                meetings: [],
                meeting: {
                    id: ' ',
                    name: ' ',
                    date: ' ',
                },
                /*This is necessary because when the make a PUT and CREATE request to the API
                the field will have to be sent with it for it to know which id to output. They both go
                to the store method and we don't pass the id with the url*/
                meeting_id: '',
                /*This is necessary because I will use the same form to add and edit.*/
                edit: false
            }
        },

        created() {
            this.getMeetings();
        },

        methods: {
            getMeetings() {
                axios.get('api/meetings')
                    .then(function(response){
                        this.meetings = response.data;
                    });
            }
        }
    }
</script>

<style scoped>

</style>
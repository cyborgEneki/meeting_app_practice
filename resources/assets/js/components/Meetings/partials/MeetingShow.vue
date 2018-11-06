<template>
    <div>
        <h4>Meeting Name: </h4>
        <p>{{ meeting.name }}</p>
        <h4>Creator:</h4>
        <p>{{ meeting.creator }}</p>
        <h4>Facilitator:</h4>
        <p>{{ meeting.facilitator }}</p>
        <h4>Time Keeper:</h4>
        <p>{{ meeting.time_keeper }}</p>
        <h4> Attendees</h4>
        <p v-for="name in meeting.users">{{ name.first_name }}</p>
        <h4>Agendas:</h4>
        <table class="table striped table-bordered">
            <thead>
            <th>Topic</th>
            <th>Description</th>
            <th>Time Allocated (minutes)</th>
            <th>Status</th>
            <th>Conclusion</th>
            <th>Follow Up Action</th>
            <th>Discussions</th>
            </thead>
            <tr v-for="agendas in meeting.agendas">
                <td>{{ agendas.topic }}</td>
                <td>{{ agendas.description }}</td>
                <td>{{ agendas.time_allocated }}</td>
                <td>{{ agendas.agenda_status }}</td>
                <td>{{ agendas.conclusion }}</td>
                <td v-for="description in agendas.followups"> {{description.action}}</td>
                <td><h6 v-for="description in agendas.discussion"> {{description.description}}</h6></td>
            </tr>
        </table>
        <h4>Venue:</h4>
        <p>{{ meeting.venue.name }}</p>
        <h4>Media:</h4>
        <p>{{ meeting.media.name }}</p>
        <h4>Meeting Type:</h4>
        <p>{{ meeting.meetingtype.name }}</p>
        <h4>Meeting Series:</h4>
        <p>{{ meeting.meetingseries.name }}</p>
        <hr/>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        computed: {
            ...mapGetters({
                meeting: 'meeting',
            })
        },
    }
</script>

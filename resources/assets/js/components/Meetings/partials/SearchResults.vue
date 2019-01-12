<template>
    <div>
        <h1>Results</h1>

        <h2>Meetings</h2>
        <ol>
        <li v-for="(meeting, index) in searchResults.meetings">{{ meeting.name }}</li>
        </ol>

        <h2>Agendas</h2>
        <ol>
        <!-- <li v-for="(agenda, index) in searchResults.agendas">{{ agenda.topic }}</li> -->
        <li v-for="(agenda, index) in searchResults.agendas">Topic -{{ agenda.topic }} <p v-show="agenda.description">Description -{{ agenda.description }}</p> <p v-show="agenda.conclusion">Conclusion -{{ agenda.conclusion }}</p></li>
        <!-- <li v-for="(agenda, index) in searchResults.agendas">{{ agenda.conclusion }}</li> -->
        </ol>

        <h2>Discussions</h2>
        <ol>
        <li v-for="(discussion, index) in searchResults.discussions">{{ discussion.description }}</li>
        </ol>

        <h2>Followups</h2>
        <ol>
        <li v-for="(followup, index) in searchResults.followups">{{ followup.action }}</li>
        </ol>
    </div>

</template>

<script>

    export default {
        name: "SearchResults",
        props: ['searchResults'],
        created () {
            console.log(this.meeting);
        }
    }

</script>

<style scoped>

</style>
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
      <li v-for="(agenda, index) in searchResults.agendas">
        Topic -{{ agenda.topic }}
        <p v-show="agenda.description">Description -{{ agenda.description }}</p>
        <p v-show="agenda.conclusion">Conclusion -{{ agenda.conclusion }}</p>
      </li>
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

    <div class="col-md-10">
      <div v-if="showMeetingDetails">
        <meeting-details :choices.sync="choices"></meeting-details>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import MeetingDetails from "./MeetingDetails";

export default {
  name: "SearchResults",
  props: ["searchResults", "choices", "meetings"],
  computed: {
    ...mapGetters({
      showMeetingDetails: "showMeetingDetails"
    })
  },
  components: {
    "meeting-details": MeetingDetails
  },
  methods: {
    loadView(meeting) {
      this.$store.commit("GET_MEETING_DETAILS", meeting);
    }
  }
};
</script>

<style scoped>
</style>
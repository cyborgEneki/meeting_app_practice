<template>
  <div>
    <h4>Meeting Series Name</h4>
    <p>{{ meetingseriesdetails.name }}</p>
    <h4>Frequency</h4>
    <p>{{ meetingseriesdetails.frequency }}</p>
    <h4>Members</h4>
    <select v-model="dataHolder.user_id">
      <option v-for="user in orderedUsers" v-bind:key="user.id">{{ user.full_name }}</option>
    </select>
  </div>
</template>

<script>
export default {
  computed: {
    orderedUsers() {
      return _.orderBy(this.choices.users, "first_name");
    }
  },
  data() {
    return {
      meetingseriesdetails: {},
      editItem: "",
      dataHolder: {},
      choices: [],
      mode: "r",
      content: this.$store.state.content
    };
  },
  created() {
    console.log(this.choices);
    axios.get("/api/meetingseries/" + this.$route.params.id).then(response => {
      this.meetingseriesdetails = response.data;
    });
  },
  watch: {
    $route(to, from) {
      axios
        .get("/api/meetingseries/" + this.$route.params.id)
        .then(response => {
          this.meetingseriesdetails = response.data;
        });
    }
  }
};
</script>

<style scoped>
</style>

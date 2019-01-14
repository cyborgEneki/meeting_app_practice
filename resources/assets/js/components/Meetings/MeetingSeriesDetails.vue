<template>
  <div>
    <h2>I</h2>
    <h2>{{ meetingseriesdetails }}</h2>
  </div>
</template>

<script>
export default {
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
  watch: {
    $route(to, from) {
      axios.get("/#/meetingseries/" + this.$route.params.id).then(response => {
        this.meetingseriesdetails = response.data;
      });
    }
  }
};
</script>

<style scoped>
</style>

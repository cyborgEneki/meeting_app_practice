<template>
  <div>
    <h4>Meeting Series:</h4>
    <p
      v-show="dataItem !== 'meetingseries_id'"
      @click.prevent="!meeting.locked && startMeetingFieldEdit($event)"
      class="link"
    >{{ choices.meetingseries[meeting.meetingseries_id].name }}</p>
    <div v-show="dataItem === 'meetingseries_id'">
      <select v-model="dataHolder.meetingseries_id">
        <option value>Select meeting series</option>
        <option
          v-for="eachmeetingseries in orderedMeetingSeries"
          :value="eachmeetingseries.id"
          :key="eachmeetingseries.id"
        >
          {{
          eachmeetingseries.name }}
        </option>
      </select>
      <el-button
        class="same-line"
        icon="el-icon-check"
        type="success"
        circle
        @click.prevent="saveMeetingFieldEdit($event)"
      >Save</el-button>
      <a href="#" class="same-line" @click.prevent="dataItem=''">Cancel</a>
    </div>

    <hr>
  </div>
</template>

<script>
export default {
  props: {
    dataItem: String,
    meeting: Object,
    choices: Object,
    dataHolder: Object,
    orderedMeetingSeries: Array
  },
  methods: {
    startMeetingFieldEdit(id) {
      this.$emit("startMeetingFieldEdit", "meetingseries_id");
    },
    saveMeetingFieldEdit(id) {
      this.$emit("saveMeetingFieldEdit", "meetingseries_id");
    }
  }
};
</script>

<style <style scoped>
.link {
  cursor: pointer;
}
</style>

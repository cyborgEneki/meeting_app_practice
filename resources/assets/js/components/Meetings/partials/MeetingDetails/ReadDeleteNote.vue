<template>
  <div>
    <h4>Notes</h4>
    <div v-show="dataItem !== 'noteEdit' && !meeting.locked" v-if="meeting.notes">
      <div>{{ meeting.notes.description }}</div>
      <div v-show="noteIcons">
        <el-button
          v-show="!meeting.locked"
          icon="el-icon-edit same-line"
          @click.prevent="startNoteEdit($event)"
        ></el-button>
        <el-button
          v-show="!meeting.locked"
          icon="el-icon-delete same-line"
          @click.prevent="deleteNote($event)"
        ></el-button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    dataItem: String,
    meeting: Object,
    noteIcons: Boolean
  },
  methods: {
    startNoteEdit (id) {
      this.$emit("startNoteEdit", this.meeting.notes.id);
    },
    deleteNote (id) {
      this.$emit("deleteNote", this.meeting.notes.id);
    }
  }
};
</script>

<style>
</style>

<template>
  <div>
    <el-button
      icon="el-icon-circle-plus-outline"
      @click.prevent="showNoteCreate($event)"
      v-show="dataItem !== 'noteCreate' && !meeting.notes && !meeting.locked"
    ></el-button>
    <div v-show="dataItem === 'noteCreate'">
      <textarea v-model="dataHolder.description"></textarea>
      <a href="#" class="same-line" @click.prevent="cancelNote">Cancel</a>
      <el-button
        class="same-line"
        type="success"
        icon="el-icon-check"
        circle
        @click.prevent="saveNoteCreate($event)"
      >Save</el-button>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  props: {
    dataItem: String,
    dataHolder: Object,
    meeting: Object
  },
  methods: {
    showNoteCreate(id) {
      this.$emit("showNoteCreate", this.meeting.id);
    },
    saveNoteCreate(id) {
      this.$emit("saveNoteCreate", this.meeting.id);
    }
  }
};
</script>

<style>
</style>

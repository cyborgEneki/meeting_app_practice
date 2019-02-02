<template>
  <div>
    <form @click.prevent>
      <div v-show="dataItem === 'noteEdit'">
        <div>
          <textarea v-model="dataHolder.description"></textarea>
        </div>
        <div>
          <el-button
            class="same-line"
            type="success"
            icon="el-icon-check"
            circle
            @click.prevent="saveNoteEdit"
          >Save Edit</el-button>
          <a href="#" class="same-line" @click.prevent="cancelNote">Cancel</a>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  props: {
    dataItem: String,
    dataHolder: Object
  },
  methods: {
    saveNoteEdit() {
      this.$emit("saveNoteEdit");
    },
    cancelNote() {
      this.$emit("cancelNote");
    }
  }
};
</script>

<style>
</style>

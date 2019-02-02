<template>
  <div>
    <h2>Related Agendas</h2>
    <ol>
      <li v-for="relagenda in agenda.related_agendas" :key="relagenda.id">
        {{ choices.agendas[relagenda].topic }}
        <i
          class="el-icon-delete same-line"
          @click.prevent="deleteAgendaRelation(agenda.id, relagenda)"
        ></i>
      </li>
    </ol>
    <el-button
      icon="el-icon-circle-plus-outline"
      @click.prevent="showAgendaRelate($event)"
      v-show="dataItem !== 'agendaRelate'+agenda.id && !meeting.locked"
    >Add Related Agenda</el-button>

    <!--Add related agenda-->
    <div v-show="dataItem === 'agendaRelate'+agenda.id">
      <label>Related Agenda</label>
      <select v-model="dataHolder.agendatarget_id">
        <option value>Select Agenda</option>
        <option
          v-for="targetagenda in choices.agendas"
          :value="targetagenda.id"
          :key="targetagenda.id"
        >{{ targetagenda.topic }}</option>
      </select>

      <el-button
        class="same-line"
        type="success"
        icon="el-icon-check"
        circle
        :disabled="!isAgendaRelationComplete"
        @click.prevent="saveAgendaRelation"
      >Save</el-button>
      <div class="same-line">
        <a href="#" @click.prevent="cancelAgenda">Cancel</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    dataItem: String,
    dataHolder: Object,
    choices: Object,
    isAgendaRelationComplete: Function,
    agenda: Object,
    meeting: Object
  },
  methods: {
    saveAgendaRelation() {
      this.$emit("saveAgendaRelation");
    },
    cancelAgenda() {
      this.$emit("cancelAgenda");
    },
    deleteAgendaRelation(id, relagenda) {
      this.$emit("deleteAgendaRelation", this.agenda.id, this.relagenda);
    },
    showAgendaRelate(id) {
      this.$emit("showAgendaRelate", this.agenda.id);
    }
  }
};
</script>

<style>
</style>

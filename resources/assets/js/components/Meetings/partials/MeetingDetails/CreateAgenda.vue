<template>
  <div>
    <div v-show="dataItem == 'agendaCreate'">
      <div>
        Topic *
        <input type="text" v-model="dataHolder.topic">
      </div>
      <div>
        Description
        <input type="text" v-model="dataHolder.description">
      </div>
      <div>
        Time Allocated (minutes)
        <select type="text" v-model="dataHolder.time_allocated">
          <option value>Select time</option>
          <option v-for="time in timing">{{ time }}</option>
        </select>
      </div>
      <div>
        Agenda Status
        <select type="text" v-model="dataHolder.agenda_status">
          <option value>Select status</option>
          <option v-for="agendaStatus in agendaStatuses" v-bind:value="agendaStatus.id">
            {{ agendaStatus.name
            }}
          </option>
        </select>
      </div>
      <div>
        <label>User Assigned *</label>
        <select v-model="dataHolder.user_id">
          <option value>Select user</option>
          <option v-for="user in orderedUsers" v-bind:value="user.id">{{ user.full_name }}</option>
        </select>
      </div>
      <el-button
        class="same-line"
        type="success"
        icon="el-icon-check"
        circle
        :disabled="!isAgendaComplete"
        @click.prevent="saveAgendaCreate"
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
        timing: Array,
        agendaStatuses: Array,
        orderedUsers: Array,
        isAgendaComplete: Boolean
    },
    methods: {
        saveAgendaCreate () {
            this.$emit('saveAgendaCreate');
        },
        cancelAgenda () {
            this.$emit('cancelAgenda');
        }
    }
};
</script>

<style>
</style>

<template>
  <div>
    <h2>Meeting Series</h2>
    <router-link :to="{ name: 'addMeetingSeries' }" class="same-line">
      <el-button icon="el-icon-circle-plus-outline"></el-button>
    </router-link>

    <div
      v-for="eachmeetingseries in orderedMeetingSeries"
      :key="eachmeetingseries.id"
      class="meetingdiv"
    >
      <router-link
        :to="{ name: 'meetingSeriesDetails', params: { name: eachmeetingseries.name, id: eachmeetingseries.id }}"
      >
        {{eachmeetingseries.name}}
        <br>
      </router-link>
      {{eachmeetingseries.frequency}}
      <br>
      <router-link :to="{ name: 'editMeetingSeries' , params: { eachmeetingseries }}">
        <el-button icon="el-icon-edit"></el-button>
      </router-link>
      <el-button icon="el-icon-delete same-line" @click.prevent="deleteMeetingSeries(eachmeetingseries.id)"></el-button>
    </div>
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: "MeetingSeriesList",
  props: ["choices"],
  data() {
    return {
      meetingseries: []
    };
  },
  computed: {
    orderedMeetingSeries: function() {
      return _.orderBy(this.choices.meetingseries, "name");
    }
  },
  methods: {
    // deleteMeetingSeries(id) {
    //   axios.delete("/api/meetingseries/" + id).then(() => {
    //     let index = this.meetingseries
    //       .map(item => {
    //         return item.id;
    //       })
    //       .indexOf(id);
    //     this.meetingseries.splice(index, 1);
    //   });
    // }
  },
  watch: {
    $route(to, from) {
      axios.get("/#/meetingseries/" + this.$route.params.id).then(response => {
        this.meetingseries = response.data;
      });
    }
  }
};
</script>

<style scoped>
.same-line {
  display: inline-block;
}

.link {
  cursor: pointer;
}

.meetingdiv {
  border-radius: 5px;
  margin-bottom: 10px;
  padding: 10px;
  background: #ffffff;
  position: relative;
}

.has-search .form-control {
  padding-left: 2.375rem;
}

.has-search .form-control-feedback {
  position: absolute;
  z-index: 2;
  display: block;
  width: 2.375rem;
  height: 2.375rem;
  line-height: 2.375rem;
  text-align: center;
  pointer-events: none;
  color: #aaa;
}
</style>
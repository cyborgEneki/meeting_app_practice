<template>
  <div>
    <div>
      <h4>Meeting Series Name</h4>
      <p
        v-show="dataItem !== 'name'"
        @click.prevent="startMeetingSeriesFieldEdit('name')"
        class="link"
      >{{ meetingseriesdetails.name }}</p>
      <div v-show="dataItem === 'name'">
        <input v-model="dataHolder.name">
        <el-button
          class="same-line"
          icon="el-icon-check"
          type="success"
          circle
          @click.prevent="saveMeetingSeriesFieldEdit('name')"
        >Save</el-button>
        <a href="#" class="same-line" @click.prevent="dataItem=''">Cancel</a>
      </div>
    </div>
    <div>
      <h4>Frequency</h4>
      <p
        v-show="dataItem !== 'frequency'"
        @click.prevent="startMeetingSeriesFieldEdit('frequency')"
        class="link"
      >{{ meetingseriesdetails.frequency }}</p>
      <div v-show="dataItem === 'frequency'">
        <input v-model="dataHolder.frequency">
        <el-button
          class="same-line"
          icon="el-icon-check"
          type="success"
          circle
          @click.prevent="saveMeetingSeriesFieldEdit('frequency')"
        >Save</el-button>
        <a href="#" class="same-line" @click.prevent="dataItem=''">Cancel</a>
      </div>
    </div>
    <div>
      <h4 class="same-line">Members</h4>
      <div v-show="dataItem == 'user'">
        <select v-model="dataHolder.user_id">
          <option value="">Select Members</option>
          <option v-for="user in orderedUsers" v-bind:value="user.id">{{ user.full_name }}</option>
        </select>
        <el-button
          class="same-line"
          type="success"
          icon="el-icon-check"
          circle
          @click.prevent="addUser(dataHolder.user_id)"
        >Save</el-button>
        <a href="#" class="same-line" @click.prevent="dataItem=''">Cancel</a>
      </div>
    </div>
    <el-button
      icon="el-icon-circle-plus-outline"
      class="same-line"
      v-show="dataItem !== 'user'"
      @click.prevent="startUserEdit"
    ></el-button>
    <br>
    <br>
    <div v-for="user in orderedMembers" v-bind:key="user.id">
      <p class="same-line">{{ user.full_name }}</p>
      <i class="el-icon-delete same-line" @click.prevent="removeUsers(user.id)"></i>
    </div>
  </div>
</template>

<script>
export default {
  props: ["choices"],
  computed: {
    orderedUsers() {
      return _.orderBy(this.choices.users, "first_name");
    },
    orderedMembers() {
      return _.orderBy(this.meetingseriesdetails.users, "first_name");
    }
  },
  data() {
    return {
      meetingseriesdetails: {},
      editItem: "",
      dataHolder: {},
      dataItem: "",
      mode: "r",
      content: this.$store.state.content
    };
  },
  created() {
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
  },
  methods: {
    addUser(id) {
      let checkMtgSeries = this.meetingseriesdetails.users.filter(function(
        user
      ) {
        return user.id === id;
      });

      if (!checkMtgSeries.length) {
        this.dataHolder.user_id = id;
        axios
          .post("/api/meetingseries/attachuser", this.dataHolder)
          .then(response => {
            this.meetingseriesdetails.users.push(this.choices.users[id]);
            this.dataItem = "";
          });
      } else {
        alert("User already exists");
      }
    },
    startUserEdit() {
      this.dataItem = "user";
      this.dataHolder.meetingseries_id = this.meetingseriesdetails.id;
    },
    removeUsers(id) {
      axios.delete("/api/meetingseries/" + this.meetingseriesdetails.id + "/users/" + id)
        .then(response => {
          let index = this.meetingseriesdetails.users
            .map(function(item) {
              return item.id;
            })
            .indexOf(id);
          this.meetingseriesdetails.users.splice(index, 1);
        });
    },
    startMeetingSeriesFieldEdit(theField) {
      this.dataItem = theField;
      this.dataHolder[theField] = this.meetingseriesdetails[theField];
    },
    saveMeetingSeriesFieldEdit(theField) {
      axios
        .put(
          "/api/meetingseries/" + this.meetingseriesdetails.id,
          this.dataHolder
        )
        .then(response => {
          this.meetingseriesdetails[theField] = this.dataHolder[theField];
        }),
        (this.dataHolder = {});
      this.dataItem = "";
    }
  }
};
</script>

<style scoped>
</style>

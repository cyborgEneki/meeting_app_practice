<template>
  <div class="row">
    <div class="grid-x">
      <div class="cell small-6">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search meeting" v-model="searchTerm">
          <div class="input-group-append">
            <button class="btn btn-secondary" type="button" @click="searchMeeting">
              <i class="el-icon-search"></i>
            </button>
          </div>
        </div>

        <div class="grid-x">
          <div class="cell small-2" id="mainmenu">
            <a class="button newbutton" href="#/create">New Meeting</a>
            <router-link :to="{ name: 'meetings'}" class="links">Meetings</router-link>
            <router-link :to="{ name: 'venues' }" class="links">Venues</router-link>
            <router-link :to="{ name: 'users'}" class="links">User Management</router-link>
            <router-link :to="{ name: 'meetingSeries'}" class="links">Meeting Series</router-link>
            <router-link :to="{ name: 'meetingTypes'}" class="links">Meeting Types</router-link>
            <router-link :to="{ name: 'medias'}" class="links">Media</router-link>
          </div>
          <div class="cell small-10">
            <router-view :choices.sync="choices" :searchResults.sync="searchResults"/>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "App",
  data() {
    return {
      choices: [],
      searchResults: null,
      searchTerm: ""
    };
  },
  created() {
    axios.get("/api/meetings/choices").then(response => {
      this.choices = response.data;
    });
  },
  methods: {
    searchMeeting() {
      axios
        .get("/api/meetings/search/?search=" + this.searchTerm)
        .then(response => {
          this.searchResults = response.data;
          this.$router.push("/meetings/searchresults");
        });
    }
  }
};
</script>

<style scoped>
#mainmenu a.router-link-active {
  color: #1bd67c;
  background: #f5f6f7;
}

#mainmenu a {
  padding: 10px;
}

#mainmenu {
  padding: 10px;
}

.links {
  display: block;
}
.list {
  text-align: left;
  max-width: 500px;
  margin: auto;
}

.newbutton {
  margin: 10px 0;
}

.head {
  margin-top: 10px;
}
</style>
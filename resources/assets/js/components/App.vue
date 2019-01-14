<template>
    <div class="row">

        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search meeting" v-model="searchTerm">
            <div class="input-group-append">
                <button class="btn btn-secondary" type="button" @click="searchMeeting">
                    <i class="el-icon-search"></i>
                </button>
            </div>
        </div>

        <div class="col-md-2"><h1>Promeet</h1>
            <ul>
                <li>
                    <router-link :to="{ name: 'meetings'}">Meetings</router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'venues' }">Venues</router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'users'}">User Management</router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'meetingSeries'}">Meeting Series</router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'meetingTypes'}">Meeting Types</router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'medias'}">Media</router-link>
                </li>
            
            </ul>
        </div>
        <div class="col-md-10">
            <router-view :choices.sync="choices" :searchResults.sync="searchResults"/>
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
                searchTerm: ''
            }
        },
        created() {
            axios.get('/api/meetings/choices')
                .then(response => {
                    this.choices = response.data;
                })
        },
        methods: {
            searchMeeting() {
                axios.get('/api/meetings/search/?search='+this.searchTerm)
                    .then(response => {
                        this.searchResults = response.data;
                        this.$router.push('/meetings/searchresults');
                    })
            }
        }
    }
</script>

<style scoped>

</style>
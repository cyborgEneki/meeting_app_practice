<template>
    <div class="row">

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
            <router-view :choices.sync="choices"/>
        </div>
    </div>
</template>

<script>
    export default {
        name: "App",
        data() {
            return {
                choices: []
            }
        },
        created() {
            axios.get('/api/meetings/choices')
                .then(response => {
                    this.choices = response.data;
                })
        }
    }
</script>

<style scoped>

</style>
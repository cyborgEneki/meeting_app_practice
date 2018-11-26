<template>
    <div>
        <h1>Promeet</h1>
        <p>
            <router-link :to="{ name: 'meetings'}">Meetings</router-link>
            <router-link :to="{ name: 'venues'}">Venues</router-link>
            <router-link :to="{ name: 'users'}">User Management</router-link>
            <router-link :to="{ name: 'meetingSeries'}">Meeting Series</router-link>
            <router-link :to="{ name: 'media'}">Media</router-link>
        </p>
        <div>
            <router-view/>
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
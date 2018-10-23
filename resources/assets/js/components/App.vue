<template>
    <div>
        <h1>Promeet</h1>
        <p>
            <router-link :to="{ name: 'meetings'}">All Meetings</router-link>
            <router-link :to="{ name: 'agendas'}">All Agendas</router-link>
        </p>
        <div>
            <router-view/>
        </div>
    </div>
</template>

<script>
    export default {
        name: "App"
    }
</script>

<style scoped>

</style>
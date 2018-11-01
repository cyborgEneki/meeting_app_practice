<template>
    <div>
        <h1>Promeet</h1>
        <p>
            <router-link :to="{ name: 'meetings'}">Meetings</router-link>
            <router-link :to="{ name: 'venues'}">Venues</router-link>
        </p>
        <div>
            <router-view/>
        </div>
    </div>
</template>

<script>
    export default {
        name: "App",
    }
</script>

<style scoped>

</style>
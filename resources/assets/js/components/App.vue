<template>
    <div>
        <h1>Promeet</h1>
        <p>
            <router-link :to="{ name: 'meetings'}">All Meetings</router-link>
            <router-link :to="{ name: 'venues'}">All Venues</router-link>
            <router-link :to="'/meetings/'+meeting.id+'/details'" v-for= "meeting in meetings" :key="meeting.id">{{ meeting.name }}</router-link>
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
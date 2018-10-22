<template>
    <div id="app">
        <h2>Promeet</h2>
        <p>
            <router-link :to="ListMeetings">List All Meetings</router-link>
        </p>
        <div class="container">
            <router-view />
        </div>
    </div>
</template>

<script>
    export default {
        name: "app",
        mounted(){
            console.log('mounted');
        }
    }
</script>

<style>
    #app {
        font-family: 'Avenir', Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: center;
        color: #2c3e50;
        margin-top: 60px;
    }
</style>
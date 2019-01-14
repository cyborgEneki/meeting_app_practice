<template>
    <div>
        <h3>Results</h3>
        {{ theresults }}
        <ol>
            <li v-for="meeting in theresults.meetings">{{meeting.name}}</li>
        </ol>
    </div>
</template>

<script>
    export default {
        name: "MeetingResults",
       
        data: function () {
            return {
                
            }
        }
    }

</script>

<style scoped>

</style>
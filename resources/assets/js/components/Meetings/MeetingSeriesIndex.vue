<template>
    <div>
        <meeting-series-list :choices.sync="choices"></meeting-series-list>
    </div>
</template>

<script>
    import MeetingSeriesList from "./partials/meetingSeries/MeetingSeriesList";
    export default {
        name: "MeetingSeriesIndex",
        props: ['choices'],
        components: {MeetingSeriesList}
    }
</script>

<style scoped>

</style>
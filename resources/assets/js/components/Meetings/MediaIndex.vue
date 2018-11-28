<template>
    <div>
        <media-list :choices.sync="choices"></media-list>
    </div>
</template>

<script>
    import MediaList from "./partials/media/MediaList";

    export default {
        name: "MediaIndex",
        props: ['choices'],
        components: {MediaList}
    }
</script>

<style scoped>

</style>
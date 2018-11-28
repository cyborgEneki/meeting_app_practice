<template>
    <div>
        <venue-list :choices.sync="choices"></venue-list>
    </div>

</template>

<script>
    import VenueList from "./partials/venues/VenueList";
    export default {
        name: "VenuesIndex",
        props: ['choices'],
        components: {VenueList},
        data() {
            return {
                venue: {},
                venues: []
            }
        },
        mounted() {
            axios.get('api/venues')
                .then(response => {
                    this.venues = response.data;
                })
        }
    }
</script>

<style scoped>

</style>
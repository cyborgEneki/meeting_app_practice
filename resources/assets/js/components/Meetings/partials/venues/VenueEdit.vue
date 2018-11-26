<template>
    <div>
        <label>Name</label>
        <input type="text" v-model="venue.name">
        <button @click="editVenue(venue)"></button>
    </div>
</template>

<script>
    export default {
        name: "VenueEdit",
        props: ['venue'],
        methods: {
            editVenue(venue) {
                let currentVenue = {};

                currentVenue.name = venue.name;

                axios.put('/api/venues/' + venue.id, currentVenue)
                    .then(response => {});
            }
        }
    }
</script>

<style scoped>

</style>
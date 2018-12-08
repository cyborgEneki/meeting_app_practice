<template>
    <div>
        <label>Name</label>
        <input type="text" v-model="venue.name">
        <button @click="editVenue(venue)">Edit Venue</button>
        <button @click="$router.go(-1)">Go Back to Previous Page</button>
    </div>
</template>

<script>
    import 'vuejs-noty/dist/vuejs-noty.css';

    export default {
        name: "VenueEdit",
        props: ['venue'],
        methods: {
            editVenue(venue) {
                let currentVenue = {};

                currentVenue.name = venue.name;

                axios.put('/api/venues/' + venue.id, currentVenue)
                    .then(response => {
                    });
                this.$router.push('/venues');
                this.$noty.success("Your venue has been edited!");
            }
        }
    }
</script>

<style scoped>

</style>
<template>
<div>
    <label>Name</label>
    <input type="text" v-model="venue.name">
    <button @click="addVenue">Save Venue</button>
    <button @click="$router.go(-1)">Go Back to Previous Page</button>
</div>
</template>

<script>
    export default {
        name: "VenueAdd",
        data() {
            return {
                venue: {
                    name: ''
                }
            }
        },
        methods: {
            addVenue(){
                axios.post('/api/venues', this.venue)
                    .then(response => {});
                this.$router.push('/venues');
            }
        }
    }
</script>

<style scoped>

</style>
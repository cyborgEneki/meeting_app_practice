<template>
<div>
    <label>Name</label>
    <input type="text" v-model="venue.name">
    <button @click="addVenue">Add Venue</button>
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
                    .then(response => {})
            }
        }
    }
</script>

<style scoped>

</style>
<template>
    <div>
        <h2>All Venues</h2>
<table class="table striped table-bordered">
    <thead>
    <th><strong>Name</strong></th>
    </thead>
    <tbody>
    <tr v-for="venue in venues">
        <td>{{ venue.name }}</td>
    </tr>
    </tbody>
</table>
    </div>

</template>

<script>
    export default {
        name: "VenuesIndex",
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
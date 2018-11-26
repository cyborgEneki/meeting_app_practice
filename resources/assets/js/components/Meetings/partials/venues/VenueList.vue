<template>
    <div>
        <h3>Venues</h3>

        <router-link :to="{ name: 'addVenue' }">Create a new venue</router-link>
       <table>
           <thead>
           <th>Name</th>
           <th>Actions</th>
           </thead>
           <tr v-for="venue in venues">
               <td> {{ venue.name }}</td>
               <td>
                   <router-link :to="{ name: 'editVenue', params: { venue } }">Edit</router-link>
               </td>
           </tr>
       </table>
    </div>
</template>

<script>
    export default {
        name: "VenueList",
        data() {
            return {
                venues: []
            }
        },
        created() {
            this.getVenues();
        },
        methods: {
            getVenues(){
                axios.get('/api/venues')
                    .then(response => {
                        this.venues = response.data;
                        console.log(this.venues)
                    });
            }
        }
    }
</script>

<style scoped>

</style>
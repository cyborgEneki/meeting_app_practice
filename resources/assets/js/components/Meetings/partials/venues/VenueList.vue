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
                   <button @click="deleteVenue(venue.id)">Delete</button>
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
                    });
            },
            deleteVenue(id) {
                axios.delete('/api/venues/' + id)
                    .then(() => {
                        let index = this.venues.map((item) => {
                            return item.id;
                        }).indexOf(id);
                        this.venues.splice(index, 1);
                    })
            }
        }
    }
</script>

<style scoped>

</style>
<template>
    <div>
        <router-link :to="{ name: 'addMedia' }">Create a media</router-link>
        <h3>Media</h3>
        <table>
            <th>Name</th>
            <th>Actions</th>
            <tr v-for="eachmedia in media">
                <td>{{eachmedia.name}}</td>
                <td>
                    <router-link :to="{ name: 'editMedia', params: { eachmedia } }">Edit</router-link>
                    <button @click="deleteMedia(eachmedia.id)">Delete</button>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        name: "MediaList",
        data() {
            return {
                media: []
            }
        },
        methods: {
            getMedia() {
                axios.get('/api/media', this.media)
                    .then(response => {
                        this.media = response.data;
                    })
            },
            deleteMedia(id) {
                axios.delete('/api/media/' + id, this.media)
                    .then(() => {
                        let index = this.media.map(item => {
                            return item.id;
                        }).indexOf(id);
                        this.media.splice(index, 1);
                    });
            }
        },
        created() {
            this.getMedia();
        }
    }
</script>

<style scoped>

</style>
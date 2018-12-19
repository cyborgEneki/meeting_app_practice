<template>
    <div>
        <router-link :to="{ name: 'addMedia' }">Create a media</router-link>
        <h3>Media</h3>
        <table>
            <th>Name</th>
            <th>Actions</th>
            <tr v-for="eachmedia in orderedMedia">
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
        props: ['choices'],
        data() {
            return {
                media: []
            }
        },
        computed: {
            orderedMedia() {
                return _.orderBy(this.choices.media, 'name');
            }
        },
        methods: {
            deleteMedia(id) {
                axios.delete('/api/medias/' + id, this.media)
                    .then(() => {
                        let index = this.media.map(item => {
                            return item.id;
                        }).indexOf(id);
                        this.media.splice(index, 1);
                    });
            }
        }
    }
</script>

<style scoped>

</style>
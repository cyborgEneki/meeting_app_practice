<template>
    <div>
        <label>Name</label>
        <input type="text" v-model="media.name"/>
        <button @click="addMedia">Save Media</button>
        <button @click="$router.go(-1)">Go Back to Previous Page</button>
    </div>
</template>

<script>
    import 'vuejs-noty/dist/vuejs-noty.css';

    export default {
        name: "MediaAdd",
        data() {
            return {
                media: {
                    name: ''
                }
            }
        },
        methods: {
            addMedia() {
                axios.post('/api/medias/', this.media)
                    .then(response => {
                    });
                this.$router.push('/media');
                this.$noty.success("Your venue has been saved!");
            }
        }
    }
</script>

<style scoped>

</style>
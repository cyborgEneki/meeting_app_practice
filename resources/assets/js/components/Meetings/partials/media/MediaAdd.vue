<template>
    <div>
        <label>Name</label>
        <input type="text" v-model="media.name"/>
        <button @click="addMedia">Save Media</button>
        <button @click="$router.go(-1)">Go Back to Previous Page</button>
    </div>
</template>

<script>
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
                axios.post('/api/media/', this.media)
                    .then(response => {});
                this.$router.push('/media');
            }
    }
    }
</script>

<style scoped>

</style>
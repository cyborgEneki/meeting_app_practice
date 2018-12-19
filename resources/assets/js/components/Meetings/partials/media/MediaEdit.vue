<template>
    <div>
        <label>Name</label>
        <input type="text" v-model="eachmedia.name">
        <button @click="editMedia(eachmedia)">Edit Media</button>
        <button @click="$router.go(-1)">Go Back to Previous Page</button>
    </div>
</template>

<script>
    import 'vuejs-noty/dist/vuejs-noty.css';

    export default {
        name: "MediaEdit",
        props: ['eachmedia'],
        methods: {
            editMedia(eachmedia) {
                axios.put('/api/medias/' + eachmedia.id, eachmedia)
                    .then(response => {
                    });
                this.$router.push('/medias');
                this.$noty.success("This media  has been edited!");
            }
        }
    }
</script>

<style scoped>

</style>
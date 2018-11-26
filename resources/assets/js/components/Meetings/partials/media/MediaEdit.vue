<template>
    <div>
        <label>Name</label>
        <input type="text" v-model="eachmedia.name">
        <button @click="editMedia(eachmedia)">Edit Media</button>
    </div>
</template>

<script>
    export default {
        name: "MediaEdit",
        props: ['eachmedia'],
        methods: {
            editMedia: function (eachmedia) {
                let currentMedia = {};

                currentMedia.name = eachmedia.name;

                axios.put('/api/media/' + eachmedia.id, currentMedia)
                    .then(response => {});
                this.$router.push('/media');
            }
        }
    }
</script>

<style scoped>

</style>
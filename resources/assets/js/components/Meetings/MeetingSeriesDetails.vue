<template>
    <div>
        <h2>I</h2>
    </div>
</template>

<script>
export default {
    data() {
        return {
            meetingdetails: {},
            editItem: '',
            dataHolder: {},
            choices: [],
            mode: 'r',
            content: this.$store.state.content
        }
    },
    created () {
        this.dataHolder.eachmeetingseries
        ;
    }
}
</script>

<style scoped>

</style>

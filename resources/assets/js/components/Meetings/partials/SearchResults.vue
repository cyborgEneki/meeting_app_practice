<template>
    <div>
        <h1>Results</h1>
        {{ searchResults }}
    </div>

</template>

<script>
    export default {
        name: "SearchResults",
        props: ['searchResults']
    }

</script>

<style scoped>

</style>
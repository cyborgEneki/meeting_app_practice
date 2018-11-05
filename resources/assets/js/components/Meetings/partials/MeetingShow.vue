<template>
    <div>
        <h4>{{ meeting.name }}</h4>
        <p>{{meeting}}</p>
    </div>
</template>

<script>
    export default {
        props:['meeting'],
    }
</script>

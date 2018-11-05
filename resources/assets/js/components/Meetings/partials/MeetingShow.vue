<template>
    <div>
        <h4>{{ meeting.name }}</h4>
        <p>{{meeting}}</p>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    export default {
        computed:{
            ...mapGetters({
                meeting: 'meeting'
            })
        },
    }
</script>

<template>
    <div>
        <p>{{ meeting.name }}</p>
    </div>
</template>

<script>
    export default {
        name: 'MeetingDetails',
        props: ['id'],
        data() {
            return {
                meeting: {}
            }
        },
        mounted() {
            this.showMeetingDetails();
        },
        methods: {
            showMeetingDetails() {
                let uri = '/api/meetings/' + this.$route.params.id;
                axios.get(uri)
                    .then(response => {
                            this.meeting = response.data;
                        }
                    )
            }
        }
    }
</script>

<template>
    <div>
        <h3>Users</h3>
        <users-list :choices.sync="choices"></users-list>
    </div>
</template>

<script>
    import UsersList from './partials/users/UsersList'

    export default {
        name: "UsersIndex",
        props: ['choices'],
        components: {'users-list': UsersList}
    }
</script>

<style scoped>

</style>
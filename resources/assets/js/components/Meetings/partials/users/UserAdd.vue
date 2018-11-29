<template>
    <div>
        <div>
            <label>First Name</label>
            <input type="text" v-model="user.first_name">
            <label>Middle Name</label>
            <input type="text" v-model="user.middle_name">
            <label>Last Name</label>
            <input type="text" v-model="user.last_name">
            <label>Phone Number</label>
            <input type="text" v-model="user.phone_number">
            <label>Email</label>
            <input type="text" v-model="user.email">
            <label>Password</label>
            <input type="text" v-model="user.password">
        </div>
        <button @click="addUser">Save User</button>
    </div>
</template>

<script>
    export default {
        name: "UserAdd",
        data(){
            return {
                user: {
                    first_name: '',
                    middle_name: '',
                    last_name: '',
                    phone_number: '',
                    email: '',
                    password: '',
                }
            }
        },
        methods: {
            addUser(){
                axios.post('/api/users', this.user)
                    .then(response => {});
                this.$router.push('/users');
            }
        }
    }
</script>

<style scoped>

</style>
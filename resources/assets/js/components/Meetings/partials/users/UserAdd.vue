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
            <input v-validate="'required|email'" name="email" type="text" v-model="user.email">
            <span>{{ errors.first('email') }}</span>
            <label>Password</label>
            <input type="text" v-model="user.password">
            <label>Confirm Password</label>
            <input type="text" v-model="user.password_confirmation">
        </div>
        <button @click="addUser">Save User</button>
        <button @click="$router.go(-1)">Go Back to Previous Page</button>
    </div>
</template>

<script>
    import 'vuejs-noty/dist/vuejs-noty.css';

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
                this.$noty.success("Your user has been saved!");
            }
        }
    }
</script>

<style scoped>

</style>
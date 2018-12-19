<template>
    <div>
        <h3>Edit User</h3>

        <div>
            First Name<input type="text" v-model="user.first_name"/>
        </div>
        <div>
            Middle Name<input type="text" v-model="user.middle_name"/>
        </div>
        <div>
            Last Name<input type="text" v-model="user.last_name"/>
        </div>
        <div>
            Phone Number<input type="text" v-model="user.phone_number"/>
        </div>
        <div>
            Email<input type="text" v-model="user.email"/>
        </div>

        <button @click="editUser(user)">Edit User</button>
        <button @click="$router.go(-1)">Go Back to Previous Page</button>
    </div>
</template>

<script>
    import 'vuejs-noty/dist/vuejs-noty.css';

    export default {
        props: ['user'],

        methods: {
            editUser: function (user) {
                axios.put('/api/users/' + user.id, user)
                    .then(response => {
                    });
                this.$router.push('/users');
                this.$noty.success("This user has been edited!");
            }
        },
    }
</script>

<style scoped>

</style>
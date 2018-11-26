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
    </div>
</template>

<script>
    export default {
        props: ['user'],

        methods: {
            editUser: function (user) {
                let currentUser = {};

                currentUser.first_name = user.first_name;
                currentUser.middle_name = user.middle_name;
                currentUser.last_name = user.last_name;
                currentUser.phone_number = user.phone_number;
                currentUser.email = user.email;

                axios.put('/api/users/' + user.id, currentUser)
                    .then(response => {});
                this.$router.push('/users');
            }
        },
    }
</script>

<style scoped>

</style>
<template>
    <div>
        <table>
            <thead>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user_id">
                    <td>{{ user_first_name}}</td>
                    <td>{{ user_middle_name}}</td>
                    <td>{{ user_last_name}}</td>
                    <td>{{ user_phone_number}}</td>
                    <td>{{ user_email}}</td>
                    <td>
                        <router-link></router-link>
                        <button>Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "UsersList",
        data() {
            return {
                users: []
            }
        },
        created() {
            this.getUsers();
        },
        methods: {
            getUsers() {
                axios.get('/api/users/')
                    .then((response) => {
                        this.users = response.data;
                    })
            }
        }
    }
</script>

<style scoped>

</style>
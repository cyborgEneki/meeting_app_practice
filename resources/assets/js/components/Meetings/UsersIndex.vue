<template>
    <div>
        <router-link :to="{ name: 'addUser' }">Add a New User</router-link>

        <table class="table striped table-bordered">
            <thead>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Actions</th>
            </thead>
            <tbody>
            <tr v-for="user in orderedUsers" :key="user.id">
                <td>{{ user.first_name }}</td>
                <td>{{ user.middle_name }}</td>
                <td>{{ user.last_name }}</td>
                <td>{{ user.phone_number }}</td>
                <td>{{ user.email }}</td>
                <td>
                    <router-link :to="{ name: 'editUser', params: { user } }">Edit</router-link>
                    <button @click="deleteUser(user.id)">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "UsersList",
        props: ['choices'],
        data() {
            return {
                users: []
            }
        },
        computed: {
            orderedUsers: function () {
                return _.orderBy(this.choices.users, 'first_name')
            }
        },
        methods: {
            deleteUser(id) {
                this.$dialog.confirm('Please confirm to continue')
                    .then(function (dialog) {
                        console.log('Clicked on proceed')
                    })
                    .catch(function () {
                        console.log('Clicked on cancel')
                    });

                axios.delete('/api/users/' + id)
                    .then(() => {
                        let index = this.users.map((item) => {
                            return item.id;
                        }).indexOf(id);
                        this.users.splice(index, 1);
                    });
            }
        }
    }
</script>

<style scoped>

</style>
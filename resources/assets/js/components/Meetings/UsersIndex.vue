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
                    <div class="confirmation__button">
                        <vue-confirmation-button
                                :messages="customMessages"
                                v-on:confirmation-success="deleteUser(user.id)">
                        </vue-confirmation-button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import vueConfirmationButton from 'vue-confirmation-button';

    export default {
        name: "UsersList",
        components: {
            'vue-confirmation-button': vueConfirmationButton,
        },
        props: ['choices'],
        data() {
            return {
                customMessages:
                    [
                        'Delete',
                        'Are you sure?',
                        'Ok!'
                    ]
            }
        },
        computed: {
            orderedUsers: function () {
                return _.orderBy(this.choices.users, 'first_name')
            }
        },
        methods: {
            deleteUser(id) {
                axios.delete('/api/users/' + id)
                    .then(() => {
                        let index = this.choices.users.map((item) => {
                            return item.id;
                        }).indexOf(id);
                        this.choices.users.splice(index, 1);
                    });
            }
        }
    }
</script>

<style scoped>

</style>
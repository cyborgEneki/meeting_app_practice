<template>
    <div>
        <h3>Users</h3>
        <router-link :to="{ name: 'addUser' }">Add New User</router-link>

        <table class="table striped table-bordered">
			<tr v-for="user in choices.users">
				<td>{{ user.first_name }}</td>
				<td>{{ user.last_name }}</td>
				<td>{{ user.email }}</td>
				<td><router-link :to="{ name: 'editUser', params: { user } }">Edit</router-link></td>
				<td><button @click="deleteUser(user.id)">Delete</button></td>
			</tr>
		</table>

    </div>
</template>

<script>

    export default {
        name: "UsersIndex",
        props: ['choices'],
        methods: {
            deleteUser(id) {
                axios.delete('/api/users/'+id)
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
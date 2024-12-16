<template>
    <div>
        <h1>User Statuses</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="userStatus in userStatuses" :key="userStatus.id">
                    <td>{{ userStatus.id }}</td>
                    <td>{{ userStatus.active ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <button @click="activate(userStatus.id)">Activate</button>
                        <button @click="deactivate(userStatus.id)">Deactivate</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: {
        userStatuses: Array,
    },
    methods: {
        activate(id) {
            this.$inertia.patch(`/user-status/activate/${id}`);
        },
        deactivate(id) {
            this.$}
        },
        };
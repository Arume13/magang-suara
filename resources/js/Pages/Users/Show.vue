<script>
export default {
    props: {
        user: Object,
    },
};
</script>
<template>
    <div>
        <h1>User Details</h1>
        <p>Name: {{ user.name }}</p>
        <p>Email: {{ user.email }}</p>
        <Link :href="`/users/${user.id}/edit`">Edit User</Link>
        <Link href="/users">Back to Users</Link>
    </div>
</template>
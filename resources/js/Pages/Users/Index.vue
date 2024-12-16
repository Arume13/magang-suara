<script setup>
import { ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";

defineProps({
    users: {
        type: Array,
        default: () => [],
    },
    userStatuses: {
        type:Array,
        default: () => [],
    },
});

// const form = useForm({});

const deleteUser = (id) => {
    if (confirm("Are you sure you want to delete this user?")) {
        router.delete(`/users/${id}`);
    }
};
</script>
<template>
    <Head title="Manage User" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manage User
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <Link href="users/create"
                            ><button
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3"
                            >
                                Create New User
                            </button></Link
                        >
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="border px-4 py-2">ID</th>
                                    <th class="border px-4 py-2">Name</th>
                                    <th class="border px-4 py-2">Email</th>
                                    <th class="border px-4 py-2" width="250px">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users.data" :key="user.id">
                                    <td class="border px-4 py-2">
                                        {{ user.id }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ user.name }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ user.email }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        <Link :href="`users/${user.id}/edit`"
                                            ><button
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                            >
                                                Edit
                                            </button></Link
                                        >
                                        <button
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2"
                                            @click="deleteUser(user.id)"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div
                            class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6"
                        >
                            <div class="flex flex-1 justify-between sm:hidden">
                                <a
                                    href="#"
                                    class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                                    ></a
                                >
                                <a
                                    href="#"
                                    class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                                    ></a
                                >
                            </div>
                            <div
                                class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between"
                            >
                                <div>
                                    <p class="text-sm text-gray-700">
                                        Showing
                                        <span class="font-medium">1</span>
                                        to
                                        <span class="font-medium">10</span>
                                        of
                                        <span class="font-medium">97</span>
                                        results
                                    </p>
                                    <h1
                                    v-for="status in users.data" :key="status.user_status_id"
                                    >{{ status.user_status_id }}</h1>
                                </div>
                                <div>
                                    <nav
                                        class="isolate inline-flex -space-x-px rounded-md shadow-sm"
                                        aria-label="Pagination"
                                    >
                                        <!-- Current: "z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600", Default: "text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0" -->
                                        <Link
                                        v-for="link in users.links"
                                            :href="link.url"
                                            aria-current="page"
                                            class="relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                            v-html="link.label"
                                            ></Link
                                        >              
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

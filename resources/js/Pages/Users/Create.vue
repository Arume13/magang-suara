<script setup>
import { ref } from "vue";
import { Link, router } from "@inertiajs/vue3";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
const form = ref({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});
const submit = () => {
    router.post("/users", form.value);
};

defineProps({
    users: {
        type: Array,
        default: () => [],
    },
    userStatuses: {
        type: Array,
        default: () => [],
    },
});
</script>
<template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <Link href="/users"
                        ><button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3"
                        >
                            Back
                        </button></Link
                    >

                    <form @submit.prevent="submit">
                        <div class="mb-4">
                            <label
                                for="title"
                                class="block text-gray-700 text-sm font-bold mb-2"
                            >
                                Name:</label
                            >
                            <input
                                type="text"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Enter your name"
                                v-model="form.name"
                            />
                        </div>
                        <div class="mb-4">
                            <label
                                for="title"
                                class="block text-gray-700 text-sm font-bold mb-2"
                            >
                                Email:</label
                            >
                            <input
                                type="email"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="mail@xxx.xxx"
                                v-model="form.email"
                            />
                        </div>
                        <div class="mb-4">
                            <label
                                for="title"
                                class="block text-gray-700 text-sm font-bold mb-2"
                            >
                                Password:</label
                            >
                            <input
                                type="password"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="******"
                                v-model="form.password"
                            />
                        </div>
                        <div class="mb-4">
                            <label
                                for="title"
                                class="block text-gray-700 text-sm font-bold mb-2"
                            >
                                Confirm Password:</label
                            >
                            <input
                                type="password"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="******"
                                v-model="form.password_confirmation"
                            />
                        </div>
                        <h1
                            v-for="status in users.data"
                            :key="status.user_status_id"
                        >
                            {{ status.user_status_id }}
                        </h1>
                        <Dropdown align="left" width="48">
                            <template #trigger>
                                <span class="inline-flex rounded-md">
                                    <button
                                        type="button"
                                        class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                                    >
                                        {{ $page.props.auth.user.name }}

                                        <svg
                                            class="-me-0.5 ms-2 h-4 w-4"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <DropdownLink
                                    v-for="status in users.data"
                                    :key="status.id"
                                >
                                    {{ status.user_status_id }}
                                </DropdownLink>
                                <DropdownLink
                                    :href="route('logout')"
                                    method="post"
                                    as="button"
                                >
                                    Log Out
                                </DropdownLink>
                            </template>
                        </Dropdown>
                        <button
                            type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3 text-white"
                        >
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- <div>
        <h1>Create User</h1>
        <form @submit.prevent="submit">
            <input
                v-model="form.name"
                type="text"
                placeholder="Name"
                required
            />
            <input
                v-model="form.email"
                type="email"
                placeholder="Email"
                required
            />
            <input
                v-model="form.password"
                type="password"
                placeholder="Password"
                required
            />
            <input
                v-model="form.password_confirmation"
                type="password"
                placeholder="Confirm Password"
                required
            />
            <button type="submit">Create</button>
        </form>
    </div> -->
</template>

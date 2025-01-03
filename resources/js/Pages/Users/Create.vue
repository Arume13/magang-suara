<script setup>
import { ref } from "vue";
import { Link, router, useForm } from "@inertiajs/vue3";
import { FwbButton, FwbAvatar, FwbFileInput, FwbInput } from "flowbite-vue";
const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    user_status_id: "",
    avatar: "",
});

const submit = () => {
    form.post("/users");
};

const handleFileUpload = (e) => {
    console.log(e.target.files[0]);
    form.avatar = e.target.files[0];
};

defineProps({
    users: {
        type: Array,
        default: () => [],
    },
    status: {
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
                        ><fwb-button
                            class="bg-red-500 hover:bg-red-800 text-white font-bold py-2 px-4 rounded my-3"
                        >
                            Back
                        </fwb-button></Link
                    >

                    <div
                        v-if="!$page.props.errors"
                        class="bg-green-100 border-l-4 mb-5 border-green-500 text-green-700 p-4 rounded-lg"
                    >
                        <p class="text-lg font-semibold">Success</p>
                    </div>

                    <div
                        v-if="
                            $page.props.errors.email ||
                            $page.props.errors.password
                        "
                        class="bg-red-100 border-l-4 mb-5 border-red-500 text-red-700 p-4 rounded-lg"
                    >
                        <p class="text-lg font-semibold">Error</p>
                        <div class="block">
                            <p>
                                {{ $page.props.errors.email }}
                            </p>
                            <p>
                                {{ $page.props.errors.password }}
                            </p>
                        </div>
                    </div>

                    <form
                        @submit.prevent="submit"
                        method="post"
                        enctype="multipart/form-data"
                    >
                        <div class="mb-4">
                            <fwb-avatar size="lg"
                                img="https://www.svgrepo.com/show/500470/avatar.svg"
                                alt="ads"
                                rounded
                            />

                            <label
                                for="avatar"
                                class="block text-gray-700 text-sm font-bold mb-2"
                            >
                                Avatar
                            </label>
                            <fwb-file-input
                                class="mb-2"
                                type="file" accept="image/png, image/gif, image/jpeg"
                                @change="handleFileUpload"
                            />
                            <label
                                for="title"
                                class="block text-gray-700 text-sm font-bold mb-2"
                            >
                                Name:</label
                            >
                            <fwb-input
                                type="text"
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
                            <fwb-input
                                type="email"
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
                            <fwb-input
                                type="password"
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
                            <fwb-input
                                type="password"
                                placeholder="******"
                                v-model="form.password_confirmation"
                            />
                        </div>

                        <select
                            class="block w-sm text-sm font-medium transition duration-75 border border-gray-800 rounded-lg shadow-sm h-9 focus:border-blue-600 focus:ring-1 focus:ring-inset focus:ring-blue-600 bg-none"
                            v-model="form.user_status_id"
                        >
                            <option disabled value="">Please select one</option>
                            <option
                                v-for="item in status"
                                :value="item.id"
                                :key="item.id"
                            >
                                {{ item.name }}
                            </option>
                        </select>

                        <button
                            type="submit"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded my-3 text-white"
                        >
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

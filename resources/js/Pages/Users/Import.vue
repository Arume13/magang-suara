<script setup>
import { ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router, useForm, usePage } from "@inertiajs/vue3";
const page = usePage();
const props = defineProps({
    users: {
        type: Array,
        default: () => [],
    },
    status: {
        type: Array,
        default: () => [],
    },
});

const form = useForm({
    name: props.users.name,
    email: props.users.email,
    password: "",
    password_confirmation: "",
    user_status_id: props.users.user_status_id,
    avatar: props.users.avatar ? props.users.avatar : null,
});

const imports = useForm({
    file: "",
});

const submit = () => {
    imports.post("/exportimport");
};

const handleFileUpload = (e) => {
    console.log(e.target.files[0]);
    imports.file = e.target.files[0];
};
</script>
<template>
    <Head title="Manage User" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Export/Import Data User
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="">
                            <form
                                @submit.prevent="submit"
                                method="post"
                                enctype="multipart/form-data"
                            >
                                <input
                                    type="file"
                                    accept="csv,xls,xlsx"
                                    class=""
                                    @change="handleFileUpload"
                                    id="upload"
                                    hidden
                                />
                                <label
                                    for="upload"
                                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded cursor-pointer"
                                    >Import</label
                                >
                                <span> Import Data Users From Excel Files</span>
                                <button
                                    type="submit"
                                    class="flex items-end bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-2.5 rounded my-3 text-white "
                                >
                                    Upadate
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

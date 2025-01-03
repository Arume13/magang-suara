<script setup>
import { ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router, useForm, usePage } from "@inertiajs/vue3";
import {
    FwbButton,
    FwbModal,
    FwbFileInput,
    FwbTable,
    FwbTableBody,
    FwbTableCell,
    FwbTableHead,
    FwbTableHeadCell,
    FwbTableRow,
    FwbA,
} from "flowbite-vue";
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
    auth: {
        type: Object,
        required: true,
    },
});
// const form = useForm({});

const deleteUser = (id) => {
    if (confirm("Are you sure you want to delete this user?")) {
        router.delete(`/users/${id}`);
    }
};

const checkPermission = (permissionName) => {
    return props.auth.permissions.some(
        (permission) => permission.name === permissionName
    );
};


console.log(page.props.users.data);


const isShowModal = ref(false);

function closeModal() {
    isShowModal.value = false;
}
function showModal() {
    isShowModal.value = true;
}

const imports = useForm({
    file: "",
});

const submit = () => {
    imports.post("/import");
    isShowModal.value = false;
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
                Manage User
            </h2>
        </template>
        <div class="py-12">
            <div
                v-if="!$page.props.errors"
                class="bg-green-100 border-l-4 mb-5 border-green-500 text-green-700 p-4 rounded-lg"
            >
                <p class="text-lg font-semibold">Success</p>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="py-5">
                            <Link href="users/create"
                                ><fwb-button
                                    v-if="checkPermission('add-user')"
                                    class="bg-blue-500 hover:bg-blue-700"
                                >
                                    Create New User
                                </fwb-button></Link
                            >
                            <a href="/user_export"
                                ><fwb-button
                                    class="bg-lime-500 hover:bg-lime-700 ml-2"
                                >
                                    Export
                                </fwb-button>
                            </a>
                            <fwb-button
                            @click="showModal"
                            class="ml-2 bg-violet-500 hover:bg-violet-700"
                            >Import
                        </fwb-button>
                        <!-- modal -->
                            <fwb-modal v-if="isShowModal" @close="closeModal">
                                <template #header>
                                    <div class="flex items-center text-lg">
                                        Import Data User
                                    </div>
                                </template>
                                <template #body>
                                    <p
                                        class="text-base text-center leading-relaxed text-gray-500 dark:text-gray-400"
                                    >
                                        Import Your Data Excel in Here
                                    </p>
                                    <fwb-file-input
                                        type="file"
                                        accept="csv,xls,xlsx"
                                        class=""
                                        @change="handleFileUpload"
                                        dropzone
                                    />
                                </template>
                                <template #footer>
                                    <div class="flex justify-between">
                                        <fwb-button
                                            @click="closeModal"
                                            color="alternative"
                                        >
                                            Decline
                                        </fwb-button>
                                        <fwb-button
                                            @click="submit"
                                            color="green"
                                        >
                                            accept
                                        </fwb-button>
                                    </div>
                                </template>
                            </fwb-modal>
                        </div>
                        <!-- end of modal -->
                        <fwb-table hoverable>
                            <fwb-table-head>
                                <fwb-table-head-cell class="text-center"
                                    >ID</fwb-table-head-cell
                                >
                                <fwb-table-head-cell class="text-center"
                                    >Name</fwb-table-head-cell
                                >
                                <fwb-table-head-cell class="text-center"
                                    >Email</fwb-table-head-cell
                                >
                                <fwb-table-head-cell class="text-center"
                                    >Status</fwb-table-head-cell
                                >
                                <fwb-table-head-cell class="text-center"
                                    >Role</fwb-table-head-cell
                                >
                                <fwb-table-head-cell
                                    class="text-center"
                                    >Action</fwb-table-head-cell
                                >
                            </fwb-table-head>
                            <fwb-table-body
                                v-for="user in users.data"
                                :key="user.id"
                            >
                                <fwb-table-row>
                                    <fwb-table-cell>{{
                                        user.id
                                    }}</fwb-table-cell>
                                    <fwb-table-cell>
                                        <fwb-a :href="`users/${user.id}/show`">
                                            {{ user.name }}</fwb-a
                                        ></fwb-table-cell
                                    >
                                    <fwb-table-cell>{{
                                        user.email
                                    }}</fwb-table-cell>
                                    <fwb-table-cell
                                        ><div
                                            v-if="
                                                user.status?.name === 'active'
                                            "
                                            class="border w-20 mx-auto rounded-lg text-center bg-green-500 text-white"
                                        >
                                            {{ user.status?.name }}
                                        </div>
                                        <div
                                            v-if="
                                                user.status?.name ===
                                                'in-active'
                                            "
                                            class="border w-20 mx-auto rounded-lg text-center bg-red-500 text-white"
                                        >
                                            {{ user.status?.name }}
                                        </div></fwb-table-cell
                                    >
                                    <fwb-table-cell>{{user?.roles[0]?.name}} </fwb-table-cell>
                                    <fwb-table-cell
                                        class="px-4 py-2 flex justify-center gap-5"
                                    >
                                        <Link :href="`users/${user.id}/edit`"
                                            ><fwb-button
                                                v-if="
                                                    checkPermission('edit-user')
                                                "
                                                class="bg-blue-500 hover:bg-blue-700 text-white"
                                            >
                                                Edit
                                            </fwb-button>
                                            </Link
                                        >
                                        <fwb-button
                                            v-if="
                                                checkPermission('delete-user')
                                            "
                                            class="bg-red-500 hover:bg-red-700 text-white"
                                            @click="deleteUser(user.id)"
                                        >
                                            Delete
                                        </fwb-button>
                                    </fwb-table-cell>
                                </fwb-table-row>
                            </fwb-table-body>
                        </fwb-table>
                        <div
                            class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6"
                        >
                            <div class="flex flex-1 justify-between sm:hidden">
                                <a
                                    href="#"
                                    class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                                ></a>
                                <a
                                    href="#"
                                    class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                                ></a>
                            </div>
                            <div
                                class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between"
                            >
                                <div>
                                    <p class="text-sm text-gray-700">
                                        Showing
                                        <span class="font-medium">{{
                                            users.from
                                        }}</span>
                                        to
                                        <span class="font-medium">{{
                                            users.to
                                        }}</span>
                                        of
                                        <span class="font-medium">{{
                                            users.total
                                        }}</span>
                                        results
                                    </p>
                                    <div class="block"></div>
                                </div>
                                <div>
                                    <nav class="" aria-label="Pagination">
                                        <!-- Current: "z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600", Default: "text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0" -->
                                        <Link
                                            v-for="link in users.links"
                                            :href="link.url"
                                            aria-current="page"
                                            class="relative z-10 inline-flex items-center rounded-lg m-1 bg-slate-500 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                            v-html="link.label"
                                        ></Link>
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

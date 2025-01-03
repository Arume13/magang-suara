<script setup>
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
    permission: {
        type: Array,
        default: () => [],
    },
});

console.log(page.props.permission);
</script>
<template>
    <Head title="Manage Roles" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manage Permissions
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <Link href="users/create"
                                            ><fwb-button
                                                class="bg-blue-500 hover:bg-blue-700"
                                            >
                                                Create New Permission
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
                        <div class="py-5">
                            <fwb-table hoverable>
                                <fwb-table-head>
                                    <fwb-table-head-cell class="text-center"
                                        >Name</fwb-table-head-cell
                                    >
                                    <fwb-table-head-cell class="text-center"
                                        >Action</fwb-table-head-cell
                                    >
                                </fwb-table-head>
                                <fwb-table-body>
                                    <fwb-table-row
                                        v-for="items in permission"
                                        :key="items.id"
                                    >
                                        <fwb-table-cell
                                        class="text-center"
                                        >{{
                                            items.name
                                        }}</fwb-table-cell>
                                        <fwb-table-cell>
                                            <Link :href="`roles/${items.id}/edit`"
                                            ><fwb-button
                                                class="bg-red-500 hover:bg-red-700 text-white"
                                            >
                                                Delete
                                            </fwb-button>
                                            </Link
                                        >
                                        </fwb-table-cell>
                                    </fwb-table-row>
                                </fwb-table-body>
                            </fwb-table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

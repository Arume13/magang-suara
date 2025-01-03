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
    role: {
        type: Array,
        default: () => [],
    },
});

console.log(page.props.role);
</script>
<template>
    <Head title="Manage Roles" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manage Roles
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
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
                                        v-for="items in role"
                                        :key="items.id"
                                    >
                                        <fwb-table-cell>{{
                                            items.name
                                        }}</fwb-table-cell>
                                        <fwb-table-cell>
                                            <Link :href="`roles/${items.id}/edit`"
                                            ><fwb-button
                                                class="bg-blue-500 hover:bg-blue-700 text-white"
                                            >
                                                Edit
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

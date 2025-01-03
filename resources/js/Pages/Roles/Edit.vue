<script setup>
import { Link, router, useForm, usePage } from "@inertiajs/vue3";
import { computed, defineComponent, toRefs } from "vue";
import { FwbButton,FwbInput, FwbFileInput, FwbAvatar, FwbCheckbox } from "flowbite-vue";

const page = usePage();

const props = defineProps({
    role: {
        type: Array,
        default: () => [],
    },
    permission: {
        type: Array,
        default: () => [],
    },
});

const form = useForm({
    name: props.role.name,
    permission_id:[] ,
});

const handleChecked = (e, id) => {
    const isChecked = e.target.checked;
    console.log(id);
    
    
    if (isChecked) {
        // Add the permission ID if it's not already in the array
        if (!form.permission_id.includes(id)) {
            form.permission_id.push(id);
        }
    } else {
        // Remove the permission ID from the array
        form.permission_id = form.permission_id.filter(permission => permission !== id);
    }
}

console.log(page.props);

const submit = () => {
    form.post(`/roles/${props.role.id}`);
};
</script>
<template>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl">Edit Roles</h1>
                    <Link href="/roles"
                        ><fwb-button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3"
                        >
                            Back
                        </fwb-button></Link
                    >

                    <form
                        @submit.prevent="submit"
                        method="post"
                        enctype="multipart/form-data"
                    >
                    <label
                            for="title"
                            class="block text-gray-700 text-sm font-bold mb-2 mt-2"
                        >
                            Roles:</label
                        >
                        <div class="mb-4">
                            <fwb-input
                                type="text"
                                placeholder="Enter your name"
                                v-model="form.name"
                            />
                        </div>
                        <label
                            for="title"
                            class="block text-gray-700 text-sm font-bold mb-2 mt-2"
                        >
                            Permissions:</label
                        >
                        <div class="flex justify-normal gap-2">
                            <fwb-checkbox
                                v-for="item in permission"
                                :value="item.id"
                                :key="item.id"
                                @change="e=> handleChecked (e, item.id)"
                                :checked="form.permission_id.includes(item.id)"
                                :label="item.name"
                            />
                        </div>

                        <fwb-button
                            type="submit"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded my-3 text-white"
                        >
                            Update
                        </fwb-button>
                    </form>
                </div>
            </div>
        </div>
        <!-- <form @submit.prevent="submit">
            <input v-model="form.name" type="text" placeholder="Name" required />
            <input v-model="form.email" type="email" placeholder="Email" required />
            <input v-model="form.password" type="password" placeholder="Password" />
            <input v-model="form.password_confirmation" type="password" placeholder="Confirm Password" />
            <button type="submit">Update</button>
        </form> -->
    </div>
</template>

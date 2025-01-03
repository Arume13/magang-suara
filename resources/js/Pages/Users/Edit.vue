<script setup>
import { Link, router, useForm, usePage } from "@inertiajs/vue3";
import { computed, defineComponent, toRefs } from "vue";
import { FwbButton,FwbInput, FwbFileInput, FwbAvatar, FwbCheckbox } from "flowbite-vue";

const page = usePage();

const props = defineProps({
    user: {
        type: Object,
        default: null,
    },
    status: {
        type: Array,
        default: () => [],
    },
    roles: {
        type: Array,
        default: () => [],
    },
    permission: {
        type: Array,
        default: () => [],
    },
});

const handleFileUpload = (e) => {
    form.avatar = e.target.files[0];
};


const form = useForm({
    name: props.user.name,
    email: props.user.email,
    password: "",
    password_confirmation: "",
    user_status_id: props.user.user_status_id,
    avatar: "",
    role_id: props.user.roles.length > 0 ? props.user.roles[0].id : null,
    permission_id: [],
});

const handleChecked = (e, id) => {
    const isChecked = e.target.checked;
    const permissionId = e.target.value;
    console.log(id);
    

    if (isChecked) {
        // form.permission_id = permissionId;
        form.permission_id.push(id)
    } else {
        form.permission_id = null;
    }
}

const avatarUrl = computed(() => {
  return props.user.avatar ? `/storage/${props.user.avatar}` : '';
});




const submit = () => {
    form.post(`/users/${props.user.id}`);
};
</script>
<template>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl">Edit User</h1>
                    <Link href="/users"
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
                        <div class="mb-4">
                            <!-- avatar -->
                            <div class="flex items-center">
                                <div class="relative">
                                    <fwb-avatar
                                        size="lg"
                                        v-if="props.user.avatar"
                                        :img="avatarUrl"
                                        alt="asd"
                                        rounded
                                    />
                                    <fwb-avatar
                                        size="lg"
                                        v-if="!props.user.avatar"
                                        img="https://www.svgrepo.com/show/500470/avatar.svg"
                                        alt="ads"
                                        rounded
                                    />
                                    <div
                                        class="absolute inset-0 rounded-full shadow-inner"
                                    ></div>
                                </div>
                                <div class="ml-4">
                                    <h2 class="font-bold text-gray-800 text-lg">
                                        {{ form.name }}
                                    </h2>
                                    <p class="text-gray-600">
                                        {{ form.email }}
                                    </p>
                                </div>
                            </div>
                            <label
                                for="avatar"
                                class="block text-gray-700 text-sm font-bold mb-2"
                            >
                                Avatar
                            </label>
                            <fwb-file-input
                                type="file"
                                accept="image/png, image/gif, image/jpeg"
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
                        <label
                            for="title"
                            class="block text-gray-700 text-sm font-bold mb-2"
                        >
                            Status:</label
                        >
                        <select
                            class="block w-sm text-sm font-medium transition duration-75 border border-gray-800 rounded-lg shadow-sm h-9 focus:border-blue-600 focus:ring-1 focus:ring-inset focus:ring-blue-600 bg-none"
                            v-model="form.user_status_id"
                        >
                            <option
                                v-for="item in status"
                                :value="item.id"
                                :key="item.id"
                            >
                                {{ item.name }}
                            </option>
                        </select>
                        <label
                            for="title"
                            class="block text-gray-700 text-sm font-bold mb-2 mt-2"
                        >
                            Role:</label
                        >
                        <select
                            class="block w-sm text-sm font-medium transition duration-75 border border-gray-800 rounded-lg shadow-sm h-9 focus:border-blue-600 focus:ring-1 focus:ring-inset focus:ring-blue-600 bg-none"
                            v-model="form.role_id"
                        >
                            <option
                                v-for="item in roles"
                                :value="item.id"
                                :key="item.id"
                            >
                                {{ item.name }}
                            </option>
                        </select>
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

<script setup>
import { Link, router, useForm } from "@inertiajs/vue3";
import { computed } from "vue";
import {
    FwbButton,
    FwbInput,
    FwbFileInput,
    FwbAvatar,
    FwbCard,
} from "flowbite-vue";

const props = defineProps({
    user: {
        type: Object,
        default: null,
    },
    status: {
        type: Array,
        default: () => [],
    },
});
const form = useForm({
    name: props.user.name,
    email: props.user.email,
    password: "",
    password_confirmation: "",
    user_status_id: props.user.user_status_id,
    avatar: props.user.avatar ? props.user.avatar : null,
    created: props.user.created_at,
});

const avatarUrl = computed(() => {
    return props.user.avatar
        ? `/storage/${props.user.avatar}`
        : "https://www.svgrepo.com/show/500470/avatar.svg";
});
console.log(props.status);
</script>
<template>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl">Profile User</h1>
                    <Link href="/users"
                        ><fwb-button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3"
                        >
                            Back
                        </fwb-button></Link
                    >
                    <fwb-card
                        img-alt="Avatar"
                        :img-src="avatarUrl"
                        variant="horizontal"
                    >
                        <div class="p-5">
                            <p
                                class="font-normal tracking-tight text-gray-900 dark:text-white"
                            >
                                Name : {{ form.name }}
                            </p>
                            <p
                                class="font-normal text-gray-700 dark:text-gray-400"
                            >
                                Email : {{ form.email }}
                            </p>
                            <p>
                                Status :
                                {{
                                    props.user.user_status_id === 1
                                        ? "active"
                                        : "in-active"
                                }}
                            </p>
                            <p
                                class="font-normal text-gray-700 dark:text-gray-400"
                            >
                                Since :
                                {{ form.created }}
                            </p>
                        </div>
                    </fwb-card>
                </div>
            </div>
        </div>
    </div>
</template>

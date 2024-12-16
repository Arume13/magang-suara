
<script setup>
import { Link, router, useForm } from '@inertiajs/vue3';

const props = defineProps({
  user: {
    type: Object,
    default: null,
  },
});

        const form = useForm({
            name: props.user.name,
            email: props.user.email,
            password: '',
            password_confirmation: '',
        });

        const submit = () => {
            form.put(`/users/${props.user.id}`);
        };
</script>
<template>
    <div>
        <h1 class="text-2xl px-16 ml-8 pt-10">Edit User</h1>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <Link href="/users"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Back</button></Link>
                        
                        <form @submit.prevent="submit">
                            <div class="mb-4">
                                <label 
                                    for="title" 
                                    class="block text-gray-700 text-sm font-bold mb-2">
                                    Name:</label>
                                <input 
                                    type="text" 
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                    placeholder="Enter your name" 
                                    v-model="form.name" />
                            </div>
                            <div class="mb-4">
                                <label 
                                    for="title" 
                                    class="block text-gray-700 text-sm font-bold mb-2">
                                    Email:</label>
                                <input 
                                    type="email" 
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                    placeholder="mail@xxx.xxx" 
                                    v-model="form.email" />
                            </div>
                            <div class="mb-4">
                                <label 
                                    for="title" 
                                    class="block text-gray-700 text-sm font-bold mb-2">
                                    Password:</label>
                                <input 
                                    type="password" 
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                    placeholder="******" 
                                    v-model="form.password" />
                            </div>
                            <div class="mb-4">
                                <label 
                                    for="title" 
                                    class="block text-gray-700 text-sm font-bold mb-2">
                                    Confirm Password:</label>
                                <input 
                                    type="password" 
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                    placeholder="******" 
                                    v-model="form.password_confirmation" />
                            </div>

                           

                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded my-3 text-white">
                                Upadate
                            </button>

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
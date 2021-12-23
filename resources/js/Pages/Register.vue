<script setup>
import { useForm } from "@inertiajs/inertia-vue3";

let form = useForm({
    name: "",
    email: "",
    password: "",
});

let submit = () => {
    form.post("/register");
};
</script>

<template>
    <Head title="Login"></Head>
    <div class="bg-grey-lighter min-h-screen flex flex-col">
        <div
            class="
                container
                max-w-sm
                mx-auto
                flex-1 flex flex-col
                items-center
                justify-center
                px-2
            "
        >
            <form
                @submit.prevent="submit"
                class="bg-white px-6 py-8 rounded shadow-md text-black w-full"
            >
                <h1 class="mb-8 text-3xl text-center">Sign up</h1>
                <input
                    v-model="form.name"
                    type="text"
                    class="
                        block
                        border border-grey-light
                        w-full
                        p-3
                        rounded
                        mb-4
                    "
                    name="fullname"
                    placeholder="Full Name"
                />
                <div
                    v-if="form.errors.name"
                    v-text="form.errors.name"
                    class="text-red-500"
                ></div>

                <input
                    v-model="form.email"
                    type="text"
                    class="
                        block
                        border border-grey-light
                        w-full
                        p-3
                        rounded
                        mb-4
                    "
                    name="email"
                    placeholder="Email"
                />
                <div
                    v-if="form.errors.email"
                    v-text="form.errors.email"
                    class="text-red-500"
                ></div>

                <input
                    v-model="form.password"
                    type="password"
                    class="
                        block
                        border border-grey-light
                        w-full
                        p-3
                        rounded
                        mb-4
                    "
                    name="password"
                    placeholder="Password"
                />
                <div
                    v-if="form.errors.password"
                    v-text="form.errors.password"
                    class="text-red-500"
                ></div>

                <button
                    type="submit"
                    class="
                        w-full
                        text-center
                        py-3
                        rounded
                        bg-green-500
                        text-white-500
                        hover:bg-green-dark
                        focus:outline-none
                        my-1
                    "
                    :disabled="form.processing"
                >
                    Create Account
                </button>
            </form>

            <div class="text-grey-dark mt-6">
                Already have an account?
                <Link
                    class="no-underline border-b border-blue text-blue"
                    href="/login"
                >
                    Log in </Link
                >.
            </div>
        </div>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/inertia-vue3";

let form = useForm({
    email: "",
    password: "",
});

let submit = () => {
    form.post("/login");
};
</script>

<template>
    <Head title="Login"></Head>

    <div
        v-if="$page.props.errors[0]"
        class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4"
        role="alert"
    >
        <p class="font-bold">Failure!</p>
        <p>{{ $page.props.errors[0] }}</p>
    </div>

    <div
        v-if="$page.props.flash.out"
        class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4"
        role="alert"
    >
        <p class="font-bold">Logged out!</p>
        <p>See you again!</p>
    </div>

    <div class="flex items-center">
        <div class="fixed pin bg-black-500 opacity-75 z-10"></div>

        <div class="relative mx-6 md:mx-auto w-full z-20 m-8">
            <div class="shadow-lg bg-white-500 rounded-lg p-8">
                <div class="flex justify-end mb-6">
                    <Link type="button" href="/">
                        <span class="mr-2">Close</span>
                        <span>
                            <i class="fa fa-times"></i>
                        </span>
                    </Link>
                </div>

                <h1 class="text-center text-2xl text-green-500">Login</h1>

                <form @submit.prevent="submit" class="pt-6 pb-2 my-2">
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2" for="email">
                            Email Address
                        </label>
                        <input
                            v-model="form.email"
                            class="
                                shadow
                                appearance-none
                                border
                                rounded
                                w-full
                                py-2
                                px-3
                                text-grey-darker
                            "
                            id="email"
                            type="text"
                            placeholder="Email Address"
                        />
                        <div
                            v-if="form.errors.email"
                            v-text="form.errors.email"
                            class="text-red-500"
                        ></div>
                    </div>
                    <div class="mb-6">
                        <label
                            class="block text-sm font-bold mb-2"
                            for="password"
                        >
                            Password
                        </label>
                        <input
                            v-model="form.password"
                            class="
                                shadow
                                appearance-none
                                border
                                rounded
                                w-full
                                py-2
                                px-3
                                text-grey-700
                                mb-3
                            "
                            id="password"
                            type="password"
                            placeholder="Password"
                        />
                        <div
                            v-if="form.errors.password"
                            v-text="form.errors.password"
                            class="text-red-500"
                        ></div>
                    </div>
                    <div class="block md:flex items-center justify-between">
                        <div>
                            <button
                                type="submit"
                                class="
                                    bg-green-500
                                    hover:bg-green-dark-500
                                    text-white-500
                                    font-bold
                                    py-2
                                    px-4
                                    rounded
                                    border-b-4 border-green-900
                                "
                            >
                                Sign In
                            </button>
                        </div>
                    </div>
                    <div class="block md:flex items-center justify-between">
                        <div>
                            <Link
                                type="button"
                                href="/register"
                                class="
                                    bg-green-500
                                    hover:bg-green-dark-500
                                    text-white-500
                                    font-bold
                                    py-2
                                    px-4
                                    rounded
                                    border-b-4 border-green-900
                                "
                            >
                                Or Register?
                            </Link>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

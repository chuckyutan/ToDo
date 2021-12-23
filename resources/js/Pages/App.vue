<script setup>
import Layout from "../Shared/Layout.vue";
import { ref, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";
import throttle from "lodash/throttle";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import { ChevronDownIcon } from "@heroicons/vue/solid";

let props = defineProps({
    tasks: Object,
    filters: Object,
    user: Object,
    status: Array,
});

let search = ref(props.filters.search);
watch(
    search,
    throttle(function (value) {
        Inertia.get(
            "/",
            { search: value },
            {
                preserveState: true,
                replace: true,
            }
        );
    }, 500)
);

let form = useForm({
    name: "",
});
let submit = () => {
    form.post("/create");
};
</script>

<template>
    <Head title="Home" />

    <Layout />

    <div
        v-if="$page.props.flash.message"
        class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4"
        role="alert"
    >
        <p class="font-bold">Success!</p>
        <p>{{ $page.props.flash.message }}</p>
    </div>

    <div
        v-if="$page.props.flash.edited"
        class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4"
        role="alert"
    >
        <p class="font-bold">Success!</p>
        <p>{{ $page.props.flash.edited }}</p>
    </div>

    <div
        v-if="$page.props.flash.success"
        class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4"
        role="alert"
    >
        <p class="font-bold">Success!</p>
        <p>{{ $page.props.flash.success }}</p>
    </div>

    <div
        v-if="$page.props.flash.deleted"
        class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4"
        role="alert"
    >
        <p class="font-bold">Success!</p>
        <p>{{ $page.props.flash.deleted }}</p>
    </div>

    <div class="pt-2 relative mx-auto text-gray-600">
        <input
            v-model="search"
            type="text"
            placeholder="Search..."
            class="
                border-2 border-gray-300
                bg-white
                h-10
                px-5
                pr-16
                rounded-lg
                text-sm
                focus:outline-none
            "
        />
    </div>

    <div
        class="
            h-100
            w-full
            flex
            items-center
            justify-center
            bg-teal-lightest
            font-sans
        "
    >
        <div
            class="
                bg-white-500
                rounded
                shadow
                p-6
                m-4
                w-full
                lg:w-3/4 lg:max-w-lg
            "
        >
            <div class="mb-4">
                <h1 class="text-grey-darkest">Todo List</h1>
                <form @submit.prevent="submit" class="flex mt-4">
                    <input
                        v-model="form.name"
                        class="
                            shadow
                            appearance-none
                            border
                            rounded
                            w-full
                            py-2
                            px-3
                            mr-4
                            text-grey-darker
                        "
                        placeholder="Add Todo"
                    />
                    <div
                        v-if="form.errors.name"
                        v-text="form.errors.name"
                        class="text-red-500"
                    ></div>
                    <button
                        type="submit"
                        class="
                            flex-no-shrink
                            p-2
                            border-2
                            rounded
                            text-teal
                            border-teal
                            hover:text-white hover:bg-teal
                        "
                    >
                        Add
                    </button>
                </form>
            </div>
            <div>
                <div
                    class="flex mb-4 items-center"
                    v-for="task in tasks.data"
                    :key="task.id"
                >
                    <p
                        class="w-full"
                        :class="{
                            'line-through': task.status == 3,
                            'text-gray-500': task.status == 3,
                            'text-green-500': task.status == 2,
                        }"
                    >
                        {{ task.name }}
                    </p>
                    <Menu as="div" class="relative inline-block text-left">
                        <div>
                            <MenuButton
                                class="
                                    inline-flex
                                    justify-center
                                    w-full
                                    rounded-md
                                    border border-gray-300
                                    shadow-sm
                                    px-4
                                    py-2
                                    bg-white
                                    text-sm
                                    font-medium
                                    text-gray-700
                                    hover:bg-gray-50
                                    focus:outline-none
                                    focus:ring-2
                                    focus:ring-offset-2
                                    focus:ring-offset-gray-100
                                    focus:ring-indigo-500
                                "
                                :class="{
                                    'text-red-500': task.status == 1,
                                    'border-red-500': task.status == 1,
                                    'text-green-500': task.status == 2,
                                    'border-green-500': task.status == 2,
                                    'text-black-500': task.status == 3,
                                    'border-black-500': task.status == 3,
                                }"
                            >
                                {{ status[task.status - 1] }}
                                <ChevronDownIcon
                                    class="-mr-1 ml-2 h-5 w-5"
                                    aria-hidden="true"
                                />
                            </MenuButton>
                        </div>

                        <transition
                            enter-active-class="transition ease-out duration-100"
                            enter-from-class="transform opacity-0 scale-95"
                            enter-to-class="transform opacity-100 scale-100"
                            leave-active-class="transition ease-in duration-75"
                            leave-from-class="transform opacity-100 scale-100"
                            leave-to-class="transform opacity-0 scale-95"
                        >
                            <MenuItems
                                class="
                                    origin-top-right
                                    absolute
                                    right-0
                                    mt-2
                                    w-56
                                    rounded-md
                                    shadow-lg
                                    bg-white
                                    ring-1 ring-black ring-opacity-5
                                    focus:outline-none
                                "
                            >
                                <div class="py-1">
                                    <MenuItem>
                                        <Link
                                            :href="`/task/${task.id}/1/update`"
                                            :class="[
                                                active
                                                    ? 'bg-gray-100 text-gray-900'
                                                    : 'text-gray-700',
                                                'block px-4 py-2 text-sm',
                                            ]"
                                            >{{ status[0] }}</Link
                                        >
                                    </MenuItem>
                                    <MenuItem>
                                        <Link
                                            :href="`/task/${task.id}/2/update`"
                                            :class="[
                                                active
                                                    ? 'bg-gray-100 text-gray-900'
                                                    : 'text-gray-700',
                                                'block px-4 py-2 text-sm',
                                            ]"
                                            >{{ status[1] }}</Link
                                        >
                                    </MenuItem>
                                    <MenuItem>
                                        <Link
                                            :href="`/task/${task.id}/3/update`"
                                            :class="[
                                                active
                                                    ? 'bg-gray-100 text-gray-900'
                                                    : 'text-gray-700',
                                                'block px-4 py-2 text-sm',
                                            ]"
                                            >{{ status[2] }}</Link
                                        >
                                    </MenuItem>
                                </div>
                            </MenuItems>
                        </transition>
                    </Menu>
                    <Link
                        :href="`/task/${task.id}/delete`"
                        type="button"
                        class="
                            flex-no-shrink
                            p-2
                            ml-2
                            border-2
                            rounded
                            text-red-500
                            border-red-500
                            hover:text-white-500 hover:bg-red-500
                        "
                        >Remove</Link
                    >
                </div>
            </div>
        </div>
    </div>
    <div class="mt-6">
        <Component
            :is="link.url ? 'Link' : 'span'"
            v-for="link in tasks.links"
            :href="link.url"
            v-html="link.label"
            class="px-1"
            :class="{
                'text-red-500': !link.url,
                'font-bold': link.active,
            }"
            :key="link.id"
        />
    </div>
</template>

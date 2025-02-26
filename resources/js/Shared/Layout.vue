<template>
    <Popover class="relative bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div
                class="
                    flex
                    justify-between
                    items-center
                    border-b-2 border-gray-100
                    py-6
                    md:justify-start md:space-x-10
                "
            >
                <div class="flex justify-start lg:w-0 lg:flex-1">
                    <a href="#">
                        <span class="sr-only">Workflow</span>
                        <img
                            class="h-8 w-auto sm:h-10"
                            src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
                            alt=""
                        />
                    </a>
                </div>
                <div class="-mr-2 -my-2 md:hidden">
                    <PopoverButton
                        class="
                            bg-white
                            rounded-md
                            p-2
                            inline-flex
                            items-center
                            justify-center
                            text-gray-400
                            hover:text-gray-500 hover:bg-gray-100
                            focus:outline-none
                            focus:ring-2
                            focus:ring-inset
                            focus:ring-indigo-500
                        "
                    >
                        <span class="sr-only">Open menu</span>
                        <MenuIcon class="h-6 w-6" aria-hidden="true" />
                    </PopoverButton>
                </div>

                <div
                    class="
                        hidden
                        md:flex
                        items-center
                        justify-end
                        md:flex-1
                        lg:w-0
                    "
                >
                    <Link
                        href="/login"
                        class="
                            whitespace-nowrap
                            text-base
                            font-medium
                            text-gray-500
                            hover:text-gray-900
                        "
                    >
                        Sign in
                    </Link>
                    <Link
                        href="/logout"
                        method="post"
                        class="
                            whitespace-nowrap
                            text-base
                            font-medium
                            text-gray-500
                            hover:text-gray-900
                            mx-5
                        "
                    >
                        Log Out
                    </Link>
                    <Link
                        href="/register"
                        class="
                            ml-8
                            whitespace-nowrap
                            inline-flex
                            items-center
                            justify-center
                            px-4
                            py-2
                            border border-transparent
                            rounded-md
                            shadow-sm
                            text-base
                            font-medium
                            text-white
                            bg-indigo-600
                            hover:bg-indigo-700
                        "
                    >
                        Sign up
                    </Link>
                </div>
            </div>
        </div>

        <transition
            enter-active-class="duration-200 ease-out"
            enter-from-class="opacity-0 scale-95"
            enter-to-class="opacity-100 scale-100"
            leave-active-class="duration-100 ease-in"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-95"
        >
            <PopoverPanel
                focus
                class="
                    absolute
                    top-0
                    inset-x-0
                    p-2
                    transition
                    transform
                    origin-top-right
                    md:hidden
                "
            >
                <div
                    class="
                        rounded-lg
                        shadow-lg
                        ring-1 ring-black ring-opacity-5
                        bg-white
                        divide-y-2 divide-gray-50
                    "
                >
                    <div class="pt-5 pb-6 px-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <img
                                    class="h-8 w-auto"
                                    src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
                                    alt="Workflow"
                                />
                            </div>
                            <div class="-mr-2">
                                <PopoverButton
                                    class="
                                        bg-white
                                        rounded-md
                                        p-2
                                        inline-flex
                                        items-center
                                        justify-center
                                        text-gray-400
                                        hover:text-gray-500 hover:bg-gray-100
                                        focus:outline-none
                                        focus:ring-2
                                        focus:ring-inset
                                        focus:ring-indigo-500
                                    "
                                >
                                    <span class="sr-only">Close menu</span>
                                    <XIcon class="h-6 w-6" aria-hidden="true" />
                                </PopoverButton>
                            </div>
                        </div>
                        <div class="mt-6">
                            <nav class="grid gap-y-8">
                                <a
                                    v-for="item in solutions"
                                    :key="item.name"
                                    :href="item.href"
                                    class="
                                        -m-3
                                        p-3
                                        flex
                                        items-center
                                        rounded-md
                                        hover:bg-gray-50
                                    "
                                >
                                    <component
                                        :is="item.icon"
                                        class="
                                            flex-shrink-0
                                            h-6
                                            w-6
                                            text-indigo-600
                                        "
                                        aria-hidden="true"
                                    />
                                    <span
                                        class="
                                            ml-3
                                            text-base
                                            font-medium
                                            text-gray-900
                                        "
                                    >
                                        {{ item.name }}
                                    </span>
                                </a>
                            </nav>
                        </div>
                    </div>
                    <div class="py-6 px-5 space-y-6">
                        <div class="grid grid-cols-2 gap-y-4 gap-x-8">
                            <a
                                href="#"
                                class="
                                    text-base
                                    font-medium
                                    text-gray-900
                                    hover:text-gray-700
                                "
                            >
                                Pricing
                            </a>

                            <a
                                href="#"
                                class="
                                    text-base
                                    font-medium
                                    text-gray-900
                                    hover:text-gray-700
                                "
                            >
                                Docs
                            </a>
                            <a
                                v-for="item in resources"
                                :key="item.name"
                                :href="item.href"
                                class="
                                    text-base
                                    font-medium
                                    text-gray-900
                                    hover:text-gray-700
                                "
                            >
                                {{ item.name }}
                            </a>
                        </div>
                        <div>
                            <a
                                href="#"
                                class="
                                    w-full
                                    flex
                                    items-center
                                    justify-center
                                    px-4
                                    py-2
                                    border border-transparent
                                    rounded-md
                                    shadow-sm
                                    text-base
                                    font-medium
                                    text-white
                                    bg-indigo-600
                                    hover:bg-indigo-700
                                "
                            >
                                Sign up
                            </a>
                            <p
                                class="
                                    mt-6
                                    text-center text-base
                                    font-medium
                                    text-gray-500
                                "
                            >
                                Existing customer?
                                {{ " " }}
                                <a
                                    href="#"
                                    class="
                                        text-indigo-600
                                        hover:text-indigo-500
                                    "
                                >
                                    Sign in
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </PopoverPanel>
        </transition>
    </Popover>
</template>

<script>
import {
    Popover,
    PopoverButton,
    PopoverGroup,
    PopoverPanel,
} from "@headlessui/vue";
import {
    BookmarkAltIcon,
    CalendarIcon,
    ChartBarIcon,
    CursorClickIcon,
    MenuIcon,
    PhoneIcon,
    PlayIcon,
    RefreshIcon,
    ShieldCheckIcon,
    SupportIcon,
    ViewGridIcon,
    XIcon,
} from "@heroicons/vue/outline";
import { ChevronDownIcon } from "@heroicons/vue/solid";

const solutions = [
    {
        name: "Analytics",
        description:
            "Get a better understanding of where your traffic is coming from.",
        href: "#",
        icon: ChartBarIcon,
    },
    {
        name: "Engagement",
        description:
            "Speak directly to your customers in a more meaningful way.",
        href: "#",
        icon: CursorClickIcon,
    },
    {
        name: "Security",
        description: "Your customers' data will be safe and secure.",
        href: "#",
        icon: ShieldCheckIcon,
    },
    {
        name: "Integrations",
        description:
            "Connect with third-party tools that you're already using.",
        href: "#",
        icon: ViewGridIcon,
    },
    {
        name: "Automations",
        description:
            "Build strategic funnels that will drive your customers to convert",
        href: "#",
        icon: RefreshIcon,
    },
];
const callsToAction = [
    { name: "Watch Demo", href: "#", icon: PlayIcon },
    { name: "Contact Sales", href: "#", icon: PhoneIcon },
];
const resources = [
    {
        name: "Help Center",
        description:
            "Get all of your questions answered in our forums or contact support.",
        href: "#",
        icon: SupportIcon,
    },
    {
        name: "Guides",
        description:
            "Learn how to maximize our platform to get the most out of it.",
        href: "#",
        icon: BookmarkAltIcon,
    },
    {
        name: "Events",
        description:
            "See what meet-ups and other events we might be planning near you.",
        href: "#",
        icon: CalendarIcon,
    },
    {
        name: "Security",
        description: "Understand how we take your privacy seriously.",
        href: "#",
        icon: ShieldCheckIcon,
    },
];
const recentPosts = [
    { id: 1, name: "Boost your conversion rate", href: "#" },
    {
        id: 2,
        name: "How to use search engine optimization to drive traffic to your site",
        href: "#",
    },
    { id: 3, name: "Improve your customer experience", href: "#" },
];

export default {
    components: {
        Popover,
        PopoverButton,
        PopoverGroup,
        PopoverPanel,
        ChevronDownIcon,
        MenuIcon,
        XIcon,
    },
    setup() {
        return {
            solutions,
            callsToAction,
            resources,
            recentPosts,
        };
    },
};
</script>

<template>
    <header class="top-0 z-40 flex-none w-full mx-auto bg-white border-b border-gray-300">
    <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded">
        <div class="container flex flex-wrap justify-between items-center mx-auto">
            <Link :href="route('accounts.index')" class="flex items-center">
                <img src="/img/emblem.png" class="mr-3 h-6 sm:h-9" alt="Inshin.org Logo" />
            <div class="self-center text-xl font-semibold whitespace-nowrap">Inshin.org</div>
            <div class="ml-10 pt-0.5 italic text-sm align-middle text-gray-400">per aspera ad astra</div>
            </Link>
            <button @click="isOpen = !isOpen" data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
            </button>
            <div :class="isOpen ? 'block' : 'hidden'" class="w-full md:block md:w-auto" id="navbar-default">
                <ul class="flex flex-col p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white">
                    <li>
                        <Link @click="isOpen = !isOpen" :href="route('accounts.index')" class="block py-2 font-semibold pr-4 pl-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0" aria-current="page">Счета</Link>
                    </li>
                    <li>
                        <Link @click="isOpen = !isOpen" :href="route('currencies.index')" class="block py-2 font-semibold pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Курсы валют</Link>
                    </li>
                    <li>
                        <Link @click="isOpen = !isOpen" :href="route('about')" class="block py-2 font-semibold pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">О сайте</Link>
                    </li>
                    <li v-if="can">
                        <a :href="route('admin.accounts.index')" class="block py-2 font-semibold pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Админпанель</a>
                    </li>
                    <li v-if="can">
                        <Link @click="isOpen = !isOpen" :href="route('logout')" class="block py-2 font-semibold pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Выход</Link>
                    </li>
                    <li v-if="!can">
                        <Link @click="isOpen = !isOpen" :href="route('login')" class="block py-2 font-semibold pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Вход</Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    </header>
    <div class="flex">
        <div class="mx-auto">
        <slot />
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";
export default {
    name: "MainLayout",
    data () {
        return {
            isOpen : null
        }
    },
    props: [
        'can'
    ],
    components: {
        Link
    },

}
</script>

<style scoped>

</style>

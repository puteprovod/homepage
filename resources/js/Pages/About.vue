<template>
    <Head>
        <title>{{ localize('About') }}</title>
    </Head>

    <div class="p-10 md:px-14 mt-6 md:mt-10 pb-20 max-w-screen-lg border bg-white shadow-lg md:rounded-xl">
    <div>
        frontend: Vue.JS (Inertia) + TailwindCSS
        </div>
    <div class="mt-3">
        backend: Laravel + PHP (& some Python) + Redis + MySQL
    </div>
    <div class="mt-3">
        VPS set: Ubuntu + Nginx + SSL + Docker
    </div>
    <div class="mt-20">
        {{ localize('SiteWasMade') }}
    </div>
    <div>
        {{ localize('WhoAmI') }}
    </div>
    </div>
</template>

<script>
import {Head, Link} from "@inertiajs/inertia-vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import localizeFilter from "@/Filters/localize";
const a = [0, 1, 2];
a[100] = 100;
console.log(a.length);
console.log(a);
export default {
    name: "index",
    layout: MainLayout,
    components: {
        Link, Head
    },
    methods: {
        localize(key) {
            return localizeFilter(key, window.lang || 'ru-RU')
        },
    }
}
</script>

<style scoped>

</style>

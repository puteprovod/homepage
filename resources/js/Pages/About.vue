<template>
    <Head>
        <title>{{ localize('About') }}</title>
    </Head>
    <div class="mt-5">
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
</template>

<script>
import {Head, Link} from "@inertiajs/inertia-vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import localizeFilter from "@/Filters/localize";

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

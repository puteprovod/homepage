<template>
            <h1 class="text-lg mb-8">Posts</h1>
            <div class="mb-8">
                Blablabla
            </div>

</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    name: "index",
    layout: MainLayout,
    props: [
        'accounts',
    ],
    components: {
        Link
    }
}
</script>

<style scoped>

</style>

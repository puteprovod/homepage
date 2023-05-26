<template>
    <Head>
        <title>Resizer</title>
    </Head>

    <div class="px-0 p-14 pt-10 md:pt-14 md:px-14 mt-6 md:mt-10 max-w-screen-lg border bg-white shadow-lg md:rounded-xl">
    <div class="text-center font-bold">
        {{ localize('QuickImageResizing') }} (resizer)
    </div>
    <div ref="errorBox" class="hidden mt-4 text-center">
        <p class="bg-red-100 border-red-200 text-sm">{{ localize('ErrorNoImage') }}</p>
    </div>
    <div class="hidden" ref="progressBox">
        <div class="text-center">
            <img src="/img/spinner.gif" class="mx-auto" alt="processing images...">
        </div>
        <div class="mx-auto text-center">
            {{ localize('ProcessingImages') }}
        </div>
    </div>
    <div class="mt-3" ref="inputFormBox">
        <div class="inline-block p-4">
            <div ref="dropzone"
                 class="border-dashed bg-blue-100 cursor-pointer border-2 rounded-xl border-gray-400 p-10 w-80 align-middle text-center">
                <div class="dz-message">
                <div class="mb-4">
                    {{ localize('DragFilesHereOr') }} <b>{{ localize('Click') }}</b> {{ localize('ToUpload') }}
                </div>
                <div class="text-gray-500 mb-5 dz-message">
                    (jpg, png, gif... )
                </div>
                <div class="text-gray-500 mb-5 dz-message">
                    {{ localize('Maximum') }}: 300 {{ localize('ImagesCount') }}, {{ localize('TotalImageSize') }} - {{ localize('NoMore') }} 300 Mb
                </div>
                    </div>
                <div v-if="viewErrors.images" class="text-red-700">{{ localize('FilesNotUploaded') }}</div>
            </div>
        </div>
        <div class="inline-block p-6 align-top">
            <form @submit.prevent="store">
                <div class="mb-5">
                    <div class="inline-block text-sm tracking-tighter w-40">
                        {{ localize('TargetWidth') }} (px):
                    </div>
                    <div class="inline-block">
                        <input v-model="targetWidth" class="rounded-full w-28 border-gray-400" type="number">
                    </div>
                    <div class="inline-block ml-2">
                        <a @click="keepWidth = !keepWidth" class="btn cursor-pointer text-lg"
                           :class="keepWidth ? '' : 'text-gray-100 opacity-20'"
                           title="{{ localize('FixWidth') }}">🔒</a>
                    </div>
                    <div v-if="viewErrors.targetWidth" class="text-red-700">{{ localize('FieldNotFilled') }} </div>
                </div>
                <div class="mb-5">
                    <div class="inline-block text-sm tracking-tight w-40">
                        {{ localize('TargetHeight') }} (px):
                    </div>
                    <div class="inline-block">
                        <input v-model="targetHeight" class="rounded-full w-28 border-gray-400" type="number">
                    </div>
                    <div class="inline-block ml-2">
                        <a @click="keepHeight = !keepHeight" class="btn cursor-pointer text-lg"
                           :class="keepHeight ? '' : 'text-gray-100 opacity-20'"
                           title="{{ localize('FixHeight') }}">🔒</a>
                    </div>
                    <div v-if="viewErrors.targetHeight" class="text-red-700">{{ localize('FieldNotFilled') }}</div>
                </div>
                <div class="mb-5">
                    <div class="text-center mb-4">
                        <input v-model="keepAspectRatio" type="checkbox" value=""
                               class="w-4 h-4 text-blue-600 bg-gray-200 rounded border-gray-400 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label @click="keepAspectRatio=!keepAspectRatio" for="default-checkbox" class="cursor-pointer ml-2 text-sm font-medium text-sm text-gray-900">{{ localize('KeepAspectRatio') }}</label>
                    </div>
                </div>
                <div class="mb-5">
                    <button
                        class="mx-auto block p-1 w-64 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 border rounded-full text-center text-white"
                        type="submit">{{ localize('ProcessImages') }}
                    </button>
                </div>
            </form>

        </div>
    </div>
    </div>
</template>

<script>


import {Head, Link} from "@inertiajs/inertia-vue3";
import Dropzone from 'dropzone'
import MainLayout from "@/Layouts/MainLayout.vue";
import localizeFilter from "@/Filters/localize";


export default {
    name: "index",
    layout: MainLayout,
    props: [
        'token'
    ],
    data() {
        return {
            dropzone: null,
            targetHeight: null,
            targetWidth: null,
            keepAspectRatio: true,
            keepHeight: false,
            keepWidth: false,
            viewErrors: {
                images: null,
                targetHeight: null,
                targetWidth: null
            }
        }
    },
    mounted() {
        this.dropzone = new Dropzone(this.$refs.dropzone,
            {
                url: "/api/resizer",
                clickable: true,
                autoProcessQueue: false,
                acceptedFiles: 'image/*',
                maxFiles: 300,
                maxFilesize: 300,
                createImageThumbnails: false,
                // thumbnailMethod: 'contain',
                // thumbnailWidth: 250,
                // thumbnailHeight: 250,
                previewTemplate: '<div class="dz-preview dz-file-preview">\n' +
                    '<div class="dz-details">\n' +
                    '<div class="dz-filename text-sm"><span data-dz-name></span></div>\n' +
                    '<div class="dz-size text-sm" data-dz-size></div>\n' +
                    '</div>\n' +
                    '<div class="dz-progress mb-4"><span class="dz-upload" data-dz-uploadprogress></span></div>\n' +
                    '</div>'
            })
    },
    components: {
        Link, Head
    },
    methods: {
        localize(key) {
            return localizeFilter(key, window.lang || 'ru-RU')
        },
        store() {
            this.$refs.progressBox.classList.remove('hidden');
            this.$refs.inputFormBox.classList.add('hidden');
            const data = new FormData()
            const files = this.dropzone.getAcceptedFiles()
            files.forEach(file => {
                data.append('images[]', file)
                this.dropzone.removeFile(file);
            })
            data.append('targetHeight', this.targetHeight)
            data.append('targetWidth', this.targetWidth)
            data.append('keepHeight', this.keepHeight)
            data.append('keepWidth', this.keepWidth)
            data.append('keepAspectRatio', this.keepAspectRatio)
            axios.post('/api/resizer', data).then(res => {
                //this.$inertia.visit('/resizer/' + res.data.token)
                this.$inertia.visit('/resizer/'+res.data.token, {
                    method: 'get',
                    data: {
                        timeTaken: res.data.timeTaken,
                        timeTakenPy: res.data.timeTakenPy
                    },
                })
            }) .catch(error => {
                this.viewErrors=error.response.data.errors
                this.$refs.progressBox.classList.add('hidden');
                this.$refs.inputFormBox.classList.remove('hidden');
            });


        },
    }

}
</script>

<style scoped>

</style>

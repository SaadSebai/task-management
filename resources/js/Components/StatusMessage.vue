<script setup>
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage()

const show = ref(page.props.flash?.success || page.props.flash?.error)

function hide() {
    show.value = false;
}
</script>

<template>
    <div
        v-if='show'
        role="alert"
        class="border px-4 py-3 rounded flex justify-between"
        :class="{
            'bg-red-100 border-red-400 text-red-700 dark:bg-red-900 dark:text-red-200 dark:border-red-600': page.props.flash?.error,
            'bg-green-100 border-green-400 text-green-700 dark:bg-green-900 dark:text-green-200 dark:border-green-600': page.props.flash?.success
        }"
    >
        <div>
            <strong class="font-bold">Success! </strong>
            <span class="block sm:inline">{{ page.props.flash?.success }}</span>
        </div>
        <div>
            <button @click="hide()">
                <i class="fa-solid fa-x"></i>
            </button>
        </div>

    </div>
</template>

<script setup>

import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ProjectList from "@/Components/Project/ProjectList.vue";
import Pagination from "@/Components/Lists/Pagination.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    'projects': Object
});
</script>

<template>
    <Head title="Projects" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Projects
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <Link :href="route('projects.create')" class="mb-3 inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">
                    Create project
                </Link>

                <div class="relative overflow-visible">
                    <ProjectList :projects="projects.data" />
                </div>

                <Pagination class="mt-3" :pagination="projects" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import ProjectItem from "@/Components/Project/ProjectItem.vue";

const props = defineProps({
    'projects': Array
});
</script>

<template>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                Name
            </th>
            <th scope="col" class="px-6 py-3">
                Created At
            </th>
            <th scope="col" class="px-6 py-3">
                Number of tasks
            </th>
            <th scope="col" class="px-1 py-3">
                Actions
            </th>
        </tr>
        </thead>
        <tbody>
            <ProjectItem v-for="project in projects" :project='project' :key="project.id" />
        </tbody>
    </table>
</template>

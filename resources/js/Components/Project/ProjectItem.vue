<script setup>
import dayjs from "dayjs";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    'project': Object
});

const deleteProject = () => {
    useForm({}).delete(route('projects.destroy', {project: props.project.id}));
};
</script>

<template>
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ project.name }}
        </th>
        <td class="px-6 py-4">
            {{ dayjs(project.created_at).format("DD/MM/YYYY HH:mm") }}
        </td>
        <td class="px-6 py-4">
            {{ project.tasks_count }}
        </td>
        <td class="px-1 py-4">
            <Dropdown>
                <template #trigger>
                    <button class="px-3 py-1 rounded-full hover:bg-gray-300 hover:dark:bg-gray-500">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </button>
                </template>

                <template #content>
                    <DropdownLink
                        :href="route('projects.tasks.index', { project: project.id })"
                    >
                        Tasks
                    </DropdownLink>
                    <DropdownLink
                        :href="route('projects.edit', { project: project.id })"
                    >
                        Edit
                    </DropdownLink>
                    <DropdownLink
                        class="bg-red-500"
                        href="#"
                        @click="deleteProject"
                    >
                        Delete
                    </DropdownLink>
                </template>
            </Dropdown>
        </td>
    </tr>
</template>

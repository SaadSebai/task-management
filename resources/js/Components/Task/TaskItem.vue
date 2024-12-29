<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import dayjs from "dayjs";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    'project': Object,
    'task': Object
})

const emit = defineEmits(['task-deleted']);

const deleteTask = () => {
    useForm({}).delete(route('projects.tasks.destroy', {project: props.project.id, task: props.task.id}), {
        onSuccess: (response) => emit('task-deleted', response.props.tasks)
    });
};
</script>

<template>
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ task.name }}
        </th>
        <td class="px-6 py-4">
            {{ task.priority }}
        </td>
        <td class="px-6 py-4">
            {{ dayjs(task.created_at).format("DD/MM/YYYY HH:mm") }}
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
                        :href="route('projects.tasks.edit', { project: project.id, task: task.id })"
                    >
                        Edit
                    </DropdownLink>
                    <DropdownLink
                        class="bg-red-500"
                        href="#"
                        @click="deleteTask"
                    >
                        Delete
                    </DropdownLink>
                </template>
            </Dropdown>
        </td>
    </tr>
</template>

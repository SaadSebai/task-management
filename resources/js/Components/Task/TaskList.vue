<script setup>
import TaskItem from "@/Components/Task/TaskItem.vue";
import draggable from "vuedraggable";
import { ref } from "vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    'project': Object,
    'tasks': Array
})
const reorderedTasks = ref([...props.tasks]);

const updateOrder = (event) => {
    const movedTaskIndex = event.newIndex;
    const movedTask = reorderedTasks.value[movedTaskIndex];

    useForm({ priority: movedTaskIndex + 1 })
        .put(route('projects.tasks.update', {project: props.project.id, task: movedTask.id}), {
            onSuccess: (response) => reorderedTasks.value = response.props.tasks,
            preserveScroll: true
        });
}

const removeTask = (tasks) => {
    reorderedTasks.value = tasks
};
</script>

<template>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                Name
            </th>
            <th scope="col" class="px-6 py-3">
                Priority
            </th>
            <th scope="col" class="px-6 py-3">
                Created At
            </th>
            <th scope="col" class="px-1 py-3">
                Actions
            </th>
        </tr>
        </thead>
        <draggable
            v-model="reorderedTasks"
            @end="updateOrder"
            item-key="id"
            class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
            tag="tbody"
        >
            <template #item="{ element }">
                <TaskItem :project="project" :task='element' :key="element.id" @task-deleted="removeTask" />
            </template>
        </draggable>
    </table>
</template>

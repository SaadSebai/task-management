<script setup>

import TextInput from "@/Components/TextInput.vue";
import {Head, useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DefaultForm from "@/Components/DefaultForm.vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    project: Object,
    task: Object
})

const form = useForm({
    name: props.task.name,
});
</script>

<template>
    <Head title="Tasks" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Tasks
            </h2>
        </template>

        <DefaultForm>
            <template #form-header>
                Update Task
            </template>

            <form
                @submit.prevent="form.put(route('projects.tasks.update', {project: project.id, task: task.id}))"
                class="mt-6 space-y-6"
            >
                <div>
                    <InputLabel for="name" value="Name" />

                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="flex items-center gap-4">
                    <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
                </div>
            </form>
        </DefaultForm>
    </AuthenticatedLayout>
</template>

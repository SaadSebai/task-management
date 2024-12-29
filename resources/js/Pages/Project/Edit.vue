<script setup>

import {Head, Link, useForm} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import DefaultForm from "@/Components/DefaultForm.vue";

const props = defineProps({
    project: Object
})

const form = useForm({
    name: props.project.name,
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

        <DefaultForm>
            <template #form-header>
                Edit Project
            </template>

            <form
                @submit.prevent="form.put(route('projects.update', { project: project.id }))"
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

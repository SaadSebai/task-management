<script setup>
</script>

<template>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div
                class="bg-white p-4 shadow sm:rounded-lg sm:p-8 dark:bg-gray-800"
            >
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        <slot name="form-header" />
                    </h2>
                </header>

                <slot />
            </div>
        </div>
    </div>
</template>

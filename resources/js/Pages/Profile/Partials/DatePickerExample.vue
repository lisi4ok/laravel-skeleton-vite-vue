<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { useDark } from '@vueuse/core';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';

const isDark = useDark({
    selector: 'html',
    // onChanged(dark: boolean) {
    //     console.log(dark);
    // },
});

const date = ref(new Date());
const dateTime = ref(new Date());

const form = useForm({
    date: date,
    datetime: dateTime,
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">DatePicker Example</h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                DatePicker Example Form
            </p>
        </header>

        <form @submit.prevent="event" class="mt-6 space-y-6">
            <div>
                <InputLabel for="date" value="Date" />

                <VueDatePicker
                    id="date"
                    class="mt-1 block w-full dark:dp__theme_dark"
                    v-model="date"
                    autocomplete="date"
                    :dark="isDark"
                    :enable-time-picker="false"
                />

                <InputError class="mt-2" :message="form.errors.date"/>
            </div>

            <div>
                <InputLabel for="datetime" value="DateTime" />

                <VueDatePicker
                    id="datetime"
                    class="mt-1 block w-full dark:dp__theme_dark"
                    v-model="dateTime"
                    autocomplete="datetime"
                    :dark="isDark"
                    enable-seconds
                />

                <InputError class="mt-2" :message="form.errors.datetime"/>
            </div>

            <div class="flex items-center gap-4" v-if="false">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>

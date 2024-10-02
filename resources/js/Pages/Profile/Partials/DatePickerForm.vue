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

const format = 'dd-MM-yyyy HH:mm:ss';
const date = ref<Date | null>(null);
const datetime = ref<Date | null>(null);

const form = useForm({
    date: date,
    datetime: datetime,
});

const submit = () => {

    if (form.datetime) {
        form.datetime = datetimeToUTC(form.datetime);
    }

    console.log(form.datetime);

    form.post(route('dates.update'),{
        preserveScroll: true,
        onFinish: (response) => {
            form.reset();

            let element = document.createElement('pre');
            element.textContent = JSON.stringify(response.data, undefined, 4);
            document.getElementById('json').appendChild(element);
        },
    });
};

const datetimeToUTC = (date) => {
    date = new Date(date);
    return new Date(Date.UTC(
        date.getFullYear(),
        date.getMonth(),
        date.getDate(),
        date.getHours(),
        date.getMinutes(),
        date.getSeconds(),
        date.getMilliseconds(),
    ));
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">DatePicker Form</h2>

            <p class="mt-1 text-md text-gray-600 dark:text-gray-400">
                The most complete datepicker solution for Vue 3.
            </p>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Powerful, lightweight, and reusable datepicker component to fit within any project
            </p>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                For more information visit:
                <a href="https://vue3datepicker.com" target="_blank">
                    <strong>Vue datepicker website</strong>
                </a>
            </p>
        </header>

        <form @submit.prevent="submit" class="mt-6 space-y-6">
            <div>
                <InputLabel for="date" value="Date" />

                <VueDatePicker
                    ref="datepicker"
                    id="date"
                    class="mt-1 block w-full dark:dp__theme_dark"
                    v-model="form.date"
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
                    v-model="form.datetime"
                    @internal-model-change="datetimeToUTC"
                    autocomplete="datetime"
                    :dark="isDark"
                    enable-seconds
                    time-picker-inline
                />

                <InputError class="mt-2" :message="form.errors.datetime"/>
            </div>

            <div class="flex items-center gap-4">
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

        <Transition
            enter-active-class="transition ease-in-out"
            enter-from-class="opacity-0"
            leave-active-class="transition ease-in-out"
            leave-to-class="opacity-0"
        >
            <div v-if="form.wasSuccessful"
                 class="mt-6 space-y-6 p-6 rounded shadow-sm text-sm border
                        text-gray-600 border-gray-300
                        dark:text-gray-300 dark:bg-gray-900 dark:border-gray-700"
                 id="json"
            ></div>
        </Transition>

    </section>
</template>

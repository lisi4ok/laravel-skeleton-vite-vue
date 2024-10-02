<script setup lang="ts">
import {
    computed, ref, onMounted, WritableComputedRef, ComputedRef,
    defineProps, withDefaults,
    defineModel, defineEmits, defineExpose
} from 'vue';
import { Ref } from '@vue/reactivity';


// const model = defineModel<any>({ required: true });
const input: Ref<HTMLInputElement | null> = ref<HTMLInputElement | null>(null);

const emit = defineEmits(['update:checked', 'update:modelValue']);

interface Props {
    checked?: boolean,
    value?: any,
    modelValue?: any,
    trueValue?: boolean | number | string,
    falseValue?: boolean | number | string,
}

const props = withDefaults(defineProps<Props>(), {
    checked: false,
    value: null,
    modelValue: null,
    trueValue: true,
    falseValue: false,
});

// const props2 = withDefaults(defineProps<{
//     checked?: boolean,
//     trueValue?: boolean | number | string,
//     falseValue?: boolean | number | string,
//     value?: any,
//     modelValue?: any,
// }>(), {
//     checked: false,
//     value: null,
//     modelValue: null,
//     trueValue: true,
//     falseValue: false,
// });

// const proxyChecked2: ComputedRef<boolean> = computed((): boolean => {
//     if (props.modelValue instanceof Array) {
//         return props.modelValue.includes(props.value);
//     }
//     return props.modelValue === true;
// });

const proxyChecked: WritableComputedRef<any> = computed({
    get(): boolean {
        if (props.modelValue instanceof Array) {
            return props.modelValue.includes(props.value);
        }
        return props.modelValue === true;
    },

    set(value: any): void {
        emit('update:checked', value);
    },
});

const updateModelValue = (event: Event): void => {
    let isChecked = (event.target as HTMLInputElement).checked;
    if (props.modelValue instanceof Array) {
        let newValue = [...props.modelValue];
        if (isChecked) {
            newValue.push(props.value);
        } else {
            newValue.splice(newValue.indexOf(props.value), 1);
        }
        emit('update:modelValue', newValue);
    } else {
        emit('update:modelValue', isChecked);
    }
};
</script>
<template>
    <input
        ref="input"
        type="checkbox"
        :value="value"
        v-model="proxyChecked"
        :checked="checked"
        @change="updateModelValue"
        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500
               dark:bg-gray-900 dark:border-gray-700 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
    />
</template>


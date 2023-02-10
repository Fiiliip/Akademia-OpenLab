<template>
    <div class="d-flex align-items-center">
        <button class="btn me-1" @click="$emit('deleteTask')">
            <img src="../../../../public/assets/trash-can.svg" alt="Odstrániť úlohu.">
        </button>
        <p class="mb-0">{{ this.task.title }}</p>
    </div>
</template>

<script>
export default {
    name: "TaskItem",
    props: {
        task: {
            type: Object,
            required: true,
        }
    }
};
</script>
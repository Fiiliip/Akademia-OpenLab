<template>
    <div style="max-width: 350px" class="d-flex justify-content-between">
        <p>{{ task.title }}</p>
        <button @click="setIsDone()">Hotovo</button>
    </div>
</template>

<script>
export default {
    name: "TaskItem",
    props: {
        task: Object,
    },
    methods: {
        setIsDone() {
            this.task.isDone = true;
        }
    },
    mounted() {
        console.log(this.task);
    }
};
</script>

<style>

</style>
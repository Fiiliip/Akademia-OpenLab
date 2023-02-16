<template>
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <button class="btn me-1" @click="changeStatus()">
                <img v-if="!this.task.completed" src="../../../../public/assets/check.svg" alt="Označiť úlohu ako splnenú.">
                <img v-else src="../../../../public/assets/x-square.svg" alt="Označiť úlohu ako nesplnenú.">
            </button>
            <p class="mb-0">{{ this.task.title }}</p>
        </div>
        <div>
            <button class="btn me-1" @click="editTask()">
                <img src="../../../../public/assets/edit.svg" alt="Upraviť úlohu.">
            </button>
            <button class="btn me-1" @click="deleteTask()">
                <img src="../../../../public/assets/trash-can.svg" alt="Odstrániť úlohu.">
            </button>
        </div>
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
    },
    methods: {
        changeStatus() {
            this.$store.state.tasks.find((task) => task.id == this.task.id).completed = !this.task.completed;
            this.$store.commit('saveData');
        },
        editTask() {
            this.$router.push({ name: 'edit-task', params: { id: this.task.id } });
        },
        deleteTask() {
            let index = this.$store.state.tasks.indexOf(this.task);
            this.$store.state.tasks.splice(index, 1);

            this.$store.commit('saveData');
        }
    }
};
</script>
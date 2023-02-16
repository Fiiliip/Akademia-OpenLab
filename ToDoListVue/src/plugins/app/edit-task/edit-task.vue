<template>
    <div class="container">
        <div>
            <div class="row align-items-center">
                <div class="col-1">
                    <p class="mb-2">ID</p>
                    <p class="col-2 mb-0">#{{ this.id }}</p>
                </div>
                <div class="col-8">
                    <p class="mb-2">Title</p>
                    <input class="w-100" type="text" v-model="this.title">
                </div>
                <div class="col-3">
                    <p class="mb-2">Status</p>
                    <p class="mb-0" v-if="this.completed">Completed</p>
                    <p class="mb-0" v-else>To do</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            id: 0,
            title: '',
            completed: false,
        }
    },
    methods: {
        saveChanges() {
            this.$store.state.tasks.find((task) => task.id == this.id).title = this.title;
            console.log(this.$store.state.tasks.find((task) => task.id == this.id).title);
            this.$store.commit('saveData');
        }
    },
    watch: {
        title() {
            this.saveChanges();
        }
    },
    beforeMount() {
        this.id = this.$route.params.id;
        this.title = this.$store.state.tasks.find((task) => task.id == this.$route.params.id).title;
        this.completed = this.$store.state.tasks.find((task) => task.id == this.$route.params.id).completed;
    }
}
</script>
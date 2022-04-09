<template>
    <div class="d-flex flex-column w-25 border border-2 border-dark me-2 rounded-3" style="background-color: #f4f4f4">
        <div class="d-flex text-black border-bottom border-2 border-dark">
            <strong class="mx-auto">{{name}}</strong>
            <a><i class="bi bi-three-dots-vertical"></i></a>
        </div>
        <div class="d-flex flex-column pb-2">
            <task v-for="task in tasks"
                  v-bind:title="task.name"
                  v-bind:description="task.description"/>
        </div>
    </div>
</template>

<script>
import Task from "./Task.vue";
export default {
    name: "Column",
    components: {Task},
    props: {
        name: String,
        tasks: Array
    }
}
</script>

<style scoped>

</style>

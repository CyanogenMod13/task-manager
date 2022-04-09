<template>
    <div class="p-3 d-flex flex-row mb-auto">
        <div v-if="!project" class="spinner-border"></div>
        <column v-else v-for="list in project.lists"
                v-bind:name="list.name"
                v-bind:tasks="list.tasks"/>
    </div>
</template>

<script>
import Column from "../components/Column.vue";
import axios from "axios";
export default {
    name: "MainBoard",
    components: {Column},
    data() {
        return {
            project: null
        }
    },
    mounted() {
        axios.get('/api/projects/4').then(response => {
            this.project = response.data
        })
    }
}
</script>

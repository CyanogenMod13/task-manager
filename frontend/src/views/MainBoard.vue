<template>
    <div class="p-3 d-flex flex-row h-100">
        <template v-if="!project">
            <div class="d-flex flex-column m-auto">
                <div class="spinner-border mx-auto"></div>
                <div class="mt-2 mx-auto">Fetching data...</div>
            </div>
        </template>
        <div v-else-if="project === 404" class="m-auto">Project not exists or you not assigned</div>
        <draggable class="w-100 d-flex"
                   v-else
                   v-bind:list="project.lists"
                   group="list"
                   item-key="id"
                   v-bind="{ animation: 200, forceFallback: true, ghostClass: 'hidden-ghost' }">
            <template #item="{ element, index }">
                <column v-bind:data="element"
                        v-bind:parent="project.lists"/>
            </template>
            <template #footer>
                <div class="w-25" style="min-width: 280px">
                    <button class="btn btn-outline-secondary mx-auto w-100" v-on:click="add">
                        <i class="bi bi-plus-circle-fill me-1"></i>add task
                    </button>
                </div>
            </template>
        </draggable>
        <router-view/>
    </div>
</template>

<script>
import Column from "../components/Column.vue";
import axios from "axios";
import draggable from "vuedraggable";
export default {
    name: "MainBoard",
    components: { Column, draggable },
    methods: {
        add: function () {
            this.project.lists.push({ name: null, tasks: []})
        }
    },
    data() {
        return {
            project: null
        }
    },
    mounted() {
        axios.get('/api/projects/' + this.$route.params.projectId).then(response => {
            this.project = response.data
        }).catch(reason => {
            this.project = 404;
        })
    }
}
</script>

<style>
    .hidden-ghost {
        opacity: 0;
    }
</style>

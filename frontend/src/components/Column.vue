<template>
    <div class="column d-flex flex-column w-25 me-2 rounded-3" style="background-color: #f4f4f4">
        <input v-if="!data.name"
               id="nameInput"
               class="form-control w-100 mt-1"
               type="text"
               placeholder="Name of the task"
               v-model="tempName"
               v-on:focusout="saveName"
               v-on:keydown.enter="saveName">
        <template v-else>
            <div class="d-flex text-black border-bottom border-dark">
                <strong class="mx-auto">{{data.name}}</strong>
                <div class="">
                    <a id="menuButton" data-bs-toggle="dropdown" role="button"><i class="bi bi-three-dots-vertical"></i></a>
                    <ul class="dropdown-menu" aria-labelledby="menuButton">
                        <li><button class="dropdown-item">Rename</button></li>
                        <li><button v-on:click="deleteColumn" class="dropdown-item">Remove</button></li>
                    </ul>
                </div>
            </div>
            <draggable v-bind:id="data.id"
                       class="h-100"
                       v-bind:list="data.tasks"
                       item-key="id"
                       v-bind="options">
                <template #item="{ element, index }">
                    <task v-bind:data="element"
                          v-bind:parent="data.tasks"/>
                </template>
                <template #footer>
                    <div class="d-flex my-2 px-1" key="footer">
                        <button class="btn btn-sm btn-outline-secondary mx-auto w-100" v-on:click="addTask">
                            <span><i class="bi bi-plus-circle-fill me-1"></i>add task</span>
                        </button>
                    </div>
                </template>
            </draggable>
        </template>
    </div>
</template>

<script>
import Task from "./Task.vue";
import draggable from 'vuedraggable'
import { remove } from "lodash";
import axios from "axios";

export default {
    name: "Column",
    components: { Task, draggable },
    props: {
        data: Object,
        parent: Array
    },
    computed: {
        options: function () {
            return {
                animation: 200,
                disabled: false,
                group: 'tasks',
                ghostClass: 'hidden-ghost',
                forceFallback: true,
                onEnd: function (event) {
                    let task = event.item
                    let to = event.to

                    axios.put(`/api/tasks/${task.id}`, { task_list_id: to.id }).then(response => {
                        console.log(response.data)
                    })
                }
            };
        }
    },
    methods: {
        addTask: function () {
            this.data.tasks.push({ name: null, task_list_id: this.data.id })
        },
        saveName: function () {
            if (this.tempName.length) {
                this.data.name = this.tempName
                this.createColumn()
            } else {
                remove(this.parent, this.data)
            }
        },
        onFocus: function () {
            let input = document.getElementById('nameInput')
            if (input) {
                input.focus()
            }
        },
        createColumn: function () {
            let projectId = this.$route.params.projectId
            axios.post(`/api/task-lists/create`, { name: this.data.name, project_id: projectId }).then(response => {
                this.data.id = response.data.id
                console.log('Column created ID: ' + this.data.id)
                this.data.tasks.forEach(task => {
                    task.task_list_id = this.data.id
                })
            })
        },
        editColumn: function () {
            axios.put(`/api/task-lists/${this.data.id}`, { name: this.data.name }).then(response => {
                console.log('Column updated ID: ' + this.data.id)
            })
        },
        deleteColumn: function () {
            console.log(this.parent)
            remove(this.parent, this.data)
            axios.delete(`/api/task-lists/${this.data.id}`).then(response => {
                console.log('Column ID '+ this.data.id + ' deleted')
            })
        }
    },
    data() {
        return {
            tempName: '',
        }
    },
    mounted() {
        this.onFocus()
    }
}
</script>

<style scoped>
    .hidden-ghost {
        opacity: 0;
    }

    .drag-task {
        opacity: 1;
    }

    .column {
        min-width: 280px;
    }
</style>

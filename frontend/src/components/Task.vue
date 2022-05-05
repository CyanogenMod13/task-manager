<template>
    <div v-bind:id="data.id" class="d-flex flex-column mt-2 mx-1">
        <div v-bind:style="{ 'background-color': colors[colorIndex] }">
            <small>&nbsp;</small>
        </div>
        <div class="bg-white p-1">
            <div v-if="data.name" >
                {{data.name}}
            </div>
            <input v-else
                   id="nameInput"
                   class="form-control w-100 mt-1"
                   type="text"
                   placeholder="Name of the task"
                   v-model="tempName"
                   v-on:focusout="saveName"
                   v-on:keydown.enter="saveName">

            <div v-if="data.end">
                <i class="bi bi-calendar-event"></i>
                {{data.end}}
            </div>

            <div class="d-flex flex-row mt-1">
                <div class="ms-auto"></div>
                <button class="btn btn-sm btn-outline-success" style="font-size: 0.7rem; border: none">
                    <i class="bi bi-calendar-plus"></i>
                </button>
                <button class="btn btn-sm btn-outline-success" v-on:click="$store.commit('editedTask', data); $router.push({ name: 'EditTask', params: { taskId: data.id } })" style="font-size: 0.7rem; border: none">
                    <i class="bi bi-pencil-square"></i>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { random, remove } from "lodash";
import axios from "axios";

export default {
    name: "Task",
    props: {
        data: Object,
        parent: Array
    },
    methods: {
        saveName: function () {
            if (this.tempName.length) {
                this.data.name = this.tempName
                this.createTask()
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
        createTask: function () {
            setTimeout(() => {
                axios.post(`/api/tasks/create`, this.data).then(response => {
                    this.data.id = response.data.id
                    console.log('Task created ID: ' + this.data.id)
                })
            }, this.data.task_list_id ? 0 : 5000)
        }
    },
    data() {
        return {
            tempName: '',
            colorIndex: random(0, 2),
            colors: [ "lightcoral", "lightgreen", "lightskyblue" ]
        }
    },
    mounted() {
        this.onFocus()
    }
}
</script>

<style scoped>
    .task-input-name {
        background: none;
        border: none;
        box-shadow: none;
    }
</style>

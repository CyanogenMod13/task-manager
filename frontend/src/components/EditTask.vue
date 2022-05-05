<template>
    <div class="d-flex flex-column w-100 h-100 position-fixed py-5" style="left: 0; top: 0; bottom: 0; right: 0; overflow-y: auto; background-color: rgba(0,0,0,0.5);">
        <div class="mx-auto bg-dark p-3 w-75">
            <div v-if="!data" class="text-white spinner-border"></div>
            <template v-else>
                <input v-model="data.name" class="bg-dark text-white form-control mt-1" type="text" placeholder="Name">

                <div class="d-flex flex-row">
                    <div class="w-75">
                        <div class="row text-white p-1">
                            <div class="col-4 my-auto">Description</div>
                            <div class="col-8"></div>
                        </div>

                        <textarea v-model="data.description" class="bg-dark text-white form-control w-100" style="min-height: 100px"></textarea>
                        <div class="dropdown-divider text-white"></div>
                        <!--div class="text-white p-1 my-auto">
                            <button v-on:click="save" class="btn btn-success me-1">
                                Save
                            </button>
                            <button v-on:click="$router.back()" class="btn btn-outline-danger">
                                Cancel
                            </button>
                        </div-->
                        <div class="row text-white p-1">
                            <div class="col-4 my-auto">Comments</div>
                            <div class="col-8"></div>
                        </div>

                        <div v-if="!data.comments" class="spinner-border text-white"></div>
                        <div v-else v-for="comment in data.comments" class="text-white p-1">
                            <div><i class="bi bi-people-fill text-white"></i>{{comment.user.name}}</div>
                            <div>{{comment.content}}</div>
                            <div class="dropdown-divider"></div>
                        </div>

                        <textarea v-model="commentText" class="form-control" placeholder="your comment"></textarea>
                        <button v-on:click="publishComment" class="btn btn-success mt-1">Comment</button>
                    </div>
                    <div class="w-25">
                        <div class="row text-white p-1">
                            <div class="col-4 my-auto">Assignee</div>
                            <div class="col-8">
                                <button class="btn btn-outline-secondary text-white w-100">
                                    <i class="bi bi-person-plus-fill">&nbsp;</i>
                                    <span>No assignee</span>
                                </button>
                            </div>
                        </div>

                        <div class="row text-white p-1">
                            <div class="col-4 my-auto">Due date</div>
                            <div class="col-8">
                                <input v-model="data.end" class="btn btn-outline-secondary text-white w-100" type="date">
                            </div>
                        </div>

                        <div class="row text-white p-1">
                            <div class="col-4 my-auto">Priority</div>
                            <div class="col-8">
                                <div class="dropdown">
                                    <button id="priorityButton" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle text-white w-100">
                                        <span v-if="data.priority">{{data.priority}}</span>
                                        <span v-else>-</span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="priorityButton">
                                        <li><button v-on:click="setPriority" class="dropdown-item"><span style="background-color: lightgreen">&nbsp;</span>&nbsp;low</button></li>
                                        <li><button v-on:click="setPriority" class="dropdown-item"><span style="background-color: lawngreen">&nbsp;</span>&nbsp;normal</button></li>
                                        <li><button v-on:click="setPriority" class="dropdown-item"><span style="background-color: lightcoral">&nbsp;</span>&nbsp;high</button></li>
                                        <li><button v-on:click="setPriority" class="dropdown-item"><span style="background-color: red">&nbsp;</span>&nbsp;critical</button></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!--div v-if="data" class="w-50 bg-black position-fixed p-3" style="left: 50%; bottom: 0;">
        <textarea v-model="commentText" class="form-control" placeholder="your comment"></textarea>
        <button v-on:click="publishComment" class="btn btn-success mt-1">Comment</button>
    </div-->
</template>

<script>

import axios from "axios";

export default {
    name: "EditTask",
    computed: {
        data: function () {
            let task = this.$store.getters.editedTask
            if (!task.comments) {
                axios.get('/api/comments/' + task.id).then(response => {
                    task.comments = response.data
                })
            }
            return task
        }
    },
    methods: {
        save: function () {
            axios.put(`/api/tasks/${this.data.id}`, this.tempData).then(response => {
                console.log('Task ID ' + this.data.id + ' updated')
            })
        },
        setPriority: function (button) {
            this.data.priority = button.target.innerText.trim()
        },
        onFocus: function (el) {
            console.log(el)
        },
        publishComment: function () {
            this.commentText = this.commentText.trim()
            if (!this.commentText.length) return

            let comment = { content: this.commentText, user: { name: 'You' } }
            axios.post('/api/comments/' + this.data.id + '/publish', { content: this.commentText }).then(response => {
                console.log(response.data)
            })
            this.data.comments.push(comment)
            this.commentText = ''
        }
    },
    data() {
        return {
            commentText: ''
        }
    },
    mounted() {
        /*let task_id = this.$route.params.task_id
        axios.get(`/api/tasks/${task_id}`).then(response => {
            this.data = response.data
        })*/
    }
}
</script>

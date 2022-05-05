<template>
    <div class="p-3 mt-1">
        <div class="d-flex w-100">
            <div class="my-auto">Assigned boards</div>
            <form class="ms-auto"><input v-model="patternName" class="form-control" placeholder="Search board"></form>
        </div>

        <div v-if="boards" class="row w-100 mx-auto">
            <template v-for="(board, index) in boards">
                <board-tile v-bind:id="board.id"
                            v-bind:name="board.name"
                            v-if="board.name.toLowerCase().startsWith(patternName.toLowerCase())"/>
            </template>
            <button id="createBoardButton" data-bs-toggle="dropdown" class="btn btn-sm btn-outline-secondary p-1 rounded-2 m-2" v-on:click="addTask" style="max-width: 250px; max-height: 100px">
                <span><i class="bi bi-plus-circle-fill me-1"></i>create board</span>
            </button>
            <div class="dropdown-menu" aria-labelledby="createBoardButton" style="width: 300px">
                <div class="p-1 mx-auto">Create board</div>
                <div class="dropdown-divider"></div>
                <div class="p-1">Title of board</div>
                <input v-model="boardName" class="form-control mb-2">
                <button v-on:click="createBoard" class="btn btn-success w-100" type="submit">Create</button>
            </div>
        </div>
        <div v-else class="d-flex flex-column w-100">
            <div class="spinner-border mx-auto"></div>
            <div class="mx-auto mt-2">Fetching boards...</div>
        </div>
    </div>
</template>

<script>
import BoardTile from "../components/board/BoardTile.vue";
import axios from "axios";
export default {
    name: "Home",
    components: {BoardTile},
    computed: {
        boards: function () {
            return this.$store.getters.projectsList
        }
    },
    methods: {
        createBoard: function () {
            axios.post('/api/projects/create', { name: this.boardName }).then(response => {
                console.log(response.data)
                this.$router.push({ name: 'Board', params: { projectId: response.data.id } })
            })
        }
    },
    data() {
        return {
            patternName: '',
            boardName: ''
        }
    },
    mounted() {
        axios.get('/api/projects/').then(response => {
            console.log(response.data)
            this.$store.commit('projectsList', response.data.projects)
        })

    }
}
</script>

<style scoped>

</style>

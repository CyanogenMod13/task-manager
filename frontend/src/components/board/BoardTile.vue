<template>
    <div v-on:click="$router.push('/boards/' + id)" role="button" class="d-flex flex-column board-tile p-1 rounded-2 w-25 m-2">
        <div class="w-100">{{name}}</div>
        <div class="d-flex mt-auto w-100">
            <a class="ms-auto" role="button"><i class="bi bi-star"></i></a>
        </div>
    </div>
</template>

<script>
export default {
    name: "BoardTile",
    props: {
        name: String,
        id: Number
    }
}
</script>

<style scoped>
    .board-tile {
        min-height: 100px;
        min-width: 250px;
        max-height: 100px;
        max-width: 250px;
        background-color: #a0aec0;
    }

    .board-tile:hover {
        border: 1px solid black;
    }
</style>

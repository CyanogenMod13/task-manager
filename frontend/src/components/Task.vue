<template>
    <div class="d-flex flex-column border border-2 border-dark mt-2 mx-1 rounded-1">
        <div class="d-flex text-white border-bottom border-2 border-dark" style="background-color: red">
            <strong class="mx-auto">{{title}}</strong>
            <a><i class="bi bi-three-dots-vertical"></i></a>
        </div>
        <div style="background-color: lightcoral">
            {{description}}
        </div>
    </div>
</template>

<script>
export default {
    name: "Task",
    props: {
        title: String,
        description: String
    }
}
</script>

<style scoped>

</style>

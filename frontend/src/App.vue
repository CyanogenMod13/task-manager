<script setup>
import MainBoard from "./views/MainBoard.vue";
</script>

<template class="h-100">
    <header class="nav d-flex bg-black w-100">
        <a class="nav-link text-white me-auto">Task Manager</a>
        <a class="nav-link text-white">
            <i class="bi bi-person-circle"></i>
        </a>
    </header>
    <main-board/>
</template>

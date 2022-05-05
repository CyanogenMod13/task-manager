<template>
    <div class="bg-dark h-100 position-fixed sidebar py-3">
        <ul class="nav nav-pills d-flex flex-column mx-auto">
            <li class="nav-item">
                <a class="nav-link nav-link-hover text-white" role="button">
                    <i class="bi bi-people-fill me-2"></i>
                    <span>Teammates</span>
                </a>
            </li>
            <li class="nav-item">
                <a v-on:click="$router.push('/boards')" class="nav-link nav-link-hover text-white collapsed" role="button">
                    <i class="bi bi-box me-2"></i>
                    <span>Boards</span>
                </a>
                <!--div id="boardsCollapse" class="collapse">
                    <div class="spinner-border text-white"></div>
                </div-->
            </li>
            <li class="nav-item">
                <a class="nav-link nav-link-hover text-white" role="button">
                    <i class="bi bi-gear-fill me-2"></i>
                    <span>Settings</span>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "SideBar"
}
</script>

<style scoped>
    .sidebar {
        width: 280px;
    }

    .nav-link-hover:focus,
    .nav-link-hover:hover {
        background-color: black;
    }
</style>

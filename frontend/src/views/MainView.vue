<template>
    <side-bar v-if="showSideBar"/>
    <div v-bind:class="mainMarge" class="h-100">
        <div class="nav d-flex bg-black w-100 position-fixed nav-shadow" v-bind:style="showSideBar ? { paddingRight: '280px' } : {}">
            <a class="nav-link text-white" role="button" v-on:click="switchSideBar"><i class="bi bi-list"></i></a>
            <a class="nav-link text-white me-auto">Project 1</a>
            <a class="nav-link text-white"><i></i></a>
            <div class="nav-item">
                <input id="searchNav" class="nav-item form-control bg-dark text-white" style="min-width: 100px" placeholder="Search" type="search">
            </div>
            <notification-bell/>
            <a class="nav-link text-white"><i class="bi bi-person-circle"></i></a>
        </div>
        <div class="main h-100">
            <router-view/>
        </div>
    </div>
</template>

<script>
import SideBar from "../components/SideBar.vue";
import EditTask from "../components/EditTask.vue";
import NotificationBell from "../components/navbar/NotificationBell.vue";
export default {
    name: "MainView",
    components: {NotificationBell, EditTask, SideBar },
    computed: {
        mainMarge: function () {
            return this.showSideBar ? 'main-open' : 'main-close'
        }
    },
    methods: {
        switchSideBar: function () {
            this.showSideBar = !this.showSideBar
        }
    },
    data() {
        return {
            showSideBar: false,
        }
    }
}
</script>

<style scoped>
    .nav-shadow {
        box-shadow: 0 0.125rem 0.25rem black;
    }

    .main {
        padding-top: 40px;
        overflow-x: auto;
    }

    .sidebar-close {
        display: none;
        animation: move-side-close 0.4s;
    }

    .sidebar-open {
        display: block;
        animation: move-side-open 0.4s;
    }

    .main-open {
        margin-left: 280px;
        /*animation: move-main-open 0.4s;*/
    }

    .main-close {
        margin-left: 0;
        /*animation: move-main-close 0.4s;*/
    }

    @keyframes move-side-open {
        from { left: -280px; }
        to { left: 0; }
    }

    @keyframes move-side-close {
        from { left: 0; }
        to { left: -280px; }
    }

    @keyframes move-main-open {
        from { margin-left: 0; }
        to { margin-left: 280px; }
    }

    @keyframes move-main-close {
        from { margin-left: 280px; }
        to { margin-left: 0; }
    }
</style>

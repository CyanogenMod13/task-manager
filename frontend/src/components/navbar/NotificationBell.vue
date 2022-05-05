<template>
    <div class="dropdown">
        <a v-on:click="updateNotifications" id="bellyDropDown" class="nav-link text-white" data-bs-toggle="dropdown"><i class="bi bi-bell"></i></a>
        <div class="dropdown-menu" aria-labelledby="bellyDropDown" style="width: 400px; height: 500px">
            <div class="d-flex flex-column h-100">
                <div class="mx-auto">Notifications</div>
                <div class="dropdown-divider w-100"></div>
                <div v-if="!notifications" class="spinner-border m-auto"></div>
                <div v-else-if="notifications.length === 0" class="m-auto">Nothing to show</div>
                <template v-else v-for="notification in notifications">
                    <div class="px-2">{{notification.title}}</div>
                    <div class="d-flex flex-row px-2">
                        <div>{{notification.context}}</div>
                        <!--div class="ms-auto">{{notification.created_at}}</div-->
                    </div>
                    <div class="dropdown-divider"></div>
                </template>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "NotificationBell",
    methods: {
        updateNotifications: function () {
            axios.get('/api/notifications').then(response => {
                this.notifications = response.data
                console.log(response.data)
            })
        }
    },
    data() {
        return {
            notifications: null
        }
    }
}
</script>

<style scoped>

</style>

<template>
    <li v-on:click.once="loadNotifications" class="dropdown">
        <a :class="newElements" class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i :class="{'double-icon': notificationsCount > 0}" class="fa fa-bell fa-fw">
                <template v-if="notificationsCount > 0">
                    <span class="fa fa-square"></span>
                    <span class="num">{{ notificationsCount }}</span>
                </template>
            </i>
            <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-alerts">
            <template v-if="notifications.length == 0 && loaded">
                <li>
                    <a href="#" class="text-center unhoverable">
                        <div>
                            <i class="fa fa-info-circle" aria-hidden="true"></i> No hay notificaciones sin leer.
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
            </template>
            <li v-show="!loaded">
                <a href="#" class="text-center">
                    <i class="fa fa-spinner fa-pulse" aria-hidden="true"></i> Cargando...
                </a>
            </li>
            <template v-if="notifications.length > 0 && loaded" v-for="(notification, index) in notifications">
                <template v-if="index < 6">
                    <li>
                        <a :href="notification.data.action" v-on:click="markAsRead(notification.id)">
                            <div>
                                <i class="fa fa-fw" :class="notification.data.icon"></i> {{ notification.data.message }}
                                <span class="pull-right text-muted small">
                                {{ humanTime(notification.created_at) }}
                            </span>
                            </div>
                        </a>
                    </li>
                    <li v-show="loaded && notifications.length > 1" class="divider"></li>
                </template>
            </template>

            <li v-show="loaded">
                <a class="text-center" :href="'/dashboard/perfil'">
                    <strong>Ver todas las notificaciones</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
        </ul>
    </li>
</template>
<script>
    export default {
        props: [],
        mounted() {
            console.log('Componente notifications-list montado');
            this.getNotificationsCount();
        },
        data() {
            return {
                notifications: [],
                notificationsCount: 0,
                loaded: false
            }
        },
        watch: {
            notifications: function () {
                this.loaded = true;
            }
        },
        methods: {
            loadNotifications() {
                this.loaded = false;
                this.fetchNotifications();
            },
            getNotificationsCount() {
                let _this = this;
                axios.get(`/api/notifications?data=count`)
                    .then((response) => {
                        _this.notificationsCount = response.data.notifications;
                    })
                    .catch((error) => {
                        console.log(error);
                    })
            },
            fetchNotifications() {
                let _this = this;
                axios.get(`/api/notifications`)
                    .then((response) => {
                        console.log(response);
                        _this.notifications = response.data.notifications;
                    })
                    .catch((error) => {
                        console.log(error);
                    })
            },
            humanTime(date) {
                //return date;
                return Moment(date, "YYYY-MM-DD HH:mm:ss").fromNow();
            },
            markAsRead(id) {
                axios.put(`/api/notifications/${id}/read`)
                    .then((response) => {
                        console.log(response);
                    })
                    .catch((error)=>{
                        console.log(error);
                    })
            }
        },
        computed: {
            newElements() {
                return '';
                //return this.notificationsCount > 0 ? 'new-elements' : '';
            }
        },
    }
</script>
<style>
    .unhoverable:hover {
        background-color: white;
    }
    .new-elements {
        color: #ffff00;
    }
    .new-elements:active, .new-elements:focus, .new-elements:hover {
        color: #c5c500;
    }

    i.double-icon {
        position: relative;
        font-size: 1em;
        cursor: pointer;
    }
    span.fa-square {
        position: absolute;
        font-size: 0.9em;
        top: -4px;
        color: red;
        right: -4px;
    }
    span.num {
        position: absolute;
        font-size: 0.7em;
        top: -2px;
        color: #fff;
        right: -1px;
    }


</style>
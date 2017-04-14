
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding partials to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('vue-pagination', require('./components/Pagination.vue'));

const app = new Vue({
    el: '#app',
    data: {
        clients: [],
        counter: 0,
        pagination: {
            total: 0,
            per_page: 2,
            from: 1,
            to: 0,
            current_page: 1
        },
        offset: 4,
    },
    created : function() {
        //this.getClients(this.pagination.current_page);
    },
    methods: {
        getClients(page) {
            var _this = this;
            $.ajax({
                url: 'clientes?page='+page,
                success: (response) => {
                    _this.clients = response.data.data;
                    _this.pagination = response.data;
                }
            });
        }
    }
});
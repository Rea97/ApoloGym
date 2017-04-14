<template>
    <ul class="pagination">
        <!--<li v-if="pagination.current_page > 1">-->
        <li :class="{'disabled':pagination.current_page == 1}">
            <a href="#" aria-label="Previous" v-on:click.prevent="changePage('backward')">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <li v-for="page in pagesNumber" :class="{'active': page == pagination.current_page}">
            <a href="#" v-on:click.prevent="changePage(page)">{{ page }}</a>
        </li>
        <!--<li v-if="pagination.current_page < pagination.last_page">-->
        <li :class="{'disabled':pagination.current_page == pagination.last_page}">
            <a href="#" aria-label="Next" v-on:click.prevent="changePage('forward')">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</template>
<script>
    export default {
        props: {
            pagination: {
                type: Object,
                required: true
            },
            offset: {
                type: Number,
                default: 4
            }
        },
        computed: {
            pagesNumber: function () {
                if (!this.pagination.to) {
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                var to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                var pagesArray = [];
                for (from = 1; from <= to; from++) {
                    pagesArray.push(from);
                }
                return pagesArray;
            }
        },
        methods : {
            changePage: function (page) {
                switch (page) {
                    case 'forward':
                        //Esta acción ocurre cuando se presipna el botón para ir hacia adelante
                        if (this.pagination.current_page < this.pagination.last_page) {
                            this.pagination.current_page++;
                        }
                        break;
                    case 'backward':
                        //Esta acción ocurre cuando se presipna el botón para ir hacia atrás
                        if (this.pagination.current_page != 1) {
                            this.pagination.current_page--;
                        }
                        break;
                    default:
                        //En caso de no recibir ninguno de los dos anteriores casos como parametros
                        //se entiende que es un numero de página especifico recibido, por lo tanto,
                        //se asigna directamente dicho numero a la página actual
                        this.pagination.current_page = page;
                        break;
                }
            }
        }
    }
</script>
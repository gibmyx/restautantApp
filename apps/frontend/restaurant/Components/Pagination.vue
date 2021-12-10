<template>
    <nav aria-label="...">
        <ul class="pagination justify-content-end mb-0">

            <li class="page-item" :class="pagination.current_page == 1 ? 'disabled' : ''">
                <a class="page-link" href="#" tabindex="-1"  :disabled="pagination.current_page == 1"
                   @click.prevent="buscar(pagination.current_page - 1)">
                    <i class="fas fa-angle-left"></i>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <li class="page-item" v-for="page in pagesNumber" :key="page"
                :class="page === isActived ? 'active' : ''">
                <a class="page-link" href="#" @click.prevent="buscar(page)" v-text="page"></a>
            </li>

            <li class="page-item" :class="pagination.current_page == pagination.last_page == 1 ? 'disabled' : ''">
                <a class="page-link" href="#" :disabled="pagination.current_page == pagination.last_page"
                   @click.prevent="buscar(pagination.current_page + 1)">
                    <i class="fas fa-angle-right"></i>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
import {defineComponent} from "vue";

export default defineComponent({
    name: "Pagination",

    emits: ["buscar"],

    props: {
        pagination: {
            type: Object,
            required: true,
            default: {
                total: 0,
                current_page: 0,
                per_page: 0,
                last_page: 0,
                from: 0,
                to: 0,
            }
        },
        params: {
            type: Object,
            required: true,
            default: []
        }
    },

    data() {
        return {
            offset: 1,
        }
    },
    computed: {
        pagesNumber() {
            if (!this.pagination.to) {
                return [];
            }

            let from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }

            let to = from + (this.offset * 2);
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }

            let pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        },

        isActived() {
            return this.pagination.current_page;
        },
    },
    methods: {
        buscar(page) {
            this.params.page = page
            this.$emit('buscar');
        }
    }
})
</script>

<style scoped>

</style>

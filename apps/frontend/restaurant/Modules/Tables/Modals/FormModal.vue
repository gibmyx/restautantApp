<template>

    <div class="modal fade" :id="name+'Modal'" data-backdrop="static" tabindex="-1" role="dialog"
         :aria-labelledby="name+'ModalLabel'"
         aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-default" v-html="edithMode ? 'Editar Mesa' : 'Crear mesa'"></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-code">Codigo</label>
                                <input type="text" min="1" pattern="^[0-9]+" id="input-code" v-model="formData.code"
                                       class="form-control form-control-sm" disabled>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-code">Estado</label>
                                <select2 name="state" :options="statesOptions" :disabled="!edithMode"
                                         v-model="formData.state" :settings="{minimumResultsForSearch: Infinity}">
                                </select2>
                            </div>
                        </div>
                    </div>
                    <hr class="my-2"/>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-max-people">Capacidad maxima </label>
                                <input type="number" min="1" pattern="^[0-9]+" id="input-max-people" v-model="formData.maxPeople"
                                       class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-min-people">Capacidad minima</label>
                                <input type="number" min="1" pattern="^[0-9]+" id="input-min-people" v-model="formData.minPeople"
                                       class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="form-group">
                            <label class="form-control-label">Descripcion</label>
                            <textarea rows="4" class="form-control" placeholder="" v-model="formData.description"></textarea>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click.prevent="update" :disabled="disableSave" v-if="edithMode">Save changes</button>
                    <button type="button" class="btn btn-primary" @click.prevent="save" :disabled="disableSave" v-else>Save changes</button>
                    <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

</template>

<script>
import {defineComponent} from "vue";
import formData from "@/Modules/Tables/Data/formData";

export default defineComponent({
    name: "FormModal",

    emits: ["reload"],

    props: ['name'],

    data() {
        return {
            formData: formData(),
            disableSave: false,
            edithMode: false,
            statesOptions: [{id: "available", text: 'Disponible'}, {id: "unavailable", text: "Fuera de Servicio"}],
        }
    },

    mounted() {
        let $searchfield = $(this).parent().find('.select2-search__field');
        $searchfield.prop('disabled', true)
    },

    methods: {
        reset() {
            this.formData = formData();
            this.edithMode = false;
        },
        setForm(row) {
            this.formData = row;
            this.formData = Object.assign({}, row);
            this.edithMode = true;
        },
        reload() {
            this.$emit("reload")
        },
        hide() {
            this.reset();
            let modal = $('#' + this.name + 'Modal');
            modal.modal('hide');
        },
        show() {
            this.reset();
            let modal = $('#' + this.name + 'Modal');
            modal.modal('show');
        },
        showDetails(row) {
            this.reset();
            this.setForm(row);
            let modal = $('#' + this.name + 'Modal');
            modal.modal('show');
        },
        save() {
            this.disableSave = true;
            axios.post('/table/'+this.formData.id, this.formData).then(response => {
                this.$toast.success("Solicitud realizada con exito", {duration: 5000, position: "top-right"});
                this.hide();
                this.reload();
            }).catch(e => {
                this.$toast.error(e, {duration: 5000, position: "top-right"});
            }).finally(() => {
                this.disableSave = false;
            });
        },
        update() {
            this.disableSave = true;
            axios.put('/table', this.formData).then(response => {
                this.$toast.success("Solicitud realizada con exito", {duration: 5000, position: "top-right"});
                this.hide();
                this.reload();
            }).catch(e => {
                this.$toast.error(e, {duration: 5000, position: "top-right"});
            }).finally(() => {
                this.disableSave = false;
            });
        },
    }
})
</script>

<style scoped>

</style>

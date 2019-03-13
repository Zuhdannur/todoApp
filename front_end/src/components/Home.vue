<template>
    <div>
        <b-container>
            <div class="d-flex bd-highlight mb-3">
                <div class="p-2 bd-highlight"><h6 class="display-4">TODO APP</h6></div>
                <div class="ml-auto p-2 bd-highlight">
                    <b-button @click="reset" variant="success" style="float: right;">Tambah Jadwal
                    </b-button>
                </div>
            </div>
            <b-modal v-model="modalShow" hide-footer title="Jadwal">
                <b-form @submit.prevent="submitForm">
                    <div>
                        <label class="sr-only" for="inlineFormInputName2">Judul Jadwal</label>
                        <b-input class="mb-2 mr-sm-2 mb-sm-0" id="inlineFormInputName2" v-model="todo.title"
                                 placeholder="Title"/>
                    </div>
                    <div class="d-flex">
                        <div class="d-flex justify-content-start">
                            <div class="p-2">
                                <label class="sr-only" for="inlineFormInputGroupUsername2">Start</label>
                                <datepicker class="mb-2 mr-sm-2 mb-sm-0" name="start" id="inlineFormInputGroupUsername2"
                                            placeholder="Start Event" style="padding: 2%;"
                                            v-model="todo.start"></datepicker>
                            </div>
                            <div class="p-2">
                                <label class="sr-only" for="inlineFormInputGroupUsername2">End</label>
                                <datepicker class="mb-2 mr-sm-2 mb-sm-0" name="start" id="inlineFormInputGroupUsername2"
                                            placeholder="End Event" style="padding: 2%;"
                                            v-model="todo.end"></datepicker>
                            </div>
                        </div>
                    </div>
                    <b-form-textarea
                            id="textarea1"
                            placeholder="Description"
                            rows="3"
                            max-rows="6"
                            v-model="todo.desscription"
                    />
                    <b-button type="submit" variant="success" style="margin: 1%;float: right;" @click="modalShow = !modalShow">{{ this.btnTitle }}</b-button>
                </b-form>
            </b-modal>

            <b-table striped hover :fields="fields" :items="item" >
                <template slot="no" slot-scope="data">
                    {{ data.index + 1 }}
                </template>

                <template slot="id" slot-scope="data">
                    <b-button variant="danger" @click="deleteRow(data.value)"><span><i class="fa fa-trash"></i>Finish</span></b-button>
                    <b-button variant="warning" style="margin: 3%;color: white;" @click="setValue(data.index + 1)">Edit</b-button>
                </template>
            </b-table>
        </b-container>
    </div>
</template>
<script>
    import BForm from "bootstrap-vue/src/components/form/form";
    import Datepicker from 'vuejs-datepicker';
    import {api} from '@/helper/api';
    import {moment} from 'vue-moment'

    export default {

        name: 'Home',
        components: {
            BForm,
            Datepicker
        },
        data() {
            return {
                todo: {
                    id:null,
                    title: '',
                    desscription: '',
                    start: new Date(),
                    end: new Date()
                },
                modalShow: false,
                fields: [
                    { key: 'no', label: 'No' },
                    { key: 'title', label: 'Title' },
                    { key: 'desscription', label: 'Description' },
                    { key: 'start', label: 'Start' },
                    { key: 'end', label: 'End' },
                    { key: 'id', label: 'Action'}
                ],
                moment: moment,
                item: null,
                btnTitle: 'Tambah',
            }
        },
        mounted() {
            this.get()
        },
        methods: {
            submitForm() {
                let data = this.todo
                let url = 'todo'
                if(this.todo.id){
                    url += '/'+this.todo.id
                }
                    api.post(url, data).then(res => {
                        if (res.data.status === 'success') {
                            // console.log(res.data.status);
                        } else {
                            // console.log(res.data.status);
                        }
                        this.get()
                    })
            },
            customFormmated(date) {
                return moment(date).format('yyyy MM dd');
            },
            get() {
                api.get('todo').then(res =>{
                    if(res.data.status === 'success'){
                        this.item = res.data.result
                    }
                })
            },
            deleteRow(id){
              api.delete('todo/'+id).then(res =>{
                 if(res.data.status === "success"){
                     this.get()
                 }
              });
            },
            setValue (index){
                this.btnTitle = 'Edit'
                this.modalShow = !this.modalShow
                this.todo = this.item[index - 1]
            },
            reset () {
                this.modalShow = !this.modalShow
                this.todo.id = null
                this.todo.title = ''
                this.todo.desscription = ''
                this.todo.start = new Date()
                this.todo.end = new Date()
                this.btnTitle = 'Tambah'
            }
        }
    }
</script>


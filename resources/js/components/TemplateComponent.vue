<template>
    <div>
        <section class="content">
            <div class="row">

                <explorer :active="active" :content="content"></explorer>

                <div class="col-md-9">
                    <div class="box box-primary">

                        <div class="box-header with-border">
                            <h3 class="box-title">Редактирование шаблона</h3>
                        </div>

                        <div class="box box-primary">
                            <div class="box-body">
                                <div v-if="active == null">
                                     <div class="box box-solid">
                                        <div class="box-header with-border">
                                            <i class="fa fa-text-width"></i>
                                            <h3 class="box-title">Описание</h3>
                                        </div>
                                        <div class="box-body">
                                            <dl>
                                            <dt>Редактирование шаблона</dt>
                                            <br />
                                            <dd>Для начала редактирования выберите необходимый шаблон из списка слева.</dd>
                                            <dd>Будьте осторожны при любых изменениях в данном разделе,
                                             это может испортить внешний вид сайта.</dd>
                                            <br />
                                            <dd>Для редактирования вы можете использовать 
                                            <a href="http://laravel.su/docs/5.4/blade" target="_blank">шаблонизатор Blade.</a></dd>               
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                                <form v-else>
                                    <codemirror v-model="code" :options="cmOptions"></codemirror>

                                    <div class="box-footer">
                                        <a class="btn btn-default" @click.prevent="cancel">Отменить</a>
                                        <button class="btn btn-success pull-right" @click.prevent="onSubmit">
                                            Сохранить
                                        </button>
                                    </div>
                                </form>
                            </div>     
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import { codemirror } from 'vue-codemirror';
import 'codemirror/lib/codemirror.css';
import 'codemirror/mode/php/php.js';
import 'codemirror/addon/selection/active-line.js';

import Explorer from './Explorer';

import Toasted from 'vue-toasted';

Vue.use(Toasted);

export default {
    data() {
        return {
            code: '',
            active: null,
            cmOptions: {
                tabSize: 4,
                styleActiveLine: true,
                lineNumbers: true,
                line: true,
                mode: 'application/x-httpd-php',
                lineWrapping: true
            }
        }
    },
    created() {
        this.getContent();
    },
    methods: {
        getFile(template) {
            axios
                .post('/admin/template-manager/load', {template: template})
                .then(res => this.code = res.data)
                .catch(err => console.log(err));
            this.active = template; 
        },
        onSubmit() {
            axios
                .post('/admin/template-manager/update', {code: this.code, template: this.active})
                .then(res => {
                        let toast = this.$toasted.show('Успешно сохранено!', {
                            position: "top-right",
                            duration : 5000
                        });
                    })
                .catch(err => console.log(err))
        },
        cancel() {
            this.code = null;
            this.active = null;
        }
    },
    components: {
        codemirror,
        Explorer
    }

}
</script>

<style>
.CodeMirror {
    height: 400px;
}
</style>

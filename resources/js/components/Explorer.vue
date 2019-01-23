<template>
    <div class="col-md-3">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Шаблоны</h3>
            </div>
            <div class="box-body no-padding" style="" v-if="!load">
                <ul class="nav nav-pills nav-stacked">
                    <li v-for="(directory, key, index) in directories" :key="index">
                        <i v-show="directory.opened" class="fa fa-minus pull-right"></i>
                        
                        <a href="#" @click.prevent="getFolder(key)">
                        <i class="fa fa-folder"></i> {{ directory.basename }}</a>
                        
                        <sub-explorer v-show="directory.opened"
                        v-if="directory.subDirectories || directory.subFiles"
                        :directory="directory">
                        </sub-explorer>
                    </li>
                    <li v-for="(file, key, index) in files" :key="index">
                        <a href="#" @click.prevent="getFile(file.path)">
                            <i class="fa fa-file-code-o"></i> {{ file.basename }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import SubExplorer from './SubExplorer';

    export default {
        created() {
            this.getContent();
        },
        data() {
            return {
                directories: null,
                files: null,
                load: false
            }
        },
        methods: {
            getContent() {
                axios
                    .post('/admin/template-manager/explore')
                    .then(res => {
                        this.directories = res.data.directories;
                        this.files = res.data.files;
                        this.load = true;
                        this.load = false;
                    })
                    .catch(error => console.log(error))
            },
            getFolder(index) {
                if(this.directories[index].opened) {
                    this.directories[index].opened = false;
                    this.reload();
                    return;
                }

                axios
                .post('/admin/template-manager/explore', {
                    path: this.directories[index].path
                })
                .then(res => {
                    this.directories[index].subDirectories = res.data.directories;
                    this.directories[index].subFiles = res.data.files;
                    this.directories[index].opened = true;
                    this.reload();
                })
                .catch(error => console.log(error))
            },
            reload() {
                this.load = true;
                this.load = false;
            },
            getFile(path) {
                EventBus.$emit('getFile', path)
            }
        },
        components: {
            SubExplorer
        },
    }
</script>

<style>
    .nav-sub {
        padding-left: 20px;
    }
    .fa.pull-right {
        padding: 13px 17px 0 0;
    }
    .nav>li>a {
        position: unset !important;
    }
</style>
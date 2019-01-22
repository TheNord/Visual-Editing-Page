<template>
    <ul v-if="!load" class="nav nav-pills nav-stacked nav-sub">
        <li v-for="(directory, key, index) in directory.subDirectories" :key="index">
            <a href="#" @click.prevent="getFolder(key)">
                <i class="fa fa-folder"></i> {{ directory.basename }}</a>
            <sub-explorer v-if="directory.subDirectories || directory.subFiles" :directory="directory"></sub-explorer>
        </li>
        <li v-for="(file, key, index) in directory.subFiles" :key="index">
            <a href="#" @click.prevent="getFolder(key)">
                <i class="fa fa-file-code-o"></i> {{ file.basename }}</a>
        </li>
    </ul>
</template>

<script>
    export default {
        props: ['directory'],
        data() {
            return {
                load: false
            }
        },
        methods: {
            getFolder(index) {
                axios
                    .post('/admin/template-manager/explore', {
                        path: this.directory.subDirectories[index].path
                    })
                    .then(res => {
                        console.log(res)
                        this.directory.subDirectories[index].subDirectories = res.data.directories;
                        this.directory.subDirectories[index].subFiles = res.data.files;
                        this.load = true;
                        this.load = false;
                    })
                    .catch(error => console.log(error))

            }
        },
    }
</script>

<style>
    .nav-sub {
        padding-left: 20px;
    }
</style>
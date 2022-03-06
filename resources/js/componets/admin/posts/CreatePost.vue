<template>
    <v-app>
        <v-main>
            <v-row>
                <v-col cols="8">
                    <v-autocomplete label="Язык статьи" :items="languages" item-text="name" item-value="id"
                                    v-model="language"/>
                    <vue-editor use-custom-image-handler @image-added="handleImageAdded" v-model="post"
                                :editorOptions="editorSettings"/>
                    <v-btn color="primary" @click="savePost">Опубликовать</v-btn>
                </v-col>
                <v-col cols="4">
                    <v-card>
                        <v-card-text v-html="post"/>
                    </v-card>
                </v-col>
            </v-row>
        </v-main>
    </v-app>
</template>

<script>
import {VueEditor, Quill} from "vue2-editor";
import ImageResize from 'quill-image-resize-vue';
import {ImageDrop} from 'quill-image-drop-module';

Quill.register("modules/imageDrop", ImageDrop);
Quill.register("modules/imageResize", ImageResize);


export default {
    name: "CreatePost",
    components: {VueEditor},
    props: {
        languages: Array,
    },
    data() {
        return {
            post: '',
            language: 1,
            editorSettings: {
                modules: {
                    imageDrop: true,
                    imageResize: {},
                }
            }
        }
    },


    methods: {
        handleImageAdded: function (file, Editor, cursorLocation, resetUploader) {
            let formData = new FormData();
            formData.append("file", file);
            axios.post('/admin/uploadFile', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(result => {
                    let url = result.data;
                    Editor.insertEmbed(cursorLocation, "image", url);
                    resetUploader();
                }).catch(err => {
                console.log('error! ' + err)
            });
        },

        savePost() {
            axios.post('/admin/savePost', {article: this.post, language_id: this.language})
                .then(() => {
                    this.post = '';
                })
                .catch(error => console.log(error));
        }
    }
}
</script>

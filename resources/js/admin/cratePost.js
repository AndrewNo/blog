import Vue from "vue";
import vuetify from "../vuetify";
import CreatePost from "../componets/admin/posts/CreatePost";
import Vue2Editor from "vue2-editor";

Vue.use(Vue2Editor);
new Vue({
  vuetify,
    components:{
        createpost: CreatePost
    }
}).$mount('#app')

<template>
    <div class="list_wrapper">
        <div v-if="bread == 'various'" class="reload" @click="reload()">
            <h2>reload</h2>
        </div>
        <div v-else-if="bread == 'search'" class="search_result">
            <p>【{{ keywords }}】</p>
        </div>
        <div class="contents_wrapper">
            <div v-if="contents.length >= 1" class="contents">
                <div v-for="content in contents" class="content" :key="content.id">
                    <div class="content_image">
                        <a :href="'/content_detail?id='+content.id"><img :src="'/img/content/'+content.image_name" @error="noImage"></a>
                    </div>
                    <div v-if="content.tag != null">
                        <span class="content_tag">{{content.tag}}</span>
                    </div>                
                </div>
            </div>
            <div v-else class="no_contents">
                <div class="load_wrapper" v-if="load_show == true">
                    <i class="fa fa-spinner fa-pulse fa-3x fa-fw loading"></i>
                </div>
                <p v-if="bread!='account'">該当するものがありません。</p>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props:['login_info', 'Bread', 'Keywords'],
    data(){
        return{
            contents:{},
            load_show:true
        }
    },
    computed:{
        detailURL(){
            return "/content_detail?id=" + this.content.id;
        }
    },
    methods:{
        getVarious(){
            var params = new URLSearchParams();
            axios.post("api/home/getVarious",params)
                    .then(res => {
                        this.contents = res.data.contents;
                    });
        },
        getSearch(){
            var params = new URLSearchParams();
            params.append('keyword',this.keywords);
            axios.post("api/home/getSearch",params)
                    .then(res => {
                        this.contents = res.data.contents;
                    });
        },
        getFavorite(){
            var params = new URLSearchParams();
            params.append('user_id',this.loginInfo['user_id']);
            axios.post('api/home/getFavorite',params)
                    .then(res=> {
                        this.contents = res.data.contents;
                    });
        },
        getMyContents(){
            var params = new URLSearchParams();
            params.append('user_id', this.loginInfo['user_id']);
            axios.post('api/home/getMyContents',params)
                    .then(res=>{
                        this.contents = res.data.contents;
                    });
        },
        reload(){
            this.getVarious();
        },
        timeout(){
            setTimeout(() => {
                this.load_show = false
            },1000);
        },
        noImage(element){
            element.target.src = "/img/content/deleted_image.png";
        }
    },
    created(){
        this.loginInfo = JSON.parse(this.login_info);
        this.bread = JSON.parse(this.Bread);
        this.keywords = JSON.parse(this.Keywords);
        
        if(this.bread == 'various'){
            this.getVarious();
        }else if(this.bread == 'search'){
            this.getSearch();
            this.timeout();
        }else if(this.bread == 'favorite'){
            this.getFavorite();
            this.timeout();
        }else if(this.bread == 'account'){
            this.getMyContents();
            this.timeout();
        }

        this.checkImage();
    },updated(){

    }
}
</script>

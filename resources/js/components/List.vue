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
                        <a :href="'/content_detail?id='+content.id"><img :src="'/img/test/'+content.image_name"></a>
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
                <p>一致するものがありません。</p>
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
        reload(){
            this.getVarious();
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
            setTimeout(() => {
                this.load_show = false
            },1000);
        }
    },updated(){

    }
}
</script>
<style scoped>
    .content{
        width:32%;
        margin:20px 5px;
    }

    .content_image img{
        height:200px;
        max-width:100%;
    }

    .content_image{
        border:1px solid gray;
    }

    .contents_wrapper{
        text-align:center;
        width: 80%;
        margin: 0 auto;
        padding:50px 0;
    }

    .contents{
        display:flex;
        flex-wrap:wrap;
    }

    .content_tag{
        background:linear-gradient(to top, #0000d2, #5bcaff);      
        border-radius: 30px;
        padding: 3px 10px;
        display: inline-block;
        margin-top: 10px;
        color:white;
    }

    .loading{
        color:#0000d2;
    }

    .load_wrapper{
        position:absolute;
        left:0;
        right:0;
        margin:0 auto;
        background:#f8fafc;
    }

    .no_contents{
        position:relative;
    }
</style>
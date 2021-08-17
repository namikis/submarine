<template>
    <div class="home_container">
        <h1 class="home-head"><span>What</span> do you want?</h1>
        <form action="/search" method="get">
            <input type="text" class="homeSearch" placeholder="Service, Product" name="keyword" v-model="query">
            <button type="submit" class="homeSearchSubmit button" @click="wave_show=true">search</button>
        </form>
        <div class="tag_wrapper">
            <div @click="changeBool(tag_show)" class="tag_button">登録タグ一覧
                <i class="fa fa-angle-down" v-if="tag_show==false"></i>
                <i class="fa fa-angle-up" v-else></i>
            </div>
            <transition name="tag">
            <div class="tags" v-if="tag_show">
                <div class="tag button" v-for="tag in tags" @click="goSearch(tag.tag)">
                    {{ tag.tag }}
                </div>
            </div>
            </transition>
        </div>
        <transition name="wave">
            <div class="sea_wave" v-show="wave_show">
            </div>
        </transition>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    props:[],
    data(){
        return{
            tags:{},
            query:"",
            selectTag:"",
            tag_show:false,
            menu_show:false,
            wave_show:false
        }
    },
    computed:{
        
    },
    methods:{
        getTags(){
            var params = new URLSearchParams();
            axios.post('api/home/getTags',params)
                    .then(res =>{
                        this.tags = res.data.tags;
                    });
        },
        goSearch(tag){
            this.query = tag;
        },
        changeBool(show){
            if(show){
                this.tag_show = false;
            }else{
                this.tag_show = true;
            }
        },
    },
    created(){
        this.getTags();
    }
}
</script>

<style scoped>
    html {
        height: 100%;
    }

    body {
        height: 100%;
        margin: 0;
    }

    .sea_wave{
        position: absolute;
        bottom: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-image: url("../../../public/img/see_wave.png");
    }
    .wave-enter-active{
        transform: translateY(0%); 
        transition: transform 1000ms;
    }

    .wave-enter{
        transform: translateY(100%);
    }

    .tag_wrapper, .to_intro{
        width:60%;
        margin:0 auto;
    }

    .tag_wrapper{
        padding:30px 0;
    }

    .tag_button{
        cursor:pointer;
        margin:10px 0;
    }

    .tags{
        display: flex;
        flex-wrap:wrap;
        border:1px solid black;
        background:white;
        padding:5px 10px;
        border-radius:10px;
    }

    .tag{
        width:auto;
        margin:5px;
        font-size:14px;
    }

    .fa{
        font-size:22px;
    }
    
    .tag-enter-active, .tag-leave-active {
        transform: translate(0px, 0px); 
        opacity: 1;
        transition: transform 500ms, opacity 500ms;
    }

    .tag-enter, .tag-leave-to {
        transform: translateY(-10%);
        opacity:0;
    }
</style>

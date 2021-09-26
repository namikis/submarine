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
                <div class="tag button" v-for="autoTag in autoTags" @click="goSearch(autoTag.tag)">
                    {{ autoTag.tag }}
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
            autoTags:{},
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
        getAutoTags(){
            var params = new URLSearchParams();
            axios.post('api/home/getAutoTags',params)
                    .then(res =>{
                        this.autoTags = res.data.tags;
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
        this.getAutoTags();
    }
}
</script>


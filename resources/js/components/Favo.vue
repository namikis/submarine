<template>
    <div class="favo_wrapper" @click="updateFavo()">
        <div v-if="favoFlag == null">
            <div v-if="loginInfo != null">
                <div class="content_favorite button fav">{{ favDisp[mode+1] }}</div>
            </div>
            <div v-else>
                <div class="content_favorite button fav"><a href="/signIn">fav</a></div>
            </div>
        </div>
        <div v-else>
            <div class="content_favorite faved">{{ favDisp[mode+1] }}</div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    props:['login_info', 'content_id'],
    data(){
        return {
            favoFlag:null,
            loginInfo:null,
            mode:0,
            favDisp:["fav","","faved"]
        }
    },
    methods:{
        getFavo(){
            var params = new URLSearchParams();
            params.append('user_id', this.loginInfo['user_id']);
            params.append('content_id', this.contentId);
            axios.post("/api/favo/getFavo", params)
                    .then(res => {
                        this.favoFlag = res.data.favoId;
                        this.getMode();
                    });
        },
        updateFavo(){
            this.mode *= -1;
            var params = new URLSearchParams();
            params.append('user_id', this.loginInfo['user_id']);
            params.append('content_id', this.contentId);
            axios.post("/api/favo/updateFavo", params)
                    .then(res => {
                        this.getFavo();
                    });
            
        },
        getMode(){
            console.log(this.favoFlag);
            if(this.favoFlag == null){
                // not favorite
                this.mode = -1;
            }else{
                // favorite
                this.mode = 1;
            }
        }
    },
    created(){
        this.loginInfo = JSON.parse(this.login_info);
        this.contentId = JSON.parse(this.content_id);
        this.getFavo();
    }
    ,updated(){

    }
}
</script>

<style scoped>
    a{
        text-decoration: none;
    }
    .favo_wrapper{
        display: inline;
    }

    .content_favorite a{
        color:white;
    }
</style>
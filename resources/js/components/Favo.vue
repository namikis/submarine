<template>
    <div class="favo_wrapper" @click="updateFavo()">
        <div>
            <div v-if="loginInfo != null">
                <div class="content_favorite faved" v-if="mode==1"><i class="fa fa-star" aria-hidden="true"></i></div>
                <div class="content_favorite fav" v-else-if="mode==-1"><i class="fa fa-star-o" aria-hidden="true"></i></div>
            </div>
            <div v-else>
                <div class="content_favorite button fav"><a href="/signIn"><i class="fa fa-star-o" aria-hidden="true"></i></a></div>
            </div>
        </div>
        
    </div>
</template>

<script>
import axios from 'axios';
export default {
    props:['login_info', 'content_id', 'auto_flag'],
    data(){
        return {
            favoFlag:null,
            loginInfo:null,
            autoFlag:null,
            mode:0,
        }
    },
    methods:{
        getFavo(){
            var params = new URLSearchParams();
            params.append('user_id', this.loginInfo['user_id']);
            params.append('content_id', this.contentId);
            if(this.autoFlag){
                var apiGetUrl = "/api/favo/getAutoFavo";
            }else{
                var apiGetUrl = "/api/favo/getFavo";
            }
            axios.post(apiGetUrl, params)
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
            if(this.autoFlag){
                var apiUrl = "/api/favo/updateAutoFavo";
            }else{
                var apiUrl = "/api/favo/updateFavo";
            }
            axios.post(apiUrl, params)
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
        this.autoFlag = JSON.parse(this.auto_flag);
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
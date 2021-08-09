<template>
    <div class="favo_wrapper" @click="updateFavo()">
        <div v-if="favoFlag != null">
            <div class="content_favorite faved">faved</div>
            <div>{{ favoFlag }}</div>
        </div>
        <div v-else>
            <div class="content_favorite button">fav</div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    props:['login_info', 'content_id'],
    data(){
        return {
            favoFlag:''
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
                    });
        },
        updateFavo(){
            var params = new URLSearchParams();
            params.append('user_id', this.loginInfo['user_id']);
            params.append('content_id', this.contentId);
            axios.post("/api/favo/updateFavo", params)
                    .then(res => {
                        this.getFavo();
                    });
            
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
    .favo_wrapper{
        display: inline;
    }
</style>
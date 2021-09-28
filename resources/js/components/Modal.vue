<template>
    <div class="modal_wrapper">
            <a class="button modal_button" v-on:click="showModal" v-if="modalMode=='content_del'"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
            <a class="account_button modal_button" v-on:click="showModal" v-else-if="modalMode=='account_del'">削除</a>
            <div class="d_modal" v-if="modal_show">
                <div class="modal_content">
                    <div class="close_modal"><i class="fa fa-window-close" @click="closeModal"></i></div>
                    <div v-if="modalMode=='content_del'">
                        <p class="modal_message">本当に削除しますか？</p>
                        <p v-if="autoFlag"><a :href="'/content/delete?auto=1&id=' + contentId" class="button">削除</a></p>
                        <p v-else><a :href="'/content/delete?id=' + contentId" class="button">削除</a></p>
                    </div>
                    <div v-else-if="modalMode=='account_del'">
                        <p class="modal_message">アカウントを削除すると投稿も削除されます。<br>本当に削除しますか？</p>
                        <p><a href="/account/delete" class="button">削除</a></p>
                    </div>
                </div>
            </div>
   </div>
</template>
<script>
export default {
    props:['modal_mode','content_id', 'auto_flag'],
    data(){
        return{
            modal_show:false,
            autoFlag:null
        }
    },
    methods:{
        showModal(){
            this.modal_show = true;
        },
        closeModal(){
            this.modal_show = false;
        }
    },
    created(){
        this.modalMode = JSON.parse(this.modal_mode);
        this.autoFlag = JSON.parse(this.auto_flag);
        if(this.modalMode=='content_del'){
            this.contentId = JSON.parse(this.content_id);
        }
    }
}
</script>